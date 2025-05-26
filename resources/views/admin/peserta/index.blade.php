@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Peserta</h1>
            <p class="text-gray-600 mt-1">Manage dan verifikasi data peserta kejuaraan</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.export.peserta.excel') }}"
               class="admin-btn-success">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export Excel
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
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
                    <div class="text-2xl font-bold text-gray-900">{{ $peserta->total() }}</div>
                    <div class="text-sm text-gray-600">Total Peserta</div>
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
                    <div class="text-2xl font-bold text-gray-900">{{ $peserta->where('status_pendaftaran', 'pending')->count() }}</div>
                    <div class="text-sm text-gray-600">Menunggu Persetujuan</div>
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
                    <div class="text-2xl font-bold text-gray-900">{{ $peserta->where('status_pendaftaran', 'approved')->count() }}</div>
                    <div class="text-sm text-gray-600">Disetujui</div>
                </div>
            </div>
        </div>

        <div class="admin-card p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-2xl font-bold text-gray-900">{{ $peserta->where('status_pendaftaran', 'rejected')->count() }}</div>
                    <div class="text-sm text-gray-600">Ditolak</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="admin-card p-6">
        <form method="GET" class="space-y-4 md:space-y-0 md:flex md:items-end md:space-x-4">
            <div class="flex-1">
                <label class="form-label">Cari Peserta</label>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-input"
                       placeholder="Nama, kode pendaftaran, atau nomor telepon...">
            </div>

            <div class="md:w-48">
                <label class="form-label">Status Pendaftaran</label>
                <select name="status_pendaftaran" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status_pendaftaran') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status_pendaftaran') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status_pendaftaran') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="md:w-48">
                <label class="form-label">Status Bayar</label>
                <select name="status_bayar" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="unpaid" {{ request('status_bayar') == 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="pending" {{ request('status_bayar') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status_bayar') == 'paid' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>

            <div class="md:w-48">
                <label class="form-label">Ranting</label>
                <select name="ranting_id" class="form-select">
                    <option value="">Semua Ranting</option>
                    @foreach($ranting as $r)
                        <option value="{{ $r->id }}" {{ request('ranting_id') == $r->id ? 'selected' : '' }}>
                            {{ $r->nama_ranting }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="admin-btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Filter
                </button>
                <a href="{{ route('admin.peserta.index') }}" class="admin-btn-secondary">Reset</a>
            </div>
        </form>
    </div>

    <!-- Bulk Actions -->
    <div id="bulk-actions" class="admin-card p-4 hidden">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">
                <span id="selected-count">0</span> peserta dipilih
            </span>
            <div class="flex space-x-2">
                <button onclick="bulkAction('approve')" class="admin-btn-success text-sm">
                    Setujui Terpilih
                </button>
                <button onclick="bulkAction('reject')" class="admin-btn-warning text-sm">
                    Tolak Terpilih
                </button>
                <button onclick="bulkAction('delete')" class="admin-btn-danger text-sm">
                    Hapus Terpilih
                </button>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th class="w-12">
                            <input type="checkbox" id="select-all" onchange="toggleSelectAll(this)"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </th>
                        <th>Peserta</th>
                        <th>Kontak</th>
                        <th>Ranting</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peserta as $p)
                    <tr class="hover:bg-gray-50">
                        <td>
                            <input type="checkbox" name="selected_peserta[]" value="{{ $p->id }}"
                                   onchange="updateBulkActions()"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    @if($p->foto_path)
                                        <img src="{{ Storage::url($p->foto_path) }}"
                                             alt="Foto"
                                             class="w-10 h-10 rounded-lg object-cover">
                                    @else
                                        <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">{{ $p->nama_lengkap }}</div>
                                    <div class="text-sm text-gray-500">{{ $p->kode_pendaftaran }}</div>
                                    <div class="text-xs text-gray-400">{{ $p->umur }} tahun • {{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-sm">
                                <div class="text-gray-900">{{ $p->no_telepon }}</div>
                                <div class="text-gray-500">{{ $p->user->email }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="text-sm">
                                <div class="font-medium text-gray-900">{{ $p->ranting->nama_ranting }}</div>
                                <div class="text-gray-500">{{ $p->kategoriUsia->nama_kategori }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="space-y-1">
                                @foreach($p->kategori_dipilih as $kategori)
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                        {{ $kategori }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-{{ $p->status_pendaftaran === 'approved' ? 'success' : ($p->status_pendaftaran === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($p->status_pendaftaran) }}
                            </span>
                        </td>
                        <td>
                            <div class="text-sm">
                                <span class="badge badge-{{ $p->status_bayar === 'paid' ? 'success' : ($p->status_bayar === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($p->status_bayar) }}
                                </span>
                                <div class="text-gray-500 mt-1">{{ $p->formatted_total_biaya }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.peserta.show', $p->id) }}"
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Detail
                                </a>

                                @if($p->status_pendaftaran === 'pending')
                                    <button onclick="confirmAction('{{ route('admin.peserta.approve', $p->id) }}', 'Setujui peserta ini?')"
                                            class="text-green-600 hover:text-green-800 text-sm font-medium">
                                        Setujui
                                    </button>
                                    <button onclick="rejectPeserta({{ $p->id }})"
                                            class="text-red-600 hover:text-red-800 text-sm font-medium">
                                        Tolak
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data peserta</h3>
                                <p class="text-gray-500">Belum ada peserta yang mendaftar atau sesuai dengan filter.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($peserta->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $peserta->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tolak Pendaftaran</h3>
            <form id="rejectForm" method="POST">
                @csrf
                @method('POST')
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
    let selectedPeserta = [];

    function toggleSelectAll(checkbox) {
        const checkboxes = document.querySelectorAll('input[name="selected_peserta[]"]');
        checkboxes.forEach(cb => {
            cb.checked = checkbox.checked;
        });
        updateBulkActions();
    }

    function updateBulkActions() {
        const checkboxes = document.querySelectorAll('input[name="selected_peserta[]"]:checked');
        selectedPeserta = Array.from(checkboxes).map(cb => cb.value);

        const bulkActions = document.getElementById('bulk-actions');
        const selectedCount = document.getElementById('selected-count');

        if (selectedPeserta.length > 0) {
            bulkActions.classList.remove('hidden');
            selectedCount.textContent = selectedPeserta.length;
        } else {
            bulkActions.classList.add('hidden');
        }
    }

    function bulkAction(action) {
        if (selectedPeserta.length === 0) {
            showToast('Pilih peserta terlebih dahulu', 'warning');
            return;
        }

        const actionText = {
            'approve': 'menyetujui',
            'reject': 'menolak',
            'delete': 'menghapus'
        };

        Swal.fire({
            title: 'Konfirmasi Bulk Action',
            text: `Apakah Anda yakin ingin ${actionText[action]} ${selectedPeserta.length} peserta yang dipilih?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: action === 'delete' ? '#EF4444' : '#3B82F6',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Lanjutkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.peserta.bulk-action") }}';

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = action;
                form.appendChild(actionInput);

                selectedPeserta.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'selected_peserta[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function rejectPeserta(id) {
        document.getElementById('rejectForm').action = `/admin/peserta/${id}/reject`;
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
