@extends('layouts.app')

@section('title', isset($laporan) ? 'Edit Laporan' : 'Buat Laporan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                {{ isset($laporan) ? 'Edit Laporan' : 'Buat Laporan Baru' }}
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                {{ isset($laporan) ? 'Perbarui informasi laporan Anda dengan data yang akurat' : 'Laporkan kejadian atau keluhan Anda dengan mengisi form berikut secara lengkap dan akurat' }}
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <form action="{{ isset($laporan) ? route('laporan.update', $laporan->id) : route('laporan.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  id="laporanForm">
                @csrf
                @if(isset($laporan))
                    @method('PUT')
                @endif

                <div class="p-8">
                    <!-- Progress Bar -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between text-sm font-medium text-gray-500 mb-2">
                            <span class="step-label active" data-step="1">Informasi Dasar</span>
                            <span class="step-label" data-step="2">Lokasi</span>
                            <span class="step-label" data-step="3">Bukti & Koordinat</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 h-2 rounded-full transition-all duration-300" 
                                 id="progressBar" style="width: 33.33%"></div>
                        </div>
                    </div>

                    <!-- Step 1: Informasi Dasar -->
                    <div class="form-step active" id="step1">
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Judul -->
                                <div class="group">
                                    <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            Judul Laporan
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <input type="text" 
                                           name="judul" 
                                           id="judul"
                                           value="{{ old('judul', isset($laporan) ? $laporan->judul : '') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 group-hover:border-gray-400"
                                           placeholder="Contoh: Pelanggaran Lalu Lintas di Jalan Sudirman"
                                           required>
                                    @error('judul')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Deskripsi -->
                                <div class="group">
                                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                            </svg>
                                            Deskripsi Kejadian
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <textarea name="deskripsi" 
                                              id="deskripsi" 
                                              rows="5"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 group-hover:border-gray-400 resize-none"
                                              placeholder="Jelaskan secara detail kejadian yang ingin Anda laporkan, termasuk waktu, tempat, dan kronologi kejadian..."
                                              required>{{ old('deskripsi', isset($laporan) ? $laporan->deskripsi : '') }}</textarea>
                                    @error('deskripsi')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Lokasi -->
                    <div class="form-step" id="step2">
                        <div class="space-y-6">
                            <!-- Wilayah -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Provinsi -->
                                <div class="group">
                                    <label for="provinsi" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Provinsi
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <select name="provinsi" 
                                            id="provinsi"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 group-hover:border-gray-400"
                                            required>
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                    @error('provinsi')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Kota -->
                                <div class="group">
                                    <label for="kota" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            Kota/Kabupaten
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <select name="kota" 
                                            id="kota"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 group-hover:border-gray-400"
                                            required disabled>
                                        <option value="">Pilih Kota/Kabupaten</option>
                                    </select>
                                    @error('kota')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Kecamatan -->
                                <div class="group">
                                    <label for="kecamatan" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                                            </svg>
                                            Kecamatan
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <select name="kecamatan" 
                                            id="kecamatan"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 group-hover:border-gray-400"
                                            required disabled>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                    @error('kecamatan')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Kelurahan -->
                                <div class="group">
                                    <label for="kelurahan" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10v11M20 10v11"></path>
                                            </svg>
                                            Kelurahan/Desa
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <select name="kelurahan" 
                                            id="kelurahan"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 group-hover:border-gray-400"
                                            required disabled>
                                        <option value="">Pilih Kelurahan/Desa</option>
                                    </select>
                                    @error('kelurahan')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Alamat Detail -->
                            <div class="group">
                                <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Alamat Detail
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <textarea name="alamat" 
                                          id="alamat" 
                                          rows="3"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 group-hover:border-gray-400 resize-none"
                                          placeholder="Contoh: Jl. Sudirman No. 123, RT 01/RW 02, dekat Bank BCA"
                                          required>{{ old('alamat', isset($laporan) ? $laporan->alamat : '') }}</textarea>
                                @error('alamat')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Bukti & Koordinat -->
                    <div class="form-step" id="step3">
                        <div class="space-y-6">
                            <!-- Upload Gambar -->
                            <div class="group">
                                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Bukti Foto
                                        @if(!isset($laporan))
                                            <span class="text-red-500 ml-1">*</span>
                                        @endif
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="file" 
                                           name="image" 
                                           id="image"
                                           accept="image/jpeg,image/png,image/jpg"
                                           class="hidden"
                                           {{ !isset($laporan) ? 'required' : '' }}>
                                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 transition-colors duration-200 cursor-pointer" 
                                         onclick="document.getElementById('image').click()">
                                        <div id="imagePreview" class="hidden">
                                            <img id="previewImg" class="max-w-full h-48 mx-auto rounded-lg shadow-md mb-4">
                                            <p class="text-sm text-gray-600 mb-2">Klik untuk mengganti gambar</p>
                                        </div>
                                        <div id="uploadPlaceholder">
                                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            <p class="text-lg font-medium text-gray-900 mb-2">Upload Foto Bukti</p>
                                            <p class="text-sm text-gray-500">PNG, JPG, JPEG hingga 5MB</p>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($laporan) && $laporan->url_file)
                                    <div class="mt-3 p-3 bg-blue-50 rounded-lg">
                                        <p class="text-sm text-blue-700 flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                            </svg>
                                            Foto saat ini akan tetap digunakan jika tidak mengunggah foto baru
                                        </p>
                                    </div>
                                @endif
                                @error('image')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Koordinat -->
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                    Koordinat Lokasi
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude <span class="text-red-500">*</span></label>
                                        <input type="text" 
                                               name="latitude" 
                                               id="latitude"
                                               value="{{ old('latitude', isset($laporan) ? $laporan->latitude : '') }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Contoh: -6.2088"
                                               required>
                                        @error('latitude')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude <span class="text-red-500">*</span></label>
                                        <input type="text" 
                                               name="longitude" 
                                               id="longitude"
                                               value="{{ old('longitude', isset($laporan) ? $laporan->longitude : '') }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Contoh: 106.8456"
                                               required>
                                        @error('longitude')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-3">
                                    <button type="button" 
                                            id="getCurrentLocation"
                                            class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Lokasi Saya
                                    </button>
                                    <button type="button" 
                                            id="openMapPicker"
                                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                        </svg>
                                        Pilih di Peta
                                    </button>
                                </div>

                                <!-- Map Container -->
                                <div id="mapContainer" class="mt-4 hidden">
                                    <div id="map" class="w-full h-64 rounded-lg border border-gray-300"></div>
                                    <p class="text-sm text-gray-600 mt-2">Klik pada peta untuk memilih lokasi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between pt-8 border-t border-gray-200">
                        <button type="button" 
                                id="prevBtn" 
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors duration-200 flex items-center"
                                style="display: none;">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Sebelumnya
                        </button>
                        
                        <div class="ml-auto flex space-x-3">
                            <button type="button" 
                                    id="nextBtn" 
                                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 flex items-center">
                                Selanjutnya
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                            
                            <button type="submit" 
                                    id="submitBtn" 
                                    class="px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-200 flex items-center"
                                    style="display: none;">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ isset($laporan) ? 'Update Laporan' : 'Kirim Laporan' }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Map Modal -->
