@extends('layouts.app')

@section('title', 'Manajemen Laporan')

@section('content')
<div class="py-12 animate-fade-in">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl shadow-xl p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold">Manajemen Laporan</h1>
                                <p class="text-primary-100 mt-1">
                                    Kelola dan pantau semua laporan pengaduan masyarakat
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="hidden lg:block">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold">{{ $laporan->total() }}</div>
                                <div class="text-primary-100 text-sm">Total Laporan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
            <div class="p-8">

                <!-- Filters -->
                <div class="mb-8">
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                            </svg>
                            Filter & Pencarian
                        </h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Laporan</label>
                                <div class="relative">
                                    <select id="status" name="status" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm pl-4 pr-10 py-3 bg-white transition-all duration-200 hover:border-primary-300">
                                        <option value="">🔍 Semua Status</option>
                                        <option value="pending">⏳ Pending</option>
                                        <option value="diproses">🔄 Diproses</option>
                                        <option value="selesai">✅ Selesai</option>
                                        <option value="ditolak">❌ Ditolak</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kejadian</label>
                                <div class="relative">
                                    <input type="date" name="date" id="date" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm pl-4 pr-4 py-3 transition-all duration-200 hover:border-primary-300">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                                <div class="relative">
                                    <input type="text" name="search" id="search" placeholder="Cari judul, lokasi, atau pelapor..." 
                                        class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm pl-12 pr-4 py-3 transition-all duration-200 hover:border-primary-300">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th scope="col" class="py-4 pl-6 pr-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-1">
                                            <span>ID</span>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                            </svg>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-1">
                                            <span>Judul Laporan</span>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-1">
                                            <span>Pelapor</span>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-1">
                                            <span>Lokasi</span>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-1">
                                            <span>Tanggal</span>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-1">
                                            <span>Status</span>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </th>
                                    <th scope="col" class="relative px-6 py-4">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($laporan as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                                                <span class="text-primary-600 font-semibold text-xs">#{{ $item->id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="max-w-xs">
                                            <div class="font-medium text-gray-900 truncate">{{ $item->judul }}</div>
                                            <div class="text-gray-500 text-xs mt-1 truncate">{{ Str::limit($item->deskripsi, 50) }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <div class="font-medium text-gray-900">{{ $item->user->name }}</div>
                                                <div class="text-gray-500 text-xs">{{ $item->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="truncate max-w-xs">{{ $item->lokasi }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>{{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d M Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($item->status === 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                </svg>
                                                Pending
                                            </span>
                                        @elseif($item->status === 'diproses')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                                                </svg>
                                                Diproses
                                            </span>
                                        @elseif($item->status === 'selesai')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Selesai
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                </svg>
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.laporan.show', $item->id) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-primary-600 bg-primary-50 hover:bg-primary-100 hover:text-primary-700 transition-all duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 rounded-b-xl">
                    <div class="flex flex-1 justify-between sm:hidden">
                        @if ($laporan->onFirstPage())
                            <span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500">Previous</span>
                        @else
                            <a href="{{ $laporan->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                        @endif
                        
                        @if ($laporan->hasMorePages())
                            <a href="{{ $laporan->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                        @else
                            <span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500">Next</span>
                        @endif
                    </div>
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan
                                <span class="font-medium">{{ $laporan->firstItem() }}</span>
                                sampai
                                <span class="font-medium">{{ $laporan->lastItem() }}</span>
                                dari
                                <span class="font-medium">{{ $laporan->total() }}</span>
                                hasil
                            </p>
                        </div>
                        <div>
                            {{ $laporan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Filter functionality
    const statusFilter = document.getElementById('status');
    const dateFilter = document.getElementById('date');
    const searchInput = document.getElementById('search');

    function applyFilters() {
        const url = new URL(window.location.href);
        
        if (statusFilter.value) {
            url.searchParams.set('status', statusFilter.value);
        } else {
            url.searchParams.delete('status');
        }
        
        if (dateFilter.value) {
            url.searchParams.set('date', dateFilter.value);
        } else {
            url.searchParams.delete('date');
        }
        
        if (searchInput.value) {
            url.searchParams.set('search', searchInput.value);
        } else {
            url.searchParams.delete('search');
        }

        window.location.href = url.toString();
    }

    statusFilter.addEventListener('change', applyFilters);
    dateFilter.addEventListener('change', applyFilters);
    
    let searchTimeout;
    searchInput.addEventListener('input', () => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(applyFilters, 500);
    });

    // Set initial values from URL params
    const urlParams = new URLSearchParams(window.location.search);
    statusFilter.value = urlParams.get('status') || '';
    dateFilter.value = urlParams.get('date') || '';
    searchInput.value = urlParams.get('search') || '';
</script>
@endpush
@endsection