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
                    <h1 class="text-2xl font-bold text-white">{{ $biaya->nama_kategori }}</h1>
                    <p class="text-purple-100">Detail biaya pendaftaran untuk setiap kategori pertandingan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Section -->
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Informasi Biaya Kategori</h2>
                <p class="text-gray-500 mt-1">Rincian biaya untuk setiap kategori pertandingan karate</p>
            </div>

            <div class="p-8 space-y-6">
                <!-- Nama Kategori -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Nama Kategori Biaya</label>
                    <div class="text-gray-900">{{ $biaya->nama_kategori }}</div>
                </div>

                <!-- Biaya Kategori -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                        Biaya per Kategori Pertandingan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Biaya Kumite Perorangan -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Kumite Perorangan</label>
                            <div class="text-gray-900">Rp {{ number_format($biaya->biaya_kumite, 0, ',', '.') }}</div>
                            <div class="text-xs text-gray-500">Biaya untuk kategori kumite perorangan</div>
                        </div>

                        <!-- Biaya Kata Perorangan -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Kata Perorangan</label>
                            <div class="text-gray-900">Rp {{ number_format($biaya->biaya_kata, 0, ',', '.') }}</div>
                            <div class="text-xs text-gray-500">Biaya untuk kategori kata perorangan</div>
                        </div>

                        <!-- Biaya Beregu -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Kategori Beregu</label>
                            <div class="text-gray-900">Rp {{ number_format($biaya->biaya_beregu, 0, ',', '.') }}</div>
                            <div class="text-xs text-gray-500">Biaya untuk kategori kata beregu dan kumite beregu</div>
                        </div>

                        <!-- Total Estimasi -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Estimasi Total Maksimal</label>
                            <div class="text-gray-900">Rp {{ number_format($biaya->biaya_kumite + $biaya->biaya_kata + ($biaya->biaya_beregu * 2), 0, ',', '.') }}</div>
                            <div class="text-xs text-gray-500">Jika peserta mengikuti semua kategori</div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Status</label>
                    <div class="text-gray-900">{{ $biaya->status == 'active' ? 'Aktif' : 'Nonaktif' }}</div>
                    <div class="text-xs text-gray-500">{{ $biaya->status == 'active' ? 'Digunakan sebagai biaya saat ini' : 'Disimpan sebagai draft' }}</div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.master.biaya-kategori.index') }}"
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors duration-200">
                        Kembali
                    </a>
                    <a href="{{ route('admin.master.biaya-kategori.edit', $biaya->id) }}"
                       class="px-8 py-3 bg-purple-600 text-white rounded-xl font-semibold hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>Edit Biaya</span>
                    </a>
                </div>
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
                            <div class="text-lg font-bold text-gray-900">Rp {{ number_format($biaya->biaya_kumite, 0, ',', '.') }}</div>
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
                            <div class="text-lg font-bold text-gray-900">Rp {{ number_format($biaya->biaya_kata, 0, ',', '.') }}</div>
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
                            <div class="text-lg font-bold text-gray-900">Rp {{ number_format($biaya->biaya_beregu, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 p-4 bg-white rounded-lg border border-purple-100">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 font-medium">Total Maksimal (Semua Kategori)</div>
                        <div class="text-2xl font-bold text-purple-900">Rp {{ number_format($biaya->biaya_kumite + $biaya->biaya_kata + ($biaya->biaya_beregu * 2), 0, ',', '.') }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Biaya terendah</div>
                        <div class="text-lg font-semibold text-green-600">Rp {{ number_format(min($biaya->biaya_kumite, $biaya->biaya_kata, $biaya->biaya_beregu), 0, ',', '.') }}</div>
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
