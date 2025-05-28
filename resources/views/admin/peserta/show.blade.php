@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 rounded-2xl shadow-2xl overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-indigo-800/30"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-white/5 to-transparent rounded-full transform translate-x-32 -translate-y-32"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-blue-500/10 to-transparent rounded-full transform -translate-x-16 translate-y-16"></div>

        <div class="relative p-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                <div class="mb-6 lg:mb-0">
                    <div class="flex items-center space-x-4 mb-4">
                        <a href="{{ route('admin.peserta.index') }}"
                           class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 border border-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                        </a>
                        <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">Detail Peserta</h1>
                            <p class="text-blue-100 text-lg">Informasi lengkap peserta kejuaraan INKAI Kediri</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-4">
                    @if($peserta->status_pendaftaran === 'pending')
                        <button onclick="confirmAction('{{ route('admin.peserta.approve', $peserta->id) }}', 'Setujui peserta ini?')"
                                class="bg-green-500/20 backdrop-blur-sm text-green-100 px-6 py-3 rounded-xl font-semibold hover:bg-green-500/30 transition-all duration-300 border border-green-400/30 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Setujui</span>
                        </button>
                        <button onclick="rejectPeserta()"
                                class="bg-red-500/20 backdrop-blur-sm text-red-100 px-6 py-3 rounded-xl font-semibold hover:bg-red-500/30 transition-all duration-300 border border-red-400/30 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span>Tolak</span>
                        </button>
                    @endif
                    <a href="{{ route('admin.peserta.edit', $peserta->id) }}"
                       class="bg-white/10 backdrop-blur-sm text-white px-6 py-3 rounded-xl font-semibold hover:bg-white/20 transition-all duration-300 border border-white/20 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>Edit</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Alert -->
    @if($peserta->status_pendaftaran === 'pending')
        <div class="group relative bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-50 to-orange-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-amber-800 mb-2">Pendaftaran Menunggu Persetujuan</h3>
                        <p class="text-amber-700">Peserta ini masih menunggu persetujuan admin untuk melanjutkan ke tahap pembayaran.</p>
                    </div>
                </div>
            </div>
        </div>
    @elseif($peserta->status_pendaftaran === 'approved')
        <div class="group relative bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-green-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-green-800 mb-2">Pendaftaran Disetujui</h3>
                        <p class="text-green-700">Peserta telah disetujui dan dapat melanjutkan proses pembayaran.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="group relative bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-red-50 to-pink-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-500 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-red-800 mb-2">Pendaftaran Ditolak</h3>
                        <p class="text-red-700">Pendaftaran peserta ini telah ditolak oleh admin.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="xl:col-span-2 space-y-8">
            <!-- Personal Information -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Informasi Pribadi</h3>
                            <p class="text-gray-500 text-sm mt-1">Data personal peserta kejuaraan</p>
                        </div>
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    <div class="flex flex-col lg:flex-row space-y-6 lg:space-y-0 lg:space-x-8">
                        <!-- Photo Section -->
                        <div class="flex-shrink-0">
                            @if($peserta->foto_path)
                                <div class="relative group">
                                    <img src="{{ Storage::url($peserta->foto_path) }}"
                                         alt="Foto {{ $peserta->nama_lengkap }}"
                                         class="w-40 h-48 object-cover rounded-2xl border-4 border-gray-200 shadow-lg group-hover:shadow-xl transition-all duration-300 cursor-pointer">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-2xl transition-all duration-300 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                </div>
                            @else
                                <div class="w-40 h-48 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl border-4 border-gray-300 flex items-center justify-center shadow-lg">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span class="text-sm text-gray-500 font-medium">No Photo</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Details Section -->
                        <div class="flex-1 space-y-6">
                            <!-- Registration Code Highlight -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-blue-600">Kode Pendaftaran</label>
                                        <p class="text-2xl font-bold text-blue-700 cursor-pointer hover:text-blue-800 transition-colors"
                                           onclick="copyToClipboard('{{ $peserta->kode_pendaftaran }}', 'Kode pendaftaran')"
                                           title="Klik untuk menyalin">{{ $peserta->kode_pendaftaran }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Details Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Nama Lengkap</label>
                                    <p class="text-lg font-bold text-gray-900">{{ $peserta->nama_lengkap }}</p>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Tempat, Tanggal Lahir</label>
                                    <p class="text-gray-900 font-medium">{{ $peserta->tempat_tanggal_lahir }}</p>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Umur</label>
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                            {{ $peserta->umur }} tahun
                                        </span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Jenis Kelamin</label>
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $peserta->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                            {{ $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Golongan Darah</label>
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                            {{ $peserta->golongan_darah }}
                                        </span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Berat Badan</label>
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                            {{ $peserta->berat_badan }} KG
                                        </span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">No. Telepon</label>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <p class="text-gray-900 font-medium">{{ $peserta->no_telepon }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Alamat</label>
                                <div class="flex items-start space-x-2">
                                    <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <p class="text-gray-900 font-medium leading-relaxed">{{ $peserta->alamat }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Organization Info -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Informasi Organisasi</h3>
                            <p class="text-gray-500 text-sm mt-1">Data ranting dan kategori usia</p>
                        </div>
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <label class="text-sm font-semibold text-green-600 uppercase tracking-wider">Ranting/Afiliasi</label>
                                </div>
                                <p class="text-xl font-bold text-green-800 mb-2">{{ $peserta->ranting->nama_ranting }}</p>
                                <p class="text-green-600 font-medium">{{ $peserta->ranting->kota }}, {{ $peserta->ranting->provinsi }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <label class="text-sm font-semibold text-blue-600 uppercase tracking-wider">Kategori Usia</label>
                                </div>
                                <p class="text-xl font-bold text-blue-800 mb-2">{{ $peserta->kategoriUsia->nama_kategori }}</p>
                                <p class="text-blue-600 font-medium">{{ $peserta->kategoriUsia->rentang_usia }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Competition Categories -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Kategori Pertandingan</h3>
                            <p class="text-gray-500 text-sm mt-1">Kategori yang dipilih peserta</p>
                        </div>
                        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        @foreach($peserta->kategori_dipilih as $kategori)
                            <div class="group bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-lg font-bold text-green-800">{{ $kategori }}</span>
                                        <p class="text-sm text-green-600">Kategori Terdaftar</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total Cost -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                    </svg>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-blue-600 uppercase tracking-wider">Total Biaya Pendaftaran</label>
                                    <p class="text-sm text-blue-500 mt-1">Biaya untuk semua kategori yang dipilih</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-3xl font-bold text-blue-700">{{ $peserta->formatted_total_biaya }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Info -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Informasi Akun</h3>
                            <p class="text-gray-500 text-sm mt-1">Data akun dan timeline pendaftaran</p>
                        </div>
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Email</label>
                                    <p class="text-lg font-semibold text-gray-900">{{ $peserta->user->email }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Role</label>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800 mt-1">
                                        {{ ucfirst($peserta->user->role) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a2 2 0 100-4 2 2 0 000 4zm6 0a2 2 0 100-4 2 2 0 000 4zm-6 4a2 2 0 100-4 2 2 0 000 4zm6 0a2 2 0 100-4 2 2 0 000 4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Tanggal Daftar</label>
                                    <p class="text-lg font-semibold text-gray-900">{{ $peserta->created_at->format('d/m/Y H:i') }}</p>
                                    <p class="text-sm text-gray-500">{{ $peserta->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Last Update</label>
                                    <p class="text-lg font-semibold text-gray-900">{{ $peserta->updated_at->format('d/m/Y H:i') }}</p>
                                    <p class="text-sm text-gray-500">{{ $peserta->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-8">
            <!-- Status Overview -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Status Overview</h3>
                            <p class="text-gray-500 text-sm mt-1">Status saat ini</p>
                        </div>
                        <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 {{ $peserta->status_pendaftaran === 'approved' ? 'bg-green-400' : ($peserta->status_pendaftaran === 'pending' ? 'bg-amber-400' : 'bg-red-400') }} rounded-full"></div>
                                <span class="text-gray-600 font-medium">Status Pendaftaran</span>
                            </div>
                            @if($peserta->status_pendaftaran === 'approved')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 cursor-pointer hover:bg-green-200 transition-colors status-pulse">
                                    Approved
                                </span>
                            @elseif($peserta->status_pendaftaran === 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 cursor-pointer hover:bg-amber-200 transition-colors status-pulse">
                                    Pending
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 cursor-pointer hover:bg-red-200 transition-colors status-pulse">
                                    Rejected
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 {{ $peserta->status_bayar === 'paid' ? 'bg-green-400' : ($peserta->status_bayar === 'pending' ? 'bg-amber-400' : 'bg-red-400') }} rounded-full"></div>
                                <span class="text-gray-600 font-medium">Status Pembayaran</span>
                            </div>
                            @if($peserta->status_bayar === 'paid')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 cursor-pointer hover:bg-green-200 transition-colors status-pulse">
                                    Lunas
                                </span>
                            @elseif($peserta->status_bayar === 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 cursor-pointer hover:bg-amber-200 transition-colors status-pulse">
                                    Pending
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 cursor-pointer hover:bg-red-200 transition-colors status-pulse">
                                    Belum Bayar
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment History -->
            @if($peserta->pembayaran->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Riwayat Pembayaran</h3>
                                <p class="text-gray-500 text-sm mt-1">{{ $peserta->pembayaran->count() }} transaksi</p>
                            </div>
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @foreach($peserta->pembayaran as $pembayaran)
                            <div class="p-6 hover:bg-gray-50 transition-colors duration-200 payment-item">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 {{ $pembayaran->status_bayar === 'paid' ? 'bg-green-100' : ($pembayaran->status_bayar === 'pending' ? 'bg-amber-100' : 'bg-red-100') }} rounded-lg flex items-center justify-center">
                                            @if($pembayaran->status_bayar === 'paid')
                                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @elseif($pembayaran->status_bayar === 'pending')
                                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="font-semibold text-gray-900">{{ $pembayaran->kode_pembayaran }}</span>
                                            <p class="text-sm text-gray-500">{{ $pembayaran->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    @if($pembayaran->status_bayar === 'paid')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            Lunas
                                        </span>
                                    @elseif($pembayaran->status_bayar === 'pending')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            Belum Bayar
                                        </span>
                                    @endif
                                </div>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500">Jumlah:</span>
                                        <span class="font-semibold text-gray-900">{{ $pembayaran->formatted_jumlah_bayar }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500">Metode:</span>
                                        <span class="text-gray-700">{{ $pembayaran->metode_pembayaran_formatted }}</span>
                                    </div>
                                    @if($pembayaran->tanggal_bayar)
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-500">Tanggal Bayar:</span>
                                            <span class="text-gray-700">{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</span>
                                        </div>
                                    @endif
                                    @if($pembayaran->verified_at)
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-500">Verified:</span>
                                            <span class="text-gray-700">{{ $pembayaran->verified_at->format('d/m/Y') }}</span>
                                        </div>
                                    @endif
                                    @if($pembayaran->verifiedBy)
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-500">Verified By:</span>
                                            <span class="text-gray-700">{{ $pembayaran->verifiedBy->name }}</span>
                                        </div>
                                    @endif
                                </div>
                                @if($pembayaran->status_bayar === 'pending')
                                    <div class="mt-4 pt-3 border-t border-gray-100">
                                        <a href="{{ route('admin.verifikasi.show', $pembayaran->id) }}"
                                           class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg text-sm font-semibold hover:bg-blue-100 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Lihat Bukti Pembayaran
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Quick Actions</h3>
                            <p class="text-gray-500 text-sm mt-1">Aksi cepat untuk peserta</p>
                        </div>
                        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <a href="{{ route('admin.export.sertifikat', $peserta->id) }}"
                           class="group w-full flex items-center p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 border border-blue-200 shine-effect">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="font-semibold text-blue-800">Download Sertifikat</div>
                                <div class="text-sm text-blue-600">Generate sertifikat peserta</div>
                            </div>
                            <svg class="w-5 h-5 text-blue-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        <button onclick="confirmDelete('{{ route('admin.peserta.destroy', $peserta->id) }}', 'Hapus peserta ini? Data tidak dapat dikembalikan!')"
                                class="group w-full flex items-center p-4 bg-gradient-to-r from-red-50 to-pink-50 rounded-xl hover:from-red-100 hover:to-pink-100 transition-all duration-200 border border-red-200 shine-effect">
                            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="font-semibold text-red-800">Hapus Peserta</div>
                                <div class="text-sm text-red-600">Hapus data peserta permanent</div>
                            </div>
                            <svg class="w-5 h-5 text-red-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 hidden">
        <div class="relative top-20 mx-auto p-0 border-0 w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden animate-scale-in">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-red-500 to-pink-500 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-white">Tolak Pendaftaran</h3>
                        </div>
                        <button onclick="closeRejectModal()" class="text-white/80 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <form id="rejectForm" method="POST" action="{{ route('admin.peserta.reject', $peserta->id) }}">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Alasan Penolakan</label>
                            <div class="relative">
                                <textarea name="reason" rows="4"
                                          class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-sm resize-none"
                                          placeholder="Berikan alasan yang jelas mengapa pendaftaran ini ditolak..." required></textarea>
                                <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                                    <span id="charCount">0</span>/500
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Alasan ini akan dikirimkan ke peserta melalui email</p>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeRejectModal()"
                                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-200">
                                Batal
                            </button>
                            <button type="submit"
                                    class="px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-xl font-semibold hover:from-red-600 hover:to-pink-600 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span>Konfirmasi Penolakan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-8 shadow-2xl flex items-center space-x-4">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <span class="text-gray-700 font-semibold">Memproses permintaan...</span>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Enhanced animations */
    .animate-slide-up {
        animation: slideUp 0.6s ease-out forwards;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .animate-scale-in {
        animation: scaleIn 0.3s ease-out forwards;
    }

    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #F3F4F6;
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb {
        background: #D1D5DB;
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #9CA3AF;
    }

    /* Enhanced hover effects */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    /* Loading animation */
    .loading-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    /* Modal backdrop blur */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }

    /* Better focus states */
    .focus\:ring-2:focus {
        outline: 2px solid transparent;
        outline-offset: 2px;
        box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.5);
    }

    /* Enhanced button effects */
    button:active {
        transform: translateY(1px);
    }

    /* Payment item hover effects */
    .payment-item {
        transition: all 0.2s ease;
    }

    .payment-item:hover {
        transform: translateX(4px);
        background-color: #F9FAFB;
    }

    /* Status badge hover effects */
    .inline-flex[class*="rounded-full"]:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
    }

    /* Responsive design improvements */
    @media (max-width: 768px) {
        .responsive-grid {
            grid-template-columns: 1fr;
        }

        .responsive-flex {
            flex-direction: column;
            gap: 1rem;
        }

        .xl\:col-span-2 {
            grid-column: span 1;
        }
    }

    /* Photo hover zoom effect */
    .group img {
        transition: all 0.3s ease;
    }

    .group:hover img {
        transform: scale(1.05);
    }

    /* Gradient text effects */
    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Card shadow depth on hover */
    .bg-white:hover {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    /* Badge pulse animation */
    .status-pulse {
        animation: statusPulse 2s infinite;
    }

    @keyframes statusPulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.05); }
    }

    /* Floating action button effect */
    .float-animation {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }

    /* Enhanced tooltips */
    .tooltip {
        position: relative;
    }

    .tooltip:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.9);
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 12px;
        white-space: nowrap;
        z-index: 1000;
        opacity: 1;
        transition: opacity 0.3s ease;
    }

    .tooltip:not(:hover)::after {
        opacity: 0;
    }

    /* Progress bar for loading states */
    .progress-bar {
        height: 4px;
        background: linear-gradient(90deg, #3B82F6, #8B5CF6);
        border-radius: 2px;
        animation: progress 2s ease-in-out infinite;
    }

    @keyframes progress {
        0% { width: 0%; }
        50% { width: 70%; }
        100% { width: 100%; }
    }

    /* Shine effect for interactive elements */
    .shine-effect {
        position: relative;
        overflow: hidden;
    }

    .shine-effect::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s;
    }

    .shine-effect:hover::before {
        left: 100%;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Enhanced SweetAlert2 configuration
    const swalConfig = {
        customClass: {
            popup: 'rounded-2xl',
            confirmButton: 'bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg font-semibold transition-colors duration-200',
            cancelButton: 'bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-lg font-semibold transition-colors duration-200 text-gray-700'
        },
        buttonsStyling: false
    };

    // Show reject modal with smooth animation
    function rejectPeserta() {
        const modal = document.getElementById('rejectModal');
        modal.classList.remove('hidden');
        modal.classList.add('animate-scale-in');

        // Focus on textarea with slight delay for better UX
        setTimeout(() => {
            const textarea = document.querySelector('#rejectModal textarea');
            if (textarea) {
                textarea.focus();
            }
        }, 300);
    }

    // Close reject modal with cleanup
    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        modal.classList.add('hidden');
        modal.classList.remove('animate-scale-in');
        document.getElementById('rejectForm').reset();
        updateCharCount();
    }

    // Confirm action with SweetAlert2
    function confirmAction(url, message) {
        Swal.fire({
            ...swalConfig,
            title: 'Konfirmasi',
            html: `
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-gray-600">${message}</p>
                    <p class="text-sm text-gray-500 mt-2">Tindakan ini akan mengubah status peserta</p>
                </div>
            `,
            showCancelButton: true,
            confirmButtonColor: '#10B981',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Setujui!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Confirm delete with SweetAlert2
    function confirmDelete(url, message) {
        Swal.fire({
            ...swalConfig,
            title: 'Konfirmasi Hapus',
            html: `
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                    <p class="text-gray-600">${message}</p>
                    <p class="text-sm text-red-500 mt-2 font-semibold">⚠️ Tindakan ini tidak dapat dibatalkan!</p>
                </div>
            `,
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Show loading overlay
    function showLoading() {
        document.getElementById('loadingOverlay').classList.remove('hidden');
    }

    // Hide loading overlay
    function hideLoading() {
        document.getElementById('loadingOverlay').classList.add('hidden');
    }

    // Update character count for reject reason textarea
    function updateCharCount() {
        const textarea = document.querySelector('#rejectModal textarea');
        const charCount = document.getElementById('charCount');
        if (textarea && charCount) {
            const count = textarea.value.length;
            charCount.textContent = count;

            // Change color based on character count
            if (count > 450) {
                charCount.className = 'text-red-500 font-semibold';
            } else if (count > 350) {
                charCount.className = 'text-yellow-500 font-medium';
            } else {
                charCount.className = 'text-gray-400';
            }

            // Prevent input beyond 500 characters
            if (count > 500) {
                textarea.value = textarea.value.substring(0, 500);
                charCount.textContent = 500;
            }
        }
    }

    // Copy to clipboard function
    function copyToClipboard(text, label) {
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({
                ...swalConfig,
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: `${label} disalin!`,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                customClass: {
                    popup: 'rounded-xl',
                    title: 'text-sm'
                }
            });
        }).catch(err => {
            Swal.fire({
                ...swalConfig,
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Gagal menyalin!',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                customClass: {
                    popup: 'rounded-xl',
                    title: 'text-sm'
                }
            });
        });
    }

    // Toast notification system
    function showToast(message, type = 'info') {
        const toastContainer = document.getElementById('toast-container') || createToastContainer();

        const toast = document.createElement('div');
        toast.className = `toast-item ${type} transform translate-x-full transition-transform duration-300 rounded-xl shadow-lg p-4 flex items-center space-x-3 max-w-sm`;

        const icons = {
            success: `<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                      </svg>`,
            error: `<svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                   </svg>`,
            warning: `<svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                     </svg>`,
            info: `<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>`
        };

        const colors = {
            success: 'bg-green-50 text-green-800 border-green-200',
            error: 'bg-red-50 text-red-800 border-red-200',
            warning: 'bg-yellow-50 text-yellow-800 border-yellow-200',
            info: 'bg-blue-50 text-blue-800 border-blue-200'
        };

        toast.innerHTML = `
            ${icons[type]}
            <span class="text-sm font-medium">${message}</span>
            <button onclick="this.parentElement.remove()" class="ml-auto text-gray-400 hover:text-gray-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;
        toast.className = `toast-item ${colors[type]} transform translate-x-full transition-transform duration-300 rounded-xl shadow-lg p-4 flex items-center space-x-3 max-w-sm border`;

        toastContainer.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
            toast.classList.add('translate-x-0');
        }, 100);

        // Auto-remove after 5 seconds
        setTimeout(() => {
            toast.classList.remove('translate-x-0');
            toast.classList.add('translate-x-full');
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }

    // Create toast container if it doesn't exist
    function createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'fixed top-4 right-4 z-50 space-y-2';
        document.body.appendChild(container);
        return container;
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', () => {
        // Character count for reject reason
        const textarea = document.querySelector('#rejectModal textarea');
        if (textarea) {
            textarea.addEventListener('input', updateCharCount);
            updateCharCount();
        }

        // Close modal on backdrop click
        const rejectModal = document.getElementById('rejectModal');
        rejectModal.addEventListener('click', (e) => {
            if (e.target === rejectModal) {
                closeRejectModal();
            }
        });

        // Form submission handling with loading state
        const rejectForm = document.getElementById('rejectForm');
        if (rejectForm) {
            rejectForm.addEventListener('submit', (e) => {
                showLoading();
            });
        }

        // Add animation to payment items
        const paymentItems = document.querySelectorAll('.payment-item');
        paymentItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
            item.classList.add('animate-slide-up');
        });

        // Initialize tooltips
        const tooltips = document.querySelectorAll('.tooltip');
        tooltips.forEach(tooltip => {
            tooltip.setAttribute('data-tooltip', tooltip.getAttribute('title') || '');
            tooltip.removeAttribute('title');
        });

        // Handle session messages
        @if(session('success'))
            showToast('{{ session('success') }}', 'success');
        @endif
        @if(session('error'))
            showToast('{{ session('error') }}', 'error');
        @endif
        @if(session('warning'))
            showToast('{{ session('warning') }}', 'warning');
        @endif
    });

    // Handle window unload to hide loading
    window.addEventListener('beforeunload', () => {
        hideLoading();
    });

    // Optimize performance for large lists
    const optimizeListRendering = () => {
        const paymentItems = document.querySelectorAll('.payment-item');
        if (paymentItems.length > 50) {
            paymentItems.forEach((item, index) => {
                if (index > 20) {
                    item.classList.add('hidden');
                    const loadMore = document.createElement('button');
                    loadMore.className = 'w-full p-4 bg-blue-50 text-blue-600 rounded-lg font-semibold hover:bg-blue-100 transition-colors duration-200';
                    loadMore.textContent = 'Load More';
                    loadMore.onclick = () => {
                        paymentItems.forEach(i => i.classList.remove('hidden'));
                        loadMore.remove();
                    };
                    item.parentNode.appendChild(loadMore);
                }
            });
        }
    };
    optimizeListRendering();
</script>
@endpush
