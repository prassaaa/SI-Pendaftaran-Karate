@extends('layouts.peserta')

@section('content')
<div class="space-y-8"> {{-- Consistent with dashboard's outer spacing --}}
    {{-- Applying dashboard-like header styling --}}
    <div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 rounded-2xl shadow-2xl overflow-hidden p-8">
        {{-- Background patterns from dashboard for added visual flair --}}
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-indigo-800/30"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-white/5 to-transparent rounded-full transform translate-x-32 -translate-y-32"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-blue-500/10 to-transparent rounded-full transform -translate-x-16 translate-y-16"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center justify-between">
            <div class="flex items-center space-x-4 mb-6 lg:mb-0">
                <div class="flex-shrink-0 w-20 h-20 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border-2 border-white/30">
                    @if($peserta->foto_path)
                        <img src="{{ Storage::url($peserta->foto_path) }}"
                             alt="Foto {{ $peserta->nama_lengkap }}"
                             class="w-full h-full rounded-full object-cover">
                    @else
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @endif
                </div>
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-white mb-1">{{ $peserta->nama_lengkap }}</h1>
                    <p class="text-blue-100 text-lg mb-2">Kode Pendaftaran: <span class="font-semibold bg-white bg-opacity-20 px-3 py-1 rounded-lg">{{ $peserta->kode_pendaftaran }}</span></p>
                    <div class="flex items-center space-x-2 text-sm">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">{{ $peserta->ranting->nama_ranting }}</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">{{ $peserta->kategoriUsia->nama_kategori }}</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">{{ $peserta->umur }} tahun</span>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-0">
                {{-- Button styling like dashboard's interactive header elements --}}
                <a href="{{ route('peserta.profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl font-medium text-sm text-white hover:bg-white/20 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Profil
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-{{ $peserta->status_pendaftaran === 'approved' ? 'green' : ($peserta->status_pendaftaran === 'pending' ? 'amber' : 'red') }}-50 to-{{ $peserta->status_pendaftaran === 'approved' ? 'emerald' : ($peserta->status_pendaftaran === 'pending' ? 'orange' : 'pink') }}-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-{{ $peserta->status_pendaftaran === 'approved' ? 'green' : ($peserta->status_pendaftaran === 'pending' ? 'amber' : 'red') }}-500 to-{{ $peserta->status_pendaftaran === 'approved' ? 'emerald' : ($peserta->status_pendaftaran === 'pending' ? 'orange' : 'pink') }}-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        @if($peserta->status_pendaftaran === 'approved')
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @elseif($peserta->status_pendaftaran === 'pending')
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @else
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-lg font-bold text-gray-900">Status Pendaftaran</div>
                        <div class="text-sm text-gray-500 font-medium">
                            @if($peserta->status_pendaftaran === 'approved') Pendaftaran Disetujui
                            @elseif($peserta->status_pendaftaran === 'pending') Menunggu Persetujuan
                            @else Pendaftaran Ditolak
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-sm text-{{ $peserta->status_pendaftaran === 'approved' ? 'green' : ($peserta->status_pendaftaran === 'pending' ? 'amber' : 'red') }}-600 flex items-center font-medium">
                     @if($peserta->status_pendaftaran === 'approved')
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @elseif($peserta->status_pendaftaran === 'pending')
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                    @else
                         <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                    @endif
                    {{ ucfirst($peserta->status_pendaftaran) }}
                </div>
            </div>
        </div>

        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-{{ $peserta->status_bayar === 'paid' ? 'green' : ($peserta->status_bayar === 'pending' ? 'amber' : 'red') }}-50 to-{{ $peserta->status_bayar === 'paid' ? 'emerald' : ($peserta->status_bayar === 'pending' ? 'orange' : 'pink') }}-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-{{ $peserta->status_bayar === 'paid' ? 'green' : ($peserta->status_bayar === 'pending' ? 'amber' : 'red') }}-500 to-{{ $peserta->status_bayar === 'paid' ? 'emerald' : ($peserta->status_bayar === 'pending' ? 'orange' : 'pink') }}-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/></svg>
                    </div>
                    <div class="text-right">
                        <div class="text-lg font-bold text-gray-900">Status Pembayaran</div>
                        <div class="text-sm text-gray-500 font-medium">
                            @if($peserta->status_bayar === 'paid') Pembayaran Lunas
                            @elseif($peserta->status_bayar === 'pending') Menunggu Verifikasi
                            @else Belum Dibayar
                            @endif
                        </div>
                    </div>
                </div>
                 <div class="text-sm text-{{ $peserta->status_bayar === 'paid' ? 'green' : ($peserta->status_bayar === 'pending' ? 'amber' : 'red') }}-600 flex items-center font-medium">
                    @if($peserta->status_bayar === 'paid')
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @else
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                    @endif
                    {{ ucfirst($peserta->status_bayar) }}
                </div>
            </div>
        </div>

        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-50"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-blue-600">{{ $peserta->formatted_total_biaya }}</div>
                        <div class="text-sm text-gray-500 font-medium">Total Biaya</div>
                    </div>
                </div>
                <div class="text-sm text-blue-600 flex items-center font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    Biaya Pendaftaran
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 space-y-6">
            {{-- Applying dashboard's card style --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100"> {{-- Standardized padding and border --}}
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Informasi Pribadi
                    </h3>
                </div>
                <div class="p-6">
                    {{-- Using dashboard's detail item styling --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <div class="bg-gray-50 rounded-xl p-4"><div class="text-sm text-gray-500 mb-1">Nama Lengkap</div><div class="font-semibold text-gray-900">{{ $peserta->nama_lengkap }}</div></div>
                        <div class="bg-gray-50 rounded-xl p-4"><div class="text-sm text-gray-500 mb-1">Kode Pendaftaran</div><div class="font-semibold text-blue-600 font-mono">{{ $peserta->kode_pendaftaran }}</div></div>
                        <div class="bg-gray-50 rounded-xl p-4"><div class="text-sm text-gray-500 mb-1">Tempat, Tanggal Lahir</div><div class="font-semibold text-gray-900">{{ $peserta->tempat_tanggal_lahir }}</div></div>
                        <div class="bg-gray-50 rounded-xl p-4"><div class="text-sm text-gray-500 mb-1">Umur</div><div class="font-semibold text-gray-900">{{ $peserta->umur }} tahun</div></div>
                        <div class="bg-gray-50 rounded-xl p-4"><div class="text-sm text-gray-500 mb-1">Jenis Kelamin</div><div class="font-semibold text-gray-900">{{ $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div></div>
                        <div class="bg-gray-50 rounded-xl p-4"><div class="text-sm text-gray-500 mb-1">Golongan Darah</div><div class="font-semibold text-gray-900">{{ $peserta->golongan_darah }}</div></div>
                        <div class="bg-gray-50 rounded-xl p-4"><div class="text-sm text-gray-500 mb-1">Berat Badan</div><div class="font-semibold text-gray-900">{{ $peserta->berat_badan }} KG</div></div>
                        <div class="bg-gray-50 rounded-xl p-4"><div class="text-sm text-gray-500 mb-1">No. Telepon</div><div class="font-semibold text-gray-900">{{ $peserta->no_telepon }}</div></div>
                        <div class="bg-gray-50 rounded-xl p-4 md:col-span-2"><div class="text-sm text-gray-500 mb-1">Alamat</div><div class="font-semibold text-gray-900">{{ $peserta->alamat }}</div></div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                         <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5h1.586a1 1 0 01.707.293l2.414 2.414a1 1 0 001.414 0l2.414-2.414A1 1 0 0117.414 16H19v5"/></svg>
                        Informasi Organisasi
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <div class="text-sm text-gray-500 mb-1">Ranting/Afiliasi</div>
                            <div class="font-semibold text-gray-900">{{ $peserta->ranting->nama_ranting }}</div>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $peserta->ranting->kota }}, {{ $peserta->ranting->provinsi }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <div class="text-sm text-gray-500 mb-1">Kategori Usia</div>
                            <div class="font-semibold text-gray-900">{{ $peserta->kategoriUsia->nama_kategori }}</div>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $peserta->kategoriUsia->rentang_usia }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Kategori Pertandingan
                    </h3>
                </div>
                <div class="p-6">
                    {{-- Applying dashboard's category item styling --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($peserta->kategori_dipilih as $kategori)
                        <div class="group flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl hover:from-green-100 hover:to-emerald-100 transition-all duration-200 border border-green-100">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="font-semibold text-green-800">{{ $kategori }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total Biaya Pendaftaran:</span>
                            <span class="text-2xl font-bold text-blue-600">{{ $peserta->formatted_total_biaya }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Informasi Akun
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <div class="bg-gray-50 rounded-xl p-4"><div class="text-sm text-gray-500 mb-1">Email</div><div class="font-semibold text-gray-900">{{ auth()->user()->email }}</div></div>
                        <div class="bg-gray-50 rounded-xl p-4"><div class="text-sm text-gray-500 mb-1">Role</div><div class="font-semibold text-gray-900">{{ ucfirst(auth()->user()->role) }}</div></div>
                        <div class="bg-gray-50 rounded-xl p-4"><div class="text-sm text-gray-500 mb-1">Tanggal Daftar</div><div class="font-semibold text-gray-900">{{ $peserta->created_at->format('d F Y, H:i') }} WIB</div></div>
                        <div class="bg-gray-50 rounded-xl p-4"><div class="text-sm text-gray-500 mb-1">Terakhir Diperbarui</div><div class="font-semibold text-gray-900">{{ $peserta->updated_at->format('d F Y, H:i') }} WIB</div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Foto Profil</h3>
                <div class="text-center">
                     <div class="w-40 h-48 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl border-2 border-dashed border-blue-200 flex items-center justify-center mx-auto mb-4">
                        @if($peserta->foto_path)
                            <img src="{{ Storage::url($peserta->foto_path) }}" alt="Foto {{ $peserta->nama_lengkap }}" class="w-full h-full object-cover rounded-xl">
                        @else
                            <div class="text-center">
                                <svg class="w-16 h-16 text-blue-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span class="text-sm text-blue-500 font-medium">Belum ada foto</span>
                            </div>
                        @endif
                    </div>
                    {{-- Button styling like dashboard's secondary/upload buttons --}}
                    <a href="{{ route('peserta.profile.edit') }}" class="group w-full sm:w-auto flex items-center justify-center p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 border border-blue-200">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        </div>
                        <div class="ml-3 flex-1 text-left">
                            <div class="font-semibold text-gray-900">{{ $peserta->foto_path ? 'Ganti Foto' : 'Upload Foto' }}</div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    {{-- Applying dashboard's gradient button styles --}}
                    <a href="{{ route('peserta.profile.edit') }}"
                       class="flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Profil
                    </a>
                    <a href="{{ route('peserta.dashboard.download-formulir') }}"
                       class="group flex items-center p-3 bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl hover:from-gray-100 hover:to-slate-100 transition-all duration-200 border border-gray-200 hover:border-gray-300">
                        <div class="w-10 h-10 bg-gradient-to-br from-gray-500 to-slate-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="ml-3 flex-1 text-left"><div class="text-sm font-semibold text-gray-900">Download Formulir</div><div class="text-xs text-gray-500">PDF</div></div>
                    </a>
                    <a href="{{ route('peserta.dashboard.download-invoice') }}"
                       class="group flex items-center p-3 bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl hover:from-gray-100 hover:to-slate-100 transition-all duration-200 border border-gray-200 hover:border-gray-300">
                        <div class="w-10 h-10 bg-gradient-to-br from-gray-500 to-slate-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="ml-3 flex-1 text-left"><div class="text-sm font-semibold text-gray-900">Download Invoice</div><div class="text-xs text-gray-500">PDF</div></div>
                    </a>
                </div>
            </div>

            @if($peserta->pembayaran->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900">Riwayat Pembayaran</h3>
                </div>
                <div class="divide-y divide-gray-100"> {{-- Lighter divider --}}
                    @foreach($peserta->pembayaran->take(3) as $pembayaran)
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold text-gray-800">{{ $pembayaran->kode_pembayaran }}</span>
                            {{-- Consistent badge styling with dashboard --}}
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $pembayaran->status_bayar === 'paid' ? 'green' : ($pembayaran->status_bayar === 'pending' ? 'yellow' : 'red') }}-100 text-{{ $pembayaran->status_bayar === 'paid' ? 'green' : ($pembayaran->status_bayar === 'pending' ? 'yellow' : 'red') }}-800">
                                {{ ucfirst($pembayaran->status_bayar) }}
                            </span>
                        </div>
                        <div class="space-y-1 text-sm text-gray-600">
                            <div class="flex justify-between"><span>Jumlah:</span><span class="font-medium text-gray-800">{{ $pembayaran->formatted_jumlah_bayar }}</span></div>
                            <div class="flex justify-between"><span>Metode:</span><span>{{ $pembayaran->metode_pembayaran_formatted }}</span></div>
                            @if($pembayaran->tanggal_bayar)
                            <div class="flex justify-between"><span>Tanggal:</span><span>{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</span></div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @if($peserta->pembayaran->count() > 3)
                    <div class="p-4 bg-gray-50 text-center">
                        <a href="{{ route('peserta.dashboard') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                            Lihat semua riwayat pembayaran →
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Data Pribadi</h3>
                <div class="space-y-3">
                     <a href="{{ route('peserta.profile.download-data') }}"
                       class="group flex items-center p-3 bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl hover:from-gray-100 hover:to-slate-100 transition-all duration-200 border border-gray-200 hover:border-gray-300">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200"> {{-- Changed color for distinction --}}
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="ml-3 flex-1 text-left"><div class="text-sm font-semibold text-gray-900">Download Data Saya</div><div class="text-xs text-gray-500">JSON</div></div>
                    </a>
                    <p class="text-xs text-gray-500 text-center">
                        File JSON berisi semua informasi pribadi dan riwayat pendaftaran Anda.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Bantuan & Dukungan</h3>
                <div class="space-y-4">
                    <div class="text-sm text-gray-600">
                        <p class="mb-3 font-medium text-gray-700">Butuh bantuan? Hubungi kami:</p>
                        <div class="space-y-3">
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span class="font-medium">{{ Setting::get('office_phone', '0354-123456') }}</span>
                            </div>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span class="font-medium">{{ Setting::get('office_email', 'info@inkai-kediri.org') }}</span>
                            </div>
                            <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-sm leading-relaxed">{{ Setting::get('office_address', 'Jl. Brawijaya No. 123, Kediri') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-500">
                            <span class="font-medium">Jam Operasional:</span><br>
                            {{ Setting::get('office_hours', 'Senin-Jumat: 08:00-16:00, Sabtu: 08:00-12:00') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                 <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                Timeline Aktivitas
            </h3>
        </div>
        <div class="p-6">
            <div class="flow-root">
                <ul class="-mb-8">
                    <li>
                        <div class="relative pb-8">
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center ring-8 ring-white">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div><p class="text-sm text-gray-600 font-medium">Pendaftaran berhasil dibuat</p><p class="text-xs text-gray-400">{{ $peserta->created_at->format('d F Y, H:i') }} WIB</p></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    @if($peserta->status_pendaftaran !== 'pending')
                    <li>
                        <div class="relative pb-8">
                            @if($peserta->pembayaran->count() > 0 || $peserta->status_pendaftaran !== 'approved') {{-- Adjust timeline connector logic --}}
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            @endif
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-gradient-to-br {{ $peserta->status_pendaftaran === 'approved' ? 'from-green-500 to-emerald-500' : 'from-red-500 to-pink-500' }} flex items-center justify-center ring-8 ring-white">
                                        @if($peserta->status_pendaftaran === 'approved')
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        @else
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        @endif
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div><p class="text-sm text-gray-600 font-medium">Pendaftaran {{ $peserta->status_pendaftaran === 'approved' ? 'disetujui' : 'ditolak' }}</p><p class="text-xs text-gray-400">{{ $peserta->updated_at->format('d F Y, H:i') }} WIB</p></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif

                    @foreach($peserta->pembayaran as $index => $pembayaran)
                    <li>
                        <div class="relative {{ $index < $peserta->pembayaran->count() - 1 ? 'pb-8' : '' }}">
                            @if($index < $peserta->pembayaran->count() - 1)
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            @endif
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-gradient-to-br {{ $pembayaran->status_bayar === 'paid' ? 'from-green-500 to-emerald-500' : ($pembayaran->status_bayar === 'pending' ? 'from-amber-500 to-orange-500' : 'from-red-500 to-pink-500') }} flex items-center justify-center ring-8 ring-white">
                                        @if($pembayaran->status_bayar === 'paid')
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        @elseif($pembayaran->status_bayar === 'pending')
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        @else
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        @endif
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">
                                            @if($pembayaran->status_bayar === 'paid') Pembayaran berhasil diverifikasi
                                            @elseif($pembayaran->status_bayar === 'pending') Bukti pembayaran diupload - menunggu verifikasi
                                            @else Pembayaran ditolak/bermasalah
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $pembayaran->formatted_jumlah_bayar }} via {{ $pembayaran->metode_pembayaran_formatted }}</p>
                                        <p class="text-xs text-gray-400">
                                            @if($pembayaran->verified_at) {{ $pembayaran->verified_at->format('d F Y, H:i') }} WIB
                                            @else {{ $pembayaran->created_at->format('d F Y, H:i') }} WIB
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
{{-- Styles from dashboard.blade.php --}}
<style>
    .animate-slide-up { animation: slideUp 0.6s ease-out forwards; }
    @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeIn 0.8s ease-out forwards; }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    .animate-scale-in { animation: scaleIn 0.5s ease-out forwards; }
    @keyframes scaleIn { from { opacity: 0; transform: scale(0.8); } to { opacity: 1; transform: scale(1); } }
    .loading-pulse { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
    @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
    .hover-lift { transition: all 0.3s ease; }
    .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #F3F4F6; border-radius: 3px; }
    ::-webkit-scrollbar-thumb { background: #D1D5DB; border-radius: 3px; }
    ::-webkit-scrollbar-thumb:hover { background: #9CA3AF; }
    .group:hover .group-hover\:scale-110 { transform: scale(1.1); }
    .group:hover .group-hover\:text-gray-600 { color: #4B5563; }

    /* Remove redundant styles from original show.blade.php if covered by Tailwind or dashboard styles */
    /* .peserta-card, .peserta-btn-*, .badge, .info-item etc. are now primarily styled with direct Tailwind or dashboard-like classes */

    /* Timeline improvements from show.blade.php */
    .flow-root ul li:last-child .pb-8 { padding-bottom: 0 !important; } /* Ensure last item doesn't have extra padding */
    .flow-root ul li:last-child .absolute[aria-hidden="true"] { display: none; } /* Hide connector for last item */

</style>
@endpush

@push('scripts')
{{-- Scripts from dashboard.blade.php, merged with show.blade.php's unique scripts --}}
<script>
    // Enhanced toast notification function from dashboard
    window.showToast = function(message, type = 'info') {
        const toastContainer = document.getElementById('toast-container') || createToastContainer();
        const toast = document.createElement('div');
        toast.className = `toast-item ${type} transform translate-x-full transition-transform duration-300 ease-out`; // Added ease-out

        const icons = {
            success: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
            error: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`, // Changed icon for error
            info: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`
        };

        toast.innerHTML = `
            <div class="flex items-center space-x-3 p-4 rounded-xl shadow-2xl border backdrop-blur-sm min-w-[300px] max-w-md
                        ${type === 'success' ? 'bg-green-500 text-white border-green-600' : // Brighter success
                          type === 'error' ? 'bg-red-500 text-white border-red-600' : // Brighter error
                          'bg-blue-500 text-white border-blue-600'}"> {{-- Brighter info --}}
                <div class="flex-shrink-0">
                    ${icons[type]}
                </div>
                <div class="flex-1 font-semibold text-sm">${message}</div>
                <button onclick="this.closest('.toast-item').remove()" class="flex-shrink-0 opacity-70 hover:opacity-100 p-1 rounded-full hover:bg-white hover:bg-opacity-20 transition-opacity">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        `;
        toastContainer.appendChild(toast);
        setTimeout(() => toast.classList.remove('translate-x-full'), 100);
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-x-full'); // Fade out before removing
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    };

    function createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'fixed top-5 right-5 z-[100] space-y-3'; // Increased z-index
        document.body.appendChild(container);
        return container;
    }

    window.showLoading = function() {
        const overlay = document.createElement('div');
        overlay.id = 'loading-overlay';
        overlay.className = 'fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-[110] transition-opacity duration-300'; // Darker, blur, higher z-index
        overlay.innerHTML = `
            <div class="bg-white rounded-2xl p-8 shadow-2xl flex items-center space-x-4 animate-scale-in">
                <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-blue-600"></div>
                <span class="text-gray-700 font-semibold text-lg">Memproses...</span>
            </div>
        `;
        document.body.appendChild(overlay);
        document.body.style.overflow = 'hidden'; // Prevent scrolling when loading
    };

    window.hideLoading = function() {
        const overlay = document.getElementById('loading-overlay');
        if (overlay) {
            overlay.classList.add('opacity-0');
            setTimeout(() => {
                overlay.remove();
                document.body.style.overflow = 'auto';
            }, 300);
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        try {
            const cards = document.querySelectorAll('.group, .bg-white.rounded-2xl.shadow-lg'); // Select more general cards for animation
            cards.forEach((card, index) => {
                if (card) {
                    card.style.animationDelay = `${index * 0.05}s`; // Faster stagger
                    card.classList.add('animate-fade-in'); // Default to fade-in
                }
            });

            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate-slide-up');
                            observer.unobserve(entry.target); // Animate once
                        }
                    });
                }, { threshold: 0.1 });
                document.querySelectorAll('.xl\\:col-span-2 > div, .space-y-6 > div, .grid.gap-6 > div').forEach(el => { // Target more specific elements for slide-up
                    if (el) observer.observe(el);
                });
            }
        } catch (error) { console.warn('Animation initialization warning:', error); }
    });

    // Keyboard shortcuts from dashboard
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey || e.metaKey) {
            switch(e.key.toLowerCase()) { // Use toLowerCase for wider compatibility
                case 'e':
                    e.preventDefault();
                    const editProfileLink = document.querySelector('a[href*="peserta/profile/edit"]');
                    if(editProfileLink) editProfileLink.click();
                    else window.location.href = "{{ route('peserta.profile.edit') }}"; // Fallback
                    break;
                case 'r':
                    e.preventDefault();
                    location.reload();
                    break;
            }
        }
    });

    // Network status monitoring from dashboard
    window.addEventListener('online', () => showToast('Koneksi internet tersambung kembali.', 'success'));
    window.addEventListener('offline', () => showToast('Koneksi internet terputus. Beberapa fitur mungkin tidak berfungsi.', 'error')); // More informative message

    // Auto-refresh status from original show.blade.php (kept)
    setInterval(function() {
        fetch('{{ route("peserta.profile.status-check") }}')
            .then(response => response.json())
            .then(data => {
                if (data.status_changed) {
                    showToast('Status pendaftaran atau pembayaran telah diperbarui!', 'info'); // Use the new toast
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            })
            .catch(error => {
                console.warn('Status check failed:', error); // Use warn for non-critical errors
            });
    }, 30000);

</script>
@endpush
