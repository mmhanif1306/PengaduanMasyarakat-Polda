@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<!-- Hero Section -->
<div class="relative min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50 overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-40 left-40 w-80 h-80 bg-primary-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
        
        <!-- Additional decorative elements -->
        <div class="absolute top-20 right-20 w-16 h-16 bg-gradient-to-br from-primary-200 to-primary-300 rounded-full opacity-30 animate-pulse"></div>
        <div class="absolute bottom-32 right-32 w-12 h-12 bg-gradient-to-br from-secondary-200 to-secondary-300 rounded-full opacity-40 animate-bounce"></div>
        <div class="absolute top-1/3 right-1/4 w-8 h-8 bg-gradient-to-br from-green-200 to-green-300 rounded-full opacity-50 animate-ping"></div>
        
        <!-- Police and Justice themed icons -->
        <div class="absolute top-1/2 left-20 animate-float" style="animation-delay: 3s;">
            <svg class="w-10 h-10 text-blue-300 opacity-40" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L3 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.734.99A.996.996 0 0118 6v2a1 1 0 11-2 0v-.277l-1.254.145a1 1 0 11-.992-1.736L14.984 6l-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.723V12a1 1 0 11-2 0v-1.277l-1.246-.855a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.277l1.246.855a1 1 0 11-.992 1.736L3 15.723V16a1 1 0 11-2 0v-2a.996.996 0 01.52-.878L3 11zm14 0a1 1 0 01.52.878L18 14v2a1 1 0 11-2 0v-.277l-1.254-.145a1 1 0 11.992-1.736L16.984 14l-.23-.132A1 1 0 0117 11z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="absolute bottom-20 right-1/4 animate-float" style="animation-delay: 4s;">
            <svg class="w-8 h-8 text-yellow-400 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
        </div>
        
        <!-- Floating icons -->
        <div class="absolute top-1/4 left-1/4 animate-float">
            <svg class="w-8 h-8 text-primary-300 opacity-60" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zM6 5v6h8V5H6z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="absolute top-2/3 right-1/3 animate-float" style="animation-delay: 1s;">
            <svg class="w-6 h-6 text-secondary-300 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-4 1-1-4 .257-.257A6 6 0 1118 8zm-6-4a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="absolute bottom-1/4 left-1/3 animate-float" style="animation-delay: 2s;">
            <svg class="w-7 h-7 text-green-300 opacity-40" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Logo and Title -->
            <div class="mb-8 animate-fade-in">
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/logo-polda.png') }}" alt="Logo Polda" class="w-20 h-20 object-contain">
                </div>
                <h1 class="text-4xl md:text-6xl font-bold bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text text-transparent mb-4 leading-tight py-2">
                    Pengaduan Masyarakat
                </h1>
                <p class="text-xl md:text-2xl text-gray-600 mb-8 max-w-3xl mx-auto">
                    Platform digital untuk menyampaikan aspirasi dan keluhan masyarakat kepada Kepolisian Daerah
                </p>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12 animate-slide-down">
                @guest
                    <a href="/register" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-primary-600 to-primary-700 rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="mr-2">Mulai Pengaduan</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="/login" class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-primary-700 bg-white border-2 border-primary-200 rounded-xl hover:bg-primary-50 hover:border-primary-300 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <span class="mr-2">Masuk</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                @else
                    <a href="#" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-primary-600 to-primary-700 rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="mr-2">Dashboard</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-20 bg-white scroll-animate" data-animation="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Mengapa Memilih Platform Kami?
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kami menyediakan layanan pengaduan yang mudah, cepat, dan terpercaya untuk masyarakat
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="scroll-animate" data-animation="fade-up" data-delay="100">
                <div class="group p-8 bg-gradient-to-br from-primary-50 to-primary-100 rounded-2xl hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Aman & Terpercaya</h3>
                    <p class="text-gray-600">Data pengaduan Anda dijamin aman dengan sistem keamanan berlapis dan enkripsi tingkat tinggi.</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="scroll-animate" data-animation="fade-up" data-delay="200">
                <div class="group p-8 bg-gradient-to-br from-secondary-50 to-secondary-100 rounded-2xl hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Proses Cepat</h3>
                    <p class="text-gray-600">Pengaduan Anda akan diproses dengan cepat dan mendapat tanggapan dalam waktu yang wajar.</p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="scroll-animate" data-animation="fade-up" data-delay="300">
                <div class="group p-8 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Transparan</h3>
                    <p class="text-gray-600">Pantau status pengaduan Anda secara real-time dengan sistem tracking yang transparan.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="py-20 bg-gradient-to-r from-primary-600 to-primary-800 scroll-animate" data-animation="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Kepercayaan Masyarakat
            </h2>
            <p class="text-xl text-primary-100 max-w-3xl mx-auto">
                Bergabunglah dengan ribuan masyarakat yang telah mempercayai platform kami
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center scroll-animate" data-animation="fade-up" data-delay="100">
                <div class="relative mb-4">
                    <svg class="w-12 h-12 text-white mx-auto mb-2 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="text-4xl md:text-5xl font-bold text-white mb-2 counter" data-target="1000">0</div>
                <div class="text-primary-200">Pengaduan Diproses</div>
            </div>
            <div class="text-center scroll-animate" data-animation="fade-up" data-delay="200">
                <div class="relative mb-4">
                    <svg class="w-12 h-12 text-white mx-auto mb-2 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="text-4xl md:text-5xl font-bold text-white mb-2 counter" data-target="95">0</div>
                <div class="text-primary-200">Tingkat Kepuasan</div>
            </div>
            <div class="text-center scroll-animate" data-animation="fade-up" data-delay="300">
                <div class="relative mb-4">
                    <svg class="w-12 h-12 text-white mx-auto mb-2 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">24/7</div>
                <div class="text-primary-200">Layanan Tersedia</div>
            </div>
            <div class="text-center scroll-animate" data-animation="fade-up" data-delay="400">
                <div class="relative mb-4">
                    <svg class="w-12 h-12 text-white mx-auto mb-2 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                    </svg>
                </div>
                <div class="text-4xl md:text-5xl font-bold text-white mb-2 counter" data-target="500">0</div>
                <div class="text-primary-200">Pengguna Aktif</div>
            </div>
        </div>
    </div>
