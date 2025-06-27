<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PesertaController as AdminPesertaController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MasterDataController;
use App\Http\Controllers\Admin\ClusteringController;
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\Peserta\ProfileController as PesertaProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Pendaftaran Routes (Public)
Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
    Route::get('/step1', [PendaftaranController::class, 'step1'])->name('step1');
    Route::post('/step1', [PendaftaranController::class, 'postStep1'])->name('step1.post');

    Route::get('/step2', [PendaftaranController::class, 'step2'])->name('step2');
    Route::post('/step2', [PendaftaranController::class, 'postStep2'])->name('step2.post');

    Route::get('/step3', [PendaftaranController::class, 'step3'])->name('step3');
    Route::post('/step3', [PendaftaranController::class, 'postStep3'])->name('step3.post');

    Route::get('/step4', [PendaftaranController::class, 'step4'])->name('step4');
    Route::post('/submit', [PendaftaranController::class, 'submit'])->name('submit');

    Route::post('/calculate-biaya', [PendaftaranController::class, 'calculateBiaya'])->name('calculate-biaya');
});

// Pembayaran Routes (Public)
Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
    Route::get('/info', [PembayaranController::class, 'info'])->name('info');
    Route::post('/check-status', [PembayaranController::class, 'checkStatus'])->name('check-status');
    Route::post('/webhook', [PembayaranController::class, 'webhook'])->name('webhook');
});

// Authentication Routes (dari Breeze)
require __DIR__.'/auth.php';

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/chart-data', [AdminDashboardController::class, 'getChartData'])->name('chart-data');

    // Peserta Management
    Route::prefix('peserta')->name('peserta.')->group(function () {
        Route::get('/', [AdminPesertaController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminPesertaController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminPesertaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminPesertaController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminPesertaController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/approve', [AdminPesertaController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [AdminPesertaController::class, 'reject'])->name('reject');
        Route::post('/bulk-action', [AdminPesertaController::class, 'bulkAction'])->name('bulk-action');
    });

    // Verifikasi Pembayaran
    Route::prefix('verifikasi')->name('verifikasi.')->group(function () {
        Route::get('/', [VerifikasiController::class, 'index'])->name('index');
        Route::get('/{id}', [VerifikasiController::class, 'show'])->name('show');
        Route::post('/{id}/approve', [VerifikasiController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [VerifikasiController::class, 'reject'])->name('reject');
        Route::post('/bulk-approve', [VerifikasiController::class, 'bulkApprove'])->name('bulk-approve');
        Route::get('/statistics', [VerifikasiController::class, 'statistics'])->name('statistics');
    });

    // Laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/peserta', [LaporanController::class, 'peserta'])->name('peserta');
        Route::get('/pembayaran', [LaporanController::class, 'pembayaran'])->name('pembayaran');
        Route::get('/keuangan', [LaporanController::class, 'keuangan'])->name('keuangan');
        Route::get('/statistik', [LaporanController::class, 'statistik'])->name('statistik');
    });

    // Master Data
    Route::prefix('master')->name('master.')->group(function () {
        // Kategori Usia
        Route::get('/kategori-usia', [MasterDataController::class, 'indexKategoriUsia'])->name('kategori-usia.index');
        Route::get('/kategori-usia/create', [MasterDataController::class, 'createKategoriUsia'])->name('kategori-usia.create');
        Route::post('/kategori-usia', [MasterDataController::class, 'storeKategoriUsia'])->name('kategori-usia.store');
        Route::get('/kategori-usia/{id}', [MasterDataController::class, 'showKategoriUsia'])->name('kategori-usia.show');
        Route::get('/kategori-usia/{id}/edit', [MasterDataController::class, 'editKategoriUsia'])->name('kategori-usia.edit');
        Route::put('/kategori-usia/{id}', [MasterDataController::class, 'updateKategoriUsia'])->name('kategori-usia.update');
        Route::delete('/kategori-usia/{id}', [MasterDataController::class, 'destroyKategoriUsia'])->name('kategori-usia.destroy');

        // Ranting
        Route::get('/ranting', [MasterDataController::class, 'indexRanting'])->name('ranting.index');
        Route::get('/ranting/create', [MasterDataController::class, 'createRanting'])->name('ranting.create');
        Route::post('/ranting', [MasterDataController::class, 'storeRanting'])->name('ranting.store');
        Route::get('/ranting/{id}', [MasterDataController::class, 'showRanting'])->name('ranting.show');
        Route::get('/ranting/{id}/edit', [MasterDataController::class, 'editRanting'])->name('ranting.edit');
        Route::put('/ranting/{id}', [MasterDataController::class, 'updateRanting'])->name('ranting.update');
        Route::delete('/ranting/{id}', [MasterDataController::class, 'destroyRanting'])->name('ranting.destroy');

        // Biaya Kategori
        Route::get('/biaya-kategori', [MasterDataController::class, 'indexBiayaKategori'])->name('biaya-kategori.index');
        Route::get('/biaya-kategori/create', [MasterDataController::class, 'createBiayaKategori'])->name('biaya-kategori.create');
        Route::post('/biaya-kategori', [MasterDataController::class, 'storeBiayaKategori'])->name('biaya-kategori.store');
        Route::get('/biaya-kategori/{id}', [MasterDataController::class, 'showBiayaKategori'])->name('biaya-kategori.show');
        Route::get('/biaya-kategori/{id}/edit', [MasterDataController::class, 'editBiayaKategori'])->name('biaya-kategori.edit');
        Route::put('/biaya-kategori/{id}', [MasterDataController::class, 'updateBiayaKategori'])->name('biaya-kategori.update');
        Route::delete('/biaya-kategori/{id}', [MasterDataController::class, 'destroyBiayaKategori'])->name('biaya-kategori.destroy');

        // Settings
        Route::get('/settings', [MasterDataController::class, 'settings'])->name('settings');
        Route::post('/settings', [MasterDataController::class, 'updateSettings'])->name('settings.update');
    });

    // Export Routes
    Route::prefix('export')->name('export.')->group(function () {
        Route::get('/peserta-excel', [ExportController::class, 'pesertaExcel'])->name('peserta.excel');
        Route::get('/peserta-pdf', [ExportController::class, 'pesertaPdf'])->name('peserta.pdf');
        Route::get('/pembayaran-excel', [ExportController::class, 'pembayaranExcel'])->name('pembayaran.excel');
        Route::get('/laporan-keuangan', [ExportController::class, 'laporanKeuangan'])->name('laporan-keuangan');
        Route::get('/daftar-hadir', [ExportController::class, 'daftarHadir'])->name('daftar.hadir');
        Route::get('/sertifikat/{id}', [ExportController::class, 'sertifikatPeserta'])->name('sertifikat');
        Route::get('/pembayaran-detail/{id}', [ExportController::class, 'pembayaranDetail'])->name('pembayaran.detail');
    });

    // Clustering Routes
    Route::get('/clustering', [ClusteringController::class, 'index'])->name('clustering');
    Route::get('/clustering/data', [ClusteringController::class, 'getClusteringData'])->name('clustering.data');
    Route::get('/clustering/export', [ClusteringController::class, 'export'])->name('clustering.export');
});

