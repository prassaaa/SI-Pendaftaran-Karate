@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Laporan & Analitik</h1>
            <p class="text-gray-600 mt-1">Akses berbagai laporan dan analisis data sistem pendaftaran</p>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="admin-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-gray-900">{{ \App\Models\Peserta::count() }}</div>
                    <div class="text-sm text-gray-600">Total Peserta</div>
                </div>
            </div>
        </div>

        <div class="admin-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-gray-900">{{ \App\Models\Pembayaran::count() }}</div>
                    <div class="text-sm text-gray-600">Total Transaksi</div>
                </div>
            </div>
        </div>

        <div class="admin-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-gray-900">{{ \App\Models\Ranting::count() }}</div>
                    <div class="text-sm text-gray-600">Total Ranting</div>
                </div>
            </div>
        </div>

        <div class="admin-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-gray-900">
                        Rp {{ number_format(\App\Models\Pembayaran::paid()->sum('jumlah_bayar'), 0, ',', '.') }}
                    </div>
                    <div class="text-sm text-gray-600">Total Revenue</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Categories -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
        <!-- Laporan Peserta -->
        <div class="admin-card group hover:shadow-lg transition-shadow duration-200">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-blue-200 transition-colors duration-200">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Laporan Peserta</h3>
                        <p class="text-sm text-gray-600">Analisis data peserta, demografis, dan distribusi</p>
                    </div>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Total Peserta:</span>
                        <span class="font-semibold">{{ \App\Models\Peserta::count() }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Approved:</span>
                        <span class="font-semibold text-green-600">{{ \App\Models\Peserta::approved()->count() }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Pending:</span>
                        <span class="font-semibold text-yellow-600">{{ \App\Models\Peserta::pending()->count() }}</span>
                    </div>
                </div>

                <a href="{{ route('admin.laporan.peserta') }}"
                   class="block w-full text-center admin-btn-primary group-hover:bg-blue-700">
                    Lihat Laporan Peserta
                    <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Laporan Pembayaran -->
        <div class="admin-card group hover:shadow-lg transition-shadow duration-200">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-green-200 transition-colors duration-200">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Laporan Pembayaran</h3>
                        <p class="text-sm text-gray-600">Analisis transaksi dan metode pembayaran</p>
                    </div>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Total Transaksi:</span>
                        <span class="font-semibold">{{ \App\Models\Pembayaran::count() }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Verified:</span>
                        <span class="font-semibold text-green-600">{{ \App\Models\Pembayaran::paid()->count() }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Pending:</span>
                        <span class="font-semibold text-yellow-600">{{ \App\Models\Pembayaran::pending()->count() }}</span>
                    </div>
                </div>

                <a href="{{ route('admin.laporan.pembayaran') }}"
                   class="block w-full text-center admin-btn-success group-hover:bg-green-700">
                    Lihat Laporan Pembayaran
                    <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Laporan Keuangan -->
        <div class="admin-card group hover:shadow-lg transition-shadow duration-200">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-purple-200 transition-colors duration-200">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Laporan Keuangan</h3>
                        <p class="text-sm text-gray-600">Analisis revenue dan proyeksi keuangan</p>
                    </div>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Total Revenue:</span>
                        <span class="font-semibold text-green-600">Rp {{ number_format(\App\Models\Pembayaran::paid()->sum('jumlah_bayar') / 1000000, 1) }}M</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Bulan Ini:</span>
                        <span class="font-semibold">Rp {{ number_format(\App\Models\Pembayaran::paid()->whereMonth('verified_at', now()->month)->sum('jumlah_bayar') / 1000, 0) }}K</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Pending:</span>
                        <span class="font-semibold text-yellow-600">Rp {{ number_format(\App\Models\Pembayaran::pending()->sum('jumlah_bayar') / 1000, 0) }}K</span>
                    </div>
                </div>

                <a href="{{ route('admin.laporan.keuangan') }}"
                   class="block w-full text-center admin-btn-purple group-hover:bg-purple-700">
                    Lihat Laporan Keuangan
                    <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Statistik Keseluruhan -->
        <div class="admin-card group hover:shadow-lg transition-shadow duration-200">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-indigo-200 transition-colors duration-200">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Statistik Keseluruhan</h3>
                        <p class="text-sm text-gray-600">Overview lengkap dan insights</p>
                    </div>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Conversion Rate:</span>
                        <span class="font-semibold text-blue-600">
                            {{ \App\Models\Peserta::count() > 0 ? round((\App\Models\Peserta::paid()->count() / \App\Models\Peserta::count()) * 100, 1) : 0 }}%
                        </span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Avg Revenue:</span>
                        <span class="font-semibold">Rp {{ \App\Models\Pembayaran::paid()->count() > 0 ? number_format(\App\Models\Pembayaran::paid()->sum('jumlah_bayar') / \App\Models\Pembayaran::paid()->count(), 0, ',', '.') : 0 }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Active Ranting:</span>
                        <span class="font-semibold">{{ \App\Models\Ranting::whereHas('peserta')->count() }}</span>
                    </div>
                </div>

                <a href="{{ route('admin.laporan.statistik') }}"
                   class="block w-full text-center admin-btn-indigo group-hover:bg-indigo-700">
                    Lihat Statistik Lengkap
                    <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Export Section -->
    <div class="admin-card p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Quick Export</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.export.peserta.excel') }}"
               class="flex items-center p-4 border border-green-200 rounded-lg hover:bg-green-50 transition-colors duration-200 group">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-green-200">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <div class="font-medium text-gray-900">Export Data Peserta</div>
                    <div class="text-sm text-gray-600">Excel spreadsheet format</div>
                </div>
            </a>

            <a href="{{ route('admin.export.pembayaran.excel') }}"
               class="flex items-center p-4 border border-blue-200 rounded-lg hover:bg-blue-50 transition-colors duration-200 group">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <div>
                    <div class="font-medium text-gray-900">Export Data Pembayaran</div>
                    <div class="text-sm text-gray-600">Excel spreadsheet format</div>
                </div>
            </a>

            <a href="{{ route('admin.export.laporan-keuangan') }}"
               class="flex items-center p-4 border border-red-200 rounded-lg hover:bg-red-50 transition-colors duration-200 group">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-200">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <div class="font-medium text-gray-900">Export Laporan Keuangan</div>
                    <div class="text-sm text-gray-600">PDF report format</div>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Registrations -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Pendaftaran Terbaru</h3>
            </div>
            <div class="divide-y divide-gray-200 max-h-80 overflow-y-auto">
                @foreach(\App\Models\Peserta::with(['ranting'])->latest()->limit(5)->get() as $peserta)
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-xs font-medium text-blue-600">
                                    {{ substr($peserta->nama_lengkap, 0, 1) }}
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ $peserta->nama_lengkap }}
                            </p>
                            <p class="text-sm text-gray-500">{{ $peserta->ranting->nama_ranting }}</p>
                        </div>
                        <div class="flex-shrink-0 text-right">
                            <span class="badge badge-{{ $peserta->status_pendaftaran === 'approved' ? 'success' : ($peserta->status_pendaftaran === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($peserta->status_pendaftaran) }}
                            </span>
                            <p class="text-xs text-gray-500 mt-1">{{ $peserta->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Payments -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Pembayaran Terbaru</h3>
            </div>
            <div class="divide-y divide-gray-200 max-h-80 overflow-y-auto">
                @foreach(\App\Models\Pembayaran::with(['peserta'])->latest()->limit(5)->get() as $pembayaran)
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ $pembayaran->peserta->nama_lengkap }}
                            </p>
                            <p class="text-sm text-gray-500">{{ $pembayaran->formatted_jumlah_bayar }}</p>
                        </div>
                        <div class="flex-shrink-0 text-right">
                            <span class="badge badge-{{ $pembayaran->status_bayar === 'paid' ? 'success' : ($pembayaran->status_bayar === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($pembayaran->status_bayar) }}
                            </span>
                            <p class="text-xs text-gray-500 mt-1">{{ $pembayaran->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

<style>
.admin-card {
    @apply bg-white rounded-xl shadow-sm border border-gray-200;
}

.admin-btn-primary {
    @apply inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200;
}

.admin-btn-success {
    @apply inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200;
}

.admin-btn-purple {
    @apply inline-flex items-center justify-center px-4 py-2 bg-purple-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200;
}

.admin-btn-indigo {
    @apply inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200;
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
</style>
