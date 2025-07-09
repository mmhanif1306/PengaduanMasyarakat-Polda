<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Pengaduan Masyarakat</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-polda.png') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        display: ['Instrument Sans', 'Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        secondary: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-down': 'slideDown 0.3s ease-out',
                        'bounce-subtle': 'bounceSubtle 2s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(-10px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        slideDown: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(-10px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        bounceSubtle: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-5px)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <!-- Axios via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        // Add CSRF token to all Axios requests
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.content;
        } else {
            console.error('CSRF token not found');
        }
    </script>
</head>

<body class="bg-gradient-to-br from-primary-50 via-white to-secondary-50 min-h-screen">
    <!-- Navigation -->
    <nav
        class="bg-gradient-to-r from-primary-800 via-primary-700 to-primary-600 text-white shadow-xl backdrop-blur-sm border-b border-primary-500/20 relative z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="/"
                            class="flex items-center space-x-2 text-lg sm:text-xl font-display font-bold hover:scale-105 transition-transform duration-200">
                            <img src="{{ asset('images/logo-polda.png') }}" alt="Logo Polda"
                                class="w-8 h-8 object-contain">
                            <span class="bg-gradient-to-r from-white to-primary-100 bg-clip-text text-transparent">
                                <span class="hidden sm:inline">Pengaduan Masyarakat</span>
                                <span class="sm:hidden">Pengaduan Masyarakat</span>
                            </span>
                        </a>
                    </div>
                    @auth
                        <div class="hidden md:ml-6 md:flex md:space-x-2">
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}"
                                    class="group relative px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'text-white bg-white/20 border border-white/30' : 'text-white/90 hover:text-white' }} transition-all duration-200 hover:bg-white/10 backdrop-blur-sm">
                                    <span class="relative z-10">Dashboard Admin</span>
                                    @if (request()->routeIs('admin.dashboard'))
                                        <div
                                            class="absolute inset-0 rounded-lg bg-gradient-to-r from-white/10 to-white/20 opacity-100">
                                        </div>
                                    @else
                                        <div
                                            class="absolute inset-0 rounded-lg bg-gradient-to-r from-white/5 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        </div>
                                    @endif
                                </a>
                                <a href="{{ route('admin.laporan.index') }}"
                                    class="group relative px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.laporan.*') ? 'text-white bg-white/20 border border-white/30' : 'text-white/90 hover:text-white' }} transition-all duration-200 hover:bg-white/10 backdrop-blur-sm">
                                    <span class="relative z-10">Manajemen Laporan</span>
                                    @if (request()->routeIs('admin.laporan.*'))
                                        <div
                                            class="absolute inset-0 rounded-lg bg-gradient-to-r from-white/10 to-white/20 opacity-100">
                                        </div>
                                    @else
                                        <div
                                            class="absolute inset-0 rounded-lg bg-gradient-to-r from-white/5 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        </div>
                                    @endif
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}"
                                    class="group relative px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-white bg-white/20 border border-white/30' : 'text-white/90 hover:text-white' }} transition-all duration-200 hover:bg-white/10 backdrop-blur-sm">
                                    <span class="relative z-10">Dashboard</span>
                                    @if (request()->routeIs('dashboard'))
                                        <div
                                            class="absolute inset-0 rounded-lg bg-gradient-to-r from-white/10 to-white/20 opacity-100">
                                        </div>
                                    @else
                                        <div
                                            class="absolute inset-0 rounded-lg bg-gradient-to-r from-white/5 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        </div>
                                    @endif
                                </a>
                                <a href="{{ route('laporan.create') }}"
                                    class="group relative px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('laporan.create') ? 'text-white bg-white/20 border border-white/30' : 'text-white/90 hover:text-white' }} transition-all duration-200 hover:bg-white/10 backdrop-blur-sm">
                                    <span class="relative z-10">Buat Laporan</span>
                                    @if (request()->routeIs('laporan.create'))
                                        <div
                                            class="absolute inset-0 rounded-lg bg-gradient-to-r from-white/10 to-white/20 opacity-100">
                                        </div>
                                    @else
                                        <div
                                            class="absolute inset-0 rounded-lg bg-gradient-to-r from-white/5 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        </div>
                                    @endif
                                </a>
                                <a href="{{ route('laporan.index') }}"
                                    class="group relative px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('laporan.index') || request()->routeIs('laporan.show') || request()->routeIs('laporan.edit') ? 'text-white bg-white/20 border border-white/30' : 'text-white/90 hover:text-white' }} transition-all duration-200 hover:bg-white/10 backdrop-blur-sm">
                                    <span class="relative z-10">Laporan Saya</span>
                                    @if (request()->routeIs('laporan.index') || request()->routeIs('laporan.show') || request()->routeIs('laporan.edit'))
                                        <div
                                            class="absolute inset-0 rounded-lg bg-gradient-to-r from-white/10 to-white/20 opacity-100">
                                        </div>
                                    @else
                                        <div
                                            class="absolute inset-0 rounded-lg bg-gradient-to-r from-white/5 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        </div>
                                    @endif
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}"
                            class="group relative px-4 py-2 rounded-lg text-sm font-medium text-white/90 hover:text-white transition-all duration-200 hover:bg-white/10 backdrop-blur-sm">
                            <span class="relative z-10">Masuk</span>
                            <div
                                class="absolute inset-0 rounded-lg bg-gradient-to-r from-white/5 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            </div>
                        </a>
                        <a href="/register"
                            class="group relative px-4 py-2 rounded-lg text-sm font-medium bg-white/10 text-white hover:bg-white/20 transition-all duration-200 backdrop-blur-sm border border-white/20 hover:border-white/30">
                            <span class="relative z-10">Daftar</span>
                            <div
                                class="absolute inset-0 rounded-lg bg-gradient-to-r from-white/5 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            </div>
                        </a>
                    @else
                        @if (auth()->user()->role !== 'admin')
                            <!-- Notification Bell -->
                            <div class="relative">
                                <button type="button" id="notification-button"
                                    class="group relative p-2 rounded-lg text-white/90 hover:text-white transition-all duration-200 hover:bg-white/10 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-white/20">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                    </svg>
                                    <!-- Notification Badge -->
                                    <span id="notification-badge"
                                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium hidden">
                                        0
                                    </span>
                                </button>

                                <!-- Notification Dropdown -->
                                <div id="notification-dropdown"
                                    class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-gray-200 z-50 max-h-96 overflow-hidden">
                                    <div class="p-4 border-b border-gray-100">
                                        <h3 class="text-lg font-semibold text-gray-900">Notifikasi</h3>
                                    </div>
                                    <div id="notification-list" class="max-h-64 overflow-y-auto">
                                        <!-- Notifications will be loaded here -->
                                    </div>
                                    <div class="p-3 border-t border-gray-100 text-center">
                                        <a href="{{ route('notifikasi.index') }}"
                                            class="text-primary-600 hover:text-primary-700 text-sm font-medium">Lihat Semua
                                            Notifikasi</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="relative">
                            <button type="button"
                                class="group flex items-center space-x-3 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-white/20 transition-all duration-200 hover:bg-white/10 px-3 py-2"
                                id="user-menu-button">
                                <span class="sr-only">Open user menu</span>
                                @if (auth()->user()->url_file)
                                    <img src="{{ auth()->user()->url_file }}" alt="Profile"
                                        class="h-8 w-8 rounded-lg object-cover border border-white/20 group-hover:border-white/30 transition-all duration-200">
                                @else
                                    <div
                                        class="h-8 w-8 rounded-lg bg-gradient-to-br from-white/20 to-white/10 flex items-center justify-center text-white font-semibold border border-white/20 group-hover:border-white/30 transition-all duration-200">
                                        {{ substr(auth()->user()->nama ?? auth()->user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <span
                                    class="hidden lg:block text-white/90 group-hover:text-white font-medium">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 text-white/70 group-hover:text-white transition-colors duration-200"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div class="hidden origin-top-right absolute right-0 mt-3 w-56 rounded-xl shadow-xl py-2 bg-white backdrop-blur-md ring-1 ring-black/5 border border-white/20 z-50 transform opacity-0 scale-95 transition-all duration-200 ease-out"
                                id="user-menu">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="{{ route('profile') }}"
                                    class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-primary-500"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="group flex items-center w-full px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-red-500"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/20 transition-all duration-200"
                        id="mobile-menu-button">
                        <span class="sr-only">Open main menu</span>
                        <!-- Hamburger icon -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            id="hamburger-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Close icon -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            id="close-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-primary-900/50 backdrop-blur-sm border-t border-white/10">
                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.dashboard') ? 'text-white bg-white/20 border border-white/30' : 'text-white/90 hover:text-white' }} hover:bg-white/10 transition-all duration-200">
                            Dashboard Admin
                        </a>
                        <a href="{{ route('admin.laporan.index') }}"
                            class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('admin.laporan.*') ? 'text-white bg-white/20 border border-white/30' : 'text-white/90 hover:text-white' }} hover:bg-white/10 transition-all duration-200">
                            Manajemen Laporan
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}"
                            class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('dashboard') ? 'text-white bg-white/20 border border-white/30' : 'text-white/90 hover:text-white' }} hover:bg-white/10 transition-all duration-200">
                            Dashboard
                        </a>
                        <a href="{{ route('laporan.create') }}"
                            class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('laporan.create') ? 'text-white bg-white/20 border border-white/30' : 'text-white/90 hover:text-white' }} hover:bg-white/10 transition-all duration-200">
                            Buat Laporan
                        </a>
                        <a href="{{ route('laporan.index') }}"
                            class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('laporan.index') || request()->routeIs('laporan.show') || request()->routeIs('laporan.edit') ? 'text-white bg-white/20 border border-white/30' : 'text-white/90 hover:text-white' }} hover:bg-white/10 transition-all duration-200">
                            Laporan Saya
                        </a>
                    @endif
                    <div class="border-t border-white/20 pt-3 mt-3">
                        <div class="flex items-center px-3 py-2">
                            @if (auth()->user()->url_file)
                                <img src="{{ auth()->user()->url_file }}" alt="Profile"
                                    class="h-8 w-8 rounded-lg object-cover border border-white/20">
                            @else
                                <div
                                    class="h-8 w-8 rounded-lg bg-gradient-to-br from-white/20 to-white/10 flex items-center justify-center text-white font-semibold border border-white/20">
                                    {{ substr(auth()->user()->nama ?? auth()->user()->name, 0, 1) }}
                                </div>
                            @endif
                            <div class="ml-3">
                                <div class="text-base font-medium text-white">{{ auth()->user()->name }}</div>
                                <div class="text-sm text-white/70">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        <a href="#"
                            class="block px-3 py-2 rounded-lg text-base font-medium text-white/90 hover:text-white hover:bg-white/10 transition-all duration-200">
                            Profile
                        </a>
                        <form method="POST" action="#">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-3 py-2 rounded-lg text-base font-medium text-white/90 hover:text-white hover:bg-red-500/20 transition-all duration-200">
                                Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 rounded-lg text-base font-medium text-white/90 hover:text-white hover:bg-white/10 transition-all duration-200">
                        Masuk
                    </a>
                    <a href="/register"
                        class="block px-3 py-2 rounded-lg text-base font-medium bg-white/10 text-white hover:bg-white/20 transition-all duration-200 border border-white/20">
                        Daftar
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Decorative Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div
            class="absolute -top-40 -right-40 w-80 h-80 bg-primary-200/20 rounded-full blur-3xl animate-bounce-subtle">
        </div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-secondary-200/20 rounded-full blur-3xl animate-bounce-subtle"
            style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-primary-100/10 rounded-full blur-3xl animate-bounce-subtle"
            style="animation-delay: 2s;"></div>
    </div>

    <!-- Page Content -->
    <main class="relative min-h-screen">
        <div class="animate-fade-in">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="relative bg-gradient-to-r from-secondary-800 via-secondary-700 to-secondary-600 text-white">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4 sm:px-6 lg:px-8">
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo-polda.png') }}" alt="Logo Polda"
                            class="w-8 h-8 object-contain">
                        <h3 class="text-lg font-display font-bold">Pengaduan Masyarakat</h3>
                    </div>
                    <p class="text-white/80 text-sm leading-relaxed">
                        Platform digital untuk menyampaikan aspirasi dan pengaduan masyarakat kepada pihak berwenang
                        dengan mudah dan transparan.
                    </p>
                </div>
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="/"
                                class="text-white/80 hover:text-white transition-colors duration-200 text-sm">Beranda</a>
                        </li>
                        @auth
                            @if (auth()->user()->role === 'user')
                                <li><a href="{{ route('dashboard') }}"
                                        class="text-white/80 hover:text-white transition-colors duration-200 text-sm">Dashboard</a>
                                </li>
                            @endif
                        @endauth
                        <li><a href="#"
                                class="text-white/80 hover:text-white transition-colors duration-200 text-sm">Buat
                                Laporan</a></li>
                        <li><a href="#"
                                class="text-white/80 hover:text-white transition-colors duration-200 text-sm">Riwayat
                                Laporan</a></li>
                        <li><a href="#"
                                class="text-white/80 hover:text-white transition-colors duration-200 text-sm">Bantuan</a>
                        </li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold">Kontak</h4>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <span class="text-white/80 text-sm">pengaduan@polda.go.id</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-white/80 text-sm">Polda Metro Jaya</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/20 mt-8 pt-8 text-center px-4 sm:px-6 lg:px-8">
                <p class="text-white/60 text-sm">
                    © {{ date('Y') }} Pengaduan Masyarakat Polda. Semua hak dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Toggle dropdown menu
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        if (userMenuButton && userMenu) {
            userMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                const isHidden = userMenu.classList.contains('hidden');

                if (isHidden) {
                    // Show dropdown
                    userMenu.classList.remove('hidden');
                    setTimeout(() => {
                        userMenu.classList.remove('opacity-0', 'scale-95');
                        userMenu.classList.add('opacity-100', 'scale-100');
                    }, 10);
                } else {
                    // Hide dropdown
                    userMenu.classList.remove('opacity-100', 'scale-100');
                    userMenu.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        userMenu.classList.add('hidden');
                    }, 200);
                }
            });

            // Close menu when clicking outside
            document.addEventListener('click', (event) => {
                if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                    userMenu.classList.remove('opacity-100', 'scale-100');
                    userMenu.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        userMenu.classList.add('hidden');
                    }, 200);
                }
            });
        }

        // Toggle mobile menu
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                hamburgerIcon.classList.toggle('hidden');
                hamburgerIcon.classList.toggle('block');
                closeIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('block');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', (event) => {
                if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                    hamburgerIcon.classList.remove('hidden');
                    hamburgerIcon.classList.add('block');
                    closeIcon.classList.add('hidden');
                    closeIcon.classList.remove('block');
                }
            });
        }

        // Notification functionality
        @auth
        @if (auth()->user()->role !== 'admin')
            const notificationButton = document.getElementById('notification-button');
            const notificationDropdown = document.getElementById('notification-dropdown');
            const notificationBadge = document.getElementById('notification-badge');
            const notificationList = document.getElementById('notification-list');

            if (notificationButton && notificationDropdown) {
                // Toggle notification dropdown
                notificationButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isHidden = notificationDropdown.classList.contains('hidden');

                    if (isHidden) {
                        loadNotifications();
                        notificationDropdown.classList.remove('hidden');
                    } else {
                        notificationDropdown.classList.add('hidden');
                    }
                });

                // Close notification dropdown when clicking outside
                document.addEventListener('click', (event) => {
                    if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event
                        .target)) {
                        notificationDropdown.classList.add('hidden');
                    }
                });
            }

            // Load notifications
            function loadNotifications() {
                axios.get('{{ route('notifikasi.preview') }}')
                    .then(response => {
                        const data = response.data;
                        updateNotificationBadge(data.unread_count);
                        renderNotifications(data.notifikasis);
                    })
                    .catch(error => {
                        console.error('Error loading notifications:', error);
                        notificationList.innerHTML =
                            '<div class="p-4 text-center text-gray-500">Gagal memuat notifikasi</div>';
                    });
            }

            // Update notification badge
            function updateNotificationBadge(count) {
                if (count > 0) {
                    notificationBadge.textContent = count > 99 ? '99+' : count;
                    notificationBadge.classList.remove('hidden');
                } else {
                    notificationBadge.classList.add('hidden');
                }
            }

            // Render notifications
            function renderNotifications(notifications) {
                if (notifications.length === 0) {
                    notificationList.innerHTML = '<div class="p-4 text-center text-gray-500">Tidak ada notifikasi</div>';
                    return;
                }

                const notificationHTML = notifications.map(notification => {
                    const isUnread = !notification.is_read;
                    const timeAgo = formatTimeAgo(notification.created_at);

                    return `
                    <div class="notification-item p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors duration-200 ${ isUnread ? 'bg-blue-50' : '' }" 
                         data-id="${notification.id}" onclick="markAsReadAndShowPopup(${notification.id}, '${notification.judul}', '${notification.deskripsi}', '${timeAgo}')">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-2 h-2 rounded-full ${ isUnread ? 'bg-blue-500' : 'bg-gray-300' } mt-2"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">${notification.judul}</p>
                                <p class="text-sm text-gray-500 truncate">${notification.deskripsi}</p>
                                <p class="text-xs text-gray-400 mt-1">${timeAgo}</p>
                            </div>
                        </div>
                    </div>
                `;
                }).join('');

                notificationList.innerHTML = notificationHTML;
            }

            // Mark notification as read and show popup
            function markAsReadAndShowPopup(id, judul, deskripsi, timeAgo) {
                // Mark as read
                axios.put(`/notifikasi/${id}/read`)
                    .then(response => {
                        // Update UI to show as read
                        const notificationItem = document.querySelector(`[data-id="${id}"]`);
                        if (notificationItem) {
                            notificationItem.classList.remove('bg-blue-50');
                            const indicator = notificationItem.querySelector('.w-2.h-2');
                            if (indicator) {
                                indicator.classList.remove('bg-blue-500');
                                indicator.classList.add('bg-gray-300');
                            }
                        }

                        // Update badge count
                        loadNotifications();

                        // Show popup
                        showNotificationPopup(judul, deskripsi, timeAgo);
                    })
                    .catch(error => {
                        console.error('Error marking notification as read:', error);
                        // Still show popup even if marking as read fails
                        showNotificationPopup(judul, deskripsi, timeAgo);
                    });
            }

            // Show notification popup
            function showNotificationPopup(judul, deskripsi, timeAgo) {
                // Create popup HTML
                const popupHTML = `
                <div id="notification-popup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Detail Notifikasi</h3>
                                <button onclick="closeNotificationPopup()" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <h4 class="font-medium text-gray-900">${judul}</h4>
                                </div>
                                <div>
                                    <p class="text-gray-600">${deskripsi}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-400">${timeAgo}</p>
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <button onclick="closeNotificationPopup()" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors duration-200">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

                // Add popup to body
                document.body.insertAdjacentHTML('beforeend', popupHTML);

                // Animate popup
                setTimeout(() => {
                    const popup = document.getElementById('notification-popup');
                    const content = popup.querySelector('.bg-white');
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            }

            // Close notification popup
            function closeNotificationPopup() {
                const popup = document.getElementById('notification-popup');
                if (popup) {
                    const content = popup.querySelector('.bg-white');
                    content.classList.remove('scale-100', 'opacity-100');
                    content.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        popup.remove();
                    }, 300);
                }
            }

            // Format time ago
            function formatTimeAgo(dateString) {
                const date = new Date(dateString);
                const now = new Date();
                const diffInSeconds = Math.floor((now - date) / 1000);

                if (diffInSeconds < 60) {
                    return 'Baru saja';
                } else if (diffInSeconds < 3600) {
                    const minutes = Math.floor(diffInSeconds / 60);
                    return `${minutes} menit yang lalu`;
                } else if (diffInSeconds < 86400) {
                    const hours = Math.floor(diffInSeconds / 3600);
                    return `${hours} jam yang lalu`;
                } else {
                    const days = Math.floor(diffInSeconds / 86400);
                    return `${days} hari yang lalu`;
                }
            }

            // Load notifications on page load
            document.addEventListener('DOMContentLoaded', function() {
                loadNotifications();

                // Refresh notifications every 30 seconds
                setInterval(loadNotifications, 30000);
            });
        @endif
        @endauth
    </script>

    @stack('scripts')
</body>

</html>
