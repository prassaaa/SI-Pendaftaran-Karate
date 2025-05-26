<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUsia extends Model
{
    use HasFactory;

    protected $table = 'kategori_usia';

    protected $fillable = [
        'nama_kategori',
        'rentang_usia',
        'deskripsi',
    ];

    /**
     * Relationship: KategoriUsia has many Peserta
     */
    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'kategori_usia_id');
    }
}
