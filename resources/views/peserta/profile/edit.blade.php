@extends('layouts.peserta')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
                @if($peserta->foto_path)
                    <img src="{{ Storage::url($peserta->foto_path) }}"
                         alt="Foto {{ $peserta->nama_lengkap }}"
                         class="w-20 h-20 rounded-full object-cover border-4 border-white/30">
                @else
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-bold mb-1">Edit Profil</h1>
                <p class="text-blue-100">{{ $peserta->nama_lengkap }} • {{ $peserta->kode_pendaftaran }}</p>
                <div class="flex items-center space-x-4 mt-2 text-sm">
                    <span class="badge-white">{{ $peserta->ranting->nama_ranting }}</span>
                    <span class="badge-white">{{ $peserta->kategoriUsia->nama_kategori }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Alert -->
    @if($peserta->status_pendaftaran === 'approved')
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800">Pendaftaran Sudah Disetujui</h3>
                <p class="mt-1 text-sm text-yellow-700">Beberapa data tidak dapat diubah karena pendaftaran sudah disetujui. Hanya data kontak dan berat badan yang masih bisa diupdate.</p>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information Form -->
            <div class="peserta-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Pribadi</h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('peserta.profile.update') }}" id="profileForm">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap -->
                            <div class="md:col-span-2">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text"
                                       name="nama_lengkap"
                                       value="{{ old('nama_lengkap', $peserta->nama_lengkap) }}"
                                       class="form-input @error('nama_lengkap') border-red-300 @enderror"
                                       {{ $peserta->status_pendaftaran === 'approved' ? 'readonly' : '' }}>
                                @error('nama_lengkap')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tempat Lahir -->
                            <div>
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text"
                                       name="tempat_lahir"
                                       value="{{ old('tempat_lahir', $peserta->tempat_lahir) }}"
                                       class="form-input @error('tempat_lahir') border-red-300 @enderror"
                                       {{ $peserta->status_pendaftaran === 'approved' ? 'readonly' : '' }}>
                                @error('tempat_lahir')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date"
                                       name="tanggal_lahir"
                                       value="{{ old('tanggal_lahir', $peserta->tanggal_lahir->format('Y-m-d')) }}"
                                       class="form-input @error('tanggal_lahir') border-red-300 @enderror"
                                       {{ $peserta->status_pendaftaran === 'approved' ? 'readonly' : '' }}>
                                @error('tanggal_lahir')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin"
                                        class="form-select @error('jenis_kelamin') border-red-300 @enderror"
                                        {{ $peserta->status_pendaftaran === 'approved' ? 'disabled' : '' }}>
                                    <option value="L" {{ old('jenis_kelamin', $peserta->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $peserta->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Golongan Darah -->
                            <div>
                                <label class="form-label">Golongan Darah</label>
                                <select name="golongan_darah"
                                        class="form-select @error('golongan_darah') border-red-300 @enderror"
                                        {{ $peserta->status_pendaftaran === 'approved' ? 'disabled' : '' }}>
                                    <option value="A" {{ old('golongan_darah', $peserta->golongan_darah) === 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('golongan_darah', $peserta->golongan_darah) === 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('golongan_darah', $peserta->golongan_darah) === 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('golongan_darah', $peserta->golongan_darah) === 'O' ? 'selected' : '' }}>O</option>
                                </select>
                                @error('golongan_darah')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- No Telepon -->
                            <div>
                                <label class="form-label">No. Telepon</label>
                                <input type="text"
                                       name="no_telepon"
                                       value="{{ old('no_telepon', $peserta->no_telepon) }}"
                                       class="form-input @error('no_telepon') border-red-300 @enderror"
                                       placeholder="08xxxxxxxxxx">
                                @error('no_telepon')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Berat Badan -->
                            <div>
                                <label class="form-label">Berat Badan (KG)</label>
                                <input type="number"
                                       name="berat_badan"
                                       value="{{ old('berat_badan', $peserta->berat_badan) }}"
                                       class="form-input @error('berat_badan') border-red-300 @enderror"
                                       min="20" max="200" step="0.1">
                                @error('berat_badan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="md:col-span-2">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat"
                                          rows="3"
                                          class="form-input @error('alamat') border-red-300 @enderror"
                                          placeholder="Masukkan alamat lengkap...">{{ old('alamat', $peserta->alamat) }}</textarea>
                                @error('alamat')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        @if($peserta->status_pendaftaran !== 'approved')
                        <!-- Organization Info (only if not approved) -->
                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <h4 class="text-md font-semibold text-gray-900 mb-4">Informasi Organisasi</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Ranting -->
                                <div>
                                    <label class="form-label">Ranting/Afiliasi</label>
                                    <select name="ranting_id" class="form-select @error('ranting_id') border-red-300 @enderror">
                                        <option value="">Pilih Ranting</option>
                                        @foreach($rantings as $ranting)
                                            <option value="{{ $ranting->id }}"
                                                    {{ old('ranting_id', $peserta->ranting_id) == $ranting->id ? 'selected' : '' }}>
                                                {{ $ranting->nama_ranting }} - {{ $ranting->kota }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ranting_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Kategori Usia -->
                                <div>
                                    <label class="form-label">Kategori Usia</label>
                                    <select name="kategori_usia_id" class="form-select @error('kategori_usia_id') border-red-300 @enderror">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                    {{ old('kategori_usia_id', $peserta->kategori_usia_id) == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }} ({{ $kategori->rentang_usia }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_usia_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Competition Categories -->
                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <h4 class="text-md font-semibold text-gray-900 mb-4">Kategori Pertandingan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox"
                                           name="kumite_perorangan"
                                           value="1"
                                           {{ old('kumite_perorangan', $peserta->kumite_perorangan) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900">Kumite Perorangan</div>
                                        <div class="text-sm text-gray-500">Pertandingan satu lawan satu</div>
                                    </div>
                                </label>

                                <label class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox"
                                           name="kata_perorangan"
                                           value="1"
                                           {{ old('kata_perorangan', $peserta->kata_perorangan) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900">Kata Perorangan</div>
                                        <div class="text-sm text-gray-500">Penampilan jurus individu</div>
                                    </div>
                                </label>

                                <label class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox"
                                           name="kata_beregu"
                                           value="1"
                                           {{ old('kata_beregu', $peserta->kata_beregu) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900">Kata Beregu</div>
                                        <div class="text-sm text-gray-500">Penampilan jurus tim</div>
                                    </div>
                                </label>

                                <label class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox"
                                           name="kumite_beregu"
                                           value="1"
                                           {{ old('kumite_beregu', $peserta->kumite_beregu) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900">Kumite Beregu</div>
                                        <div class="text-sm text-gray-500">Pertandingan tim</div>
                                    </div>
                                </label>
                            </div>
                            @error('kategori')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('peserta.dashboard') }}" class="peserta-btn-secondary">
                                    Batal
                                </a>
                                <button type="submit" class="peserta-btn-primary">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Photo Upload -->
            <div class="peserta-card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Foto Profil</h3>
                <div class="text-center">
                    <div class="mx-auto mb-4" id="photo-preview">
                        @if($peserta->foto_path)
                            <img src="{{ Storage::url($peserta->foto_path) }}"
                                 alt="Foto {{ $peserta->nama_lengkap }}"
                                 class="w-32 h-40 object-cover rounded-lg border-2 border-gray-200 mx-auto">
                        @else
                            <div class="w-32 h-40 bg-gray-200 rounded-lg border-2 border-gray-300 flex items-center justify-center mx-auto">
                                <div class="text-center">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span class="text-sm text-gray-500">No Photo</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <form id="photoForm" enctype="multipart/form-data">
                        @csrf
                        <input type="file"
                               id="foto"
                               name="foto"
                               accept="image/jpeg,image/png,image/jpg"
                               class="hidden"
                               onchange="uploadPhoto()">
                        <button type="button"
                                onclick="document.getElementById('foto').click()"
                                class="peserta-btn-secondary w-full mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            Upload Foto
                        </button>
                    </form>
                    <p class="text-xs text-gray-500">Format: JPG, PNG. Max: 2MB</p>
                </div>
            </div>

            <!-- Account Settings -->
            <div class="peserta-card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Pengaturan Akun</h3>
                </div>
                <div class="p-6 space-y-4">
                    <button onclick="openEmailModal()"
                            class="w-full text-left p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-medium text-gray-900">Email</div>
                                <div class="text-sm text-gray-500">{{ auth()->user()->email }}</div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </button>

                    <button onclick="openPasswordModal()"
                            class="w-full text-left p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-medium text-gray-900">Password</div>
                                <div class="text-sm text-gray-500">Ubah password akun</div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Data Export -->
            <div class="peserta-card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pribadi</h3>
                <div class="space-y-3">
                    <a href="{{ route('peserta.profile.download-data') }}"
                       class="peserta-btn-secondary w-full text-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Data Saya
                    </a>

                    <button onclick="openDeleteModal()"
                            class="w-full peserta-btn-danger">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Akun
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Email Modal -->
<div id="emailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Ubah Email</h3>
            <form id="emailForm" method="POST" action="{{ route('peserta.profile.update-email') }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label">Ketik "DELETE" untuk konfirmasi</label>
                    <input type="text" name="confirmation" class="form-input" placeholder="DELETE" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Password saat ini" required>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeDeleteModal()" class="peserta-btn-secondary">
                        Batal
                    </button>
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors duration-200">
                        Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Photo upload
    function uploadPhoto() {
        const formData = new FormData();
        const fileInput = document.getElementById('foto');
        formData.append('foto', fileInput.files[0]);
        formData.append('_token', '{{ csrf_token() }}');

        showLoading();

        fetch('{{ route("peserta.profile.upload-foto") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                // Update photo preview
                const preview = document.getElementById('photo-preview');
                preview.innerHTML = `
                    <img src="${data.foto_url}"
                         alt="Foto {{ $peserta->nama_lengkap }}"
                         class="w-32 h-40 object-cover rounded-lg border-2 border-gray-200 mx-auto">
                `;
                showToast(data.message, 'success');
            } else {
                showToast(data.message, 'error');
            }
        })
        .catch(error => {
            hideLoading();
            showToast('Gagal mengupload foto', 'error');
        });
    }

    // Modal functions
    function openEmailModal() {
        document.getElementById('emailModal').classList.remove('hidden');
    }

    function closeEmailModal() {
        document.getElementById('emailModal').classList.add('hidden');
        document.getElementById('emailForm').reset();
    }

    function openPasswordModal() {
        document.getElementById('passwordModal').classList.remove('hidden');
    }

    function closePasswordModal() {
        document.getElementById('passwordModal').classList.add('hidden');
        document.getElementById('passwordForm').reset();
    }

    function openDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteForm').reset();
    }

    // Form submissions
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        // Validate categories if not approved
        @if($peserta->status_pendaftaran !== 'approved')
        const categories = document.querySelectorAll('input[type="checkbox"]:checked');
        if (categories.length === 0) {
            e.preventDefault();
            showToast('Pilih minimal satu kategori pertandingan', 'warning');
            return;
        }
        @endif

        showLoading();
    });

    document.getElementById('emailForm').addEventListener('submit', function(e) {
        e.preventDefault();
        showLoading();
        this.submit();
    });

    document.getElementById('passwordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const password = this.querySelector('input[name="password"]').value;
        const confirmation = this.querySelector('input[name="password_confirmation"]').value;

        if (password !== confirmation) {
            showToast('Konfirmasi password tidak cocok', 'error');
            return;
        }

        showLoading();
        this.submit();
    });

    document.getElementById('deleteForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const confirmation = this.querySelector('input[name="confirmation"]').value;

        if (confirmation !== 'DELETE') {
            showToast('Ketik "DELETE" dengan benar untuk konfirmasi', 'error');
            return;
        }

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Tindakan ini tidak dapat dibatalkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, hapus akun!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();
                this.submit();
            }
        });
    });

    // Close modals when clicking outside
    document.getElementById('emailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEmailModal();
        }
    });

    document.getElementById('passwordModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePasswordModal();
        }
    });

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // Show/hide loading
    function showLoading() {
        // Add loading spinner or disable buttons
        const buttons = document.querySelectorAll('button[type="submit"]');
        buttons.forEach(btn => {
            btn.disabled = true;
            btn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Loading...';
        });
    }

    function hideLoading() {
        // Remove loading spinner and enable buttons
        const buttons = document.querySelectorAll('button[type="submit"]');
        buttons.forEach(btn => {
            btn.disabled = false;
            // Restore original button text based on context
        });
    }

    // Toast notification function
    function showToast(message, type = 'info') {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;

        // Set colors based on type
        const colors = {
            success: 'bg-green-500 text-white',
            error: 'bg-red-500 text-white',
            warning: 'bg-yellow-500 text-white',
            info: 'bg-blue-500 text-white'
        };

        toast.className += ` ${colors[type] || colors.info}`;
        toast.innerHTML = `
            <div class="flex items-center space-x-2">
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;

        document.body.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        // Auto remove after 5 seconds
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.remove();
                }
            }, 300);
        }, 5000);
    }

    // Auto-save draft functionality (optional)
    let autoSaveTimeout;
    const formInputs = document.querySelectorAll('#profileForm input, #profileForm textarea, #profileForm select');

    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(() => {
                // Save draft to localStorage
                const draftData = {};
                formInputs.forEach(inp => {
                    if (inp.type === 'checkbox') {
                        draftData[inp.name] = inp.checked;
                    } else {
                        draftData[inp.name] = inp.value;
                    }
                });
                localStorage.setItem('profile_draft', JSON.stringify(draftData));
            }, 1000);
        });
    });

    // Load draft on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedDraft = localStorage.getItem('profile_draft');
        if (savedDraft) {
            try {
                const draftData = JSON.parse(savedDraft);
                // Show restore draft option
                const restoreDiv = document.createElement('div');
                restoreDiv.className = 'bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6';
                restoreDiv.innerHTML = `
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm text-blue-800">Ada draft perubahan yang belum disimpan</span>
                        </div>
                        <div class="space-x-2">
                            <button onclick="restoreDraft()" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                Pulihkan
                            </button>
                            <button onclick="clearDraft()" class="text-sm text-gray-600 hover:text-gray-800">
                                Abaikan
                            </button>
                        </div>
                    </div>
                `;
                document.querySelector('.peserta-card').insertBefore(restoreDiv, document.querySelector('#profileForm'));
            } catch (e) {
                localStorage.removeItem('profile_draft');
            }
        }
    });

    function restoreDraft() {
        const savedDraft = localStorage.getItem('profile_draft');
        if (savedDraft) {
            const draftData = JSON.parse(savedDraft);
            Object.keys(draftData).forEach(key => {
                const input = document.querySelector(`[name="${key}"]`);
                if (input) {
                    if (input.type === 'checkbox') {
                        input.checked = draftData[key];
                    } else {
                        input.value = draftData[key];
                    }
                }
            });
            clearDraft();
        }
    }

    function clearDraft() {
        localStorage.removeItem('profile_draft');
        const restoreDiv = document.querySelector('.bg-blue-50');
        if (restoreDiv) {
            restoreDiv.remove();
        }
    }

    // Clear draft when form is successfully submitted
    document.getElementById('profileForm').addEventListener('submit', function() {
        localStorage.removeItem('profile_draft');
    });
</script>
@endpush

<style>
/* Additional CSS for peserta theme */
.peserta-card {
    @apply bg-white rounded-xl shadow-sm border border-gray-200;
}

.peserta-btn-primary {
    @apply inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200;
}

.peserta-btn-secondary {
    @apply inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200;
}

.peserta-btn-danger {
    @apply inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200;
}

.badge-white {
    @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-white;
}

.form-label {
    @apply block text-sm font-medium text-gray-700 mb-1;
}

.form-input {
    @apply block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200;
}

.form-select {
    @apply block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200;
}

/* Loading animation */
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .grid-cols-1.md\\:grid-cols-2 {
        grid-template-columns: 1fr;
    }

    .lg\\:col-span-2 {
        grid-column: span 1;
    }
}
</style>
