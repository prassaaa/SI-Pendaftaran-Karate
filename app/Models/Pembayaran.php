<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'peserta_id',
        'kode_pembayaran',
        'jumlah_bayar',
        'metode_pembayaran',
        'status_bayar',
        'bukti_bayar_path',
        'tanggal_bayar',
        'tanggal_expired',
        'keterangan',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
        'tanggal_bayar' => 'datetime',
        'tanggal_expired' => 'datetime',
        'verified_at' => 'datetime',
    ];

    /**
     * Relationship: Pembayaran belongs to Peserta
     */
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    /**
     * Relationship: Pembayaran verified by User (admin)
     */
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Scope untuk status pembayaran
     */
    public function scopePending($query)
    {
        return $query->where('status_bayar', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status_bayar', 'paid');
    }

    public function scopeExpired($query)
    {
        return $query->where('status_bayar', 'expired');
    }

    public function scopeFailed($query)
    {
        return $query->where('status_bayar', 'failed');
    }

    /**
     * Generate kode pembayaran unik
     */
    public static function generateKodePembayaran()
    {
        $prefix = 'PAY';
        $timestamp = date('YmdHis');
        $random = rand(100, 999);

        return $prefix . $timestamp . $random;
    }

    /**
     * Get formatted jumlah bayar
     */
    public function getFormattedJumlahBayarAttribute()
    {
        return 'Rp ' . number_format($this->jumlah_bayar, 0, ',', '.');
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status_bayar) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-green-100 text-green-800',
            'expired' => 'bg-gray-100 text-gray-800',
            'failed' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Check if payment is expired
     */
    public function isExpired()
    {
        return $this->tanggal_expired && Carbon::now()->gt($this->tanggal_expired);
    }

    /**
     * Get metode pembayaran formatted
     */
    public function getMetodePembayaranFormattedAttribute()
    {
        return match($this->metode_pembayaran) {
            'transfer' => 'Transfer Bank',
            'cash' => 'Bayar Tunai',
            'qris' => 'QRIS',
            default => ucfirst($this->metode_pembayaran)
        };
    }

    /**
     * Mark as verified
     */
    public function markAsVerified($adminId)
    {
        $this->update([
            'status_bayar' => 'paid',
            'verified_by' => $adminId,
            'verified_at' => now(),
        ]);

        // Update status bayar peserta
        $this->peserta->update([
            'status_bayar' => 'paid'
        ]);
    }

    /**
     * Mark as expired
     */
    public function markAsExpired()
    {
        $this->update([
            'status_bayar' => 'expired'
        ]);
    }
}
