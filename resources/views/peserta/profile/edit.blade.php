@extends('layouts.peserta')

@section('content')
<div class="space-y-8">
    <div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 rounded-2xl shadow-2xl overflow-hidden p-8">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-indigo-800/30"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-white/5 to-transparent rounded-full transform translate-x-32 -translate-y-32"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-blue-500/10 to-transparent rounded-full transform -translate-x-16 translate-y-16"></div>
        <div class="relative flex items-center space-x-4">
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
                <h1 class="text-3xl font-bold text-white mb-1">Edit Profil</h1>
                <p class="text-blue-100 text-lg">{{ $peserta->nama_lengkap }} <span class="text-sm opacity-70">•</span> {{ $peserta->kode_pendaftaran }}</p>
                <div class="flex items-center space-x-2 mt-2 text-sm">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">{{ $peserta->ranting->nama_ranting }}</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">{{ $peserta->kategoriUsia->nama_kategori }}</span>
                </div>
            </div>
        </div>
    </div>

    @if($peserta->status_pendaftaran === 'approved')
    <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded-r-lg p-4 shadow-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-semibold text-yellow-900">Pendaftaran Sudah Disetujui</h3>
                <p class="mt-1 text-sm text-yellow-800">Beberapa data tidak dapat diubah karena pendaftaran sudah disetujui. Hanya data kontak dan berat badan yang masih bisa diupdate.</p>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Informasi Pribadi
                    </h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('peserta.profile.update') }}" id="profileForm">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $peserta->nama_lengkap) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_lengkap') border-red-500 ring-red-500 @enderror {{ $peserta->status_pendaftaran === 'approved' ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                       {{ $peserta->status_pendaftaran === 'approved' ? 'readonly' : '' }}>
                                @error('nama_lengkap') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $peserta->tempat_lahir) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tempat_lahir') border-red-500 ring-red-500 @enderror {{ $peserta->status_pendaftaran === 'approved' ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                       {{ $peserta->status_pendaftaran === 'approved' ? 'readonly' : '' }}>
                                @error('tempat_lahir') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $peserta->tanggal_lahir->format('Y-m-d')) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_lahir') border-red-500 ring-red-500 @enderror {{ $peserta->status_pendaftaran === 'approved' ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                       {{ $peserta->status_pendaftaran === 'approved' ? 'readonly' : '' }}>
                                @error('tanggal_lahir') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jenis_kelamin') border-red-500 ring-red-500 @enderror {{ $peserta->status_pendaftaran === 'approved' ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                        {{ $peserta->status_pendaftaran === 'approved' ? 'disabled' : '' }}>
                                    <option value="L" {{ old('jenis_kelamin', $peserta->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $peserta->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Golongan Darah</label>
                                <select name="golongan_darah" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('golongan_darah') border-red-500 ring-red-500 @enderror {{ $peserta->status_pendaftaran === 'approved' ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                        {{ $peserta->status_pendaftaran === 'approved' ? 'disabled' : '' }}>
                                    <option value="A" {{ old('golongan_darah', $peserta->golongan_darah) === 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('golongan_darah', $peserta->golongan_darah) === 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('golongan_darah', $peserta->golongan_darah) === 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('golongan_darah', $peserta->golongan_darah) === 'O' ? 'selected' : '' }}>O</option>
                                </select>
                                @error('golongan_darah') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">No. Telepon</label>
                                <input type="text" name="no_telepon" value="{{ old('no_telepon', $peserta->no_telepon) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('no_telepon') border-red-500 ring-red-500 @enderror" placeholder="08xxxxxxxxxx">
                                @error('no_telepon') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Berat Badan (KG)</label>
                                <input type="number" name="berat_badan" value="{{ old('berat_badan', $peserta->berat_badan) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('berat_badan') border-red-500 ring-red-500 @enderror" min="20" max="200" step="0.1">
                                @error('berat_badan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Alamat Lengkap</label>
                                <textarea name="alamat" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('alamat') border-red-500 ring-red-500 @enderror" placeholder="Masukkan alamat lengkap...">{{ old('alamat', $peserta->alamat) }}</textarea>
                                @error('alamat') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        @if($peserta->status_pendaftaran !== 'approved')
                        <div class="border-t border-gray-100 pt-6 mt-6">
                            <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5h1.586a1 1 0 01.707.293l2.414 2.414a1 1 0 001.414 0l2.414-2.414A1 1 0 0117.414 16H19v5"/></svg>
                                Informasi Organisasi
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-900 mb-2">Ranting/Afiliasi</label>
                                    <select name="ranting_id" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('ranting_id') border-red-500 ring-red-500 @enderror">
                                        <option value="">Pilih Ranting</option>
                                        @foreach($rantings as $ranting)
                                            <option value="{{ $ranting->id }}" {{ old('ranting_id', $peserta->ranting_id) == $ranting->id ? 'selected' : '' }}>
                                                {{ $ranting->nama_ranting }} - {{ $ranting->kota }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ranting_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-900 mb-2">Kategori Usia</label>
                                    <select name="kategori_usia_id" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kategori_usia_id') border-red-500 ring-red-500 @enderror">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}" {{ old('kategori_usia_id', $peserta->kategori_usia_id) == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }} ({{ $kategori->rentang_usia }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_usia_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="border-t border-gray-100 pt-6 mt-6">
                            <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Kategori Pertandingan
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @php
                                    $competitionCategories = [
                                        'kumite_perorangan' => ['label' => 'Kumite Perorangan', 'desc' => 'Pertandingan satu lawan satu'],
                                        'kata_perorangan' => ['label' => 'Kata Perorangan', 'desc' => 'Penampilan jurus individu'],
                                        'kata_beregu' => ['label' => 'Kata Beregu', 'desc' => 'Penampilan jurus tim'],
                                        'kumite_beregu' => ['label' => 'Kumite Beregu', 'desc' => 'Pertandingan tim']
                                    ];
                                @endphp
                                @foreach($competitionCategories as $key => $cat)
                                <label class="group flex items-center p-4 bg-gray-50 rounded-xl hover:bg-blue-50 border border-gray-200 hover:border-blue-300 transition-colors duration-200 cursor-pointer has-[:checked]:bg-blue-50 has-[:checked]:border-blue-400">
                                    <input type="checkbox" name="{{ $key }}" value="1"
                                           {{ old($key, $peserta->$key ?? false) ? 'checked' : '' }}
                                           class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded-md">
                                    <div class="ml-3 flex-1">
                                        <div class="font-semibold text-gray-900 group-has-[:checked]:text-blue-700">{{ $cat['label'] }}</div>
                                        <div class="text-sm text-gray-500 group-has-[:checked]:text-blue-600">{{ $cat['desc'] }}</div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                            @error('kategori') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        @endif

                        <div class="border-t border-gray-100 pt-6 mt-6">
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('peserta.dashboard') }}" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-100 transition-colors">
                                    Batal
                                </a>
                                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Foto Profil</h3>
                <div class="text-center">
                    <div class="w-40 h-48 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl border-2 border-dashed border-blue-200 flex items-center justify-center mx-auto mb-4" id="photo-preview">
                        @if($peserta->foto_path)
                            <img src="{{ Storage::url($peserta->foto_path) }}" alt="Foto {{ $peserta->nama_lengkap }}" class="w-full h-full object-cover rounded-xl">
                        @else
                            <div class="text-center">
                                <svg class="w-16 h-16 text-blue-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span class="text-sm text-blue-500 font-medium">Belum ada foto</span>
                            </div>
                        @endif
                    </div>
                    <form id="photoForm" enctype="multipart/form-data" class="space-y-2">
                        @csrf
                        <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg" class="hidden" onchange="previewAndPrepareUpload()">
                        <button type="button" onclick="document.getElementById('foto').click()" class="group w-full flex items-center justify-center p-3 bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl hover:from-gray-100 hover:to-slate-100 transition-all duration-200 border border-gray-200 hover:border-gray-300">
                            <div class="w-10 h-10 bg-gradient-to-br from-gray-500 to-slate-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            </div>
                            <div class="ml-3 flex-1 text-left"><div class="text-sm font-semibold text-gray-900">Pilih Foto</div></div>
                        </button>
                        <button type="button" id="uploadPhotoButton" onclick="uploadPhoto()" class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg hidden items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Upload Foto Pilihan
                        </button>
                    </form>
                    <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG. Max: 2MB</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900">Pengaturan Akun</h3>
                </div>
                <div class="p-6 space-y-3">
                    <button onclick="openEmailModal()" class="group w-full flex items-center p-3 bg-gray-50 rounded-xl hover:bg-blue-50 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="ml-3 flex-1 text-left">
                            <div class="text-sm font-semibold text-gray-900 group-hover:text-blue-700">Email</div>
                            <div class="text-xs text-gray-500 group-hover:text-blue-600">{{ auth()->user()->email }}</div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                    <button onclick="openPasswordModal()" class="group w-full flex items-center p-3 bg-gray-50 rounded-xl hover:bg-blue-50 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                             <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div class="ml-3 flex-1 text-left">
                            <div class="text-sm font-semibold text-gray-900 group-hover:text-blue-700">Password</div>
                            <div class="text-xs text-gray-500 group-hover:text-blue-600">Ubah password akun</div>
                        </div>
                       <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Data & Keamanan</h3>
                <div class="space-y-3">
                    <a href="{{ route('peserta.profile.download-data') }}" class="group w-full flex items-center p-3 bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl hover:from-gray-100 hover:to-slate-100 transition-all duration-200 border border-gray-200 hover:border-gray-300">
                         <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="ml-3 flex-1 text-left"><div class="text-sm font-semibold text-gray-900">Download Data Saya</div></div>
                    </a>
                    <button onclick="openDeleteModal()" class="group w-full flex items-center p-3 bg-gradient-to-r from-red-50 to-pink-50 rounded-xl hover:from-red-100 hover:to-pink-100 transition-all duration-200 border border-red-200 hover:border-red-300">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-pink-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </div>
                         <div class="ml-3 flex-1 text-left"><div class="text-sm font-semibold text-red-800">Hapus Akun</div></div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="emailModal"
     class="fixed inset-0 bg-gray-600 bg-opacity-75 backdrop-blur-sm z-[60] flex items-center justify-center p-4
            opacity-0 pointer-events-none transition-opacity duration-300 ease-out">
    <div id="emailModalPanel" class="p-8 w-full max-w-md shadow-2xl rounded-2xl bg-white
                transform scale-95 opacity-0 transition-all duration-300 ease-out overflow-y-auto max-h-[calc(100vh-2rem)]">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Ubah Email</h3>
            <button onclick="closeModal('emailModal')" class="text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="emailForm" method="POST" action="{{ route('peserta.profile.update-email') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Email Baru <span class="text-red-500">*</span></label>
                <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan email baru" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Password saat ini" required>
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeModal('emailModal')" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-100 transition-colors">Batal</button>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg">Simpan Email</button>
            </div>
        </form>
    </div>
</div>

<div id="passwordModal"
     class="fixed inset-0 bg-gray-600 bg-opacity-75 backdrop-blur-sm z-[60] flex items-center justify-center p-4
            opacity-0 pointer-events-none transition-opacity duration-300 ease-out">
    <div id="passwordModalPanel" class="p-8 w-full max-w-md shadow-2xl rounded-2xl bg-white
                transform scale-95 opacity-0 transition-all duration-300 ease-out overflow-y-auto max-h-[calc(100vh-2rem)]">
         <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Ubah Password</h3>
            <button onclick="closeModal('passwordModal')" class="text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="passwordForm" method="POST" action="{{ route('peserta.profile.update-password') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Password Saat Ini <span class="text-red-500">*</span></label>
                <input type="password" name="current_password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Password Baru <span class="text-red-500">*</span></label>
                <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Konfirmasi Password Baru <span class="text-red-500">*</span></label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeModal('passwordModal')" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-100 transition-colors">Batal</button>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg">Simpan Password</button>
            </div>
        </form>
    </div>
</div>

<div id="deleteModal"
     class="fixed inset-0 bg-gray-600 bg-opacity-75 backdrop-blur-sm z-[60] flex items-center justify-center p-4
            opacity-0 pointer-events-none transition-opacity duration-300 ease-out">
    <div id="deleteModalPanel" class="p-8 w-full max-w-md shadow-2xl rounded-2xl bg-white
                transform scale-95 opacity-0 transition-all duration-300 ease-out overflow-y-auto max-h-[calc(100vh-2rem)]">
         <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Hapus Akun</h3>
            <button onclick="closeModal('deleteModal')" class="text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="deleteForm" method="POST" action="{{ route('peserta.profile.delete-account') }}" class="space-y-4">
            @csrf
            @method('DELETE')
            <p class="text-sm text-gray-600">Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus secara permanen. Untuk melanjutkan, ketik "DELETE" pada kolom di bawah ini.</p>
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Ketik "DELETE" untuk konfirmasi <span class="text-red-500">*</span></label>
                <input type="text" name="confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="DELETE" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Password saat ini" required>
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeModal('deleteModal')" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-100 transition-colors">Batal</button>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 text-white font-semibold rounded-xl hover:from-red-700 hover:to-pink-700 transition-all duration-200 shadow-md hover:shadow-lg">Hapus Akun Saya</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .animate-slide-up { animation: slideUp 0.6s ease-out forwards; }
    @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

    /* .animate-fade-in and .animate-scale-in are not used for modals anymore, but kept for other page elements if needed */
    .animate-fade-in { animation: fadeInAnimation 0.8s ease-out forwards; } /* Renamed to avoid conflict if names were generic */
    @keyframes fadeInAnimation { from { opacity: 0; } to { opacity: 1; } }

    .animate-scale-in { animation: scaleInAnimation 0.5s ease-out forwards; }
    @keyframes scaleInAnimation { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }

    .loading-pulse { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
    @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
    .hover-lift { transition: all 0.3s ease; }
    .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #F3F4F6; border-radius: 3px; }
    ::-webkit-scrollbar-thumb { background: #D1D5DB; border-radius: 3px; }
    ::-webkit-scrollbar-thumb:hover { background: #9CA3AF; }
    .group:hover .group-hover\:scale-110 { transform: scale(1.1); }
    .group.has-[:checked]:hover .group-hover\:text-blue-700 {color: #1D4ED8;}
</style>
@endpush

@push('scripts')
<script>
    window.showToast = function(message, type = 'info') {
        const toastContainer = document.getElementById('toast-container') || createToastContainer();
        const toast = document.createElement('div');
        toast.className = `toast-item transform transition-all duration-300 ease-out max-w-md w-full`;

        const icons = {
            success: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
            error: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
            info: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
            warning: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" /></svg>`
        };
        const colors = {
            success: 'bg-green-500 text-white border-green-600', error: 'bg-red-500 text-white border-red-600',
            warning: 'bg-yellow-400 text-black border-yellow-500', info: 'bg-blue-500 text-white border-blue-600'
        };

        toast.innerHTML = `
            <div class="flex items-center space-x-3 p-4 rounded-xl shadow-2xl border backdrop-blur-sm ${colors[type] || colors.info}">
                <div class="flex-shrink-0">${icons[type] || icons.info}</div>
                <div class="flex-1 font-semibold text-sm">${message}</div>
                <button onclick="this.closest('.toast-item').removeToast()" class="flex-shrink-0 opacity-70 hover:opacity-100 p-1 rounded-full hover:bg-white hover:bg-opacity-20 transition-opacity">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>`;
        toast.style.transform = 'translateX(100%)'; toast.style.opacity = '0';
        toastContainer.appendChild(toast);
        requestAnimationFrame(() => { toast.style.transform = 'translateX(0)'; toast.style.opacity = '1'; });
        toast.removeToast = function() {
            this.style.transform = 'translateX(100%)'; this.style.opacity = '0';
            setTimeout(() => this.remove(), 350); // Sync with transition duration
        };
        setTimeout(() => toast.removeToast(), 5000);
    };
    function createToastContainer() {
        let container = document.getElementById('toast-container');
        if (!container) {
            container = document.createElement('div'); container.id = 'toast-container';
            container.className = 'fixed top-5 right-5 z-[100] space-y-3 w-auto'; document.body.appendChild(container);
        } return container;
    }

    const originalButtonContent = {};
    window.showLoading = function(formElement) {
        const button = formElement ? formElement.querySelector('button[type="submit"]') : document.getElementById('uploadPhotoButton');
        if (button) {
            const buttonId = button.id || button.innerText.substring(0, 10); // Create a unique enough key
            originalButtonContent[buttonId] = button.innerHTML;
            button.disabled = true;
            button.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Processing...`;
        }
    };
    window.hideLoading = function(formElement) {
        const button = formElement ? formElement.querySelector('button[type="submit"]') : document.getElementById('uploadPhotoButton');
        if (button) {
            const buttonId = button.id || button.innerText.substring(0, 10); // Use the same key
            button.disabled = false;
            if (originalButtonContent[buttonId]) {
                button.innerHTML = originalButtonContent[buttonId];
            } else { button.innerHTML = 'Submit'; } // Fallback
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        try { /* Page animations */ } catch (error) { console.warn(error); }
        const draftKey = 'profile_draft_{{ $peserta->id }}';
        const savedDraft = localStorage.getItem(draftKey);
        if (savedDraft && "{{ $peserta->status_pendaftaran }}" !== 'approved') {
            try { /* Draft restore UI */ } catch (e) { localStorage.removeItem(draftKey); }
        }
    });

    let selectedFileForUpload = null;
    function previewAndPrepareUpload() { /* ... existing logic ... */ }
    function uploadPhoto() { /* ... existing logic ... */ }

    // Updated Modal Open/Close for Transitions
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        const panel = document.getElementById(modalId + 'Panel'); // Assuming panel has ID like 'emailModalPanel'
        if (modal && panel) {
            modal.classList.remove('pointer-events-none');
            requestAnimationFrame(() => { // Ensure display is processed before starting transition
                modal.classList.remove('opacity-0');
                panel.classList.remove('opacity-0', 'scale-95');
                panel.classList.add('opacity-100', 'scale-100');
            });
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        const panel = document.getElementById(modalId + 'Panel');
        if (modal && panel) {
            modal.classList.add('opacity-0');
            panel.classList.add('opacity-0', 'scale-95');
            panel.classList.remove('opacity-100', 'scale-100');
            setTimeout(() => {
                // Check if modal is still supposed to be hidden before adding pointer-events-none
                // This is important if another action tries to open it quickly
                if (modal.classList.contains('opacity-0')) {
                     modal.classList.add('pointer-events-none');
                }
            }, 300); // Must match the longest transition duration (opacity is 300ms)
            document.body.style.overflow = 'auto';
        }
    }

    // Alias old function names if they are still somehow in use or for convenience
    window.openEmailModal = () => openModal('emailModal');
    window.closeEmailModal = () => { closeModal('emailModal'); document.getElementById('emailForm').reset(); };
    window.openPasswordModal = () => openModal('passwordModal');
    window.closePasswordModal = () => { closeModal('passwordModal'); document.getElementById('passwordForm').reset(); };
    window.openDeleteModal = () => openModal('deleteModal');
    window.closeDeleteModal = () => { closeModal('deleteModal'); document.getElementById('deleteForm').reset(); };


    document.getElementById('profileForm').addEventListener('submit', function(e) {
        @if($peserta->status_pendaftaran !== 'approved')
        const categories = document.querySelectorAll('#profileForm input[type="checkbox"][name^="kumite_"], #profileForm input[type="checkbox"][name^="kata_"]');
        let oneChecked = false; categories.forEach(cat => { if(cat.checked) oneChecked = true; });
        if (!oneChecked) { e.preventDefault(); showToast('Pilih minimal satu kategori pertandingan.', 'warning'); return; }
        @endif
        showLoading(this);
    });

    ['emailForm', 'passwordForm', 'deleteForm'].forEach(formId => {
        const form = document.getElementById(formId);
        if(form){
            form.addEventListener('submit', function(e) {
                e.preventDefault(); const currentForm = this; let canSubmit = true;
                if (formId === 'passwordForm') {
                    const password = currentForm.querySelector('input[name="password"]').value;
                    const confirmation = currentForm.querySelector('input[name="password_confirmation"]').value;
                    if (password.length < 8) { showToast('Password baru minimal 8 karakter.', 'error'); canSubmit = false; }
                    else if (password !== confirmation) { showToast('Konfirmasi password baru tidak cocok.', 'error'); canSubmit = false; }
                } else if (formId === 'deleteForm') {
                    const confirmationText = currentForm.querySelector('input[name="confirmation"]').value;
                    if (confirmationText !== 'DELETE') { showToast('Ketik "DELETE" dengan benar untuk konfirmasi.', 'error'); canSubmit = false; }
                }
                if (canSubmit) {
                    if (formId === 'deleteForm') {
                         if (typeof Swal !== 'undefined') {
                            Swal.fire({ title: 'Apakah Anda yakin?', text: 'Tindakan ini tidak dapat dibatalkan! Semua data Anda akan dihapus permanen.', icon: 'warning', showCancelButton: true, confirmButtonColor: '#EF4444', cancelButtonColor: '#6B7280', confirmButtonText: 'Ya, Hapus Akun Saya!', cancelButtonText: 'Batal', customClass: { popup: 'rounded-2xl shadow-xl', confirmButton: 'rounded-lg px-4 py-2', cancelButton: 'rounded-lg px-4 py-2'}
                            }).then((result) => { if (result.isConfirmed) { showLoading(currentForm); currentForm.submit(); } });
                        } else { if(confirm('Apakah Anda Yakin Ingin Menghapus Akun? Tindakan ini tidak dapat dibatalkan.')){ showLoading(currentForm); currentForm.submit(); } }
                    } else { showLoading(currentForm); currentForm.submit(); }
                }
            });
        }
    });

    ['emailModal', 'passwordModal', 'deleteModal'].forEach(modalId => {
        const modal = document.getElementById(modalId);
        if(modal) modal.addEventListener('click', function(e) { if (e.target === this) closeModal(modalId); });
    });
     document.addEventListener('keydown', function(e) { if (e.key === "Escape") { ['emailModal', 'passwordModal', 'deleteModal'].forEach(id => closeModal(id)); } });

    let autoSaveTimeout;
    const formToSave = document.getElementById('profileForm');
    const draftKey = 'profile_draft_{{ $peserta->id }}';
    if (formToSave && "{{ $peserta->status_pendaftaran }}" !== 'approved') {
        const formInputs = formToSave.querySelectorAll('input:not([type="hidden"]), textarea, select');
        formInputs.forEach(input => { /* ... auto-save logic ... */ });
        formToSave.addEventListener('submit', function() { localStorage.removeItem(draftKey); });
    }
    window.restoreDraft = function(key) { /* ... existing logic ... */ };
    window.clearDraftNotification = function(key, showNotif = true) { /* ... existing logic ... */ };
</script>
@endpush
