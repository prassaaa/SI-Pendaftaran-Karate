@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}!</h1>
                <p class="text-blue-100">Kelola sistem pendaftaran karate INKAI Kediri dengan mudah</p>
            </div>
            <div class="hidden md:block">
                <div class="flex items-center space-x-4 text-sm">
                    <div class="text-center">
                        <div class="text-2xl font-bold">{{ now()->format('d') }}</div>
                        <div class="text-blue-200">{{ now()->format('M Y') }}</div>
                    </div>
                    <div class="w-px h-12 bg-blue-400"></div>
                    <div>
                        <div class="font-semibold">{{ now()->format('l') }}</div>
                        <div class="text-blue-200">{{ now()->format('H:i') }} WIB</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Peserta -->
        <div class="stat-card group hover:scale-105 transition-transform duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <div class="stat-value text-blue-600" data-stat="total_peserta">{{ $stats['total_peserta'] }}</div>
                    <div class="stat-label">Total Peserta</div>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.peserta.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                    Lihat semua →
                </a>
            </div>
        </div>

        <!-- Pending Approval -->
        <div class="stat-card group hover:scale-105 transition-transform duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center group-hover:bg-yellow-200 transition-colors duration-200">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <div class="stat-value text-yellow-600" data-stat="peserta_pending">{{ $stats['peserta_pending'] }}</div>
                    <div class="stat-label">Menunggu Persetujuan</div>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.peserta.index', ['status_pendaftaran' => 'pending']) }}" class="text-sm text-yellow-600 hover:text-yellow-800 font-medium">
                    Review sekarang →
                </a>
            </div>
        </div>

        <!-- Pending Payment -->
        <div class="stat-card group hover:scale-105 transition-transform duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-200 transition-colors duration-200">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <div class="stat-value text-red-600" data-stat="pembayaran_pending">{{ $stats['pembayaran_pending'] }}</div>
                    <div class="stat-label">Verifikasi Pembayaran</div>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.verifikasi.index') }}" class="text-sm text-red-600 hover:text-red-800 font-medium">
                    Verifikasi sekarang →
                </a>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="stat-card group hover:scale-105 transition-transform duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <div class="stat-value text-green-600">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
                    <div class="stat-label">Total Revenue</div>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.laporan.keuangan') }}" class="text-sm text-green-600 hover:text-green-800 font-medium">
                    Lihat laporan →
                </a>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Monthly Registration Chart -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Pendaftaran per Bulan</h3>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Peserta</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>

        <!-- Payment Status Chart -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Status Pembayaran</h3>
                <button onclick="refreshPaymentChart()" class="text-sm text-blue-600 hover:text-blue-800">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Refresh
                </button>
            </div>
            <div class="chart-container">
                <canvas id="paymentChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Registrations -->
        <div class="admin-card">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Pendaftaran Terbaru</h3>
                    <a href="{{ route('admin.peserta.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        Lihat semua
                    </a>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($recentPeserta as $peserta)
                <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-blue-600">
                                    {{ substr($peserta->nama_lengkap, 0, 1) }}
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ $peserta->nama_lengkap }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $peserta->ranting->nama_ranting }}
                            </p>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="badge badge-{{ $peserta->status_pendaftaran === 'pending' ? 'warning' : ($peserta->status_pendaftaran === 'approved' ? 'success' : 'danger') }}">
                                {{ ucfirst($peserta->status_pendaftaran) }}
                            </span>
                            <span class="text-xs text-gray-500 mt-1">
                                {{ $peserta->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <p>Belum ada pendaftaran</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Pending Payments -->
        <div class="admin-card">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Pembayaran Menunggu Verifikasi</h3>
                    <a href="{{ route('admin.verifikasi.index') }}" class="text-sm text-red-600 hover:text-red-800">
                        Verifikasi semua
                    </a>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($pendingPayments as $payment)
                <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ $payment->peserta->nama_lengkap }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $payment->formatted_jumlah_bayar }} - {{ $payment->metode_pembayaran_formatted }}
                            </p>
                        </div>
                        <div class="flex flex-col items-end">
                            <a href="{{ route('admin.verifikasi.show', $payment->id) }}"
                               class="text-sm bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition-colors duration-200">
                                Verifikasi
                            </a>
                            <span class="text-xs text-gray-500 mt-1">
                                {{ $payment->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p>Semua pembayaran sudah diverifikasi</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="admin-card p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.peserta.index', ['status_pendaftaran' => 'pending']) }}"
               class="flex flex-col items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors duration-200 group">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-3 group-hover:bg-yellow-200">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900">Review Pendaftaran</span>
                @if($stats['peserta_pending'] > 0)
                    <span class="text-xs text-yellow-600 mt-1">{{ $stats['peserta_pending'] }} pending</span>
                @endif
            </a>

            <a href="{{ route('admin.verifikasi.index') }}"
               class="flex flex-col items-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-200 group">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-3 group-hover:bg-red-200">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900">Verifikasi Bayar</span>
                @if($stats['pembayaran_pending'] > 0)
                    <span class="text-xs text-red-600 mt-1">{{ $stats['pembayaran_pending'] }} pending</span>
                @endif
            </a>

            <a href="{{ route('admin.export.peserta.excel') }}"
               class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors duration-200 group">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-3 group-hover:bg-green-200">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900">Export Data</span>
                <span class="text-xs text-green-600 mt-1">Excel/PDF</span>
            </a>

            <a href="{{ route('admin.laporan.statistik') }}"
               class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200 group">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-3 group-hover:bg-blue-200">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900">Lihat Statistik</span>
                <span class="text-xs text-blue-600 mt-1">Analitik</span>
            </a>
        </div>
    </div>

    <!-- Top Ranting -->
    <div class="admin-card p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Top 5 Ranting</h3>
            <a href="{{ route('admin.laporan.peserta') }}" class="text-sm text-blue-600 hover:text-blue-800">
                Lihat laporan lengkap →
            </a>
        </div>
        <div class="space-y-4">
            @foreach($pesertaPerRanting->take(5) as $index => $data)
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                    <span class="text-sm font-bold text-blue-600">{{ $index + 1 }}</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-900">{{ $data['ranting'] }}</span>
                        <span class="text-sm font-bold text-gray-700">{{ $data['total'] }} peserta</span>
                    </div>
                    <div class="mt-1 bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 rounded-full h-2"
                             style="width: {{ ($data['total'] / $pesertaPerRanting->first()['total']) * 100 }}%"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Chart.js configurations
    Chart.defaults.font.family = 'Inter';
    Chart.defaults.color = '#6B7280';

    // Monthly Registration Chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyData = @json($monthlyRegistrations);

    // Convert PHP data to Chart.js format
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const monthlyLabels = [];
    const monthlyValues = [];

    for (let i = 1; i <= 12; i++) {
        monthlyLabels.push(months[i - 1]);
        monthlyValues.push(monthlyData[i] || 0);
    }

    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Pendaftaran',
                data: monthlyValues,
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
            },
            elements: {
                point: {
                    hoverBackgroundColor: '#1D4ED8'
                }
            }
        }
    });

    // Payment Status Chart
    const paymentCtx = document.getElementById('paymentChart').getContext('2d');
    const paymentData = @json($paymentStatus);

    new Chart(paymentCtx, {
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

    // Refresh payment chart
    window.refreshPaymentChart = function() {
        fetch('{{ route("admin.chart-data") }}?type=payment')
            .then(response => response.json())
            .then(data => {
                // Update chart data
                showToast('Chart data updated', 'success');
            })
            .catch(error => {
                showToast('Failed to refresh chart', 'error');
            });
    };

    // Real-time updates
    setInterval(function() {
        // Update stats every 30 seconds
        fetch('/admin/api/quick-stats')
            .then(response => response.json())
            .then(data => {
                Object.keys(data).forEach(key => {
                    const element = document.querySelector(`[data-stat="${key}"]`);
                    if (element && element.textContent != data[key]) {
                        element.textContent = data[key];
                        element.classList.add('animate-pulse');
                        setTimeout(() => element.classList.remove('animate-pulse'), 1000);
                    }
                });
            })
            .catch(error => console.log('Stats update failed:', error));
    }, 30000);

    // Initialize tooltips and animations
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to cards on scroll
        const cards = document.querySelectorAll('.stat-card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-slide-up');
                }
            });
        });

        cards.forEach(card => observer.observe(card));
    });

    // Dashboard refresh function
    window.refreshDashboard = function() {
        showLoading();
        location.reload();
    };
</script>
@endpush
