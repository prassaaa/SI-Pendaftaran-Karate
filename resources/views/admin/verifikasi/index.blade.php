@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Verifikasi Pembayaran</h1>
            <p class="text-gray-600 mt-1">Verifikasi bukti pembayaran peserta kejuaraan</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.verifikasi.statistics') }}" class="admin-btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Statistik
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
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
                    <div class="text-2xl font-bold text-gray-900">{{ $pembayaran->where('status_bayar', 'pending')->count() }}</div>
                    <div class="text-sm text-gray-600">Menunggu Verifikasi</div>
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
                    <div class="text-2xl font-bold text-gray-900">{{ $pembayaran->where('status_bayar', 'paid')->count() }}</div>
                    <div class="text-sm text-gray-600">Sudah Diverifikasi</div>
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
                    <div class="text-2xl font-bold text-gray-900">{{ $pembayaran->where('status_bayar', 'failed')->count() }}</div>
                    <div class="text-sm text-gray-600">Ditolak</div>
                </div>
            </div>
        </div>

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
                    <div class="text-2xl font-bold text-gray-900">
                        Rp {{ number_format($pembayaran->where('status_bayar', 'paid')->sum('jumlah_bayar'), 0, ',', '.') }}
                    </div>
                    <div class="text-sm text-gray-600">Total Revenue</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="admin-card p-6">
        <form method="GET" class="space-y-4 md:space-y-0 md:flex md:items-end md:space-x-4">
            <div class="flex-1">
                <label class="form-label">Cari Pembayaran</label>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-input"
                       placeholder="Nama peserta, kode pembayaran, atau kode pendaftaran...">
            </div>

            <div class="md:w-48">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>

            <div class="md:w-48">
                <label class="form-label">Metode Pembayaran</label>
                <select name="metode" class="form-select">
                    <option value="">Semua Metode</option>
                    <option value="transfer" {{ request('metode') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                    <option value="qris" {{ request('metode') == 'qris' ? 'selected' : '' }}>QRIS</option>
                    <option value="cash" {{ request('metode') == 'cash' ? 'selected' : '' }}>Cash</option>
                </select>
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="admin-btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Filter
                </button>
                <a href="{{ route('admin.verifikasi.index') }}" class="admin-btn-secondary">Reset</a>
            </div>
        </form>
    </div>

    <!-- Bulk Actions -->
    <div id="bulk-actions" class="admin-card p-4 hidden">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">
                <span id="selected-count">0</span> pembayaran dipilih
            </span>
            <div class="flex space-x-2">
                <button onclick="bulkApprove()" class="admin-btn-success text-sm">
                    Verifikasi Terpilih
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
                        <th>Pembayaran</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $p)
                    <tr class="hover:bg-gray-50">
                        <td>
                            @if($p->status_bayar === 'pending')
                            <input type="checkbox" name="selected_pembayaran[]" value="{{ $p->id }}"
                                   onchange="updateBulkActions()"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    @if($p->peserta->foto_path)
                                        <img src="{{ Storage::url($p->peserta->foto_path) }}"
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
                                    <div class="font-medium text-gray-900">{{ $p->peserta->nama_lengkap }}</div>
                                    <div class="text-sm text-gray-500">{{ $p->peserta->kode_pendaftaran }}</div>
                                    <div class="text-xs text-gray-400">{{ $p->peserta->ranting->nama_ranting }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-sm">
                                <div class="font-medium text-gray-900">{{ $p->kode_pembayaran }}</div>
                                <div class="text-blue-600 font-semibold">{{ $p->formatted_jumlah_bayar }}</div>
                            </div>
                        </td>
                        <td>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">
                                {{ $p->metode_pembayaran_formatted }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $p->status_bayar === 'paid' ? 'success' : ($p->status_bayar === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($p->status_bayar) }}
                            </span>
                        </td>
                        <td>
                            <div class="text-sm text-gray-900">
                                @if($p->tanggal_bayar)
                                    {{ $p->tanggal_bayar->format('d/m/Y') }}
                                    <div class="text-xs text-gray-500">{{ $p->tanggal_bayar->format('H:i') }}</div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.verifikasi.show', $p->id) }}"
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Detail
                                </a>

                                @if($p->status_bayar === 'pending')
                                    <button onclick="quickApprove({{ $p->id }})"
                                            class="text-green-600 hover:text-green-800 text-sm font-medium">
                                        Verifikasi
                                    </button>
                                    <button onclick="rejectPayment({{ $p->id }})"
                                            class="text-red-600 hover:text-red-800 text-sm font-medium">
                                        Tolak
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data pembayaran</h3>
                                <p class="text-gray-500">Belum ada pembayaran yang perlu diverifikasi atau sesuai dengan filter.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pembayaran->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $pembayaran->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Quick Approve Modal -->
<div id="approveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Verifikasi Pembayaran</h3>
            <form id="approveForm" method="POST">
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
                        Verifikasi Pembayaran
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
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tolak Pembayaran</h3>
            <form id="rejectForm" method="POST">
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
                        Tolak Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let selectedPembayaran = [];

    function toggleSelectAll(checkbox) {
        const checkboxes = document.querySelectorAll('input[name="selected_pembayaran[]"]');
        checkboxes.forEach(cb => {
            cb.checked = checkbox.checked;
        });
        updateBulkActions();
    }

    function updateBulkActions() {
        const checkboxes = document.querySelectorAll('input[name="selected_pembayaran[]"]:checked');
        selectedPembayaran = Array.from(checkboxes).map(cb => cb.value);

        const bulkActions = document.getElementById('bulk-actions');
        const selectedCount = document.getElementById('selected-count');

        if (selectedPembayaran.length > 0) {
            bulkActions.classList.remove('hidden');
            selectedCount.textContent = selectedPembayaran.length;
        } else {
            bulkActions.classList.add('hidden');
        }
    }

    function bulkApprove() {
        if (selectedPembayaran.length === 0) {
            showToast('Pilih pembayaran terlebih dahulu', 'warning');
            return;
        }

        Swal.fire({
            title: 'Konfirmasi Bulk Verifikasi',
            text: `Apakah Anda yakin ingin memverifikasi ${selectedPembayaran.length} pembayaran yang dipilih?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10B981',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Verifikasi!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.verifikasi.bulk-approve") }}';

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                selectedPembayaran.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'selected_pembayaran[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function quickApprove(id) {
        document.getElementById('approveForm').action = `/admin/verifikasi/${id}/approve`;
        document.getElementById('approveModal').classList.remove('hidden');
    }

    function closeApproveModal() {
        document.getElementById('approveModal').classList.add('hidden');
        document.getElementById('approveForm').reset();
    }

    function rejectPayment(id) {
        document.getElementById('rejectForm').action = `/admin/verifikasi/${id}/reject`;
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectForm').reset();
    }

    // Submit forms
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

    // Auto-refresh for pending payments
    setInterval(function() {
        if (window.location.search.includes('status=pending') || !window.location.search.includes('status=')) {
            fetch(window.location.href)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newTable = doc.querySelector('.admin-table tbody');
                    const currentTable = document.querySelector('.admin-table tbody');
                    if (newTable && currentTable && newTable.innerHTML !== currentTable.innerHTML) {
                        location.reload();
                    }
                })
                .catch(error => console.log('Auto-refresh failed:', error));
        }
    }, 30000); // Refresh every 30 seconds
</script>
@endpush
