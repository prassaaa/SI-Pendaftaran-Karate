@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-8 py-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.master.ranting.index') }}"
                   class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center hover:bg-white/30 transition-colors duration-200">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-white">Tambah Ranting</h1>
                    <p class="text-green-100">Daftarkan ranting/cabang karate INKAI baru</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Informasi Ranting</h2>
                <p class="text-gray-500 mt-1">Lengkapi form di bawah untuk mendaftarkan ranting baru</p>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.master.ranting.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Nama Ranting -->
                    <div class="space-y-2">
                        <label for="nama_ranting" class="block text-sm font-semibold text-gray-700">
                            Nama Ranting
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="nama_ranting"
                               name="nama_ranting"
                               value="{{ old('nama_ranting') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('nama_ranting') border-red-500 @enderror"
                               placeholder="Contoh: INKAI Dojo Kediri Kota"
                               required>
                        @error('nama_ranting')
                            <p class="text-red-500 text-sm flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kota -->
                        <div class="space-y-2">
                            <label for="kota" class="block text-sm font-semibold text-gray-700">
                                Kota/Kabupaten
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="kota"
                                   name="kota"
                                   value="{{ old('kota') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('kota') border-red-500 @enderror"
                                   placeholder="Contoh: Kediri"
                                   required>
                            @error('kota')
                                <p class="text-red-500 text-sm flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        <!-- Provinsi -->
                        <div class="space-y-2">
                            <label for="provinsi" class="block text-sm font-semibold text-gray-700">
                                Provinsi
                                <span class="text-red-500">*</span>
                            </label>
                            <select id="provinsi"
                                    name="provinsi"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('provinsi') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Provinsi</option>
                                <option value="Jawa Timur" {{ old('provinsi') == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                                <option value="Jawa Tengah" {{ old('provinsi') == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                                <option value="Jawa Barat" {{ old('provinsi') == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                                <option value="DKI Jakarta" {{ old('provinsi') == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                                <option value="Banten" {{ old('provinsi') == 'Banten' ? 'selected' : '' }}>Banten</option>
                                <option value="DI Yogyakarta" {{ old('provinsi') == 'DI Yogyakarta' ? 'selected' : '' }}>DI Yogyakarta</option>
                                <option value="Bali" {{ old('provinsi') == 'Bali' ? 'selected' : '' }}>Bali</option>
                                <option value="Sumatera Utara" {{ old('provinsi') == 'Sumatera Utara' ? 'selected' : '' }}>Sumatera Utara</option>
                                <option value="Sumatera Barat" {{ old('provinsi') == 'Sumatera Barat' ? 'selected' : '' }}>Sumatera Barat</option>
                                <option value="Sumatera Selatan" {{ old('provinsi') == 'Sumatera Selatan' ? 'selected' : '' }}>Sumatera Selatan</option>
                                <option value="Kalimantan Timur" {{ old('provinsi') == 'Kalimantan Timur' ? 'selected' : '' }}>Kalimantan Timur</option>
                                <option value="Kalimantan Selatan" {{ old('provinsi') == 'Kalimantan Selatan' ? 'selected' : '' }}>Kalimantan Selatan</option>
                                <option value="Sulawesi Selatan" {{ old('provinsi') == 'Sulawesi Selatan' ? 'selected' : '' }}>Sulawesi Selatan</option>
                                <option value="Sulawesi Utara" {{ old('provinsi') == 'Sulawesi Utara' ? 'selected' : '' }}>Sulawesi Utara</option>
                            </select>
                            @error('provinsi')
                                <p class="text-red-500 text-sm flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-2">
                        <label for="alamat" class="block text-sm font-semibold text-gray-700">
                            Alamat Lengkap
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat"
                                  name="alamat"
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('alamat') border-red-500 @enderror"
                                  placeholder="Masukkan alamat lengkap ranting termasuk jalan, nomor, RT/RW, kelurahan, kecamatan..."
                                  required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-sm flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Kontak -->
                    <div class="space-y-2">
                        <label for="kontak" class="block text-sm font-semibold text-gray-700">
                            Nomor Kontak
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="tel"
                               id="kontak"
                               name="kontak"
                               value="{{ old('kontak') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('kontak') border-red-500 @enderror"
                               placeholder="Contoh: 0354-123456 atau 081234567890"
                               required>
                        @error('kontak')
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
                        <a href="{{ route('admin.master.ranting.index') }}"
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors duration-200">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-8 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Simpan Ranting</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Quick Guide -->
    <div class="max-w-4xl">
        <div class="bg-green-50 rounded-2xl border border-green-200 p-6">
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-green-900 mb-2">Panduan Pendaftaran Ranting</h3>
                    <div class="text-green-800 space-y-2">
                        <p>• <strong>Nama Ranting:</strong> Gunakan format yang jelas dan konsisten, contoh: "INKAI Dojo [Nama Kota]"</p>
                        <p>• <strong>Lokasi:</strong> Pastikan kota dan provinsi sesuai dengan alamat yang dimasukkan</p>
                        <p>• <strong>Alamat:</strong> Berikan alamat selengkap mungkin untuk memudahkan komunikasi</p>
                        <p>• <strong>Kontak:</strong> Bisa nomor telepon tetap atau HP yang aktif digunakan</p>
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
    // Auto-format nama ranting based on kota
    const kotaInput = document.getElementById('kota');
    const namaRantingInput = document.getElementById('nama_ranting');

    kotaInput.addEventListener('input', function() {
        const kota = this.value.trim();
        if (kota && !namaRantingInput.value) {
            namaRantingInput.value = `INKAI Dojo ${kota}`;
        }
    });

    // Phone number formatting
    const kontakInput = document.getElementById('kontak');
    kontakInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, ''); // Remove non-digits

        // Format based on length
        if (value.startsWith('0') && value.length <= 12) {
            // Format: 0354-123456 or 081234567890
            if (value.length > 4 && value.startsWith('0354')) {
                value = value.slice(0, 4) + '-' + value.slice(4);
            }
        }

        this.value = value;
    });

    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const requiredFields = ['nama_ranting', 'kota', 'provinsi', 'alamat', 'kontak'];
        let isValid = true;

        requiredFields.forEach(fieldName => {
            const field = form.querySelector(`[name="${fieldName}"]`);
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('border-red-500');
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi!');
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

    // Address suggestion based on city and province
    const provinsiSelect = document.getElementById('provinsi');
    const alamatTextarea = document.getElementById('alamat');

    function updateAddressSuggestion() {
        const kota = kotaInput.value.trim();
        const provinsi = provinsiSelect.value;

        if (kota && provinsi && !alamatTextarea.value) {
            alamatTextarea.placeholder = `Contoh: Jl. Brawijaya No. 123, Kelurahan Mojoroto, Kecamatan Mojoroto, ${kota}, ${provinsi}`;
        }
    }

    kotaInput.addEventListener('input', updateAddressSuggestion);
    provinsiSelect.addEventListener('change', updateAddressSuggestion);
});
</script>
@endpush