// Peserta Routes
Route::middleware(['auth', 'role:peserta'])->prefix('peserta')->name('peserta.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [PesertaDashboardController::class, 'index'])->name('dashboard');

    // Upload Bukti Pembayaran
    Route::post('/upload-bukti', [PesertaDashboardController::class, 'uploadBuktiPembayaran'])->name('upload-bukti');

    // Downloads
    Route::get('/download-invoice', [PesertaDashboardController::class, 'downloadInvoice'])->name('download-invoice');
    Route::get('/download-formulir', [PesertaDashboardController::class, 'downloadFormulir'])->name('download-formulir');

    // Profile Management
    Route::get('/profile', [PesertaProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [PesertaProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/upload-foto', [PesertaProfileController::class, 'uploadFoto'])->name('profile.upload-foto');
    Route::put('/profile/password', [PesertaProfileController::class, 'changePassword'])->name('profile.update-password');
    Route::put('/profile/email', [PesertaProfileController::class, 'updateEmail'])->name('profile.update-email');
    Route::delete('/profile/delete-account', [PesertaProfileController::class, 'deleteAccount'])->name('profile.delete-account');
    Route::get('/profile/download-data', [PesertaProfileController::class, 'downloadData'])->name('profile.download-data');

    // Notifications
    Route::post('/notifications/{id}/read', [PesertaDashboardController::class, 'markNotificationAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [PesertaDashboardController::class, 'markAllNotificationsAsRead'])->name('notifications.read-all');

    // Payment Info API
    Route::get('/payment-info', [PesertaDashboardController::class, 'getPaymentInfo'])->name('payment-info');

    // Payment Status Check
    Route::get('/payment-status', [PesertaDashboardController::class, 'checkPaymentStatus'])->name('payment-status');
});

// Redirect Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('peserta.dashboard');
    })->name('dashboard');

    Route::get('/home', function () {
        return redirect()->route('dashboard');
    });
});