<div id="mapModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Pilih Lokasi di Peta</h3>
                <button type="button" id="closeMapModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            <div id="modalMap" class="w-full h-96 rounded-lg"></div>
            <div class="mt-4 flex justify-end space-x-3">
                <button type="button" id="cancelMapSelection" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button type="button" id="confirmMapSelection" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Gunakan Lokasi Ini
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
console.log('🚀 JavaScript file loaded successfully!');
console.log('📅 Timestamp:', new Date().toISOString());

// Multi-step form functionality
let currentStep = 1;
const totalSteps = 3;

// API Configuration
const NUSAKITA_API = 'https://api.nusakita.yuefii.site/v2';
let map, modalMap, marker, modalMarker;
let selectedLat, selectedLng;
let provinceData = {}; // Store province data with codes
let cityData = {}; // Store city data with codes
let districtData = {}; // Store district data with codes

console.log('⚙️ Variables initialized');
console.log('🌐 API Base URL:', NUSAKITA_API);

// Initialize when document is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('📄 DOM Content Loaded - Starting initialization...');
    
    // Check if required elements exist
    const requiredElements = ['provinsi', 'nextBtn', 'prevBtn', 'submitBtn'];
    const missingElements = [];
    
    requiredElements.forEach(id => {
        const element = document.getElementById(id);
        if (!element) {
            missingElements.push(id);
            console.error('❌ Missing element:', id);
        } else {
            console.log('✅ Found element:', id);
        }
    });
    
    if (missingElements.length > 0) {
        console.error('🚨 Critical Error: Missing required DOM elements:', missingElements);
        alert('Error: Beberapa elemen form tidak ditemukan. Silakan refresh halaman.');
        return;
    }
    
    console.log('🎯 All required elements found, proceeding with initialization...');
    
    try {
        initializeForm();
        console.log('✅ Form initialized');
        
        loadProvinces();
        console.log('🔄 Province loading started');
        
        setupImagePreview();
        console.log('✅ Image preview setup');
        
        setupLocationHandlers();
        console.log('✅ Location handlers setup');
        
    } catch (error) {
        console.error('💥 Error during initialization:', error);
        alert('Error during initialization: ' + error.message);
    }
    
    @if(isset($laporan))
        // Pre-fill form for edit mode
        setTimeout(() => {
            setSelectedValue('provinsi', '{{ $laporan->provinsi }}');
            loadCities('{{ $laporan->provinsi }}', '{{ $laporan->kota }}');
        }, 1000);
    @endif
});

