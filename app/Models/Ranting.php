<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranting extends Model
{
    use HasFactory;

    protected $table = 'ranting';

    protected $fillable = [
        'nama_ranting',
        'kota',
        'provinsi',
        'alamat',
        'kontak',
    ];

    /**
     * Relationship: Ranting has many Peserta
     */
    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'ranting_id');
    }

    /**
     * Get full location (Kota, Provinsi)
     */
    public function getFullLocationAttribute()
    {
        return $this->kota . ', ' . $this->provinsi;
    }
}
