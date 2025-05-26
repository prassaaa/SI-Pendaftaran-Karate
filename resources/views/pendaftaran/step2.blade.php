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

                <!-- Step 2 - Active -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                        2
                    </div>
                    <span class="ml-3 text-blue-600 font-semibold">Kategori & Biaya</span>
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
                <h1 class="text-2xl font-bold text-white">Pilih Kategori Pertandingan</h1>
                <p class="text-blue-100 mt-2">Pilih kategori yang ingin Anda ikuti (dapat memilih lebih dari satu)</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('pendaftaran.step2.post') }}" class="p-8" x-data="categoryForm()">
                @csrf

                <!-- Categories Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kumite Perorangan -->
                    <div class="relative">
                        <input type="checkbox"
                               name="kumite_perorangan"
                               id="kumite_perorangan"
                               value="1"
                               {{ old('kumite_perorangan') ? 'checked' : '' }}
                               x-model="categories.kumite_perorangan"
                               class="sr-only">
                        <label for="kumite_perorangan"
                               class="block cursor-pointer group"
                               :class="categories.kumite_perorangan ? 'ring-2 ring-blue-500' : ''">
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 border-2 border-transparent transition-all duration-200 hover:shadow-lg"
                                 :class="categories.kumite_perorangan ? 'border-blue-500 bg-blue-50' : 'group-hover:border-red-300'">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2c-4 0-8 .5-8 4v9.5C4 17.43 5.57 19 7.5 19L6 20.5v.5h2.23l2-2H16l2 2H20v-.5L18.5 19c1.93 0 3.5-1.57 3.5-3.5V6c0-3.5-4-4-8-4z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900">Kumite Perorangan</h3>
                                            <p class="text-sm text-gray-600">Pertarungan satu lawan satu</p>
                                        </div>
                                    </div>
                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center"
                                         :class="categories.kumite_perorangan ? 'border-blue-500 bg-blue-500' : 'border-gray-300'">
                                        <svg x-show="categories.kumite_perorangan" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-red-600">
                                        Rp {{ number_format($biaya->biaya_kumite ?? 50000, 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm text-gray-500">per peserta</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Kata Perorangan -->
                    <div class="relative">
                        <input type="checkbox"
                               name="kata_perorangan"
                               id="kata_perorangan"
                               value="1"
                               {{ old('kata_perorangan') ? 'checked' : '' }}
                               x-model="categories.kata_perorangan"
                               class="sr-only">
                        <label for="kata_perorangan"
                               class="block cursor-pointer group"
                               :class="categories.kata_perorangan ? 'ring-2 ring-blue-500' : ''">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border-2 border-transparent transition-all duration-200 hover:shadow-lg"
                                 :class="categories.kata_perorangan ? 'border-blue-500 bg-blue-50' : 'group-hover:border-blue-300'">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900">Kata Perorangan</h3>
                                            <p class="text-sm text-gray-600">Demonstrasi gerakan individu</p>
                                        </div>
                                    </div>
                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center"
                                         :class="categories.kata_perorangan ? 'border-blue-500 bg-blue-500' : 'border-gray-300'">
                                        <svg x-show="categories.kata_perorangan" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-blue-600">
                                        Rp {{ number_format($biaya->biaya_kata ?? 40000, 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm text-gray-500">per peserta</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Kata Beregu -->
                    <div class="relative">
                        <input type="checkbox"
                               name="kata_beregu"
                               id="kata_beregu"
                               value="1"
                               {{ old('kata_beregu') ? 'checked' : '' }}
                               x-model="categories.kata_beregu"
                               class="sr-only">
                        <label for="kata_beregu"
                               class="block cursor-pointer group"
                               :class="categories.kata_beregu ? 'ring-2 ring-blue-500' : ''">
                            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border-2 border-transparent transition-all duration-200 hover:shadow-lg"
                                 :class="categories.kata_beregu ? 'border-blue-500 bg-blue-50' : 'group-hover:border-green-300'">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.996 1.996 0 0 0 18.04 7h-.5c-.8 0-1.54.37-2.01 1.01L14 10v3h2v7h4zM12.5 11.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5S11 9.17 11 10s.67 1.5 1.5 1.5zm1.5 1h-4c-.83 0-1.5.67-1.5 1.5v6h2v7h3v-7h2v-6c0-.83-.67-1.5-1.5-1.5zM6 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm2 18v-6H5.5l2.54-7.63A1.996 1.996 0 0 1 9.96 7h.5c.8 0 1.54.37 2.01 1.01L14 10v3h-2v7H8z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900">Kata Beregu</h3>
                                            <p class="text-sm text-gray-600">Demonstrasi gerakan tim</p>
                                        </div>
                                    </div>
                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center"
                                         :class="categories.kata_beregu ? 'border-blue-500 bg-blue-500' : 'border-gray-300'">
                                        <svg x-show="categories.kata_beregu" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-green-600">
                                        Rp {{ number_format($biaya->biaya_beregu ?? 75000, 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm text-gray-500">per peserta</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Kumite Beregu -->
                    <div class="relative">
                        <input type="checkbox"
                               name="kumite_beregu"
                               id="kumite_beregu"
                               value="1"
                               {{ old('kumite_beregu') ? 'checked' : '' }}
                               x-model="categories.kumite_beregu"
                               class="sr-only">
                        <label for="kumite_beregu"
                               class="block cursor-pointer group"
                               :class="categories.kumite_beregu ? 'ring-2 ring-blue-500' : ''">
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border-2 border-transparent transition-all duration-200 hover:shadow-lg"
                                 :class="categories.kumite_beregu ? 'border-blue-500 bg-blue-50' : 'group-hover:border-purple-300'">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 10c2.7 0 5.8 1.29 6 2H6c.23-.72 3.31-2 6-2M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 10c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900">Kumite Beregu</h3>
                                            <p class="text-sm text-gray-600">Pertarungan tim</p>
                                        </div>
                                    </div>
                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center"
                                         :class="categories.kumite_beregu ? 'border-blue-500 bg-blue-500' : 'border-gray-300'">
                                        <svg x-show="categories.kumite_beregu" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-purple-600">
                                        Rp {{ number_format($biaya->biaya_beregu ?? 75000, 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm text-gray-500">per peserta</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Error Message -->
                @error('kategori')
                    <div class="mt-4 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <span class="text-red-700 font-medium">{{ $message }}</span>
                        </div>
                    </div>
                @enderror

                <!-- Total Calculation -->
                <div class="mt-8 bg-gray-50 rounded-xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Total Biaya Pendaftaran</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                <span x-text="selectedCount"></span> kategori dipilih
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-blue-600" x-text="formatRupiah(totalBiaya)"></div>
                            <div class="text-sm text-gray-500">Total yang harus dibayar</div>
                        </div>
                    </div>

                    <!-- Breakdown -->
                    <div class="mt-4 space-y-2" x-show="selectedCount > 0">
                        <div class="text-sm text-gray-600 font-medium border-t pt-4">Rincian Biaya:</div>
                        <div x-show="categories.kumite_perorangan" class="flex justify-between text-sm">
                            <span>Kumite Perorangan</span>
                            <span>Rp {{ number_format($biaya->biaya_kumite ?? 50000, 0, ',', '.') }}</span>
                        </div>
                        <div x-show="categories.kata_perorangan" class="flex justify-between text-sm">
                            <span>Kata Perorangan</span>
                            <span>Rp {{ number_format($biaya->biaya_kata ?? 40000, 0, ',', '.') }}</span>
                        </div>
                        <div x-show="categories.kata_beregu" class="flex justify-between text-sm">
                            <span>Kata Beregu</span>
                            <span>Rp {{ number_format($biaya->biaya_beregu ?? 75000, 0, ',', '.') }}</span>
                        </div>
                        <div x-show="categories.kumite_beregu" class="flex justify-between text-sm">
                            <span>Kumite Beregu</span>
                            <span>Rp {{ number_format($biaya->biaya_beregu ?? 75000, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('pendaftaran.step1') }}"
                       class="admin-btn-secondary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Step 1
                    </a>

                    <button type="submit"
                            class="admin-btn-primary"
                            :disabled="selectedCount === 0"
                            :class="{ 'opacity-50 cursor-not-allowed': selectedCount === 0 }">
                        Lanjut ke Step 3
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Section -->
        <div class="mt-8 bg-blue-50 rounded-xl p-6">
            <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-blue-900 mb-2">Informasi Kategori Pertandingan</h3>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• <strong>Kumite Perorangan:</strong> Pertarungan 1 lawan 1 dengan sistem poin</li>
                        <li>• <strong>Kata Perorangan:</strong> Demonstrasi gerakan karate secara individu</li>
                        <li>• <strong>Kata Beregu:</strong> Demonstrasi gerakan karate secara tim (3 orang)</li>
                        <li>• <strong>Kumite Beregu:</strong> Pertarungan tim dengan 5 pertandingan</li>
                        <li>• Anda dapat mengikuti lebih dari satu kategori dengan biaya terpisah</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function categoryForm() {
        return {
            categories: {
                kumite_perorangan: {{ old('kumite_perorangan') ? 'true' : 'false' }},
                kata_perorangan: {{ old('kata_perorangan') ? 'true' : 'false' }},
                kata_beregu: {{ old('kata_beregu') ? 'true' : 'false' }},
                kumite_beregu: {{ old('kumite_beregu') ? 'true' : 'false' }}
            },
            biaya: {
                kumite_perorangan: {{ $biaya->biaya_kumite ?? 50000 }},
                kata_perorangan: {{ $biaya->biaya_kata ?? 40000 }},
                kata_beregu: {{ $biaya->biaya_beregu ?? 75000 }},
                kumite_beregu: {{ $biaya->biaya_beregu ?? 75000 }}
            },

            get selectedCount() {
                return Object.values(this.categories).filter(Boolean).length;
            },

            get totalBiaya() {
                let total = 0;
                if (this.categories.kumite_perorangan) total += this.biaya.kumite_perorangan;
                if (this.categories.kata_perorangan) total += this.biaya.kata_perorangan;
                if (this.categories.kata_beregu) total += this.biaya.kata_beregu;
                if (this.categories.kumite_beregu) total += this.biaya.kumite_beregu;
                return total;
            },

            formatRupiah(amount) {
                return 'Rp ' + amount.toLocaleString('id-ID');
            }
        }
    }

    // Auto-save selections
    document.addEventListener('alpine:init', () => {
        Alpine.store('pendaftaran', {
            saveStep2(data) {
                localStorage.setItem('pendaftaran_step2', JSON.stringify(data));
            },

            loadStep2() {
                const saved = localStorage.getItem('pendaftaran_step2');
                return saved ? JSON.parse(saved) : {};
            }
        });
    });

    // Form submission
    document.querySelector('form').addEventListener('submit', function() {
        showLoading();
    });
</script>
@endpush