function initializeForm() {
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');
    
    nextBtn.addEventListener('click', nextStep);
    prevBtn.addEventListener('click', prevStep);
    
    updateStepDisplay();
}

function nextStep() {
    if (validateCurrentStep()) {
        if (currentStep < totalSteps) {
            currentStep++;
            updateStepDisplay();
        }
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateStepDisplay();
    }
}

function updateStepDisplay() {
    // Hide all steps
    document.querySelectorAll('.form-step').forEach(step => {
        step.classList.remove('active');
    });
    
    // Show current step
    document.getElementById(`step${currentStep}`).classList.add('active');
    
    // Update progress bar
    const progressBar = document.getElementById('progressBar');
    const progressWidth = (currentStep / totalSteps) * 100;
    progressBar.style.width = progressWidth + '%';
    
    // Update step labels
    document.querySelectorAll('.step-label').forEach((label, index) => {
        if (index + 1 <= currentStep) {
            label.classList.add('active');
        } else {
            label.classList.remove('active');
        }
    });
    
    // Update buttons
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');
    
    prevBtn.style.display = currentStep === 1 ? 'none' : 'flex';
    nextBtn.style.display = currentStep === totalSteps ? 'none' : 'flex';
    submitBtn.style.display = currentStep === totalSteps ? 'flex' : 'none';
}

function validateCurrentStep() {
    const currentStepElement = document.getElementById(`step${currentStep}`);
    const requiredFields = currentStepElement.querySelectorAll('[required]');
    
    for (let field of requiredFields) {
        if (!field.value.trim()) {
            field.focus();
            showNotification('Mohon lengkapi semua field yang wajib diisi', 'error');
            return false;
        }
    }
    
    return true;
}

