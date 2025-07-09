@extends('layouts.app')

@section('title', 'Detail Notifikasi')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('notifikasi.index') }}"
                    class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Notifikasi
                </a>
            </div>

            <!-- Notification Detail Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-5 5v-5zM9 7H4l5-5v5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold text-gray-900">Detail Notifikasi</h1>
                                <p class="text-sm text-gray-600">Informasi lengkap notifikasi</p>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="flex items-center space-x-2">
                            @if ($notifikasi->is_read)
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Sudah Dibaca
                                </span>
                            @else
                                <span
                                    class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Belum Dibaca
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                            <div class="p-4 bg-gray-50 rounded-lg border">
                                <h2 class="text-lg font-semibold text-gray-900">{{ $notifikasi->judul }}</h2>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <div class="p-4 bg-gray-50 rounded-lg border">
                                <p class="text-gray-700 leading-relaxed">{{ $notifikasi->deskripsi }}</p>
                            </div>
                        </div>

                        <!-- Metadata -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Created At -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dibuat</label>
                                <div class="p-4 bg-gray-50 rounded-lg border">
                                    <div class="flex items-center text-gray-700">
                                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <div>
                                            <p class="font-medium">{{ $notifikasi->created_at->format('d F Y') }}</p>
                                            <p class="text-sm text-gray-500">{{ $notifikasi->created_at->format('H:i') }}
                                                WIB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Time Ago -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Relatif</label>
                                <div class="p-4 bg-gray-50 rounded-lg border">
                                    <div class="flex items-center text-gray-700">
                                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="font-medium">{{ $notifikasi->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            @if (!$notifikasi->is_read)
                                <form action="{{ route('notifikasi.markAsRead', $notifikasi->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Tandai Sudah Dibaca
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('notifikasi.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                Lihat Semua Notifikasi
                            </a>
                        </div>

                        <form action="{{ route('notifikasi.destroy', $notifikasi->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Hapus Notifikasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
