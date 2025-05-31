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
                        <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">Pengaturan Sistem</h1>
                            <p class="text-purple-100 text-lg">Kelola konfigurasi dan pengaturan sistem pendaftaran INKAI Kediri</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-4">
                    <button onclick="resetForm()"
                           class="bg-white/10 backdrop-blur-sm text-white px-6 py-3 rounded-xl font-semibold hover:bg-white/20 transition-all duration-300 border border-white/20 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span>Reset</span>
                    </button>
                    <button type="submit" form="settingsForm"
                           class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        <span>Simpan Pengaturan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="relative bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 shadow-lg">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-green-900">Berhasil!</h4>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="relative bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-2xl p-6 shadow-lg">
            <div class="flex items-start space-x-3">
                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-red-900 mb-2">Terjadi kesalahan:</h4>
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-red-700 text-sm">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Settings Form -->
    <form id="settingsForm" action="{{ route('admin.master.settings.update') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            @foreach($settings as $category => $categorySettings)
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
                    <!-- Category Header -->
                    <div class="relative p-6 border-b border-gray-100">
                        <div class="absolute inset-0 bg-gradient-to-r
                            @switch($category)
                                @case('Aplikasi')
                                    from-blue-50 to-indigo-50
                                    @break
                                @case('Event/Kejuaraan')
                                    from-emerald-50 to-green-50
                                    @break
                                @case('Pendaftaran')
                                    from-purple-50 to-violet-50
                                    @break
                                @case('Kontak')
                                    from-amber-50 to-orange-50
                                    @break
                                @case('Bank')
                                    from-teal-50 to-cyan-50
                                    @break
                                @case('Email')
                                    from-rose-50 to-pink-50
                                    @break
                                @case('Upload File')
                                    from-slate-50 to-gray-50
                                    @break
                                @default
                                    from-gray-50 to-slate-50
                            @endswitch
                            opacity-50"></div>

                        <div class="relative flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300
                                    @switch($category)
                                        @case('Aplikasi')
                                            bg-gradient-to-br from-blue-500 to-indigo-500
                                            @break
                                        @case('Event/Kejuaraan')
                                            bg-gradient-to-br from-emerald-500 to-green-500
                                            @break
                                        @case('Pendaftaran')
                                            bg-gradient-to-br from-purple-500 to-violet-500
                                            @break
                                        @case('Kontak')
                                            bg-gradient-to-br from-amber-500 to-orange-500
                                            @break
                                        @case('Bank')
                                            bg-gradient-to-br from-teal-500 to-cyan-500
                                            @break
                                        @case('Email')
                                            bg-gradient-to-br from-rose-500 to-pink-500
                                            @break
                                        @case('Upload File')
                                            bg-gradient-to-br from-slate-500 to-gray-500
                                            @break
                                        @default
                                            bg-gradient-to-br from-gray-500 to-slate-500
                                    @endswitch">
                                    @switch($category)
                                        @case('Aplikasi')
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                            @break
                                        @case('Event/Kejuaraan')
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                            </svg>
                                            @break
                                        @case('Pendaftaran')
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                            </svg>
                                            @break
                                        @case('Kontak')
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            @break
                                        @case('Bank')
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M9 7l3-3 3 3M4 10h16v11H4V10z"/>
                                            </svg>
                                            @break
                                        @case('Email')
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            @break
                                        @case('Upload File')
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                            @break
                                        @default
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                    @endswitch
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ $category }}</h3>
                                    <p class="text-sm text-gray-600">{{ $categorySettings->count() }} pengaturan</p>
                                </div>
                            </div>

                            <!-- Progress indicator -->
                            <div class="text-right">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center">
                                    <span class="text-lg font-bold text-gray-700">{{ $categorySettings->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Fields -->
                    <div class="p-6 space-y-6">
                        @foreach($categorySettings as $setting)
                            <div class="group/field">
                                <label for="setting_{{ $setting->key }}" class="block text-sm font-semibold text-gray-900 mb-3">
                                    {{ ucwords(str_replace(['_', '-'], ' ', $setting->key)) }}
                                    @if($setting->description)
                                        <span class="ml-2 inline-flex items-center justify-center w-4 h-4 text-xs bg-gray-100 text-gray-600 rounded-full cursor-help"
                                              title="{{ $setting->description }}">?</span>
                                    @endif
                                </label>

                                @if(in_array($setting->key, ['app_description', 'event_description', 'office_address']))
                                    <textarea
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 resize-none bg-gray-50 focus:bg-white"
                                        id="setting_{{ $setting->key }}"
                                        name="settings[{{ $setting->key }}]"
                                        rows="3"
                                        placeholder="Masukkan {{ strtolower(ucwords(str_replace(['_', '-'], ' ', $setting->key))) }}"
                                    >{{ old('settings.'.$setting->key, $setting->value) }}</textarea>
                                @elseif(str_contains($setting->key, 'email'))
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <input
                                            type="email"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 bg-gray-50 focus:bg-white"
                                            id="setting_{{ $setting->key }}"
                                            name="settings[{{ $setting->key }}]"
                                            value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                            placeholder="example@domain.com"
                                        >
                                    </div>
                                @elseif(str_contains($setting->key, 'phone') || str_contains($setting->key, 'kontak'))
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <input
                                            type="tel"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 bg-gray-50 focus:bg-white"
                                            id="setting_{{ $setting->key }}"
                                            name="settings[{{ $setting->key }}]"
                                            value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                            placeholder="+62 xxx xxxx xxxx"
                                        >
                                    </div>
                                @elseif(str_contains($setting->key, 'url') || str_contains($setting->key, 'website'))
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                            </svg>
                                        </div>
                                        <input
                                            type="url"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 bg-gray-50 focus:bg-white"
                                            id="setting_{{ $setting->key }}"
                                            name="settings[{{ $setting->key }}]"
                                            value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                            placeholder="https://example.com"
                                        >
                                    </div>
                                @elseif(str_contains($setting->key, 'max_') || str_contains($setting->key, '_size'))
                                    <div class="relative">
                                        <input
                                            type="number"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 bg-gray-50 focus:bg-white pr-16"
                                            id="setting_{{ $setting->key }}"
                                            name="settings[{{ $setting->key }}]"
                                            value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                            min="0"
                                            placeholder="0"
                                        >
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 text-sm font-medium">
                                                @if(str_contains($setting->key, 'size'))
                                                    MB
                                                @else
                                                    Items
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @elseif(str_contains($setting->key, 'date'))
                                    <input
                                        type="date"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 bg-gray-50 focus:bg-white"
                                        id="setting_{{ $setting->key }}"
                                        name="settings[{{ $setting->key }}]"
                                        value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                    >
                                @elseif(str_contains($setting->key, 'time'))
                                    <input
                                        type="time"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 bg-gray-50 focus:bg-white"
                                        id="setting_{{ $setting->key }}"
                                        name="settings[{{ $setting->key }}]"
                                        value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                    >
                                @elseif(in_array($setting->key, ['registration_open', 'email_notifications', 'auto_approve']))
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input
                                            type="checkbox"
                                            class="sr-only peer"
                                            id="setting_{{ $setting->key }}"
                                            name="settings[{{ $setting->key }}]"
                                            value="1"
                                            {{ old('settings.'.$setting->key, $setting->value) == '1' ? 'checked' : '' }}
                                        >
                                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-purple-600 peer-checked:to-indigo-600"></div>
                                        <span class="ml-3 text-sm font-medium text-gray-700">
                                            {{ old('settings.'.$setting->key, $setting->value) == '1' ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </label>
                                @else
                                    <input
                                        type="text"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 bg-gray-50 focus:bg-white"
                                        id="setting_{{ $setting->key }}"
                                        name="settings[{{ $setting->key }}]"
                                        value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                        placeholder="Masukkan {{ strtolower(ucwords(str_replace(['_', '-'], ' ', $setting->key))) }}"
                                    >
                                @endif

                                @if($setting->description)
                                    <p class="mt-2 text-sm text-gray-600">{{ $setting->description }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </form>

    <!-- Help Section -->
    <div class="relative bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-purple-50 opacity-50"></div>
        <div class="relative p-8">
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Panduan Pengaturan</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="space-y-3">
                    <h4 class="font-semibold text-blue-600 flex items-center">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                        Aplikasi
                    </h4>
                    <p class="text-sm text-gray-600">Pengaturan dasar aplikasi seperti nama, deskripsi, dan informasi umum sistem.</p>
                </div>

                <div class="space-y-3">
                    <h4 class="font-semibold text-emerald-600 flex items-center">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></div>
                        Event/Kejuaraan
                    </h4>
                    <p class="text-sm text-gray-600">Detail informasi tentang event yang sedang berlangsung dan konfigurasi kejuaraan.</p>
                </div>

                <div class="space-y-3">
                    <h4 class="font-semibold text-purple-600 flex items-center">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                        Pendaftaran
                    </h4>
                    <p class="text-sm text-gray-600">Pengaturan proses pendaftaran peserta, batas waktu, dan validasi data.</p>
                </div>

                <div class="space-y-3">
                    <h4 class="font-semibold text-amber-600 flex items-center">
                        <div class="w-2 h-2 bg-amber-500 rounded-full mr-2"></div>
                        Kontak & Bank
                    </h4>
                    <p class="text-sm text-gray-600">Informasi kontak penyelenggara dan detail rekening untuk pembayaran.</p>
                </div>
            </div>

            <div class="mt-8 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mt-1">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="font-semibold text-blue-900 mb-2">Tips Penggunaan:</h5>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• Pastikan semua field yang wajib terisi sebelum menyimpan</li>
                            <li>• Pengaturan akan tersimpan otomatis sebagai draft setiap 5 detik</li>
                            <li>• Gunakan tombol Reset untuk mengembalikan ke nilai awal</li>
                            <li>• Perubahan pengaturan akan berlaku segera setelah disimpan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl p-8 shadow-2xl flex items-center space-x-4">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
        <span class="text-gray-700 font-semibold">Menyimpan pengaturan...</span>
    </div>
    </div>
    @endsection

    @push('styles')
    <style>
    /* Enhanced animations */
    .animate-fade-in {
    animation: fadeIn 0.8s ease-out forwards;
    }

    @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
    }

    .animate-slide-up {
    animation: slideUp 0.6s ease-out forwards;
    }

    @keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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

    /* Enhanced hover effects */
    .group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
    }

    /* Form field focus effects */
    input:focus, textarea:focus {
    transform: translateY(-1px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    /* Toggle switch animation */
    input[type="checkbox"]:checked + div {
    background: linear-gradient(to right, #9333ea, #4f46e5);
    }

    /* Card hover effects */
    .group {
    transition: all 0.3s ease;
    }

    .group:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Field group hover effects */
    .group\/field:hover input,
    .group\/field:hover textarea {
    border-color: #a855f7;
    background-color: #faf5ff;
    }

    /* Loading animation */
    .loading-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
    }

    /* Button press effect */
    button:active {
    transform: translateY(1px);
    }

    /* Tooltip hover effect */
    [title]:hover {
    cursor: help;
    }

    /* Smooth transitions for all interactive elements */
    * {
    transition: all 0.2s ease;
    }

    /* Focus ring enhancement */
    .focus\:ring-purple-500:focus {
    ring-color: rgba(168, 85, 247, 0.5);
    }

    /* Backdrop blur effect */
    .backdrop-blur-sm {
    backdrop-filter: blur(4px);
    }
    </style>
    @endpush

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    // Initialize form functionality
    initializeForm();

    // Initialize animations
    initializeAnimations();

    // Initialize auto-save
    initializeAutoSave();

    // Initialize tooltips
    initializeTooltips();
    });

    function initializeForm() {
    const form = document.getElementById('settingsForm');
    let hasChanges = false;

    // Track changes
    form.addEventListener('input', function() {
        hasChanges = true;
        updateFormState();
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        showLoading();
        hasChanges = false;
    });

    // Warn before leaving if there are unsaved changes
    window.addEventListener('beforeunload', function(e) {
        if (hasChanges) {
            e.preventDefault();
            e.returnValue = 'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman?';
        }
    });

    // Reset form function
    window.resetForm = function() {
        if (confirm('Apakah Anda yakin ingin mereset semua perubahan? Semua data yang belum disimpan akan hilang.')) {
            form.reset();
            hasChanges = false;
            updateFormState();
            showToast('Form berhasil direset', 'info');
        }
    };
    }

    function initializeAnimations() {
    // Stagger animation for cards
    const cards = document.querySelectorAll('.group');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate-fade-in');
    });

    // Add hover effects to form fields
    const formFields = document.querySelectorAll('input, textarea');
    formFields.forEach(field => {
        field.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-purple-500', 'ring-opacity-50');
        });

        field.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-purple-500', 'ring-opacity-50');
        });
    });

    // Toggle switch label updates
    const toggles = document.querySelectorAll('input[type="checkbox"]');
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const label = this.parentElement.querySelector('span');
            if (label) {
                label.textContent = this.checked ? 'Aktif' : 'Nonaktif';

                // Add animation
                label.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    label.style.transform = 'scale(1)';
                }, 150);
            }
        });
    });
    }

    function initializeAutoSave() {
    let autoSaveTimer;
    const form = document.getElementById('settingsForm');

    form.addEventListener('input', function() {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(function() {
            saveDraft();
        }, 5000); // Auto-save after 5 seconds of inactivity
    });

    function saveDraft() {
        const formData = new FormData(form);
        const draftData = {};

        for (let [key, value] of formData.entries()) {
            draftData[key] = value;
        }

        localStorage.setItem('settingsDraft', JSON.stringify(draftData));
        showToast('Draft tersimpan otomatis', 'success', 2000);
    }

    // Load draft on page load
    const savedDraft = localStorage.getItem('settingsDraft');
    if (savedDraft) {
        try {
            const draftData = JSON.parse(savedDraft);

            if (confirm('Ditemukan draft yang belum disimpan. Apakah Anda ingin memulihkannya?')) {
                Object.keys(draftData).forEach(key => {
                    const element = document.querySelector(`[name="${key}"]`);
                    if (element) {
                        if (element.type === 'checkbox') {
                            element.checked = draftData[key] === '1';
                            // Update toggle label
                            const label = element.parentElement.querySelector('span');
                            if (label) {
                                label.textContent = element.checked ? 'Aktif' : 'Nonaktif';
                            }
                        } else {
                            element.value = draftData[key];
                        }
                    }
                });
                showToast('Draft berhasil dipulihkan', 'success');
            } else {
                localStorage.removeItem('settingsDraft');
            }
        } catch (error) {
            console.error('Error loading draft:', error);
            localStorage.removeItem('settingsDraft');
        }
    }
    }

    function initializeTooltips() {
    // Simple tooltip implementation
    const tooltipElements = document.querySelectorAll('[title]');

    tooltipElements.forEach(element => {
        let tooltip;

        element.addEventListener('mouseenter', function(e) {
            const text = this.getAttribute('title');
            this.removeAttribute('title'); // Prevent default tooltip

            tooltip = document.createElement('div');
            tooltip.className = 'absolute z-50 px-3 py-2 text-sm text-white bg-gray-900 rounded-lg shadow-lg pointer-events-none whitespace-nowrap';
            tooltip.textContent = text;

            document.body.appendChild(tooltip);

            const rect = this.getBoundingClientRect();
            tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
            tooltip.style.top = rect.top - tooltip.offsetHeight - 8 + 'px';

            // Store original title for restoration
            this.dataset.originalTitle = text;
        });

        element.addEventListener('mouseleave', function() {
            if (tooltip) {
                tooltip.remove();
                tooltip = null;
            }
            // Restore title
            this.setAttribute('title', this.dataset.originalTitle);
        });
    });
    }

    function updateFormState() {
    // Visual feedback for form state changes
    const submitButton = document.querySelector('button[type="submit"]');
    if (submitButton) {
        submitButton.classList.add('animate-pulse');
        setTimeout(() => {
            submitButton.classList.remove('animate-pulse');
        }, 1000);
    }
    }

    function showLoading() {
    document.getElementById('loadingOverlay').classList.remove('hidden');
    }

    function hideLoading() {
    document.getElementById('loadingOverlay').classList.add('hidden');
    }

    function showToast(message, type = 'info', duration = 5000) {
    const toastContainer = document.getElementById('toast-container') || createToastContainer();

    const toast = document.createElement('div');
    toast.className = `toast-item transform translate-x-full transition-transform duration-300`;

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
        info: 'bg-blue-50 text-blue-800 border-blue-200'
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
    }, duration);
    }

    function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'fixed top-4 right-4 z-50 space-y-2';
    document.body.appendChild(container);
    return container;
    }

    // Utility functions
    window.settingsUtils = {
    exportSettings: function() {
        const formData = new FormData(document.getElementById('settingsForm'));
        const settings = {};

        for (let [key, value] of formData.entries()) {
            settings[key] = value;
        }

        const blob = new Blob([JSON.stringify(settings, null, 2)], { type: 'application/json' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'settings-backup.json';
        a.click();
        URL.revokeObjectURL(url);

        showToast('Pengaturan berhasil diekspor', 'success');
    },

    searchSettings: function(query) {
        const cards = document.querySelectorAll('.group');
        const searchTerm = query.toLowerCase();

        cards.forEach(card => {
            const labels = card.querySelectorAll('label');
            let hasMatch = false;

            labels.forEach(label => {
                if (label.textContent.toLowerCase().includes(searchTerm)) {
                    hasMatch = true;
                }
            });

            if (hasMatch || searchTerm === '') {
                card.style.display = '';
                card.classList.add('animate-fade-in');
            } else {
                card.style.display = 'none';
            }
        });
    }
};

console.log('Settings Modern UI v2.0.0 loaded successfully! ⚙️✨');
</script>
@endpush
