@extends('layouts.peserta')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
                @if($peserta->foto_path)
                    <img src="{{ Storage::url($peserta->foto_path) }}"
                         alt="Foto {{ $peserta->nama_lengkap }}"
                         class="w-20 h-20 rounded-full object-cover border-4 border-white/30">
                @else
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-bold mb-1">{{ $peserta->nama_lengkap }}</h1>
                <p class="text-blue-100 mb-2">{{ $peserta->kode_pendaftaran }}</p>
                <div class="flex items-center space-x-4 text-sm">
                    <span class="badge-white">{{ $peserta->ranting->nama_ranting }}</span>
                    <span class="badge-white">{{ $peserta->kategoriUsia->nama_kategori }}</span>
                    <span class="badge-white">{{ $peserta->umur }} tahun</span>
                </div>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ route('peserta.profile.edit') }}" class="peserta-btn-white">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Profil
                </a>
            </div>
        </div>
    </div>

    <!-- Status Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Registration Status -->
        <div class="peserta-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 {{ $peserta->status_pendaftaran === 'approved' ? 'bg-green-100' : ($peserta->status_pendaftaran === 'pending' ? 'bg-yellow-100' : 'bg-red-100') }} rounded-lg flex items-center justify-center">
                        @if($peserta->status_pendaftaran === 'approved')
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        @elseif($peserta->status_pendaftaran === 'pending')
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        @endif
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-500">Status Pendaftaran</div>
                    <div class="text-lg font-semibold {{ $peserta->status_pendaftaran === 'approved' ? 'text-green-600' : ($peserta->status_pendaftaran === 'pending' ? 'text-yellow-600' : 'text-red-600') }}">
                        {{ ucfirst($peserta->status_pendaftaran) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="peserta-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 {{ $peserta->status_bayar === 'paid' ? 'bg-green-100' : ($peserta->status_bayar === 'pending' ? 'bg-yellow-100' : 'bg-red-100') }} rounded-lg flex items-center justify-center">
                        @if($peserta->status_bayar === 'paid')
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.5-2A7.5 7.5 0 1016.5 3.5 7.5 7.5 0 0021 12zm-2.5 5.5L16 15l-2.5 2.5"/>
                            </svg>
                        @elseif($peserta->status_bayar === 'pending')
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        @endif
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-500">Status Pembayaran</div>
                    <div class="text-lg font-semibold {{ $peserta->status_bayar === 'paid' ? 'text-green-600' : ($peserta->status_bayar === 'pending' ? 'text-yellow-600' : 'text-red-600') }}">
                        {{ ucfirst($peserta->status_bayar) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Fee -->
        <div class="peserta-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-500">Total Biaya</div>
                    <div class="text-lg font-bold text-blue-600">{{ $peserta->formatted_total_biaya }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information -->
            <div class="peserta-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Pribadi</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="info-item">
                            <label class="info-label">Nama Lengkap</label>
                            <p class="info-value">{{ $peserta->nama_lengkap }}</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Kode Pendaftaran</label>
                            <p class="info-value text-blue-600 font-mono">{{ $peserta->kode_pendaftaran }}</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Tempat, Tanggal Lahir</label>
                            <p class="info-value">{{ $peserta->tempat_tanggal_lahir }}</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Umur</label>
                            <p class="info-value">{{ $peserta->umur }} tahun</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Jenis Kelamin</label>
                            <p class="info-value">{{ $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Golongan Darah</label>
                            <p class="info-value">{{ $peserta->golongan_darah }}</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Berat Badan</label>
                            <p class="info-value">{{ $peserta->berat_badan }} KG</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">No. Telepon</label>
                            <p class="info-value">{{ $peserta->no_telepon }}</p>
                        </div>
                        <div class="info-item md:col-span-2">
                            <label class="info-label">Alamat</label>
                            <p class="info-value">{{ $peserta->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Organization Information -->
            <div class="peserta-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Organisasi</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="info-item">
                            <label class="info-label">Ranting/Afiliasi</label>
                            <p class="info-value font-semibold">{{ $peserta->ranting->nama_ranting }}</p>
                            <p class="text-sm text-gray-500">{{ $peserta->ranting->kota }}, {{ $peserta->ranting->provinsi }}</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Kategori Usia</label>
                            <p class="info-value font-semibold">{{ $peserta->kategoriUsia->nama_kategori }}</p>
                            <p class="text-sm text-gray-500">{{ $peserta->kategoriUsia->rentang_usia }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Competition Categories -->
            <div class="peserta-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Kategori Pertandingan</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($peserta->kategori_dipilih as $kategori)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-medium text-green-800">{{ $kategori }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total Biaya Pendaftaran:</span>
                            <span class="text-2xl font-bold text-blue-600">{{ $peserta->formatted_total_biaya }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="peserta-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Akun</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="info-item">
                            <label class="info-label">Email</label>
                            <p class="info-value">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Role</label>
                            <p class="info-value">{{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Tanggal Daftar</label>
                            <p class="info-value">{{ $peserta->created_at->format('d F Y, H:i') }} WIB</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Terakhir Diperbarui</label>
                            <p class="info-value">{{ $peserta->updated_at->format('d F Y, H:i') }} WIB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Profile Photo -->
            <div class="peserta-card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Foto Profil</h3>
                <div class="text-center">
                    @if($peserta->foto_path)
                        <img src="{{ Storage::url($peserta->foto_path) }}"
                             alt="Foto {{ $peserta->nama_lengkap }}"
                             class="w-40 h-48 object-cover rounded-lg border-2 border-gray-200 mx-auto mb-4">
                    @else
                        <div class="w-40 h-48 bg-gray-200 rounded-lg border-2 border-gray-300 flex items-center justify-center mx-auto mb-4">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="text-sm text-gray-500">Belum ada foto</span>
                            </div>
                        </div>
                    @endif
                    <a href="{{ route('peserta.profile.edit') }}" class="peserta-btn-secondary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        {{ $peserta->foto_path ? 'Ganti Foto' : 'Upload Foto' }}
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="peserta-card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('peserta.profile.edit') }}"
                       class="w-full peserta-btn-primary text-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Profil
                    </a>

                    <a href="{{ route('peserta.dashboard.download-formulir') }}"
                       class="w-full peserta-btn-secondary text-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Formulir
                    </a>

                    <a href="{{ route('peserta.dashboard.download-invoice') }}"
                       class="w-full peserta-btn-secondary text-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                        Download Invoice
                    </a>
                </div>
            </div>

            <!-- Payment History -->
            @if($peserta->pembayaran->count() > 0)
            <div class="peserta-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Riwayat Pembayaran</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($peserta->pembayaran->take(3) as $pembayaran)
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-medium text-gray-900">{{ $pembayaran->kode_pembayaran }}</span>
                            <span class="badge badge-{{ $pembayaran->status_bayar === 'paid' ? 'success' : ($pembayaran->status_bayar === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($pembayaran->status_bayar) }}
                            </span>
                        </div>
                        <div class="space-y-1 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Jumlah:</span>
                                <span class="font-medium text-gray-900">{{ $pembayaran->formatted_jumlah_bayar }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Metode:</span>
                                <span>{{ $pembayaran->metode_pembayaran_formatted }}</span>
                            </div>
                            @if($pembayaran->tanggal_bayar)
                            <div class="flex justify-between">
                                <span>Tanggal:</span>
                                <span>{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @if($peserta->pembayaran->count() > 3)
                    <div class="px-6 py-3 bg-gray-50">
                        <a href="{{ route('peserta.dashboard') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                            Lihat semua riwayat pembayaran →
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Data Export -->
            <div class="peserta-card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pribadi</h3>
                <div class="space-y-3">
                    <a href="{{ route('peserta.profile.download-data') }}"
                       class="w-full peserta-btn-secondary text-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Data Saya
                    </a>

                    <p class="text-xs text-gray-500 text-center">
                        File JSON berisi semua informasi pribadi dan riwayat pendaftaran Anda
                    </p>
                </div>
            </div>

            <!-- Help & Support -->
            <div class="peserta-card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Bantuan & Dukungan</h3>
                <div class="space-y-4">
                    <div class="text-sm text-gray-600">
                        <p class="mb-2">Butuh bantuan? Hubungi kami:</p>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span>{{ Setting::get('office_phone', '0354-123456') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ Setting::get('office_email', 'info@inkai-kediri.org') }}</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-4 h-4 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-xs leading-relaxed">{{ Setting::get('office_address', 'Jl. Brawijaya No. 123, Kediri') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-gray-200">
                        <p class="text-xs text-gray-500">
                            Jam Operasional:<br>
                            {{ Setting::get('office_hours', 'Senin-Jumat: 08:00-16:00, Sabtu: 08:00-12:00') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Timeline -->
    <div class="peserta-card">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Timeline Aktivitas</h3>
        </div>
        <div class="p-6">
            <div class="flow-root">
                <ul class="-mb-8">
                    <!-- Registration -->
                    <li>
                        <div class="relative pb-8">
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Pendaftaran berhasil dibuat</p>
                                        <p class="text-xs text-gray-400">{{ $peserta->created_at->format('d F Y, H:i') }} WIB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Approval Status -->
                    @if($peserta->status_pendaftaran !== 'pending')
                    <li>
                        <div class="relative pb-8">
                            @if($peserta->pembayaran->count() > 0)
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            @endif
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full {{ $peserta->status_pendaftaran === 'approved' ? 'bg-green-500' : 'bg-red-500' }} flex items-center justify-center ring-8 ring-white">
                                        @if($peserta->status_pendaftaran === 'approved')
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        @endif
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-500">
                                            Pendaftaran {{ $peserta->status_pendaftaran === 'approved' ? 'disetujui' : 'ditolak' }}
                                        </p>
                                        <p class="text-xs text-gray-400">{{ $peserta->updated_at->format('d F Y, H:i') }} WIB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif

                    <!-- Payment Activities -->
                    @foreach($peserta->pembayaran as $index => $pembayaran)
                    <li>
                        <div class="relative {{ $index < $peserta->pembayaran->count() - 1 ? 'pb-8' : '' }}">
                            @if($index < $peserta->pembayaran->count() - 1)
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            @endif
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full {{ $pembayaran->status_bayar === 'paid' ? 'bg-green-500' : ($pembayaran->status_bayar === 'pending' ? 'bg-yellow-500' : 'bg-red-500') }} flex items-center justify-center ring-8 ring-white">
                                        @if($pembayaran->status_bayar === 'paid')
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @elseif($pembayaran->status_bayar === 'pending')
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        @endif
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-500">
                                            @if($pembayaran->status_bayar === 'paid')
                                                Pembayaran berhasil diverifikasi
                                            @elseif($pembayaran->status_bayar === 'pending')
                                                Bukti pembayaran diupload - menunggu verifikasi
                                            @else
                                                Pembayaran ditolak
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $pembayaran->formatted_jumlah_bayar }} via {{ $pembayaran->metode_pembayaran_formatted }}</p>
                                        <p class="text-xs text-gray-400">
                                            @if($pembayaran->verified_at)
                                                {{ $pembayaran->verified_at->format('d F Y, H:i') }} WIB
                                            @else
                                                {{ $pembayaran->created_at->format('d F Y, H:i') }} WIB
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-refresh status every 30 seconds
    setInterval(function() {
        // Check for status updates
        fetch('{{ route("peserta.profile.status-check") }}')
            .then(response => response.json())
            .then(data => {
                if (data.status_changed) {
                    // Show notification and reload page
                    showToast('Status pendaftaran telah diperbarui', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            })
            .catch(error => {
                console.log('Status check failed:', error);
            });
    }, 30000);

    // Toast notification function
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;

        const colors = {
            success: 'bg-green-500 text-white',
            error: 'bg-red-500 text-white',
            warning: 'bg-yellow-500 text-white',
            info: 'bg-blue-500 text-white'
        };

        toast.className += ` ${colors[type] || colors.info}`;
        toast.innerHTML = `
            <div class="flex items-center space-x-2">
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.remove();
                }
            }, 300);
        }, 5000);
    }
</script>
@endpush

<style>
/* Additional CSS for peserta profile */
.peserta-card {
    @apply bg-white rounded-xl shadow-sm border border-gray-200;
}

.peserta-btn-primary {
    @apply inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200;
}

.peserta-btn-secondary {
    @apply inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200;
}

.peserta-btn-white {
    @apply inline-flex items-center px-4 py-2 bg-white/90 border border-white/30 rounded-lg font-medium text-sm text-gray-700 hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200;
}

.badge-white {
    @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-white;
}

.badge {
    @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
}

.badge-success {
    @apply bg-green-100 text-green-800;
}

.badge-warning {
    @apply bg-yellow-100 text-yellow-800;
}

.badge-danger {
    @apply bg-red-100 text-red-800;
}

.info-item {
    @apply space-y-1;
}

.info-label {
    @apply text-sm font-medium text-gray-500;
}

.info-value {
    @apply text-gray-900 font-medium;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .grid-cols-1.md\\:grid-cols-2 {
        grid-template-columns: 1fr;
    }

    .grid-cols-1.md\\:grid-cols-3 {
        grid-template-columns: 1fr;
    }

    .lg\\:col-span-2 {
        grid-column: span 1;
    }
}

/* Timeline improvements */
.flow-root ul li:last-child .absolute {
    display: none;
}
</style>
