@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><defs><pattern id=%22grain%22 width=%2250%22 height=%2250%22 patternUnits=%22userSpaceOnUse%22><circle cx=%2225%22 cy=%2225%22 r=%221%22 fill=%22%23ffffff%22 opacity=%220.1%22/></pattern></defs><rect width=%22100%22 height=%22100%22 fill=%22url(%23grain)%22/></svg>');"></div>
    </div>

    <!-- Floating Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white bg-opacity-5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-white bg-opacity-5 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/4 w-64 h-64 bg-white bg-opacity-3 rounded-full blur-2xl animate-bounce delay-500"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Logo/Icon -->
        <div class="mb-8 animate-slide-up">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-white bg-opacity-10 rounded-full backdrop-blur-sm border border-white border-opacity-20 mb-6">
                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
        </div>

        <!-- Main Title -->
        <div class="mb-8 animate-slide-up delay-200">
            <h1 class="text-5xl md:text-7xl font-black text-white mb-4 leading-tight">
                {{ $event_name ?? 'Kejuaraan Karate INKAI Kediri 2025' }}
            </h1>
            <p class="text-xl md:text-2xl text-blue-200 font-light max-w-3xl mx-auto leading-relaxed">
                {{ $welcome_message ?? 'Daftarkan diri Anda dalam kejuaraan karate terbesar di Kediri dan buktikan kemampuan terbaik Anda!' }}
            </p>
        </div>

        <!-- Event Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 animate-slide-up delay-400">
            <div class="glass rounded-2xl p-6 text-white">
                <div class="text-blue-300 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-1">Tanggal</h3>
                <p class="text-blue-200">{{ $event_date ?? '15-17 Juni 2025' }}</p>
            </div>

            <div class="glass rounded-2xl p-6 text-white">
                <div class="text-blue-300 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-1">Lokasi</h3>
                <p class="text-blue-200">{{ $event_location ?? 'GOR Jayabaya Kediri' }}</p>
            </div>

            <div class="glass rounded-2xl p-6 text-white">
                <div class="text-blue-300 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-1">Deadline</h3>
                <p class="text-blue-200">{{ $registration_deadline ?? '10 Juni 2025' }}</p>
            </div>
        </div>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up delay-600">
            <a href="{{ route('pendaftaran.step1') }}"
               class="inline-flex items-center px-8 py-4 bg-white text-blue-900 font-bold text-lg rounded-2xl hover:bg-blue-50 transform hover:scale-105 transition-all duration-200 shadow-xl hover:shadow-2xl">
                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                </svg>
                Daftar Sekarang
            </a>

            <a href="{{ route('pembayaran.info') }}"
               class="inline-flex items-center px-8 py-4 bg-transparent text-white font-semibold text-lg rounded-2xl border-2 border-white hover:bg-white hover:text-blue-900 transform hover:scale-105 transition-all duration-200">
                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                Cek Status Pembayaran
            </a>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-white rounded-full flex justify-center">
            <div class="w-1 h-3 bg-white rounded-full mt-2 animate-pulse"></div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Kategori Pertandingan</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Pilih kategori yang sesuai dengan kemampuan dan usia Anda
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Kumite Perorangan -->
            <div class="group bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="text-red-600 mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2c-4 0-8 .5-8 4v9.5C4 17.43 5.57 19 7.5 19L6 20.5v.5h2.23l2-2H16l2 2H20v-.5L18.5 19c1.93 0 3.5-1.57 3.5-3.5V6c0-3.5-4-4-8-4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">Kumite Perorangan</h3>
                <p class="text-gray-600 text-center mb-4">Pertarungan satu lawan satu</p>
                <div class="text-center">
                    <span class="inline-block bg-red-600 text-white px-4 py-2 rounded-full font-semibold">
                        {{ $biaya_kategori ? 'Rp ' . number_format($biaya_kategori->biaya_kumite, 0, ',', '.') : 'Rp 50.000' }}
                    </span>
                </div>
            </div>

            <!-- Kata Perorangan -->
            <div class="group bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="text-blue-600 mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">Kata Perorangan</h3>
                <p class="text-gray-600 text-center mb-4">Demonstrasi gerakan individu</p>
                <div class="text-center">
                    <span class="inline-block bg-blue-600 text-white px-4 py-2 rounded-full font-semibold">
                        {{ $biaya_kategori ? 'Rp ' . number_format($biaya_kategori->biaya_kata, 0, ',', '.') : 'Rp 40.000' }}
                    </span>
                </div>
            </div>

            <!-- Kata Beregu -->
            <div class="group bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="text-green-600 mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.996 1.996 0 0 0 18.04 7h-.5c-.8 0-1.54.37-2.01 1.01L14 10v3h2v7h4zM12.5 11.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5S11 9.17 11 10s.67 1.5 1.5 1.5zm1.5 1h-4c-.83 0-1.5.67-1.5 1.5v6h2v7h3v-7h2v-6c0-.83-.67-1.5-1.5-1.5zM6 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm2 18v-6H5.5l2.54-7.63A1.996 1.996 0 0 1 9.96 7h.5c.8 0 1.54.37 2.01 1.01L14 10v3h-2v7H8z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">Kata Beregu</h3>
                <p class="text-gray-600 text-center mb-4">Demonstrasi gerakan tim</p>
                <div class="text-center">
                    <span class="inline-block bg-green-600 text-white px-4 py-2 rounded-full font-semibold">
                        {{ $biaya_kategori ? 'Rp ' . number_format($biaya_kategori->biaya_beregu, 0, ',', '.') : 'Rp 75.000' }}
                    </span>
                </div>
            </div>

            <!-- Kumite Beregu -->
            <div class="group bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="text-purple-600 mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 10c2.7 0 5.8 1.29 6 2H6c.23-.72 3.31-2 6-2M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 10c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">Kumite Beregu</h3>
                <p class="text-gray-600 text-center mb-4">Pertarungan tim</p>
                <div class="text-center">
                    <span class="inline-block bg-purple-600 text-white px-4 py-2 rounded-full font-semibold">
                        {{ $biaya_kategori ? 'Rp ' . number_format($biaya_kategori->biaya_beregu, 0, ',', '.') : 'Rp 75.000' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Statistik Kejuaraan</h2>
            <p class="text-xl text-gray-600">Data real-time pendaftaran peserta</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-lg text-center hover:shadow-xl transition-shadow duration-300">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                    </svg>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2" id="total-peserta">{{ \App\Models\Peserta::count() }}</div>
                <div class="text-gray-600">Total Peserta</div>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg text-center hover:shadow-xl transition-shadow duration-300">
                <div class="text-green-600 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">{{ \App\Models\Peserta::approved()->count() }}</div>
                <div class="text-gray-600">Peserta Disetujui</div>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg text-center hover:shadow-xl transition-shadow duration-300">
                <div class="text-purple-600 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">{{ $total_ranting ?? 20 }}</div>
                <div class="text-gray-600">Ranting/Cabang</div>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg text-center hover:shadow-xl transition-shadow duration-300">
                <div class="text-orange-600 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                    </svg>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">
                    Rp {{ number_format(\App\Models\Pembayaran::paid()->sum('jumlah_bayar'), 0, ',', '.') }}
                </div>
                <div class="text-gray-600">Total Revenue</div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Cara Pendaftaran</h2>
            <p class="text-xl text-gray-600">Ikuti langkah mudah berikut untuk mendaftar</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center group">
                <div class="relative mb-6">
                    <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-700 transition-colors duration-300">
                        <span class="text-2xl font-bold text-white">1</span>
                    </div>
                    <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-gray-300"></div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Isi Data Diri</h3>
                <p class="text-gray-600">Lengkapi informasi pribadi dan pilih kategori usia</p>
            </div>

            <div class="text-center group">
                <div class="relative mb-6">
                    <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-700 transition-colors duration-300">
                        <span class="text-2xl font-bold text-white">2</span>
                    </div>
                    <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-gray-300"></div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Pilih Kategori</h3>
                <p class="text-gray-600">Tentukan kategori pertandingan yang akan diikuti</p>
            </div>

            <div class="text-center group">
                <div class="relative mb-6">
                    <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-700 transition-colors duration-300">
                        <span class="text-2xl font-bold text-white">3</span>
                    </div>
                    <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-gray-300"></div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Upload Foto</h3>
                <p class="text-gray-600">Unggah foto 3x4 terbaru dengan format JPG/PNG</p>
            </div>

            <div class="text-center group">
                <div class="w-20 h-20 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-700 transition-colors duration-300">
                    <span class="text-2xl font-bold text-white">4</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Bayar & Selesai</h3>
                <p class="text-gray-600">Lakukan pembayaran dan tunggu verifikasi admin</p>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('pendaftaran.step1') }}"
               class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-bold text-lg rounded-2xl hover:bg-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                Mulai Pendaftaran
                <svg class="w-6 h-6 ml-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 bg-gradient-to-br from-gray-900 to-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Hubungi Kami</h2>
            <p class="text-xl text-gray-300">Ada pertanyaan? Jangan ragu untuk menghubungi kami</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="glass rounded-2xl p-8 text-center hover:bg-white hover:bg-opacity-10 transition-all duration-300">
                <div class="text-blue-400 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Alamat Sekretariat</h3>
                <p class="text-gray-300">{{ $office_address ?? 'Jl. Brawijaya No. 123, Kediri, Jawa Timur 64111' }}</p>
            </div>

            <div class="glass rounded-2xl p-8 text-center hover:bg-white hover:bg-opacity-10 transition-all duration-300">
                <div class="text-blue-400 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Telepon</h3>
                <p class="text-gray-300">{{ $office_phone ?? '(0354) 123-456' }}</p>
                <p class="text-gray-300">{{ $office_whatsapp ?? 'WA: 081234567890' }}</p>
            </div>

            <div class="glass rounded-2xl p-8 text-center hover:bg-white hover:bg-opacity-10 transition-all duration-300">
                <div class="text-blue-400 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Email</h3>
                <p class="text-gray-300">{{ $office_email ?? 'info@inkai-kediri.com' }}</p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Auto-update statistics every 30 seconds
    setInterval(function() {
        fetch('/api/stats')
            .then(response => response.json())
            .then(data => {
                if (data.total_peserta) {
                    document.getElementById('total-peserta').textContent = data.total_peserta;
                }
            })
            .catch(error => console.log('Stats update failed:', error));
    }, 30000);

    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Parallax effect for hero background
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector('.hero-bg');
        if (parallax) {
            const speed = scrolled * 0.5;
            parallax.style.transform = `translateY(${speed}px)`;
        }
    });
</script>
@endpush
