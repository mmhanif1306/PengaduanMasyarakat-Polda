@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Buat Laporan Baru</h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    Silakan isi form berikut untuk membuat laporan pengaduan. Pastikan data yang diisi
                                    lengkap dan benar.
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form action="{{ route('user.laporan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <label for="judul" class="block text-sm font-medium text-gray-700">Judul
                                            Laporan</label>
                                        <div class="mt-1">
                                            <input type="text" name="judul" id="judul"
                                                class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                placeholder="Contoh: Pelanggaran Lalu Lintas di Jalan Raya"
                                                value="{{ old('judul') }}" required>
                                        </div>
                                        @error('judul')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6">
                                        <label for="isi" class="block text-sm font-medium text-gray-700">Isi
                                            Laporan</label>
                                        <div class="mt-1">
                                            <textarea id="isi" name="isi" rows="5"
                                                class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                placeholder="Jelaskan detail kejadian secara lengkap..." required>{{ old('isi') }}</textarea>
                                        </div>
                                        @error('isi')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6">
                                        <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi
                                            Kejadian</label>
                                        <div class="mt-1">
                                            <input type="text" name="lokasi" id="lokasi"
                                                class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                placeholder="Contoh: Jl. Sudirman No. 123, Jakarta Pusat"
                                                value="{{ old('lokasi') }}" required>
                                        </div>
                                        @error('lokasi')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6">
                                        <label for="tanggal_kejadian"
                                            class="block text-sm font-medium text-gray-700">Tanggal Kejadian</label>
                                        <div class="mt-1">
                                            <input type="date" name="tanggal_kejadian" id="tanggal_kejadian"
                                                class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                value="{{ old('tanggal_kejadian') }}" required>
                                        </div>
                                        @error('tanggal_kejadian')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6">
                                        <label for="bukti" class="block text-sm font-medium text-gray-700">Bukti
                                            (Foto/Dokumen)</label>
                                        <div class="mt-1">
                                            <input type="file" name="bukti" id="bukti"
                                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                                accept="image/*,.pdf">
                                            <p class="mt-1 text-sm text-gray-500">
                                                Format yang diterima: JPG, PNG, PDF. Maksimal 5MB.
                                            </p>
                                        </div>
                                        @error('bukti')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <button type="submit"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        Kirim Laporan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
