@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg p-6 text-white mb-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl md:text-3xl font-bold mb-2">
                        Selamat Datang, {{ $peserta->nama_lengkap }}!
                    </h1>
                    <p class="text-blue-100 text-lg">
                        Kode Pendaftaran: <span class="font-semibold bg-white bg-opacity-20 px-3 py-1 rounded-lg">{{ $peserta->kode_pendaftaran }}</span>
                    </p>
                </div>
                <div class="flex flex-col items-end space-y-2">
                    <div class="flex items-center space-x-3">
                        <span class="badge badge-{{ $peserta->status_pendaftaran === 'approved' ? 'success' : ($peserta->status_pendaftaran === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($peserta->status_pendaftaran) }}
                        </span>
                        <span class="badge badge-{{ $peserta->status_bayar === 'paid' ? 'success' : ($peserta->status_bayar === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($peserta->status_bayar) }}
                        </span>
                    </div>
                    <p class="text-blue-200 text-sm">
                        Terdaftar {{ $peserta->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Registration Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-{{ $peserta->status_pendaftaran === 'approved' ? 'green' : ($peserta->status_pendaftaran === 'pending' ? 'yellow' : 'red') }}-100 rounded-lg flex items-center justify-center">
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

<!-- Payment Upload Modal -->
<div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Upload Bukti Pembayaran</h3>
                <button onclick="closePaymentModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('peserta.upload-bukti') }}" enctype="multipart/form-data" id="paymentForm">
                @csrf

                <!-- Payment Amount -->
                <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-blue-800">Total yang harus dibayar:</span>
                        <span class="text-xl font-bold text-blue-600">{{ $peserta->formatted_total_biaya }}</span>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="mb-4">
                    <label class="form-label">Metode Pembayaran <span class="text-red-500">*</span></label>
                    <select name="metode_pembayaran" class="form-select" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="qris">QRIS</option>
                        <option value="cash">Bayar Tunai</option>
                    </select>
                </div>

                <!-- Payment Date -->
                <div class="mb-4">
                    <label class="form-label">Tanggal Pembayaran <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_bayar" class="form-input" value="{{ date('Y-m-d') }}" required>
                </div>

                <!-- File Upload -->
                <div class="mb-4">
                    <label class="form-label">Bukti Pembayaran <span class="text-red-500">*</span></label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="text-sm text-gray-600">
                                <label for="bukti_bayar" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                    <span>Pilih file</span>
                                    <input id="bukti_bayar" name="bukti_bayar" type="file" accept="image/*,application/pdf" class="sr-only" required>
                                </label>
                                <span class="pl-1">atau drag and drop</span>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, PDF hingga 5MB</p>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mb-6">
                    <label class="form-label">Keterangan (opsional)</label>
                    <textarea name="keterangan" rows="3" class="form-input" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>

                <!-- Bank Info -->
                <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <h4 class="font-semibold text-yellow-900 mb-2">Informasi Rekening</h4>
                    <div class="text-sm text-yellow-800 space-y-1">
                        <p><strong>BCA:</strong> 1234567890 a.n. INKAI Kediri</p>
                        <p><strong>Mandiri:</strong> 0987654321 a.n. INKAI Kediri</p>
                        <p><strong>QRIS:</strong> Scan QR Code yang tersedia</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex space-x-3">
                    <button type="button" onclick="closePaymentModal()" class="flex-1 admin-btn-secondary">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 admin-btn-primary">
                        Upload Bukti Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function showPaymentModal() {
        document.getElementById('paymentModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closePaymentModal() {
        document.getElementById('paymentModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Payment form submission
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Konfirmasi Upload',
            text: 'Apakah Anda yakin data pembayaran sudah benar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3B82F6',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Upload!',
            cancelButtonText: 'Periksa Lagi'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();
                this.submit();
            }
        });
    });

    // File upload preview
    document.getElementById('bukti_bayar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                showToast('Ukuran file maksimal 5MB!', 'error');
                this.value = '';
                return;
            }

            showToast('File berhasil dipilih: ' + file.name, 'success');
        }
    });

    // Auto refresh notifications
    setInterval(function() {
        fetch('/peserta/api/notifications-count')
            .then(response => response.json())
            .then(data => {
                if (data.unread > 0) {
                    // Update notification badge
                    const badge = document.querySelector('.notification-badge');
                    if (badge) {
                        badge.textContent = data.unread;
                        badge.classList.remove('hidden');
                    }
                }
            })
            .catch(error => console.log('Notification check failed:', error));
    }, 30000); // Check every 30 seconds

    // Mark notification as read when clicked
    document.querySelectorAll('.notification-item').forEach(item => {
        item.addEventListener('click', function() {
            const notificationId = this.dataset.id;
            if (notificationId) {
                fetch(`/peserta/notifications/${notificationId}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
            }
        });
    });

    // Auto-refresh payment status
    if ('{{ $peserta->status_bayar }}' === 'pending') {
        setInterval(function() {
            fetch('/peserta/api/payment-status')
                .then(response => response.json())
                .then(data => {
                    if (data.status !== 'pending') {
                        location.reload();
                    }
                })
                .catch(error => console.log('Payment status check failed:', error));
        }, 60000); // Check every minute
    }

    // Close modal when clicking outside
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
    });
</script>
@endpush
                        </div>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold text-gray-900">Status Pendaftaran</h2>
                        <p class="text-sm text-gray-600">
                            @if($peserta->status_pendaftaran === 'approved')
                                Pendaftaran Anda telah disetujui
                            @elseif($peserta->status_pendaftaran === 'pending')
                                Menunggu persetujuan admin
                            @else
                                Pendaftaran ditolak
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Payment Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-{{ $peserta->status_bayar === 'paid' ? 'green' : ($peserta->status_bayar === 'pending' ? 'yellow' : 'red') }}-100 rounded-lg flex items-center justify-center">
                            @if($peserta->status_bayar === 'paid')
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            @elseif($peserta->status_bayar === 'pending')
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
                        <h2 class="text-lg font-semibold text-gray-900">Status Pembayaran</h2>
                        <p class="text-sm text-gray-600">
                            @if($peserta->status_bayar === 'paid')
                                Pembayaran telah lunas
                            @elseif($peserta->status_bayar === 'pending')
                                Menunggu verifikasi
                            @else
                                Belum dibayar
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Total Cost -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold text-gray-900">Total Biaya</h2>
                        <p class="text-2xl font-bold text-blue-600">{{ $peserta->formatted_total_biaya }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Personal Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Informasi Pribadi
                    </h3>
                </div>
                <div class="p-6">
                    <!-- Photo -->
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-20 h-24 bg-gray-200 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center">
                            @if($peserta->foto_path)
                                <img src="{{ Storage::url($peserta->foto_path) }}" alt="Foto" class="w-full h-full object-cover rounded-lg">
                            @else
                                <div class="text-center">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span class="text-xs text-gray-500">Foto</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $peserta->nama_lengkap }}</h4>
                            <p class="text-sm text-gray-600">{{ $peserta->tempat_tanggal_lahir }}</p>
                            <p class="text-sm text-gray-600">{{ $peserta->umur }} tahun</p>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="space-y-3">
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Jenis Kelamin</span>
                            <span class="text-sm font-medium">{{ $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Golongan Darah</span>
                            <span class="text-sm font-medium">{{ $peserta->golongan_darah }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Berat Badan</span>
                            <span class="text-sm font-medium">{{ $peserta->berat_badan }} KG</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">No. Telepon</span>
                            <span class="text-sm font-medium">{{ $peserta->no_telepon }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Ranting</span>
                            <span class="text-sm font-medium">{{ $peserta->ranting->nama_ranting }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-sm text-gray-600">Kategori Usia</span>
                            <span class="text-sm font-medium">{{ $peserta->kategoriUsia->nama_kategori }}</span>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <div class="mt-6">
                        <a href="{{ route('peserta.profile.edit') }}"
                           class="w-full admin-btn-secondary text-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Competition Categories & Payment -->
            <div class="space-y-6">
                <!-- Categories -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Kategori Pertandingan
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @foreach($peserta->kategori_dipilih as $kategori)
                            <div class="flex items-center justify-between py-2 px-3 bg-green-50 rounded-lg">
                                <span class="text-green-800 font-medium">{{ $kategori }}</span>
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z"/>
                            </svg>
                            Pembayaran
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($latestPembayaran)
                        <!-- Payment Info -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600">Kode Pembayaran</span>
                                <span class="text-sm font-medium font-mono">{{ $latestPembayaran->kode_pembayaran }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600">Jumlah</span>
                                <span class="text-sm font-medium">{{ $latestPembayaran->formatted_jumlah_bayar }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600">Metode</span>
                                <span class="text-sm font-medium">{{ $latestPembayaran->metode_pembayaran_formatted }}</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-sm text-gray-600">Status</span>
                                <span class="badge badge-{{ $latestPembayaran->status_bayar === 'paid' ? 'success' : ($latestPembayaran->status_bayar === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($latestPembayaran->status_bayar) }}
                                </span>
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        @if($peserta->status_bayar === 'unpaid')
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <p class="text-red-700 text-sm font-medium">
                                    Silakan lakukan pembayaran untuk menyelesaikan pendaftaran
                                </p>
                            </div>
                        </div>

                        <button onclick="showPaymentModal()"
                                class="w-full admin-btn-primary mb-3">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Upload Bukti Pembayaran
                        </button>
                        @elseif($peserta->status_bayar === 'pending')
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <p class="text-yellow-700 text-sm font-medium">
                                    Pembayaran Anda sedang diverifikasi oleh admin
                                </p>
                            </div>
                        </div>
                        @else
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <p class="text-green-700 text-sm font-medium">
                                    Pembayaran telah lunas. Pendaftaran Anda selesai!
                                </p>
                            </div>
                        </div>
                        @endif

                        <!-- Download Buttons -->
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('peserta.download-invoice') }}"
                               class="admin-btn-secondary text-center text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Invoice
                            </a>
                            <a href="{{ route('peserta.download-formulir') }}"
                               class="admin-btn-secondary text-center text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Formulir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        @if($notifications->count() > 0)
        <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        Notifikasi Terbaru
                    </h3>
                    @if($unreadCount > 0)
                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $unreadCount }} baru
                        </span>
                    @endif
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($notifications as $notification)
                <div class="p-6 hover:bg-gray-50 {{ $notification->read_at ? '' : 'bg-blue-50' }}">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-{{ $notification->type === 'success' ? 'green' : ($notification->type === 'warning' ? 'yellow' : 'blue') }}-100 rounded-full flex items-center justify-center">
                                @if($notification->type === 'success')
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                @elseif($notification->type === 'warning')
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900">{{ $notification->title }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
                            <p class="text-xs text-gray-400 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        @if(!$notification->read_at)
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
