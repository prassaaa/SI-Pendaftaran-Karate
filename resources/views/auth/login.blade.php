<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Kejuaraan Karate INKAI Kediri</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<!-- Login Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><defs><pattern id=%22grain%22 width=%2250%22 height=%2250%22 patternUnits=%22userSpaceOnUse%22><circle cx=%2225%22 cy=%2225%22 r=%221%22 fill=%22%23ffffff%22 opacity=%220.1%22/></pattern></defs><rect width=%22100%22 height=%22100%22 fill=%22url(%23grain)%22/></svg>');"></div>
    </div>

    <div class="relative z-10 w-full max-w-md mx-auto px-4">
        <!-- Login Card -->
        <div class="glass rounded-3xl p-8 backdrop-blur-lg border border-white border-opacity-20 shadow-2xl animate-slide-up">
            <!-- Logo/Icon -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-10 rounded-full backdrop-blur-sm border border-white border-opacity-20 mb-4">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Masuk</h1>
                <p class="text-blue-200">Silakan masuk untuk melanjutkan</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-500 bg-opacity-20 border border-green-400 border-opacity-30 rounded-xl text-green-100">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-white">
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-blue-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               autocomplete="username"
                               class="w-full pl-10 pr-4 py-3 bg-white bg-opacity-10 border border-white border-opacity-20 rounded-xl text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 focus:border-transparent backdrop-blur-sm transition-all duration-200"
                               placeholder="Masukkan email Anda">
                    </div>
                    @error('email')
                        <p class="text-red-300 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-white">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-blue-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                            </svg>
                        </div>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               autocomplete="current-password"
                               class="w-full pl-10 pr-4 py-3 bg-white bg-opacity-10 border border-white border-opacity-20 rounded-xl text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 focus:border-transparent backdrop-blur-sm transition-all duration-200"
                               placeholder="Masukkan password Anda">
                    </div>
                    @error('password')
                        <p class="text-red-300 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me"
                           type="checkbox"
                           name="remember"
                           class="h-4 w-4 bg-white bg-opacity-10 border border-white border-opacity-20 rounded focus:ring-white focus:ring-opacity-50 text-white">
                    <label for="remember_me" class="ml-3 text-sm text-blue-200">
                        Ingat saya
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="space-y-4">
                    <button type="submit"
                            class="w-full py-3 px-4 bg-white text-blue-900 font-bold text-lg rounded-xl hover:bg-blue-50 transform hover:scale-105 transition-all duration-200 shadow-xl hover:shadow-2xl">
                        Masuk
                    </button>

                    <!-- Links -->
                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-y-0 text-sm">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-blue-200 hover:text-white transition-colors duration-200">
                                Lupa password?
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="text-blue-200 hover:text-white transition-colors duration-200">
                                Belum punya akun? Daftar
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="{{ route('welcome') }}"
                   class="inline-flex items-center text-blue-200 hover:text-white transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    .glass {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-up {
        animation: slide-up 0.6s ease-out;
    }

    /* Custom checkbox styling */
    input[type="checkbox"]:checked {
        background-color: rgba(255, 255, 255, 0.8);
        border-color: rgba(255, 255, 255, 0.8);
    }
</style>
</body>
</html>
