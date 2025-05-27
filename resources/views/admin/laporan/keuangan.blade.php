@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Laporan Keuangan</h1>
            <p class="text-gray-600 mt-1">Analisis finansial dan revenue management</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.export.laporan-keuangan', request()->query()) }}"
               class="admin-btn-danger">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export PDF
            </a>
        </div>
    </div>

    <!-- Date Filter -->
    <div class="admin-card p-6">
        <form method="GET" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="form-input">
            </div>
            <div>
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="form-input">
            </div>
            <button type="submit" class="admin-btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Update Laporan
            </button>
        </form>
    </div>

    <!-- Revenue Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
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
                    <div class="text-2xl font-bold text-green-600">
                        Rp {{ number_format($revenueStats['total_revenue'], 0, ',', '.') }}
                    </div>
                    <div class="text-sm text-gray-600">Total Revenue</div>
                </div>
            </div>
        </div>

        <div class="admin-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-yellow-600">
                        Rp {{ number_format($revenueStats['pending_revenue'], 0, ',', '.') }}
                    </div>
                    <div class="text-sm text-gray-600">Pending Revenue</div>
                </div>
            </div>
        </div>

        <div class="admin-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-blue-600">
                        Rp {{ number_format($revenueStats['this_month'], 0, ',', '.') }}
                    </div>
                    <div class="text-sm text-gray-600">Bulan Ini</div>
                </div>
            </div>
        </div>

        <div class="admin-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-purple-600">
                        @php
                            $growth = $revenueStats['last_month'] > 0
                                ? (($revenueStats['this_month'] - $revenueStats['last_month']) / $revenueStats['last_month']) * 100
                                : ($revenueStats['this_month'] > 0 ? 100 : 0);
                        @endphp
                        {{ $growth >= 0 ? '+' : '' }}{{ number_format($growth, 1) }}%
                    </div>
                    <div class="text-sm text-gray-600">Growth Rate</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue per Category -->
    <div class="admin-card p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Revenue per Kategori Pertandingan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="text-xl font-bold text-blue-600">
                    Rp {{ number_format($revenuePerKategori['kumite_perorangan'], 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-600 mt-1">Kumite Perorangan</div>
            </div>

            <div class="text-center p-4 bg-green-50 rounded-lg">
                <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="text-xl font-bold text-green-600">
                    Rp {{ number_format($revenuePerKategori['kata_perorangan'], 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-600 mt-1">Kata Perorangan</div>
            </div>

            <div class="text-center p-4 bg-yellow-50 rounded-lg">
                <div class="w-16 h-16 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div class="text-xl font-bold text-yellow-600">
                    Rp {{ number_format($revenuePerKategori['kata_beregu'], 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-600 mt-1">Kata Beregu</div>
            </div>

            <div class="text-center p-4 bg-purple-50 rounded-lg">
                <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div class="text-xl font-bold text-purple-600">
                    Rp {{ number_format($revenuePerKategori['kumite_beregu'], 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-600 mt-1">Kumite Beregu</div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Monthly Revenue Trend -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Trend Revenue Bulanan (12 Bulan)</h3>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Revenue</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="monthlyRevenueChart"></canvas>
            </div>
        </div>

        <!-- Daily Revenue -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Revenue Harian - Periode Terpilih</h3>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Daily Revenue</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="dailyRevenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Revenue Breakdown Table -->
    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Breakdown Revenue per Kategori</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Revenue</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontribusi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Est. Peserta</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rate per Peserta</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $totalRevenue = array_sum($revenuePerKategori);
                        $categories = [
                            ['name' => 'Kumite Perorangan', 'revenue' => $revenuePerKategori['kumite_perorangan'], 'rate' => 50000],
                            ['name' => 'Kata Perorangan', 'revenue' => $revenuePerKategori['kata_perorangan'], 'rate' => 40000],
                            ['name' => 'Kata Beregu', 'revenue' => $revenuePerKategori['kata_beregu'], 'rate' => 75000],
                            ['name' => 'Kumite Beregu', 'revenue' => $revenuePerKategori['kumite_beregu'], 'rate' => 75000],
                        ];
                    @endphp
                    @foreach($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $category['name'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                            Rp {{ number_format($category['revenue'], 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $totalRevenue > 0 ? number_format(($category['revenue'] / $totalRevenue) * 100, 1) : 0 }}%
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $category['rate'] > 0 ? number_format($category['revenue'] / $category['rate'], 0) : 0 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($category['rate'], 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                    <tr class="bg-gray-50 font-semibold">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Total</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">100%</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Financial Summary -->
    <div class="admin-card p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Ringkasan Keuangan</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-6 bg-green-50 rounded-lg">
                <div class="text-3xl font-bold text-green-600 mb-2">
                    Rp {{ number_format($revenueStats['total_revenue'], 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-600 mb-1">Total Revenue Verified</div>
                <div class="text-xs text-gray-500">Revenue yang sudah dikonfirmasi</div>
            </div>

            <div class="text-center p-6 bg-blue-50 rounded-lg">
                <div class="text-3xl font-bold text-blue-600 mb-2">
                    @php
                        $avgDaily = count($dailyRevenue) > 0 ? $revenueStats['total_revenue'] / count($dailyRevenue) : 0;
                    @endphp
                    Rp {{ number_format($avgDaily, 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-600 mb-1">Rata-rata Harian</div>
                <div class="text-xs text-gray-500">Revenue per hari dalam periode</div>
            </div>

            <div class="text-center p-6 bg-purple-50 rounded-lg">
                <div class="text-3xl font-bold text-purple-600 mb-2">
                    @php
                        $projectedMonthly = $avgDaily * 30;
                    @endphp
                    Rp {{ number_format($projectedMonthly, 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-600 mb-1">Proyeksi Bulanan</div>
                <div class="text-xs text-gray-500">Berdasarkan rata-rata harian</div>
            </div>
        </div>

        <!-- Growth Analysis -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h4 class="text-md font-semibold text-gray-900 mb-4">Analisis Pertumbuhan</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <div class="text-sm text-gray-600">Bulan Ini vs Bulan Lalu</div>
                        <div class="text-lg font-semibold text-gray-900">
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
                        <div class="text-sm font-medium">Rp {{ number_format($revenueStats['last_month'], 0, ',', '.') }}</div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <div class="text-sm text-gray-600">Status Pending</div>
                        <div class="text-lg font-semibold text-yellow-600">
                            Rp {{ number_format($revenueStats['pending_revenue'], 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Potensi Tambahan</div>
                        <div class="text-sm font-medium text-gray-900">
                            {{ $revenueStats['total_revenue'] > 0 ? number_format(($revenueStats['pending_revenue'] / $revenueStats['total_revenue']) * 100, 1) : 0 }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    Chart.defaults.font.family = 'Inter';
    Chart.defaults.color = '#6B7280';

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
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#F3F4F6'
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value + 'M';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Daily Revenue Chart
    const dailyCtx = document.getElementById('dailyRevenueChart').getContext('2d');
    const dailyData = @json($dailyRevenue);

    const dailyLabels = dailyData.map(item => new Date(item.date).toLocaleDateString('id-ID'));
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
                borderRadius: 4,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#F3F4F6'
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value + 'K';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush

<style>
.chart-container {
    position: relative;
    height: 300px;
}

.admin-card {
    @apply bg-white rounded-xl shadow-sm border border-gray-200;
}

.form-label {
    @apply block text-sm font-medium text-gray-700 mb-1;
}

.form-input {
    @apply block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200;
}

.admin-btn-primary {
    @apply inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200;
}

.admin-btn-danger {
    @apply inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200;
}
</style>
