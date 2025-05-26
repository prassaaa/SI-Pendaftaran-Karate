<nav x-data="{ open: false }" class="bg-white/90 backdrop-blur-md border-b border-gray-200 fixed w-full z-50 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <div class="text-xl font-bold text-gray-900">INKAI Kediri</div>
                        <div class="text-xs text-gray-500">Karate Championship</div>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('welcome') }}"
                   class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('welcome') ? 'text-blue-600 bg-blue-50' : '' }}">
                    Beranda
                </a>

                <a href="{{ route('pendaftaran.step1') }}"
                   class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('pendaftaran.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    Pendaftaran
                </a>

                <a href="{{ route('pembayaran.info') }}"
                   class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('pembayaran.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    Info Pembayaran
                </a>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}"
                       class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        Masuk
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 transform hover:scale-105">
                        Daftar Akun
                    </a>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
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

    <!-- Mobile Navigation -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
            <a href="{{ route('welcome') }}"
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200 {{ request()->routeIs('welcome') ? 'text-blue-600 bg-blue-50' : '' }}">
                Beranda
            </a>

            <a href="{{ route('pendaftaran.step1') }}"
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200 {{ request()->routeIs('pendaftaran.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                Pendaftaran
            </a>

            <a href="{{ route('pembayaran.info') }}"
               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200 {{ request()->routeIs('pembayaran.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                Info Pembayaran
            </a>

            <div class="border-t border-gray-200 pt-4">
                <a href="{{ route('login') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                    Masuk
                </a>

                <a href="{{ route('register') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-200 mx-3 mt-2">
                    Daftar Akun
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer for fixed navbar -->
<div class="h-16"></div>
