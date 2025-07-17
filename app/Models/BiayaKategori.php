<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaKategori extends Model
{
    use HasFactory;

    protected $table = 'biaya_kategori';

    protected $fillable = [
        'nama_kategori',
        'biaya_kumite',
        'biaya_kata',
        'biaya_beregu',
        'status',
    ];

    protected $casts = [
        'biaya_kumite' => 'decimal:2',
        'biaya_kata' => 'decimal:2',
        'biaya_beregu' => 'decimal:2',
    ];

    /**
     * Scope untuk biaya yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get formatted biaya kumite
     */
    public function getFormattedBiayaKumiteAttribute()
    {
        return 'Rp ' . number_format($this->biaya_kumite, 0, ',', '.');
    }

    /**
     * Get formatted biaya kata
     */
    public function getFormattedBiayaKataAttribute()
    {
        return 'Rp ' . number_format($this->biaya_kata, 0, ',', '.');
    }

    /**
     * Get formatted biaya beregu
     */
    public function getFormattedBiayaBereguAttribute()
    {
        return 'Rp ' . number_format($this->biaya_beregu, 0, ',', '.');
    }

    /**
     * Check if this biaya is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'active' => 'bg-green-100 text-green-800',
            'inactive' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'active' => 'Aktif',
            'inactive' => 'Tidak Aktif',
            default => 'Tidak Diketahui'
        };
    }
}