</div>

<!-- How It Works Section -->
<div class="py-20 bg-gray-50 scroll-animate" data-animation="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Cara Menggunakan Platform
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Proses pengaduan yang mudah dalam 3 langkah sederhana
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="relative text-center scroll-animate" data-animation="fade-up" data-delay="100">
                <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <span class="text-2xl font-bold text-white">1</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Daftar & Masuk</h3>
                <p class="text-gray-600">Buat akun baru atau masuk dengan akun yang sudah ada untuk mulai menggunakan platform.</p>
                <!-- Arrow -->
                <div class="hidden md:block absolute top-10 -right-4 text-primary-300">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative text-center scroll-animate" data-animation="fade-up" data-delay="200">
                <div class="w-20 h-20 bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <span class="text-2xl font-bold text-white">2</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Buat Pengaduan</h3>
                <p class="text-gray-600">Isi formulir pengaduan dengan detail yang jelas dan lengkap beserta bukti pendukung.</p>
                <!-- Arrow -->
                <div class="hidden md:block absolute top-10 -right-4 text-secondary-300">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="text-center scroll-animate" data-animation="fade-up" data-delay="300">
                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <span class="text-2xl font-bold text-white">3</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Pantau Status</h3>
                <p class="text-gray-600">Pantau perkembangan pengaduan Anda dan terima notifikasi update secara real-time.</p>
            </div>
        </div>
    </div>
</div>

<style>
.scroll-animate {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease-out;
}

.scroll-animate.animate {
    opacity: 1;
    transform: translateY(0);
}

.scroll-animate[data-animation="fade-up"] {
    opacity: 0;
    transform: translateY(50px);
}

.scroll-animate[data-animation="fade-up"].animate {
    opacity: 1;
    transform: translateY(0);
}

/* Float animation for decorative icons */
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

/* Additional blob animation */
@keyframes blob {
    0%, 100% {
        transform: translate(0px, 0px) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    // Counter animation function
    function animateCounter(element, target, suffix = '') {
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current) + suffix;
        }, 20);
    }

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const delay = element.getAttribute('data-delay') || 0;
                
                setTimeout(() => {
                    element.classList.add('animate');
                    
                    // Check if this element contains counters
                    const counters = element.querySelectorAll('.counter');
                    counters.forEach(counter => {
                        const target = parseInt(counter.getAttribute('data-target'));
                        let suffix = '';
                        
                        // Add appropriate suffix based on target value
                        if (target === 1000) suffix = '+';
                        else if (target === 95) suffix = '%';
                        else if (target === 500) suffix = '+';
                        
                        // Start counter animation with additional delay
                        setTimeout(() => {
                            animateCounter(counter, target, suffix);
                        }, 500);
                    });
                }, delay);
                
                observer.unobserve(element);
            }
        });
    }, observerOptions);

    // Observe all scroll-animate elements
    document.querySelectorAll('.scroll-animate').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endsection
