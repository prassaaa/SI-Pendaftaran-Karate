<nav x-data="{ open: false, profileOpen: false, notifOpen: false }"
     x-cloak
     class="bg-white shadow-sm border-b border-gray-200 fixed w-full z-50 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <button @click="$dispatch('toggle-sidebar')"
                        class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 mr-3">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <div class="text-lg font-bold text-gray-900">Portal Peserta</div>
                        <div class="text-xs text-gray-500">INKAI Kediri</div>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-4">

                <div class="relative" x-data="{ count: {{ auth()->user()->notifications()->unread()->count() }} }">
                    <button @click="notifOpen = !notifOpen; profileOpen = false;"
                            class="relative p-2 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span x-show="count > 0"
                              x-text="count"
                              x-transition
                              class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
                    </button>

                    <div x-show="notifOpen"
                         @click.outside="notifOpen = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Notifikasi</h3>
                        </div>
                        <div class="max-h-64 overflow-y-auto">
                            @forelse(auth()->user()->notifications()->latest()->limit(5)->get() as $notification)
                            <div class="p-4 border-b border-gray-100 hover:bg-gray-50 {{ $notification->read_at ? '' : 'bg-blue-50' }}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $notification->data['title'] ?? 'Notifikasi Baru' }}</h4>
                                        <p class="text-sm text-gray-600 mt-1">{{ $notification->data['message'] ?? 'Anda memiliki notifikasi baru.' }}</p>
                                        <p class="text-xs text-gray-400 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                    @if(!$notification->read_at)
                                    <div class="w-2 h-2 bg-blue-500 rounded-full ml-2 mt-1"></div>
                                    @endif
                                </div>
                            </div>
                            @empty
                            <div class="p-4 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <p>Tidak ada notifikasi</p>
                            </div>
                            @endforelse
                        </div>
                        @if(auth()->user()->notifications()->unread()->count() > 0)
                        <div class="p-4 bg-gray-50 border-t border-gray-200">
                            <button onclick="markAllAsRead()" class="w-full text-sm text-blue-600 hover:text-blue-800 font-medium focus:outline-none">Tandai semua dibaca</button>
                        </div>
                        @elseif(auth()->user()->notifications()->count() > 0)
                         <div class="p-4 bg-gray-50 border-t border-gray-200">
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat semua notifikasi</a> {{-- Ganti # dengan route yang benar jika ada halaman semua notifikasi --}}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="relative">
                    <button @click="profileOpen = !profileOpen; notifOpen = false;"
                            class="flex items-center space-x-3 text-sm focus:outline-none">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                            @if(auth()->user()->peserta)
                                <div class="text-xs text-gray-500">{{ auth()->user()->peserta->kode_pendaftaran }}</div>
                            @else
                                <div class="text-xs text-gray-500">Peserta</div>
                            @endif
                        </div>
                        <svg class="w-4 h-4 text-gray-500 transition-transform duration-200"
                             :class="{ 'rotate-180': profileOpen }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="profileOpen"
                         @click.outside="profileOpen = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                        <div class="py-2">
                            <a href="{{ route('peserta.profile.edit') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profil
                            </a>

                            @if(auth()->user()->peserta)
                            <a href="{{ route('peserta.download-invoice') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download Invoice
                            </a>

                            <a href="{{ route('peserta.download-formulir') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download Formulir
                            </a>
                            @endif

                            <div class="border-t border-gray-100 my-1"></div>

                            <a href="{{ route('welcome') }}" target="_blank"
                               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Lihat Website
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="h-16"></div>

<script>
function markAllAsRead() {
    fetch('{{ route("peserta.notifications.read-all") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update UI directly or reload
            document.querySelector('[x-data="{ count: {{ auth()->user()->notifications()->unread()->count() }} }"]')._x_dataStack[0].count = 0;
            document.querySelectorAll('.p-4.border-b.border-gray-100.hover\\:bg-gray-50.bg-blue-50').forEach(el => el.classList.remove('bg-blue-50'));
            document.querySelectorAll('.w-2.h-2.bg-blue-500.rounded-full').forEach(el => el.style.display = 'none');
             // Optionally reload if more complex UI updates are needed:
             // location.reload();
             showToast('Semua notifikasi ditandai terbaca.', 'success'); // Menggunakan global showToast
        } else {
            showToast('Gagal menandai notifikasi.', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan.', 'error');
    });
}
</script>
