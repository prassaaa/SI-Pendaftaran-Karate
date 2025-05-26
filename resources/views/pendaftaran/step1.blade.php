@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Progress Steps -->
        <div class="mb-12">
            <div class="flex items-center justify-center space-x-8">
                <!-- Step 1 - Active -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                        1
                    </div>
                    <span class="ml-3 text-blue-600 font-semibold">Data Pribadi</span>
                </div>

                <!-- Connector -->
                <div class="w-12 h-1 bg-gray-300 rounded"></div>

                <!-- Step 2 - Inactive -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500 font-bold">
                        2
                    </div>
                    <span class="ml-3 text-gray-500 font-semibold">Kategori & Biaya</span>
                </div>

                <!-- Connector -->
                <div class="w-12 h-1 bg-gray-300 rounded"></div>

                <!-- Step 3 - Inactive -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500 font-bold">
                        3
                    </div>
                    <span class="ml-3 text-gray-500 font-semibold">Upload Foto</span>
                </div>

                <!-- Connector -->
                <div class="w-12 h-1 bg-gray-300 rounded"></div>

                <!-- Step 4 - Inactive -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500 font-bold">
                        4
                    </div>
                    <span class="ml-3 text-gray-500 font-semibold">Konfirmasi</span>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6">
                <h1 class="text-2xl font-bold text-white">Pendaftaran Peserta</h1>
                <p class="text-blue-100 mt-2">Silakan lengkapi data pribadi Anda dengan benar</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('pendaftaran.step1.post') }}" class="p-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2">
                        <label for="nama_lengkap" class="form-label">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Nama Lengkap
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <input type="text"
                               name="nama_lengkap"
                               id="nama_lengkap"
                               value="{{ old('nama_lengkap') }}"
                               class="form-input @error('nama_lengkap') border-red-500 @enderror"
                               placeholder="Masukkan nama lengkap sesuai KTP"
                               required>
                        @error('nama_lengkap')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label for="tempat_lahir" class="form-label">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Tempat Lahir
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <input type="text"
                               name="tempat_lahir"
                               id="tempat_lahir"
                               value="{{ old('tempat_lahir') }}"
                               class="form-input @error('tempat_lahir') border-red-500 @enderror"
                               placeholder="Contoh: Kediri"
                               required>
                        @error('tempat_lahir')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="tanggal_lahir" class="form-label">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Tanggal Lahir
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <input type="date"
                               name="tanggal_lahir"
                               id="tanggal_lahir"
                               value="{{ old('tanggal_lahir') }}"
                               class="form-input @error('tanggal_lahir') border-red-500 @enderror"
                               required>
                        @error('tanggal_lahir')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label for="alamat" class="form-label">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Alamat Lengkap
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <textarea name="alamat"
                                  id="alamat"
                                  rows="3"
                                  class="form-input @error('alamat') border-red-500 @enderror"
                                  placeholder="Masukkan alamat lengkap (RT/RW, Kelurahan, Kecamatan, Kota)"
                                  required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No Telepon -->
                    <div>
                        <label for="no_telepon" class="form-label">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                No. Telepon/HP
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <input type="tel"
                               name="no_telepon"
                               id="no_telepon"
                               value="{{ old('no_telepon') }}"
                               class="form-input @error('no_telepon') border-red-500 @enderror"
                               placeholder="08xxxxxxxxxx"
                               required>
                        @error('no_telepon')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="form-label">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                                Jenis Kelamin
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <div class="mt-2 space-y-3">
                            <label class="flex items-center">
                                <input type="radio"
                                       name="jenis_kelamin"
                                       value="L"
                                       {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="ml-3 text-gray-700">Laki-laki</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio"
                                       name="jenis_kelamin"
                                       value="P"
                                       {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="ml-3 text-gray-700">Perempuan</span>
                            </label>
                        </div>
                        @error('jenis_kelamin')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Golongan Darah -->
                    <div>
                        <label for="golongan_darah" class="form-label">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                Golongan Darah
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <select name="golongan_darah"
                                id="golongan_darah"
                                class="form-select @error('golongan_darah') border-red-500 @enderror"
                                required>
                            <option value="">Pilih Golongan Darah</option>
                            <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                            <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                        </select>
                        @error('golongan_darah')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ranting -->
                    <div>
                        <label for="ranting_id" class="form-label">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                Mewakili Ranting/Afiliasi
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <select name="ranting_id"
                                id="ranting_id"
                                class="form-select @error('ranting_id') border-red-500 @enderror"
                                required>
                            <option value="">Pilih Ranting/Afiliasi</option>
                            @foreach($ranting as $r)
                                <option value="{{ $r->id }}" {{ old('ranting_id') == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_ranting }} - {{ $r->kota }}
                                </option>
                            @endforeach
                        </select>
                        @error('ranting_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori Usia -->
                    <div>
                        <label for="kategori_usia_id" class="form-label">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Kelompok Usia
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <select name="kategori_usia_id"
                                id="kategori_usia_id"
                                class="form-select @error('kategori_usia_id') border-red-500 @enderror"
                                required>
                            <option value="">Pilih Kelompok Usia</option>
                            @foreach($kategori_usia as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_usia_id') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }} ({{ $kat->rentang_usia }})
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_usia_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Berat Badan -->
                    <div>
                        <label for="berat_badan" class="form-label">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                Berat Badan
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <div class="relative">
                            <input type="number"
                                   name="berat_badan"
                                   id="berat_badan"
                                   step="0.1"
                                   min="20"
                                   max="200"
                                   value="{{ old('berat_badan') }}"
                                   class="form-input @error('berat_badan') border-red-500 @enderror pr-12"
                                   placeholder="55.5"
                                   required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">KG</span>
                            </div>
                        </div>
                        @error('berat_badan')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('welcome') }}"
                       class="admin-btn-secondary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Beranda
                    </a>

                    <button type="submit" class="admin-btn-primary">
                        Lanjut ke Step 2
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-8 bg-blue-50 rounded-xl p-6">
            <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-blue-900 mb-2">Bantuan Pengisian Form</h3>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Pastikan semua data sesuai dengan dokumen resmi (KTP/Kartu Pelajar)</li>
                        <li>• Pilih ranting/afiliasi yang sesuai dengan tempat latihan Anda</li>
                        <li>• Berat badan akan digunakan untuk pembagian kelas pertandingan</li>
                        <li>• Jika ada kendala, hubungi panitia di (0354) 123-456</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Form validation and UX improvements
    document.addEventListener('DOMContentLoaded', function() {
        // Auto format phone number
        const phoneInput = document.getElementById('no_telepon');
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('8')) {
                value = '0' + value;
            }
            e.target.value = value;
        });

        // Auto calculate age from birth date
        const birthDateInput = document.getElementById('tanggal_lahir');
        birthDateInput.addEventListener('change', function(e) {
            const birthDate = new Date(e.target.value);
            const today = new Date();
            const age = today.getFullYear() - birthDate.getFullYear();

            // Optional: Show age info
            console.log('Umur:', age, 'tahun');
        });

        // Form submission with loading
        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            showLoading();
        });

        // Auto-save to localStorage (optional)
        const formInputs = form.querySelectorAll('input, select, textarea');
        formInputs.forEach(input => {
            // Load saved data
            const saved = localStorage.getItem('pendaftaran_' + input.name);
            if (saved && !input.value) {
                input.value = saved;
            }

            // Save on change
            input.addEventListener('change', function() {
                localStorage.setItem('pendaftaran_' + input.name, input.value);
            });
        });

        // Clear localStorage on successful submission
        if (window.location.search.includes('success')) {
            formInputs.forEach(input => {
                localStorage.removeItem('pendaftaran_' + input.name);
            });
        }
    });

    // Smooth scrolling to error
    if (document.querySelector('.form-error')) {
        document.querySelector('.form-error').scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }
</script>
@endpush
