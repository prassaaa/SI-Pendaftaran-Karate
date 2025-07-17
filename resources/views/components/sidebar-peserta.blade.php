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
                <a href="{{ route('peserta.dashboard') }}"
                   class="group flex items-center p-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('peserta.dashboard') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/25' : 'text-gray-700 hover:bg-gray-50 hover:shadow-md' }}">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('peserta.dashboard') ? 'bg-white/20' : 'bg-blue-50 group-hover:bg-blue-100' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('peserta.dashboard') ? 'text-white' : 'text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Dashboard</span>
                    @if(request()->routeIs('peserta.dashboard'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>

                <!-- Profile Management -->
                <div x-data="{ open: {{ request()->routeIs('peserta.profile.*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open"
                            class="group w-full flex items-center justify-between p-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('peserta.profile.*') ? 'bg-gradient-to-r from-emerald-500 to-green-500 text-white shadow-lg shadow-emerald-500/25' : 'text-gray-700 hover:bg-gray-50 hover:shadow-md' }}">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('peserta.profile.*') ? 'bg-white/20' : 'bg-emerald-50 group-hover:bg-emerald-100' }}">
                                <svg class="w-5 h-5 {{ request()->routeIs('peserta.profile.*') ? 'text-white' : 'text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <span class="font-semibold">Profile Saya</span>
                        </div>
                        <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="ml-4 space-y-1 border-l-2 border-gray-100 pl-4">
                        <a href="{{ route('peserta.profile.edit') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('peserta.profile.edit') ? 'bg-emerald-50 text-emerald-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="w-2 h-2 rounded-full mr-3 {{ request()->routeIs('peserta.profile.edit') ? 'bg-emerald-500' : 'bg-gray-300' }}"></div>
                            Kelola Profile
                        </a>
                        <a href="{{ route('peserta.profile.download-data') }}"
                           class="flex items-center p-2.5 text-sm rounded-lg transition-colors duration-200 text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <div class="w-2 h-2 rounded-full mr-3 bg-gray-300"></div>
                            Download Data
                        </a>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-6"></div>

                <!-- Quick Actions -->
                <div class="space-y-3">
                    <div class="flex items-center px-2">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Quick Actions</h3>
                        <div class="flex-1 h-px bg-gray-200 ml-3"></div>
                    </div>

                    <!-- Quick Edit Profile -->
                    <a href="{{ route('peserta.profile.edit') }}"
                       class="group flex items-center justify-between p-3 text-sm bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 rounded-xl border border-blue-100 transition-all duration-200">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-blue-800">Edit Profile</div>
                                <div class="text-xs text-blue-600">Perbarui data pribadi</div>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                    <!-- Download Data -->
                    <a href="{{ route('peserta.profile.download-data') }}"
                       class="group flex items-center justify-between p-3 text-sm bg-gradient-to-r from-emerald-50 to-green-50 hover:from-emerald-100 hover:to-green-100 rounded-xl border border-emerald-100 transition-all duration-200">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-green-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-emerald-800">Download Data</div>
                                <div class="text-xs text-emerald-600">Export data pribadi</div>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </nav>
        </div>

        <!-- User Info Footer -->
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="font-semibold text-sm text-gray-900 truncate">
                        {{ auth()->check() ? auth()->user()->name ?? 'Peserta' : 'Peserta' }}
                    </div>
                    <div class="text-xs text-gray-500 truncate">
                        {{ auth()->check() ? auth()->user()->email ?? 'Email tidak tersedia' : 'Tidak login' }}
                    </div>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Menu Peserta</h2>
                            <p class="text-sm text-gray-600">{{ auth()->check() ? auth()->user()->name ?? 'Peserta' : 'Peserta' }}</p>
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
                    <a href="{{ route('peserta.dashboard') }}"
                       @click="mobileOpen = false"
                       class="flex items-center p-4 text-sm font-semibold rounded-xl transition-all duration-200 {{ request()->routeIs('peserta.dashboard') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-50' }}">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 {{ request()->routeIs('peserta.dashboard') ? 'bg-white/20' : 'bg-blue-50' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('peserta.dashboard') ? 'text-white' : 'text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        Dashboard
                    </a>

                    <!-- Profile Menu -->
                    <a href="{{ route('peserta.profile.edit') }}"
                       @click="mobileOpen = false"
                       class="flex items-center p-4 text-sm font-semibold text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 bg-emerald-50">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        Kelola Profile
                    </a>

                    <a href="{{ route('peserta.profile.download-data') }}"
                       @click="mobileOpen = false"
                       class="flex items-center p-4 text-sm font-semibold text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 bg-blue-50">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        Download Data
                    </a>

                    <!-- Mobile Quick Actions -->
                    <div class="border-t border-gray-200 my-6 pt-6">
                        <div class="flex items-center px-2 mb-4">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Quick Actions</h3>
                            <div class="flex-1 h-px bg-gray-200 ml-3"></div>
                        </div>

                        <a href="{{ route('peserta.profile.download-data') }}"
                           @click="mobileOpen = false"
                           class="flex items-center justify-between p-3 text-sm bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl border border-emerald-100 mb-3">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-green-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <span class="font-semibold text-emerald-800">Download Data</span>
                            </div>
                        </a>
                    </div>
                </nav>
            </div>

            <!-- Mobile Footer -->
            <div class="p-4 border-t border-gray-100 bg-gray-50">
                <div class="text-center">
                    <div class="text-sm font-semibold text-gray-900">
                        {{ auth()->check() ? auth()->user()->name ?? 'Peserta' : 'Peserta' }}
                    </div>
                    <div class="text-xs text-gray-500 mt-1">
                        INKAI Kediri Portal
                    </div>
                </div>
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

/* Responsive design */
@media (max-width: 640px) {
    .w-80 {
        width: 100vw;
    }
}

/* Focus states for accessibility */
.sidebar-link:focus {
    outline: 2px solid #3B82F6;
    outline-offset: 2px;
}
</style>

<script>
// Enhanced sidebar functionality
document.addEventListener('DOMContentLoaded', function() {
    // Auto-collapse sidebar on smaller screens
    function handleSidebarResize() {
        if (window.innerWidth < 1024) {
            // On mobile, ensure sidebar is closed by default
            const sidebar = document.querySelector('[x-data*="sidebarOpen"]');
            if (sidebar) {
                Alpine.store('sidebar', { open: false });
            }
        }
    }

    // Listen for window resize
    window.addEventListener('resize', handleSidebarResize);

    // Initial check
    handleSidebarResize();

    // Smooth scrolling for sidebar links
    document.querySelectorAll('.sidebar-link').forEach(link => {
        link.addEventListener('click', function(e) {
            // Add loading state
            this.style.opacity = '0.7';
            setTimeout(() => {
                this.style.opacity = '1';
            }, 200);
        });
    });

    // Keyboard navigation support
    document.addEventListener('keydown', function(e) {
        // Toggle sidebar with Alt+S
        if (e.altKey && e.key === 's') {
            e.preventDefault();
            window.dispatchEvent(new CustomEvent('toggle-sidebar'));
        }

        // Quick navigation shortcuts
        if (e.ctrlKey || e.metaKey) {
            switch(e.key) {
                case 'h':
                    e.preventDefault();
                    window.location.href = "{{ route('peserta.dashboard') }}";
                    break;
                case 'p':
                    e.preventDefault();
                    window.location.href = "{{ route('peserta.profile.edit') }}";
                    break;
            }
        }
    });

    // Enhanced link click handlers
    document.querySelectorAll('a[href]').forEach(link => {
        link.addEventListener('click', function(e) {
            // Add visual feedback for navigation
            this.style.opacity = '0.7';
            setTimeout(() => {
                this.style.opacity = '1';
            }, 200);
        });
    });

    console.log('Sidebar Peserta Simple v1.0.0 loaded successfully! 🥋');
});
</script>
