@extends('layouts.admin')

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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang, {{ auth()->user()->name }}!</h1>
                            <p class="text-blue-100 text-lg">Kelola sistem pendaftaran karate INKAI Kediri dengan mudah</p>
                        </div>
                    </div>
                </div>

                <!-- Date Time Widget -->
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                    <div class="flex items-center space-x-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white" id="currentDate">{{ now()->format('d') }}</div>
                            <div class="text-blue-200 text-sm font-medium">{{ now()->format('M Y') }}</div>
                        </div>
                        <div class="w-px h-16 bg-white/20"></div>
                        <div class="text-center">
                            <div class="text-lg font-semibold text-white" id="currentDay">{{ now()->format('l') }}</div>
                            <div class="text-blue-200 text-sm" id="currentTime">{{ now()->format('H:i') }} WIB</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <!-- Total Peserta Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-gray-900" data-stat="total_peserta">{{ $stats['total_peserta'] }}</div>
                        <div class="text-sm text-gray-500 font-medium">Total Peserta</div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-sm text-green-600 flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        +12% dari bulan lalu
                    </div>
                    <a href="{{ route('admin.peserta.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold hover:underline">
                        Lihat Detail →
                    </a>
                </div>
            </div>
        </div>

        <!-- Pending Approval Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-50 to-orange-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-gray-900" data-stat="peserta_pending">{{ $stats['peserta_pending'] }}</div>
                        <div class="text-sm text-gray-500 font-medium">Menunggu Persetujuan</div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    @if($stats['peserta_pending'] > 0)
                        <div class="text-sm text-amber-600 flex items-center font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            Perlu perhatian
                        </div>
                    @else
                        <div class="text-sm text-green-600 flex items-center font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Semua sudah disetujui
                        </div>
                    @endif
                    <a href="{{ route('admin.peserta.index', ['status_pendaftaran' => 'pending']) }}" class="text-amber-600 hover:text-amber-800 text-sm font-semibold hover:underline">
                        Review Sekarang →
                    </a>
                </div>
            </div>
        </div>

        <!-- Pending Payment Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-red-50 to-pink-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-gray-900" data-stat="pembayaran_pending">{{ $stats['pembayaran_pending'] }}</div>
                        <div class="text-sm text-gray-500 font-medium">Verifikasi Pembayaran</div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    @if($stats['pembayaran_pending'] > 0)
                        <div class="text-sm text-red-600 flex items-center font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            Butuh verifikasi
                        </div>
                    @else
                        <div class="text-sm text-green-600 flex items-center font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Semua terverifikasi
                        </div>
                    @endif
                    <a href="{{ route('admin.verifikasi.index') }}" class="text-red-600 hover:text-red-800 text-sm font-semibold hover:underline">
                        Verifikasi Sekarang →
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Revenue Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-green-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
                        <div class="text-sm text-gray-500 font-medium">Total Revenue</div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-sm text-green-600 flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        +8% dari target
                    </div>
                    <a href="{{ route('admin.laporan.keuangan') }}" class="text-emerald-600 hover:text-emerald-800 text-sm font-semibold hover:underline">
                        Lihat Laporan →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Monthly Registration Chart -->
        <div class="xl:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Statistik Pendaftaran</h3>
                        <p class="text-gray-500 text-sm mt-1">Tren pendaftaran per bulan tahun ini</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <span class="text-sm text-gray-600 font-medium">Pendaftaran</span>
                        </div>
                        <button onclick="refreshChart('monthly')" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="h-80">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Payment Status Chart -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Status Pembayaran</h3>
                        <p class="text-gray-500 text-sm mt-1">Distribusi status pembayaran</p>
                    </div>
                    <button onclick="refreshPaymentChart()" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div class="h-80">
                    <canvas id="paymentChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities & Quick Actions -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Recent Activities -->
        <div class="xl:col-span-2 space-y-6">
            <!-- Recent Registrations -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Pendaftaran Terbaru</h3>
                            <p class="text-gray-500 text-sm mt-1">5 pendaftaran terakhir</p>
                        </div>
                        <a href="{{ route('admin.peserta.index') }}" class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg text-sm font-semibold hover:bg-blue-100 transition-colors">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($recentPeserta as $peserta)
                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center">
                                <span class="text-lg font-bold text-blue-600">
                                    {{ substr(strtoupper($peserta->nama_lengkap), 0, 1) }}
                                </span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-base font-semibold text-gray-900 truncate">
                                    {{ $peserta->nama_lengkap }}
                                </p>
                                <p class="text-sm text-gray-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $peserta->ranting->nama_ranting }}
                                </p>
                            </div>
                            <div class="flex flex-col items-end space-y-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    {{ $peserta->status_pendaftaran === 'pending' ? 'bg-amber-100 text-amber-800' :
                                       ($peserta->status_pendaftaran === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($peserta->status_pendaftaran) }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $peserta->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada pendaftaran terbaru</p>
                        <p class="text-gray-400 text-sm mt-1">Pendaftaran baru akan muncul di sini</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Pending Payments -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Pembayaran Menunggu Verifikasi</h3>
                            <p class="text-gray-500 text-sm mt-1">Pembayaran yang butuh perhatian</p>
                        </div>
                        <a href="{{ route('admin.verifikasi.index') }}" class="px-4 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-semibold hover:bg-red-100 transition-colors">
                            Verifikasi Semua
                        </a>
                    </div>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($pendingPayments as $payment)
                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-red-100 to-pink-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-base font-semibold text-gray-900 truncate">
                                    {{ $payment->peserta->nama_lengkap }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $payment->formatted_jumlah_bayar }} - {{ $payment->metode_pembayaran_formatted }}
                                </p>
                            </div>
                            <div class="flex flex-col items-end space-y-2">
                                <a href="{{ route('admin.verifikasi.show', $payment->id) }}"
                                   class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition-colors duration-200">
                                    Verifikasi
                                </a>
                                <span class="text-xs text-gray-500">
                                    {{ $payment->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Semua pembayaran sudah diverifikasi</p>
                        <p class="text-gray-400 text-sm mt-1">Pembayaran baru akan muncul di sini</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions & Top Ranting -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900">Quick Actions</h3>
                    <p class="text-gray-500 text-sm mt-1">Aksi cepat untuk manajemen</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-4">
                        <a href="{{ route('admin.peserta.index', ['status_pendaftaran' => 'pending']) }}"
                           class="group flex items-center p-4 bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl hover:from-amber-100 hover:to-orange-100 transition-all duration-200 border border-amber-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="font-semibold text-gray-900">Review Pendaftaran</div>
                                @if($stats['peserta_pending'] > 0)
                                    <div class="text-sm text-amber-600 font-medium">{{ $stats['peserta_pending'] }} menunggu</div>
                                @else
                                    <div class="text-sm text-green-600 font-medium">Semua sudah direview</div>
                                @endif
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        <a href="{{ route('admin.verifikasi.index') }}"
                           class="group flex items-center p-4 bg-gradient-to-r from-red-50 to-pink-50 rounded-xl hover:from-red-100 hover:to-pink-100 transition-all duration-200 border border-red-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="font-semibold text-gray-900">Verifikasi Bayar</div>
                                @if($stats['pembayaran_pending'] > 0)
                                    <div class="text-sm text-red-600 font-medium">{{ $stats['pembayaran_pending'] }} menunggu</div>
                                @else
                                    <div class="text-sm text-green-600 font-medium">Semua terverifikasi</div>
                                @endif
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        <a href="{{ route('admin.export.peserta.excel') }}"
                           class="group flex items-center p-4 bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl hover:from-emerald-100 hover:to-green-100 transition-all duration-200 border border-emerald-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="font-semibold text-gray-900">Export Data</div>
                                <div class="text-sm text-emerald-600 font-medium">Excel & PDF</div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        <a href="{{ route('admin.laporan.statistik') }}"
                           class="group flex items-center p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 border border-blue-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="font-semibold text-gray-900">Lihat Statistik</div>
                                <div class="text-sm text-blue-600 font-medium">Analitik</div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Top Ranting -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Top 5 Ranting</h3>
                            <p class="text-gray-500 text-sm mt-1">Berdasarkan jumlah peserta</p>
                        </div>
                        <a href="{{ route('admin.laporan.peserta') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold hover:underline">
                            Lihat Lengkap →
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($pesertaPerRanting->take(5) as $index => $data)
                        <div class="group">
                            <div class="flex items-center space-x-4 mb-2">
                                <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-sm">
                                    <span class="text-sm font-bold text-white">{{ $index + 1 }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-semibold text-gray-900 truncate">{{ $data['ranting'] }}</span>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm font-bold text-gray-700">{{ $data['total'] }}</span>
                                            <span class="text-xs text-gray-500">peserta</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-12">
                                <div class="bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full h-2 transition-all duration-1000 ease-out group-hover:from-blue-600 group-hover:to-indigo-700"
                                         style="width: {{ ($data['total'] / $pesertaPerRanting->first()['total']) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                    </svg>
                </div>
                <div class="text-sm font-semibold text-gray-900">Sistem Stabil</div>
                <div class="text-xs text-green-600 font-medium">Berjalan Normal</div>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <div class="text-sm font-semibold text-gray-900">Backup Terbaru</div>
                <div class="text-xs text-gray-500">{{ now()->format('d M Y, H:i') }}</div>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div class="text-sm font-semibold text-gray-900">Versi Aplikasi</div>
                <div class="text-xs text-gray-500">v2.1.0</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .chart-container {
        position: relative;
        height: 320px;
    }

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
</style>
@endpush

@push('scripts')
<script>
    // Enhanced Chart.js configurations dengan error handling
    try {
        Chart.defaults.font.family = 'Inter, -apple-system, BlinkMacSystemFont, sans-serif';
        Chart.defaults.color = '#6B7280';
        Chart.defaults.borderColor = '#E5E7EB';
        Chart.defaults.backgroundColor = 'rgba(59, 130, 246, 0.1)';
    } catch (error) {
        console.warn('Chart.js configuration warning:', error);
    }

    // Monthly Registration Chart dengan error handling
    try {
        const monthlyCtx = document.getElementById('monthlyChart');
        if (!monthlyCtx) {
            console.warn('Monthly chart canvas not found');
            return;
        }

        const monthlyData = @json($monthlyRegistrations ?? []);

        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const monthlyLabels = [];
        const monthlyValues = [];

        for (let i = 1; i <= 12; i++) {
            monthlyLabels.push(months[i - 1]);
            monthlyValues.push(monthlyData[i] || 0);
        }

        const monthlyChart = new Chart(monthlyCtx.getContext('2d'), {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Pendaftaran',
                data: monthlyValues,
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.08)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3B82F6',
                pointBorderColor: '#FFFFFF',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: '#1D4ED8',
                pointHoverBorderWidth: 4,
                shadow: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.95)',
                    titleColor: '#F9FAFB',
                    bodyColor: '#F9FAFB',
                    borderColor: '#374151',
                    borderWidth: 1,
                    cornerRadius: 12,
                    displayColors: false,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 12,
                    callbacks: {
                        title: function(context) {
                            return `Bulan ${context[0].label}`;
                        },
                        label: function(context) {
                            return `${context.parsed.y} pendaftaran`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#F3F4F6',
                        drawBorder: false
                    },
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 12
                        },
                        color: '#6B7280'
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        },
                        color: '#6B7280'
                    }
                }
            },
            elements: {
                point: {
                    hoverBackgroundColor: '#1D4ED8'
                }
            }
        }
            });

        // Payment Status Chart dengan error handling
        const paymentCtx = document.getElementById('paymentChart');
        if (!paymentCtx) {
            console.warn('Payment chart canvas not found');
            return;
        }

        const paymentData = @json($paymentStatus ?? ['unpaid' => 0, 'pending' => 0, 'paid' => 0]);

        const paymentChart = new Chart(paymentCtx.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Belum Bayar', 'Menunggu Verifikasi', 'Sudah Lunas'],
            datasets: [{
                data: [paymentData.unpaid, paymentData.pending, paymentData.paid],
                backgroundColor: [
                    '#EF4444',
                    '#F59E0B',
                    '#10B981'
                ],
                borderWidth: 0,
                cutout: '65%',
                spacing: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 25,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 13,
                            weight: '500'
                        },
                        color: '#374151'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.95)',
                    titleColor: '#F9FAFB',
                    bodyColor: '#F9FAFB',
                    borderColor: '#374151',
                    borderWidth: 1,
                    cornerRadius: 12,
                    displayColors: true,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.parsed * 100) / total).toFixed(1);
                            return `${context.label}: ${context.parsed} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Enhanced refresh functions dengan error handling
    window.refreshChart = function(type) {
        try {
            const button = event.target.closest('button');
            const icon = button.querySelector('svg');

            if (!icon) return;

            // Add loading animation
            icon.style.animation = 'spin 1s linear infinite';

            fetch(`{{ route('admin.chart-data') }}?type=${type}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Chart data not available');
                    }
                    return response.json();
                })
                .then(data => {
                    if (type === 'monthly' && window.monthlyChart) {
                        window.monthlyChart.data.datasets[0].data = Object.values(data);
                        window.monthlyChart.update('active');
                    }
                    showToast('Chart berhasil diperbarui!', 'success');
                })
                .catch(error => {
                    showToast('Fitur refresh akan tersedia setelah API diimplementasi', 'info');
                    console.log('Chart refresh:', error.message);
                })
                .finally(() => {
                    if (icon) icon.style.animation = '';
                });
        } catch (error) {
            console.warn('Refresh chart warning:', error);
        }
    };

    window.refreshPaymentChart = function() {
        try {
            const button = event.target.closest('button');
            const icon = button.querySelector('svg');

            if (!icon) return;

            icon.style.animation = 'spin 1s linear infinite';

            fetch('{{ route("admin.chart-data") }}?type=payment')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Payment chart data not available');
                    }
                    return response.json();
                })
                .then(data => {
                    if (window.paymentChart) {
                        window.paymentChart.data.datasets[0].data = [data.unpaid, data.pending, data.paid];
                        window.paymentChart.update('active');
                    }
                    showToast('Chart pembayaran diperbarui!', 'success');
                })
                .catch(error => {
                    showToast('Fitur refresh akan tersedia setelah API diimplementasi', 'info');
                    console.log('Payment chart refresh:', error.message);
                })
                .finally(() => {
                    if (icon) icon.style.animation = '';
                });
        } catch (error) {
            console.warn('Refresh payment chart warning:', error);
        }
    };

    // Real-time stats updates with animation
    setInterval(function() {
        // Simulasi update stats untuk demo (gunakan route yang ada)
        fetch('{{ route("admin.chart-data") }}?type=stats')
            .then(response => {
                if (!response.ok) {
                    // Jika route tidak ada, skip update
                    return null;
                }
                return response.json();
            })
            .then(data => {
                if (data) {
                    Object.keys(data).forEach(key => {
                        const element = document.querySelector(`[data-stat="${key}"]`);
                        if (element && element.textContent != data[key]) {
                            // Add update animation
                            element.style.transform = 'scale(1.1)';
                            element.style.color = '#10B981';
                            element.textContent = data[key];

                            setTimeout(() => {
                                element.style.transform = 'scale(1)';
                                element.style.color = '';
                            }, 300);
                        }
                    });
                }
            })
            .catch(error => {
                // Silent fail - tidak mengganggu user experience
                console.log('Stats update skipped - route not available');
            });
    }, 30000);

    // Enhanced toast notification function
    window.showToast = function(message, type = 'info') {
        const toastContainer = document.getElementById('toast-container') || createToastContainer();

        const toast = document.createElement('div');
        toast.className = `toast-item ${type} transform translate-x-full`;

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
            <div class="flex items-center space-x-3 p-4 rounded-lg shadow-lg border backdrop-blur-sm
                        ${type === 'success' ? 'bg-green-50 text-green-800 border-green-200' :
                          type === 'error' ? 'bg-red-50 text-red-800 border-red-200' :
                          'bg-blue-50 text-blue-800 border-blue-200'}">
                <div class="flex-shrink-0">
                    ${icons[type]}
                </div>
                <div class="flex-1 font-medium">${message}</div>
                <button onclick="this.closest('.toast-item').remove()" class="flex-shrink-0 opacity-70 hover:opacity-100">
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

    // Live clock update dengan error handling
    function updateClock() {
        try {
            const now = new Date();
            const timeElement = document.getElementById('currentTime');
            const dayElement = document.getElementById('currentDay');
            const dateElement = document.getElementById('currentDate');

            if (timeElement) {
                timeElement.textContent = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    timeZone: 'Asia/Jakarta'
                }) + ' WIB';
            }

            if (dayElement) {
                dayElement.textContent = now.toLocaleDateString('id-ID', { weekday: 'long' });
            }

            if (dateElement) {
                dateElement.textContent = now.getDate();
            }
        } catch (error) {
            console.warn('Clock update warning:', error);
        }
    }

    // Update clock every minute
    setInterval(updateClock, 60000);

    // Initialize animations on load dengan error handling
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
        } catch (error) {
            console.warn('Animation initialization warning:', error);
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey || e.metaKey) {
            switch(e.key) {
                case 'r':
                    e.preventDefault();
                    location.reload();
                    break;
                case '1':
                    e.preventDefault();
                    window.location.href = "{{ route('admin.peserta.index') }}";
                    break;
                case '2':
                    e.preventDefault();
                    window.location.href = "{{ route('admin.verifikasi.index') }}";
                    break;
            }
        }
    });
