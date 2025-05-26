@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('admin.peserta.index') }}"
                   class="text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Detail Peserta</h1>
            </div>
            <p class="text-gray-600">Informasi lengkap peserta kejuaraan</p>
        </div>
        <div class="flex space-x-3">
            @if($peserta->status_pendaftaran === 'pending')
                <button onclick="confirmAction('{{ route('admin.peserta.approve', $peserta->id) }}', 'Setujui peserta ini?')"
                        class="admin-btn-success">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Setujui
                </button>
                <button onclick="rejectPeserta()" class="admin-btn-danger">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Tolak
                </button>
            @endif
            <a href="{{ route('admin.peserta.edit', $peserta->id) }}" class="admin-btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
        </div>
    </div>

    <!-- Status Alert -->
    @if($peserta->status_pendaftaran === 'pending')
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800">Pendaftaran Menunggu Persetujuan</h3>
                <p class="mt-1 text-sm text-yellow-700">Peserta ini masih menunggu persetujuan admin untuk melanjutkan ke tahap pembayaran.</p>
            </div>
        </div>
    </div>
    @elseif($peserta->status_pendaftaran === 'approved')
    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">Pendaftaran Disetujui</h3>
                <p class="mt-1 text-sm text-green-700">Peserta telah disetujui dan dapat melanjutkan proses pembayaran.</p>
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
                <h3 class="text-sm font-medium text-red-800">Pendaftaran Ditolak</h3>
                <p class="mt-1 text-sm text-red-700">Pendaftaran peserta ini telah ditolak.</p>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Personal Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info -->
            <div class="admin-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Pribadi</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-start space-x-6">
                        <!-- Photo -->
                        <div class="flex-shrink-0">
                            @if($peserta->foto_path)
                                <img src="{{ Storage::url($peserta->foto_path) }}"
                                     alt="Foto {{ $peserta->nama_lengkap }}"
                                     class="w-32 h-40 object-cover rounded-lg border-2 border-gray-200">
                            @else
                                <div class="w-32 h-40 bg-gray-200 rounded-lg border-2 border-gray-300 flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span class="text-sm text-gray-500">No Photo</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Details -->
                        <div class="flex-1 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Kode Pendaftaran</label>
                                    <p class="text-lg font-bold text-blue-600">{{ $peserta->kode_pendaftaran }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                                    <p class="text-lg font-semibold text-gray-900">{{ $peserta->nama_lengkap }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</label>
                                    <p class="text-gray-900">{{ $peserta->tempat_tanggal_lahir }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Umur</label>
                                    <p class="text-gray-900">{{ $peserta->umur }} tahun</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Jenis Kelamin</label>
                                    <p class="text-gray-900">{{ $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Golongan Darah</label>
                                    <p class="text-gray-900">{{ $peserta->golongan_darah }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Berat Badan</label>
                                    <p class="text-gray-900">{{ $peserta->berat_badan }} KG</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">No. Telepon</label>
                                    <p class="text-gray-900">{{ $peserta->no_telepon }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Alamat</label>
                                <p class="text-gray-900">{{ $peserta->alamat }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Organization Info -->
            <div class="admin-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Organisasi</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Ranting/Afiliasi</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $peserta->ranting->nama_ranting }}</p>
                            <p class="text-gray-600">{{ $peserta->ranting->kota }}, {{ $peserta->ranting->provinsi }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Kategori Usia</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $peserta->kategoriUsia->nama_kategori }}</p>
                            <p class="text-gray-600">{{ $peserta->kategoriUsia->rentang_usia }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Competition Categories -->
            <div class="admin-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Kategori Pertandingan</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($peserta->kategori_dipilih as $kategori)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-medium text-green-800">{{ $kategori }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total Biaya:</span>
                            <span class="text-2xl font-bold text-blue-600">{{ $peserta->formatted_total_biaya }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Info -->
            <div class="admin-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Akun</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900">{{ $peserta->user->email }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Role</label>
                            <p class="text-gray-900">{{ ucfirst($peserta->user->role) }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tanggal Daftar</label>
                            <p class="text-gray-900">{{ $peserta->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Last Update</label>
                            <p class="text-gray-900">{{ $peserta->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Cards -->
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Pendaftaran</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Status Pendaftaran</span>
                        <span class="badge badge-{{ $peserta->status_pendaftaran === 'approved' ? 'success' : ($peserta->status_pendaftaran === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($peserta->status_pendaftaran) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Status Pembayaran</span>
                        <span class="badge badge-{{ $peserta->status_bayar === 'paid' ? 'success' : ($peserta->status_bayar === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($peserta->status_bayar) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Payment History -->
            @if($peserta->pembayaran->count() > 0)
            <div class="admin-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Riwayat Pembayaran</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($peserta->pembayaran as $pembayaran)
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-medium text-gray-900">{{ $pembayaran->kode_pembayaran }}</span>
                            <span class="badge badge-{{ $pembayaran->status_bayar === 'paid' ? 'success' : ($pembayaran->status_bayar === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($pembayaran->status_bayar) }}
                            </span>
                        </div>
                        <div class="space-y-1 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Jumlah:</span>
                                <span class="font-medium">{{ $pembayaran->formatted_jumlah_bayar }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Metode:</span>
                                <span>{{ $pembayaran->metode_pembayaran_formatted }}</span>
                            </div>
                            @if($pembayaran->tanggal_bayar)
                            <div class="flex justify-between">
                                <span>Tanggal Bayar:</span>
                                <span>{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</span>
                            </div>
                            @endif
                            @if($pembayaran->verified_at)
                            <div class="flex justify-between">
                                <span>Verified:</span>
                                <span>{{ $pembayaran->verified_at->format('d/m/Y') }}</span>
                            </div>
                            @endif
                            @if($pembayaran->verifiedBy)
                            <div class="flex justify-between">
                                <span>Verified By:</span>
                                <span>{{ $pembayaran->verifiedBy->name }}</span>
                            </div>
                            @endif
                        </div>
                        @if($pembayaran->status_bayar === 'pending')
                        <div class="mt-3">
                            <a href="{{ route('admin.verifikasi.show', $pembayaran->id) }}"
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lihat Bukti Pembayaran →
                            </a>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.export.sertifikat', $peserta->id) }}"
                       class="w-full admin-btn-primary text-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Sertifikat
                    </a>

                    <button onclick="confirmDelete('{{ route('admin.peserta.destroy', $peserta->id) }}', 'Hapus peserta ini? Data tidak dapat dikembalikan!')"
                            class="w-full admin-btn-danger">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Peserta
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tolak Pendaftaran</h3>
            <form id="rejectForm" method="POST" action="{{ route('admin.peserta.reject', $peserta->id) }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label">Alasan Penolakan</label>
                    <textarea name="reason" rows="4" class="form-input"
                              placeholder="Berikan alasan penolakan..." required></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeRejectModal()" class="admin-btn-secondary">
                        Batal
                    </button>
                    <button type="submit" class="admin-btn-danger">
                        Tolak Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function rejectPeserta() {
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectForm').reset();
    }

    // Submit reject form
    document.getElementById('rejectForm').addEventListener('submit', function(e) {
        e.preventDefault();
        showLoading();
        this.submit();
    });

    // Close modal when clicking outside
    document.getElementById('rejectModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRejectModal();
        }
    });
</script>
@endpush
