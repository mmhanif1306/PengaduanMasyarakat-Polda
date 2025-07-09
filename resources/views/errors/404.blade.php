@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full space-y-8 text-center py-10">
        <!-- Error Icon -->
        <div class="flex justify-center">
            <div class="bg-gradient-to-br from-red-100 to-red-50 rounded-full p-8 shadow-lg">
                <svg class="h-24 w-24 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
            </div>
        </div>

        <!-- Error Code -->
        <div>
            <h1 class="text-9xl font-bold text-gray-900 tracking-tight">404</h1>
            <h2 class="mt-4 text-3xl font-bold text-gray-900 sm:text-4xl">Halaman Tidak Ditemukan</h2>
            <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin halaman tersebut telah dipindahkan, dihapus, atau URL yang Anda masukkan salah.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
            <a href="{{ url('/') }}"
                class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <svg class="mr-2 h-5 w-5 transition-transform group-hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Kembali ke Beranda
            </a>
            
            <button onclick="history.back()"
                class="group inline-flex items-center px-6 py-3 bg-white text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300 font-semibold border border-gray-300 shadow-sm hover:shadow-md">
                <svg class="mr-2 h-5 w-5 transition-transform group-hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                Kembali
            </button>
        </div>

        <!-- Help Section -->
        <div class="mt-12 p-6 bg-white rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Butuh Bantuan?</h3>
            <p class="text-sm text-gray-600 mb-4">
                Jika Anda yakin halaman ini seharusnya ada, silakan hubungi administrator atau coba:
            </p>
            <ul class="text-sm text-gray-600 space-y-2 text-left">
                <li class="flex items-center">
                    <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Periksa kembali URL yang Anda masukkan
                </li>
                <li class="flex items-center">
                    <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Gunakan menu navigasi untuk mencari halaman yang diinginkan
                </li>
                <li class="flex items-center">
                    <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Hubungi tim support jika masalah berlanjut
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection