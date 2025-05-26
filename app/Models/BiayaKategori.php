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
}
