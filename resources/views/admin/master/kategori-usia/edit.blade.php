@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.master.kategori-usia.index') }}"
                   class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center hover:bg-white/30 transition-colors duration-200">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-white">Edit Kategori Usia</h1>
                    <p class="text-blue-100">Ubah informasi kategori usia untuk peserta kejuaraan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Informasi Kategori Usia</h2>
                <p class="text-gray-500 mt-1">Perbarui informasi kategori usia di bawah ini</p>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.master.kategori-usia.update', $kategori->id) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Nama Kategori -->
                    <div class="space-y-2">
                        <label for="nama_kategori" class="block text-sm font-semibold text-gray-700">
                            Nama Kategori
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="nama_kategori"
                               name="nama_kategori"
                               value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('nama_kategori') border-red-500 @enderror"
                               placeholder="Contoh: Anak-anak, Remaja, Dewasa"
                               required>
                        @error('nama_kategori')
                            <p class="text-red-500 text-sm flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Rentang Usia -->
                    <div class="space-y-2">
                        <label for="rentang_usia" class="block text-sm font-semibold text-gray-700">
                            Rentang Usia
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="rentang_usia"
                               name="rentang_usia"
                               value="{{ old('rentang_usia', $kategori->rentang_usia) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('rentang_usia') border-red-500 @enderror"
                               placeholder="Contoh: 8-12 tahun, 13-17 tahun, 18+ tahun"
                               required>
                        @error('rentang_usia')
                            <p class="text-red-500 text-sm flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="space-y-2">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700">
                            Deskripsi
                            <span class="text-gray-400 text-xs font-normal">(Opsional)</span>
                        </label>
                        <textarea id="deskripsi"
                                  name="deskripsi"
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('deskripsi') border-red-500 @enderror"
                                  placeholder="Keterangan tambahan tentang kategori usia ini...">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-sm flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.master.kategori-usia.index') }}"
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors duration-200">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-8 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Perbarui Kategori</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Quick Guide -->
    <div class="max-w-4xl">
        <div class="bg-blue-50 rounded-2xl border border-blue-200 p-6">
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Panduan Kategori Usia</h3>
                    <div class="text-blue-800 space-y-2">
                        <p>• <strong>Nama Kategori:</strong> Berikan nama yang jelas dan mudah dipahami</p>
                        <p>• <strong>Rentang Usia:</strong> Gunakan format yang konsisten, misalnya "8-12 tahun"</p>
                        <p>• <strong>Deskripsi:</strong> Tambahkan informasi tambahan yang dapat membantu peserta memahami kategori</p>
                        <p>• <strong>Contoh kategori umum:</strong> Anak-anak (8-12 tahun), Remaja (13-17 tahun), Dewasa (18+ tahun)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-suggest for rentang_usia based on nama_kategori
    const namaKategori = document.getElementById('nama_kategori');
    const rentangUsia = document.getElementById('rentang_usia');

    const suggestions = {
        'anak': '8-12 tahun',
        'anak-anak': '8-12 tahun',
        'remaja': '13-17 tahun',
        'pemuda': '13-17 tahun',
        'dewasa': '18+ tahun',
        'senior': '35+ tahun',
        'veteran': '40+ tahun'
    };

    namaKategori.addEventListener('input', function() {
        const value = this.value.toLowerCase();
        for (let key in suggestions) {
            if (value.includes(key) && !rentangUsia.value) {
                rentangUsia.value = suggestions[key];
                break;
            }
        }
    });

    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const namaValue = namaKategori.value.trim();
        const rentangValue = rentangUsia.value.trim();

        if (!namaValue || !rentangValue) {
            e.preventDefault();
            alert('Nama kategori dan rentang usia harus diisi!');
            return;
        }

        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = `
            <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            <span>Menyimpan...</span>
        `;
        submitBtn.disabled = true;

        // Restore button if form submission fails
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 5000);
    });
});
</script>
@endpush
