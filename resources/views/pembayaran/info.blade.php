@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Informasi Pembayaran</h1>
            <p class="text-lg text-gray-600">Panduan lengkap cara pembayaran pendaftaran kejuaraan</p>
        </div>

        <!-- Payment Methods -->
        <div class="space-y-8">
            <!-- Bank Transfer -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Transfer Bank</h2>
                            <p class="text-blue-100">Pembayaran melalui ATM, Internet Banking, atau Mobile Banking</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($bankAccounts as $bank)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors duration-200">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-12 h-8 bg-gray-100 rounded flex items-center justify-center mr-3">
                                        <span class="text-sm font-bold text-gray-700">{{ $bank['bank'] }}</span>
                                    </div>
                                    <span class="font-semibold text-gray-900">Bank {{ $bank['bank'] }}</span>
                                </div>
                                <button onclick="copyToClipboard('{{ $bank['account'] }}')"
                                        class="text-blue-600 hover:text-blue-800 p-1 rounded">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <label class="text-sm text-gray-500">Nomor Rekening</label>
                                    <p class="font-mono text-lg font-bold text-gray-900">{{ $bank['account'] }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-500">Atas Nama</label>
                                    <p class="font-semibold text-gray-900">{{ $bank['holder'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h3 class="font-semibold text-blue-900 mb-2">Cara Transfer Bank:</h3>
                        <ol class="space-y-2 text-sm text-blue-800">
                            <li class="flex items-start">
                                <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">1</span>
                                <span>Login ke Internet Banking atau Mobile Banking Anda</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">2</span>
                                <span>Pilih menu Transfer ke Bank Lain</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">3</span>
                                <span>Masukkan nomor rekening tujuan sesuai pilihan bank</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">4</span>
                                <span>Masukkan jumlah yang harus dibayar sesuai invoice</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">5</span>
                                <span>Pastikan nama penerima sudah benar, lalu konfirmasi transfer</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">6</span>
                                <span>Simpan bukti transfer dan upload melalui dashboard peserta</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- QRIS Payment -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h4m4 0V4M8 12V8M8 8V4m0 4h4m4 0h2m-6 4v2m0-6V4m6 8h2m-6 4h2M8 20v-4m4 0v4m0-4h2m-6 0h2"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">QRIS Payment</h2>
                            <p class="text-purple-100">Pembayaran praktis dengan scan QR Code</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                        <div class="flex-shrink-0">
                            <div class="bg-white border-2 border-gray-200 rounded-lg p-4 shadow-sm">
                                <img src="{{ $qrisImage }}"
                                     alt="QRIS Code INKAI Kediri"
                                     class="w-48 h-48 object-contain">
                            </div>
                            <p class="text-center text-sm text-gray-600 mt-2">Scan QR Code di atas</p>
                        </div>
                        <div class="flex-1">
                            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 mb-4">
                                <h3 class="font-semibold text-purple-900 mb-2">Cara Pembayaran QRIS:</h3>
                                <ol class="space-y-2 text-sm text-purple-800">
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">1</span>
                                        <span>Buka aplikasi e-wallet Anda (OVO, GoPay, DANA, ShopeePay, dll)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">2</span>
                                        <span>Pilih menu Scan QR atau Bayar dengan QR</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">3</span>
                                        <span>Arahkan kamera ke QR Code di atas</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">4</span>
                                        <span>Masukkan jumlah yang harus dibayar sesuai invoice</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">5</span>
                                        <span>Konfirmasi pembayaran dengan PIN atau biometrik</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">6</span>
                                        <span>Screenshot bukti pembayaran dan upload ke dashboard</span>
                                    </li>
                                </ol>
                            </div>
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-800">
                                            <strong>Penting:</strong> Masukkan jumlah pembayaran dengan benar sesuai invoice Anda untuk menghindari kesalahan verifikasi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cash Payment -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Pembayaran Tunai</h2>
                            <p class="text-green-100">Bayar langsung di kantor sekretariat</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <h3 class="font-semibold text-green-900 mb-3">Informasi Kantor:</h3>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-green-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-green-900">Alamat</p>
                                            <p class="text-sm text-green-700">{{ $officeInfo['address'] }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-green-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-green-900">Telepon</p>
                                            <p class="text-sm text-green-700">{{ $officeInfo['phone'] }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-green-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-green-900">Jam Operasional</p>
                                            <p class="text-sm text-green-700">{{ $officeInfo['hours'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <h3 class="font-semibold text-green-900 mb-2">Cara Pembayaran Tunai:</h3>
                                <ol class="space-y-2 text-sm text-green-800">
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">1</span>
                                        <span>Datang ke kantor sekretariat pada jam operasional</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">2</span>
                                        <span>Bawa kode pendaftaran atau invoice pembayaran</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">3</span>
                                        <span>Serahkan uang tunai sesuai jumlah yang tertera</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">4</span>
                                        <span>Terima kwitansi resmi sebagai bukti pembayaran</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">5</span>
                                        <span>Status pembayaran akan diupdate secara otomatis</span>
                                    </li>
                                </ol>
                            </div>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-800">
                                            <strong>Tips:</strong> Hubungi kantor terlebih dahulu untuk memastikan ketersediaan petugas.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Status Checker -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mt-8">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 px-6 py-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Cek Status Pembayaran</h2>
                        <p class="text-indigo-100">Periksa status pembayaran dengan kode pendaftaran</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="max-w-md mx-auto">
                    <form id="statusForm" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Kode Pendaftaran atau Kode Pembayaran
                            </label>
                            <input type="text"
                                   id="kodeInput"
                                   name="kode"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200"
                                   placeholder="Contoh: KRT202501001 atau PAY202501001"
                                   required>
                        </div>
                        <button type="submit"
                                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 font-medium">
                            <span id="btnText">Cek Status</span>
                            <svg id="loadingIcon" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white hidden inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </form>

                    <!-- Status Result -->
                    <div id="statusResult" class="mt-6 hidden">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="font-semibold text-gray-900">Status Pembayaran</h3>
                                <span id="statusBadge" class="px-2 py-1 text-xs font-medium rounded-full"></span>
                            </div>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Nama Peserta:</span>
                                    <span id="namaPeserta" class="font-medium text-gray-900"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Kode Pendaftaran:</span>
                                    <span id="kodePendaftaran" class="font-mono text-gray-900"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Jumlah Bayar:</span>
                                    <span id="jumlahBayar" class="font-semibold text-gray-900"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Metode Pembayaran:</span>
                                    <span id="metodePembayaran" class="text-gray-900"></span>
                                </div>
                                <div class="flex justify-between" id="tanggalBayarRow">
                                    <span class="text-gray-600">Tanggal Bayar:</span>
                                    <span id="tanggalBayar" class="text-gray-900"></span>
                                </div>
                                <div class="flex justify-between" id="verifiedRow">
                                    <span class="text-gray-600">Diverifikasi:</span>
                                    <span id="verifiedAt" class="text-gray-900"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Important Notes -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mt-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Catatan Penting</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Perhatian!</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            <li>Pastikan jumlah pembayaran sesuai dengan invoice yang diterima</li>
                                            <li>Simpan bukti pembayaran dengan baik untuk keperluan verifikasi</li>
                                            <li>Upload bukti pembayaran maksimal 3 hari setelah transfer</li>
                                            <li>Pembayaran yang tidak sesuai nominal akan ditolak</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Waktu Verifikasi</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            <li>Transfer Bank: 1-2 hari kerja</li>
                                            <li>QRIS: 1-2 hari kerja</li>
                                            <li>Pembayaran Tunai: Langsung</li>
                                            <li>Verifikasi dilakukan pada jam kerja</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Tips Pembayaran</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            <li>Screenshot atau foto bukti transfer dengan jelas</li>
                                            <li>Pastikan nomor rekening tujuan benar sebelum transfer</li>
                                            <li>Untuk QRIS, pastikan nominal yang dimasukkan tepat</li>
                                            <li>Jika ada kendala, hubungi admin segera</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-green-800">Setelah Pembayaran</h3>
                                    <div class="mt-2 text-sm text-green-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            <li>Login ke dashboard peserta untuk upload bukti</li>
                                            <li>Tunggu konfirmasi verifikasi via email/SMS</li>
                                            <li>Download sertifikat jika pembayaran sudah diverifikasi</li>
                                            <li>Simpan invoice untuk dokumentasi</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Support -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-lg text-white mt-8">
            <div class="p-6">
                <div class="text-center">
                    <h2 class="text-2xl font-bold mb-2">Butuh Bantuan?</h2>
                    <p class="text-gray-300 mb-6">Tim support kami siap membantu Anda 24/7</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="tel:{{ $officeInfo['phone'] }}"
                           class="flex items-center justify-center px-4 py-3 bg-white/10 rounded-lg hover:bg-white/20 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>Hubungi Kami</span>
                        </a>
                        <a href="https://wa.me/62{{ ltrim($officeInfo['phone'], '0') }}"
                           target="_blank"
                           class="flex items-center justify-center px-4 py-3 bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                            <span>WhatsApp</span>
                        </a>
                        <a href="{{ route('login') }}"
                           class="flex items-center justify-center px-4 py-3 bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Login Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Copy to clipboard function
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            showToast('Nomor rekening berhasil disalin!', 'success');
        }, function(err) {
            // Fallback for older browsers
            const textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
                showToast('Nomor rekening berhasil disalin!', 'success');
            } catch (err) {
                showToast('Gagal menyalin nomor rekening', 'error');
            }
            document.body.removeChild(textArea);
        });
    }

    // Payment status checker
    document.getElementById('statusForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const kode = document.getElementById('kodeInput').value.trim();
        const btnText = document.getElementById('btnText');
        const loadingIcon = document.getElementById('loadingIcon');
        const statusResult = document.getElementById('statusResult');

        if (!kode) {
            showToast('Masukkan kode pendaftaran atau pembayaran', 'warning');
            return;
        }

        // Show loading
        btnText.textContent = 'Mencari...';
        loadingIcon.classList.remove('hidden');
        statusResult.classList.add('hidden');

        // Make request to check status
        fetch('{{ route("pembayaran.check-status") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ kode: kode })
        })
        .then(response => response.json())
        .then(data => {
            // Hide loading
            btnText.textContent = 'Cek Status';
            loadingIcon.classList.add('hidden');

            if (data.success) {
                // Show result
                displayStatusResult(data.data);
                statusResult.classList.remove('hidden');
            } else {
                showToast(data.message, 'error');
            }
        })
        .catch(error => {
            btnText.textContent = 'Cek Status';
            loadingIcon.classList.add('hidden');
            showToast('Terjadi kesalahan saat mengecek status', 'error');
        });
    });

    function displayStatusResult(data) {
        document.getElementById('namaPeserta').textContent = data.nama_peserta;
        document.getElementById('kodePendaftaran').textContent = data.kode_pendaftaran;
        document.getElementById('jumlahBayar').textContent = data.jumlah_bayar;
        document.getElementById('metodePembayaran').textContent = data.metode_pembayaran;

        // Status badge
        const statusBadge = document.getElementById('statusBadge');
        const statusColors = {
            'unpaid': 'bg-red-100 text-red-800',
            'pending': 'bg-yellow-100 text-yellow-800',
            'paid': 'bg-green-100 text-green-800',
            'failed': 'bg-red-100 text-red-800'
        };

        statusBadge.className = `px-2 py-1 text-xs font-medium rounded-full ${statusColors[data.status_bayar] || 'bg-gray-100 text-gray-800'}`;
        statusBadge.textContent = data.status_bayar.charAt(0).toUpperCase() + data.status_bayar.slice(1);

        // Optional fields
        const tanggalBayarRow = document.getElementById('tanggalBayarRow');
        const verifiedRow = document.getElementById('verifiedRow');

        if (data.tanggal_bayar) {
            document.getElementById('tanggalBayar').textContent = data.tanggal_bayar;
            tanggalBayarRow.classList.remove('hidden');
        } else {
            tanggalBayarRow.classList.add('hidden');
        }

        if (data.verified_at) {
            document.getElementById('verifiedAt').textContent = data.verified_at + ' oleh ' + (data.verified_by || 'Admin');
            verifiedRow.classList.remove('hidden');
        } else {
            verifiedRow.classList.add('hidden');
        }
    }

    // Toast notification function
    function showToast(message, type = 'info') {
        const toastContainer = document.getElementById('toast-container') || createToastContainer();

        const toast = document.createElement('div');
        toast.className = `transform transition-all duration-300 translate-x-full`;

        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            warning: 'bg-yellow-500',
            info: 'bg-blue-500'
        };

        toast.innerHTML = `
            <div class="${colors[type]} text-white px-6 py-4 rounded-lg shadow-lg flex items-center justify-between min-w-80">
                <span>${message}</span>
                <button onclick="removeToast(this)" class="ml-4 text-white hover:text-gray-200">
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

        // Auto remove after 5 seconds
        setTimeout(() => {
            removeToast(toast.querySelector('button'));
        }, 5000);
    }

    function createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'fixed top-4 right-4 z-50 space-y-2';
        document.body.appendChild(container);
        return container;
    }

    function removeToast(button) {
        const toast = button.closest('.transform');
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }

    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Auto-format input for payment code
    document.getElementById('kodeInput').addEventListener('input', function(e) {
        let value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');

        // Format as KRT202501001 or PAY202501001
        if (value.length > 3) {
            if (value.startsWith('KRT') || value.startsWith('PAY')) {
                e.target.value = value;
            } else {
                e.target.value = value;
            }
        } else {
            e.target.value = value;
        }
    });

    // Add loading states to buttons
    document.querySelectorAll('button[type="submit"]').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('form');
            if (form && form.checkValidity()) {
                this.disabled = true;
                setTimeout(() => {
                    this.disabled = false;
                }, 3000);
            }
        });
    });

    // Initialize tooltips for copy buttons
    document.querySelectorAll('[onclick^="copyToClipboard"]').forEach(button => {
        button.title = 'Klik untuk menyalin';
    });
</script>
@endpush

<style>
/* Additional styles for payment info page */
.bg-gradient-to-r {
    background: linear-gradient(to right, var(--tw-gradient-stops));
}

/* Animation for cards */
.hover\:border-blue-300:hover {
    border-color: #93c5fd;
}

.hover\:border-blue-300:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

/* Responsive improvements */
@media (max-width: 768px) {
    .grid-cols-1.md\\:grid-cols-2 {
        grid-template-columns: 1fr;
    }

    .grid-cols-1.md\\:grid-cols-3 {
        grid-template-columns: 1fr;
    }

    .flex-col.md\\:flex-row {
        flex-direction: column;
    }

    .space-y-6.md\\:space-y-0.md\\:space-x-8 {
        column-gap: 0;
        row-gap: 1.5rem;
    }
}

/* Print styles */
@media print {
    .no-print {
        display: none !important;
    }

    .bg-gradient-to-r {
        background: #1f2937 !important;
        color: white !important;
    }
}

/* Accessibility improvements */
button:focus,
input:focus {
    outline: 2px solid #3B82F6;
    outline-offset: 2px;
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

/* Toast container positioning */
#toast-container {
    pointer-events: none;
}

#toast-container > * {
    pointer-events: auto;
}
</style>
