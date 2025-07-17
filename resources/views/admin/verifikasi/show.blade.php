@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="relative bg-gradient-to-br from-slate-900 via-purple-900 to-indigo-900 rounded-2xl shadow-2xl overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-purple-600/20 to-indigo-800/30"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-white/5 to-transparent rounded-full transform translate-x-32 -translate-y-32"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-purple-500/10 to-transparent rounded-full transform -translate-x-16 translate-y-16"></div>

        <div class="relative p-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                <div class="mb-6 lg:mb-0">
                    <div class="flex items-center space-x-4 mb-4">
                        <a href="{{ route('admin.verifikasi.index') }}"
                           class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 border border-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                        </a>
                        <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">Detail Verifikasi Pembayaran</h1>
                            <p class="text-purple-100 text-lg">Peserta: {{ $pembayaran->peserta->nama_lengkap }}</p>
                            <p class="text-purple-200 text-sm">{{ $pembayaran->kode_pembayaran }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-4">
                    @if($pembayaran->status_bayar === 'pending')
                        <button onclick="approvePayment()"
                               class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-3 rounded-xl font-semibold hover:from-green-600 hover:to-emerald-600 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Setujui</span>
                        </button>
                        <button onclick="rejectPayment()"
                               class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 py-3 rounded-xl font-semibold hover:from-red-600 hover:to-pink-600 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span>Tolak</span>
                        </button>
                    @endif
                    <a href="{{ route('admin.export.pembayaran.detail', $pembayaran->id) }}"
                       class="bg-white/10 backdrop-blur-sm text-white px-6 py-3 rounded-xl font-semibold hover:bg-white/20 transition-all duration-300 border border-white/20 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Export</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Alert -->
    @if($pembayaran->status_bayar === 'pending')
    <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-2xl shadow-lg p-6">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-amber-900 mb-2">Pembayaran Menunggu Verifikasi</h3>
                <p class="text-amber-800">Silakan periksa bukti pembayaran dan lakukan verifikasi untuk melanjutkan proses pendaftaran peserta.</p>
                <div class="mt-4 flex items-center space-x-2">
                    <div class="w-3 h-3 bg-amber-400 rounded-full animate-pulse"></div>
                    <span class="text-sm text-amber-700 font-medium">Perlu tindakan segera</span>
                </div>
            </div>
        </div>
    </div>
    @elseif($pembayaran->status_bayar === 'paid')
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl shadow-lg p-6">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-green-900 mb-2">Pembayaran Sudah Diverifikasi</h3>
                <p class="text-green-800">
                    Diverifikasi oleh {{ $pembayaran->verifiedBy->name }} pada {{ $pembayaran->verified_at->format('d F Y, H:i') }} WIB
                </p>
                <div class="mt-4 flex items-center space-x-2">
                    <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                    <span class="text-sm text-green-700 font-medium">Pembayaran valid</span>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 rounded-2xl shadow-lg p-6">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-red-900 mb-2">Pembayaran Ditolak</h3>
                @if($pembayaran->keterangan)
                    <p class="text-red-800 mb-2"><strong>Alasan:</strong> {{ $pembayaran->keterangan }}</p>
                @endif
                <div class="mt-4 flex items-center space-x-2">
                    <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                    <span class="text-sm text-red-700 font-medium">Pembayaran tidak valid</span>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="xl:col-span-2 space-y-8">
            <!-- Payment Information -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Informasi Pembayaran</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Kode Pembayaran</label>
                            <p class="text-lg font-mono text-purple-600 bg-purple-50 px-3 py-2 rounded-lg">{{ $pembayaran->kode_pembayaran }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Jumlah Bayar</label>
                            <p class="text-2xl font-bold text-green-600">{{ $pembayaran->formatted_jumlah_bayar }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Metode Pembayaran</label>
                            <p class="text-gray-900 font-medium">{{ $pembayaran->metode_pembayaran_formatted }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Status</label>
                            @if($pembayaran->status_bayar === 'paid')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                    Paid
                                </span>
                            @elseif($pembayaran->status_bayar === 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-amber-100 text-amber-800">
                                    <div class="w-2 h-2 bg-amber-400 rounded-full mr-2"></div>
                                    Pending
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                    <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                    Failed
                                </span>
                            @endif
                        </div>
                        @if($pembayaran->tanggal_bayar)
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Tanggal Bayar</label>
                            <p class="text-gray-900 font-medium">{{ $pembayaran->tanggal_bayar->format('d F Y, H:i') }} WIB</p>
                        </div>
                        @endif
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Tanggal Upload</label>
                            <p class="text-gray-900 font-medium">{{ $pembayaran->created_at->format('d F Y, H:i') }} WIB</p>
                        </div>
                        @if($pembayaran->tanggal_expired)
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Batas Waktu</label>
                            <p class="font-medium {{ $pembayaran->isExpired() ? 'text-red-600' : 'text-green-600' }}">
                                {{ $pembayaran->tanggal_expired->format('d F Y, H:i') }} WIB
                                @if($pembayaran->isExpired())
                                    <span class="text-red-500 text-sm font-semibold">(Expired)</span>
                                @endif
                            </p>
                        </div>
                        @endif
                        @if($pembayaran->keterangan)
                        <div class="md:col-span-2 space-y-1">
                            <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Keterangan</label>
                            <p class="text-gray-900 bg-gray-50 p-4 rounded-lg">{{ $pembayaran->keterangan }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Participant Information -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Informasi Peserta</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start space-x-6">
                        <!-- Photo -->
                        <div class="flex-shrink-0">
                            @if($pembayaran->peserta->foto_path)
                                <div class="relative group">
                                    <img src="{{ Storage::url($pembayaran->peserta->foto_path) }}"
                                         alt="Foto {{ $pembayaran->peserta->nama_lengkap }}"
                                         class="w-32 h-40 object-cover rounded-2xl border-2 border-gray-200 shadow-lg group-hover:shadow-xl transition-all duration-300">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-2xl transition-all duration-300"></div>
                                </div>
                            @else
                                <div class="w-32 h-40 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl border-2 border-gray-300 flex items-center justify-center shadow-lg">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Details -->
                        <div class="flex-1 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Kode Pendaftaran</label>
                                    <p class="text-lg font-mono text-blue-600 bg-blue-50 px-3 py-2 rounded-lg">{{ $pembayaran->peserta->kode_pendaftaran }}</p>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Nama Lengkap</label>
                                    <p class="text-lg font-bold text-gray-900">{{ $pembayaran->peserta->nama_lengkap }}</p>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Ranting</label>
                                    <p class="text-gray-900 font-medium">{{ $pembayaran->peserta->ranting->nama_ranting }}</p>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Kategori Usia</label>
                                    <p class="text-gray-900 font-medium">{{ $pembayaran->peserta->kategoriUsia->nama_kategori }}</p>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">No. Telepon</label>
                                    <p class="text-gray-900 font-medium">{{ $pembayaran->peserta->no_telepon }}</p>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Email</label>
                                    <p class="text-gray-900 font-medium">{{ $pembayaran->peserta->user->email }}</p>
                                </div>
                            </div>

                            <!-- Competition Categories -->
                            <div class="space-y-3">
                                <label class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Kategori Pertandingan</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($pembayaran->peserta->kategori_dipilih as $kategori)
                                        <span class="inline-block bg-blue-100 text-blue-800 text-sm px-4 py-2 rounded-full font-medium">
                                            {{ $kategori }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <a href="{{ route('admin.peserta.show', $pembayaran->peserta->id) }}"
                               class="bg-blue-50 text-blue-600 px-6 py-3 rounded-xl font-semibold hover:bg-blue-100 transition-all duration-300 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span>Lihat Detail Peserta</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Proof -->
            @if($pembayaran->bukti_bayar_path)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Bukti Pembayaran</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="text-center">
                        @if(Str::endsWith($pembayaran->bukti_bayar_path, ['.jpg', '.jpeg', '.png', '.gif']))
                            <div class="max-w-lg mx-auto">
                                <div class="relative group">
                                    <img src="{{ Storage::url($pembayaran->bukti_bayar_path) }}"
                                         alt="Bukti Pembayaran"
                                         class="w-full rounded-2xl border-2 border-gray-200 shadow-xl cursor-pointer group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-105"
                                         onclick="openImageModal(this.src)">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-2xl transition-all duration-300 flex items-center justify-center">
                                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <div class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg">
                                                <span class="text-gray-800 font-medium text-sm">Klik untuk memperbesar</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mt-4">Klik gambar untuk memperbesar</p>
                            </div>
                        @else
                            <div class="flex items-center justify-center w-32 h-32 bg-gray-100 rounded-2xl mx-auto">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">File bukti pembayaran</p>
                        @endif

                        <div class="mt-6">
                            <a href="{{ Storage::url($pembayaran->bukti_bayar_path) }}"
                               target="_blank"
                               class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-indigo-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2 mx-auto w-fit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span>Download Bukti</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Verification Actions -->
            @if($pembayaran->status_bayar === 'pending')
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Aksi Verifikasi</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <button onclick="approvePayment()"
                                class="w-full bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-4 rounded-xl font-semibold hover:from-green-600 hover:to-emerald-600 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Setujui Pembayaran</span>
                        </button>

                        <button onclick="rejectPayment()"
                                class="w-full bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 py-4 rounded-xl font-semibold hover:from-red-600 hover:to-pink-600 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span>Tolak Pembayaran</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Verification History -->
            @if($pembayaran->verified_at)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Riwayat Verifikasi</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-3 h-3 bg-green-400 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Pembayaran Diverifikasi</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $pembayaran->verified_at->format('d F Y, H:i') }} WIB</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-3 h-3 bg-blue-400 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Diverifikasi oleh</p>
                                <p class="text-sm text-gray-600">{{ $pembayaran->verifiedBy->name }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Payment Summary -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Ringkasan</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Status</span>
                            @if($pembayaran->status_bayar === 'paid')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                    Paid
                                </span>
                            @elseif($pembayaran->status_bayar === 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                    <div class="w-2 h-2 bg-amber-400 rounded-full mr-2"></div>
                                    Pending
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                    <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                    Failed
                                </span>
                            @endif
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Jumlah</span>
                            <span class="text-lg font-bold text-green-600">{{ $pembayaran->formatted_jumlah_bayar }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Metode</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $pembayaran->metode_pembayaran_formatted }}</span>
                        </div>
                        @if($pembayaran->tanggal_bayar)
                        <div class="flex justify-between items-center py-3">
                            <span class="text-sm font-medium text-gray-600">Tanggal</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Quick Actions</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="{{ route('admin.peserta.show', $pembayaran->peserta->id) }}"
                           class="w-full bg-blue-50 text-blue-600 px-6 py-3 rounded-xl font-semibold hover:bg-blue-100 transition-all duration-300 flex items-center justify-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Lihat Peserta</span>
                        </a>

                        <a href="{{ route('admin.export.sertifikat', $pembayaran->peserta->id) }}"
                           class="w-full bg-purple-50 text-purple-600 px-6 py-3 rounded-xl font-semibold hover:bg-purple-100 transition-all duration-300 flex items-center justify-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Download Sertifikat</span>
                        </a>

                        <button onclick="copyToClipboard('{{ $pembayaran->kode_pembayaran }}')"
                               class="w-full bg-gray-50 text-gray-600 px-6 py-3 rounded-xl font-semibold hover:bg-gray-100 transition-all duration-300 flex items-center justify-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            <span>Copy Kode</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Approve Modal -->
<div id="approveModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-0 border-0 w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden animate-scale-in">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white">Setujui Pembayaran</h3>
                    </div>
                    <button onclick="closeApproveModal()" class="text-white/80 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form id="approveForm" method="POST" action="{{ route('admin.verifikasi.approve', $pembayaran->id) }}">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Keterangan Verifikasi (Opsional)</label>
                        <div class="relative">
                            <textarea name="keterangan" rows="4"
                                      class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-sm resize-none"
                                      placeholder="Tambahkan catatan verifikasi jika diperlukan..."></textarea>
                            <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                                <span id="approveCharCount">0</span>/300
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Catatan ini akan disimpan dalam sistem untuk referensi</p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeApproveModal()"
                                class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-200">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-semibold hover:from-green-600 hover:to-emerald-600 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Setujui Pembayaran</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-0 border-0 w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden animate-scale-in">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-red-500 to-pink-500 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white">Tolak Pembayaran</h3>
                    </div>
                    <button onclick="closeRejectModal()" class="text-white/80 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form id="rejectForm" method="POST" action="{{ route('admin.verifikasi.reject', $pembayaran->id) }}">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Alasan Penolakan <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <textarea name="reason" rows="4"
                                      class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-sm resize-none"
                                      placeholder="Berikan alasan yang jelas mengapa pembayaran ini ditolak..." required></textarea>
                            <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                                <span id="rejectCharCount">0</span>/500
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Alasan ini akan dikirimkan ke peserta melalui email</p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeRejectModal()"
                                class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-200">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-xl font-semibold hover:from-red-600 hover:to-pink-600 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span>Tolak Pembayaran</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 backdrop-blur-sm overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative max-w-6xl max-h-full">
            <button onclick="closeImageModal()"
                    class="absolute top-4 right-4 w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center text-white hover:bg-white/20 transition-all duration-300 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <img id="modalImage" src="" alt="Bukti Pembayaran" class="max-w-full max-h-full rounded-2xl shadow-2xl animate-scale-in">
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl p-8 shadow-2xl flex items-center space-x-4">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
        <span class="text-gray-700 font-semibold">Memproses permintaan...</span>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Enhanced animations */
    .animate-scale-in {
        animation: scaleIn 0.3s ease-out forwards;
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #F3F4F6;
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb {
        background: #D1D5DB;
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #9CA3AF;
    }

    /* Loading animation */
    .loading-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    /* Modal backdrop blur */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }

    /* Better focus states */
    .focus\:ring-2:focus {
        outline: 2px solid transparent;
        outline-offset: 2px;
    }

    /* Enhanced button effects */
    button:active {
        transform: translateY(1px);
    }

    /* Status badge animations */
    .status-badge {
        transition: all 0.2s ease;
    }

    .status-badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
    }

    /* Image hover effects */
    .image-hover {
        transition: all 0.3s ease;
    }

    .image-hover:hover {
        transform: scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Gradient text effect */
    .gradient-text {
        background: linear-gradient(45deg, #8B5CF6, #A855F7);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Card hover effects */
    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    /* Button loading state */
    .btn-loading {
        position: relative;
        pointer-events: none;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
        border: 2px solid transparent;
        border-top: 2px solid currentColor;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: translate(-50%, -50%) rotate(0deg); }
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }
</style>
@endpush

@push('scripts')
<script>
    function approvePayment() {
        document.getElementById('approveModal').classList.remove('hidden');
        document.getElementById('approveModal').classList.add('animate-fade-in');

        // Focus on textarea
        setTimeout(() => {
            document.querySelector('#approveModal textarea').focus();
        }, 300);
    }

    function closeApproveModal() {
        const modal = document.getElementById('approveModal');
        modal.classList.add('hidden');
        modal.classList.remove('animate-fade-in');
        document.getElementById('approveForm').reset();
        updateApproveCharCount();
    }

    function rejectPayment() {
        document.getElementById('rejectModal').classList.remove('hidden');
        document.getElementById('rejectModal').classList.add('animate-fade-in');

        // Focus on textarea
        setTimeout(() => {
            document.querySelector('#rejectModal textarea').focus();
        }, 300);
    }

    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        modal.classList.add('hidden');
        modal.classList.remove('animate-fade-in');
        document.getElementById('rejectForm').reset();
        updateRejectCharCount();
    }

    function openImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
        document.getElementById('imageModal').classList.add('animate-fade-in');
    }

    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        modal.classList.remove('animate-fade-in');
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            showToast('Kode pembayaran berhasil disalin!', 'success');
        }).catch(() => {
            showToast('Gagal menyalin kode pembayaran', 'error');
        });
    }

    function showLoading() {
        document.getElementById('loadingOverlay').classList.remove('hidden');

        // Add loading state to submit buttons
        const buttons = document.querySelectorAll('button[type="submit"]');
        buttons.forEach(btn => {
            btn.disabled = true;
            btn.classList.add('btn-loading');
            const originalText = btn.innerHTML;
            btn.setAttribute('data-original-text', originalText);
            btn.innerHTML = '<span class="opacity-0">' + originalText + '</span>';
        });
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').classList.add('hidden');

        // Remove loading state from submit buttons
        const buttons = document.querySelectorAll('button[type="submit"]');
        buttons.forEach(btn => {
            btn.disabled = false;
            btn.classList.remove('btn-loading');
            const originalText = btn.getAttribute('data-original-text');
            if (originalText) {
                btn.innerHTML = originalText;
            }
        });
    }

    function showToast(message, type = 'info') {
        const toastContainer = document.getElementById('toast-container') || createToastContainer();

        const toast = document.createElement('div');
        toast.className = `toast-item ${type} transform translate-x-full transition-transform duration-300`;

        const icons = {
            success: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                      </svg>`,
            error: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                   </svg>`,
            warning: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                     </svg>`,
            info: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>`
        };

        const colors = {
            success: 'bg-green-50 text-green-800 border-green-200',
            error: 'bg-red-50 text-red-800 border-red-200',
            warning: 'bg-yellow-50 text-yellow-800 border-yellow-200',
            info: 'bg-purple-50 text-purple-800 border-purple-200'
        };

        toast.innerHTML = `
            <div class="flex items-center space-x-3 p-4 rounded-xl shadow-lg border backdrop-blur-sm ${colors[type]}">
                <div class="flex-shrink-0">
                    ${icons[type]}
                </div>
                <div class="flex-1 font-medium">${message}</div>
                <button onclick="this.closest('.toast-item').remove()" class="flex-shrink-0 opacity-70 hover:opacity-100 transition-opacity">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;

        toastContainer.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        // Auto remove
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }

    function createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'fixed top-4 right-4 z-50 space-y-2';
        document.body.appendChild(container);
        return container;
    }

    function updateApproveCharCount() {
        const textarea = document.querySelector('#approveModal textarea');
        const charCount = document.getElementById('approveCharCount');
        if (textarea && charCount) {
            charCount.textContent = textarea.value.length;

            // Change color based on character count
            if (textarea.value.length > 280) {
                charCount.className = 'text-red-500 font-semibold';
            } else if (textarea.value.length > 250) {
                charCount.className = 'text-yellow-500 font-medium';
            } else {
                charCount.className = 'text-gray-400';
            }
        }
    }

    function updateRejectCharCount() {
        const textarea = document.querySelector('#rejectModal textarea');
        const charCount = document.getElementById('rejectCharCount');
        if (textarea && charCount) {
            charCount.textContent = textarea.value.length;

            // Change color based on character count
            if (textarea.value.length > 450) {
                charCount.className = 'text-red-500 font-semibold';
            } else if (textarea.value.length > 350) {
                charCount.className = 'text-yellow-500 font-medium';
            } else {
                charCount.className = 'text-gray-400';
            }
        }
    }

    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize animations
        const cards = document.querySelectorAll('.bg-white');
        cards.forEach((card, index) => {
            if (card) {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate-fade-in', 'card-hover');
            }
        });

        // Character count for approve modal
        const approveTextarea = document.querySelector('#approveModal textarea');
        if (approveTextarea) {
            approveTextarea.addEventListener('input', updateApproveCharCount);
            approveTextarea.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) {
                    document.getElementById('approveForm').dispatchEvent(new Event('submit'));
                }
            });
        }

        // Character count for reject modal
        const rejectTextarea = document.querySelector('#rejectModal textarea');
        if (rejectTextarea) {
            rejectTextarea.addEventListener('input', updateRejectCharCount);
            rejectTextarea.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) {
                    document.getElementById('rejectForm').dispatchEvent(new Event('submit'));
                }
            });
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Escape to close modals
            if (e.key === 'Escape') {
                closeApproveModal();
                closeRejectModal();
                closeImageModal();
            }

            // Ctrl/Cmd + Enter to submit forms
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                const activeModal = document.querySelector('.fixed:not(.hidden)');
                if (activeModal) {
                    const form = activeModal.querySelector('form');
                    if (form) {
                        form.dispatchEvent(new Event('submit'));
                    }
                }
            }
        });

        // Add hover effects to images
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.classList.add('image-hover');
        });

        // Add status badge hover effects
        const statusBadges = document.querySelectorAll('.inline-flex');
        statusBadges.forEach(badge => {
            badge.classList.add('status-badge');
        });
    });

    // Form submissions with enhanced validation
    document.getElementById('approveForm').addEventListener('submit', function(e) {
        e.preventDefault();
        showLoading();

        // Simulate form submission delay
        setTimeout(() => {
            this.submit();
        }, 500);
    });

    document.getElementById('rejectForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const reason = this.querySelector('textarea[name="reason"]').value.trim();

        if (reason.length < 10) {
            showToast('Alasan penolakan minimal 10 karakter', 'warning');
            return;
        }

        if (reason.length > 500) {
            showToast('Alasan penolakan maksimal 500 karakter', 'warning');
            return;
        }

        showLoading();

        // Simulate form submission delay
        setTimeout(() => {
            this.submit();
        }, 500);
    });

    // Close modals when clicking outside
    document.getElementById('approveModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeApproveModal();
        }
    });

    document.getElementById('rejectModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRejectModal();
        }
    });

    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });

    // Enhanced image loading
    function initializeImageLoading() {
        const images = document.querySelectorAll('img[src]');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.classList.add('animate-fade-in');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }

    // Initialize enhanced features
    document.addEventListener('DOMContentLoaded', function() {
        initializeImageLoading();

        // Add loading states to action buttons
        const actionButtons = document.querySelectorAll('a[href*="export"], a[href*="download"]');
        actionButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.add('loading-pulse');
                setTimeout(() => {
                    this.classList.remove('loading-pulse');
                }, 2000);
            });
        });

        // Auto-save form data in session storage for modals
        const formInputs = document.querySelectorAll('#approveModal textarea, #rejectModal textarea');
        formInputs.forEach(input => {
            const key = `form_${input.closest('form').id}_${input.name}`;

            // Load saved data
            const savedValue = sessionStorage.getItem(key);
            if (savedValue) {
                input.value = savedValue;
                // Update character count
                if (input.closest('#approveModal')) {
                    updateApproveCharCount();
                } else {
                    updateRejectCharCount();
                }
            }

            // Save data on input
            input.addEventListener('input', function() {
                sessionStorage.setItem(key, this.value);
            });

            // Clear saved data on form submit
            input.closest('form').addEventListener('submit', function() {
                sessionStorage.removeItem(key);
            });
        });
    });

    // Utility functions
    window.verifikasiDetailUtils = {
        formatCurrency: function(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        },

        formatDate: function(date) {
            return new Intl.DateTimeFormat('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }).format(new Date(date));
        },

        printPage: function() {
            window.print();
        },

        shareDetails: function() {
            if (navigator.share) {
                navigator.share({
                    title: 'Detail Verifikasi Pembayaran',
                    text: `Pembayaran ${document.querySelector('.font-mono').textContent}`,
                    url: window.location.href
                });
            } else {
                copyToClipboard(window.location.href);
                showToast('Link halaman berhasil disalin!', 'success');
            }
        }
    };

    console.log('Detail Verifikasi Pembayaran Modern UI v2.1.0 loaded successfully! 💳✨');
</script>
@endpush
