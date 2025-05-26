@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Progress Steps -->
        <div class="mb-12">
            <div class="flex items-center justify-center space-x-8">
                <!-- Step 1 - Completed -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="ml-3 text-green-600 font-semibold">Data Pribadi</span>
                </div>

                <!-- Connector -->
                <div class="w-12 h-1 bg-green-600 rounded"></div>

                <!-- Step 2 - Completed -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="ml-3 text-green-600 font-semibold">Kategori & Biaya</span>
                </div>

                <!-- Connector -->
                <div class="w-12 h-1 bg-green-600 rounded"></div>

                <!-- Step 3 - Active -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                        3
                    </div>
                    <span class="ml-3 text-blue-600 font-semibold">Upload Foto</span>
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
                <h1 class="text-2xl font-bold text-white">Upload Foto Peserta</h1>
                <p class="text-blue-100 mt-2">Upload foto 3x4 terbaru dengan latar belakang merah atau biru</p>
            </div>

            <!-- Form -->
            <form method="POST"
                  action="{{ route('pendaftaran.step3.post') }}"
                  enctype="multipart/form-data"
                  class="p-8"
                  x-data="photoUpload()">
                @csrf

                <!-- Upload Area -->
                <div class="mb-8">
                    <label class="form-label">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Foto Peserta (3x4)
                            <span class="text-red-500 ml-1">*</span>
                        </span>
                    </label>

                    <!-- Drop Zone -->
                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-blue-400 transition-colors duration-200"
                         :class="{ 'border-blue-400 bg-blue-50': isDragOver }"
                         @dragover.prevent="isDragOver = true"
                         @dragleave.prevent="isDragOver = false"
                         @drop.prevent="handleFileDrop($event)">

                        <!-- Preview Image -->
                        <div x-show="imagePreview" class="text-center">
                            <img :src="imagePreview"
                                 alt="Preview"
                                 class="mx-auto h-40 w-32 object-cover rounded-lg shadow-md mb-4">
                            <div class="flex justify-center space-x-4">
                                <button type="button"
                                        @click="removeImage()"
                                        class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus Foto
                                </button>
                                <button type="button"
                                        @click="$refs.fileInput.click()"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Ganti Foto
                                </button>
                            </div>
                        </div>

                        <!-- Upload Placeholder -->
                        <div x-show="!imagePreview" class="space-y-2 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="text-sm text-gray-600">
                                <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Pilih file</span>
                                    <input x-ref="fileInput"
                                           id="foto"
                                           name="foto"
                                           type="file"
                                           accept="image/jpeg,image/png,image/jpg"
                                           class="sr-only"
                                           @change="handleFileSelect($event)"
                                           required>
                                </label>
                                <span class="pl-1">atau drag and drop</span>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 2MB</p>
                        </div>
                    </div>

                    @error('foto')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    <!-- Progress Bar -->
                    <div x-show="uploadProgress > 0 && uploadProgress < 100" class="mt-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Mengupload...</span>
                            <span x-text="uploadProgress + '%'"></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                                 :style="'width: ' + uploadProgress + '%'"></div>
                        </div>
                    </div>
                </div>

                <!-- File Requirements -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-8">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-yellow-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-yellow-900 mb-2">Persyaratan Foto</h3>
                            <ul class="text-sm text-yellow-800 space-y-1">
                                <li>• Foto formal dengan ukuran 3x4 cm</li>
                                <li>• Latar belakang merah atau biru</li>
                                <li>• Wajah menghadap ke depan dengan ekspresi netral</li>
                                <li>• Tidak menggunakan aksesoris berlebihan</li>
                                <li>• Format file: JPG, JPEG, atau PNG</li>
                                <li>• Ukuran maksimal: 2MB</li>
                                <li>• Resolusi minimal: 300 x 400 pixel</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Image Guidelines -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Good Example -->
                    <div class="text-center">
                        <div class="bg-green-50 border-2 border-green-200 rounded-xl p-6">
                            <div class="w-24 h-32 bg-green-100 rounded-lg mx-auto mb-3 flex items-center justify-center">
                                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-green-900 mb-2">✅ Foto Yang Benar</h4>
                            <ul class="text-xs text-green-800 text-left space-y-1">
                                <li>• Wajah terlihat jelas</li>
                                <li>• Latar belakang polos</li>
                                <li>• Pencahayaan yang baik</li>
                                <li>• Ukuran proporsional</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bad Example -->
                    <div class="text-center">
                        <div class="bg-red-50 border-2 border-red-200 rounded-xl p-6">
                            <div class="w-24 h-32 bg-red-100 rounded-lg mx-auto mb-3 flex items-center justify-center">
                                <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-red-900 mb-2">❌ Foto Yang Salah</h4>
                            <ul class="text-xs text-red-800 text-left space-y-1">
                                <li>• Wajah tidak jelas/blur</li>
                                <li>• Latar belakang ramai</li>
                                <li>• Pencahayaan kurang</li>
                                <li>• Terpotong atau miring</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('pendaftaran.step2') }}"
                       class="admin-btn-secondary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Step 2
                    </a>

                    <button type="submit"
                            class="admin-btn-primary"
                            :disabled="!imageSelected"
                            :class="{ 'opacity-50 cursor-not-allowed': !imageSelected }">
                        Lanjut ke Step 4
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Tips Section -->
        <div class="mt-8 bg-blue-50 rounded-xl p-6">
            <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-blue-900 mb-2">Tips Mengambil Foto Yang Baik</h3>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Gunakan kamera dengan resolusi tinggi atau smartphone yang baik</li>
                        <li>• Pastikan pencahayaan cukup, hindari cahaya terlalu terang atau gelap</li>
                        <li>• Posisikan kamera sejajar dengan mata</li>
                        <li>• Gunakan tripod atau minta bantuan orang lain untuk hasil yang stabil</li>
                        <li>• Compress foto jika ukuran melebihi 2MB menggunakan tools online</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function photoUpload() {
        return {
            imagePreview: null,
            imageSelected: false,
            uploadProgress: 0,
            isDragOver: false,

            handleFileSelect(event) {
                const file = event.target.files[0];
                this.processFile(file);
            },

            handleFileDrop(event) {
                this.isDragOver = false;
                const file = event.dataTransfer.files[0];
                this.processFile(file);
            },

            processFile(file) {
                if (!file) return;

                // Validate file type
                if (!file.type.match('image.*')) {
                    showToast('File harus berupa gambar!', 'error');
                    return;
                }

                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    showToast('Ukuran file maksimal 2MB!', 'error');
                    return;
                }

                // Create preview
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                    this.imageSelected = true;
                    this.simulateUpload();
                };
                reader.readAsDataURL(file);

                // Update file input
                const fileInput = this.$refs.fileInput;
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
            },

            removeImage() {
                this.imagePreview = null;
                this.imageSelected = false;
                this.uploadProgress = 0;
                this.$refs.fileInput.value = '';
            },

            simulateUpload() {
                this.uploadProgress = 0;
                const interval = setInterval(() => {
                    this.uploadProgress += 10;
                    if (this.uploadProgress >= 100) {
                        clearInterval(interval);
                        showToast('Foto berhasil dipilih!', 'success');
                    }
                }, 100);
            }
        }
    }

    // Form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        const fileInput = document.getElementById('foto');
        if (!fileInput.files.length) {
            e.preventDefault();
            showToast('Silakan pilih foto terlebih dahulu!', 'error');
            return;
        }

        showLoading();
    });
</script>
@endpush
