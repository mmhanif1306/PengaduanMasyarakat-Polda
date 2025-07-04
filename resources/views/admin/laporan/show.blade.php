@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ route('admin.laporan.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 4.158a.75.75 0 11-1.06 1.06l-5.5-5.5a.75.75 0 010-1.06l5.5-5.5a.75.75 0 111.06 1.06L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
                </svg>
                Kembali ke Daftar Laporan
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="lg:flex lg:items-center lg:justify-between">
                    <div class="min-w-0 flex-1">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                            {{ $laporan->judul }}
                        </h2>
                        <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" />
                                </svg>
                                {{ $laporan->user->name }}
                            </div>
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
                                </svg>
                                {{ $laporan->lokasi }}
                            </div>
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                                </svg>
                                {{ $laporan->tanggal_kejadian }}
                            </div>
                            <div class="mt-2 flex items-center text-sm">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                    {{ $laporan->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $laporan->status === 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $laporan->status === 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $laporan->status === 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($laporan->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Isi Laporan -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900">Isi Laporan</h3>
                    <div class="mt-4 whitespace-pre-wrap text-gray-700">
                        {{ $laporan->isi }}
                    </div>
                </div>

                <!-- Bukti -->
                @if($laporan->bukti)
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900">Bukti</h3>
                    <div class="mt-4">
                        @if(Str::endsWith($laporan->bukti, ['.jpg', '.jpeg', '.png', '.gif']))
                            <img src="{{ Storage::url($laporan->bukti) }}" alt="Bukti laporan" class="max-w-lg rounded-lg shadow-sm">
                        @else
                            <a href="{{ Storage::url($laporan->bukti) }}" target="_blank" 
                                class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                                <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.75 2.75a.75.75 0 00-1.5 0v8.614L6.295 8.235a.75.75 0 10-1.09 1.03l4.25 4.5a.75.75 0 001.09 0l4.25-4.5a.75.75 0 00-1.09-1.03l-2.955 3.129V2.75z" />
                                    <path d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z" />
                                </svg>
                                Download Bukti
                            </a>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Form Update Status -->
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h3 class="text-lg font-medium text-gray-900">Update Status Laporan</h3>
                    <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PUT')

                        <div class="sm:col-span-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="pending" {{ $laporan->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="diproses" {{ $laporan->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ $laporan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ $laporan->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">
                                Keterangan Update
                            </label>
                            <div class="mt-1">
                                <textarea id="keterangan" name="keterangan" rows="3" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    placeholder="Berikan keterangan terkait update status..."></textarea>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end space-x-4">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Update Status
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Riwayat Update -->
                @if($laporan->notifikasi && $laporan->notifikasi->count() > 0)
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h3 class="text-lg font-medium text-gray-900">Riwayat Update</h3>
                    <div class="mt-4 flow-root">
                        <ul role="list" class="-mb-8">
                            @foreach($laporan->notifikasi->sortByDesc('created_at') as $notifikasi)
                            <li>
                                <div class="relative pb-8">
                                    @if(!$loop->last)
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white
                                                {{ $notifikasi->status === 'pending' ? 'bg-yellow-500' : '' }}
                                                {{ $notifikasi->status === 'diproses' ? 'bg-blue-500' : '' }}
                                                {{ $notifikasi->status === 'selesai' ? 'bg-green-500' : '' }}
                                                {{ $notifikasi->status === 'ditolak' ? 'bg-red-500' : '' }}">
                                                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 01-9.201 2.466l-.312-.311h2.433a.75.75 0 000-1.5H3.989a.75.75 0 00-.75.75v4.242a.75.75 0 001.5 0v-2.43l.31.31a7 7 0 0011.712-3.138.75.75 0 00-1.449-.39zm1.23-3.723a.75.75 0 00.219-.53V2.929a.75.75 0 00-1.5 0V5.36l-.31-.31A7 7 0 003.239 8.188a.75.75 0 101.448.389A5.5 5.5 0 0113.89 6.11l.311.31h-2.432a.75.75 0 000 1.5h4.243a.75.75 0 00.53-.219z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm text-gray-500">Status diubah menjadi <span class="font-medium text-gray-900">{{ ucfirst($notifikasi->status) }}</span></p>
                                                @if($notifikasi->keterangan)
                                                    <p class="mt-1 text-sm text-gray-700">{{ $notifikasi->keterangan }}</p>
                                                @endif
                                            </div>
                                            <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                                <time datetime="{{ $notifikasi->created_at }}">{{ $notifikasi->created_at->diffForHumans() }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 