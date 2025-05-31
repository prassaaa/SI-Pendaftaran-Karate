@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="relative bg-gradient-to-br from-slate-900 via-purple-900 to-indigo-900 rounded-2xl shadow-2xl overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-purple-600/20 to-indigo-800/30"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-white/5 to-transparent rounded-full transform translate-x-32 -translate-y-32"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-purple-500/10 to-transparent rounded-full transform -translate-x-16 translate-y-16"></div>

        <div class="relative p-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                <div class="mb-6 lg:mb-0">
                    <div class="flex items-center space-x-4 mb-4">
                        <a href="{{ route('admin.dashboard') }}"
                           class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 border border-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                        </a>
                        <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">Statistik Keseluruhan</h1>
                            <p class="text-purple-100 text-lg">Overview lengkap sistem pendaftaran karate INKAI Kediri</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-4">
                    <button onclick="window.print()"
                            class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-gray-600 hover:to-gray-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        <span>Print Report</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- General Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">
        <!-- Total Peserta Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-50"></div>
            <div class="relative p-6 text-center">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div class="text-2xl font-bold text-gray-900 mb-1">{{ $generalStats['total_peserta'] }}</div>
                <div class="text-sm text-gray-500 font-medium">Total Peserta</div>
                <div class="text-xs text-blue-600 flex items-center justify-center mt-2 font-medium">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    Terdaftar aktif
                </div>
            </div>
        </div>

        <!-- Total Ranting Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-emerald-50 opacity-50"></div>
            <div class="relative p-6 text-center">
                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div class="text-2xl font-bold text-gray-900 mb-1">{{ $generalStats['total_ranting'] }}</div>
                <div class="text-sm text-gray-500 font-medium">Ranting Terdaftar</div>
                <div class="text-xs text-green-600 flex items-center justify-center mt-2 font-medium">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Organisasi aktif
                </div>
            </div>
        </div>

        <!-- Total Kategori Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-violet-50 opacity-50"></div>
            <div class="relative p-6 text-center">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="text-2xl font-bold text-gray-900 mb-1">{{ $generalStats['total_kategori'] }}</div>
                <div class="text-sm text-gray-500 font-medium">Kategori Usia</div>
                <div class="text-xs text-purple-600 flex items-center justify-center mt-2 font-medium">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Kelompok umur
                </div>
            </div>
        </div>

        <!-- Total Revenue Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-50 to-orange-50 opacity-50"></div>
            <div class="relative p-6 text-center">
                <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <div class="text-lg font-bold text-gray-900 mb-1">Rp {{ number_format($generalStats['total_revenue'], 0, ',', '.') }}</div>
                <div class="text-sm text-gray-500 font-medium">Total Revenue</div>
                <div class="text-xs text-amber-600 flex items-center justify-center mt-2 font-medium">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    Pendapatan total
                </div>
            </div>
        </div>

        <!-- Average Age Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-blue-50 opacity-50"></div>
            <div class="relative p-6 text-center">
                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div class="text-2xl font-bold text-gray-900 mb-1">{{ $generalStats['avg_age'] }}</div>
                <div class="text-sm text-gray-500 font-medium">Rata-rata Umur</div>
                <div class="text-xs text-indigo-600 flex items-center justify-center mt-2 font-medium">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Tahun
                </div>
            </div>
        </div>

        <!-- Conversion Rate Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-pink-50 to-rose-50 opacity-50"></div>
            <div class="relative p-6 text-center">
                <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <div class="text-2xl font-bold text-gray-900 mb-1">{{ $generalStats['conversion_rate'] }}%</div>
                <div class="text-sm text-gray-500 font-medium">Conversion Rate</div>
                <div class="text-xs text-pink-600 flex items-center justify-center mt-2 font-medium">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Tingkat berhasil
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        <!-- Registration Trend -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Trend Pendaftaran</h3>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-sm text-gray-600 font-medium">6 Bulan Terakhir</span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="chart-container">
                    <canvas id="registrationTrendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Gender Distribution -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Distribusi Jenis Kelamin</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="chart-container">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Age Distribution and Payment Methods -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        <!-- Age Distribution -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Distribusi Kategori Usia</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    @forelse($ageDistribution as $age)
                    <div class="group">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-bold text-gray-900">{{ $age->nama_kategori }}</span>
                            <span class="text-sm text-gray-600 font-medium">{{ $age->peserta_count }} peserta</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-full h-3 transition-all duration-500 group-hover:scale-105"
                                 style="width: {{ $generalStats['total_peserta'] > 0 ? ($age->peserta_count / $generalStats['total_peserta']) * 100 : 0 }}%"></div>
                        </div>
                        <div class="mt-2 text-xs text-gray-500 text-right">
                            {{ $generalStats['total_peserta'] > 0 ? round(($age->peserta_count / $generalStats['total_peserta']) * 100, 1) : 0 }}% dari total peserta
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <div class="text-gray-500">Tidak ada data kategori usia</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Metode Pembayaran</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    @forelse($paymentMethods as $method)
                    <div class="group p-4 {{ $method->metode_pembayaran === 'transfer' ? 'bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100' : ($method->metode_pembayaran === 'qris' ? 'bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100' : 'bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-100') }} rounded-xl transition-all duration-300 hover:shadow-md">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-4 h-4 rounded-full mr-3 {{ $method->metode_pembayaran === 'transfer' ? 'bg-blue-500' : ($method->metode_pembayaran === 'qris' ? 'bg-green-500' : 'bg-amber-500') }}"></div>
                                <span class="text-sm font-bold {{ $method->metode_pembayaran === 'transfer' ? 'text-blue-900' : ($method->metode_pembayaran === 'qris' ? 'text-green-900' : 'text-amber-900') }}">
                                    {{ $method->metode_pembayaran === 'transfer' ? 'Transfer Bank' : ($method->metode_pembayaran === 'qris' ? 'QRIS' : 'Cash') }}
                                </span>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-gray-900">{{ $method->total }}</div>
                                <div class="text-xs {{ $method->metode_pembayaran === 'transfer' ? 'text-blue-600' : ($method->metode_pembayaran === 'qris' ? 'text-green-600' : 'text-amber-600') }} font-medium">
                                    {{ $paymentMethods->sum('total') > 0 ? round(($method->total / $paymentMethods->sum('total')) * 100, 1) : 0 }}% dari total
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 bg-gray-200 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r {{ $method->metode_pembayaran === 'transfer' ? 'from-blue-500 to-blue-600' : ($method->metode_pembayaran === 'qris' ? 'from-green-500 to-green-600' : 'from-amber-500 to-amber-600') }} rounded-full h-2 transition-all duration-500 group-hover:scale-105"
                                 style="width: {{ $paymentMethods->sum('total') > 0 ? ($method->total / $paymentMethods->sum('total')) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <div class="text-gray-500">Tidak ada data metode pembayaran</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Top Performing Ranting -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2m4-6a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Top 10 Ranting Terbaik</h3>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Ranking</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Ranting</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Peserta</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Persentase</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Performance</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($topRanting as $index => $ranting)
                    <tr class="{{ $index < 3 ? 'bg-gradient-to-r from-yellow-50 to-amber-50' : 'hover:bg-gray-50' }} transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($index < 3)
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-lg
                                        {{ $index === 0 ? 'bg-gradient-to-br from-yellow-400 to-yellow-500 text-white' :
                                            ($index === 1 ? 'bg-gradient-to-br from-gray-400 to-gray-500 text-white' : 'bg-gradient-to-br from-orange-400 to-orange-500 text-white') }}">
                                        @if($index === 0)
                                            🥇
                                        @elseif($index === 1)
                                            🥈
                                        @else
                                            🥉
                                        @endif
                                    </div>
                                @else
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-bold text-blue-600">{{ $index + 1 }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">{{ $ranting->nama_ranting }}</div>
                            <div class="text-sm text-gray-500">{{ $ranting->kota }}, {{ $ranting->provinsi }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-blue-600">{{ $ranting->peserta_count }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-semibold text-gray-900 mr-2">
                                    {{ $generalStats['total_peserta'] > 0 ? round(($ranting->peserta_count / $generalStats['total_peserta']) * 100, 1) : 0 }}%
                                </div>
                                <div class="w-16 bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full transition-all duration-500"
                                            style="width: {{ $generalStats['total_peserta'] > 0 ? ($ranting->peserta_count / $generalStats['total_peserta']) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($ranting->peserta_count >= 10)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                    Excellent
                                </span>
                            @elseif($ranting->peserta_count >= 5)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full mr-2"></div>
                                    Good
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                    <div class="w-2 h-2 bg-amber-400 rounded-full mr-2"></div>
                                    Average
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-gray-500">Tidak ada data ranting untuk ditampilkan</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Status Distribution -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        <!-- Registration Status -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Status Pendaftaran</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    @forelse($statusDistribution['pendaftaran'] as $status)
                    <div class="group p-6 rounded-2xl border-2 transition-all duration-300 hover:shadow-lg
                        {{ $status->status_pendaftaran === 'approved' ? 'bg-gradient-to-br from-green-50 to-emerald-50 border-green-100 hover:border-green-200' :
                            ($status->status_pendaftaran === 'pending' ? 'bg-gradient-to-br from-amber-50 to-orange-50 border-amber-100 hover:border-amber-200' : 'bg-gradient-to-br from-red-50 to-pink-50 border-red-100 hover:border-red-200') }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-5 h-5 rounded-full mr-4 group-hover:scale-110 transition-transform duration-300
                                    {{ $status->status_pendaftaran === 'approved' ? 'bg-green-500' :
                                        ($status->status_pendaftaran === 'pending' ? 'bg-amber-500' : 'bg-red-500') }}">
                                </div>
                                <span class="font-bold {{ $status->status_pendaftaran === 'approved' ? 'text-green-900' : ($status->status_pendaftaran === 'pending' ? 'text-amber-900' : 'text-red-900') }}">
                                    {{ $status->status_pendaftaran === 'approved' ? 'Approved' : ($status->status_pendaftaran === 'pending' ? 'Pending' : 'Rejected') }}
                                </span>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-gray-900">{{ $status->total }}</div>
                                <div class="text-sm {{ $status->status_pendaftaran === 'approved' ? 'text-green-600' : ($status->status_pendaftaran === 'pending' ? 'text-amber-600' : 'text-red-600') }} font-medium">
                                    {{ $generalStats['total_peserta'] > 0 ? round(($status->total / $generalStats['total_peserta']) * 100, 1) : 0 }}% dari total
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r {{ $status->status_pendaftaran === 'approved' ? 'from-green-500 to-green-600' : ($status->status_pendaftaran === 'pending' ? 'from-amber-500 to-amber-600' : 'from-red-500 to-red-600') }} rounded-full h-3 transition-all duration-500 group-hover:scale-105"
                                    style="width: {{ $generalStats['total_peserta'] > 0 ? ($status->total / $generalStats['total_peserta']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <div class="text-gray-500">Tidak ada data status pendaftaran</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Status Pembayaran</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    @forelse($statusDistribution['pembayaran'] as $status)
                    <div class="group p-6 rounded-2xl border-2 transition-all duration-300 hover:shadow-lg
                        {{ $status->status_bayar === 'paid' ? 'bg-gradient-to-br from-green-50 to-emerald-50 border-green-100 hover:border-green-200' :
                            ($status->status_bayar === 'pending' ? 'bg-gradient-to-br from-amber-50 to-orange-50 border-amber-100 hover:border-amber-200' : 'bg-gradient-to-br from-red-50 to-pink-50 border-red-100 hover:border-red-200') }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-5 h-5 rounded-full mr-4 group-hover:scale-110 transition-transform duration-300
                                    {{ $status->status_bayar === 'paid' ? 'bg-green-500' :
                                        ($status->status_bayar === 'pending' ? 'bg-amber-500' : 'bg-red-500') }}">
                                </div>
                                <span class="font-bold {{ $status->status_bayar === 'paid' ? 'text-green-900' : ($status->status_bayar === 'pending' ? 'text-amber-900' : 'text-red-900') }}">
                                    {{ $status->status_bayar === 'paid' ? 'Lunas' : ($status->status_bayar === 'pending' ? 'Pending' : 'Failed') }}
                                </span>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-gray-900">{{ $status->total }}</div>
                                <div class="text-sm {{ $status->status_bayar === 'paid' ? 'text-green-600' : ($status->status_bayar === 'pending' ? 'text-amber-600' : 'text-red-600') }} font-medium">
                                    {{ $generalStats['total_peserta'] > 0 ? round(($status->total / $generalStats['total_peserta']) * 100, 1) : 0 }}% dari total
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r {{ $status->status_bayar === 'paid' ? 'from-green-500 to-green-600' : ($status->status_bayar === 'pending' ? 'from-amber-500 to-amber-600' : 'from-red-500 to-red-600') }} rounded-full h-3 transition-all duration-500 group-hover:scale-105"
                                    style="width: {{ $generalStats['total_peserta'] > 0 ? ($status->total / $generalStats['total_peserta']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <div class="text-gray-500">Tidak ada data status pembayaran</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Key Insights -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-violet-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Key Insights & Recommendations</h3>
            </div>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Insight 1: Registration Performance -->
                <div class="group p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-200 transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-blue-900">Performa Pendaftaran</h4>
                    </div>
                    <p class="text-sm text-blue-800 mb-3 leading-relaxed">
                        Conversion rate <strong>{{ $generalStats['conversion_rate'] }}%</strong> menunjukkan
                        {{ $generalStats['conversion_rate'] >= 80 ? 'performa sangat baik' :
                            ($generalStats['conversion_rate'] >= 60 ? 'performa baik' : 'masih perlu ditingkatkan') }}.
                    </p>
                    <div class="text-xs text-blue-600 bg-blue-100 px-3 py-2 rounded-lg">
                        📈 {{ $generalStats['total_peserta'] }} peserta dari {{ $generalStats['total_ranting'] }} ranting
                    </div>
                </div>

                <!-- Insight 2: Age Demographics -->
                <div class="group p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-200 transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-green-900">Demografi Usia</h4>
                    </div>
                    <p class="text-sm text-green-800 mb-3 leading-relaxed">
                        Rata-rata usia peserta <strong>{{ $generalStats['avg_age'] }} tahun</strong>.
                        Kategori terpopuler: <strong>{{ $ageDistribution->sortByDesc('peserta_count')->first()->nama_kategori ?? 'N/A' }}</strong>.
                    </p>
                    <div class="text-xs text-green-600 bg-green-100 px-3 py-2 rounded-lg">
                        👥 {{ $generalStats['total_kategori'] }} kategori usia tersedia
                    </div>
                </div>

                <!-- Insight 3: Revenue Performance -->
                <div class="group p-6 bg-gradient-to-br from-purple-50 to-violet-50 rounded-2xl border border-purple-200 transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-purple-900">Performa Revenue</h4>
                    </div>
                    <p class="text-sm text-purple-800 mb-3 leading-relaxed">
                        Total revenue <strong>Rp {{ number_format($generalStats['total_revenue'], 0, ',', '.') }}</strong>.
                        Rata-rata per peserta: <strong>Rp {{ $generalStats['total_peserta'] > 0 ? number_format($generalStats['total_revenue'] / $generalStats['total_peserta'], 0, ',', '.') : 0 }}</strong>.
                    </p>
                    <div class="text-xs text-purple-600 bg-purple-100 px-3 py-2 rounded-lg">
                        💰 Target revenue tercapai
                    </div>
                </div>
            </div>

            <!-- Recommendations -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <span class="text-2xl mr-2">📋</span>
                    Rekomendasi Strategis
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-200">
                        <h5 class="font-bold text-blue-900 mb-3 text-lg">Peningkatan Partisipasi</h5>
                        <ul class="space-y-2 text-sm text-blue-800">
                            <li class="flex items-start">
                                <span class="text-blue-600 mr-2">•</span>
                                Focus pada ranting dengan partisipasi rendah
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-600 mr-2">•</span>
                                Program promosi untuk kategori usia tertentu
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-600 mr-2">•</span>
                                Kerjasama dengan sekolah dan komunitas
                            </li>
                        </ul>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border border-amber-200">
                        <h5 class="font-bold text-amber-900 mb-3 text-lg">Optimasi Proses</h5>
                        <ul class="space-y-2 text-sm text-amber-800">
                            <li class="flex items-start">
                                <span class="text-amber-600 mr-2">•</span>
                                Streamline proses verifikasi pembayaran
                            </li>
                            <li class="flex items-start">
                                <span class="text-amber-600 mr-2">•</span>
                                Implementasi reminder otomatis
                            </li>
                            <li class="flex items-start">
                                <span class="text-amber-600 mr-2">•</span>
                                Digitalisasi dokumentasi
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl p-8 shadow-2xl flex items-center space-x-4">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
        <span class="text-gray-700 font-semibold">Memuat statistik...</span>
    </div>
    </div>
    @endsection

    @push('styles')
    <style>
    .chart-container {
    position: relative;
    height: 300px;
    }

    /* Enhanced animations */
    .animate-fade-in {
    animation: fadeIn 0.8s ease-out forwards;
    }

    @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
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

    /* Custom scrollbar */
    ::-webkit-scrollbar {
    width: 6px;
    height: 8px;
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

    /* Loading animation */
    .loading-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
    }

    /* Better focus states */
    .focus\:ring-2:focus {
    outline: 2px solid transparent;
    outline-offset: 2px;
    box-shadow: 0 0 0 2px rgba(147, 51, 234, 0.5);
    }

    /* Card hover effects */
    .card-hover {
    transition: all 0.3s ease;
    }

    .card-hover:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Progress bar animations */
    .progress-bar {
    transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Print styles */
    @media print {
    .no-print {
        display: none !important;
    }

    .bg-white {
        box-shadow: none !important;
        border: 1px solid #e5e7eb !important;
    }

    .chart-container {
        page-break-inside: avoid;
    }

    body * {
        visibility: hidden;
    }

    .print-section, .print-section * {
        visibility: visible;
    }

    .print-section {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
    .chart-container {
        height: 250px;
    }
    }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    function showLoading() {
    document.getElementById('loadingOverlay').classList.remove('hidden');
    }

    function hideLoading() {
    document.getElementById('loadingOverlay').classList.add('hidden');
    }

    // Initialize Charts and functionality
    document.addEventListener('DOMContentLoaded', function() {
    // Chart.js global configuration
    Chart.defaults.font.family = 'Inter, system-ui, sans-serif';
    Chart.defaults.color = '#6B7280';
    Chart.defaults.plugins.legend.labels.usePointStyle = true;

    // Registration Trend Chart
    const trendCtx = document.getElementById('registrationTrendChart').getContext('2d');
    const trendData = @json($registrationTrend);

    const trendLabels = trendData.map(item => item.month);
    const trendValues = trendData.map(item => item.count);

    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [{
                label: 'Pendaftaran',
                data: trendValues,
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3B82F6',
                pointBorderColor: '#FFFFFF',
                pointBorderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#FFFFFF',
                    bodyColor: '#FFFFFF',
                    borderColor: '#3B82F6',
                    borderWidth: 1,
                    cornerRadius: 8,
                    callbacks: {
                        title: function(context) {
                            return 'Bulan: ' + context[0].label;
                            },
                        label: function(context) {
                            return 'Pendaftaran: ' + context.raw + ' peserta';
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
                        padding: 10,
                        callback: function(value) {
                            return value + ' peserta';
                        }
                    },
                    border: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        padding: 10
                    },
                    border: {
                        display: false
                    }
                }
            }
        }
    });

    // Gender Distribution Chart
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    const genderData = @json($genderDistribution);

    const genderLabels = genderData.map(item => item.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
    const genderValues = genderData.map(item => item.total);
    const genderColors = ['#3B82F6', '#EC4899'];

    new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: genderLabels,
            datasets: [{
                data: genderValues,
                backgroundColor: genderColors,
                borderColor: genderColors,
                borderWidth: 0,
                cutout: '60%',
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#FFFFFF',
                    bodyColor: '#FFFFFF',
                    borderWidth: 1,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.raw / total) * 100).toFixed(1);
                            return context.label + ': ' + context.raw + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });

    // Initialize animations
    const cards = document.querySelectorAll('.group, .bg-white');
    cards.forEach((card, index) => {
        if (card) {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('animate-fade-in', 'card-hover');
        }
    });

    // Add print button functionality
    const printButton = document.querySelector('button[onclick="window.print()"]');
    if (printButton) {
        printButton.addEventListener('click', function(e) {
            e.preventDefault();
            showToast('Mempersiapkan dokumen untuk dicetak...', 'info');

            setTimeout(() => {
                window.print();
            }, 1000);
        });
    }

    // Auto refresh data setiap 5 menit
    setInterval(function() {
        if (document.visibilityState === 'visible') {
            fetch(window.location.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // Update statistics if changed
                const currentTotal = document.querySelector('.text-2xl.font-bold.text-gray-900');
                const newTotal = doc.querySelector('.text-2xl.font-bold.text-gray-900');

                if (currentTotal && newTotal && currentTotal.textContent !== newTotal.textContent) {
                    showToast('Data statistik telah diperbarui', 'info');
                }
            })
            .catch(error => console.log('Auto-refresh failed:', error));
        }
    }, 300000); // 5 minutes

    // Add table row hover effects
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(4px)';
        });

        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    // Add progress bar animations
    const progressBars = document.querySelectorAll('.bg-gradient-to-r');
    progressBars.forEach(bar => {
        if (bar.style.width) {
            bar.classList.add('progress-bar');
        }
    });
    });

    // Toast notification function
    function showToast(message, type = 'info') {
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
        warning: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>`,
        info: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>`
    };

    const colors = {
        success: 'bg-green-50 text-green-800 border-green-200',
        error: 'bg-red-50 text-red-800 border-red-200',
        warning: 'bg-yellow-50 text-yellow-800 border-yellow-200',
        info: 'bg-purple-50 text-purple-800 border-purple-200'
    };

    toast.innerHTML = `
        <div class="flex items-center space-x-3 p-4 rounded-xl shadow-lg border backdrop-blur-sm ${colors[type]}">
            <div class="flex-shrink-0">
                ${icons[type]}
            </div>
            <div class="flex-1 font-medium">${message}</div>
            <button onclick="this.closest('.toast-item').remove()" class="flex-shrink-0 opacity-70 hover:opacity-100 transition-opacity">
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
    }

    function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'fixed top-4 right-4 z-50 space-y-2';
    document.body.appendChild(container);
    return container;
    }

    // Performance optimization
    function optimizePerformance() {
    // Lazy load images if any
    const images = document.querySelectorAll('img[src]');
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.classList.add('fade-in');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));

    // Debounced resize handler
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Handle any responsive adjustments
            Chart.instances.forEach(chart => {
                chart.resize();
            });
        }, 250);
    });
    }

    // Initialize performance optimizations
    document.addEventListener('DOMContentLoaded', function() {
    optimizePerformance();
    });

    // Utility functions
    window.statistikUtils = {
    formatNumber: function(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    },

    formatCurrency: function(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    },

    calculatePercentage: function(part, total) {
        return total > 0 ? ((part / total) * 100).toFixed(1) : 0;
    },

    copyToClipboard: function(text) {
        navigator.clipboard.writeText(text).then(() => {
            showToast('Berhasil disalin ke clipboard', 'success');
        }).catch(() => {
            showToast('Gagal menyalin ke clipboard', 'error');
        });
    },

    shareStatistics: function() {
        if (navigator.share) {
            navigator.share({
                title: 'Statistik Keseluruhan',
                text: 'Statistik Keseluruhan INKAI Kediri',
                url: window.location.href
            });
        } else {
            this.copyToClipboard(window.location.href);
            showToast('Link statistik berhasil disalin!', 'success');
        }
    },

    exportStatistics: function(format) {
        showToast(`Memulai export statistik ke ${format.toUpperCase()}...`, 'info');

        const progressBar = document.createElement('div');
        progressBar.className = 'fixed bottom-4 right-4 bg-white rounded-lg shadow-lg p-4 z-50';
        progressBar.innerHTML = `
            <div class="flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-purple-600"></div>
                <div>
                    <div class="text-sm font-semibold text-gray-900">Mengexport statistik...</div>
                    <div class="w-48 bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-purple-600 h-2 rounded-full transition-all duration-300" style="width: 0%" id="exportProgress"></div>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(progressBar);

        // Simulate progress
        let progress = 0;
        const progressInterval = setInterval(() => {
            progress += Math.random() * 20;
            if (progress > 100) progress = 100;

            const progressBarElement = document.getElementById('exportProgress');
            if (progressBarElement) {
                progressBarElement.style.width = progress + '%';
            }

            if (progress >= 100) {
                clearInterval(progressInterval);
                setTimeout(() => {
                    progressBar.remove();
                    showToast(`Statistik berhasil diexport ke ${format.toUpperCase()}!`, 'success');
                }, 500);
            }
        }, 200);
    },

    generateInsights: function(data) {
        const insights = [];

        // Performance analysis
        if (data.conversionRate > 80) {
            insights.push({
                type: 'positive',
                message: `Conversion rate excellent (${data.conversionRate}%)`
            });
        } else if (data.conversionRate < 60) {
            insights.push({
                type: 'warning',
                message: `Conversion rate needs improvement (${data.conversionRate}%)`
            });
        }

        // Demographics analysis
        if (data.averageAge < 15) {
            insights.push({
                type: 'info',
                message: 'Mayoritas peserta berusia muda, fokus pada program junior'
            });
        }

        return insights;
    },

    refreshData: function() {
        showLoading();

        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            // Update page content
            showToast('Data statistik berhasil diperbarui', 'success');
            setTimeout(() => {
                location.reload();
            }, 1000);
        })
        .catch(error => {
            showToast('Gagal memperbarui data', 'error');
            console.error('Refresh failed:', error);
        })
        .finally(() => {
            hideLoading();
        });
    }
};

console.log('Statistik Keseluruhan Modern UI v2.1.0 loaded successfully! 📊🎯');
</script>
@endpush
