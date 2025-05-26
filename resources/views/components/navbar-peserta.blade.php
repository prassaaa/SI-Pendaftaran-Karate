<nav x-data="{ open: false, profileOpen: false, notifOpen: false }" class="bg-white shadow-sm border-b border-gray-200 fixed w-full z-50 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <div class="text-lg font-bold text-gray-900">Dashboard Peserta</div>
                        <div class="text-xs text-gray-500">INKAI Kediri</div>
                    </div>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('peserta.dashboard') }}"
                   class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('peserta.dashboard') ? 'text-blue-600 bg-blue-50' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('peserta.profile.edit') }}"
                   class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('peserta.profile.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    Profil
                </a>

                <a href="{{ route('pembayaran.info') }}"
                   class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                    Info Pembayaran
                </a>

                <!-- Status Badge -->
                @if(auth()->user()->peserta)
                    <div class="flex items-center space-x-2">
                        <span class="badge badge-{{ auth()->user()->peserta->status_pendaftaran === 'approved' ? 'success' : (auth()->user()->peserta->status_pendaftaran === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst(auth()->user()->peserta->status_pendaftaran) }}
                        </span>
                        <span class="badge badge-{{ auth()->user()->peserta->status_bayar === 'paid' ? 'success' : (auth()->user()->peserta->status_bayar === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst(auth()->user()->peserta->status_bayar) }}
                        </span>
                    </div>
                @endif
            </div>

            <!-- Right side -->
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <div class="relative" x-data="{ count: {{ auth()->user()->notifications()->unread()->count() }} }">
                    <button @click="notifOpen = !notifOpen"
                            class="relative p-2 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span x-show="count > 0" x-text="count"
                              class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
                    </button>

                    <!-- Notifications Dropdown -->
                    <div x-show="notifOpen" @click.away="notifOpen = false"
                         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Notifikasi</h3>
                        </div>
                        <div class="max-h-64 overflow-y-auto">
                            @forelse(auth()->user()->notifications()->latest()->limit(5)->get() as $notification)
                            <div class="p-4 border-b border-gray-100 hover:bg-gray-50 {{ $notification->read_at ? '' : 'bg-blue-50' }}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $notification->title }}</h4>
                                        <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
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
                        @if(auth()->user()->notifications()->count() > 0)
                        <div class="p-4 bg-gray-50">
                            <button onclick="markAllAsRead()" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                Tandai semua dibaca
                            </button>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <div class="relative">
                    <button @click="profileOpen = !profileOpen"
                            class="flex items-center space-x-3 text-sm focus:outline-none">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                            @if(auth()->user()->peserta)
                                <div class="text-xs text-gray-500">{{ auth()->user()->peserta->kode_pendaftaran }}</div>
                            @endif
                        </div>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Profile Dropdown Menu -->
                    <div x-show="profileOpen" @click.away="profileOpen = false"
                         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                        <div class="py-2">
                            <a href="{{ route('peserta.dashboard') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Dashboard
                            </a>

                            <a href="{{ route('peserta.profile.edit') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Edit Profil
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

                            <a href="{{ route('welcome') }}"
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

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="open = !open"
                            class="text-gray-700 hover:text-blue-600 focus:outline-none focus:text-blue-600 transition-colors duration-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
            <a href="{{ route('peserta.dashboard') }}"
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200 {{ request()->routeIs('peserta.dashboard') ? 'text-blue-600 bg-blue-50' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('peserta.profile.edit') }}"
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200 {{ request()->routeIs('peserta.profile.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                Profil
            </a>

            <a href="{{ route('pembayaran.info') }}"
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                Info Pembayaran
            </a>

            @if(auth()->user()->peserta)
            <div class="border-t border-gray-200 pt-4">
                <div class="px-3 py-2">
                    <div class="flex items-center space-x-2">
                        <span class="badge badge-{{ auth()->user()->peserta->status_pendaftaran === 'approved' ? 'success' : (auth()->user()->peserta->status_pendaftaran === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst(auth()->user()->peserta->status_pendaftaran) }}
                        </span>
                        <span class="badge badge-{{ auth()->user()->peserta->status_bayar === 'paid' ? 'success' : (auth()->user()->peserta->status_bayar === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst(auth()->user()->peserta->status_bayar) }}
                        </span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</nav>

<!-- Spacer for fixed navbar -->
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
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
