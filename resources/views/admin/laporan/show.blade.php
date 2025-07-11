@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-3">
                                <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-white">Detail Laporan</h1>
                                <p class="text-blue-100 mt-1">Informasi lengkap laporan pengaduan</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <!-- Download PDF Button -->
                            <a href="{{ route('admin.laporan.pdf', $laporan->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 shadow-lg">
                                <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                PDF
                            </a>
                            <!-- Back Button -->
                            <a href="{{ route('admin.laporan.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm text-white rounded-lg hover:bg-white/30 transition-all duration-200 border border-white/20">
                                <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M17 10a.75.75 0 01-.75.75H5.612l4.158 4.158a.75.75 0 11-1.06 1.06l-5.5-5.5a.75.75 0 010-1.06l5.5-5.5a.75.75 0 111.06 1.06L5.612 9.25H16.25A.75.75 0 0117 10z"
                                        clip-rule="evenodd" />
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white overflow-hidden shadow-xl rounded-xl border border-gray-100 animate-fade-in">
                <div class="p-8">
                    <!-- Laporan Header -->
                    <div class="border-b border-gray-200 pb-6 mb-8">
                        <div class="lg:flex lg:items-start lg:justify-between">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-3xl font-bold leading-7 text-gray-900 mb-4">
                                    {{ $laporan->judul }}
                                </h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                                        <div class="bg-blue-100 rounded-lg p-2 mr-3">
                                            <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-blue-600 uppercase tracking-wide">Pelapor</p>
                                            <p class="text-sm font-semibold text-gray-900">{{ $laporan->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $laporan->user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                        <div class="bg-green-100 rounded-lg p-2 mr-3">
                                            <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-green-600 uppercase tracking-wide">Alamat</p>
                                            <p class="text-sm font-semibold text-gray-900">{{ $laporan->alamat }}</p>
                                            <p class="text-xs text-gray-500">{{ $laporan->kelurahan }},
                                                {{ $laporan->kecamatan }}</p>
                                            <p class="text-xs text-gray-500">{{ $laporan->kota }}, {{ $laporan->provinsi }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-3 bg-purple-50 rounded-lg">
                                        <div class="bg-purple-100 rounded-lg p-2 mr-3">
                                            <svg class="h-5 w-5 text-purple-600" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-purple-600 uppercase tracking-wide">Tanggal
                                                Dibuat</p>
                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ $laporan->created_at->format('d M Y') }}</p>
                                            <p class="text-xs text-gray-500">{{ $laporan->created_at->format('H:i') }} WIB
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center p-3 
                                    {{ $laporan->status === 'menunggu' ? 'bg-yellow-50' : '' }}
                                    {{ $laporan->status === 'diproses' ? 'bg-blue-50' : '' }}
                                    {{ $laporan->status === 'selesai' ? 'bg-green-50' : '' }}
                                    {{ $laporan->status === 'ditolak' ? 'bg-red-50' : '' }} rounded-lg">
                                        <div
                                            class="
                                        {{ $laporan->status === 'menunggu' ? 'bg-yellow-100' : '' }}
                                        {{ $laporan->status === 'diproses' ? 'bg-blue-100' : '' }}
                                        {{ $laporan->status === 'selesai' ? 'bg-green-100' : '' }}
                                        {{ $laporan->status === 'ditolak' ? 'bg-red-100' : '' }} rounded-lg p-2 mr-3">
                                            @if ($laporan->status === 'menunggu')
                                                <svg class="h-5 w-5 text-yellow-600" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @elseif($laporan->status === 'diproses')
                                                <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                </svg>
                                            @elseif($laporan->status === 'selesai')
                                                <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @else
                                                <svg class="h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <p
                                                class="text-xs font-medium 
                                            {{ $laporan->status === 'menunggu' ? 'text-yellow-600' : '' }}
                                            {{ $laporan->status === 'diproses' ? 'text-blue-600' : '' }}
                                            {{ $laporan->status === 'selesai' ? 'text-green-600' : '' }}
                                            {{ $laporan->status === 'ditolak' ? 'text-red-600' : '' }} uppercase tracking-wide">
                                                Status</p>
                                            <a
                                                class="{{ $laporan->status === 'menunggu' ? 'text-yellow-800' : '' }}
                                            {{ $laporan->status === 'diproses' ? 'text-blue-800' : '' }}
                                            {{ $laporan->status === 'selesai' ? 'text-green-800' : '' }}
                                            {{ $laporan->status === 'ditolak' ? 'text-red-800' : '' }}">
                                                @if ($laporan->status === 'menunggu')
                                                    Menunggu
                                                @elseif($laporan->status === 'diproses')
                                                    Diproses
                                                @elseif($laporan->status === 'selesai')
                                                    Selesai
                                                @else
                                                    Ditolak
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Isi Laporan -->
                    <div class="mb-8">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-100 rounded-lg p-2 mr-3">
                                <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 18H3.75a1.5 1.5 0 01-1.5-1.5V4.5a1.5 1.5 0 011.5-1.5H8.25m0 0h2.25A1.125 1.125 0 0111.625 4.5v1.5m-3.375 0h3.375m0 0h1.5m-3.375 0v15.75m3.375-12v9.75m0-9.75h1.5m-1.5 0V3.375a1.125 1.125 0 011.125-1.125h1.5m0 0h3.375A1.125 1.125 0 0121 4.5v3.75m0 0V9.75m0 0h-3.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Isi Laporan</h3>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <div class="text-gray-700 leading-relaxed">
                                {{ $laporan->deskripsi }}
                            </div>
                        </div>
                    </div>

                    <!-- Bukti -->
                    @if ($laporan->url_file)
                        <div class="mb-8">
                            <div class="flex items-center mb-4">
                                <div class="bg-green-100 rounded-lg p-2 mr-3">
                                    <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Bukti Pendukung</h3>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                                <div class="text-center">
                                    <div class="relative inline-block">
                                        <img src="{{ $laporan->url_file }}" alt="Bukti laporan"
                                            class="max-w-full max-h-96 h-auto rounded-lg shadow-lg border border-gray-200 mx-auto object-cover">
                                        <div class="absolute top-2 right-2">
                                            <a href="{{ $laporan->url_file }}" target="_blank"
                                                class="inline-flex items-center px-3 py-2 bg-black/50 backdrop-blur-sm text-white rounded-lg hover:bg-black/70 transition-all duration-200">
                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ $laporan->url_file }}" target="_blank"
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                            <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M10.75 2.75a.75.75 0 00-1.5 0v8.614L6.295 8.235a.75.75 0 10-1.09 1.03l4.25 4.5a.75.75 0 001.09 0l4.25-4.5a.75.75 0 00-1.09-1.03l-2.955 3.129V2.75z" />
                                                <path
                                                    d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z" />
                                            </svg>
                                            Lihat Gambar Penuh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Lokasi Google Maps -->
                    @if ($laporan->longitude && $laporan->latitude)
                        <div class="mb-8">
                            <div class="flex items-center mb-4">
                                <div class="bg-red-100 rounded-lg p-2 mr-3">
                                    <svg class="h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Lokasi Kejadian</h3>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">
                                        <strong>Koordinat:</strong> {{ $laporan->latitude }}, {{ $laporan->longitude }}
                                    </p>
                                </div>
                                <div class="w-full h-96 rounded-lg overflow-hidden border border-gray-300">
                                    <div id="map" class="w-full h-full"></div>
                                </div>
                                <div class="mt-4 flex justify-center">
                                    <a href="https://www.google.com/maps?q={{ $laporan->latitude }},{{ $laporan->longitude }}"
                                        target="_blank"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                        <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                        </svg>
                                        Buka di Google Maps
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Update Status -->
                    @if ($laporan->status === 'menunggu' || $laporan->status === 'diproses')
                        <div class="border-t border-gray-200 pt-8 mb-8">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <div class="bg-gradient-to-br from-orange-100 to-orange-50 rounded-xl p-3 mr-4 shadow-sm">
                                        <svg class="h-6 w-6 text-orange-600" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">Update Status Laporan</h3>
                                        <p class="text-sm text-gray-600 mt-1">Ubah status laporan untuk memberikan update kepada pelapor</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    @if ($laporan->status === 'menunggu')
                                        <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="diproses">
                                            <button type="submit"
                                                class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-semibold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                                <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-blue-500 rounded-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                                <svg class="mr-3 h-6 w-6 transition-transform group-hover:scale-110" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                </svg>
                                                <span class="relative">Mulai Diproses</span>
                                            </button>
                                        </form>
                                    @elseif($laporan->status === 'diproses')
                                        <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit"
                                                class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-300 font-semibold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                                <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-green-500 rounded-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                                <svg class="mr-3 h-6 w-6 transition-transform group-hover:scale-110" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="relative">Tandai Selesai</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Riwayat Update -->
                    @if ($laporan->notifikasi && $laporan->notifikasi->count() > 0)
                        <div class="border-t border-gray-200 pt-8">
                            <div class="flex items-center mb-6">
                                <div class="bg-purple-100 rounded-lg p-2 mr-3">
                                    <svg class="h-5 w-5 text-purple-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Riwayat Update</h3>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                                <div class="flow-root">
                                    <ul role="list" class="-mb-8">
                                        @foreach ($laporan->notifikasi->sortByDesc('created_at') as $notifikasi)
                                            <li>
                                                <div class="relative pb-8">
                                                    @if (!$loop->last)
                                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-300"
                                                            aria-hidden="true"></span>
                                                    @endif
                                                    <div class="relative flex space-x-4">
                                                        <div>
                                                            <span
                                                                class="h-10 w-10 rounded-full flex items-center justify-center ring-4 ring-white shadow-lg
                                                    {{ $notifikasi->status === 'menunggu' ? 'bg-yellow-500' : '' }}
                                                    {{ $notifikasi->status === 'diproses' ? 'bg-blue-500' : '' }}
                                                    {{ $notifikasi->status === 'selesai' ? 'bg-green-500' : '' }}
                                                    {{ $notifikasi->status === 'ditolak' ? 'bg-red-500' : '' }}">
                                                                @if ($notifikasi->status === 'menunggu')
                                                                    <svg class="h-5 w-5 text-white"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    </svg>
                                                                @elseif($notifikasi->status === 'diproses')
                                                                    <svg class="h-5 w-5 text-white"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                                    </svg>
                                                                @elseif($notifikasi->status === 'selesai')
                                                                    <svg class="h-5 w-5 text-white"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    </svg>
                                                                @else
                                                                    <svg class="h-5 w-5 text-white"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    </svg>
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                            <div
                                                                class="bg-white rounded-lg p-4 shadow-sm border border-gray-200 flex-1">
                                                                <div class="flex items-center justify-between mb-2">
                                                                    <p class="text-sm font-medium text-gray-900">Status
                                                                        diubah menjadi
                                                                        <span
                                                                            class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                                                {{ $notifikasi->status === 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                                {{ $notifikasi->status === 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                                                {{ $notifikasi->status === 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                                                                {{ $notifikasi->status === 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                                                            {{ ucfirst($notifikasi->status) }}
                                                                        </span>
                                                                    </p>
                                                                    <time class="text-xs text-gray-500"
                                                                        datetime="{{ $notifikasi->created_at }}">{{ $notifikasi->created_at->diffForHumans() }}</time>
                                                                </div>
                                                                @if ($notifikasi->keterangan)
                                                                    <p
                                                                        class="text-sm text-gray-700 bg-gray-50 rounded-md p-3 mt-2">
                                                                        {{ $notifikasi->keterangan }}</p>
                                                                @endif
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function initMap() {
        const latitude = {{ $laporan->latitude }};
        const longitude = {{ $laporan->longitude }};
        const location = { lat: latitude, lng: longitude };

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 16,
            center: location,
            mapTypeId: 'roadmap'
        });

        const marker = new google.maps.Marker({
            position: location,
            map: map,
            title: 'Lokasi Kejadian: {{ $laporan->judul }}',
            icon: {
                url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
                scaledSize: new google.maps.Size(32, 32)
            }
        });

        const infoWindow = new google.maps.InfoWindow({
            content: `
                <div style="padding: 10px; max-width: 250px;">
                    <h3 style="margin: 0 0 8px 0; color: #1f2937; font-size: 16px; font-weight: bold;">{{ $laporan->judul }}</h3>
                    <p style="margin: 0 0 4px 0; color: #6b7280; font-size: 14px;"><strong>Alamat:</strong> {{ $laporan->alamat }}</p>
                    <p style="margin: 0 0 4px 0; color: #6b7280; font-size: 14px;"><strong>Koordinat:</strong> ${latitude}, ${longitude}</p>
                    <p style="margin: 0; color: #6b7280; font-size: 14px;"><strong>Status:</strong> 
                        <span style="background: {{ $laporan->status === 'menunggu' ? '#fef3c7' : ($laporan->status === 'diproses' ? '#dbeafe' : ($laporan->status === 'selesai' ? '#d1fae5' : '#fee2e2')) }}; color: {{ $laporan->status === 'menunggu' ? '#92400e' : ($laporan->status === 'diproses' ? '#1e40af' : ($laporan->status === 'selesai' ? '#065f46' : '#991b1b')) }}; padding: 2px 8px; border-radius: 12px; font-size: 12px;">{{ ucfirst($laporan->status) }}</span>
                    </p>
                </div>
            `
        });

        marker.addListener('click', () => {
            infoWindow.open(map, marker);
        });

        // Auto open info window
        infoWindow.open(map, marker);
    }

    window.initMap = initMap;
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
@endpush
