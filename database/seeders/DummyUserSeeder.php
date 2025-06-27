<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Peserta;
use App\Models\Pembayaran;
use App\Models\Ranting;
use App\Models\KategoriUsia;
use App\Models\BiayaKategori;
use Carbon\Carbon;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan data referensi sudah ada
        $rantings = Ranting::all();
        $kategoriUsias = KategoriUsia::all();
        $biayaKategori = BiayaKategori::active()->first();
        $admin = User::where('role', 'admin')->first();

        if ($rantings->isEmpty() || $kategoriUsias->isEmpty() || !$biayaKategori || !$admin) {
            $this->command->error('Data referensi belum lengkap. Pastikan seeder Ranting, KategoriUsia, BiayaKategori, dan AdminUser sudah dijalankan.');
            return;
        }

        // Cek apakah sudah ada data dummy
        $existingDummy = User::where('email', 'like', '%@example.com')->count();
        if ($existingDummy > 0) {
            $this->command->warn("Sudah ada {$existingDummy} user dummy. Apakah Anda ingin menambah lagi?");
            if (!$this->command->confirm('Lanjutkan?')) {
                return;
            }
        }

        // Jumlah user yang akan dibuat (default 50)
        $jumlahUser = 150;

        $this->command->info("Membuat {$jumlahUser} user dummy dengan data terverifikasi...");

        // Data nama Indonesia yang realistis
        $namaLaki = [
            'Ahmad Rizki Pratama', 'Budi Santoso', 'Dedi Kurniawan', 'Eko Prasetyo',
            'Fajar Nugroho', 'Gilang Ramadhan', 'Hendra Wijaya', 'Indra Gunawan',
            'Joko Susilo', 'Krisna Mahendra', 'Lukman Hakim', 'Muhammad Iqbal',
            'Nanda Pratama', 'Oscar Febrian', 'Putra Aditya', 'Qori Maulana',
            'Rizky Firmansyah', 'Sandi Permana', 'Taufik Hidayat', 'Umar Faruq',
            'Vino Bastian', 'Wahyu Setiawan', 'Xavier Nugraha', 'Yoga Pratama', 'Zaki Rahman'
        ];

        $namaPerempuan = [
            'Ayu Lestari', 'Bella Safitri', 'Citra Dewi', 'Dina Marlina',
            'Eka Putri', 'Fitri Handayani', 'Gita Sari', 'Hani Rahmawati',
            'Indah Permata', 'Jihan Aulia', 'Kirana Putri', 'Lina Marlina',
            'Maya Sari', 'Nisa Rahmawati', 'Olivia Damayanti', 'Putri Ayu',
            'Qonita Zahira', 'Rina Wulandari', 'Sari Dewi', 'Tika Pratiwi',
            'Ulfa Khoirunnisa', 'Vera Anggraini', 'Winda Sari', 'Xenia Putri', 'Yuni Astuti'
        ];

        $tempatLahir = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Makassar',
            'Palembang', 'Tangerang', 'Depok', 'Bekasi', 'Kediri', 'Malang',
            'Yogyakarta', 'Solo', 'Bogor', 'Batam', 'Pekanbaru', 'Bandar Lampung',
            'Padang', 'Denpasar', 'Samarinda', 'Balikpapan', 'Pontianak', 'Manado'
        ];

        $alamatJalan = [
            'Jl. Merdeka', 'Jl. Sudirman', 'Jl. Thamrin', 'Jl. Gatot Subroto',
            'Jl. Ahmad Yani', 'Jl. Diponegoro', 'Jl. Pahlawan', 'Jl. Pemuda',
            'Jl. Kartini', 'Jl. Veteran', 'Jl. Dhoho', 'Jl. Brawijaya',
            'Jl. Majapahit', 'Jl. Hayam Wuruk', 'Jl. Gajah Mada'
        ];

        $golonganDarah = ['A', 'B', 'AB', 'O'];

        for ($i = 1; $i <= $jumlahUser; $i++) {
            try {
                // Tentukan jenis kelamin secara acak
                $jenisKelamin = rand(0, 1) ? 'L' : 'P';
                $namaLengkap = $jenisKelamin === 'L'
                    ? $namaLaki[array_rand($namaLaki)]
                    : $namaPerempuan[array_rand($namaPerempuan)];

                // Generate email unik dengan timestamp untuk menghindari duplikasi
                $emailBase = strtolower(str_replace(' ', '.', $namaLengkap));
                $email = $emailBase . '.' . time() . '.' . $i . '@example.com';

            // Buat user
            $user = User::create([
                'name' => $namaLengkap,
                'email' => $email,
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'email_verified_at' => now(),
            ]);

            // Generate data peserta
            $tanggalLahir = Carbon::now()->subYears(rand(10, 45))->subDays(rand(1, 365));
            $ranting = $rantings->random();
            $kategoriUsia = $kategoriUsias->random();

            // Pilih kategori lomba secara acak
            $kumitePerorangan = rand(0, 1);
            $kataPerorangan = rand(0, 1);
            $kataBeregu = rand(0, 1);
            $kumiteBeregu = rand(0, 1);

            // Pastikan minimal satu kategori dipilih
            if (!$kumitePerorangan && !$kataPerorangan && !$kataBeregu && !$kumiteBeregu) {
                $kumitePerorangan = 1;
            }

            // Hitung total biaya
            $totalBiaya = 0;
            if ($kumitePerorangan) $totalBiaya += $biayaKategori->biaya_kumite;
            if ($kataPerorangan) $totalBiaya += $biayaKategori->biaya_kata;
            if ($kataBeregu) $totalBiaya += $biayaKategori->biaya_beregu;
            if ($kumiteBeregu) $totalBiaya += $biayaKategori->biaya_beregu;

            // Generate kode pendaftaran manual untuk dummy data
            $kodePendaftaran = 'KRT' . date('Ym') . str_pad($i, 3, '0', STR_PAD_LEFT);

            // Buat data peserta
            $peserta = Peserta::create([
                'user_id' => $user->id,
                'kode_pendaftaran' => $kodePendaftaran,
                'nama_lengkap' => $namaLengkap,
                'tempat_lahir' => $tempatLahir[array_rand($tempatLahir)],
                'tanggal_lahir' => $tanggalLahir,
                'alamat' => $alamatJalan[array_rand($alamatJalan)] . ' No. ' . rand(1, 999) . ', RT ' . rand(1, 10) . '/RW ' . rand(1, 15),
                'no_telepon' => '08' . rand(1000000000, 9999999999),
                'jenis_kelamin' => $jenisKelamin,
                'ranting_id' => $ranting->id,
                'golongan_darah' => $golonganDarah[array_rand($golonganDarah)],
                'kategori_usia_id' => $kategoriUsia->id,
                'berat_badan' => rand(30, 100) + (rand(0, 99) / 100), // 30.00 - 100.99 kg
                'kumite_perorangan' => $kumitePerorangan,
                'kata_perorangan' => $kataPerorangan,
                'kata_beregu' => $kataBeregu,
                'kumite_beregu' => $kumiteBeregu,
                'foto_path' => null, // Dummy data tidak perlu foto
                'total_biaya' => $totalBiaya,
                'status_pendaftaran' => 'approved', // Sudah disetujui
                'status_bayar' => 'paid', // Sudah dibayar
            ]);

            // Buat data pembayaran yang sudah diverifikasi
            $tanggalBayar = $peserta->created_at->addHours(rand(1, 48));
            $tanggalVerified = $tanggalBayar->addHours(rand(1, 24));

            Pembayaran::create([
                'peserta_id' => $peserta->id,
                'kode_pembayaran' => 'PAY' . date('YmdHis', $tanggalBayar->timestamp) . rand(100, 999),
                'jumlah_bayar' => $totalBiaya,
                'metode_pembayaran' => ['transfer', 'qris', 'cash'][array_rand(['transfer', 'qris', 'cash'])],
                'status_bayar' => 'paid',
                'bukti_bayar_path' => 'dummy/bukti_bayar_' . $peserta->id . '.jpg',
                'tanggal_bayar' => $tanggalBayar,
                'tanggal_expired' => $tanggalBayar->addDays(3),
                'keterangan' => 'Pembayaran untuk pendaftaran karate - Data dummy',
                'verified_by' => $admin->id,
                'verified_at' => $tanggalVerified,
                'created_at' => $tanggalBayar,
                'updated_at' => $tanggalVerified,
            ]);

                if ($i % 10 == 0) {
                    $this->command->info("Berhasil membuat {$i} user dummy...");
                }
            } catch (\Exception $e) {
                $this->command->error("Error membuat user ke-{$i}: " . $e->getMessage());
                continue;
            }
        }

        $this->command->info("Selesai! {$jumlahUser} user dummy dengan data terverifikasi berhasil dibuat.");
        $this->command->info('Login credentials untuk semua user dummy: password123');
    }
}