// Location API functions
async function loadProvinces() {
    try {
        const apiUrl = `${NUSAKITA_API}/provinsi?pagination=false`;
        console.log('🔄 Starting to load provinces from:', apiUrl);
        console.log('🌐 NUSAKITA_API base:', NUSAKITA_API);
        
        // Test if we can reach the API
        console.log('📡 Attempting to fetch data...');
        const response = await fetch(apiUrl, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        
        console.log('📊 Response received:');
        console.log('  - Status:', response.status);
        console.log('  - Status Text:', response.statusText);
        console.log('  - Headers:', Object.fromEntries(response.headers.entries()));
        
        if (!response.ok) {
            console.error('❌ HTTP Error Details:');
            console.error('  - Status:', response.status);
            console.error('  - Status Text:', response.statusText);
            const errorText = await response.text();
            console.error('  - Response Body:', errorText);
            throw new Error(`HTTP error! status: ${response.status} - ${response.statusText}`);
        }
        
        console.log('✅ Response OK, parsing JSON...');
        const data = await response.json();
        console.log('📋 Raw API Response:', data);
        console.log('📋 Data type:', typeof data);
        console.log('📋 Data keys:', Object.keys(data));
        
        const provinsiSelect = document.getElementById('provinsi');
        provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
        
        // Store province data for later use
        provinceData = {};
        if (data.data && Array.isArray(data.data)) {
            data.data.forEach(province => {
                provinceData[province.nama] = province.kode;
                const option = document.createElement('option');
                option.value = province.nama;
                option.textContent = province.nama;
                provinsiSelect.appendChild(option);
            });
            console.log('Provinces loaded successfully:', Object.keys(provinceData).length);
        } else {
            console.error('❌ Invalid data structure received:');
            console.error('  - Expected: { data: Array }');
            console.error('  - Received:', data);
            
            // Try to handle different response formats
            if (Array.isArray(data)) {
                console.log('🔄 Data is array, trying direct processing...');
                data.forEach(province => {
                    provinceData[province.nama] = province.kode;
                    const option = document.createElement('option');
                    option.value = province.nama;
                    option.textContent = province.nama;
                    provinsiSelect.appendChild(option);
                });
                console.log('✅ Provinces loaded from direct array:', Object.keys(provinceData).length);
            } else {
                throw new Error('Invalid data structure received - not array or { data: array }');
            }
        }
        
        // Remove existing event listener to prevent duplicates
        provinsiSelect.onchange = null;
        provinsiSelect.addEventListener('change', function() {
            if (this.value) {
                loadCities(this.value);
            } else {
                resetSelect('kota');
                resetSelect('kecamatan');
                resetSelect('kelurahan');
            }
        });
        
        console.log('🎉 Province loading completed successfully!');
        
    } catch (error) {
        console.error('💥 Critical Error loading provinces:');
        console.error('  - Error Type:', error.name);
        console.error('  - Error Message:', error.message);
        console.error('  - Stack Trace:', error.stack);
        
        // Check if it's a network error
        if (error.message.includes('fetch')) {
            console.error('🌐 Network Error Detected - Possible causes:');
            console.error('  1. Internet connection issue');
            console.error('  2. API server is down');
            console.error('  3. CORS policy blocking request');
            console.error('  4. Firewall blocking external requests');
        }
        
        // Load fallback data for testing
        console.log('🔄 Loading fallback province data...');
        loadFallbackProvinces();
        
        showNotification('Gagal memuat data provinsi dari API. Menggunakan data fallback. Error: ' + error.message, 'error');
    }
}

// Fallback function for testing
function loadFallbackProvinces() {
    console.log('📦 Loading fallback province data...');
    const fallbackProvinces = [
        { kode: '11', nama: 'Aceh' },
        { kode: '12', nama: 'Sumatera Utara' },
        { kode: '13', nama: 'Sumatera Barat' },
        { kode: '14', nama: 'Riau' },
        { kode: '15', nama: 'Jambi' },
        { kode: '16', nama: 'Sumatera Selatan' },
        { kode: '17', nama: 'Bengkulu' },
        { kode: '18', nama: 'Lampung' },
        { kode: '31', nama: 'DKI Jakarta' },
        { kode: '32', nama: 'Jawa Barat' },
        { kode: '33', nama: 'Jawa Tengah' },
        { kode: '34', nama: 'DI Yogyakarta' },
        { kode: '35', nama: 'Jawa Timur' }
    ];
    
    const provinsiSelect = document.getElementById('provinsi');
    provinsiSelect.innerHTML = '<option value="">Pilih Provinsi (Fallback Data)</option>';
    
    provinceData = {};
    fallbackProvinces.forEach(province => {
        provinceData[province.nama] = province.kode;
        const option = document.createElement('option');
        option.value = province.nama;
        option.textContent = province.nama;
        provinsiSelect.appendChild(option);
    });
    
    console.log('✅ Fallback provinces loaded:', Object.keys(provinceData).length);
    
    // Add event listener
    provinsiSelect.onchange = null;
    provinsiSelect.addEventListener('change', function() {
        if (this.value) {
            loadCities(this.value);
        } else {
            resetSelect('kota');
            resetSelect('kecamatan');
            resetSelect('kelurahan');
        }
    });
}

async function loadCities(provinceName, selectedCity = null) {
    try {
        const provinceCode = provinceData[provinceName];
        console.log('Loading cities for province:', provinceName, 'with code:', provinceCode);
        
        if (!provinceCode) {
            throw new Error('Province code not found for: ' + provinceName);
        }
        
        const url = `${NUSAKITA_API}/${provinceCode}/kab-kota?pagination=false`;
        console.log('Fetching cities from:', url);
        const response = await fetch(url);
        console.log('Cities response status:', response.status);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Cities data:', data);
        
        const kotaSelect = document.getElementById('kota');
        kotaSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
        kotaSelect.disabled = false;
        
        // Store city data for later use
        cityData = {};
        if (data.data && Array.isArray(data.data)) {
            data.data.forEach(city => {
                cityData[city.nama] = city.kode;
                const option = document.createElement('option');
                option.value = city.nama;
                option.textContent = city.nama;
                if (selectedCity && city.nama === selectedCity) {
                    option.selected = true;
                }
                kotaSelect.appendChild(option);
            });
            console.log('Cities loaded successfully:', Object.keys(cityData).length);
        } else {
            console.error('Invalid cities data structure:', data);
            throw new Error('Invalid cities data structure received');
        }
        
        // Remove existing event listener to prevent duplicates
        kotaSelect.onchange = null;
        kotaSelect.addEventListener('change', function() {
            if (this.value) {
                loadDistricts(this.value);
            } else {
                resetSelect('kecamatan');
                resetSelect('kelurahan');
            }
        });
        
        if (selectedCity) {
            loadDistricts(selectedCity);
        }
    } catch (error) {
        console.error('Error loading cities:', error);
        showNotification('Gagal memuat data kota: ' + error.message, 'error');
    }
}

async function loadDistricts(cityName, selectedDistrict = null) {
    try {
        const cityCode = cityData[cityName];
        if (!cityCode) {
            throw new Error('City code not found');
        }
        
        const response = await fetch(`${NUSAKITA_API}/${cityCode}/kecamatan?pagination=false`);
        const data = await response.json();
        
        const kecamatanSelect = document.getElementById('kecamatan');
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        kecamatanSelect.disabled = false;
        
        // Store district data for later use
        districtData = {};
        data.data.forEach(district => {
            districtData[district.nama] = district.kode;
            const option = document.createElement('option');
            option.value = district.nama;
            option.textContent = district.nama;
            if (selectedDistrict && district.nama === selectedDistrict) {
                option.selected = true;
            }
            kecamatanSelect.appendChild(option);
        });
        
        // Remove existing event listener to prevent duplicates
        kecamatanSelect.onchange = null;
        kecamatanSelect.addEventListener('change', function() {
            if (this.value) {
                loadVillages(this.value);
            } else {
                resetSelect('kelurahan');
            }
        });
        
        if (selectedDistrict) {
            loadVillages(selectedDistrict);
        }
    } catch (error) {
        console.error('Error loading districts:', error);
        showNotification('Gagal memuat data kecamatan', 'error');
    }
}

async function loadVillages(districtName, selectedVillage = null) {
    try {
        const districtCode = districtData[districtName];
        if (!districtCode) {
            throw new Error('District code not found');
        }
        
        const response = await fetch(`${NUSAKITA_API}/${districtCode}/desa-kel?pagination=false`);
        const data = await response.json();
        
        const kelurahanSelect = document.getElementById('kelurahan');
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
        kelurahanSelect.disabled = false;
        
        data.data.forEach(village => {
            const option = document.createElement('option');
            option.value = village.nama;
            option.textContent = village.nama;
            if (selectedVillage && village.nama === selectedVillage) {
                option.selected = true;
            }
            kelurahanSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error loading villages:', error);
        showNotification('Gagal memuat data kelurahan', 'error');
    }
}

function resetSelect(selectId) {
    const select = document.getElementById(selectId);
    select.innerHTML = `<option value="">Pilih ${selectId.charAt(0).toUpperCase() + selectId.slice(1)}</option>`;
    select.disabled = true;
}

function setSelectedValue(selectId, value) {
    const select = document.getElementById(selectId);
    const option = Array.from(select.options).find(opt => opt.value === value);
    if (option) {
        option.selected = true;
    }
}

// Image preview functionality
function setupImagePreview() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const previewImg = document.getElementById('previewImg');
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('hidden');
                uploadPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
}

// Location handlers
function setupLocationHandlers() {
    document.getElementById('getCurrentLocation').addEventListener('click', getCurrentLocation);
    document.getElementById('openMapPicker').addEventListener('click', openMapPicker);
    document.getElementById('closeMapModal').addEventListener('click', closeMapModal);
    document.getElementById('cancelMapSelection').addEventListener('click', closeMapModal);
    document.getElementById('confirmMapSelection').addEventListener('click', confirmMapSelection);
}

function getCurrentLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);
                
                showNotification('Lokasi berhasil didapatkan', 'success');
            },
            function(error) {
                showNotification('Gagal mendapatkan lokasi. Pastikan GPS aktif.', 'error');
            }
        );
    } else {
        showNotification('Browser tidak mendukung geolocation', 'error');
    }
}

