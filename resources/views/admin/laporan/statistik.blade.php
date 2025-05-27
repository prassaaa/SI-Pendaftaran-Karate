@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Statistik Keseluruhan</h1>
            <p class="text-gray-600 mt-1">Overview lengkap sistem pendaftaran karate INKAI Kediri</p>
        </div>
        <div class="flex space-x-3">
            <button onclick="window.print()" class="admin-btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Print
            </button>
        </div>
    </div>

    <!-- General Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">
        <div class="admin-card p-6 text-center">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <div class="text-2xl font-bold text-gray-900">{{ $generalStats['total_peserta'] }}</div>
            <div class="text-sm text-gray-600">Total Peserta</div>
        </div>

        <div class="admin-card p-6 text-center">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div class="text-2xl font-bold text-gray-900">{{ $generalStats['total_ranting'] }}</div>
            <div class="text-sm text-gray-600">Ranting Terdaftar</div>
        </div>

        <div class="admin-card p-6 text-center">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="text-2xl font-bold text-gray-900">{{ $generalStats['total_kategori'] }}</div>
            <div class="text-sm text-gray-600">Kategori Usia</div>
        </div>

        <div class="admin-card p-6 text-center">
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                </svg>
            </div>
            <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($generalStats['total_revenue'], 0, ',', '.') }}</div>
            <div class="text-sm text-gray-600">Total Revenue</div>
        </div>

        <div class="admin-card p-6 text-center">
            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div class="text-2xl font-bold text-gray-900">{{ $generalStats['avg_age'] }}</div>
            <div class="text-sm text-gray-600">Rata-rata Umur</div>
        </div>

        <div class="admin-card p-6 text-center">
            <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <div class="text-2xl font-bold text-gray-900">{{ $generalStats['conversion_rate'] }}%</div>
            <div class="text-sm text-gray-600">Conversion Rate</div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Registration Trend -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Trend Pendaftaran (6 Bulan Terakhir)</h3>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Pendaftaran</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="registrationTrendChart"></canvas>
            </div>
        </div>

        <!-- Gender Distribution -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Distribusi Jenis Kelamin</h3>
            </div>
            <div class="chart-container">
                <canvas id="genderChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Age Distribution and Payment Methods -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Age Distribution -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Distribusi Kategori Usia</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($ageDistribution as $age)
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-medium text-gray-900">{{ $age->nama_kategori }}</span>
                                <span class="text-sm text-gray-600">{{ $age->peserta_count }} peserta</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full"
                                     style="width: {{ $generalStats['total_peserta'] > 0 ? ($age->peserta_count / $generalStats['total_peserta']) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Metode Pembayaran</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($paymentMethods as $method)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-3
                                {{ $method->metode_pembayaran === 'transfer' ? 'bg-blue-500' :
                                   ($method->metode_pembayaran === 'qris' ? 'bg-green-500' : 'bg-yellow-500') }}">
                            </div>
                            <span class="text-sm font-medium text-gray-900">
                                {{ $method->metode_pembayaran === 'transfer' ? 'Transfer Bank' :
                                   ($method->metode_pembayaran === 'qris' ? 'QRIS' : 'Cash') }}
                            </span>
                        </div>
                        <div class="text-right">
                            <div class="text-sm font-semibold text-gray-900">{{ $method->total }}</div>
                            <div class="text-xs text-gray-500">
                                {{ $paymentMethods->sum('total') > 0 ? round(($method->total / $paymentMethods->sum('total')) * 100, 1) : 0 }}%
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Top Performing Ranting -->
    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Top 10 Ranting Terbaik</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ranking</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ranting</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Peserta</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($topRanting as $index => $ranting)
                    <tr>
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
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $ranting->nama_ranting }}</div>
                            <div class="text-sm text-gray-500">{{ $ranting->kota }}, {{ $ranting->provinsi }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $ranting->peserta_count }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $generalStats['total_peserta'] > 0 ? round(($ranting->peserta_count / $generalStats['total_peserta']) * 100, 1) : 0 }}%
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($ranting->peserta_count >= 10)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Excellent
                                </span>
                            @elseif($ranting->peserta_count >= 5)
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

    <!-- Status Distribution -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Registration Status -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Status Pendaftaran</h3>
            <div class="space-y-4">
                @foreach($statusDistribution['pendaftaran'] as $status)
                <div class="flex items-center justify-between p-4 rounded-lg
                    {{ $status->status_pendaftaran === 'approved' ? 'bg-green-50' :
                       ($status->status_pendaftaran === 'pending' ? 'bg-yellow-50' : 'bg-red-50') }}">
                    <div class="flex items-center">
                        <div class="w-4 h-4 rounded-full mr-3
                            {{ $status->status_pendaftaran === 'approved' ? 'bg-green-500' :
                               ($status->status_pendaftaran === 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                        </div>
                        <span class="font-medium text-gray-900">{{ ucfirst($status->status_pendaftaran) }}</span>
                    </div>
                    <div class="text-right">
                        <div class="text-lg font-bold text-gray-900">{{ $status->total }}</div>
                        <div class="text-sm text-gray-500">
                            {{ $generalStats['total_peserta'] > 0 ? round(($status->total / $generalStats['total_peserta']) * 100, 1) : 0 }}%
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Payment Status -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Status Pembayaran</h3>
            <div class="space-y-4">
                @foreach($statusDistribution['pembayaran'] as $status)
                <div class="flex items-center justify-between p-4 rounded-lg
                    {{ $status->status_bayar === 'paid' ? 'bg-green-50' :
                       ($status->status_bayar === 'pending' ? 'bg-yellow-50' : 'bg-red-50') }}">
                    <div class="flex items-center">
                        <div class="w-4 h-4 rounded-full mr-3
                            {{ $status->status_bayar === 'paid' ? 'bg-green-500' :
                               ($status->status_bayar === 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                        </div>
                        <span class="font-medium text-gray-900">{{ ucfirst($status->status_bayar) }}</span>
                    </div>
                    <div class="text-right">
                        <div class="text-lg font-bold text-gray-900">{{ $status->total }}</div>
                        <div class="text-sm text-gray-500">
                            {{ $generalStats['total_peserta'] > 0 ? round(($status->total / $generalStats['total_peserta']) * 100, 1) : 0 }}%
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Key Insights -->
    <div class="admin-card p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Key Insights & Recommendations</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Insight 1: Registration Performance -->
            <div class="p-4 bg-blue-50 rounded-lg">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-blue-900">Performa Pendaftaran</h4>
                </div>
                <p class="text-sm text-blue-800 mb-2">
                    Conversion rate {{ $generalStats['conversion_rate'] }}% menunjukkan
                    {{ $generalStats['conversion_rate'] >= 80 ? 'performa sangat baik' :
                       ($generalStats['conversion_rate'] >= 60 ? 'performa baik' : 'masih perlu ditingkatkan') }}.
                </p>
                <div class="text-xs text-blue-600">
                    📈 {{ $generalStats['total_peserta'] }} peserta terdaftar dari {{ $generalStats['total_ranting'] }} ranting
                </div>
            </div>

            <!-- Insight 2: Age Demographics -->
            <div class="p-4 bg-green-50 rounded-lg">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-green-900">Demografi Usia</h4>
                </div>
                <p class="text-sm text-green-800 mb-2">
                    Rata-rata usia peserta {{ $generalStats['avg_age'] }} tahun.
                    Kategori terpopuler: {{ $ageDistribution->sortByDesc('peserta_count')->first()->nama_kategori ?? 'N/A' }}.
                </p>
                <div class="text-xs text-green-600">
                    👥 {{ $generalStats['total_kategori'] }} kategori usia tersedia
                </div>
            </div>

            <!-- Insight 3: Revenue Performance -->
            <div class="p-4 bg-purple-50 rounded-lg">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-purple-900">Performa Revenue</h4>
                </div>
                <p class="text-sm text-purple-800 mb-2">
                    Total revenue Rp {{ number_format($generalStats['total_revenue'], 0, ',', '.') }}.
                    Rata-rata per peserta: Rp {{ $generalStats['total_peserta'] > 0 ? number_format($generalStats['total_revenue'] / $generalStats['total_peserta'], 0, ',', '.') : 0 }}.
                </p>
                <div class="text-xs text-purple-600">
                    💰 Target revenue tercapai
                </div>
            </div>
        </div>

        <!-- Recommendations -->
        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <h4 class="font-semibold text-gray-900 mb-3">📋 Rekomendasi Strategis</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                <div>
                    <strong>Peningkatan Partisipasi:</strong>
                    <ul class="list-disc list-inside mt-1 space-y-1">
                        <li>Focus pada ranting dengan partisipasi rendah</li>
                        <li>Program promosi untuk kategori usia tertentu</li>
                        <li>Kerjasama dengan sekolah dan komunitas</li>
                    </ul>
                </div>
                <div>
                    <strong>Optimasi Proses:</strong>
                    <ul class="list-disc list-inside mt-1 space-y-1">
                        <li>Streamline proses verifikasi pembayaran</li>
                        <li>Implementasi reminder otomatis</li>
                        <li>Digitalisasi dokumentasi</li>
                    </ul>
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
                        stepSize: 1
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

    // Gender Distribution Chart
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    const genderData = @json($genderDistribution);

    const genderLabels = genderData.map(item => item.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
    const genderValues = genderData.map(item => item.total);

    new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: genderLabels,
            datasets: [{
                data: genderValues,
                backgroundColor: [
                    '#3B82F6',
                    '#EC4899'
                ],
                borderWidth: 0,
                cutout: '60%'
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
                        pointStyle: 'circle'
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

.admin-btn-secondary {
    @apply inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200;
}

@media print {
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

    .no-print {
        display: none !important;
    }
}
</style>
