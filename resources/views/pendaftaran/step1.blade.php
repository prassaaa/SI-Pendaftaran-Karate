@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        50: '#eff6ff',
                        100: '#dbeafe',
                        500: '#3b82f6',
                        600: '#2563eb',
                        700: '#1d4ed8',
                        800: '#1e40af',
                        900: '#1e3a8a'
                    }
                },
                fontFamily: {
                    'inter': ['Inter', 'system-ui', 'sans-serif']
                }
            }
        }
    }
</script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Inter', sans-serif; }
    .glass-effect {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .input-focus:focus {
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
    .step-active {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }
    .step-inactive {
        background: #e5e7eb;
        color: #6b7280;
    }
    .form-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }
    .floating-label {
        transition: all 0.2s ease;
    }
    .input-filled + .floating-label,
    .form-input:focus + .floating-label {
        transform: translateY(-1.5rem) scale(0.75);
        color: #3b82f6;
    }
</style>

<div class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">


    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Progress Steps -->
        <div class="mb-12">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-2 sm:space-x-4 overflow-x-auto pb-4">
                    <!-- Step 1 - Active -->
                    <div class="flex items-center flex-shrink-0">
                        <div class="relative">
                            <div class="step-active w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                1
                            </div>
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-400 to-indigo-600 rounded-full opacity-20 animate-pulse"></div>
                        </div>
                        <div class="ml-3 hidden sm:block">
                            <p class="text-sm font-semibold text-blue-600">Step 1</p>
                            <p class="text-xs text-gray-600">Data Pribadi</p>
                        </div>
                    </div>

                    <!-- Connector -->
                    <div class="w-8 h-0.5 bg-gradient-to-r from-blue-200 to-gray-300 mx-2"></div>

                    <!-- Step 2 -->
                    <div class="flex items-center flex-shrink-0">
                        <div class="step-inactive w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg">
                            2
                        </div>
                        <div class="ml-3 hidden sm:block">
                            <p class="text-sm font-semibold text-gray-500">Step 2</p>
                            <p class="text-xs text-gray-400">Kategori & Biaya</p>
                        </div>
                    </div>

                    <!-- Connector -->
                    <div class="w-8 h-0.5 bg-gray-300 mx-2"></div>

                    <!-- Step 3 -->
                    <div class="flex items-center flex-shrink-0">
                        <div class="step-inactive w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg">
                            3
                        </div>
                        <div class="ml-3 hidden sm:block">
                            <p class="text-sm font-semibold text-gray-500">Step 3</p>
                            <p class="text-xs text-gray-400">Upload Foto</p>
                        </div>
                    </div>

                    <!-- Connector -->
                    <div class="w-8 h-0.5 bg-gray-300 mx-2"></div>

                    <!-- Step 4 -->
                    <div class="flex items-center flex-shrink-0">
                        <div class="step-inactive w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg">
                            4
                        </div>
                        <div class="ml-3 hidden sm:block">
                            <p class="text-sm font-semibold text-gray-500">Step 4</p>
                            <p class="text-xs text-gray-400">Konfirmasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="glass-effect rounded-3xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 px-8 py-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-white mb-2">Data Pribadi</h2>
                        <p class="text-blue-100">Lengkapi informasi personal Anda dengan benar dan akurat</p>
                    </div>
                    <div class="hidden lg:block">
                        <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('pendaftaran.step1.post') }}" class="p-8 lg:p-12 space-y-8">
                @csrf
                <!-- Personal Information Section -->
                <div class="space-y-8">
                    <div class="flex items-center space-x-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Personal</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Nama Lengkap -->
                        <div class="lg:col-span-2">
                            <div class="relative">
                                <input type="text"
                                       id="nama_lengkap"
                                       name="nama_lengkap"
                                       value="{{ old('nama_lengkap') }}"
                                       class="form-input input-focus w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all duration-200 text-gray-900 bg-white @error('nama_lengkap') border-red-500 @enderror"
                                       placeholder=" "
                                       required>
                                <label for="nama_lengkap" class="floating-label absolute left-4 top-4 text-gray-500 transition-all duration-200 pointer-events-none">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                            </div>
                            @error('nama_lengkap')
                                <div class="field-error mt-2 text-sm text-red-600 flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @else
                                <p class="mt-2 text-sm text-gray-500">Sesuai dengan KTP atau dokumen resmi</p>
                            @enderror
                        </div>

                        <!-- Tempat Lahir -->
                        <div>
                            <div class="relative">
                                <input type="text"
                                       id="tempat_lahir"
                                       name="tempat_lahir"
                                       value="{{ old('tempat_lahir') }}"
                                       class="form-input input-focus w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all duration-200 text-gray-900 bg-white @error('tempat_lahir') border-red-500 @enderror"
                                       placeholder=" "
                                       required>
                                <label for="tempat_lahir" class="floating-label absolute left-4 top-4 text-gray-500 transition-all duration-200 pointer-events-none">
                                    Tempat Lahir <span class="text-red-500">*</span>
                                </label>
                            </div>
                            @error('tempat_lahir')
                                <div class="field-error mt-2 text-sm text-red-600 flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <div class="relative">
                                <input type="date"
                                       id="tanggal_lahir"
                                       name="tanggal_lahir"
                                       value="{{ old('tanggal_lahir') }}"
                                       class="form-input input-focus w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all duration-200 text-gray-900 bg-white @error('tanggal_lahir') border-red-500 @enderror"
                                       required>
                                <label for="tanggal_lahir" class="floating-label absolute left-4 -top-2 text-xs text-blue-600 bg-white px-2">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                            </div>
                            @error('tanggal_lahir')
                                <div class="field-error mt-2 text-sm text-red-600 flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="lg:col-span-2">
                            <div class="relative">
                                <textarea id="alamat"
                                          name="alamat"
                                          rows="4"
                                          class="form-input input-focus w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all duration-200 text-gray-900 bg-white resize-none @error('alamat') border-red-500 @enderror"
                                          placeholder=" "
                                          required>{{ old('alamat') }}</textarea>
                                <label for="alamat" class="floating-label absolute left-4 top-4 text-gray-500 transition-all duration-200 pointer-events-none">
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>
                            </div>
                            @error('alamat')
                                <div class="field-error mt-2 text-sm text-red-600 flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @else
                                <p class="mt-2 text-sm text-gray-500">Masukkan alamat lengkap (RT/RW, Kelurahan, Kecamatan, Kota)</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact & Physical Info -->
                <div class="space-y-8">
                    <div class="flex items-center space-x-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Kontak & Informasi Fisik</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- No Telepon -->
                        <div>
                            <div class="relative">
                                <input type="tel"
                                       id="no_telepon"
                                       name="no_telepon"
                                       value="{{ old('no_telepon') }}"
                                       class="form-input input-focus w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all duration-200 text-gray-900 bg-white @error('no_telepon') border-red-500 @enderror"
                                       placeholder=" "
                                       required>
                                <label for="no_telepon" class="floating-label absolute left-4 top-4 text-gray-500 transition-all duration-200 pointer-events-none">
                                    No. Telepon/HP <span class="text-red-500">*</span>
                                </label>
                            </div>
                            @error('no_telepon')
                                <div class="field-error mt-2 text-sm text-red-600 flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @else
                                <p class="mt-2 text-sm text-gray-500">Format: 08xxxxxxxxxx</p>
                            @enderror
                        </div>

                        <!-- Berat Badan -->
                        <div>
                            <div class="relative">
                                <input type="number"
                                       id="berat_badan"
                                       name="berat_badan"
                                       step="0.1"
                                       min="20"
                                       max="200"
                                       value="{{ old('berat_badan') }}"
                                       class="form-input input-focus w-full px-4 py-4 pr-16 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all duration-200 text-gray-900 bg-white @error('berat_badan') border-red-500 @enderror"
                                       placeholder=" "
                                       required>
                                <label for="berat_badan" class="floating-label absolute left-4 top-4 text-gray-500 transition-all duration-200 pointer-events-none">
                                    Berat Badan <span class="text-red-500">*</span>
                                </label>
                                <div class="absolute right-4 top-4 text-gray-500 font-medium">KG</div>
                            </div>
                            @error('berat_badan')
                                <div class="field-error mt-2 text-sm text-red-600 flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-4">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} class="peer sr-only">
                                    <div class="flex items-center justify-center p-4 border-2 border-gray-200 rounded-xl peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all duration-200 hover:bg-gray-50">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-6 h-6 rounded-full border-2 border-gray-300 peer-checked:border-blue-500 peer-checked:bg-blue-500 flex items-center justify-center">
                                                <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                            </div>
                                            <span class="font-medium text-gray-700">Laki-laki</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} class="peer sr-only">
                                    <div class="flex items-center justify-center p-4 border-2 border-gray-200 rounded-xl peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all duration-200 hover:bg-gray-50">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-6 h-6 rounded-full border-2 border-gray-300 peer-checked:border-blue-500 peer-checked:bg-blue-500 flex items-center justify-center">
                                                <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                            </div>
                                            <span class="font-medium text-gray-700">Perempuan</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('jenis_kelamin')
                                <div class="field-error mt-2 text-sm text-red-600 flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Golongan Darah -->
                        <div>
                            <label for="golongan_darah" class="block text-sm font-medium text-gray-700 mb-4">
                                Golongan Darah <span class="text-red-500">*</span>
                            </label>
                            <select id="golongan_darah"
                                    name="golongan_darah"
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all duration-200 text-gray-900 bg-white @error('golongan_darah') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Golongan Darah</option>
                                <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                            @error('golongan_darah')
                                <div class="field-error mt-2 text-sm text-red-600 flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Registration Info -->
                <div class="space-y-8">
                    <div class="flex items-center space-x-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Pendaftaran</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Ranting (Database) -->
                        <div>
                            <label for="ranting_id" class="block text-sm font-medium text-gray-700 mb-4">
                                Mewakili Ranting/Afiliasi <span class="text-red-500">*</span>
                            </label>
                            <select id="ranting_id"
                                    name="ranting_id"
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all duration-200 text-gray-900 bg-white @error('ranting_id') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Ranting/Afiliasi</option>
                                @foreach($ranting as $r)
                                    <option value="{{ $r->id }}" {{ old('ranting_id') == $r->id ? 'selected' : '' }}>
                                        {{ $r->nama_ranting }} - {{ $r->kota }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ranting_id')
                                <div class="field-error mt-2 text-sm text-red-600 flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Kategori Usia (Database) -->
                        <div>
                            <label for="kategori_usia_id" class="block text-sm font-medium text-gray-700 mb-4">
                                Kelompok Usia <span class="text-red-500">*</span>
                            </label>
                            <select id="kategori_usia_id"
                                    name="kategori_usia_id"
                                    class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all duration-200 text-gray-900 bg-white @error('kategori_usia_id') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Kelompok Usia</option>
                                @foreach($kategori_usia as $kat)
                                    <option value="{{ $kat->id }}" {{ old('kategori_usia_id') == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }} ({{ $kat->rentang_usia }})
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_usia_id')
                                <div class="field-error mt-2 text-sm text-red-600 flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between items-center pt-8 space-y-4 sm:space-y-0 border-t border-gray-200">
                    <a href="{{ route('welcome') }}"
                       class="w-full sm:w-auto px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200 flex items-center justify-center space-x-2 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Kembali ke Beranda</span>
                    </a>

                    <button type="submit"
                            class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-xl hover:from-blue-700 hover:to-indigo-800 transition-all duration-200 flex items-center justify-center space-x-2 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <span>Lanjut ke Step 2</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 shadow-sm">
            <div class="flex flex-col lg:flex-row items-start lg:items-center space-y-4 lg:space-y-0 lg:space-x-6">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-blue-900 mb-3">Tips Pengisian Form</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-blue-800">
                        <div class="flex items-start space-x-2">
                            <div class="w-2 h-2 bg-blue-400 rounded-full mt-2 flex-shrink-0"></div>
                            <span>Pastikan data sesuai dokumen resmi (KTP/Kartu Pelajar)</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <div class="w-2 h-2 bg-blue-400 rounded-full mt-2 flex-shrink-0"></div>
                            <span>Pilih ranting sesuai tempat latihan Anda</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <div class="w-2 h-2 bg-blue-400 rounded-full mt-2 flex-shrink-0"></div>
                            <span>Berat badan untuk pembagian kelas pertandingan</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <div class="w-2 h-2 bg-blue-400 rounded-full mt-2 flex-shrink-0"></div>
                            <span>Hubungi panitia di (0354) 123-456 jika ada kendala</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    // Enhanced form functionality
    document.addEventListener('DOMContentLoaded', function() {

        // ===== CLEAR DATA SECTION =====
        // Clear localStorage saat pertama kali buka halaman (dari luar sistem pendaftaran)
        if (!document.referrer.includes('pendaftaran')) {
            // Jika bukan dari halaman pendaftaran lain, clear semua data
            clearAllStoredData();
        }

        // Check URL parameter untuk reset
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('reset') === 'true') {
            clearAllStoredData();
            showNotification('Form telah direset', 'success');
        }

        // ===== FLOATING LABEL ANIMATION =====
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value) {
                    this.classList.add('input-filled');
                } else {
                    this.classList.remove('input-filled');
                }
            });

            // Check initial values (for Laravel old() data)
            if (input.value) {
                input.classList.add('input-filled');
            }
        });

        // ===== PHONE NUMBER FORMATTING =====
        const phoneInput = document.getElementById('no_telepon');
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('8')) {
                value = '0' + value;
            }
            e.target.value = value;
        });

        // ===== AUTO CALCULATE AGE =====
        const birthDateInput = document.getElementById('tanggal_lahir');
        const ageSelect = document.getElementById('kategori_usia_id');

        birthDateInput.addEventListener('change', function(e) {
            const birthDate = new Date(e.target.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            // Show age info
            showNotification(`Usia Anda: ${age} tahun`, 'info');
        });

        // ===== FORM VALIDATION =====
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            // Show loading
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = `
                <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Memproses...</span>
            `;
            submitBtn.disabled = true;

            // Basic client-side validation
            let isValid = true;

            // Validate phone number format
            const phoneValue = phoneInput.value;
            if (phoneValue && !/^0\d{9,12}$/.test(phoneValue)) {
                showNotification('Format nomor telepon tidak valid (contoh: 08123456789)', 'error');
                isValid = false;
                e.preventDefault();
            }

            // Validate weight range
            const weightInput = document.getElementById('berat_badan');
            const weight = parseFloat(weightInput.value);
            if (weight && (weight < 20 || weight > 200)) {
                showNotification('Berat badan harus antara 20-200 kg', 'error');
                isValid = false;
                e.preventDefault();
            }

            // Reset button if validation fails
            if (!isValid) {
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 100);
            }
        });

        // ===== AUTO-SAVE FUNCTIONALITY =====
        const formInputs = form.querySelectorAll('input, select, textarea');
        formInputs.forEach(input => {
            // Load saved data (only if no Laravel old() data exists)
            if (!input.value) {
                const saved = localStorage.getItem(`pendaftaran_${input.name}`);
                if (saved) {
                    input.value = saved;
                    if (input.classList.contains('form-input')) {
                        input.classList.add('input-filled');
                    }
                }
            }

            // Save on change
            input.addEventListener('change', function() {
                localStorage.setItem(`pendaftaran_${input.name}`, input.value);
            });

            // Clear validation errors on input
            input.addEventListener('input', function() {
                clearFieldError(this);
            });
        });

        // ===== RADIO BUTTON HANDLING =====
        const radioButtons = document.querySelectorAll('input[type="radio"]');
        radioButtons.forEach(radio => {
            if (radio.checked) {
                const parent = radio.closest('label').querySelector('div');
                parent.classList.add('border-blue-500', 'bg-blue-50');
                parent.classList.remove('border-gray-200');
            }

            radio.addEventListener('change', function() {
                // Update visual state for custom radio buttons
                const name = this.name;
                const radios = document.querySelectorAll(`input[name="${name}"]`);
                radios.forEach(r => {
                    const parent = r.closest('label').querySelector('div');
                    if (r.checked) {
                        parent.classList.add('border-blue-500', 'bg-blue-50');
                        parent.classList.remove('border-gray-200');
                    } else {
                        parent.classList.remove('border-blue-500', 'bg-blue-50');
                        parent.classList.add('border-gray-200');
                    }
                });
            });
        });

        // ===== CLEAR DATA ON SUCCESS =====
        @if(session('success'))
            clearAllStoredData();
            showNotification('{{ session('success') }}', 'success');
        @endif

        // ===== SHOW VALIDATION ERRORS =====
        @if($errors->any())
            showNotification('Mohon periksa kembali data yang Anda masukkan', 'error');
        @endif
    });

    // ===== UTILITY FUNCTIONS =====

    // Clear semua data yang tersimpan
    function clearAllStoredData() {
        // Clear localStorage
        Object.keys(localStorage).forEach(key => {
            if (key.startsWith('pendaftaran_')) {
                localStorage.removeItem(key);
            }
        });

        // Reset form jika ada
        const form = document.querySelector('form');
        if (form) {
            form.reset();

            // Reset floating labels
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.classList.remove('input-filled');
            });

            // Reset radio buttons visual state
            const radioContainers = document.querySelectorAll('input[type="radio"]');
            radioContainers.forEach(radio => {
                const parent = radio.closest('label').querySelector('div');
                if (parent) {
                    parent.classList.remove('border-blue-500', 'bg-blue-50');
                    parent.classList.add('border-gray-200');
                }
            });
        }
    }

    // Clear field error styling
    function clearFieldError(field) {
        field.classList.remove('border-red-500');
        field.classList.add('border-gray-200');
    }

    // Show notification
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existing = document.querySelector('.notification');
        if (existing) {
            existing.remove();
        }

        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            warning: 'bg-yellow-500',
            info: 'bg-blue-500'
        };

        const icons = {
            success: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>`,
            error: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>`,
            warning: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>`,
            info: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>`
        };

        const notification = document.createElement('div');
        notification.className = `notification fixed top-4 right-4 ${colors[type]} text-white px-6 py-4 rounded-lg shadow-lg z-50 flex items-center space-x-3 transform translate-x-full transition-transform duration-300`;
        notification.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${icons[type]}
            </svg>
            <span class="font-medium">${message}</span>
            <button onclick="this.parentElement.remove()" class="ml-4 text-white/80 hover:text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            }
        }, 5000);
    }

    // Manual reset function (untuk button reset jika diperlukan)
    function resetForm() {
        if (confirm('Yakin ingin menghapus semua data yang sudah diisi?')) {
            clearAllStoredData();
            showNotification('Form telah direset', 'success');
            location.reload();
        }
    }

    // ===== SCROLL TO ERROR ON LOAD =====
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const firstError = document.querySelector('.border-red-500');
                if (firstError) {
                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    firstError.focus();
                }
            }, 500);
        });
    @endif

    // ===== SMOOTH SCROLL TO TOP =====
    window.addEventListener('load', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // ===== HOVER EFFECTS =====
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effects to form sections
        const sections = document.querySelectorAll('.space-y-8 > .space-y-8');
        sections.forEach(section => {
            section.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'transform 0.2s ease';
            });

            section.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });

    // Console log for debugging
    console.log('Enhanced Registration Form JavaScript initialized');
</script>
@endsection

@push('scripts')
<script>
    // Additional Laravel-specific scripts can be added here
    console.log('Laravel Registration Form initialized');
</script>
@endpush
