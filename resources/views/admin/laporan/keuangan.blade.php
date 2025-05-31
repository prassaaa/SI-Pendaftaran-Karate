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
                        <a href="{{ route('admin.laporan.index') }}"
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
                            <h1 class="text-3xl font-bold text-white mb-2">Laporan Keuangan</h1>
                            <p class="text-purple-100 text-lg">Analisis finansial dan revenue management</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.export.laporan-keuangan', request()->query()) }}"
                       class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 py-3 rounded-xl font-semibold hover:from-red-600 hover:to-pink-600 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Export PDF</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Filter Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Filter Periode</h3>
            </div>
        </div>
        <div class="p-6">
            <form method="GET" class="flex flex-wrap items-end gap-6">
                <div class="min-w-0 flex-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Tanggal Mulai</label>
                    <input type="date" name="start_date" value="{{ $startDate }}"
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 text-sm">
                </div>
                <div class="min-w-0 flex-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Tanggal Akhir</label>
                    <input type="date" name="end_date" value="{{ $endDate }}"
                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 text-sm">
                </div>
                <div class="flex-shrink-0">
                    <button type="submit"
                            class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span>Update Laporan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Revenue Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Total Revenue Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-emerald-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($revenueStats['total_revenue'], 0, ',', '.') }}</div>
                        <div class="text-sm text-gray-500 font-medium">Total Revenue</div>
                    </div>
                </div>
                <div class="text-sm text-green-600 flex items-center font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    Revenue terkonfirmasi
                </div>
            </div>
        </div>

        <!-- Pending Revenue Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-50 to-orange-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($revenueStats['pending_revenue'], 0, ',', '.') }}</div>
                        <div class="text-sm text-gray-500 font-medium">Pending Revenue</div>
                    </div>
                </div>
                <div class="text-sm text-amber-600 flex items-center font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    Menunggu konfirmasi
                </div>
            </div>
        </div>

        <!-- This Month Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($revenueStats['this_month'], 0, ',', '.') }}</div>
                        <div class="text-sm text-gray-500 font-medium">Bulan Ini</div>
                    </div>
                </div>
                <div class="text-sm text-blue-600 flex items-center font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    Revenue bulan berjalan
                </div>
            </div>
        </div>

        <!-- Growth Rate Card -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-violet-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        @php
                            $growth = $revenueStats['last_month'] > 0
                                ? (($revenueStats['this_month'] - $revenueStats['last_month']) / $revenueStats['last_month']) * 100
                                : ($revenueStats['this_month'] > 0 ? 100 : 0);
                        @endphp
                        <div class="text-2xl font-bold text-gray-900">{{ $growth >= 0 ? '+' : '' }}{{ number_format($growth, 1) }}%</div>
                        <div class="text-sm text-gray-500 font-medium">Growth Rate</div>
                    </div>
                </div>
                <div class="text-sm text-purple-600 flex items-center font-medium">
                    @if($growth >= 0)
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        Pertumbuhan positif
                    @else
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                        </svg>
                        Penurunan
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue per Category -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Revenue per Kategori Pertandingan</h3>
            </div>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Kumite Perorangan -->
                <div class="group p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border-2 border-blue-100 hover:border-blue-200 transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-blue-900">Kumite Perorangan</h4>
                            <p class="text-sm text-blue-600 font-medium">Individual Combat</p>
                        </div>
                    </div>
                    <div class="text-2xl font-bold text-blue-600 mb-2">
                        Rp {{ number_format($revenuePerKategori['kumite_perorangan'], 0, ',', '.') }}
                    </div>
                    <div class="text-sm text-blue-800">
                        Est. {{ number_format($revenuePerKategori['kumite_perorangan'] / 50000, 0) }} peserta
                    </div>
                </div>

                <!-- Kata Perorangan -->
                <div class="group p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border-2 border-green-100 hover:border-green-200 transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-green-900">Kata Perorangan</h4>
                            <p class="text-sm text-green-600 font-medium">Individual Forms</p>
                        </div>
                    </div>
                    <div class="text-2xl font-bold text-green-600 mb-2">
                        Rp {{ number_format($revenuePerKategori['kata_perorangan'], 0, ',', '.') }}
                    </div>
                    <div class="text-sm text-green-800">
                        Est. {{ number_format($revenuePerKategori['kata_perorangan'] / 40000, 0) }} peserta
                    </div>
                </div>

                <!-- Kata Beregu -->
                <div class="group p-6 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border-2 border-amber-100 hover:border-amber-200 transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-amber-900">Kata Beregu</h4>
                            <p class="text-sm text-amber-600 font-medium">Team Forms</p>
                        </div>
                    </div>
                    <div class="text-2xl font-bold text-amber-600 mb-2">
                        Rp {{ number_format($revenuePerKategori['kata_beregu'], 0, ',', '.') }}
                    </div>
                    <div class="text-sm text-amber-800">
                        Est. {{ number_format($revenuePerKategori['kata_beregu'] / 75000, 0) }} tim
                    </div>
                </div>

                <!-- Kumite Beregu -->
                <div class="group p-6 bg-gradient-to-br from-purple-50 to-violet-50 rounded-2xl border-2 border-purple-100 hover:border-purple-200 transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-purple-900">Kumite Beregu</h4>
                            <p class="text-sm text-purple-600 font-medium">Team Combat</p>
                        </div>
                    </div>
                    <div class="text-2xl font-bold text-purple-600 mb-2">
                        Rp {{ number_format($revenuePerKategori['kumite_beregu'], 0, ',', '.') }}
                    </div>
                    <div class="text-sm text-purple-800">
                        Est. {{ number_format($revenuePerKategori['kumite_beregu'] / 75000, 0) }} tim
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        <!-- Monthly Revenue Trend -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Trend Revenue Bulanan</h3>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-sm text-gray-600 font-medium">Revenue</span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="chart-container">
                    <canvas id="monthlyRevenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Daily Revenue -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Revenue Harian</h3>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-sm text-gray-600 font-medium">Daily Revenue</span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="chart-container">
                    <canvas id="dailyRevenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Breakdown Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v10z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Breakdown Revenue per Kategori</h3>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Revenue</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kontribusi</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Est. Peserta</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Rate per Peserta</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Performance</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $totalRevenue = array_sum($revenuePerKategori);
                        $categories = [
                            ['name' => 'Kumite Perorangan', 'revenue' => $revenuePerKategori['kumite_perorangan'], 'rate' => 50000, 'color' => 'blue'],
                            ['name' => 'Kata Perorangan', 'revenue' => $revenuePerKategori['kata_perorangan'], 'rate' => 40000, 'color' => 'green'],
                            ['name' => 'Kata Beregu', 'revenue' => $revenuePerKategori['kata_beregu'], 'rate' => 75000, 'color' => 'amber'],
                            ['name' => 'Kumite Beregu', 'revenue' => $revenuePerKategori['kumite_beregu'], 'rate' => 75000, 'color' => 'purple'],
                        ];
                    @endphp
                    @foreach($categories as $category)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-{{ $category['color'] }}-500 rounded-full mr-3"></div>
                                <span class="text-sm font-bold text-gray-900">{{ $category['name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-green-600">Rp {{ number_format($category['revenue'], 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-semibold text-gray-900 mr-2">
                                    {{ $totalRevenue > 0 ? number_format(($category['revenue'] / $totalRevenue) * 100, 1) : 0 }}%
                                </div>
                                <div class="w-20 bg-gray-200 rounded-full h-2">
                                    <div class="bg-{{ $category['color'] }}-500 h-2 rounded-full transition-all duration-500"
                                            style="width: {{ $totalRevenue > 0 ? ($category['revenue'] / $totalRevenue) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-blue-600">
                                {{ $category['rate'] > 0 ? number_format($category['revenue'] / $category['rate'], 0) : 0 }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">Rp {{ number_format($category['rate'], 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($category['revenue'] >= 1000000)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                    Excellent
                                </span>
                            @elseif($category['revenue'] >= 500000)
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
                    @endforeach
                    <tr class="bg-gray-50 font-semibold border-t-2 border-gray-300">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">Total</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-green-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">100%</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-blue-600">-</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">-</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                <div class="w-2 h-2 bg-gray-400 rounded-full mr-2"></div>
                                Combined
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Financial Summary -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Ringkasan Keuangan ({{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }})</h3>
            </div>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-100 to-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="text-lg font-bold text-green-600">
                            Rp {{ number_format($revenueStats['total_revenue'], 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 font-semibold mb-1">Total Revenue Verified</div>
                    <div class="text-xs text-gray-500">Revenue yang sudah dikonfirmasi</div>
                </div>

                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        @php
                            $avgDaily = count($dailyRevenue) > 0 ? $revenueStats['total_revenue'] / count($dailyRevenue) : 0;
                        @endphp
                        <div class="text-lg font-bold text-blue-600">
                            Rp {{ number_format($avgDaily, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 font-semibold mb-1">Rata-rata Harian</div>
                    <div class="text-xs text-gray-500">Revenue per hari dalam periode</div>
                </div>

                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-violet-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        @php
                            $projectedMonthly = $avgDaily * 30;
                        @endphp
                        <div class="text-lg font-bold text-purple-600">
                            Rp {{ number_format($projectedMonthly, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 font-semibold mb-1">Proyeksi Bulanan</div>
                    <div class="text-xs text-gray-500">Berdasarkan rata-rata harian</div>
                </div>
            </div>

            <!-- Growth Analysis -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <span class="text-2xl mr-2">📈</span>
                    Analisis Pertumbuhan
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-200">
                        <h5 class="font-bold text-blue-900 mb-3 text-lg">Perbandingan Bulanan</h5>
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-blue-600 mb-1">Bulan Ini vs Bulan Lalu</div>
                                <div class="text-2xl font-bold">
                                    @if($growth >= 0)
                                        <span class="text-green-600">+{{ number_format($growth, 1) }}%</span>
                                        <span class="text-xs text-green-600 ml-1">↗️ Naik</span>
                                    @else
                                        <span class="text-red-600">{{ number_format($growth, 1) }}%</span>
                                        <span class="text-xs text-red-600 ml-1">↘️ Turun</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-500">Bulan Lalu</div>
                                <div class="text-sm font-bold text-gray-900">Rp {{ number_format($revenueStats['last_month'], 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border border-amber-200">
                        <h5 class="font-bold text-amber-900 mb-3 text-lg">Status Pending</h5>
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-amber-600 mb-1">Revenue Pending</div>
                                <div class="text-2xl font-bold text-amber-600">
                                    Rp {{ number_format($revenueStats['pending_revenue'], 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-500">Potensi Tambahan</div>
                                <div class="text-sm font-bold text-gray-900">
                                    {{ $revenueStats['total_revenue'] > 0 ? number_format(($revenueStats['pending_revenue'] / $revenueStats['total_revenue']) * 100, 1) : 0 }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Key Insights -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <span class="text-2xl mr-2">💡</span>
                    Key Insights
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-200">
                        <h5 class="font-bold text-green-900 mb-3 text-lg">Kategori Terpopuler</h5>
                        @php
                            $topCategory = collect($categories)->sortByDesc('revenue')->first();
                        @endphp
                        <p class="text-sm text-green-800 leading-relaxed">
                            <strong>{{ $topCategory['name'] }}</strong> menjadi kategori dengan revenue tertinggi
                            sebesar <strong>Rp {{ number_format($topCategory['revenue'], 0, ',', '.') }}</strong>
                            (<strong>{{ $totalRevenue > 0 ? number_format(($topCategory['revenue'] / $totalRevenue) * 100, 1) : 0 }}%</strong> dari total)
                        </p>
                    </div>

                    <div class="p-6 bg-gradient-to-br from-purple-50 to-violet-50 rounded-2xl border border-purple-200">
                        <h5 class="font-bold text-purple-900 mb-3 text-lg">Performance Metrics</h5>
                        <p class="text-sm text-purple-800 leading-relaxed">
                            Success rate pembayaran mencapai <strong>{{ $revenueStats['total_revenue'] > 0 ? number_format((($revenueStats['total_revenue'] - $revenueStats['pending_revenue']) / $revenueStats['total_revenue']) * 100, 1) : 0 }}%</strong>
                            dengan proyeksi revenue bulanan sebesar <strong>Rp {{ number_format($projectedMonthly, 0, ',', '.') }}</strong>
                        </p>
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
        <span class="text-gray-700 font-semibold">Memperbarui laporan keuangan...</span>
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

    // Monthly Revenue Chart
    const monthlyCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
    const monthlyData = @json($monthlyRevenue);

    const monthlyLabels = monthlyData.map(item => item.month);
    const monthlyValues = monthlyData.map(item => item.revenue / 1000000); // Convert to millions

    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Revenue (Juta)',
                data: monthlyValues,
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#10B981',
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
                    borderColor: '#10B981',
                    borderWidth: 1,
                    cornerRadius: 8,
                    callbacks: {
                        title: function(context) {
                            return 'Bulan: ' + context[0].label;
                        },
                        label: function(context) {
                            return 'Revenue: Rp ' + (context.raw * 1000000).toLocaleString('id-ID');
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
                        padding: 10,
                        callback: function(value) {
                            return 'Rp ' + value + 'M';
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

    // Daily Revenue Chart
    const dailyCtx = document.getElementById('dailyRevenueChart').getContext('2d');
    const dailyData = @json($dailyRevenue);

    const dailyLabels = dailyData.map(item => {
        const date = new Date(item.date);
        return date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'short'
        });
    });
    const dailyValues = dailyData.map(item => item.revenue / 1000); // Convert to thousands

    new Chart(dailyCtx, {
        type: 'bar',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: 'Revenue (Ribu)',
                data: dailyValues,
                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                borderColor: '#3B82F6',
                borderWidth: 1,
                borderRadius: 8,
                borderSkipped: false,
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
                            return 'Tanggal: ' + context[0].label;
                        },
                        label: function(context) {
                            return 'Revenue: Rp ' + (context.raw * 1000).toLocaleString('id-ID');
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
                        padding: 10,
                        callback: function(value) {
                            return 'Rp ' + value + 'K';
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

    // Initialize animations
    const cards = document.querySelectorAll('.group, .bg-white');
    cards.forEach((card, index) => {
        if (card) {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('animate-fade-in', 'card-hover');
        }
    });

    // Add export button loading states
    const exportButtons = document.querySelectorAll('a[href*="export"]');
    exportButtons.forEach(button => {
        button.addEventListener('click', function() {
            showToast('Memulai export PDF...', 'info');

            this.classList.add('loading-pulse');
            const originalHTML = this.innerHTML;
            this.innerHTML = `
                <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Mengunduh...</span>
            `;
            this.style.pointerEvents = 'none';

            setTimeout(() => {
                this.innerHTML = originalHTML;
                this.style.pointerEvents = 'auto';
                this.classList.remove('loading-pulse');
            }, 3000);
        });
    });

    // Form submission handling
    const filterForm = document.querySelector('form');
    if (filterForm) {
        filterForm.addEventListener('submit', function() {
            showLoading();
        });
    }

    // Date validation
    const dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(input => {
        input.addEventListener('change', function() {
            const startDate = document.querySelector('input[name="start_date"]').value;
            const endDate = document.querySelector('input[name="end_date"]').value;

            if (startDate && endDate && new Date(startDate) > new Date(endDate)) {
                showToast('Tanggal mulai tidak boleh lebih besar dari tanggal akhir', 'warning');
                this.value = '';
            }
        });
    });

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

                // Update revenue numbers if changed
                const currentRevenue = document.querySelector('.text-2xl.font-bold.text-gray-900');
                const newRevenue = doc.querySelector('.text-2xl.font-bold.text-gray-900');

                if (currentRevenue && newRevenue && currentRevenue.textContent !== newRevenue.textContent) {
                    showToast('Data keuangan telah diperbarui', 'info');
                }
            })
            .catch(error => console.log('Auto-refresh failed:', error));
        }
    }, 300000); // 5 minutes
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

    // Print functionality
    window.printReport = function() {
    window.print();
    };

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

    // Utility functions
    window.laporanKeuanganUtils = {
    formatCurrency: function(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    },

    formatNumber: function(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    },

    copyToClipboard: function(text) {
        navigator.clipboard.writeText(text).then(() => {
            showToast('Berhasil disalin ke clipboard', 'success');
        }).catch(() => {
            showToast('Gagal menyalin ke clipboard', 'error');
        });
    },

    shareReport: function() {
        if (navigator.share) {
            navigator.share({
                title: 'Laporan Keuangan',
                text: 'Laporan Keuangan INKAI Kediri',
                url: window.location.href
            });
        } else {
            this.copyToClipboard(window.location.href);
            showToast('Link laporan berhasil disalin!', 'success');
        }
    },

    exportData: function(format) {
        showToast(`Memulai export data ke ${format.toUpperCase()}...`, 'info');

        const progressBar = document.createElement('div');
        progressBar.className = 'fixed bottom-4 right-4 bg-white rounded-lg shadow-lg p-4 z-50';
        progressBar.innerHTML = `
            <div class="flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-purple-600"></div>
                <div>
                    <div class="text-sm font-semibold text-gray-900">Mengexport data...</div>
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
                    showToast(`Data berhasil diexport ke ${format.toUpperCase()}!`, 'success');
                }, 500);
            }
        }, 200);
    },

    calculateGrowthRate: function(current, previous) {
        if (previous === 0) return current > 0 ? 100 : 0;
        return ((current - previous) / previous) * 100;
    },

    generateFinancialInsights: function(data) {
        const insights = [];

        // Revenue trend analysis
        if (data.growth > 10) {
            insights.push({
                type: 'positive',
                message: `Revenue mengalami pertumbuhan signifikan sebesar ${data.growth.toFixed(1)}%`
            });
        } else if (data.growth < -5) {
            insights.push({
                type: 'warning',
                message: `Perlu perhatian: Revenue mengalami penurunan ${Math.abs(data.growth).toFixed(1)}%`
            });
        }

        // Pending revenue analysis
        if (data.pendingRevenue > data.totalRevenue * 0.2) {
            insights.push({
                type: 'info',
                message: `Terdapat ${((data.pendingRevenue / data.totalRevenue) * 100).toFixed(1)}% revenue yang masih pending`
            });
        }

        return insights;
    }
    };

console.log('Laporan Keuangan Modern UI v2.1.0 loaded successfully! 💰📊');
</script>
@endpush
