# 🥋 Sistem Pendaftaran Karate INKAI Kediri

Sistem pendaftaran online untuk kejuaraan karate INKAI Kediri yang dibangun menggunakan Laravel 10, Tailwind CSS, dan metode Extreme Programming (XP).

## 📋 Deskripsi

Aplikasi web untuk memudahkan pendaftaran peserta kejuaraan karate dengan fitur pembayaran online, verifikasi admin, dan sistem laporan yang komprehensif.

## ✨ Fitur Utama

### 🌐 Frontend (Public)
- **Landing Page** dengan informasi kejuaraan
- **Form Pendaftaran Multi-step** yang user-friendly
- **Sistem Pembayaran** dengan multiple metode
- **Upload Bukti Bayar** dan tracking status
- **Cek Status Pendaftaran** real-time
- **Download Invoice** dalam format PDF

### 🔧 Backend (Admin Dashboard)
- **Dashboard Analytics** dengan charts dan statistik
- **Manajemen Data Peserta** lengkap dengan filter
- **Verifikasi Pembayaran** dengan preview bukti
- **Sistem Notifikasi** real-time
- **Export Data** ke Excel dan PDF
- **Laporan Keuangan** dan pendaftaran

## 🛠️ Tech Stack

- **Framework**: Laravel 10
- **Frontend**: Blade Templates + Tailwind CSS
- **JavaScript**: Alpine.js + Chart.js
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **File Storage**: Laravel Storage
- **Export**: Excel (maatwebsite/excel) + PDF (DomPDF)

## 📦 Dependencies

### Composer Packages
```json
{
  "laravel/framework": "^10.10",
  "laravel/breeze": "^1.21",
  "maatwebsite/excel": "^3.1",
  "barryvdh/laravel-dompdf": "^2.0",
  "intervention/image": "^2.7",
  "doctrine/dbal": "^3.6"
}
```

### NPM Packages
```json
{
  "tailwindcss": "^3.3.0",
  "@tailwindcss/forms": "^0.5.3",
  "alpinejs": "^3.12.0",
  "chart.js": "^4.3.0",
  "sweetalert2": "^11.7.0"
}
```

## 🚀 Installation

### 1. Clone Repository
```bash
git clone https://github.com/username/karate-registration.git
cd karate-registration
```

### 2. Install Dependencies
```bash
# Install Composer packages
composer install

# Install NPM packages
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=karate_registration
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Database Setup
```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### 5. Storage Setup
```bash
# Create storage link
php artisan storage:link
```

### 6. Build Assets
```bash
# Compile assets
npm run build

# For development
npm run dev
```

### 7. Start Server
```bash
php artisan serve
```

## 🗄️ Database Schema

### Tabel Utama
- **users** - Data admin dan super admin
- **peserta** - Data peserta karate
- **pembayaran** - Transaksi pembayaran
- **kategori_usia** - Master kategori usia
- **ranting** - Master ranting/cabang
- **biaya_kategori** - Master biaya per kategori
- **notifications** - Sistem notifikasi
- **settings** - Pengaturan aplikasi

## 👤 Default Admin

```
Email: admin@inkai.com
Password: password123
```

> ⚠️ **Penting**: Ubah password default setelah login pertama!

## 🎯 Alur Aplikasi

### Pendaftaran Peserta
1. **Landing Page** → Informasi kejuaraan
2. **Form Step 1** → Data pribadi peserta
3. **Form Step 2** → Pilih kategori & hitung biaya
4. **Form Step 3** → Upload foto peserta
5. **Form Step 4** → Review & konfirmasi
6. **Generate Kode** → Kode pendaftaran unik
7. **Pembayaran** → Pilih metode bayar
8. **Upload Bukti** → Bukti transfer/QRIS
9. **Verifikasi Admin** → Approve/reject
10. **Status Lunas** → Pendaftaran selesai

### Dashboard Admin
1. **Login** → Autentikasi admin
2. **Dashboard** → Overview statistik
3. **Notifikasi** → Pendaftaran baru
4. **Verifikasi** → Cek bukti bayar
5. **Approve/Reject** → Update status
6. **Laporan** → Generate reports
7. **Export** → Download data

## 💰 Biaya Pendaftaran

| Kategori | Biaya |
|----------|-------|
| Kumite Perorangan | Rp 50.000 |
| Kata Perorangan | Rp 40.000 |
| Kata Beregu | Rp 75.000 |
| Kumite Beregu | Rp 75.000 |
| **Maksimal Total** | **Rp 240.000** |

## 🔐 Security Features

- **CSRF Protection** - Perlindungan dari Cross-Site Request Forgery
- **Input Sanitization** - Validasi dan sanitasi input
- **Authentication Middleware** - Proteksi route admin
- **File Upload Validation** - Validasi tipe dan ukuran file
- **Rate Limiting** - Pembatasan request per IP
- **Secure File Storage** - Penyimpanan file yang aman

## 📊 Features Dashboard

### Analytics
- Total peserta terdaftar
- Revenue hari ini/bulan ini
- Pembayaran pending verifikasi
- Chart peserta per kategori
- Chart trend pembayaran

### Management
- CRUD peserta lengkap
- Bulk approve/reject
- Filter dan search advanced
- Export Excel/PDF
- Backup database

## 🧪 Testing

```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter=PesertaTest
```

## 📁 Project Structure

```
app/
├── Http/Controllers/
│   ├── Auth/                 # Laravel Breeze auth
│   ├── DashboardController.php
│   ├── PesertaController.php
│   ├── PendaftaranController.php
│   ├── PembayaranController.php
│   └── ExportController.php
├── Models/
│   ├── User.php
│   ├── Peserta.php
│   ├── Pembayaran.php
│   └── ...
├── Exports/
│   └── PesertaExport.php
resources/views/
├── layouts/
├── auth/                     # Laravel Breeze views
├── dashboard/
├── pendaftaran/
└── welcome.blade.php
```

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

## 📝 License

Distributed under the MIT License. See `LICENSE` for more information.

## 👨‍💻 Author

**Nama Developer**
- GitHub: [@username](https://github.com/username)
- Email: developer@email.com

## 🙏 Acknowledgments

- [Laravel Framework](https://laravel.com/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Alpine.js](https://alpinejs.dev/)
- [Chart.js](https://www.chartjs.org/)
- INKAI Kediri untuk kepercayaan project ini

---

## 📞 Support

Jika mengalami kendala atau memiliki pertanyaan:

1. **Bug Reports**: Buat issue di GitHub
2. **Feature Requests**: Diskusi di GitHub Discussions
3. **Email**: support@inkai-kediri.com
4. **Documentation**: Lihat folder `/docs`

---

**⭐ Jika project ini membantu, jangan lupa berikan star di GitHub!**
