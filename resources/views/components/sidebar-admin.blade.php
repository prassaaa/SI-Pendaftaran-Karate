<!-- Sidebar for Desktop -->
<div x-data="{ sidebarOpen: true }"
     @toggle-sidebar.window="sidebarOpen = !sidebarOpen"
     class="hidden lg:block fixed left-0 top-0 bottom-0 w-72 bg-white shadow-xl border-r border-gray-200 z-40 transition-all duration-300"
     :class="{ '-ml-72': !sidebarOpen }">

    <div class="flex flex-col h-full pt-16">


        <!-- Sidebar Content -->
        <div class="flex-1 overflow-y-auto py-4 px-4 space-y-2">
            <nav class="space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                   class="group flex items-center p-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/25' : 'text-gray-700 hover:bg-gray-50 hover:shadow-md' }}">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'bg-blue-50 group-hover:bg-blue-100' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Dashboard</span>
                    @if(request()->routeIs('admin.dashboard'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>

                <!-- Peserta Management -->
                <div x-data="{ open: {{ request()->routeIs('admin.peserta.*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open"
                            class="group w-full flex items-center justify-between p-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.peserta.*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-lg shadow-amber-500/25' : 'text-gray-700 hover:bg-gray-50 hover:shadow-md' }}">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.peserta.*') ? 'bg-white/20' : 'bg-amber-50 group-hover:bg-amber-100' }}">
                                <svg class="w-5 h-5 {{ request()->routeIs('admin.peserta.*') ? 'text-white' : 'text-amber-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <span class="font-semibold">Kelola Peserta</span>
                        </div>
                        <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="ml-4 space-y-1 border-l-2 border-gray-100 pl-4">
                        <a href="{{ route('admin.peserta.index') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.peserta.index') && !request('status_pendaftaran') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="w-2 h-2 rounded-full mr-3 {{ request()->routeIs('admin.peserta.index') && !request('status_pendaftaran') ? 'bg-blue-500' : 'bg-gray-300' }}"></div>
                            Semua Peserta
                        </a>
                        <a href="{{ route('admin.peserta.index', ['status_pendaftaran' => 'pending']) }}"
                           class="flex items-center justify-between p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request('status_pendaftaran') === 'pending' ? 'bg-amber-50 text-amber-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex items-center">
                                <div class="w-2 h-2 rounded-full mr-3 {{ request('status_pendaftaran') === 'pending' ? 'bg-amber-500' : 'bg-gray-300' }}"></div>
                                Menunggu Persetujuan
                            </div>
                            @php $pendingCount = \App\Models\Peserta::pending()->count(); @endphp
                            @if($pendingCount > 0)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 animate-pulse">
                                    {{ $pendingCount }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('admin.peserta.index', ['status_pendaftaran' => 'approved']) }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request('status_pendaftaran') === 'approved' ? 'bg-green-50 text-green-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="w-2 h-2 rounded-full mr-3 {{ request('status_pendaftaran') === 'approved' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                            Disetujui
                        </a>
                    </div>
                </div>

                <!-- Verifikasi Pembayaran -->
                <div x-data="{ open: {{ request()->routeIs('admin.verifikasi.*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open"
                            class="group w-full flex items-center justify-between p-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.verifikasi.*') ? 'bg-gradient-to-r from-red-500 to-pink-500 text-white shadow-lg shadow-red-500/25' : 'text-gray-700 hover:bg-gray-50 hover:shadow-md' }}">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.verifikasi.*') ? 'bg-white/20' : 'bg-red-50 group-hover:bg-red-100' }}">
                                <svg class="w-5 h-5 {{ request()->routeIs('admin.verifikasi.*') ? 'text-white' : 'text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="font-semibold">Verifikasi Bayar</span>
                            @php $paymentPendingCount = \App\Models\Pembayaran::pending()->count(); @endphp
                            @if($paymentPendingCount > 0)
                                <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 animate-bounce">
                                    {{ $paymentPendingCount }}
                                </span>
                            @endif
                        </div>
                        <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="ml-4 space-y-1 border-l-2 border-gray-100 pl-4">
                        <a href="{{ route('admin.verifikasi.index') }}"
                           class="flex items-center justify-between p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.verifikasi.index') && !request('status') ? 'bg-red-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex items-center">
                                <div class="w-2 h-2 rounded-full mr-3 {{ request()->routeIs('admin.verifikasi.index') && !request('status') ? 'bg-red-500' : 'bg-gray-300' }}"></div>
                                Menunggu Verifikasi
                            </div>
                            @if($paymentPendingCount > 0)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    {{ $paymentPendingCount }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('admin.verifikasi.index', ['status' => 'paid']) }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request('status') === 'paid' ? 'bg-green-50 text-green-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="w-2 h-2 rounded-full mr-3 {{ request('status') === 'paid' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                            Sudah Diverifikasi
                        </a>
                    </div>
                </div>

                <!-- Laporan -->
                <div x-data="{ open: {{ request()->routeIs('admin.laporan.*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open"
                            class="group w-full flex items-center justify-between p-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.laporan.*') ? 'bg-gradient-to-r from-purple-500 to-indigo-500 text-white shadow-lg shadow-purple-500/25' : 'text-gray-700 hover:bg-gray-50 hover:shadow-md' }}">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.laporan.*') ? 'bg-white/20' : 'bg-purple-50 group-hover:bg-purple-100' }}">
                                <svg class="w-5 h-5 {{ request()->routeIs('admin.laporan.*') ? 'text-white' : 'text-purple-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <span class="font-semibold">Laporan</span>
                        </div>
                        <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="ml-4 space-y-1 border-l-2 border-gray-100 pl-4">
                        <a href="{{ route('admin.laporan.peserta') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.laporan.peserta') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="w-2 h-2 rounded-full mr-3 {{ request()->routeIs('admin.laporan.peserta') ? 'bg-blue-500' : 'bg-gray-300' }}"></div>
                            Laporan Peserta
                        </a>
                        <a href="{{ route('admin.laporan.pembayaran') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.laporan.pembayaran') ? 'bg-green-50 text-green-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="w-2 h-2 rounded-full mr-3 {{ request()->routeIs('admin.laporan.pembayaran') ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                            Laporan Pembayaran
                        </a>
                        <a href="{{ route('admin.laporan.keuangan') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.laporan.keuangan') ? 'bg-purple-50 text-purple-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="w-2 h-2 rounded-full mr-3 {{ request()->routeIs('admin.laporan.keuangan') ? 'bg-purple-500' : 'bg-gray-300' }}"></div>
                            Laporan Keuangan
                        </a>
                        <a href="{{ route('admin.laporan.statistik') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.laporan.statistik') ? 'bg-orange-50 text-orange-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="w-2 h-2 rounded-full mr-3 {{ request()->routeIs('admin.laporan.statistik') ? 'bg-orange-500' : 'bg-gray-300' }}"></div>
                            Statistik & Analitik
                        </a>
                    </div>
                </div>

                <!-- Master Data -->
                <div x-data="{ open: {{ request()->routeIs('admin.master.*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open"
                            class="group w-full flex items-center justify-between p-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.master.*') ? 'bg-gradient-to-r from-emerald-500 to-green-500 text-white shadow-lg shadow-emerald-500/25' : 'text-gray-700 hover:bg-gray-50 hover:shadow-md' }}">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.master.*') ? 'bg-white/20' : 'bg-emerald-50 group-hover:bg-emerald-100' }}">
                                <svg class="w-5 h-5 {{ request()->routeIs('admin.master.*') ? 'text-white' : 'text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                                </svg>
                            </div>
                            <span class="font-semibold">Master Data</span>
                        </div>
                        <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="ml-4 space-y-1 border-l-2 border-gray-100 pl-4">
                        <a href="{{ route('admin.master.kategori-usia.index') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.master.kategori-usia.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="w-2 h-2 rounded-full mr-3 {{ request()->routeIs('admin.master.kategori-usia.*') ? 'bg-indigo-500' : 'bg-gray-300' }}"></div>
                            Kategori Usia
                        </a>
                        <a href="{{ route('admin.master.ranting.index') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.master.ranting.*') ? 'bg-pink-50 text-pink-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="w-2 h-2 rounded-full mr-3 {{ request()->routeIs('admin.master.ranting.*') ? 'bg-pink-500' : 'bg-gray-300' }}"></div>
                            Ranting/Cabang
                        </a>
                        <a href="{{ route('admin.master.biaya-kategori.index') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.master.biaya-kategori.*') ? 'bg-green-50 text-green-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="w-2 h-2 rounded-full mr-3 {{ request()->routeIs('admin.master.biaya-kategori.*') ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                            Biaya Kategori
                        </a>
                        <a href="{{ route('admin.master.settings') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.master.settings') ? 'bg-gray-50 text-gray-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="w-2 h-2 rounded-full mr-3 {{ request()->routeIs('admin.master.settings') ? 'bg-gray-500' : 'bg-gray-300' }}"></div>
                            Pengaturan Sistem
                        </a>
                    </div>
                </div>

                <!-- Export -->
                <div x-data="{ open: false }" class="space-y-1">
                    <button @click="open = !open"
                            class="group w-full flex items-center justify-between p-3 text-sm font-medium rounded-xl transition-all duration-200 text-gray-700 hover:bg-gray-50 hover:shadow-md">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 bg-cyan-50 group-hover:bg-cyan-100">
                                <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="font-semibold">Export Data</span>
                        </div>
                        <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="ml-4 space-y-1 border-l-2 border-gray-100 pl-4">
                        <a href="{{ route('admin.export.peserta.excel') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 text-gray-600 hover:bg-green-50 hover:text-green-700">
                            <div class="w-2 h-2 rounded-full mr-3 bg-green-400"></div>
                            Data Peserta (Excel)
                        </a>
                        <a href="{{ route('admin.export.pembayaran.excel') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 text-gray-600 hover:bg-blue-50 hover:text-blue-700">
                            <div class="w-2 h-2 rounded-full mr-3 bg-blue-400"></div>
                            Data Pembayaran (Excel)
                        </a>
                        <a href="{{ route('admin.export.daftar.hadir') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 text-gray-600 hover:bg-purple-50 hover:text-purple-700">
                            <div class="w-2 h-2 rounded-full mr-3 bg-purple-400"></div>
                            Daftar Hadir (PDF)
                        </a>
                    </div>
                </div>

                <!-- Clustering -->
                <a href="{{ route('admin.clustering') }}"
                   class="group flex items-center p-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.clustering') ? 'bg-gradient-to-r from-orange-500 to-red-600 text-white shadow-lg shadow-orange-500/25' : 'text-gray-700 hover:bg-gray-50 hover:shadow-md' }}">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.clustering') ? 'bg-white/20' : 'bg-orange-50 group-hover:bg-orange-100' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.clustering') ? 'text-white' : 'text-orange-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Clustering Umur</span>
                </a>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-6"></div>

                <!-- Quick Actions -->
                <div class="space-y-3">
                    <div class="flex items-center px-2">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Quick Actions</h3>
                        <div class="flex-1 h-px bg-gray-200 ml-3"></div>
                    </div>

                    <a href="{{ route('admin.peserta.index', ['status_pendaftaran' => 'pending']) }}"
                       class="group flex items-center justify-between p-3 text-sm bg-gradient-to-r from-amber-50 to-orange-50 hover:from-amber-100 hover:to-orange-100 rounded-xl border border-amber-100 transition-all duration-200">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-amber-800">Review Pendaftaran</div>
                                <div class="text-xs text-amber-600">Perlu perhatian segera</div>
                            </div>
                        </div>
                        @php $pendingCount = \App\Models\Peserta::pending()->count(); @endphp
                        @if($pendingCount > 0)
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-200 text-amber-900 animate-pulse">
                                    {{ $pendingCount }}
                                </span>
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        @else
                            <div class="text-xs text-green-600 font-medium">✓ Semua sudah direview</div>
                        @endif
                    </a>

                    <a href="{{ route('admin.verifikasi.index') }}"
                       class="group flex items-center justify-between p-3 text-sm bg-gradient-to-r from-red-50 to-pink-50 hover:from-red-100 hover:to-pink-100 rounded-xl border border-red-100 transition-all duration-200">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-pink-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-red-800">Verifikasi Pembayaran</div>
                                <div class="text-xs text-red-600">Menunggu konfirmasi</div>
                            </div>
                        </div>
                        @php $paymentPendingCount = \App\Models\Pembayaran::pending()->count(); @endphp
                        @if($paymentPendingCount > 0)
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-red-200 text-red-900 animate-bounce">
                                    {{ $paymentPendingCount }}
                                </span>
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        @else
                            <div class="text-xs text-green-600 font-medium">✓ Semua terverifikasi</div>
                        @endif
                    </a>
                </div>
            </nav>
        </div>
    </div>
</div>

<!-- Mobile Sidebar Overlay -->
<div x-data="{ mobileOpen: false }"
     @toggle-sidebar.window="mobileOpen = !mobileOpen"
     class="lg:hidden">

    <!-- Overlay -->
    <div x-show="mobileOpen"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900 bg-opacity-75 z-40 backdrop-blur-sm"
         @click="mobileOpen = false"></div>

    <!-- Mobile Sidebar -->
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="fixed left-0 top-0 bottom-0 h-screen w-80 bg-white shadow-xl border-r border-gray-200 z-50">

        <div class="flex flex-col h-full pt-16">
            <!-- Mobile Header -->
            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Menu</h2>
                        </div>
                    </div>
                    <button @click="mobileOpen = false" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Sidebar Content -->
            <div class="flex-1 overflow-y-auto py-4 px-4">
                <nav class="space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                       @click="mobileOpen = false"
                       class="flex items-center p-4 text-sm font-semibold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50' }}">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'bg-blue-50' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        Dashboard
                    </a>

                    <!-- Quick Links for Mobile -->
                    <a href="{{ route('admin.peserta.index') }}"
                       @click="mobileOpen = false"
                       class="flex items-center p-4 text-sm font-semibold text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 bg-amber-50">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        Kelola Peserta
                    </a>

                    <a href="{{ route('admin.verifikasi.index') }}"
                       @click="mobileOpen = false"
                       class="flex items-center justify-between p-4 text-sm font-semibold text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 bg-red-50">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            Verifikasi Pembayaran
                        </div>
                        @php $paymentPendingCount = \App\Models\Pembayaran::pending()->count(); @endphp
                        @if($paymentPendingCount > 0)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 animate-pulse">
                                {{ $paymentPendingCount }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('admin.laporan.peserta') }}"
                       @click="mobileOpen = false"
                       class="flex items-center p-4 text-sm font-semibold text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 bg-purple-50">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        Laporan & Statistik
                    </a>

                    <a href="{{ route('admin.clustering') }}"
                       @click="mobileOpen = false"
                       class="flex items-center p-4 text-sm font-semibold text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 bg-orange-50">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        Clustering Umur
                    </a>

                    <a href="{{ route('admin.master.settings') }}"
                       @click="mobileOpen = false"
                       class="flex items-center p-4 text-sm font-semibold text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 bg-emerald-50">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        Master Data & Settings
                    </a>

                    <!-- Mobile Quick Actions -->
                    <div class="border-t border-gray-200 my-6 pt-6">
                        <div class="flex items-center px-2 mb-4">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Quick Actions</h3>
                            <div class="flex-1 h-px bg-gray-200 ml-3"></div>
                        </div>

                        <a href="{{ route('admin.peserta.index', ['status_pendaftaran' => 'pending']) }}"
                           @click="mobileOpen = false"
                           class="flex items-center justify-between p-3 text-sm bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl border border-amber-100 mb-3">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/>
                                    </svg>
                                </div>
                                <span class="font-semibold text-amber-800">Review Pendaftaran</span>
                            </div>
                            @php $pendingCount = \App\Models\Peserta::pending()->count(); @endphp
                            @if($pendingCount > 0)
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-bold bg-amber-200 text-amber-900">
                                    {{ $pendingCount }}
                                </span>
                            @endif
                        </a>

                        <a href="{{ route('admin.verifikasi.index') }}"
                           @click="mobileOpen = false"
                           class="flex items-center justify-between p-3 text-sm bg-gradient-to-r from-red-50 to-pink-50 rounded-xl border border-red-100">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2"/>
                                    </svg>
                                </div>
                                <span class="font-semibold text-red-800">Verifikasi Bayar</span>
                            </div>
                            @if($paymentPendingCount > 0)
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-bold bg-red-200 text-red-900">
                                    {{ $paymentPendingCount }}
                                </span>
                            @endif
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom scrollbar untuk sidebar */
.overflow-y-auto::-webkit-scrollbar {
    width: 4px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: transparent;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #D1D5DB;
    border-radius: 2px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #9CA3AF;
}

/* Hover effects */
.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}

/* Animation improvements */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-slide-in {
    animation: slideIn 0.3s ease-out;
}

/* Backdrop blur fallback */
@supports not (backdrop-filter: blur(8px)) {
    .backdrop-blur-sm {
        background-color: rgba(17, 24, 39, 0.8);
    }
}
</style>
