@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-8 py-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.master.biaya-kategori.index') }}"
                   class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center hover:bg-white/30 transition-colors duration-200">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-white">Edit Biaya Kategori</h1>
                    <p class="text-purple-100">Ubah biaya pendaftaran untuk setiap kategori pertandingan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Informasi Biaya Kategori</h2>
                <p class="text-gray-500 mt-1">Perbarui biaya untuk setiap kategori pertandingan karate</p>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.master.biaya-kategori.update', $biaya->id) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Nama Kategori -->
                    <div class="space-y-2">
                        <label for="nama_kategori" class="block text-sm font-semibold text-gray-700">
                            Nama Kategori Biaya
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="nama_kategori"
                               name="nama_kategori"
                               value="{{ old('nama_kategori', $biaya->nama_kategori) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 @error('nama_kategori') border-red-500 @enderror"
                               placeholder="Contoh: Biaya Kejuaraan 2025, Biaya Regional Jatim"
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

                    <!-- Biaya Kategori -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                            Biaya per Kategori Pertandingan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Biaya Kumite Perorangan -->
                            <div class="space-y-2">
                                <label for="biaya_kumite" class="block text-sm font-semibold text-gray-700">
                                    Kumite Perorangan
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number"
                                           id="biaya_kumite"
                                           name="biaya_kumite"
                                           value="{{ old('biaya_kumite', $biaya->biaya_kumite) }}"
                                           min="0"
                                           step="1000"
                                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 @error('biaya_kumite') border-red-500 @enderror"
                                           placeholder="50000"
                                           required>
                                </div>
                                <div class="text-xs text-gray-500">Biaya untuk kategori kumite perorangan</div>
                                @error('biaya_kumite')
                                    <p class="text-red-500 text-sm flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>

                            <!-- Biaya Kata Perorangan -->
                            <div class="space-y-2">
                                <label for="biaya_kata" class="block text-sm font-semibold text-gray-700">
                                    Kata Perorangan
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number"
                                           id="biaya_kata"
                                           name="biaya_kata"
                                           value="{{ old('biaya_kata', $biaya->biaya_kata) }}"
                                           min="0"
                                           step="1000"
                                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 @error('biaya_kata') border-red-500 @enderror"
                                           placeholder="40000"
                                           required>
                                </div>
                                <div class="text-xs text-gray-500">Biaya untuk kategori kata perorangan</div>
                                @error('biaya_kata')
                                    <p class="text-red-500 text-sm flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>

                            <!-- Biaya Beregu -->
                            <div class="space-y-2">
                                <label for="biaya_beregu" class="block text-sm font-semibold text-gray-700">
                                    Kategori Beregu
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number"
                                           id="biaya_beregu"
                                           name="biaya_beregu"
                                           value="{{ old('biaya_beregu', $biaya->biaya_beregu) }}"
                                           min="0"
                                           step="1000"
                                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 @error('biaya_beregu') border-red-500 @enderror"
                                           placeholder="75000"
                                           required>
                                </div>
                                <div class="text-xs text-gray-500">Biaya untuk kategori kata beregu dan kumite beregu</div>
                                @error('biaya_beregu')
                                    <p class="text-red-500 text-sm flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>

                            <!-- Total Estimasi -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    Estimasi Total Maksimal
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="text"
                                           id="total_estimasi"
                                           class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-600 cursor-not-allowed"
                                           value="0"
                                           readonly>
                                </div>
                                <div class="text-xs text-gray-500">Jika peserta mengikuti semua kategori</div>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label for="status" class="block text-sm font-semibold text-gray-700">
                            Status
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="relative flex items-center p-4 border border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                                <input type="radio"
                                       name="status"
                                       value="active"
                                       {{ old('status', $biaya->status) == 'active' ? 'checked' : '' }}
                                       class="sr-only">
                                <div class="radio-indicator w-5 h-5 border-2 border-gray-300 rounded-full mr-3 flex items-center justify-center">
                                    <div class="w-2 h-2 bg-green-600 rounded-full hidden"></div>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Aktif</div>
                                    <div class="text-sm text-gray-500">Gunakan sebagai biaya saat ini</div>
                                </div>
                            </label>

                            <label class="relative flex items-center p-4 border border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                                <input type="radio"
                                       name="status"
                                       value="inactive"
                                       {{ old('status', $biaya->status) == 'inactive' ? 'checked' : '' }}
                                       class="sr-only">
                                <div class="radio-indicator w-5 h-5 border-2 border-gray-300 rounded-full mr-3 flex items-center justify-center">
                                    <div class="w-2 h-2 bg-gray-600 rounded-full hidden"></div>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Nonaktif</div>
                                    <div class="text-sm text-gray-500">Simpan sebagai draft</div>
                                </div>
                            </label>
                        </div>
                        @error('status')
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
                        <a href="{{ route('admin.master.biaya-kategori.index') }}"
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors duration-200">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-8 py-3 bg-purple-600 text-white rounded-xl font-semibold hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Perbarui Biaya</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Card -->
    <div class="max-w-4xl">
        <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-2xl border border-purple-200 p-6">
            <h3 class="text-lg font-semibold text-purple-900 mb-4">Preview Biaya</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg p-4 border border-purple-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 font-medium">Kumite Perorangan</div>
                            <div class="text-lg font-bold text-gray-900" id="preview-kumite">Rp {{ number_format($biaya->biaya_kumite, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 border border-purple-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 font-medium">Kata Perorangan</div>
                            <div class="text-lg font-bold text-gray-900" id="preview-kata">Rp {{ number_format($biaya->biaya_kata, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 border border-purple-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 font-medium">Kategori Beregu</div>
                            <div class="text-lg font-bold text-gray-900" id="preview-beregu">Rp {{ number_format($biaya->biaya_beregu, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 p-4 bg-white rounded-lg border border-purple-100">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 font-medium">Total Maksimal (Semua Kategori)</div>
                        <div class="text-2xl font-bold text-purple-900" id="preview-total">Rp {{ number_format($biaya->biaya_kumite + $biaya->biaya_kata + ($biaya->biaya_beregu * 2), 0, ',', '.') }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Biaya terendah</div>
                        <div class="text-lg font-semibold text-green-600" id="preview-minimum">Rp {{ number_format(min($biaya->biaya_kumite, $biaya->biaya_kata, $biaya->biaya_beregu), 0, ',', '.') }}</div>
                    </div>
                </div>
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
                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Panduan Pengaturan Biaya</h3>
                    <div class="text-blue-800 space-y-2">
                        <p>• <strong>Kumite Perorangan:</strong> Biaya untuk pertandingan kumite individual</p>
                        <p>• <strong>Kata Perorangan:</strong> Biaya untuk pertandingan kata individual</p>
                        <p>• <strong>Kategori Beregu:</strong> Biaya untuk pertandingan beregu (kata beregu & kumite beregu)</p>
                        <p>• <strong>Status Aktif:</strong> Hanya satu biaya kategori yang dapat aktif pada satu waktu</p>
                        <p>• <strong>Kelipatan 1000:</strong> Disarankan menggunakan nominal kelipatan 1000 untuk kemudahan</p>
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
    const biayaKumite = document.getElementById('biaya_kumite');
    const biayaKata = document.getElementById('biaya_kata');
    const biayaBeregu = document.getElementById('biaya_beregu');
    const totalEstimasi = document.getElementById('total_estimasi');

    // Preview elements
    const previewKumite = document.getElementById('preview-kumite');
    const previewKata = document.getElementById('preview-kata');
    const previewBeregu = document.getElementById('preview-beregu');
    const previewTotal = document.getElementById('preview-total');
    const previewMinimum = document.getElementById('preview-minimum');

    // Radio button styling
    const radioInputs = document.querySelectorAll('input[type="radio"]');
    radioInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Reset all radio indicators
            document.querySelectorAll('.radio-indicator').forEach(indicator => {
                indicator.classList.remove('border-green-500', 'border-gray-600');
                indicator.classList.add('border-gray-300');
                indicator.querySelector('div').classList.add('hidden');
            });

            // Style selected radio
            const indicator = this.parentElement.querySelector('.radio-indicator');
            if (this.value === 'active') {
                indicator.classList.remove('border-gray-300');
                indicator.classList.add('border-green-500');
                indicator.querySelector('div').classList.remove('hidden');
                indicator.querySelector('div').classList.add('bg-green-600');
            } else {
                indicator.classList.remove('border-gray-300');
                indicator.classList.add('border-gray-600');
                indicator.querySelector('div').classList.remove('hidden');
                indicator.querySelector('div').classList.add('bg-gray-600');
            }
        });

        // Trigger change event on page load for checked radio
        if (input.checked) {
            input.dispatchEvent(new Event('change'));
        }
    });

    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    }

    function updateCalculations() {
        const kumite = parseInt(biayaKumite.value) || 0;
        const kata = parseInt(biayaKata.value) || 0;
        const beregu = parseInt(biayaBeregu.value) || 0;

        // Calculate total (kumite + kata + beregu*2 for both kata beregu and kumite beregu)
        const total = kumite + kata + (beregu * 2);
        const minimum = Math.min(kumite, kata, beregu);

        // Update form
        totalEstimasi.value = formatCurrency(total);

        // Update preview
        previewKumite.textContent = formatCurrency(kumite);
        previewKata.textContent = formatCurrency(kata);
        previewBeregu.textContent = formatCurrency(beregu);
        previewTotal.textContent = formatCurrency(total);
        previewMinimum.textContent = formatCurrency(minimum);
    }

    // Add event listeners
    [biayaKumite, biayaKata, biayaBeregu].forEach(input => {
        input.addEventListener('input', updateCalculations);

        // Format input on blur
        input.addEventListener('blur', function() {
            const value = parseInt(this.value) || 0;
            this.value = value;
        });
    });

    // Initial calculation
    updateCalculations();

    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const kumite = parseInt(biayaKumite.value) || 0;
        const kata = parseInt(biayaKata.value) || 0;
        const beregu = parseInt(biayaBeregu.value) || 0;

        if (kumite < 1000 || kata < 1000 || beregu < 1000) {
            e.preventDefault();
            alert('Biaya minimal adalah Rp 1.000 untuk setiap kategori');
            return;
        }

        if (kumite > 1000000 || kata > 1000000 || beregu > 1000000) {
            e.preventDefault();
            alert('Biaya maksimal adalah Rp 1.000.000 untuk setiap kategori');
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

    // Quick preset buttons
    const namaKategoriInput = document.getElementById('nama_kategori');
    namaKategoriInput.addEventListener('focus', function() {
        if (!this.value) {
            const currentYear = new Date().getFullYear();
            this.value = `Biaya Kejuaraan ${currentYear}`;
        }
    });

    // Preset values based on common patterns
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === '1') {
            e.preventDefault();
            // Preset 1: Standard
            biayaKumite.value = 50000;
            biayaKata.value = 40000;
            biayaBeregu.value = 75000;
            updateCalculations();
        } else if (e.ctrlKey && e.key === '2') {
            e.preventDefault();
            // Preset 2: Premium
            biayaKumite.value = 75000;
            biayaKata.value = 60000;
            biayaBeregu.value = 100000;
            updateCalculations();
        } else if (e.ctrlKey && e.key === '3') {
            e.preventDefault();
            // Preset 3: Budget
            biayaKumite.value = 35000;
            biayaKata.value = 25000;
            biayaBeregu.value = 50000;
            updateCalculations();
        }
    });
});
</script>
@endpush
