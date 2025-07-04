<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pengaduan Masyarakat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-xl font-bold">
                            Pengaduan Masyarakat
                        </a>
                    </div>
                    @auth
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.laporan') }}" class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                                    Manajemen Laporan
                                </a>
                            @else
                                <a href="{{ route('user.laporan.create') }}" class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                                    Buat Laporan
                                </a>
                                <a href="{{ route('user.laporan') }}" class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                                    Laporan Saya
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>
                <div class="flex items-center">
                    @guest
                        <a href="{{ route('login') }}" class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium">Daftar</a>
                    @else
                        <div class="ml-3 relative">
                            <div class="relative">
                                <button type="button" class="flex text-sm rounded-full focus:outline-none" id="user-menu-button">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                </button>
                                <!-- Dropdown menu -->
                                <div class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" id="user-menu">
                                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <script>
        // Toggle dropdown menu
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');
        
        if (userMenuButton && userMenu) {
            userMenuButton.addEventListener('click', () => {
                userMenu.classList.toggle('hidden');
            });

            // Close menu when clicking outside
            document.addEventListener('click', (event) => {
                if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                    userMenu.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html> 