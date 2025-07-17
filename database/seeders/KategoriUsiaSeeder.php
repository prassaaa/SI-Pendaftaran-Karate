<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriUsia;

class KategoriUsiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Anak-anak',
                'rentang_usia' => '8-12 tahun',
                'deskripsi' => 'Kategori untuk anak-anak usia 8 sampai 12 tahun'
            ],
            [
                'nama_kategori' => 'Remaja',
                'rentang_usia' => '13-17 tahun',
                'deskripsi' => 'Kategori untuk remaja usia 13 sampai 17 tahun'
            ],
            [
                'nama_kategori' => 'Dewasa Muda',
                'rentang_usia' => '18-25 tahun',
                'deskripsi' => 'Kategori untuk dewasa muda usia 18 sampai 25 tahun'
            ],
            [
                'nama_kategori' => 'Dewasa',
                'rentang_usia' => '26-35 tahun',
                'deskripsi' => 'Kategori untuk dewasa usia 26 sampai 35 tahun'
            ],
            [
                'nama_kategori' => 'Master',
                'rentang_usia' => '36+ tahun',
                'deskripsi' => 'Kategori untuk master usia 36 tahun ke atas'
            ],
        ];

        foreach ($kategoris as $kategori) {
            KategoriUsia::create($kategori);
        }
    }
}
