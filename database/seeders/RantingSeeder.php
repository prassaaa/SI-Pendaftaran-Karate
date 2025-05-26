<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ranting;

class RantingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rantings = [
            [
                'nama_ranting' => 'INKAI Kediri Kota',
                'kota' => 'Kediri',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Dhoho No. 123, Kediri Kota',
                'kontak' => '0354-123456'
            ],
            [
                'nama_ranting' => 'INKAI Kediri Kabupaten',
                'kota' => 'Kediri',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Ahmad Yani No. 456, Pare, Kediri',
                'kontak' => '0354-234567'
            ],
            [
                'nama_ranting' => 'INKAI Tulungagung',
                'kota' => 'Tulungagung',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Pahlawan No. 789, Tulungagung',
                'kontak' => '0355-345678'
            ],
            [
                'nama_ranting' => 'INKAI Blitar',
                'kota' => 'Blitar',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Merdeka No. 321, Blitar',
                'kontak' => '0342-456789'
            ],
            [
                'nama_ranting' => 'INKAI Nganjuk',
                'kota' => 'Nganjuk',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Diponegoro No. 654, Nganjuk',
                'kontak' => '0358-567890'
            ],
            [
                'nama_ranting' => 'INKAI Jombang',
                'kota' => 'Jombang',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. KH. Wahid Hasyim No. 987, Jombang',
                'kontak' => '0321-678901'
            ],
            [
                'nama_ranting' => 'INKAI Malang',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Ijen No. 147, Malang',
                'kontak' => '0341-789012'
            ],
            [
                'nama_ranting' => 'INKAI Surabaya Utara',
                'kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Ahmad Yani No. 258, Surabaya Utara',
                'kontak' => '031-890123'
            ],
            [
                'nama_ranting' => 'INKAI Surabaya Selatan',
                'kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. HR. Muhammad No. 369, Surabaya Selatan',
                'kontak' => '031-901234'
            ],
            [
                'nama_ranting' => 'INKAI Mojokerto',
                'kota' => 'Mojokerto',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Gajah Mada No. 741, Mojokerto',
                'kontak' => '0321-012345'
            ],
            [
                'nama_ranting' => 'INKAI Sidoarjo',
                'kota' => 'Sidoarjo',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Diponegoro No. 852, Sidoarjo',
                'kontak' => '031-123456'
            ],
            [
                'nama_ranting' => 'INKAI Pasuruan',
                'kota' => 'Pasuruan',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Panglima Sudirman No. 963, Pasuruan',
                'kontak' => '0343-234567'
            ],
            [
                'nama_ranting' => 'INKAI Probolinggo',
                'kota' => 'Probolinggo',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Dr. Sutomo No. 174, Probolinggo',
                'kontak' => '0335-345678'
            ],
            [
                'nama_ranting' => 'INKAI Lumajang',
                'kota' => 'Lumajang',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Basuki Rahmat No. 285, Lumajang',
                'kontak' => '0334-456789'
            ],
            [
                'nama_ranting' => 'INKAI Jember',
                'kota' => 'Jember',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. PB. Sudirman No. 396, Jember',
                'kontak' => '0331-567890'
            ],
            [
                'nama_ranting' => 'INKAI Banyuwangi',
                'kota' => 'Banyuwangi',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Ahmad Yani No. 507, Banyuwangi',
                'kontak' => '0333-678901'
            ],
            [
                'nama_ranting' => 'INKAI Madiun',
                'kota' => 'Madiun',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Pahlawan No. 618, Madiun',
                'kontak' => '0351-789012'
            ],
            [
                'nama_ranting' => 'INKAI Magetan',
                'kota' => 'Magetan',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Raya Magetan No. 729, Magetan',
                'kontak' => '0351-890123'
            ],
            [
                'nama_ranting' => 'INKAI Ponorogo',
                'kota' => 'Ponorogo',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Soekarno Hatta No. 830, Ponorogo',
                'kontak' => '0352-901234'
            ],
            [
                'nama_ranting' => 'INKAI Trenggalek',
                'kota' => 'Trenggalek',
                'provinsi' => 'Jawa Timur',
                'alamat' => 'Jl. Pemuda No. 941, Trenggalek',
                'kontak' => '0355-012345'
            ]
        ];

        foreach ($rantings as $ranting) {
            Ranting::create($ranting);
        }
    }
}
