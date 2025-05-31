<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\BiayaKategori;

class Peserta extends Model
{
    use HasFactory;

    protected $table = 'peserta';

    protected $fillable = [
        'user_id',
        'kode_pendaftaran',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'jenis_kelamin',
        'ranting_id',
        'golongan_darah',
        'kategori_usia_id',
        'berat_badan',
        'kumite_perorangan',
        'kata_perorangan',
        'kata_beregu',
        'kumite_beregu',
        'foto_path',
        'total_biaya',
        'status_pendaftaran',
        'status_bayar',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'berat_badan' => 'decimal:2',
        'total_biaya' => 'decimal:2',
        'kumite_perorangan' => 'boolean',
        'kata_perorangan' => 'boolean',
        'kata_beregu' => 'boolean',
        'kumite_beregu' => 'boolean',
    ];

    /**
     * Relationship: Peserta belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Peserta belongs to Ranting
     */
    public function ranting()
    {
        return $this->belongsTo(Ranting::class);
    }

    /**
     * Relationship: Peserta belongs to KategoriUsia
     */
    public function kategoriUsia()
    {
        return $this->belongsTo(KategoriUsia::class, 'kategori_usia_id');
    }

    /**
     * Relationship: Peserta has many Pembayaran
     */
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'peserta_id');
    }

    /**
     * Get latest pembayaran
     */
    public function latestPembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'peserta_id')->latest();
    }

    /**
     * Scope untuk status pendaftaran
     */
    public function scopePending($query)
    {
        return $query->where('status_pendaftaran', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status_pendaftaran', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status_pendaftaran', 'rejected');
    }

    /**
     * Scope untuk status bayar
     */
    public function scopeUnpaid($query)
    {
        return $query->where('status_bayar', 'unpaid');
    }

    public function scopePendingPayment($query)
    {
        return $query->where('status_bayar', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status_bayar', 'paid');
    }

    /**
     * Generate kode pendaftaran unik
     */
    public static function generateKodePendaftaran()
    {
        $prefix = 'KRT';
        $year = date('Y');
        $month = date('m');

        // Hitung jumlah peserta bulan ini
        $count = self::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count() + 1;

        return $prefix . $year . $month . str_pad($count, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Get umur berdasarkan tanggal lahir
     */
    public function getUmurAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    /**
     * Get tempat tanggal lahir formatted
     */
    public function getTempatTanggalLahirAttribute()
    {
        return $this->tempat_lahir . ', ' . $this->tanggal_lahir->format('d F Y');
    }

    /**
     * Get formatted total biaya
     */
    public function getFormattedTotalBiayaAttribute()
    {
        return 'Rp ' . number_format($this->total_biaya, 0, ',', '.');
    }

    /**
     * Get status pendaftaran badge class
     */
    public function getStatusPendaftaranBadgeAttribute()
    {
        return match($this->status_pendaftaran) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get status bayar badge class
     */
    public function getStatusBayarBadgeAttribute()
    {
        return match($this->status_bayar) {
            'unpaid' => 'bg-red-100 text-red-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get kategori yang dipilih
     */
    public function getKategoriDipilihAttribute()
    {
        $kategori = [];

        if ($this->kumite_perorangan) $kategori[] = 'Kumite Perorangan';
        if ($this->kata_perorangan) $kategori[] = 'Kata Perorangan';
        if ($this->kata_beregu) $kategori[] = 'Kata Beregu';
        if ($this->kumite_beregu) $kategori[] = 'Kumite Beregu';

        return $kategori;
    }

    /**
     * Calculate total biaya based on selected categories
     */
    public function calculateTotalBiaya()
    {
        try {
            // Get active biaya kategori
            $biaya = \App\Models\BiayaKategori::active()->first();

            if ($biaya) {
                $total = 0;
                if ($this->kumite_perorangan) $total += $biaya->biaya_kumite;
                if ($this->kata_perorangan) $total += $biaya->biaya_kata;
                if ($this->kata_beregu) $total += $biaya->biaya_beregu;
                if ($this->kumite_beregu) $total += $biaya->biaya_beregu;

                return $total;
            }
        } catch (\Exception $e) {
            // Log error but continue with default calculation
            \Log::warning('Error getting BiayaKategori: ' . $e->getMessage());
        }

        // Default biaya jika tidak ada setting atau error
        $total = 0;
        if ($this->kumite_perorangan) $total += 50000;
        if ($this->kata_perorangan) $total += 40000;
        if ($this->kata_beregu) $total += 75000;
        if ($this->kumite_beregu) $total += 75000;

        return $total;
    }
}
