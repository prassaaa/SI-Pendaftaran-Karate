<!-- Sidebar for Desktop -->
<div x-data="{ sidebarOpen: true }"
     @toggle-sidebar.window="sidebarOpen = !sidebarOpen"
     class="hidden lg:block fixed left-0 top-16 h-full w-64 bg-white shadow-lg border-r border-gray-200 z-40 transition-all duration-300"
     :class="{ '-ml-64': !sidebarOpen }">

    <div class="flex flex-col h-full">
        <!-- Sidebar Content -->
        <div class="flex-1 overflow-y-auto py-6">
            <nav class="space-y-2 px-4">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <!-- Peserta Management -->
                <div x-data="{ open: {{ request()->routeIs('admin.peserta.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                            class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Kelola Peserta
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="mt-2 space-y-1 pl-4">
                        <a href="{{ route('admin.peserta.index') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.peserta.index') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="w-2 h-2 bg-gray-400 rounded-full mr-3"></span>
                            Semua Peserta
                        </a>
                        <a href="{{ route('admin.peserta.index', ['status_pendaftaran' => 'pending']) }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 text-gray-600 hover:bg-gray-50">
                            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-3"></span>
                            Menunggu Persetujuan
                            <span class="ml-auto bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                                {{ \App\Models\Peserta::pending()->count() }}
                            </span>
                        </a>
                        <a href="{{ route('admin.peserta.index', ['status_pendaftaran' => 'approved']) }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 text-gray-600 hover:bg-gray-50">
                            <span class="w-2 h-2 bg-green-400 rounded-full mr-3"></span>
                            Disetujui
                        </a>
                    </div>
                </div>

                <!-- Verifikasi Pembayaran -->
                <div x-data="{ open: {{ request()->routeIs('admin.verifikasi.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                            class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Verifikasi Bayar
                            @if(\App\Models\Pembayaran::pending()->count() > 0)
                                <span class="ml-2 bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                    {{ \App\Models\Pembayaran::pending()->count() }}
                                </span>
                            @endif
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="mt-2 space-y-1 pl-4">
                        <a href="{{ route('admin.verifikasi.index') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.verifikasi.index') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-3"></span>
                            Menunggu Verifikasi
                        </a>
                        <a href="{{ route('admin.verifikasi.index', ['status' => 'paid']) }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 text-gray-600 hover:bg-gray-50">
                            <span class="w-2 h-2 bg-green-400 rounded-full mr-3"></span>
                            Sudah Diverifikasi
                        </a>
                    </div>
                </div>

                <!-- Laporan -->
                <div x-data="{ open: {{ request()->routeIs('admin.laporan.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                            class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Laporan
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="mt-2 space-y-1 pl-4">
                        <a href="{{ route('admin.laporan.peserta') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.laporan.peserta') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-3"></span>
                            Laporan Peserta
                        </a>
                        <a href="{{ route('admin.laporan.pembayaran') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.laporan.pembayaran') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="w-2 h-2 bg-green-400 rounded-full mr-3"></span>
                            Laporan Pembayaran
                        </a>
                        <a href="{{ route('admin.laporan.keuangan') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.laporan.keuangan') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="w-2 h-2 bg-purple-400 rounded-full mr-3"></span>
                            Laporan Keuangan
                        </a>
                        <a href="{{ route('admin.laporan.statistik') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.laporan.statistik') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="w-2 h-2 bg-orange-400 rounded-full mr-3"></span>
                            Statistik
                        </a>
                    </div>
                </div>

                <!-- Master Data -->
                <div x-data="{ open: {{ request()->routeIs('admin.master.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                            class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                            </svg>
                            Master Data
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="mt-2 space-y-1 pl-4">
                        <a href="{{ route('admin.master.kategori-usia.index') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.master.kategori-usia.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="w-2 h-2 bg-indigo-400 rounded-full mr-3"></span>
                            Kategori Usia
                        </a>
                        <a href="{{ route('admin.master.ranting.index') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.master.ranting.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="w-2 h-2 bg-pink-400 rounded-full mr-3"></span>
                            Ranting/Cabang
                        </a>
                        <a href="{{ route('admin.master.biaya-kategori.index') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.master.biaya-kategori.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="w-2 h-2 bg-green-400 rounded-full mr-3"></span>
                            Biaya Kategori
                        </a>
                        <a href="{{ route('admin.master.settings') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.master.settings') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="w-2 h-2 bg-gray-400 rounded-full mr-3"></span>
                            Pengaturan
                        </a>
                    </div>
                </div>

                <!-- Export -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                            class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Export Data
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="mt-2 space-y-1 pl-4">
                        <a href="{{ route('admin.export.peserta.excel') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 text-gray-600 hover:bg-gray-50">
                            <span class="w-2 h-2 bg-green-400 rounded-full mr-3"></span>
                            Data Peserta (Excel)
                        </a>
                        <a href="{{ route('admin.export.pembayaran.excel') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 text-gray-600 hover:bg-gray-50">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-3"></span>
                            Data Pembayaran (Excel)
                        </a>
                        <a href="{{ route('admin.export.daftar.hadir') }}"
                           class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 text-gray-600 hover:bg-gray-50">
                            <span class="w-2 h-2 bg-purple-400 rounded-full mr-3"></span>
                            Daftar Hadir (PDF)
                        </a>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-4"></div>

                <!-- Quick Actions -->
                <div class="space-y-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Quick Actions</p>

                    <a href="{{ route('admin.peserta.index', ['status_pendaftaran' => 'pending']) }}"
                       class="flex items-center px-4 py-2 text-sm text-orange-600 hover:bg-orange-50 rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        Review Pendaftaran
                        @if(\App\Models\Peserta::pending()->count() > 0)
                            <span class="ml-auto bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">
                                {{ \App\Models\Peserta::pending()->count() }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('admin.verifikasi.index') }}"
                       class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                        Verifikasi Pembayaran
                        @if(\App\Models\Pembayaran::pending()->count() > 0)
                            <span class="ml-auto bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                {{ \App\Models\Pembayaran::pending()->count() }}
                            </span>
                        @endif
                    </a>
                </div>
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-xs font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Sidebar Overlay -->
<div x-data="{ mobileOpen: false }"
     @toggle-sidebar.window="mobileOpen = !mobileOpen"
     class="lg:hidden">

    <!-- Overlay -->
    <div x-show="mobileOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-75 z-40"
         @click="mobileOpen = false"></div>

    <!-- Mobile Sidebar -->
    <div x-show="mobileOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
         class="fixed left-0 top-16 h-full w-64 bg-white shadow-lg border-r border-gray-200 z-50">

        <div class="flex flex-col h-full">
            <!-- Mobile Sidebar Content (Same as desktop) -->
            <div class="flex-1 overflow-y-auto py-6">
                <nav class="space-y-2 px-4">
                    <!-- Same navigation items as desktop -->
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Quick Links for Mobile -->
                    <a href="{{ route('admin.peserta.index') }}"
                       class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Kelola Peserta
                    </a>

                    <a href="{{ route('admin.verifikasi.index') }}"
                       class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Verifikasi Pembayaran
                        @if(\App\Models\Pembayaran::pending()->count() > 0)
                            <span class="ml-auto bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                {{ \App\Models\Pembayaran::pending()->count() }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('admin.laporan.peserta') }}"
                       class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Laporan
                    </a>

                    <a href="{{ route('admin.master.settings') }}"
                       class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Pengaturan
                    </a>
                </nav>
            </div>

            <!-- Mobile Footer -->
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-xs font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
