<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Aplikasi
            [
                'key' => 'app_name',
                'value' => 'Karate INKAI Kediri',
                'description' => 'Nama aplikasi yang ditampilkan'
            ],
            [
                'key' => 'app_version',
                'value' => '1.0.0',
                'description' => 'Versi aplikasi'
            ],
            [
                'key' => 'app_description',
                'value' => 'Sistem Pendaftaran Calon Peserta Kejuaraan Karate INKAI Kediri',
                'description' => 'Deskripsi aplikasi'
            ],

            // Event Information
            [
                'key' => 'event_name',
                'value' => 'Kejuaraan Karate INKAI Kediri 2025',
                'description' => 'Nama event kejuaraan'
            ],
            [
                'key' => 'event_date',
                'value' => '15-17 Juni 2025',
                'description' => 'Tanggal pelaksanaan event'
            ],
            [
                'key' => 'event_location',
                'value' => 'GOR Jayabaya Kediri',
                'description' => 'Lokasi pelaksanaan event'
            ],
            [
                'key' => 'event_organizer',
                'value' => 'INKAI (Ikatan Nasional Karate-do Indonesia) Cabang Kediri',
                'description' => 'Penyelenggara event'
            ],

            // Registration Settings
            [
                'key' => 'registration_start',
                'value' => '1 Mei 2025',
                'description' => 'Tanggal mulai pendaftaran'
            ],
            [
                'key' => 'registration_end',
                'value' => '10 Juni 2025',
                'description' => 'Tanggal akhir pendaftaran'
            ],
            [
                'key' => 'registration_deadline',
                'value' => '10 Juni 2025',
                'description' => 'Batas akhir pendaftaran'
            ],
            [
                'key' => 'payment_deadline',
                'value' => '3 hari setelah pendaftaran',
                'description' => 'Batas waktu pembayaran'
            ],
            [
                'key' => 'max_participants',
                'value' => '500',
                'description' => 'Maksimal peserta yang dapat mendaftar'
            ],

            // Contact Information
            [
                'key' => 'office_address',
                'value' => 'Jl. Brawijaya No. 123, Kediri, Jawa Timur 64111',
                'description' => 'Alamat sekretariat'
            ],
            [
                'key' => 'office_phone',
                'value' => '(0354) 123-456',
                'description' => 'Nomor telepon sekretariat'
            ],
            [
                'key' => 'office_whatsapp',
                'value' => '081234567890',
                'description' => 'Nomor WhatsApp sekretariat'
            ],
            [
                'key' => 'office_email',
                'value' => 'info@inkai-kediri.com',
                'description' => 'Email sekretariat'
            ],
            [
                'key' => 'office_hours',
                'value' => 'Senin-Jumat: 08:00-16:00, Sabtu: 08:00-12:00',
                'description' => 'Jam operasional sekretariat'
            ],

            // Bank Account Information
            [
                'key' => 'bank_bca_account',
                'value' => '1234567890',
                'description' => 'Nomor rekening Bank BCA'
            ],
            [
                'key' => 'bank_bca_holder',
                'value' => 'INKAI Kediri',
                'description' => 'Nama pemegang rekening BCA'
            ],
            [
                'key' => 'bank_mandiri_account',
                'value' => '0987654321',
                'description' => 'Nomor rekening Bank Mandiri'
            ],
            [
                'key' => 'bank_mandiri_holder',
                'value' => 'INKAI Kediri',
                'description' => 'Nama pemegang rekening Mandiri'
            ],

            // Social Media
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/inkai.kediri',
                'description' => 'URL Facebook official'
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/inkai.kediri',
                'description' => 'URL Instagram official'
            ],
            [
                'key' => 'youtube_url',
                'value' => 'https://youtube.com/@inkaikediri',
                'description' => 'URL YouTube official'
            ],
            [
                'key' => 'website_url',
                'value' => 'https://inkai-kediri.com',
                'description' => 'Website official INKAI Kediri'
            ],

            // Email Settings
            [
                'key' => 'email_from_name',
                'value' => 'INKAI Kediri',
                'description' => 'Nama pengirim email'
            ],
            [
                'key' => 'email_from_address',
                'value' => 'noreply@inkai-kediri.com',
                'description' => 'Email pengirim otomatis'
            ],

            // Technical Settings
            [
                'key' => 'maintenance_mode',
                'value' => 'false',
                'description' => 'Mode maintenance aplikasi'
            ],
            [
                'key' => 'registration_open',
                'value' => 'true',
                'description' => 'Status pendaftaran (buka/tutup)'
            ],
            [
                'key' => 'auto_approve',
                'value' => 'false',
                'description' => 'Otomatis approve pendaftaran'
            ],
            [
                'key' => 'notification_enabled',
                'value' => 'true',
                'description' => 'Status notifikasi email'
            ],

            // File Upload Settings
            [
                'key' => 'max_photo_size',
                'value' => '2048',
                'description' => 'Maksimal ukuran foto (KB)'
            ],
            [
                'key' => 'max_payment_proof_size',
                'value' => '5120',
                'description' => 'Maksimal ukuran bukti bayar (KB)'
            ],
            [
                'key' => 'allowed_photo_types',
                'value' => 'jpg,jpeg,png',
                'description' => 'Tipe file foto yang diizinkan'
            ],
            [
                'key' => 'allowed_payment_proof_types',
                'value' => 'jpg,jpeg,png,pdf',
                'description' => 'Tipe file bukti bayar yang diizinkan'
            ],

            // Competition Categories
            [
                'key' => 'categories_enabled',
                'value' => 'kumite_perorangan,kata_perorangan,kata_beregu,kumite_beregu',
                'description' => 'Kategori pertandingan yang tersedia'
            ],

            // Terms and Conditions
            [
                'key' => 'terms_and_conditions',
                'value' => 'Dengan mendaftar, peserta menyetujui semua peraturan yang berlaku dalam kejuaraan ini.',
                'description' => 'Syarat dan ketentuan pendaftaran'
            ],
            [
                'key' => 'privacy_policy',
                'value' => 'Data pribadi peserta akan dijaga kerahasiaannya dan hanya digunakan untuk keperluan kejuaraan.',
                'description' => 'Kebijakan privasi'
            ],

            // Additional Info
            [
                'key' => 'welcome_message',
                'value' => 'Selamat datang di sistem pendaftaran Kejuaraan Karate INKAI Kediri 2025. Daftarkan diri Anda sekarang!',
                'description' => 'Pesan selamat datang di halaman utama'
            ],
            [
                'key' => 'registration_success_message',
                'value' => 'Pendaftaran Anda berhasil! Silakan lakukan pembayaran untuk menyelesaikan proses pendaftaran.',
                'description' => 'Pesan setelah berhasil mendaftar'
            ],
            [
                'key' => 'payment_success_message',
                'value' => 'Pembayaran Anda sedang diverifikasi. Anda akan mendapat notifikasi setelah pembayaran dikonfirmasi.',
                'description' => 'Pesan setelah upload bukti bayar'
            ]
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
