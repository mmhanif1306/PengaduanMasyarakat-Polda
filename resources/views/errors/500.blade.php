@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full space-y-8 text-center py-10">
        <!-- Error Icon -->
        <div class="flex justify-center">
            <div class="bg-gradient-to-br from-red-100 to-red-50 rounded-full p-8 shadow-lg">
                <svg class="h-24 w-24 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-6.75 0h13.5m-13.5 0a3 3 0 003 3h7.5a3 3 0 003-3m-13.5 0V5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25v13.5M6 9h12" />
                </svg>
            </div>
        </div>

        <!-- Error Code -->
        <div>
            <h1 class="text-9xl font-bold text-gray-900 tracking-tight">500</h1>
            <h2 class="mt-4 text-3xl font-bold text-gray-900 sm:text-4xl">Terjadi Kesalahan Server</h2>
            <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                Maaf, terjadi kesalahan internal pada server. Tim teknis kami telah diberitahu dan sedang menangani masalah ini.
            </p>
        </div>

        <!-- Error Info -->
        <div class="bg-red-50 border border-red-200 rounded-xl p-6">
            <div class="flex items-center justify-center mb-3">
                <svg class="h-6 w-6 text-red-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
                <h3 class="text-lg font-semibold text-red-800">Kesalahan Sistem</h3>
            </div>
            <p class="text-sm text-red-700">
                Server mengalami masalah teknis sementara. Silakan coba lagi dalam beberapa menit atau hubungi administrator jika masalah berlanjut.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
            <button onclick="location.reload()"
                class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <svg class="mr-2 h-5 w-5 transition-transform group-hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                Coba Lagi
            </button>
            
            <a href="{{ url('/') }}"
                class="group inline-flex items-center px-6 py-3 bg-white text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300 font-semibold border border-gray-300 shadow-sm hover:shadow-md">
                <svg class="mr-2 h-5 w-5 transition-transform group-hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Kembali ke Beranda
            </button>
        </div>

        <!-- Help Section -->
        <div class="mt-12 p-6 bg-white rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Apa yang Terjadi?</h3>
            <div class="text-sm text-gray-600 space-y-3 text-left">
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-red-500 mr-3 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3V6a3 3 0 013-3h13.5a3 3 0 013 3v5.25a3 3 0 01-3 3m-16.5 0a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25h15a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25h-15z" />
                    </svg>
                    <div>
                        <p class="font-medium text-gray-900">Masalah Server Internal</p>
                        <p class="text-gray-600">Terjadi kesalahan pada sistem yang sedang kami perbaiki.</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-red-500 mr-3 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="font-medium text-gray-900">Gangguan Sementara</p>
                        <p class="text-gray-600">Masalah ini bersifat sementara dan akan segera diperbaiki.</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-red-500 mr-3 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <div>
                        <p class="font-medium text-gray-900">Tim Teknis Diberitahu</p>
                        <p class="text-gray-600">Administrator telah menerima notifikasi dan sedang menangani masalah ini.</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <p class="text-sm text-blue-800">
                    <strong>Laporkan masalah:</strong> Jika masalah berlanjut, hubungi kami di 
                    <a href="mailto:pengaduan@polda.go.id" class="font-medium underline hover:no-underline">pengaduan@polda.go.id</a>
                    dengan menyertakan waktu kejadian dan aktivitas yang sedang dilakukan.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection