@extends('layouts.app')

@section('title', 'Laporan Saya')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">📋 Laporan Saya</h1>
                            <p class="text-blue-100 text-lg">
                                Kelola dan pantau status laporan pengaduan Anda
                            </p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <a href="{{ route('laporan.create') }}"
                                class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-semibold rounded-xl shadow-lg hover:bg-blue-50 hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Buat Laporan Baru
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Filters Section -->
                <div class="px-8 py-6 bg-gray-50 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">🏷️ Filter Status</label>
                            <select id="status" name="status"
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200">
                                <option value="">Semua Status</option>
                                <option value="menunggu">Menunggu</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div>
                            <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">📅 Filter Tanggal</label>
                            <input type="date" name="date" id="date"
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200">
                        </div>
                        <div class="flex items-end">
                            <button onclick="resetFilters()" 
                                class="w-full px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-all duration-200 font-medium">
                                🔄 Reset Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports Grid -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">📊 Daftar Laporan</h2>
                    <p class="text-gray-600 mt-1">Total: {{ $laporan->total() }} laporan</p>
                </div>
                
                @if($laporan->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        Judul & Lokasi
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($laporan as $item)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <span class="text-blue-600 font-bold text-sm">{{ $loop->iteration }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm">
                                                <div class="font-semibold text-gray-900 mb-1">{{ Str::limit($item->judul, 40) }}</div>
                                                <div class="text-gray-500 text-xs">
                                                    📍 {{ $item->provinsi }}, {{ $item->kota }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $item->created_at->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                                {{ $item->status === 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $item->status === 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $item->status === 'selesai' ? 'bg-green-100 text-green-800' : '' }}">
                                                @if($item->status === 'menunggu')
                                                    ⏳ Menunggu
                                                @elseif($item->status === 'diproses')
                                                    🔄 Diproses
                                                @elseif($item->status === 'selesai')
                                                    ✅ Selesai
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('laporan.show', $item->id) }}"
                                                    class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200 text-xs font-medium">
                                                    👁️ Detail
                                                </a>
                                                @if($item->status === 'menunggu')
                                                    <a href="{{ route('laporan.edit', $item->id) }}"
                                                        class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors duration-200 text-xs font-medium">
                                                        ✏️ Edit
                                                    </a>
                                                    <form action="{{ route('laporan.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200 text-xs font-medium">
                                                            🗑️ Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Laporan</h3>
                        <p class="text-gray-500 mb-6">Anda belum membuat laporan pengaduan. Mulai buat laporan pertama Anda!</p>
                        <a href="{{ route('laporan.create') }}"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl shadow-lg hover:bg-blue-700 hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Buat Laporan Pertama
                        </a>
                    </div>
                @endif
                
                @if($laporan->hasPages())
                    <div class="px-8 py-6 border-t border-gray-200 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Menampilkan {{ $laporan->firstItem() }} - {{ $laporan->lastItem() }} dari {{ $laporan->total() }} laporan
                            </div>
                            <div class="pagination-wrapper">
                                {{ $laporan->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Filter functionality
            const statusFilter = document.getElementById('status');
            const dateFilter = document.getElementById('date');

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

                window.location.href = url.toString();
            }

            function resetFilters() {
                const url = new URL(window.location.href);
                url.searchParams.delete('status');
                url.searchParams.delete('date');
                window.location.href = url.toString();
            }

            statusFilter.addEventListener('change', applyFilters);
            dateFilter.addEventListener('change', applyFilters);

            // Set initial values from URL params
            const urlParams = new URLSearchParams(window.location.search);
            statusFilter.value = urlParams.get('status') || '';
            dateFilter.value = urlParams.get('date') || '';
        </script>
    @endpush
@endsection
