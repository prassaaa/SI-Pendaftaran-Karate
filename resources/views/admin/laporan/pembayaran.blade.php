@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Laporan Pembayaran</h1>
            <p class="text-gray-600 mt-1">Analisis data pembayaran dan transaksi</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.export.pembayaran.excel', request()->query()) }}"
               class="admin-btn-success">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export Excel
            </a>
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

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="admin-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['total_pembayaran'] }}</div>
                    <div class="text-sm text-gray-600">Total Transaksi</div>
                </div>
            </div>
        </div>

        <div class="admin-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['pembayaran_lunas'] }}</div>
                    <div class="text-sm text-gray-600">Lunas</div>
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
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['pembayaran_pending'] }}</div>
                    <div class="text-sm text-gray-600">Pending</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                    <div class="text-2xl font-bold text-green-600">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
                    <div class="text-sm text-gray-600">Total Revenue</div>
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
                    <div class="text-2xl font-bold text-yellow-600">Rp {{ number_format($stats['pending_revenue'], 0, ',', '.') }}</div>
                    <div class="text-sm text-gray-600">Pending Revenue</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Daily Payment Trend -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Trend Pembayaran Harian</h3>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-sm text-gray-600">Transaksi</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-sm text-gray-600">Revenue</span>
                    </div>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="paymentTrendChart"></canvas>
            </div>
        </div>

        <!-- Payment Method Distribution -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Metode Pembayaran</h3>
            </div>
            <div class="space-y-6">
                @foreach($pembayaranPerMetode as $metode => $data)
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-900">
                            {{ $metode === 'transfer' ? 'Transfer Bank' : ($metode === 'qris' ? 'QRIS' : 'Cash') }}
                        </span>
                        <span class="text-sm text-gray-600">{{ $data->sum('total') }} transaksi</span>
                    </div>
                    <div class="space-y-1">
                        @foreach($data as $status)
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-500">
                                {{ ucfirst($status->status_bayar) }}: {{ $status->total }}
                            </span>
                            <span class="font-medium text-gray-700">
                                Rp {{ number_format($status->amount, 0, ',', '.') }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 rounded-full h-2"
                             style="width: {{ $stats['total_pembayaran'] > 0 ? ($data->sum('total') / $stats['total_pembayaran']) * 100 : 0 }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Payment Methods Stats -->
    <div class="admin-card p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Analisis Metode Pembayaran</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($pembayaranPerMetode as $metode => $data)
            <div class="p-6 {{ $metode === 'transfer' ? 'bg-blue-50' : ($metode === 'qris' ? 'bg-green-50' : 'bg-yellow-50') }} rounded-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 {{ $metode === 'transfer' ? 'bg-blue-100' : ($metode === 'qris' ? 'bg-green-100' : 'bg-yellow-100') }} rounded-lg flex items-center justify-center mr-4">
                        @if($metode === 'transfer')
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        @elseif($metode === 'qris')
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z"/>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <h4 class="font-semibold {{ $metode === 'transfer' ? 'text-blue-900' : ($metode === 'qris' ? 'text-green-900' : 'text-yellow-900') }}">
                            {{ $metode === 'transfer' ? 'Transfer Bank' : ($metode === 'qris' ? 'QRIS' : 'Cash') }}
                        </h4>
                        <p class="text-sm {{ $metode === 'transfer' ? 'text-blue-600' : ($metode === 'qris' ? 'text-green-600' : 'text-yellow-600') }}">
                            {{ $data->sum('total') }} transaksi
                        </p>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Total Amount:</span>
                        <span class="font-semibold">Rp {{ number_format($data->sum('amount'), 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Success Rate:</span>
                        <span class="font-semibold">
                            {{ $data->sum('total') > 0 ? number_format(($data->where('status_bayar', 'paid')->sum('total') / $data->sum('total')) * 100, 1) : 0 }}%
                        </span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Avg per Transaction:</span>
                        <span class="font-semibold">
                            Rp {{ $data->sum('total') > 0 ? number_format($data->sum('amount') / $data->sum('total'), 0, ',', '.') : 0 }}
                        </span>
                    </div>
                </div>

                <!-- Status breakdown -->
                <div class="mt-4 pt-4 border-t {{ $metode === 'transfer' ? 'border-blue-200' : ($metode === 'qris' ? 'border-green-200' : 'border-yellow-200') }}">
                    <div class="space-y-2">
                        @foreach($data as $status)
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-500 capitalize">{{ $status->status_bayar }}:</span>
                            <span class="font-medium">{{ $status->total }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Top Ranting Table -->
    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Top 10 Ranting - Revenue Tertinggi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ranking</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ranting</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Revenue</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avg per Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Performance</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($topRanting as $index => $ranting)
                    <tr class="{{ $index < 3 ? 'bg-yellow-50' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($index < 3)
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center
                                        {{ $index === 0 ? 'bg-yellow-100 text-yellow-600' :
                                           ($index === 1 ? 'bg-gray-100 text-gray-600' : 'bg-orange-100 text-orange-600') }}">
                                        @if($index === 0)
                                            🥇
                                        @elseif($index === 1)
                                            🥈
                                        @else
                                            🥉
                                        @endif
                                    </div>
                                @else
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-bold text-blue-600">{{ $index + 1 }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $ranting->nama_ranting }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $ranting->total_payments }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                            Rp {{ number_format($ranting->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ $ranting->total_payments > 0 ? number_format($ranting->total_amount / $ranting->total_payments, 0, ',', '.') : 0 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($ranting->total_amount >= 500000)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Excellent
                                </span>
                            @elseif($ranting->total_amount >= 200000)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Good
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Average
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Summary Section -->
    <div class="admin-card p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Ringkasan Periode ({{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }})</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="text-center p-6 bg-blue-50 rounded-lg">
                <div class="text-3xl font-bold text-blue-600">
                    {{ $stats['total_pembayaran'] > 0 ? round(($stats['pembayaran_lunas'] / $stats['total_pembayaran']) * 100, 1) : 0 }}%
                </div>
                <div class="text-sm text-gray-600 mt-1">Success Rate</div>
                <div class="text-xs text-gray-500">Pembayaran berhasil</div>
            </div>
            <div class="text-center p-6 bg-green-50 rounded-lg">
                <div class="text-3xl font-bold text-green-600">
                    Rp {{ $stats['total_pembayaran'] > 0 ? number_format($stats['total_revenue'] / $stats['total_pembayaran'], 0, ',', '.') : 0 }}
                </div>
                <div class="text-sm text-gray-600 mt-1">Avg Transaction</div>
                <div class="text-xs text-gray-500">Rata-rata per transaksi</div>
            </div>
            <div class="text-center p-6 bg-purple-50 rounded-lg">
                <div class="text-3xl font-bold text-purple-600">
                    {{ $stats['pembayaran_gagal'] }}
                </div>
                <div class="text-sm text-gray-600 mt-1">Failed Transactions</div>
                <div class="text-xs text-gray-500">Pembayaran gagal/ditolak</div>
            </div>
            <div class="text-center p-6 bg-indigo-50 rounded-lg">
                <div class="text-3xl font-bold text-indigo-600">
                    {{ count($trendPembayaran) }}
                </div>
                <div class="text-sm text-gray-600 mt-1">Active Days</div>
                <div class="text-xs text-gray-500">Hari dengan transaksi</div>
            </div>
        </div>

        <!-- Insights -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h4 class="text-md font-semibold text-gray-900 mb-4">💡 Key Insights</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-blue-50 rounded-lg">
                    <h5 class="font-semibold text-blue-900 mb-2">Metode Pembayaran Terpopuler</h5>
                    @php
                        $topMethod = $pembayaranPerMetode->sortByDesc(function($data) { return $data->sum('total'); })->first();
                        $methodName = $pembayaranPerMetode->keys()->first();
                    @endphp
                    <p class="text-sm text-blue-800">
                        {{ $methodName === 'transfer' ? 'Transfer Bank' : ($methodName === 'qris' ? 'QRIS' : 'Cash') }}
                        mendominasi dengan {{ $topMethod ? $topMethod->sum('total') : 0 }} transaksi
                        ({{ $stats['total_pembayaran'] > 0 ? round(($topMethod ? $topMethod->sum('total') : 0) / $stats['total_pembayaran'] * 100, 1) : 0 }}%)
                    </p>
                </div>

                <div class="p-4 bg-green-50 rounded-lg">
                    <h5 class="font-semibold text-green-900 mb-2">Revenue Performance</h5>
                    <p class="text-sm text-green-800">
                        Total revenue mencapai Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                        dengan success rate {{ $stats['total_pembayaran'] > 0 ? round(($stats['pembayaran_lunas'] / $stats['total_pembayaran']) * 100, 1) : 0 }}%.
                        {{ $stats['pending_revenue'] > 0 ? 'Masih ada Rp ' . number_format($stats['pending_revenue'], 0, ',', '.') . ' pending.' : 'Tidak ada revenue pending.' }}
                    </p>
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

    // Payment Trend Chart
    const trendCtx = document.getElementById('paymentTrendChart').getContext('2d');
    const trendData = @json($trendPembayaran);

    const trendLabels = trendData.map(item => new Date(item.date).toLocaleDateString('id-ID'));
    const trendCounts = trendData.map(item => item.count);
    const trendAmounts = trendData.map(item => item.amount / 1000); // Convert to thousands

    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [{
                label: 'Transaksi',
                data: trendCounts,
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 2,
                fill: false,
                tension: 0.4,
                yAxisID: 'y'
            }, {
                label: 'Revenue (Ribu)',
                data: trendAmounts,
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 2,
                fill: false,
                tension: 0.4,
                yAxisID: 'y1'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    beginAtZero: true,
                    grid: {
                        color: '#F3F4F6'
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: false,
                    },
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Auto refresh data setiap 5 menit
    setInterval(function() {
        if (document.visibilityState === 'visible') {
            fetch(window.location.href)
                .then(response => response.text())
                .then(html => {
                    // Update stats cards jika ada perubahan
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // Update revenue numbers
                    const currentRevenue = document.querySelector('.text-green-600').textContent;
                    const newRevenue = doc.querySelector('.text-green-600').textContent;

                    if (currentRevenue !== newRevenue) {
                        // Show update notification
                        showNotification('Data pembayaran telah diupdate', 'info');
                    }
                })
                .catch(error => console.log('Auto-refresh failed:', error));
        }
    }, 300000); // 5 minutes

    // Notification function
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
            type === 'info' ? 'bg-blue-500 text-white' :
            type === 'success' ? 'bg-green-500 text-white' :
            'bg-red-500 text-white'
        }`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Export functionality with loading
    document.querySelectorAll('a[href*="export"]').forEach(link => {
        link.addEventListener('click', function(e) {
            const button = this;
            const originalText = button.innerHTML;

            // Show loading state
            button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Mengunduh...
            `;
            button.style.pointerEvents = 'none';

            // Reset after 3 seconds
            setTimeout(() => {
                button.innerHTML = originalText;
                button.style.pointerEvents = 'auto';
            }, 3000);
        });
    });

    // Print functionality
    window.printReport = function() {
        window.print();
    };

    // Filter form enhancement
    const dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(input => {
        input.addEventListener('change', function() {
            const startDate = document.querySelector('input[name="start_date"]').value;
            const endDate = document.querySelector('input[name="end_date"]').value;

            if (startDate && endDate && new Date(startDate) > new Date(endDate)) {
                alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir');
                this.value = '';
            }
        });
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

.admin-btn-success {
    @apply inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200;
}

.admin-btn-danger {
    @apply inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200;
}

/* Print styles */
@media print {
    .no-print {
        display: none !important;
    }

    .admin-card {
        box-shadow: none !important;
        border: 1px solid #e5e7eb !important;
    }

    .chart-container {
        page-break-inside: avoid;
    }
}

/* Animation for cards */
.admin-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.admin-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Loading animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .chart-container {
        height: 250px;
    }

    .grid {
        gap: 1rem;
    }

    .admin-card {
        margin-bottom: 1rem;
    }
}

/* Custom scrollbar for tables */
.overflow-x-auto::-webkit-scrollbar {
    height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
