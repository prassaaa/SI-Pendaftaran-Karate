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
                    <h1 class="text-2xl font-bold text-white">{{ $ranting->nama_ranting }}</h1>
                    <p class="text-green-100">Detail ranting/cabang karate INKAI</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Section -->
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Informasi Ranting</h2>
                <p class="text-gray-500 mt-1">Rincian informasi ranting karate</p>
            </div>

            <div class="p-8 space-y-6">
                <!-- Nama Ranting -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Nama Ranting</label>
                    <div class="text-gray-900">{{ $ranting->nama_ranting }}</div>
                </div>

                <!-- Lokasi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kota -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Kota/Kabupaten</label>
                        <div class="text-gray-900">{{ $ranting->kota }}</div>
                    </div>

                    <!-- Provinsi -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Provinsi</label>
                        <div class="text-gray-900">{{ $ranting->provinsi }}</div>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Alamat Lengkap</label>
                    <div class="text-gray-900">{{ $ranting->alamat }}</div>
                </div>

                <!-- Kontak -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Nomor Kontak</label>
                    <div class="text-gray-900">{{ $ranting->kontak }}</div>
                </div>

                <!-- Jumlah Peserta -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Jumlah Peserta</label>
                    <div class="text-gray-900">{{ $ranting->peserta_count }} peserta</div>
                    <div class="text-xs text-gray-500">Jumlah peserta yang terdaftar dari ranting ini</div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.master.ranting.index') }}"
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors duration-200">
                        Kembali
                    </a>
                    <a href="{{ route('admin.master.ranting.edit', $ranting->id) }}"
                       class="px-8 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>Edit Ranting</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Participants -->
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Peserta Terbaru</h2>
                <p class="text-gray-500 mt-1">Daftar hingga 10 peserta terbaru dari ranting ini</p>
            </div>

            <div class="p-8">
                @if($recentPeserta->isEmpty())
                    <div class="text-gray-500 text-center py-4">
                        Belum ada peserta terdaftar dari ranting ini.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Peserta
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Pendaftaran
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kategori Usia
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($recentPeserta as $peserta)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $peserta->nama ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $peserta->created_at ? $peserta->created_at->format('d/m/Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $peserta->kategoriUsia->nama_kategori ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
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
