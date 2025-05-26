<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BiayaKategori;

class BiayaKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $biayas = [
            [
                'nama_kategori' => 'Biaya Pendaftaran 2025',
                'biaya_kumite' => 50000.00,
                'biaya_kata' => 40000.00,
                'biaya_beregu' => 75000.00,
                'status' => 'active'
            ],
            [
                'nama_kategori' => 'Biaya Pendaftaran 2024 (Arsip)',
                'biaya_kumite' => 45000.00,
                'biaya_kata' => 35000.00,
                'biaya_beregu' => 70000.00,
                'status' => 'inactive'
            ]
        ];

        foreach ($biayas as $biaya) {
            BiayaKategori::create($biaya);
        }
    }
}
