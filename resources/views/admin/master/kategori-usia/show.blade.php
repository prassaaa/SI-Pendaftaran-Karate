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
                    <h1 class="text-2xl font-bold text-white">{{ $kategori->nama_kategori }}</h1>
                    <p class="text-blue-100">Detail kategori usia untuk peserta kejuaraan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Section -->
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Informasi Kategori Usia</h2>
                <p class="text-gray-500 mt-1">Rincian kategori usia untuk peserta karate</p>
            </div>

            <div class="p-8 space-y-6">
                <!-- Nama Kategori -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Nama Kategori</label>
                    <div class="text-gray-900">{{ $kategori->nama_kategori }}</div>
                </div>

                <!-- Rentang Usia -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Rentang Usia</label>
                    <div class="text-gray-900">{{ $kategori->rentang_usia }}</div>
                </div>

                <!-- Deskripsi -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                    <div class="text-gray-900">{{ $kategori->deskripsi ?: 'Tidak ada deskripsi' }}</div>
                </div>

                <!-- Jumlah Peserta -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Jumlah Peserta</label>
                    <div class="text-gray-900">{{ $kategori->peserta_count }} peserta</div>
                    <div class="text-xs text-gray-500">Jumlah peserta yang terdaftar dalam kategori ini</div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.master.kategori-usia.index') }}"
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors duration-200">
                        Kembali
                    </a>
                    <a href="{{ route('admin.master.kategori-usia.edit', $kategori->id) }}"
                       class="px-8 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>Edit Kategori</span>
                    </a>
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
