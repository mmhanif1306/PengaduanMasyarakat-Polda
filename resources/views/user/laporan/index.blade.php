@extends('layouts.app')

@section('title', 'Laporan Saya')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">Laporan Saya</h1>
                            <p class="mt-2 text-sm text-gray-700">
                                Daftar laporan pengaduan yang telah Anda ajukan.
                            </p>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <a href="{{ route('user.laporan.create') }}"
                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:w-auto">
                                Buat Laporan Baru
                            </a>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Filter Status</label>
                            <select id="status" name="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="">Semua Status</option>
                                <option value="pending">Pending</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Filter Tanggal</label>
                            <input type="date" name="date" id="date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    ID</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Judul
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Lokasi
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Tanggal</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <span class="sr-only">Aksi</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @foreach ($laporan as $item)
                                                <tr>
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                        {{ $item->id }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        {{ $item->judul }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        {{ $item->lokasi }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        {{ $item->tanggal_kejadian }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                        <span
                                                            class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 
                                                    {{ $item->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                    {{ $item->status === 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                                    {{ $item->status === 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ $item->status === 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                                            {{ ucfirst($item->status) }}
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                        <a href="{{ route('user.laporan.show', $item->id) }}"
                                                            class="text-blue-600 hover:text-blue-900">
                                                            Detail<span class="sr-only">, laporan
                                                                {{ $item->id }}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $laporan->links() }}
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

            statusFilter.addEventListener('change', applyFilters);
            dateFilter.addEventListener('change', applyFilters);

            // Set initial values from URL params
            const urlParams = new URLSearchParams(window.location.search);
            statusFilter.value = urlParams.get('status') || '';
            dateFilter.value = urlParams.get('date') || '';
        </script>
    @endpush
@endsection
