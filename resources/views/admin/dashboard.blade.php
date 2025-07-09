@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
                <p class="text-gray-600 mt-2">Kelola dan pantau laporan pengaduan masyarakat</p>
            </div>

            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 lg:gap-6 mb-8">
                <!-- Total Laporan -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Laporan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($totalLaporan) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total User -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total User</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($totalUser) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Menunggu -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Menunggu</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($laporanMenunggu) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Diproses -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Diproses</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($laporanDiproses) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Selesai -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Selesai</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($laporanSelesai) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('admin.laporan.index') }}"
                        class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Kelola Laporan</p>
                            <p class="text-sm text-gray-500">Lihat dan kelola semua laporan</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.laporan.index', ['status' => 'menunggu']) }}"
                        class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="p-2 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Laporan Menunggu</p>
                            <p class="text-sm text-gray-500">Tinjau laporan yang menunggu</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.laporan.index', ['status' => 'diproses']) }}"
                        class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="p-2 bg-orange-100 rounded-lg">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Laporan Diproses</p>
                            <p class="text-sm text-gray-500">Pantau laporan yang sedang diproses</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 lg:gap-8">
                <!-- Laporan Terbaru -->
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Laporan Terbaru</h3>
                            <a href="{{ route('admin.laporan.index') }}"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua</a>
                        </div>
                    </div>
                    <div class="p-6">
                        @if ($laporanTerbaru->count() > 0)
                            <div class="space-y-4">
                                @foreach ($laporanTerbaru as $laporan)
                                    <div class=" rounded-lg hover:bg-gray-50">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex-1 mr-4">
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $laporan->judul }}
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    {{ $laporan->user->nama ?? $laporan->user->name }}</p>
                                                <p class="text-xs text-gray-400">
                                                    {{ $laporan->created_at->diffForHumans() }}</p>
                                            </div>
                                            <div class="pt-1 flex flex-col items-end">
                                                @php
                                                    $statusColors = [
                                                        'menunggu' => 'bg-yellow-100 text-yellow-800',
                                                        'diproses' => 'bg-orange-100 text-orange-800',
                                                        'selesai' => 'bg-green-100 text-green-800',
                                                    ];
                                                @endphp
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mb-2 {{ $statusColors[$laporan->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ ucfirst($laporan->status) }}
                                                </span>
                                                <div class="pr-2 flex items-center space-x-2">
                                                    <a href="{{ route('admin.laporan.show', $laporan->id) }}"
                                                        class="flex items-center text-blue-600 hover:text-blue-800 group"
                                                        title="Detail">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                            </path>
                                                        </svg>
                                                        <span
                                                            class="text-xs font-medium group-hover:underline">Detail</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">Belum ada laporan</p>
                        @endif
                    </div>
                </div>

                <!-- User Paling Aktif -->
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">User Paling Aktif</h3>
                    </div>
                    <div class="p-6">
                        @if ($activeUsers->count() > 0)
                            <div class="space-y-4">
                                @foreach ($activeUsers as $user)
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            @if ($user->url_file)
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ asset('storage/' . $user->url_file) }}"
                                                    alt="{{ $user->nama ?? $user->name }}">
                                            @else
                                                <div
                                                    class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                                    {{ strtoupper(substr($user->nama ?? $user->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                {{ $user->nama ?? $user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $user->laporan_count }} laporan
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">Belum ada data user</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
