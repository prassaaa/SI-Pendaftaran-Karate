@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('admin.verifikasi.index') }}"
                   class="text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Verifikasi Pembayaran</h1>
            </div>
            <p class="text-gray-600">Detail pembayaran peserta: {{ $pembayaran->peserta->nama_lengkap }}</p>
        </div>
        <div class="flex space-x-3">
            @if($pembayaran->status_bayar === 'pending')
                <button onclick="approvePayment()" class="admin-btn-success">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Setujui
                </button>
                <button onclick="rejectPayment()" class="admin-btn-danger">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Tolak
                </button>
            @endif
        </div>
    </div>

    <!-- Status Alert -->
    @if($pembayaran->status_bayar === 'pending')
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800">Pembayaran Menunggu Verifikasi</h3>
                <p class="mt-1 text-sm text-yellow-700">Silakan periksa bukti pembayaran dan lakukan verifikasi.</p>
            </div>
        </div>
    </div>
    @elseif($pembayaran->status_bayar === 'paid')
    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">Pembayaran Sudah Diverifikasi</h3>
                <p class="mt-1 text-sm text-green-700">
                    Diverifikasi oleh {{ $pembayaran->verifiedBy->name }} pada {{ $pembayaran->verified_at->format('d/m/Y H:i') }}
                </p>
            </div>
        </div>
    </div>
    @else
    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Pembayaran Ditolak</h3>
                <p class="mt-1 text-sm text-red-700">
                    @if($pembayaran->keterangan)
                        Alasan: {{ $pembayaran->keterangan }}
                    @endif
                </p>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Payment Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Payment Information -->
            <div class="admin-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Pembayaran</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="info-item">
                            <label class="info-label">Kode Pembayaran</label>
                            <p class="info-value font-mono text-blue-600">{{ $pembayaran->kode_pembayaran }}</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Jumlah Bayar</label>
                            <p class="info-value text-2xl font-bold text-green-600">{{ $pembayaran->formatted_jumlah_bayar }}</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Metode Pembayaran</label>
                            <p class="info-value">{{ $pembayaran->metode_pembayaran_formatted }}</p>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Status</label>
                            <span class="badge badge-{{ $pembayaran->status_bayar === 'paid' ? 'success' : ($pembayaran->status_bayar === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($pembayaran->status_bayar) }}
                            </span>
                        </div>
                        @if($pembayaran->tanggal_bayar)
                        <div class="info-item">
                            <label class="info-label">Tanggal Bayar</label>
                            <p class="info-value">{{ $pembayaran->tanggal_bayar->format('d F Y, H:i') }} WIB</p>
                        </div>
                        @endif
                        <div class="info-item">
                            <label class="info-label">Tanggal Upload</label>
                            <p class="info-value">{{ $pembayaran->created_at->format('d F Y, H:i') }} WIB</p>
                        </div>
                        @if($pembayaran->tanggal_expired)
                        <div class="info-item">
                            <label class="info-label">Batas Waktu</label>
                            <p class="info-value {{ $pembayaran->isExpired() ? 'text-red-600' : 'text-green-600' }}">
                                {{ $pembayaran->tanggal_expired->format('d F Y, H:i') }} WIB
                                @if($pembayaran->isExpired())
                                    <span class="text-red-500 text-sm">(Expired)</span>
                                @endif
                            </p>
                        </div>
                        @endif
                        @if($pembayaran->keterangan)
                        <div class="info-item md:col-span-2">
                            <label class="info-label">Keterangan</label>
                            <p class="info-value">{{ $pembayaran->keterangan }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Participant Information -->
            <div class="admin-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Peserta</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-start space-x-6">
                        <!-- Photo -->
                        <div class="flex-shrink-0">
                            @if($pembayaran->peserta->foto_path)
                                <img src="{{ Storage::url($pembayaran->peserta->foto_path) }}"
                                     alt="Foto {{ $pembayaran->peserta->nama_lengkap }}"
                                     class="w-24 h-32 object-cover rounded-lg border-2 border-gray-200">
                            @else
                                <div class="w-24 h-32 bg-gray-200 rounded-lg border-2 border-gray-300 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Details -->
                        <div class="flex-1 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="info-item">
                                    <label class="info-label">Kode Pendaftaran</label>
                                    <p class="info-value font-mono text-blue-600">{{ $pembayaran->peserta->kode_pendaftaran }}</p>
                                </div>
                                <div class="info-item">
                                    <label class="info-label">Nama Lengkap</label>
                                    <p class="info-value font-semibold">{{ $pembayaran->peserta->nama_lengkap }}</p>
                                </div>
                                <div class="info-item">
                                    <label class="info-label">Ranting</label>
                                    <p class="info-value">{{ $pembayaran->peserta->ranting->nama_ranting }}</p>
                                </div>
                                <div class="info-item">
                                    <label class="info-label">Kategori Usia</label>
                                    <p class="info-value">{{ $pembayaran->peserta->kategoriUsia->nama_kategori }}</p>
                                </div>
                                <div class="info-item">
                                    <label class="info-label">No. Telepon</label>
                                    <p class="info-value">{{ $pembayaran->peserta->no_telepon }}</p>
                                </div>
                                <div class="info-item">
                                    <label class="info-label">Email</label>
                                    <p class="info-value">{{ $pembayaran->peserta->user->email }}</p>
                                </div>
                            </div>

                            <!-- Competition Categories -->
                            <div class="info-item">
                                <label class="info-label">Kategori Pertandingan</label>
                                <div class="flex flex-wrap gap-2 mt-1">
                                    @foreach($pembayaran->peserta->kategori_dipilih as $kategori)
                                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                            {{ $kategori }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <a href="{{ route('admin.peserta.show', $pembayaran->peserta->id) }}"
                               class="admin-btn-secondary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat Detail Peserta
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Proof -->
            @if($pembayaran->bukti_bayar_path)
            <div class="admin-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Bukti Pembayaran</h3>
                </div>
                <div class="p-6">
                    <div class="text-center">
                        @if(Str::endsWith($pembayaran->bukti_bayar_path, ['.jpg', '.jpeg', '.png', '.gif']))
                            <div class="max-w-md mx-auto">
                                <img src="{{ Storage::url($pembayaran->bukti_bayar_path) }}"
                                     alt="Bukti Pembayaran"
                                     class="w-full rounded-lg border-2 border-gray-200 shadow-lg cursor-pointer"
                                     onclick="openImageModal(this.src)">
                                <p class="text-sm text-gray-500 mt-2">Klik gambar untuk memperbesar</p>
                            </div>
                        @else
                            <div class="flex items-center justify-center w-32 h-32 bg-gray-100 rounded-lg mx-auto">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">File bukti pembayaran</p>
                        @endif

                        <div class="mt-4">
                            <a href="{{ Storage::url($pembayaran->bukti_bayar_path) }}"
                               target="_blank"
                               class="admin-btn-secondary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download Bukti
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Verification Actions -->
            @if($pembayaran->status_bayar === 'pending')
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Verifikasi</h3>
                <div class="space-y-3">
                    <button onclick="approvePayment()"
                            class="w-full admin-btn-success">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Setujui Pembayaran
                    </button>

                    <button onclick="rejectPayment()"
                            class="w-full admin-btn-danger">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Tolak Pembayaran
                    </button>
                </div>
            </div>
            @endif

            <!-- Verification History -->
            @if($pembayaran->verified_at)
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Riwayat Verifikasi</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-400 rounded-full mr-3"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Diverifikasi</p>
                            <p class="text-xs text-gray-500">{{ $pembayaran->verified_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-400 rounded-full mr-3"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Oleh: {{ $pembayaran->verifiedBy->name }}</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Payment Summary -->
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Status:</span>
                        <span class="font-medium {{ $pembayaran->status_bayar === 'paid' ? 'text-green-600' : ($pembayaran->status_bayar === 'pending' ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ ucfirst($pembayaran->status_bayar) }}
                        </span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Jumlah:</span>
                        <span class="font-semibold">{{ $pembayaran->formatted_jumlah_bayar }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Metode:</span>
                        <span>{{ $pembayaran->metode_pembayaran_formatted }}</span>
                    </div>
                    @if($pembayaran->tanggal_bayar)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Tanggal:</span>
                        <span>{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.peserta.show', $pembayaran->peserta->id) }}"
                       class="w-full admin-btn-secondary text-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Lihat Peserta
                    </a>

                    <a href="{{ route('admin.export.sertifikat', $pembayaran->peserta->id) }}"
                       class="w-full admin-btn-secondary text-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Sertifikat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-4 text-center">Setujui Pembayaran</h3>
            <form id="approveForm" method="POST" action="{{ route('admin.verifikasi.approve', $pembayaran->id) }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label">Keterangan (opsional)</label>
                    <textarea name="keterangan" rows="3" class="form-input"
                              placeholder="Tambahkan catatan verifikasi..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeApproveModal()" class="admin-btn-secondary">
                        Batal
                    </button>
                    <button type="submit" class="admin-btn-success">
                        Setujui Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-4 text-center">Tolak Pembayaran</h3>
            <form id="rejectForm" method="POST" action="{{ route('admin.verifikasi.reject', $pembayaran->id) }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label">Alasan Penolakan <span class="text-red-500">*</span></label>
                    <textarea name="reason" rows="4" class="form-input"
                              placeholder="Berikan alasan penolakan..." required></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeRejectModal()" class="admin-btn-secondary">
                        Batal
                    </button>
                    <button type="submit" class="admin-btn-danger">
                        Tolak Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeImageModal()"
                    class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <img id="modalImage" src="" alt="Bukti Pembayaran" class="max-w-full max-h-full rounded-lg">
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function approvePayment() {
        document.getElementById('approveModal').classList.remove('hidden');
    }

    function closeApproveModal() {
        document.getElementById('approveModal').classList.add('hidden');
        document.getElementById('approveForm').reset();
    }

    function rejectPayment() {
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectForm').reset();
    }

    function openImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    // Form submissions
    document.getElementById('approveForm').addEventListener('submit', function(e) {
        e.preventDefault();
        showLoading();
        this.submit();
    });

    document.getElementById('rejectForm').addEventListener('submit', function(e) {
        e.preventDefault();
        showLoading();
        this.submit();
    });

    // Close modals when clicking outside
    document.getElementById('approveModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeApproveModal();
        }
    });

    document.getElementById('rejectModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRejectModal();
        }
    });

    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeApproveModal();
            closeRejectModal();
            closeImageModal();
        }
    });

    function showLoading() {
        const buttons = document.querySelectorAll('button[type="submit"]');
        buttons.forEach(btn => {
            btn.disabled = true;
            btn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Processing...';
        });
    }
</script>
@endpush

<style>
.admin-card {
    @apply bg-white rounded-xl shadow-sm border border-gray-200;
}

.info-item {
    @apply space-y-1;
}

.info-label {
    @apply text-sm font-medium text-gray-500;
}

.info-value {
    @apply text-gray-900 font-medium;
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

.admin-btn-secondary {
    @apply inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200;
}

.admin-btn-success {
    @apply inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200;
}

.admin-btn-danger {
    @apply inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200;
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

/* Animation */
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