</script>

<style>
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.toast-item {
    transition: transform 0.3s ease-in-out;
}

/* Enhanced hover effects */
.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}

.group:hover .group-hover\:text-gray-600 {
    color: #4B5563;
}

.group:hover .group-hover\:bg-blue-200 {
    background-color: #DBEAFE;
}

.group:hover .group-hover\:bg-yellow-200 {
    background-color: #FEF3C7;
}

.group:hover .group-hover\:bg-red-200 {
    background-color: #FECACA;
}

.group:hover .group-hover\:bg-green-200 {
    background-color: #D1FAE5;
}

.group:hover .group-hover\:from-blue-600 {
    background-image: linear-gradient(to bottom right, #2563EB, #3730A3);
}

.group:hover .group-hover\:to-indigo-700 {
    background-image: linear-gradient(to bottom right, #2563EB, #3730A3);
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

/* Responsive design improvements */
@media (max-width: 768px) {
    .chart-container {
        height: 250px;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
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
    .stats-grid {
        grid-template-columns: 1fr;
    }

    .header-content {
        text-align: center;
    }

    .date-widget {
        margin-top: 1rem;
        justify-self: center;
    }
}
</style>

<script>
// Additional utility functions
window.utils = {
    // Format number with Indonesian locale
    formatNumber: function(num) {
        return new Intl.NumberFormat('id-ID').format(num);
    },

    // Format currency
    formatCurrency: function(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    },

    // Format date
    formatDate: function(date) {
        return new Intl.DateTimeFormat('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        }).format(new Date(date));
    },

    // Show loading state
    showLoading: function(element) {
        element.classList.add('loading-pulse');
        element.style.pointerEvents = 'none';
    },

    // Hide loading state
    hideLoading: function(element) {
        element.classList.remove('loading-pulse');
        element.style.pointerEvents = 'auto';
    }
};

// Dashboard refresh with better UX
window.refreshDashboard = function() {
    showToast('Memperbarui dashboard...', 'info');

    // Add loading overlay
    const overlay = document.createElement('div');
    overlay.className = 'fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center z-50';
    overlay.innerHTML = `
        <div class="bg-white rounded-lg p-6 shadow-2xl flex items-center space-x-4">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <span class="text-gray-700 font-medium">Memperbarui data...</span>
        </div>
    `;
    document.body.appendChild(overlay);

    setTimeout(() => {
        location.reload();
    }, 1000);
};

// Export functionality
window.exportData = function(type) {
    showToast('Memulai export data...', 'info');

    const urls = {
        excel: "{{ route('admin.export.peserta.excel') }}",
        pdf: "{{ route('admin.export.peserta.pdf') }}",
        pembayaran: "{{ route('admin.export.pembayaran.excel') }}"
    };

    if (urls[type]) {
        window.open(urls[type], '_blank');
        setTimeout(() => {
            showToast(`Data berhasil diexport ke ${type.toUpperCase()}!`, 'success');
        }, 2000);
    } else {
        showToast('Format export tidak tersedia', 'error');
    }
};

// Quick search functionality
window.quickSearch = function(query) {
    if (query.length < 3) return;

    // Simulasi search menggunakan route yang ada
    showToast(`Mencari: "${query}"`, 'info');

    // Redirect ke halaman peserta dengan filter
    setTimeout(() => {
        window.location.href = `{{ route('admin.peserta.index') }}?search=${encodeURIComponent(query)}`;
    }, 1000);
};

function displaySearchResults(results) {
    // Implementation for displaying search results
    console.log('Search results:', results);
}

// Performance monitoring
const performanceObserver = new PerformanceObserver((list) => {
    for (const entry of list.getEntries()) {
        if (entry.entryType === 'navigation') {
            console.log('Page load time:', entry.loadEventEnd - entry.fetchStart, 'ms');
        }
    }
});

if ('PerformanceObserver' in window) {
    performanceObserver.observe({ entryTypes: ['navigation'] });
}

// Service worker registration for offline support
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then((registration) => {
                console.log('SW registered: ', registration);
            })
            .catch((registrationError) => {
                console.log('SW registration failed: ', registrationError);
            });
    });
}

// Error boundary untuk JavaScript errors - hanya log, jangan tampilkan toast
window.addEventListener('error', (event) => {
    console.warn('JavaScript warning:', event.error);
    // Hanya tampilkan toast untuk error kritikal, bukan untuk error kecil
    if (event.error && event.error.message && event.error.message.includes('critical')) {
        showToast('Terjadi kesalahan sistem. Silakan refresh halaman.', 'error');
    }
});

// Network status monitoring
window.addEventListener('online', () => {
    showToast('Koneksi internet tersambung kembali', 'success');
});

window.addEventListener('offline', () => {
    showToast('Koneksi internet terputus', 'error');
});

// Advanced chart interactions
function addChartInteractions() {
    // Add click handlers for chart elements
    monthlyChart.options.onClick = (event, elements) => {
        if (elements.length > 0) {
            const index = elements[0].index;
            const month = monthlyLabels[index];
            showToast(`Menampilkan detail untuk bulan ${month}`, 'info');
            // Navigate to detailed view
            // window.location.href = `/admin/laporan/detail?month=${index + 1}`;
        }
    };

    paymentChart.options.onClick = (event, elements) => {
        if (elements.length > 0) {
            const index = elements[0].index;
            const status = ['unpaid', 'pending', 'paid'][index];
            showToast('Menampilkan detail pembayaran...', 'info');
            // Navigate to payment detail
            // window.location.href = `/admin/pembayaran?status=${status}`;
        }
    };
}

// Initialize advanced features
document.addEventListener('DOMContentLoaded', function() {
    addChartInteractions();

    // Add tooltip to all elements with title attribute
    const elementsWithTooltip = document.querySelectorAll('[title]');
    elementsWithTooltip.forEach(element => {
        element.addEventListener('mouseenter', showTooltip);
        element.addEventListener('mouseleave', hideTooltip);
    });
});

function showTooltip(event) {
    const element = event.target;
    const title = element.getAttribute('title');

    if (!title) return;

    const tooltip = document.createElement('div');
    tooltip.className = 'absolute z-50 px-2 py-1 text-sm bg-gray-900 text-white rounded shadow-lg';
    tooltip.textContent = title;
    tooltip.id = 'custom-tooltip';

    document.body.appendChild(tooltip);

    const rect = element.getBoundingClientRect();
    tooltip.style.left = rect.left + 'px';
    tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';

    element.removeAttribute('title');
    element.setAttribute('data-original-title', title);
}

function hideTooltip(event) {
    const tooltip = document.getElementById('custom-tooltip');
    if (tooltip) {
        tooltip.remove();
    }

    const element = event.target;
    const originalTitle = element.getAttribute('data-original-title');
    if (originalTitle) {
        element.setAttribute('title', originalTitle);
        element.removeAttribute('data-original-title');
    }
}

// Accessibility improvements
document.addEventListener('keydown', function(e) {
    // Skip to main content with Alt+M
    if (e.altKey && e.key === 'm') {
        e.preventDefault();
        const mainContent = document.querySelector('main') || document.querySelector('[role="main"]');
        if (mainContent) {
            mainContent.focus();
        }
    }

    // Focus management for modal dialogs
    if (e.key === 'Escape') {
        const openModal = document.querySelector('.modal.open');
        if (openModal) {
            closeModal(openModal);
        }
    }
});

// Print functionality
window.printDashboard = function() {
    const printStyles = `
        <style>
            @media print {
                .no-print { display: none !important; }
                .print-full-width { width: 100% !important; }
                .chart-container {
                    height: 300px !important;
                    page-break-inside: avoid;
                }
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

    const head = document.head.innerHTML;
    const body = document.querySelector('.space-y-8').innerHTML;

    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            ${head}
            ${printStyles}
            <title>Dashboard INKAI - ${new Date().toLocaleDateString('id-ID')}</title>
        </head>
        <body class="p-4">
            <div class="space-y-6">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold">Dashboard Admin INKAI Kediri</h1>
                    <p class="text-gray-600">Laporan tanggal ${new Date().toLocaleDateString('id-ID')}</p>
                </div>
                ${body}
            </div>
        </body>
        </html>
    `);

    printWindow.document.close();
    printWindow.focus();

    setTimeout(() => {
        printWindow.print();
        printWindow.close();
    }, 1000);
};

console.log('Dashboard INKAI Admin v2.1.0 loaded successfully! 🥋');
</script>
@endpush
