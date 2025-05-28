<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin' }} - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Admin specific styles */
        .admin-card {
            @apply bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200;
        }

        .admin-btn {
            @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2;
        }

        .admin-btn-primary {
            @apply admin-btn bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500;
        }

        .admin-btn-secondary {
            @apply admin-btn bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500;
        }

        .admin-btn-success {
            @apply admin-btn bg-green-600 text-white hover:bg-green-700 focus:ring-green-500;
        }

        .admin-btn-danger {
            @apply admin-btn bg-red-600 text-white hover:bg-red-700 focus:ring-red-500;
        }

        .admin-btn-warning {
            @apply admin-btn bg-yellow-600 text-white hover:bg-yellow-700 focus:ring-yellow-500;
        }

        /* Table styles */
        .admin-table {
            @apply min-w-full divide-y divide-gray-200 bg-white;
        }

        .admin-table th {
            @apply px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-50;
        }

        .admin-table td {
            @apply px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-b border-gray-100;
        }

        /* Badge styles */
        .badge {
            @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
        }

        .badge-success {
            @apply badge bg-green-100 text-green-800;
        }

        .badge-warning {
            @apply badge bg-yellow-100 text-yellow-800;
        }

        .badge-danger {
            @apply badge bg-red-100 text-red-800;
        }

        .badge-info {
            @apply badge bg-blue-100 text-blue-800;
        }

        .badge-gray {
            @apply badge bg-gray-100 text-gray-800;
        }

        /* Form styles */
        .form-input {
            @apply block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200;
        }

        .form-select {
            @apply block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200;
        }

        .form-label {
            @apply block text-sm font-medium text-gray-700 mb-2;
        }

        .form-error {
            @apply text-red-600 text-sm mt-1;
        }

        /* Chart container */
        .chart-container {
            @apply relative w-full h-64 md:h-80;
        }

        /* Stat cards */
        .stat-card {
            @apply admin-card p-6;
        }

        .stat-value {
            @apply text-3xl font-bold text-gray-900;
        }

        .stat-label {
            @apply text-sm font-medium text-gray-500 uppercase tracking-wide;
        }

        .stat-change {
            @apply text-sm font-medium flex items-center;
        }

        .stat-change.positive {
            @apply text-green-600;
        }

        .stat-change.negative {
            @apply text-red-600;
        }

        /* Loading states */
        .loading-skeleton {
            @apply animate-pulse bg-gray-200 rounded;
        }

        /* Mobile responsive table */
        @media (max-width: 768px) {
            .mobile-table-card {
                @apply bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4;
            }
        }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div id="admin-app" class="min-h-screen">
        @include('components.navbar-admin')

        @include('components.sidebar-admin')

        {{-- PENYESUAIAN: Mengubah lg:ml-64 menjadi lg:ml-72 --}}
        <div class="lg:ml-72">
            <main class="py-6">
                @isset($header)
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        {{ $header }}
                    </div>
                </div>
                @endisset

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-xl">
            <div class="flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                <span class="text-gray-700 font-medium">Loading...</span>
            </div>
        </div>
    </div>

    <div id="toast-container" class="fixed top-20 right-4 z-50 space-y-2"></div>

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-20 right-4 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
                <button @click="show = false" class="ml-3 text-green-500 hover:text-green-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if(session('error') || $errors->any())
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 7000)"
             class="fixed top-20 right-4 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg max-w-md">
            <div class="flex items-start">
                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <div class="flex-1">
                    @if(session('error'))
                        <span class="font-medium">{{ session('error') }}</span>
                    @endif
                    @if($errors->any())
                        <ul class="mt-1 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <button @click="show = false" class="ml-3 text-red-500 hover:text-red-700 flex-shrink-0">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Pastikan Alpine.js dimuat dengan benar
        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js initialized successfully');
        });

        // CSRF Token setup
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };

        // Global loading functions
        window.showLoading = function() {
            document.getElementById('loading-overlay').classList.remove('hidden');
            document.getElementById('loading-overlay').classList.add('flex');
        };

        window.hideLoading = function() {
            document.getElementById('loading-overlay').classList.add('hidden');
            document.getElementById('loading-overlay').classList.remove('flex');
        };

        // Toast notification function
        window.showToast = function(message, type = 'success') {
            const colors = {
                success: 'bg-green-100 border-green-400 text-green-700',
                error: 'bg-red-100 border-red-400 text-red-700',
                warning: 'bg-yellow-100 border-yellow-400 text-yellow-700',
                info: 'bg-blue-100 border-blue-400 text-blue-700'
            };

            const icons = {
                success: '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>',
                error: '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>',
                warning: '<path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>',
                info: '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>'
            };

            const toast = document.createElement('div');
            toast.className = `${colors[type]} border px-4 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
            toast.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        ${icons[type]}
                    </svg>
                    <span class="font-medium">${message}</span>
                </div>
            `;

            document.getElementById('toast-container').appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 10);

            // Animate out and remove
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 4000);
        };

        // Confirm deletion function
        window.confirmDelete = function(url, message = 'Apakah Anda yakin ingin menghapus data ini?') {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();

                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = window.Laravel.csrfToken;

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';

                    form.appendChild(csrfToken);
                    form.appendChild(methodField);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        };

        // Confirm action function
        window.confirmAction = function(url, message = 'Apakah Anda yakin?', method = 'POST') {
            Swal.fire({
                title: 'Konfirmasi',
                text: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3B82F6',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();

                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = window.Laravel.csrfToken;

                    if (method !== 'POST') {
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = method;
                        form.appendChild(methodField);
                    }

                    form.appendChild(csrfToken);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        };

        // Bulk actions
        window.bulkAction = function(action, selectedItems, actionUrl) {
            if (selectedItems.length === 0) {
                Swal.fire('Perhatian', 'Pilih minimal satu item terlebih dahulu', 'warning');
                return;
            }

            const actionText = {
                'approve': 'menyetujui',
                'reject': 'menolak',
                'delete': 'menghapus'
            };

            Swal.fire({
                title: 'Konfirmasi Bulk Action',
                text: `Apakah Anda yakin ingin ${actionText[action]} ${selectedItems.length} item yang dipilih?`,
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
                    form.action = actionUrl;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = window.Laravel.csrfToken;
                    form.appendChild(csrfToken);

                    const actionInput = document.createElement('input');
                    actionInput.type = 'hidden';
                    actionInput.name = 'action';
                    actionInput.value = action;
                    form.appendChild(actionInput);

                    selectedItems.forEach(id => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'selected_items[]';
                        input.value = id;
                        form.appendChild(input);
                    });

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        };

        // Auto-refresh stats
        function refreshStats() {
            fetch('/admin/api/stats') // Pastikan URL API ini benar
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Update navbar stats
                    document.querySelectorAll('[data-stat]').forEach(el => {
                        const stat = el.getAttribute('data-stat');
                        if (data[stat] !== undefined) {
                            el.textContent = data[stat];
                        }
                    });
                })
                .catch(error => console.warn('Stats refresh failed:', error)); // Use warn for non-critical periodic failures
        }

        // Refresh stats every 30 seconds, only if on admin dashboard page.
        if (window.location.pathname.includes('/admin/dashboard')) {
             setInterval(refreshStats, 30000);
             refreshStats(); // Initial call
        }


        // Table utilities
        window.toggleSelectAll = function(checkbox) {
            const checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
            updateBulkActionButton();
        };

        window.updateBulkActionButton = function() {
            const checked = document.querySelectorAll('input[name="selected_items[]"]:checked');
            const bulkButton = document.getElementById('bulk-action-button');
            if (bulkButton) {
                bulkButton.style.display = checked.length > 0 ? 'inline-flex' : 'none'; // use inline-flex for buttons
            }
        };
        // Call on page load if checkboxes are present
        if (document.querySelectorAll('input[name="selected_items[]"]').length > 0) {
            updateBulkActionButton();
             document.querySelectorAll('input[name="selected_items[]"]').forEach(cb => {
                cb.addEventListener('change', updateBulkActionButton);
            });
        }


        // Initialize tooltips (if using a library like Tippy.js or Bootstrap's)
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Admin panel loaded');

            // Debug Alpine.js
            setTimeout(() => {
                const navElement = document.querySelector('nav[x-data]');
                if (navElement && typeof navElement.__x !== 'undefined') { // Check for Alpine's internal property
                    console.log('Alpine.js working correctly on admin layout.');
                } else {
                    console.warn('Alpine.js might not be working properly on admin layout or nav has no x-data.');
                }
            }, 1000);
        });

        // Search functionality
        window.searchTable = function(input, tableId) {
            const filter = input.value.toUpperCase();
            const table = document.getElementById(tableId);
            if (!table) return;
            const rows = table.querySelectorAll('tbody tr'); // More specific to tbody rows

            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                let found = false;
                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell && cell.textContent.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
                row.style.display = found ? '' : 'none';
            });
        };

        // Export functionality
        window.exportData = function(format, url, filters = {}) {
            showLoading();
            const params = new URLSearchParams(filters);
            const exportUrl = `${url}${url.includes('?') ? '&' : '?'}${params.toString()}&export_format=${format}`;

            const link = document.createElement('a');
            link.href = exportUrl;
            // link.download = ''; // Optional: specific filename can be set by server via Content-Disposition
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            setTimeout(() => hideLoading(), 1000);
        };
    </script>

    @stack('scripts')
</body>
</html>
