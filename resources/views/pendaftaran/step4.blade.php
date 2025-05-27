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
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Pribadi
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nama Lengkap:</span>
                                <span class="font-medium">{{ $step1['nama_lengkap'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tempat, Tanggal Lahir:</span>
                                <span class="font-medium">{{ $step1['tempat_lahir'] }}, {{ date('d/m/Y', strtotime($step1['tanggal_lahir'])) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Jenis Kelamin:</span>
                                <span class="font-medium">{{ $step1['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Golongan Darah:</span>
                                <span class="font-medium">{{ $step1['golongan_darah'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Berat Badan:</span>
                                <span class="font-medium">{{ $step1['berat_badan'] }} KG</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">No. Telepon:</span>
                                <span class="font-medium">{{ $step1['no_telepon'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Ranting:</span>
                                <span class="font-medium">{{ $ranting->nama_ranting }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kategori Usia:</span>
                                <span class="font-medium">{{ $kategori_usia->nama_kategori }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Categories & Photo -->
                    <div class="space-y-6">
                        <!-- Selected Categories -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Kategori Pertandingan
                            </h3>
                            <div class="space-y-2">
                                @if($step2['kumite_perorangan'] ?? false)
                                    <div class="flex items-center justify-between py-2 px-3 bg-red-50 rounded-lg">
                                        <span class="text-red-800 font-medium">Kumite Perorangan</span>
                                        <span class="text-red-600 font-bold">Rp 50.000</span>
                                    </div>
                                @endif
                                @if($step2['kata_perorangan'] ?? false)
                                    <div class="flex items-center justify-between py-2 px-3 bg-blue-50 rounded-lg">
                                        <span class="text-blue-800 font-medium">Kata Perorangan</span>
                                        <span class="text-blue-600 font-bold">Rp 40.000</span>
                                    </div>
                                @endif
                                @if($step2['kata_beregu'] ?? false)
                                    <div class="flex items-center justify-between py-2 px-3 bg-green-50 rounded-lg">
                                        <span class="text-green-800 font-medium">Kata Beregu</span>
                                        <span class="text-green-600 font-bold">Rp 75.000</span>
                                    </div>
                                @endif
                                @if($step2['kumite_beregu'] ?? false)
                                    <div class="flex items-center justify-between py-2 px-3 bg-purple-50 rounded-lg">
                                        <span class="text-purple-800 font-medium">Kumite Beregu</span>
                                        <span class="text-purple-600 font-bold">Rp 75.000</span>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-900">Total Biaya:</span>
                                    <span class="text-2xl font-bold text-blue-600">
                                        Rp {{ number_format($step2['total_biaya'], 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Photo Preview -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Foto Peserta
                            </h3>
                            <div class="flex justify-center">
                                <div class="w-32 h-40 bg-gray-200 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-xs text-gray-500">Foto 3x4</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 text-center mt-2">Foto akan ditampilkan setelah pendaftaran selesai</p>
                        </div>
                    </div>
                </div>

                <!-- Account Creation -->
                <div class="bg-blue-50 rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-semibold text-blue-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-11.255 3.043M10 12a4 4 0 00-4 4v3h8v-3a4 4 0 00-4-4z"/>
                        </svg>
                        Buat Akun Peserta
                    </h3>
                    <p class="text-blue-800 mb-4">Akun akan dibuat otomatis untuk mengakses dashboard peserta setelah pendaftaran selesai.</p>

                    <form method="POST" action="{{ route('pendaftaran.submit') }}" x-data="accountForm()">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="form-label">
                                    Email untuk Login <span class="text-red-500">*</span>
                                </label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       class="form-input @error('email') border-red-500 @enderror"
                                       placeholder="contoh@email.com"
                                       required>
                                @error('email')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="form-label">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input :type="showPassword ? 'text' : 'password'"
                                           name="password"
                                           id="password"
                                           class="form-input @error('password') border-red-500 @enderror pr-10"
                                           placeholder="Minimal 8 karakter"
                                           minlength="8"
                                           required>
                                    <button type="button"
                                            @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
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
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mt-6">
                            <label class="flex items-start space-x-3">
                                <input type="checkbox"
                                       name="agree_terms"
                                       required
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1">
                                <span class="text-sm text-gray-700">
                                    Saya menyetujui
                                    <button type="button" onclick="openTermsModal()" class="text-blue-600 hover:text-blue-800 font-medium underline">
                                        Syarat dan Ketentuan
                                    </button>
                                    serta
                                    <button type="button" onclick="openPrivacyModal()" class="text-blue-600 hover:text-blue-800 font-medium underline">
                                        Kebijakan Privasi
                                    </button>
                                    dalam mengikuti kejuaraan ini.
                                </span>
                            </label>
                            @error('agree_terms')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Final Summary -->
                        <div class="mt-8 bg-white rounded-xl p-6 border-2 border-blue-200">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-lg font-semibold text-gray-900">Ringkasan Pendaftaran</h4>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    Siap Dikirim
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-blue-600">
                                        {{ count(array_filter([$step2['kumite_perorangan'] ?? false, $step2['kata_perorangan'] ?? false, $step2['kata_beregu'] ?? false, $step2['kumite_beregu'] ?? false])) }}
                                    </div>
                                    <div class="text-gray-600">Kategori Dipilih</div>
                                </div>
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-green-600">
                                        Rp {{ number_format($step2['total_biaya'], 0, ',', '.') }}
                                    </div>
                                    <div class="text-gray-600">Total Biaya</div>
                                </div>
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-purple-600">
                                        1
                                    </div>
                                    <div class="text-gray-600">Foto Terupload</div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-between mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('pendaftaran.step3') }}"
                               class="admin-btn-secondary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali ke Step 3
                            </a>

                            <button type="submit"
                                    class="admin-btn-primary text-lg px-8 py-3"
                                    @click="submitForm()">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Selesaikan Pendaftaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Terms Modal - Pure JavaScript -->
        <div id="termsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Syarat dan Ketentuan</h3>
                        <button onclick="closeTermsModal()" type="button" class="text-gray-400 hover:text-gray-600">
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>
                    <div class="mt-2 px-7 py-3 max-h-96 overflow-y-auto text-sm text-gray-600">
                        <ol class="list-decimal space-y-2">
                            <li>Peserta wajib mengikuti semua peraturan pertandingan yang ditetapkan oleh INKAI.</li>
                            <li>Peserta bertanggung jawab atas keamanan dan keselamatan diri sendiri selama pertandingan.</li>
                            <li>Biaya pendaftaran yang sudah dibayar tidak dapat dikembalikan dalam kondisi apapun.</li>
                            <li>Peserta wajib hadir tepat waktu sesuai jadwal yang telah ditentukan.</li>
                            <li>Peserta yang tidak hadir tanpa pemberitahuan dianggap mengundurkan diri.</li>
                            <li>Keputusan wasit dan juri bersifat final dan tidak dapat diganggu gugat.</li>
                            <li>Panitia berhak mendiskualifikasi peserta yang melanggar aturan.</li>
                            <li>Peserta wajib menggunakan perlengkapan karate yang sesuai standar.</li>
                            <li>Peserta bertanggung jawab atas asuransi kesehatan pribadi.</li>
                            <li>Dengan mendaftar, peserta menyetujui penggunaan foto/video untuk dokumentasi acara.</li>
                        </ol>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button onclick="closeTermsModal()" type="button" class="admin-btn-primary w-full">
                            Saya Mengerti
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Privacy Modal - Pure JavaScript -->
        <div id="privacyModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Kebijakan Privasi</h3>
                        <button onclick="closePrivacyModal()" type="button" class="text-gray-400 hover:text-gray-600">
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>
                    <div class="mt-2 px-7 py-3 max-h-96 overflow-y-auto text-sm text-gray-600">
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Pengumpulan Data</h4>
                                <p>Kami mengumpulkan data pribadi yang Anda berikan saat mendaftar, termasuk nama, alamat, nomor telepon, dan foto.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Penggunaan Data</h4>
                                <p>Data yang dikumpulkan digunakan untuk keperluan administrasi pertandingan, verifikasi identitas, dan komunikasi terkait acara.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Keamanan Data</h4>
                                <p>Kami berkomitmen menjaga keamanan data pribadi Anda dengan implementasi langkah-langkah keamanan yang sesuai.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Pembagian Data</h4>
                                <p>Data pribadi tidak akan dibagikan kepada pihak ketiga tanpa persetujuan Anda, kecuali untuk keperluan hukum.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Hak Anda</h4>
                                <p>Anda memiliki hak untuk mengakses, memperbaiki, atau menghapus data pribadi yang kami miliki.</p>
                            </div>
                        </div>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button onclick="closePrivacyModal()" type="button" class="admin-btn-primary w-full">
                            Saya Mengerti
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function accountForm() {
        return {
            showPassword: false,

            submitForm() {
                // Show confirmation
                Swal.fire({
                    title: 'Konfirmasi Pendaftaran',
                    text: 'Apakah Anda yakin semua data sudah benar?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3B82F6',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, Daftarkan!',
                    cancelButtonText: 'Periksa Lagi'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (typeof showLoading === 'function') {
                            showLoading();
                        }
                        // Form will submit naturally
                    }
                });
            }
        }
    }

    // Pure JavaScript Modal Functions
    function openTermsModal() {
        document.getElementById('termsModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeTermsModal() {
        document.getElementById('termsModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openPrivacyModal() {
        document.getElementById('privacyModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closePrivacyModal() {
        document.getElementById('privacyModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modals when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
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

        // Email validation
        const emailInput = document.getElementById('email');
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const email = this.value;
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email && !emailRegex.test(email)) {
                    if (typeof showToast === 'function') {
                        showToast('Format email tidak valid', 'error');
                    } else {
                        alert('Format email tidak valid');
                    }
                }
            });
        }

        // Password strength indicator
        const passwordInput = document.getElementById('password');
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = calculatePasswordStrength(password);
                // You can add visual indicator here if needed
            });
        }

        // Auto-save form data (except password for security)
        const formInputs = document.querySelectorAll('input[name="email"]');
        formInputs.forEach(input => {
            input.addEventListener('change', function() {
                localStorage.setItem('pendaftaran_step4_' + this.name, this.value);
            });

            // Load saved data
            const saved = localStorage.getItem('pendaftaran_step4_' + input.name);
            if (saved && !input.value) {
                input.value = saved;
            }
        });

        // Clear localStorage on successful submission
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function() {
                setTimeout(() => {
                    localStorage.removeItem('pendaftaran_step4_email');
                }, 1000);
            });
        }
    });

    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        return strength;
    }

    // Debug logging
    console.log('Step 4 JavaScript loaded successfully');
</script>
@endpush
