@extends('layouts.peserta')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 rounded-2xl shadow-2xl overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-indigo-800/30"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-white/5 to-transparent rounded-full transform translate-x-32 -translate-y-32"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-blue-500/10 to-transparent rounded-full transform -translate-x-16 translate-y-16"></div>

        <div class="relative p-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                <div class="mb-6 lg:mb-0">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang, {{ $peserta->nama_lengkap }}!</h1>
                            <p class="text-blue-100 text-lg">Kode Pendaftaran: <span class="font-semibold bg-white bg-opacity-20 px-3 py-1 rounded-lg">{{ $peserta->kode_pendaftaran }}</span></p>
                        </div>
                    </div>
                </div>

                <!-- Status Widget -->
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                    <div class="flex items-center space-x-6">
                        <div class="text-center">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">
                                    {{ ucfirst($peserta->status_pendaftaran) }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">
                                    {{ ucfirst($peserta->status_bayar) }}
                                </span>
                            </div>
                            <div class="text-blue-200 text-sm">Terdaftar {{ $peserta->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Registration Status Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-{{ $peserta->status_pendaftaran === 'approved' ? 'green' : ($peserta->status_pendaftaran === 'pending' ? 'amber' : 'red') }}-50 to-{{ $peserta->status_pendaftaran === 'approved' ? 'emerald' : ($peserta->status_pendaftaran === 'pending' ? 'orange' : 'pink') }}-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-{{ $peserta->status_pendaftaran === 'approved' ? 'green' : ($peserta->status_pendaftaran === 'pending' ? 'amber' : 'red') }}-500 to-{{ $peserta->status_pendaftaran === 'approved' ? 'emerald' : ($peserta->status_pendaftaran === 'pending' ? 'orange' : 'pink') }}-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        @if($peserta->status_pendaftaran === 'approved')
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        @elseif($peserta->status_pendaftaran === 'pending')
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        @else
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-lg font-bold text-gray-900">Status Pendaftaran</div>
                        <div class="text-sm text-gray-500 font-medium">
                            @if($peserta->status_pendaftaran === 'approved')
                                Pendaftaran Disetujui
                            @elseif($peserta->status_pendaftaran === 'pending')
                                Menunggu Persetujuan
                            @else
                                Pendaftaran Ditolak
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-sm text-{{ $peserta->status_pendaftaran === 'approved' ? 'green' : ($peserta->status_pendaftaran === 'pending' ? 'amber' : 'red') }}-600 flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($peserta->status_pendaftaran === 'approved')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @elseif($peserta->status_pendaftaran === 'pending')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            @endif
                        </svg>
                        {{ ucfirst($peserta->status_pendaftaran) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Status Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-{{ $peserta->status_bayar === 'paid' ? 'green' : ($peserta->status_bayar === 'pending' ? 'amber' : 'red') }}-50 to-{{ $peserta->status_bayar === 'paid' ? 'emerald' : ($peserta->status_bayar === 'pending' ? 'orange' : 'pink') }}-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-{{ $peserta->status_bayar === 'paid' ? 'green' : ($peserta->status_bayar === 'pending' ? 'amber' : 'red') }}-500 to-{{ $peserta->status_bayar === 'paid' ? 'emerald' : ($peserta->status_bayar === 'pending' ? 'orange' : 'pink') }}-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-lg font-bold text-gray-900">Status Pembayaran</div>
                        <div class="text-sm text-gray-500 font-medium">
                            @if($peserta->status_bayar === 'paid')
                                Pembayaran Lunas
                            @elseif($peserta->status_bayar === 'pending')
                                Menunggu Verifikasi
                            @else
                                Belum Dibayar
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-sm text-{{ $peserta->status_bayar === 'paid' ? 'green' : ($peserta->status_bayar === 'pending' ? 'amber' : 'red') }}-600 flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($peserta->status_bayar === 'paid')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            @endif
                        </svg>
                        {{ ucfirst($peserta->status_bayar) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Cost Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-blue-600">{{ $peserta->formatted_total_biaya }}</div>
                        <div class="text-sm text-gray-500 font-medium">Total Biaya</div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-sm text-blue-600 flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        Biaya Pendaftaran
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Personal Information -->
        <div class="xl:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Informasi Pribadi
                            </h3>
                            <p class="text-gray-500 text-sm mt-1">Data personal peserta</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <!-- Photo Section -->
                    <div class="flex items-center space-x-6 mb-8">
                        <div class="w-24 h-32 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl border-2 border-dashed border-blue-200 flex items-center justify-center">
                            @if($peserta->foto_path)
                                <img src="{{ Storage::url($peserta->foto_path) }}" alt="Foto" class="w-full h-full object-cover rounded-xl">
                            @else
                                <div class="text-center">
                                    <svg class="w-10 h-10 text-blue-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span class="text-xs text-blue-500 font-medium">Foto</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="text-2xl font-bold text-gray-900 mb-2">{{ $peserta->nama_lengkap }}</h4>
                            <div class="space-y-2">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V7a2 2 0 012-2h4a2 2 0 012 2v0M8 7v10a2 2 0 002 2h4a2 2 0 002-2V7"/>
                                    </svg>
                                    {{ $peserta->tempat_tanggal_lahir }}
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $peserta->umur }} tahun
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ $peserta->ranting->nama_ranting }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="text-sm text-gray-500 mb-1">Jenis Kelamin</div>
                                <div class="font-semibold text-gray-900">{{ $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="text-sm text-gray-500 mb-1">Golongan Darah</div>
                                <div class="font-semibold text-gray-900">{{ $peserta->golongan_darah }}</div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="text-sm text-gray-500 mb-1">Berat Badan</div>
                                <div class="font-semibold text-gray-900">{{ $peserta->berat_badan }} KG</div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="text-sm text-gray-500 mb-1">No. Telepon</div>
                                <div class="font-semibold text-gray-900">{{ $peserta->no_telepon }}</div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="text-sm text-gray-500 mb-1">Kategori Usia</div>
                                <div class="font-semibold text-gray-900">{{ $peserta->kategoriUsia->nama_kategori }}</div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="text-sm text-gray-500 mb-1">Status</div>
                                <div class="flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $peserta->status_pendaftaran === 'approved' ? 'green' : ($peserta->status_pendaftaran === 'pending' ? 'yellow' : 'red') }}-100 text-{{ $peserta->status_pendaftaran === 'approved' ? 'green' : ($peserta->status_pendaftaran === 'pending' ? 'yellow' : 'red') }}-800">
                                        {{ ucfirst($peserta->status_pendaftaran) }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $peserta->status_bayar === 'paid' ? 'green' : ($peserta->status_bayar === 'pending' ? 'yellow' : 'red') }}-100 text-{{ $peserta->status_bayar === 'paid' ? 'green' : ($peserta->status_bayar === 'pending' ? 'yellow' : 'red') }}-800">
                                        {{ ucfirst($peserta->status_bayar) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- Categories & Payment -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Kategori Pertandingan
                    </h3>
                    <p class="text-gray-500 text-sm mt-1">Kategori yang diikuti</p>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @foreach($peserta->kategori_dipilih as $kategori)
                        <div class="group flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl hover:from-green-100 hover:to-emerald-100 transition-all duration-200 border border-green-100">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="font-semibold text-green-800">{{ $kategori }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z"/>
                        </svg>
                        Pembayaran
                    </h3>
                    <p class="text-gray-500 text-sm mt-1">Status dan informasi pembayaran</p>
                </div>
                <div class="p-6">
                    <!-- Payment Info -->
                    @if($latestPembayaran)
                    <div class="bg-blue-50 rounded-xl p-4 mb-6">
                        <h4 class="font-semibold text-blue-900 mb-3">Detail Pembayaran Terakhir</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-blue-700">Kode Pembayaran</span>
                                <span class="font-mono font-medium text-blue-900">{{ $latestPembayaran->kode_pembayaran }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-blue-700">Jumlah</span>
                                <span class="font-medium text-blue-900">{{ $latestPembayaran->formatted_jumlah_bayar }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-blue-700">Metode</span>
                                <span class="font-medium text-blue-900">{{ $latestPembayaran->metode_pembayaran_formatted }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Payment Actions -->
                    @if($peserta->status_bayar === 'unpaid')
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <p class="text-red-700 text-sm font-medium">
                                Silakan lakukan pembayaran untuk menyelesaikan pendaftaran
                            </p>
                        </div>
                    </div>

                    <button onclick="showPaymentModal()" class="group w-full flex items-center p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 border border-blue-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1 text-left">
                            <div class="font-semibold text-gray-900">Upload Bukti Pembayaran</div>
                            <div class="text-sm text-blue-600 font-medium">Lengkapi pembayaran sekarang</div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    @elseif($peserta->status_bayar === 'pending')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-yellow-700 text-sm font-medium">
                                Pembayaran Anda sedang diverifikasi oleh admin
                            </p>
                        </div>
                    </div>

                    @else
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-green-700 text-sm font-medium">
                                Pembayaran telah lunas. Pendaftaran Anda selesai!
                            </p>
                        </div>
                    </div>
                    @endif

                    <!-- Download Actions -->
                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <a href="{{ route('peserta.download-invoice') }}" class="group flex items-center p-3 bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl hover:from-gray-100 hover:to-slate-100 transition-all duration-200 border border-gray-100">
                            <div class="w-10 h-10 bg-gradient-to-br from-gray-500 to-slate-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="ml-3 flex-1 text-left">
                                <div class="text-sm font-semibold text-gray-900">Invoice</div>
                                <div class="text-xs text-gray-500">PDF</div>
                            </div>
                        </a>
                        <a href="{{ route('peserta.download-formulir') }}" class="group flex items-center p-3 bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl hover:from-gray-100 hover:to-slate-100 transition-all duration-200 border border-gray-100">
                            <div class="w-10 h-10 bg-gradient-to-br from-gray-500 to-slate-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="ml-3 flex-1 text-left">
                                <div class="text-sm font-semibold text-gray-900">Formulir</div>
                                <div class="text-xs text-gray-500">PDF</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Info Footer -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="text-sm font-semibold text-gray-900">Status Aktif</div>
                <div class="text-xs text-green-600 font-medium">Online</div>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="text-sm font-semibold text-gray-900">Terakhir Update</div>
                <div class="text-xs text-gray-500">{{ $peserta->updated_at->format('d M Y, H:i') }}</div>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div class="text-sm font-semibold text-gray-900">INKAI Kediri</div>
                <div class="text-xs text-gray-500">Portal Peserta</div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Upload Modal -->
<div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-2xl rounded-2xl bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Upload Bukti Pembayaran</h3>
                    <p class="text-gray-500 text-sm mt-1">Lengkapi pembayaran untuk menyelesaikan pendaftaran</p>
                </div>
                <button onclick="closePaymentModal()" class="text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('peserta.upload-bukti') }}" enctype="multipart/form-data" id="paymentForm">
                @csrf

                <!-- Payment Amount -->
                <div class="mb-6 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-blue-800 font-medium">Total yang harus dibayar:</span>
                        </div>
                        <span class="text-2xl font-bold text-blue-600">{{ $peserta->formatted_total_biaya }}</span>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Metode Pembayaran <span class="text-red-500">*</span></label>
                    <select name="metode_pembayaran" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="qris">QRIS</option>
                        <option value="cash">Bayar Tunai</option>
                    </select>
                </div>

                <!-- Payment Date -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Pembayaran <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_bayar" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ date('Y-m-d') }}" required>
                </div>

                <!-- File Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Bukti Pembayaran <span class="text-red-500">*</span></label>
                    <div class="mt-2 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-xl hover:border-blue-400 transition-colors bg-gray-50">
                        <div class="space-y-2 text-center">
                            <svg class="mx-auto h-16 w-16 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="text-gray-600">
                                <label for="bukti_bayar" class="relative cursor-pointer bg-white rounded-lg font-medium text-blue-600 hover:text-blue-500 px-4 py-2 border border-blue-300 hover:border-blue-400">
                                    <span>Pilih file</span>
                                    <input id="bukti_bayar" name="bukti_bayar" type="file" accept="image/*,application/pdf" class="sr-only" required>
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-sm text-gray-500">PNG, JPG, PDF hingga 5MB</p>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Keterangan (opsional)</label>
                    <textarea name="keterangan" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>

                <!-- Bank Info -->
                <div class="mb-6 p-6 bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-xl">
                    <h4 class="font-bold text-yellow-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Informasi Rekening
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white rounded-lg p-4 border border-yellow-300">
                            <div class="font-semibold text-yellow-900">BCA</div>
                            <div class="text-sm text-yellow-800 font-mono">1234567890</div>
                            <div class="text-xs text-yellow-700">a.n. INKAI Kediri</div>
                        </div>
                        <div class="bg-white rounded-lg p-4 border border-yellow-300">
                            <div class="font-semibold text-yellow-900">Mandiri</div>
                            <div class="text-sm text-yellow-800 font-mono">0987654321</div>
                            <div class="text-xs text-yellow-700">a.n. INKAI Kediri</div>
                        </div>
                        <div class="bg-white rounded-lg p-4 border border-yellow-300 md:col-span-2">
                            <div class="font-semibold text-yellow-900">QRIS</div>
                            <div class="text-sm text-yellow-800">Scan QR Code yang tersedia</div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex space-x-4">
                    <button type="button" onclick="closePaymentModal()" class="flex-1 px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Upload Bukti Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .animate-slide-up {
        animation: slideUp 0.6s ease-out forwards;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .animate-scale-in {
        animation: scaleIn 0.5s ease-out forwards;
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Loading animation */
    .loading-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    /* Hover effects */
    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #F3F4F6;
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb {
        background: #D1D5DB;
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #9CA3AF;
    }

    /* Enhanced hover effects */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    .group:hover .group-hover\:text-gray-600 {
        color: #4B5563;
    }

    /* Responsive design improvements */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .stats-card {
            padding: 1rem;
        }

        .stats-value {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 640px) {
        .header-content {
            text-align: center;
        }

        .status-widget {
            margin-top: 1rem;
            justify-self: center;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function showPaymentModal() {
        document.getElementById('paymentModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Add entrance animation
        const modal = document.getElementById('paymentModal');
        modal.style.opacity = '0';
        setTimeout(() => {
            modal.style.opacity = '1';
            modal.style.transition = 'opacity 0.3s ease-in-out';
        }, 10);
    }

    function closePaymentModal() {
        const modal = document.getElementById('paymentModal');
        modal.style.opacity = '0';
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 300);
    }

    // Enhanced Payment form submission with SweetAlert
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Check if SweetAlert is available
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Konfirmasi Upload',
                text: 'Apakah Anda yakin data pembayaran sudah benar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3B82F6',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Upload!',
                cancelButtonText: 'Periksa Lagi',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-lg',
                    cancelButton: 'rounded-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    this.submit();
                }
            });
        } else {
            // Fallback without SweetAlert
            if (confirm('Apakah Anda yakin data pembayaran sudah benar?')) {
                showLoading();
                this.submit();
            }
        }
    });

    // Enhanced file upload preview
    document.getElementById('bukti_bayar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                showToast('Ukuran file maksimal 5MB!', 'error');
                this.value = '';
                return;
            }

            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
            if (!allowedTypes.includes(file.type)) {
                showToast('Format file harus JPG, PNG, atau PDF!', 'error');
                this.value = '';
                return;
            }

            showToast('File berhasil dipilih: ' + file.name, 'success');

            // Update UI to show selected file
            const uploadArea = this.closest('.border-dashed');
            uploadArea.classList.add('border-green-400', 'bg-green-50');
            uploadArea.classList.remove('border-gray-300', 'bg-gray-50');
        }
    });

    // Enhanced modal interactions
    document.getElementById('paymentModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePaymentModal();
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePaymentModal();
        }

        // Quick actions with keyboard
        if (e.ctrlKey || e.metaKey) {
            switch(e.key) {
                case 'e':
                    e.preventDefault();
                    window.location.href = "{{ route('peserta.profile.edit') }}";
                    break;
                case 'r':
                    e.preventDefault();
                    location.reload();
                    break;
            }
        }
    });

    // Enhanced toast notification function
    window.showToast = function(message, type = 'info') {
        const toastContainer = document.getElementById('toast-container') || createToastContainer();

        const toast = document.createElement('div');
        toast.className = `toast-item ${type} transform translate-x-full transition-transform duration-300`;

        const icons = {
            success: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                      </svg>`,
            error: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                   </svg>`,
            info: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>`
        };

        toast.innerHTML = `
            <div class="flex items-center space-x-3 p-4 rounded-xl shadow-lg border backdrop-blur-sm
                        ${type === 'success' ? 'bg-green-50 text-green-800 border-green-200' :
                          type === 'error' ? 'bg-red-50 text-red-800 border-red-200' :
                          'bg-blue-50 text-blue-800 border-blue-200'}">
                <div class="flex-shrink-0">
                    ${icons[type]}
                </div>
                <div class="flex-1 font-medium">${message}</div>
                <button onclick="this.closest('.toast-item').remove()" class="flex-shrink-0 opacity-70 hover:opacity-100 p-1 rounded-lg hover:bg-white hover:bg-opacity-20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;

        toastContainer.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        // Auto remove
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    };

    function createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'fixed top-4 right-4 z-50 space-y-2';
        document.body.appendChild(container);
        return container;
    }

    // Show loading overlay
    window.showLoading = function() {
        const overlay = document.createElement('div');
        overlay.id = 'loading-overlay';
        overlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        overlay.innerHTML = `
            <div class="bg-white rounded-2xl p-8 shadow-2xl flex items-center space-x-4">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                <span class="text-gray-700 font-medium">Memproses...</span>
            </div>
        `;
        document.body.appendChild(overlay);
    };

    // Initialize animations on load
    document.addEventListener('DOMContentLoaded', function() {
        try {
            // Stagger animation for cards
            const cards = document.querySelectorAll('.group');
            cards.forEach((card, index) => {
                if (card) {
                    card.style.animationDelay = `${index * 0.1}s`;
                    card.classList.add('animate-fade-in');
                }
            });

            // Initialize intersection observer for scroll animations
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate-slide-up');
                        }
                    });
                }, { threshold: 0.1 });

                document.querySelectorAll('.hover-lift').forEach(el => {
                    if (el) observer.observe(el);
                });
            }

            // Add smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

        } catch (error) {
            console.warn('Animation initialization warning:', error);
        }
    });

    // Network status monitoring
    window.addEventListener('online', () => {
        showToast('Koneksi internet tersambung kembali', 'success');
    });

    window.addEventListener('offline', () => {
        showToast('Koneksi internet terputus', 'error');
    });

    // Print functionality
    window.printProfile = function() {
        const printStyles = `
            <style>
                @media print {
                    .no-print { display: none !important; }
                    .print-full-width { width: 100% !important; }
                    body {
                        font-size: 12px;
                        color: black !important;
                        background: white !important;
                    }
                    .bg-gradient-to-br,
                    .bg-gradient-to-r {
                        background: white !important;
                        border: 1px solid #ccc !important;
                    }
                }
            </style>
        `;

        const content = document.querySelector('.space-y-8').innerHTML;
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Profil Peserta - {{ $peserta->nama_lengkap }}</title>
                <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                ${printStyles}
            </head>
            <body class="p-4">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-8">
                        <h1 class="text-2xl font-bold">Profil Peserta INKAI Kediri</h1>
                        <p class="text-gray-600">{{ $peserta->nama_lengkap }} - {{ $peserta->kode_pendaftaran }}</p>
                        <p class="text-gray-500 text-sm">Dicetak pada ${new Date().toLocaleDateString('id-ID')}</p>
                    </div>
                    ${content}
                </div>
                <script>
                    window.onload = function() {
                        setTimeout(() => {
                            window.print();
                            window.close();
                        }, 1000);
                    }
                </script>
            </body>
            </html>
        `);
    };
</script>
@endpush