function openMapPicker() {
    document.getElementById('mapModal').classList.remove('hidden');
    
    // Initialize map if not already done
    if (!modalMap) {
        initializeModalMap();
    }
}

function closeMapModal() {
    document.getElementById('mapModal').classList.add('hidden');
}

function confirmMapSelection() {
    if (selectedLat && selectedLng) {
        document.getElementById('latitude').value = selectedLat.toFixed(6);
        document.getElementById('longitude').value = selectedLng.toFixed(6);
        closeMapModal();
        showNotification('Lokasi berhasil dipilih', 'success');
    } else {
        showNotification('Silakan pilih lokasi di peta terlebih dahulu', 'error');
    }
}

// Google Maps integration (requires Google Maps API key)
function initializeModalMap() {
    // Default to Jakarta coordinates
    const defaultLat = -6.2088;
    const defaultLng = 106.8456;
    
    // Check if Google Maps is loaded
    if (typeof google !== 'undefined' && google.maps) {
        modalMap = new google.maps.Map(document.getElementById('modalMap'), {
            center: { lat: defaultLat, lng: defaultLng },
            zoom: 13
        });
        
        modalMap.addListener('click', function(e) {
            selectedLat = e.latLng.lat();
            selectedLng = e.latLng.lng();
            
            // Remove existing marker
            if (modalMarker) {
                modalMarker.setMap(null);
            }
            
            // Add new marker
            modalMarker = new google.maps.Marker({
                position: { lat: selectedLat, lng: selectedLng },
                map: modalMap,
                title: 'Lokasi yang dipilih'
            });
        });
    } else {
        // Fallback: show message about Google Maps API
        document.getElementById('modalMap').innerHTML = 
            '<div class="flex items-center justify-center h-full bg-gray-100 rounded-lg">' +
            '<p class="text-gray-600">Google Maps API tidak tersedia. Silakan masukkan koordinat secara manual.</p>' +
            '</div>';
    }
}

// Utility functions
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
    
    if (type === 'success') {
        notification.className += ' bg-green-500 text-white';
    } else if (type === 'error') {
        notification.className += ' bg-red-500 text-white';
    } else {
        notification.className += ' bg-blue-500 text-white';
    }
    
    notification.innerHTML = `
        <div class="flex items-center">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 5000);
}
</script>

<!-- Google Maps API -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>

<style>
.form-step {
    display: none;
}

.form-step.active {
    display: block;
}

.step-label {
    color: #9CA3AF;
    transition: color 0.3s ease;
}

.step-label.active {
    color: #3B82F6;
    font-weight: 600;
}

.group:hover .group-hover\:border-gray-400 {
    border-color: #9CA3AF;
}

/* Custom scrollbar for modal */
.modal-content {
    scrollbar-width: thin;
    scrollbar-color: #CBD5E0 #F7FAFC;
}

.modal-content::-webkit-scrollbar {
    width: 6px;
}

.modal-content::-webkit-scrollbar-track {
    background: #F7FAFC;
}

.modal-content::-webkit-scrollbar-thumb {
    background: #CBD5E0;
    border-radius: 3px;
}

.modal-content::-webkit-scrollbar-thumb:hover {
    background: #A0AEC0;
}
</style>
@endpush
