@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Progress Steps -->
        <div class="mb-12">
            <div class="flex items-center justify-center space-x-8">
                <!-- All Steps Completed -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="ml-3 text-green-600 font-semibold">Data Pribadi</span>
                </div>

                <div class="w-12 h-1 bg-green-600 rounded"></div>

                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="ml-3 text-green-600 font-semibold">Kategori & Biaya</span>
                </div>

                <div class="w-12 h-1 bg-green-600 rounded"></div>

                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="ml-3 text-green-600 font-semibold">Upload Foto</span>
                </div>

                <div class="w-12 h-1 bg-green-600 rounded"></div>

                <!-- Step 4 - Active -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                        4
                    </div>
                    <span class="ml-3 text-blue-600 font-semibold">Konfirmasi</span>
                </div>
            </div>
        </div>

        <!-- Confirmation Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6">
                <h1 class="text-2xl font-bold text-white">Konfirmasi Data Pendaftaran</h1>
                <p class="text-blue-100 mt-2">Periksa kembali semua data sebelum menyelesaikan pendaftaran</p>
            </div>

            <div class="p-8">
                <!-- Summary Cards -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Personal Data -->
                    <div class="bg-gray-50 rounded-xl p-6 border-l-4 border-blue-500">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Pribadi
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between border-b border-gray-200 pb-2">
                                <span class="text-gray-600 font-medium">Nama Lengkap:</span>
                                <span class="font-semibold text-gray-900">{{ $step1['nama_lengkap'] }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-200 pb-2">
                                <span class="text-gray-600 font-medium">Tempat, Tanggal Lahir:</span>
                                <span class="font-semibold text-gray-900">{{ $step1['tempat_lahir'] }}, {{ date('d/m/Y', strtotime($step1['tanggal_lahir'])) }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-200 pb-2">
                                <span class="text-gray-600 font-medium">Jenis Kelamin:</span>
                                <span class="font-semibold text-gray-900">{{ $step1['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-200 pb-2">
                                <span class="text-gray-600 font-medium">Golongan Darah:</span>
                                <span class="font-semibold text-gray-900">{{ $step1['golongan_darah'] }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-200 pb-2">
                                <span class="text-gray-600 font-medium">Berat Badan:</span>
                                <span class="font-semibold text-gray-900">{{ $step1['berat_badan'] }} KG</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-200 pb-2">
                                <span class="text-gray-600 font-medium">No. Telepon:</span>
                                <span class="font-semibold text-gray-900">{{ $step1['no_telepon'] }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-200 pb-2">
                                <span class="text-gray-600 font-medium">Ranting:</span>
                                <span class="font-semibold text-gray-900">{{ $ranting->nama_ranting }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Kategori Usia:</span>
                                <span class="font-semibold text-gray-900">{{ $kategori_usia->nama_kategori }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Categories & Photo -->
                    <div class="space-y-6">
                        <!-- Selected Categories -->
                        <div class="bg-gray-50 rounded-xl p-6 border-l-4 border-green-500">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Kategori Pertandingan
                            </h3>
                            <div class="space-y-3">
                                @if($step2['kumite_perorangan'] ?? false)
                                    <div class="flex items-center justify-between py-3 px-4 bg-red-50 border border-red-200 rounded-lg shadow-sm">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-red-500 rounded-full mr-3"></div>
                                            <span class="text-red-800 font-medium">Kumite Perorangan</span>
                                        </div>
                                        <span class="text-red-600 font-bold">Rp 50.000</span>
                                    </div>
                                @endif
                                @if($step2['kata_perorangan'] ?? false)
                                    <div class="flex items-center justify-between py-3 px-4 bg-blue-50 border border-blue-200 rounded-lg shadow-sm">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                            <span class="text-blue-800 font-medium">Kata Perorangan</span>
                                        </div>
                                        <span class="text-blue-600 font-bold">Rp 40.000</span>
                                    </div>
                                @endif
                                @if($step2['kata_beregu'] ?? false)
                                    <div class="flex items-center justify-between py-3 px-4 bg-green-50 border border-green-200 rounded-lg shadow-sm">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                            <span class="text-green-800 font-medium">Kata Beregu</span>
                                        </div>
                                        <span class="text-green-600 font-bold">Rp 75.000</span>
                                    </div>
                                @endif
                                @if($step2['kumite_beregu'] ?? false)
                                    <div class="flex items-center justify-between py-3 px-4 bg-purple-50 border border-purple-200 rounded-lg shadow-sm">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                                            <span class="text-purple-800 font-medium">Kumite Beregu</span>
                                        </div>
                                        <span class="text-purple-600 font-bold">Rp 75.000</span>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-6 pt-4 border-t-2 border-gray-300">
                                <div class="flex justify-between items-center bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-lg">
                                    <span class="text-lg font-semibold text-gray-900 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                        Total Biaya:
                                    </span>
                                    <span class="text-2xl font-bold text-blue-600 bg-white px-4 py-2 rounded-lg shadow">
                                        Rp {{ number_format($step2['total_biaya'], 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Photo Preview -->
                        <div class="bg-gray-50 rounded-xl p-6 border-l-4 border-purple-500">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Foto Peserta
                            </h3>
                            <div class="flex justify-center">
                                <div class="w-32 h-40 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center shadow-inner">
                                    <div class="text-center">
                                        <div class="w-12 h-12 bg-gray-300 rounded-full mx-auto mb-2 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <span class="text-xs text-gray-500 font-medium">Foto 3x4</span>
                                        <div class="mt-1 flex items-center justify-center">
                                            <div class="w-2 h-2 bg-green-500 rounded-full mr-1"></div>
                                            <span class="text-xs text-green-600">Terupload</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 text-center mt-3 bg-blue-50 py-2 px-3 rounded-lg">
                                <svg class="w-4 h-4 inline mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Foto akan ditampilkan di dashboard setelah pendaftaran selesai
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Account Creation -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 mb-8 border border-blue-200">
                    <h3 class="text-lg font-semibold text-blue-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-11.255 3.043M10 12a4 4 0 00-4 4v3h8v-3a4 4 0 00-4-4z"/>
                        </svg>
                        Buat Akun Peserta
                    </h3>
                    <div class="bg-blue-100 border border-blue-300 rounded-lg p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Informasi Akun</h3>
                                <p class="mt-1 text-sm text-blue-700">
                                    Akun akan dibuat otomatis untuk mengakses dashboard peserta setelah pendaftaran selesai. Anda akan menerima email konfirmasi berisi detail login.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('pendaftaran.submit') }}" x-data="accountForm()" id="registrationForm" novalidate>
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="email" class="form-label flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                    Email untuk Login <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       class="form-input @error('email') border-red-500 @enderror transition-all duration-200 focus:ring-2 focus:ring-blue-500"
                                       placeholder="contoh@email.com"
                                       required
                                       autocomplete="email"
                                       onblur="validateEmail(this)">
                                @error('email')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                                <div id="email-error" class="form-error hidden"></div>
                                <p class="text-xs text-gray-500 mt-1">Email ini akan digunakan untuk login ke dashboard peserta</p>
                            </div>

                            <div>
                                <label for="password" class="form-label flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    Password <span class="text-red-500 ml-1">*</span>
                                </label>
                                <div class="relative">
                                    <input :type="showPassword ? 'text' : 'password'"
                                           name="password"
                                           id="password"
                                           class="form-input @error('password') border-red-500 @enderror pr-10 transition-all duration-200 focus:ring-2 focus:ring-blue-500"
                                           placeholder="Minimal 8 karakter"
                                           minlength="8"
                                           required
                                           autocomplete="new-password"
                                           oninput="validatePassword(this)">
                                    <button type="button"
                                            @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center transition-colors duration-200 hover:text-blue-600">
                                        <svg x-show="!showPassword" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg x-show="showPassword" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.757 6.757M9.878 9.878L12 12m6.121-3.121l2.122-2.122M15.121 12l-3 3"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                                <div id="password-error" class="form-error hidden"></div>
                                <!-- Password Strength Indicator -->
                                <div id="password-strength" class="mt-2 hidden">
                                    <div class="flex space-x-1">
                                        <div class="password-strength-bar flex-1 h-1 bg-gray-200 rounded"></div>
                                        <div class="password-strength-bar flex-1 h-1 bg-gray-200 rounded"></div>
                                        <div class="password-strength-bar flex-1 h-1 bg-gray-200 rounded"></div>
                                        <div class="password-strength-bar flex-1 h-1 bg-gray-200 rounded"></div>
                                    </div>
                                    <p id="password-strength-text" class="text-xs mt-1">Kekuatan password</p>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions - Enhanced -->
                        <div class="mt-8">
                            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-amber-800">Perhatian Penting</h3>
                                        <p class="mt-1 text-sm text-amber-700">
                                            Pastikan Anda telah membaca dan memahami syarat & ketentuan sebelum melanjutkan pendaftaran. Persetujuan ini bersifat mengikat secara hukum.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                                <label class="flex items-start space-x-4 cursor-pointer group hover:bg-gray-50 p-3 rounded-lg transition-colors duration-200">
                                    <div class="relative flex-shrink-0 mt-1">
                                        <input type="checkbox"
                                               name="agree_terms"
                                               id="agree_terms"
                                               required
                                               class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-2 border-gray-300 rounded transition-all duration-200 hover:border-blue-400 peer"
                                               onchange="toggleSubmitButton()">
                                        <!-- Custom checkbox styling -->
                                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity duration-200">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <span class="text-sm text-gray-700 leading-relaxed">
                                            Saya telah membaca, memahami, dan menyetujui
                                            <button type="button" onclick="openTermsModal()" class="text-blue-600 hover:text-blue-800 font-semibold underline decoration-2 underline-offset-2 transition-colors duration-200">
                                                Syarat dan Ketentuan
                                            </button>
                                            serta
                                            <button type="button" onclick="openPrivacyModal()" class="text-blue-600 hover:text-blue-800 font-semibold underline decoration-2 underline-offset-2 transition-colors duration-200">
                                                Kebijakan Privasi
                                            </button>
                                            dalam mengikuti kejuaraan ini.
                                        </span>
                                        <div class="mt-2 text-xs text-gray-500">
                                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                            </svg>
                                            Dengan mencentang kotak ini, Anda menyatakan setuju dengan semua persyaratan yang berlaku
                                        </div>
                                    </div>
                                </label>
                                @error('agree_terms')
                                    <p class="form-error mt-2">{{ $message }}</p>
                                @enderror
                                <div id="terms-error" class="form-error mt-2 hidden">Anda harus menyetujui syarat dan ketentuan untuk melanjutkan</div>
                            </div>
                        </div>

                        <!-- Final Summary -->
                        <div class="mt-8 bg-gradient-to-r from-white to-gray-50 rounded-xl p-6 border-2 border-blue-200 shadow-lg">
                            <div class="flex items-center justify-between mb-6">
                                <h4 class="text-xl font-bold text-gray-900 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Ringkasan Pendaftaran
                                </h4>
                                <span class="bg-gradient-to-r from-green-100 to-green-200 text-green-800 text-sm font-bold px-4 py-2 rounded-full border border-green-300 shadow-sm">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Siap Dikirim
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                                <div class="text-center p-5 bg-white rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-200">
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                    </div>
                                    <div class="text-3xl font-bold text-blue-600 mb-1">
                                        {{ count(array_filter([$step2['kumite_perorangan'] ?? false, $step2['kata_perorangan'] ?? false, $step2['kata_beregu'] ?? false, $step2['kumite_beregu'] ?? false])) }}
                                    </div>
                                    <div class="text-gray-600 font-medium">Kategori Dipilih</div>
                                </div>
                                <div class="text-center p-5 bg-white rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-200">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                    </div>
                                    <div class="text-3xl font-bold text-green-600 mb-1">
                                        Rp {{ number_format($step2['total_biaya'], 0, ',', '.') }}
                                    </div>
                                    <div class="text-gray-600 font-medium">Total Biaya</div>
                                </div>
                                <div class="text-center p-5 bg-white rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-200">
                                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="text-3xl font-bold text-purple-600 mb-1">1</div>
                                    <div class="text-gray-600 font-medium">Foto Terupload</div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row justify-between items-center mt-10 pt-6 border-t-2 border-gray-200 space-y-4 sm:space-y-0">
                            <a href="{{ route('pendaftaran.step3') }}"
                                class="admin-btn-secondary flex items-center justify-center w-full sm:w-auto order-2 sm:order-1 transition-all duration-200 hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali ke Step 3
                            </a>

                            <button type="button"
                                    id="submitButton"
                                    class="admin-btn-primary text-lg px-8 py-4 flex items-center justify-center w-full sm:w-auto order-1 sm:order-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-105 disabled:hover:scale-100"
                                    disabled
                                    onclick="handleSubmit(event)">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span id="submitButtonText">Selesaikan Pendaftaran</span>
                                <div id="submitButtonLoader" class="hidden ml-2">
                                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Terms Modal - Enhanced -->
        <div id="termsModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden backdrop-blur-sm">
            <div class="relative top-10 mx-auto p-0 border-0 w-11/12 md:w-3/4 lg:w-1/2 shadow-2xl rounded-2xl bg-white max-h-[90vh] flex flex-col">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4 rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Syarat dan Ketentuan
                        </h3>
                        <button onclick="closeTermsModal()" type="button" class="text-white hover:text-gray-200 transition-colors duration-200 p-1 rounded-full hover:bg-white hover:bg-opacity-20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex-1 overflow-y-auto px-6 py-4">
                    <div class="prose prose-sm max-w-none">
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        <strong>Penting:</strong> Mohon baca dengan teliti seluruh syarat dan ketentuan di bawah ini sebelum melanjutkan pendaftaran.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <ol class="list-decimal space-y-4 text-sm text-gray-700 leading-relaxed">
                            <li class="pl-2">
                                <strong>Kelayakan Peserta:</strong> Peserta wajib mengikuti semua peraturan pertandingan yang ditetapkan oleh INKAI dan memiliki sertifikat sabuk yang sesuai dengan kategori yang diikuti.
                            </li>
                            <li class="pl-2">
                                <strong>Keselamatan dan Tanggung Jawab:</strong> Peserta bertanggung jawab penuh atas keamanan dan keselamatan diri sendiri selama pertandingan. Panitia tidak bertanggung jawab atas cedera yang terjadi.
                            </li>
                            <li class="pl-2">
                                <strong>Pembayaran:</strong> Biaya pendaftaran yang sudah dibayar tidak dapat dikembalikan dalam kondisi apapun, termasuk pembatalan dari peserta atau force majeure.
                            </li>
                            <li class="pl-2">
                                <strong>Kehadiran:</strong> Peserta wajib hadir tepat waktu sesuai jadwal yang telah ditentukan. Keterlambatan lebih dari 15 menit dianggap sebagai pengunduran diri.
                            </li>
                            <li class="pl-2">
                                <strong>Absensi:</strong> Peserta yang tidak hadir tanpa pemberitahuan resmi minimal 24 jam sebelumnya dianggap mengundurkan diri dan kehilangan hak kompetisi.
                            </li>
                            <li class="pl-2">
                                <strong>Keputusan Wasit:</strong> Keputusan wasit dan juri bersifat final dan tidak dapat diganggu gugat. Segala bentuk protes harus disampaikan melalui prosedur resmi yang berlaku.
                            </li>
                            <li class="pl-2">
                                <strong>Diskualifikasi:</strong> Panitia berhak mendiskualifikasi peserta yang melanggar aturan, bersikap tidak sportif, atau melakukan tindakan yang merugikan acara.
                            </li>
                            <li class="pl-2">
                                <strong>Perlengkapan:</strong> Peserta wajib menggunakan perlengkapan karate yang sesuai standar INKAI, termasuk karategi yang bersih dan pelindung yang disetujui.
                            </li>
                            <li class="pl-2">
                                <strong>Asuransi:</strong> Peserta bertanggung jawab atas asuransi kesehatan pribadi dan disarankan memiliki asuransi yang mencakup aktivitas olahraga kontak.
                            </li>
                            <li class="pl-2">
                                <strong>Dokumentasi:</strong> Dengan mendaftar, peserta menyetujui penggunaan foto, video, dan nama untuk keperluan dokumentasi, promosi, dan publikasi acara tanpa kompensasi tambahan.
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 rounded-b-2xl">
                    <button onclick="closeTermsModal()" type="button" class="admin-btn-primary w-full transition-all duration-200 hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Saya Telah Memahami
                    </button>
                </div>
            </div>
        </div>

        <!-- Privacy Modal - Enhanced -->
        <div id="privacyModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden backdrop-blur-sm">
            <div class="relative top-10 mx-auto p-0 border-0 w-11/12 md:w-3/4 lg:w-1/2 shadow-2xl rounded-2xl bg-white max-h-[90vh] flex flex-col">
                <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-4 rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Kebijakan Privasi
                        </h3>
                        <button onclick="closePrivacyModal()" type="button" class="text-white hover:text-gray-200 transition-colors duration-200 p-1 rounded-full hover:bg-white hover:bg-opacity-20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex-1 overflow-y-auto px-6 py-4">
                    <div class="prose prose-sm max-w-none">
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Kami berkomitmen melindungi privasi dan keamanan data pribadi Anda sesuai dengan peraturan yang berlaku.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Pengumpulan Data
                                </h4>
                                <p class="text-sm text-gray-700 leading-relaxed">
                                    Kami mengumpulkan data pribadi yang Anda berikan saat mendaftar, termasuk namun tidak terbatas pada: nama lengkap, tanggal lahir, alamat, nomor telepon, email, foto, dan informasi medis dasar (golongan darah, berat badan) untuk keperluan administrasi pertandingan.
                                </p>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Penggunaan Data
                                </h4>
                                <p class="text-sm text-gray-700 leading-relaxed">
                                    Data yang dikumpulkan digunakan untuk keperluan administrasi pertandingan, verifikasi identitas, pengelompokkan kategori, komunikasi terkait acara, dan pembuatan sertifikat atau dokumentasi resmi. Data tidak akan digunakan untuk tujuan komersial tanpa persetujuan eksplisit.
                                </p>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    Keamanan Data
                                </h4>
                                <p class="text-sm text-gray-700 leading-relaxed">
                                    Kami berkomitmen menjaga keamanan data pribadi Anda dengan implementasi langkah-langkah keamanan teknis dan administratif yang sesuai, termasuk enkripsi data, akses terbatas, dan penyimpanan yang aman. Data akan disimpan hanya selama diperlukan untuk tujuan yang telah ditetapkan.
                                </p>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Pembagian Data
                                </h4>
                                <p class="text-sm text-gray-700 leading-relaxed">
                                    Data pribadi tidak akan dibagikan, dijual, atau diserahkan kepada pihak ketiga tanpa persetujuan eksplisit Anda, kecuali dalam situasi berikut: (1) untuk memenuhi kewajiban hukum, (2) untuk melindungi keamanan dan hak-hak kami, atau (3) kepada penyedia layanan terpercaya yang membantu operasional acara dengan kewajiban menjaga kerahasiaan.
                                </p>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Hak Anda
                                </h4>
                                <p class="text-sm text-gray-700 leading-relaxed">
                                    Anda memiliki hak untuk: (1) mengakses data pribadi yang kami simpan, (2) meminta koreksi data yang tidak akurat, (3) meminta penghapusan data dalam kondisi tertentu, (4) membatasi pemrosesan data, dan (5) memperoleh salinan data dalam format yang dapat dibaca. Untuk menggunakan hak-hak ini, silakan hubungi panitia melalui kontak resmi yang tersedia.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 rounded-b-2xl">
                    <button onclick="closePrivacyModal()" type="button" class="admin-btn-primary w-full transition-all duration-200 hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Saya Telah Memahami
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endsection

    @push('scripts')
    <script>
    let formSubmitted = false; // Prevent double submission

    function accountForm() {
        return {
            showPassword: false
        }
    }

    // Enhanced form validation
    function validateEmail(input) {
        const email = input.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const errorDiv = document.getElementById('email-error');

        if (email && !emailRegex.test(email)) {
            input.classList.add('border-red-500');
            errorDiv.textContent = 'Format email tidak valid. Contoh: user@domain.com';
            errorDiv.classList.remove('hidden');
            return false;
        } else {
            input.classList.remove('border-red-500');
            errorDiv.classList.add('hidden');
            return true;
        }
    }

    function validatePassword(input) {
        const password = input.value;
        const errorDiv = document.getElementById('password-error');
        const strengthDiv = document.getElementById('password-strength');
        const strengthText = document.getElementById('password-strength-text');
        const strengthBars = document.querySelectorAll('.password-strength-bar');

        if (password.length === 0) {
            strengthDiv.classList.add('hidden');
            errorDiv.classList.add('hidden');
            input.classList.remove('border-red-500', 'border-green-500');
            return false;
        }

        strengthDiv.classList.remove('hidden');

        if (password.length < 8) {
            input.classList.add('border-red-500');
            input.classList.remove('border-green-500');
            errorDiv.textContent = 'Password minimal 8 karakter';
            errorDiv.classList.remove('hidden');

            // Reset strength bars
            strengthBars.forEach(bar => {
                bar.className = 'password-strength-bar flex-1 h-1 bg-gray-200 rounded';
            });
            strengthText.textContent = 'Password terlalu pendek';
            strengthText.className = 'text-xs mt-1 text-red-600';
            return false;
        }

        input.classList.remove('border-red-500');
        errorDiv.classList.add('hidden');

        // Calculate password strength
        const strength = calculatePasswordStrength(password);
        const strengthColors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-green-500'];
        const strengthTexts = ['Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];
        const strengthTextColors = ['text-red-600', 'text-orange-600', 'text-yellow-600', 'text-green-600'];

        // Update strength bars
        strengthBars.forEach((bar, index) => {
            if (index < strength) {
                bar.className = `password-strength-bar flex-1 h-1 ${strengthColors[Math.min(strength - 1, 3)]} rounded`;
            } else {
                bar.className = 'password-strength-bar flex-1 h-1 bg-gray-200 rounded';
            }
        });

        strengthText.textContent = `Kekuatan: ${strengthTexts[Math.min(strength - 1, 3)]}`;
        strengthText.className = `text-xs mt-1 ${strengthTextColors[Math.min(strength - 1, 3)]}`;

        if (strength >= 3) {
            input.classList.add('border-green-500');
        }

        return strength >= 2; // Minimum strength requirement
    }

    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        return strength;
    }

    function toggleSubmitButton() {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const termsCheckbox = document.getElementById('agree_terms');
        const submitButton = document.getElementById('submitButton');
        const termsError = document.getElementById('terms-error');

        // Validate all fields
        const emailValid = validateEmail(emailInput);
        const passwordValid = validatePassword(passwordInput);
        const termsAccepted = termsCheckbox.checked;

        // Update terms validation
        if (!termsAccepted && termsCheckbox.getAttribute('data-touched')) {
            termsError.classList.remove('hidden');
        } else {
            termsError.classList.add('hidden');
        }

        // Enable/disable submit button
        const allValid = emailValid && passwordValid && termsAccepted && emailInput.value.trim() && passwordInput.value;

        submitButton.disabled = !allValid;

        if (allValid) {
            submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
            submitButton.classList.add('hover:shadow-lg');
        } else {
            submitButton.classList.add('opacity-50', 'cursor-not-allowed');
            submitButton.classList.remove('hover:shadow-lg');
        }
    }

    function handleSubmit(event) {
        event.preventDefault();

        if (formSubmitted) {
            return false;
        }

        const form = document.getElementById('registrationForm');
        const submitButton = document.getElementById('submitButton');
        const submitButtonText = document.getElementById('submitButtonText');
        const submitButtonLoader = document.getElementById('submitButtonLoader');

        // Final validation
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const termsCheckbox = document.getElementById('agree_terms');

        if (!validateEmail(emailInput) || !validatePassword(passwordInput) || !termsCheckbox.checked) {
            // Show validation errors
            if (!termsCheckbox.checked) {
                document.getElementById('terms-error').classList.remove('hidden');
                termsCheckbox.focus();
            }
            return false;
        }

        // Show confirmation dialog
        Swal.fire({
            title: 'Konfirmasi Pendaftaran',
            html: `
                <div class="text-left">
                    <p class="mb-4">Apakah Anda yakin semua data sudah benar dan siap untuk didaftarkan?</p>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="h-5 w-5 text-yellow-400 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm text-yellow-800">
                                    <strong>Perhatian:</strong> Setelah dikonfirmasi, data tidak dapat diubah dan biaya pendaftaran tidak dapat dikembalikan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3B82F6',
            cancelButtonColor: '#6B7280',
            confirmButtonText: '<i class="fas fa-check mr-2"></i>Ya, Daftarkan!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>Periksa Lagi',
            reverseButtons: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-lg px-6 py-3',
                cancelButton: 'rounded-lg px-6 py-3'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Prevent double submission
                formSubmitted = true;

                // Update button state
                submitButton.disabled = true;
                submitButtonText.textContent = 'Memproses...';
                submitButtonLoader.classList.remove('hidden');

                // Show loading state
                if (typeof showLoading === 'function') {
                    showLoading();
                }

                // Show processing message
                Swal.fire({
                    title: 'Memproses Pendaftaran',
                    html: 'Mohon tunggu, data sedang diproses...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit form
                setTimeout(() => {
                    form.submit();
                }, 1000);
            }
        });

        return false;
    }

    // Pure JavaScript Modal Functions
    function openTermsModal() {
        document.getElementById('termsModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Focus management for accessibility
        setTimeout(() => {
            const modal = document.getElementById('termsModal');
            const focusableElements = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            if (focusableElements.length > 0) {
                focusableElements[focusableElements.length - 1].focus(); // Focus close button
            }
        }, 100);
    }

    function closeTermsModal() {
        document.getElementById('termsModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openPrivacyModal() {
        document.getElementById('privacyModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Focus management for accessibility
        setTimeout(() => {
            const modal = document.getElementById('privacyModal');
            const focusableElements = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            if (focusableElements.length > 0) {
                focusableElements[focusableElements.length - 1].focus(); // Focus close button
            }
        }, 100);
    }

    function closePrivacyModal() {
        document.getElementById('privacyModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Enhanced DOM Content Loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Modal event listeners
        setupModalEventListeners();

        // Form validation event listeners
        setupFormValidation();

        // Auto-save functionality (except password for security)
        setupAutoSave();

        // Accessibility enhancements
        setupAccessibility();

        // Form state restoration
        restoreFormState();

        console.log('Step 4 JavaScript loaded successfully');
    });

    function setupModalEventListeners() {
        // Terms modal outside click
        document.getElementById('termsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeTermsModal();
            }
        });

        // Privacy modal outside click
        document.getElementById('privacyModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePrivacyModal();
            }
        });

        // Escape key handler
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeTermsModal();
                closePrivacyModal();
            }
        });
    }

    function setupFormValidation() {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const termsCheckbox = document.getElementById('agree_terms');

        // Email validation
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                validateEmail(this);
                toggleSubmitButton();
            });

            emailInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    validateEmail(this);
                }
                toggleSubmitButton();
            });
        }

        // Password validation
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                validatePassword(this);
                toggleSubmitButton();
            });

            passwordInput.addEventListener('blur', function() {
                validatePassword(this);
                toggleSubmitButton();
            });
        }

        // Terms checkbox validation
        if (termsCheckbox) {
            termsCheckbox.addEventListener('change', function() {
                this.setAttribute('data-touched', 'true');
                toggleSubmitButton();
            });
        }

        // Real-time validation
        document.addEventListener('input', toggleSubmitButton);
        document.addEventListener('change', toggleSubmitButton);
    }

    function setupAutoSave() {
        const emailInput = document.getElementById('email');

        if (emailInput) {
            emailInput.addEventListener('change', function() {
                localStorage.setItem('pendaftaran_step4_email', this.value);
            });
        }

        // Clear localStorage on successful submission
        const form = document.getElementById('registrationForm');
        if (form) {
            form.addEventListener('submit', function() {
                setTimeout(() => {
                    localStorage.removeItem('pendaftaran_step4_email');
                }, 2000);
            });
        }
    }

    function setupAccessibility() {
        // Add ARIA labels and roles
        const submitButton = document.getElementById('submitButton');
        if (submitButton) {
            submitButton.setAttribute('aria-describedby', 'submit-button-help');
        }

        // Focus trap for modals (basic implementation)
        const modals = document.querySelectorAll('[id$="Modal"]');
        modals.forEach(modal => {
            modal.addEventListener('keydown', function(e) {
                if (e.key === 'Tab') {
                    const focusableElements = this.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                    const firstElement = focusableElements[0];
                    const lastElement = focusableElements[focusableElements.length - 1];

                    if (e.shiftKey && document.activeElement === firstElement) {
                        e.preventDefault();
                        lastElement.focus();
                    } else if (!e.shiftKey && document.activeElement === lastElement) {
                        e.preventDefault();
                        firstElement.focus();
                    }
                }
            });
        });
    }

    function restoreFormState() {
        // Load saved email
        const emailInput = document.getElementById('email');
        if (emailInput) {
            const savedEmail = localStorage.getItem('pendaftaran_step4_email');
            if (savedEmail && !emailInput.value) {
                emailInput.value = savedEmail;
                validateEmail(emailInput);
            }
        }

        // Initial button state check
        setTimeout(toggleSubmitButton, 100);
    }

    // Form submission prevention on page unload (if form is dirty)
    window.addEventListener('beforeunload', function(e) {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        if (!formSubmitted && (emailInput?.value.trim() || passwordInput?.value.trim())) {
            e.preventDefault();
            e.returnValue = 'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman?';
            return e.returnValue;
        }
    });

    // Prevent back button after submission
    if (performance.navigation.type === performance.navigation.TYPE_BACK_FORWARD) {
        if (localStorage.getItem('form_submitted') === 'true') {
            window.location.replace('/dashboard');
        }
    }
</script>
@endpush
