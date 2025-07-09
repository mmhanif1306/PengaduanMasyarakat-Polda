@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full space-y-8 text-center py-10">
        <!-- Error Icon -->
        <div class="flex justify-center">
            <div class="bg-gradient-to-br from-orange-100 to-orange-50 rounded-full p-8 shadow-lg">
                <svg class="h-24 w-24 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                </svg>
            </div>
        </div>

        <!-- Error Code -->
        <div>
            <h1 class="text-9xl font-bold text-gray-900 tracking-tight">403</h1>
            <h2 class="mt-4 text-3xl font-bold text-gray-900 sm:text-4xl">Akses Ditolak</h2>
            <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.
            </p>
        </div>

        <!-- Permission Info -->
        <div class="bg-orange-50 border border-orange-200 rounded-xl p-6">
            <div class="flex items-center justify-center mb-3">
                <svg class="h-6 w-6 text-orange-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
                <h3 class="text-lg font-semibold text-orange-800">Akses Terbatas</h3>
            </div>
            <p class="text-sm text-orange-700">
                Halaman ini memerlukan tingkat akses khusus. Pastikan Anda telah login dengan akun yang memiliki hak akses yang sesuai.
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
            
            @guest
                <a href="{{ route('login') }}"
                    class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="mr-2 h-5 w-5 transition-transform group-hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    Login
                </a>
            @else
                <button onclick="history.back()"
                    class="group inline-flex items-center px-6 py-3 bg-white text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300 font-semibold border border-gray-300 shadow-sm hover:shadow-md">
                    <svg class="mr-2 h-5 w-5 transition-transform group-hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    Kembali
                </button>
            @endguest
        </div>

        <!-- Help Section -->
        <div class="mt-12 p-6 bg-white rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Mengapa Saya Melihat Halaman Ini?</h3>
            <div class="text-sm text-gray-600 space-y-3 text-left">
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-orange-500 mr-3 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <div>
                        <p class="font-medium text-gray-900">Akun Tidak Memiliki Izin</p>
                        <p class="text-gray-600">Akun Anda mungkin tidak memiliki role atau permission yang diperlukan untuk mengakses halaman ini.</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-orange-500 mr-3 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="font-medium text-gray-900">Sesi Telah Berakhir</p>
                        <p class="text-gray-600">Sesi login Anda mungkin telah berakhir. Silakan login kembali untuk melanjutkan.</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-orange-500 mr-3 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                    </svg>
                    <div>
                        <p class="font-medium text-gray-900">Halaman Khusus Admin</p>
                        <p class="text-gray-600">Halaman ini mungkin hanya dapat diakses oleh administrator sistem.</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <p class="text-sm text-blue-800">
                    <strong>Perlu bantuan?</strong> Hubungi administrator sistem di 
                    <a href="mailto:pengaduan@polda.go.id" class="font-medium underline hover:no-underline">pengaduan@polda.go.id</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection