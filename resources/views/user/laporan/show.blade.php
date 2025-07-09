@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('laporan.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white text-gray-700 rounded-xl shadow-md hover:shadow-lg hover:bg-gray-50 transition-all duration-200 border border-gray-200">
                    <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M17 10a.75.75 0 01-.75.75H5.612l4.158 4.158a.75.75 0 11-1.06 1.06l-5.5-5.5a.75.75 0 010-1.06l5.5-5.5a.75.75 0 111.06 1.06L5.612 9.25H16.25A.75.75 0 0117 10z"
                            clip-rule="evenodd" />
                    </svg>
                    Kembali ke Daftar Laporan
                </a>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <!-- Header with Status -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-white mb-2">📋 Detail Laporan</h1>
                            <p class="text-blue-100">Dibuat pada {{ $laporan->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white
                                {{ $laporan->status === 'menunggu' ? 'text-yellow-700' : '' }}
                                {{ $laporan->status === 'diproses' ? 'text-blue-700' : '' }}
                                {{ $laporan->status === 'selesai' ? 'text-green-700' : '' }}
                                {{ $laporan->status === 'ditolak' ? 'text-red-700' : '' }}">
                                @if ($laporan->status === 'menunggu')
                                    ⏳ Menunggu
                                @elseif($laporan->status === 'diproses')
                                    🔄 Diproses
                                @elseif($laporan->status === 'selesai')
                                    ✅ Selesai
                                @elseif($laporan->status === 'ditolak')
                                    ❌ Ditolak
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Status Information -->
                <div
                    class="px-8 py-6 border-b border-gray-200
                    {{ $laporan->status === 'menunggu' ? 'bg-yellow-50' : '' }}
                    {{ $laporan->status === 'diproses' ? 'bg-blue-50' : '' }}
                    {{ $laporan->status === 'selesai' ? 'bg-green-50' : '' }}
                    {{ $laporan->status === 'ditolak' ? 'bg-red-50' : '' }}">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 rounded-full flex items-center justify-center
                                {{ $laporan->status === 'menunggu' ? 'bg-yellow-100' : '' }}
                                {{ $laporan->status === 'diproses' ? 'bg-blue-100' : '' }}
                                {{ $laporan->status === 'selesai' ? 'bg-green-100' : '' }}
                                @if ($laporan->status === 'menunggu') <span class="text-2xl">⏳</span>
                                @elseif($laporan->status === 'diproses')
                                    <span class="text-2xl">🔄</span>
                                @elseif($laporan->status === 'selesai')
                                    <span class="text-2xl">✅</span> @endif
                            </div>
                        </div>
                        <div class="flex-1">
                                <h3
                                    class="text-lg font-semibold
                                {{ $laporan->status === 'menunggu' ? 'text-yellow-800' : '' }}
                                {{ $laporan->status === 'diproses' ? 'text-blue-800' : '' }}
                                {{ $laporan->status === 'selesai' ? 'text-green-800' : '' }}
                                {{ $laporan->status === 'ditolak' ? 'text-red-800' : '' }}">
                                    Status: {{ ucfirst($laporan->status) }}
                                </h3>
                                <p
                                    class="mt-1
                                {{ $laporan->status === 'menunggu' ? 'text-yellow-700' : '' }}
                                {{ $laporan->status === 'diproses' ? 'text-blue-700' : '' }}
                                {{ $laporan->status === 'selesai' ? 'text-green-700' : '' }}
                                {{ $laporan->status === 'ditolak' ? 'text-red-700' : '' }}">
                                    @if ($laporan->status === 'menunggu')
                                        Laporan Anda sedang menunggu untuk ditinjau oleh petugas.
                                    @elseif($laporan->status === 'diproses')
                                        Laporan Anda sedang dalam proses penanganan oleh petugas.
                                    @elseif($laporan->status === 'selesai')
                                        Laporan Anda telah selesai ditangani.
                                    @else
                                        Laporan Anda tidak dapat diproses. Silakan periksa keterangan di bawah.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Laporan -->
                    <div class="px-8 py-6">
                        <div class="space-y-8">
                            <!-- 1. Informasi Laporan -->
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    📝 Informasi Laporan
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Judul Laporan</label>
                                        <p class="text-gray-900 font-medium text-lg">{{ $laporan->judul }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Kejadian</label>
                                        <p class="text-gray-900">
                                            {{ \Carbon\Carbon::parse($laporan->tanggal_kejadian)->format('d F Y') }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Waktu Dibuat</label>
                                        <p class="text-gray-900">{{ $laporan->created_at->format('d F Y, H:i') }} WIB</p>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Lokasi Kejadian -->
                            <div class="bg-blue-50 rounded-xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    📍 Lokasi Kejadian
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                    @if ($laporan->provinsi)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-600 mb-1">Provinsi</label>
                                            <p class="text-gray-900">{{ $laporan->provinsi }}</p>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-600 mb-1">Kota/Kabupaten</label>
                                            <p class="text-gray-900">{{ $laporan->kota }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-600 mb-1">Kecamatan</label>
                                            <p class="text-gray-900">{{ $laporan->kecamatan }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-600 mb-1">Kelurahan</label>
                                            <p class="text-gray-900">{{ $laporan->kelurahan }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Alamat Lengkap</label>
                                        <p class="text-gray-900">{{ $laporan->alamat ?? $laporan->lokasi }}</p>
                                    </div>
                                    @if ($laporan->latitude && $laporan->longitude)
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-600 mb-1">Latitude</label>
                                                <p class="text-gray-900 font-mono text-sm">{{ $laporan->latitude }}</p>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-600 mb-1">Longitude</label>
                                                <p class="text-gray-900 font-mono text-sm">{{ $laporan->longitude }}</p>
                                            </div>
                                        </div>
                                        

                                    @endif
                                </div>
                            </div>

                            <!-- 2.5. Peta Lokasi -->
                            @if ($laporan->latitude && $laporan->longitude)
                            <div class="bg-blue-50 rounded-xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    🗺️ Peta Lokasi Kejadian
                                </h3>
                                <div class="bg-white rounded-lg border border-blue-200 overflow-hidden shadow-sm">
                                    <div id="map" class="w-full h-[500px]"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">📍 Lokasi kejadian berdasarkan koordinat yang dilaporkan. Klik marker untuk melihat detail lokasi.</p>
                            </div>
                            @endif

                            <!-- 3. Isi Laporan -->
                            <div class="bg-green-50 rounded-xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    📄 Isi Laporan
                                </h3>
                                <div class="bg-white rounded-lg p-6 border border-green-200 min-h-[300px]">
                                    <div class="prose prose-gray max-w-none">
                                        <p class="text-gray-900 leading-relaxed text-justifu">
                                            {{ $laporan->deskripsi }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bukti -->
                    @if ($laporan->url_file)
                        <div class="px-8 py-6 border-t border-gray-200">
                            <div class="bg-purple-50 rounded-xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                    📎 Bukti Laporan
                                </h3>
                                <div class="bg-white rounded-lg overflow-hidden border border-purple-200 shadow-sm">
                                    @if (Str::endsWith($laporan->url_file, ['.jpg', '.jpeg', '.png', '.gif']))
                                        <div class="relative">
                                            <!-- Image Container -->
                                            <div class="aspect-w-16 aspect-h-9 bg-gray-100">
                                                <img src="{{ $laporan->url_file }}" alt="Bukti laporan"
                                                    class="w-full h-full object-contain rounded-lg transition-transform duration-300 hover:scale-105"
                                                    style="max-height: 500px; object-fit: contain;">
                                            </div>

                                            <!-- Image Actions -->
                                            <div class="absolute top-4 right-4">
                                                <div class="flex space-x-2">
                                                    <!-- View Full Size Button -->
                                                    <a href="{{ $laporan->url_file }}" target="_blank"
                                                        class="inline-flex items-center px-3 py-2 bg-white bg-opacity-90 text-gray-700 rounded-lg shadow-md hover:bg-opacity-100 transition-all duration-200">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                        </svg>
                                                        <span class="text-sm font-medium">Perbesar</span>
                                                    </a>

                                                    <!-- Download Button -->
                                                    <a href="{{ $laporan->url_file }}" download
                                                        class="inline-flex items-center px-3 py-2 bg-purple-600 text-white rounded-lg shadow-md hover:bg-purple-700 transition-all duration-200">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                        <span class="text-sm font-medium">Unduh</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <!-- Image Info -->
                                            <div
                                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                                                <p class="text-white text-sm font-medium">Bukti Laporan</p>
                                                <p class="text-gray-300 text-xs">Klik tombol perbesar untuk melihat detail
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Non-Image File -->
                                        <div
                                            class="flex items-center justify-center p-12 border-2 border-dashed border-purple-300 rounded-lg bg-purple-25">
                                            <div class="text-center max-w-sm">
                                                <div
                                                    class="mx-auto w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                                                    <svg class="w-8 h-8 text-purple-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <h4 class="text-lg font-semibold text-gray-900 mb-2">Dokumen Bukti</h4>
                                                <p class="text-gray-600 mb-6">File bukti dalam format dokumen. Klik tombol
                                                    di bawah untuk mengunduh dan melihat isi dokumen.</p>

                                                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                                    <a href="{{ $laporan->url_file }}" target="_blank"
                                                        class="inline-flex items-center justify-center px-6 py-3 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-all duration-200 shadow-md hover:shadow-lg">
                                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                            </path>
                                                        </svg>
                                                        Lihat Dokumen
                                                    </a>

                                                    <a href="{{ $laporan->url_file }}" download
                                                        class="inline-flex items-center justify-center px-6 py-3 bg-white text-purple-600 font-medium rounded-lg border-2 border-purple-600 hover:bg-purple-50 transition-all duration-200">
                                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                        Unduh Dokumen
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- No Evidence -->
                        <div class="px-8 py-6 border-t border-gray-200">
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    📎 Bukti Laporan
                                </h3>
                                <div class="bg-white rounded-lg p-8 border border-gray-200 text-center">
                                    <div
                                        class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Bukti</h4>
                                    <p class="text-gray-500">Tidak ada bukti foto atau dokumen yang dilampirkan pada
                                        laporan ini.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Riwayat Update -->
                    @if ($laporan->notifikasi && $laporan->notifikasi->count() > 0)
                        <div class="px-8 py-6 border-t border-gray-200">
                            <div class="bg-orange-50 rounded-xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                    📋 Riwayat Update Status
                                </h3>
                                <div class="bg-white rounded-lg p-4 border border-orange-200">
                                    <div class="flow-root">
                                        <ul role="list" class="-mb-8">
                                            @foreach ($laporan->notifikasi->sortByDesc('created_at') as $notifikasi)
                                                <li>
                                                    <div class="relative pb-8">
                                                        @if (!$loop->last)
                                                            <span
                                                                class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-300"
                                                                aria-hidden="true"></span>
                                                        @endif
                                                        <div class="relative flex items-start space-x-4">
                                                            <div class="relative">
                                                                <span
                                                                    class="h-10 w-10 rounded-full flex items-center justify-center ring-4 ring-white shadow-md
                                                                {{ $notifikasi->status === 'menunggu' ? 'bg-yellow-500' : '' }}
                                                                {{ $notifikasi->status === 'diproses' ? 'bg-blue-500' : '' }}
                                                                {{ $notifikasi->status === 'selesai' ? 'bg-green-500' : '' }}
                                                                {{ $notifikasi->status === 'ditolak' ? 'bg-red-500' : '' }}">
                                                                    @if ($notifikasi->status === 'menunggu')
                                                                        <span class="text-white text-lg">⏳</span>
                                                                    @elseif($notifikasi->status === 'diproses')
                                                                        <span class="text-white text-lg">🔄</span>
                                                                    @elseif($notifikasi->status === 'selesai')
                                                                        <span class="text-white text-lg">✅</span>
                                                                    @elseif($notifikasi->status === 'ditolak')
                                                                        <span class="text-white text-lg">❌</span>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <div class="flex items-center justify-between">
                                                                    <div>
                                                                        <p class="text-sm font-medium text-gray-900">
                                                                            Status diubah menjadi
                                                                            <span
                                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                                            {{ $notifikasi->status === 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                                            {{ $notifikasi->status === 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                                                            {{ $notifikasi->status === 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                                                                            {{ $notifikasi->status === 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                                                                {{ ucfirst($notifikasi->status) }}
                                                                            </span>
                                                                        </p>
                                                                        @if ($notifikasi->keterangan)
                                                                            <div class="mt-2 p-3 bg-gray-50 rounded-lg">
                                                                                <p class="text-sm text-gray-700">
                                                                                    {{ $notifikasi->keterangan }}</p>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <p class="text-xs text-gray-500">
                                                                            {{ $notifikasi->created_at->format('d M Y') }}
                                                                        </p>
                                                                        <p class="text-xs text-gray-400">
                                                                            {{ $notifikasi->created_at->format('H:i') }}
                                                                            WIB
                                                                        </p>
                                                                    </div>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>

<script>
let map;
let marker;

function initMap() {
    @if($laporan->latitude && $laporan->longitude)
        const lat = {{ $laporan->latitude }};
        const lng = {{ $laporan->longitude }};
        
        // Initialize Google Map
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: lat, lng: lng },
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [
                {
                    featureType: 'poi',
                    elementType: 'labels',
                    stylers: [{ visibility: 'on' }]
                }
            ]
        });
        
        // Custom marker
        marker = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map,
            title: '{{ addslashes($laporan->judul) }}',
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                scale: 10,
                fillColor: '#ef4444',
                fillOpacity: 1,
                strokeColor: '#ffffff',
                strokeWeight: 3
            }
        });
        
        // Info window
        const infoWindow = new google.maps.InfoWindow({
            content: `
                <div style="min-width: 250px; font-family: system-ui, -apple-system, sans-serif; padding: 10px;">
                    <h3 style="margin: 0 0 10px 0; font-weight: 600; color: #1f2937; font-size: 16px;">{{ addslashes($laporan->judul) }}</h3>
                    <div style="margin: 8px 0; padding: 8px; background-color: #f9fafb; border-radius: 6px;">
                        <p style="margin: 0 0 6px 0; font-size: 14px;"><strong style="color: #374151;">📍 Alamat:</strong></p>
                        <p style="margin: 0 0 8px 0; color: #6b7280; font-size: 13px;">{{ addslashes($laporan->alamat ?? $laporan->lokasi) }}</p>
                        <p style="margin: 0; font-size: 12px; color: #9ca3af;"><strong>Koordinat:</strong> ${lat}, ${lng}</p>
                    </div>
                </div>
            `
        });
        
        // Open info window on marker click
        marker.addListener('click', () => {
            infoWindow.open(map, marker);
        });
        
        // Open info window by default
        infoWindow.open(map, marker);
        
    @else
        document.getElementById('map').innerHTML = `
            <div class="flex items-center justify-center h-full text-gray-500 bg-gray-50 rounded-lg">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p class="text-sm font-medium">Koordinat lokasi tidak tersedia</p>
                    <p class="text-xs text-gray-400 mt-1">Peta tidak dapat ditampilkan</p>
                </div>
            </div>
        `;
    @endif
}

// Fallback if Google Maps fails to load
window.addEventListener('load', function() {
    setTimeout(function() {
        if (typeof google === 'undefined') {
            document.getElementById('map').innerHTML = `
                <div class="flex items-center justify-center h-full text-gray-500 bg-gray-50 rounded-lg">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        <p class="text-sm font-medium">Gagal memuat Google Maps</p>
                        <p class="text-xs text-gray-400 mt-1">Periksa koneksi internet atau API key</p>
                    </div>
                </div>
            `;
        }
    }, 5000);
});
</script>
@endpush
