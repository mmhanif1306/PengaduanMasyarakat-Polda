@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                        <p class="text-gray-600 mt-1">Selamat datang, {{ Auth::user()->nama }}!</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">{{ now()->format('d F Y') }}</p>
                        <p class="text-sm text-gray-500">{{ now()->format('H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Buat Laporan</h3>
                            <p class="text-gray-600 text-sm">Laporkan keluhan atau pengaduan</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('laporan.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Buat Laporan Baru
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Laporan Saya</h3>
                            <p class="text-gray-600 text-sm">Lihat status laporan yang telah dibuat</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('laporan.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                            Lihat Laporan
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Profil</h3>
                            <p class="text-gray-600 text-sm">Kelola informasi akun Anda</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('profile') }}"
                            class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition-colors">
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Laporan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ Auth::user()->laporan()->count() ?? 0 }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Menunggu</p>
                            <p class="text-2xl font-bold text-yellow-600">
                                {{ Auth::user()->laporan()->where('status', 'menunggu')->count() ?? 0 }}</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Diproses</p>
                            <p class="text-2xl font-bold text-blue-600">
                                {{ Auth::user()->laporan()->where('status', 'diproses')->count() ?? 0 }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Selesai</p>
                            <p class="text-2xl font-bold text-green-600">
                                {{ Auth::user()->laporan()->where('status', 'selesai')->count() ?? 0 }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter dan Pencarian -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Filter Laporan</h2>
                <form method="GET" action="{{ route('dashboard') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div>
                        <input type="text" name="search" value="{{ $currentFilters['search'] }}"
                            placeholder="Cari laporan..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <select name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}"
                                    {{ $currentFilters['status'] == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Province Filter -->
                    <div>
                        <select name="provinsi"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Provinsi</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province }}"
                                    {{ $currentFilters['provinsi'] == $province ? 'selected' : '' }}>
                                    {{ $province }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <button type="submit"
                            class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                            Filter
                        </button>
                        <a href="{{ route('dashboard') }}"
                            class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-200 text-center">
                            Reset
                        </a>
                    </div>
                </form>

                @if ($currentFilters['total_filtered'] != $totalLaporan)
                    <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-700">
                            Menampilkan {{ $currentFilters['total_filtered'] }} dari {{ $totalLaporan }} laporan
                        </p>
                    </div>
                @endif
            </div>

            <!-- Recent Reports -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">
                        {{ $currentFilters['search'] || $currentFilters['status'] || $currentFilters['provinsi'] ? 'Hasil Filter' : 'Laporan Terbaru' }}
                    </h2>
                </div>
                <div class="p-6">
                    @if ($laporanTerbaru->count() > 0)
                        <div class="space-y-4">
                            @foreach ($laporanTerbaru as $laporan)
                                <div
                                    class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                                    <div class="flex-1">
                                        <h3 class="font-medium text-gray-900">{{ $laporan->judul }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($laporan->deskripsi, 100) }}
                                        </p>
                                        <div class="flex items-center space-x-4 mt-2">
                                            <p class="text-xs text-gray-500">
                                                {{ $laporan->created_at->format('d M Y, H:i') }}</p>
                                            @if ($laporan->provinsi)
                                                <p class="text-xs text-gray-500">📍 {{ $laporan->provinsi }},
                                                    {{ $laporan->kota }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-4 flex flex-col items-end space-y-2">
                                        @if ($laporan->status == 'menunggu')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Menunggu
                                            </span>
                                        @elseif($laporan->status == 'diproses')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Diproses
                                            </span>
                                        @elseif($laporan->status == 'selesai')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Selesai
                                            </span>
                                        @endif
                                        <a href="{{ route('laporan.show', $laporan->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 shadow-sm hover:shadow-md transform hover:scale-105">
                                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6 text-center">
                            <a href="{{ route('laporan.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                Lihat Semua Laporan
                            </a>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            @if ($currentFilters['search'] || $currentFilters['status'] || $currentFilters['provinsi'])
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada laporan yang sesuai dengan
                                    filter</h3>
                                <p class="mt-1 text-sm text-gray-500">Coba ubah kriteria pencarian Anda.</p>
                                <div class="mt-6">
                                    <a href="{{ route('dashboard') }}"
                                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                                        Reset Filter
                                    </a>
                                </div>
                            @else
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada laporan</h3>
                                <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat laporan pertama Anda.</p>
                                <div class="mt-6">
                                    <a href="{{ route('laporan.create') }}"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Buat Laporan Baru
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <!-- Monthly Statistics Chart -->
            <div class="mt-6 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Statistik Laporan Bulanan ({{ date('Y') }})</h2>
                <div class="h-64">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Statistics Chart
        const monthlyData = @json($monthlyStats);
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const chartData = new Array(12).fill(0);

        // Fill data from database
        monthlyData.forEach(item => {
            chartData[item.month - 1] = item.count;
        });

        const ctx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Jumlah Laporan',
                    data: chartData,
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                elements: {
                    point: {
                        radius: 4,
                        hoverRadius: 6
                    }
                }
            }
        });
    </script>
@endsection
