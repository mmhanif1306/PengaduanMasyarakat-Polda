@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="min-h-screen flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8 relative">
    <!-- Background decoration -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-primary-200/30 rounded-full blur-3xl animate-bounce-subtle"></div>
        <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-secondary-200/30 rounded-full blur-3xl animate-bounce-subtle" style="animation-delay: 1s;"></div>
    </div>
    
    <div class="relative sm:mx-auto sm:w-full sm:max-w-md">
        <!-- Logo/Icon -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo-polda.png') }}" alt="Logo Polda" class="w-16 h-16 object-contain">
        </div>
        
        <h2 class="text-center text-3xl font-display font-bold tracking-tight text-gray-900">
            Selamat Datang Kembali
        </h2>
        <p class="mt-3 text-center text-sm text-gray-600">
            Belum memiliki akun?
            <a href="\register" class="font-semibold text-primary-600 hover:text-primary-500 transition-colors duration-200">
                Daftar sekarang
            </a>
        </p>
    </div>

    <div class="pb mt-8 sm:mx-auto sm:w-full sm:max-w-md relative">
        <div class="bg-white/80 backdrop-blur-xl py-10 px-8 shadow-2xl border border-white/20 sm:rounded-2xl sm:px-12">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="space-y-1">
                    <label for="email" class="block text-sm font-semibold text-gray-700">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl bg-gray-50/50 placeholder-gray-400 focus:bg-white focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 transition-all duration-200 sm:text-sm"
                            placeholder="nama@email.com"
                            value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                            class="block w-full pl-10 pr-12 py-3 border border-gray-200 rounded-xl bg-gray-50/50 placeholder-gray-400 focus:bg-white focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 transition-all duration-200 sm:text-sm"
                            placeholder="Masukkan password">
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg id="eye-open" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eye-closed" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors duration-200 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-2">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" 
                            class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 focus:ring-offset-0">
                        <label for="remember_me" class="ml-3 block text-sm font-medium text-gray-700">
                            Ingat saya
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-semibold text-primary-600 hover:text-primary-500 transition-colors duration-200">
                            Lupa password?
                        </a>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-primary-300 group-hover:text-primary-200 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        Masuk ke Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeOpen = document.getElementById('eye-open');
    const eyeClosed = document.getElementById('eye-closed');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
    } else {
        passwordInput.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
    }
}
</script>
@endsection