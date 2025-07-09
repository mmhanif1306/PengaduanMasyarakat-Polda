@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Profile Saya</h1>
                <p class="text-gray-600">Kelola informasi personal Anda</p>
            </div>

            <!-- Profile Card -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                <!-- Profile Header with Avatar -->
                <div class="bg-gradient-to-r from-primary-600 to-secondary-600 px-8 py-12 text-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <!-- Profile Avatar -->
                        <div class="relative group cursor-pointer" onclick="document.getElementById('profile-image-input').click()">
                            @if(auth()->user()->url_file)
                                <img src="{{ auth()->user()->url_file }}" alt="Profile" class="w-24 h-24 rounded-full border-4 border-white/30 backdrop-blur-sm shadow-lg object-cover transition-all duration-300 group-hover:brightness-75">
                            @else
                                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center text-3xl font-bold border-4 border-white/30 backdrop-blur-sm transition-all duration-300 group-hover:brightness-75">
                                    {{ substr(auth()->user()->nama, 0, 1) }}
                                </div>
                            @endif
                            
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 rounded-full bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            
                            <!-- Tooltip -->
                            <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                                Edit Foto Profile
                            </div>
                        </div>
                        

                        <h2 class="text-2xl font-bold mb-1">{{ auth()->user()->nama }}</h2>
                        <p class="text-white/80">{{ auth()->user()->email }}</p>
                        <div class="mt-4 px-4 py-2 bg-white/20 rounded-full text-sm font-medium border border-white/30">
                            {{ auth()->user()->role === 'admin' ? 'Administrator' : 'Pengguna' }}
                        </div>
                    </div>
                    <!-- Decorative elements -->
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/5 rounded-full"></div>
                </div>

                <!-- Profile Form -->
                <div class="p-8">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Hidden File Input -->
                        <input type="file" id="profile-image-input" name="image" accept="image/*" class="hidden" onchange="previewImage(this)">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- NIK -->
                            <div class="space-y-2">
                                <label for="nik" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2h12v8H4V6z" clip-rule="evenodd"></path>
                                        <path d="M6 8h2v2H6V8zm4 0h4v2h-4V8zm-4 4h8v2H6v-2z"></path>
                                    </svg>
                                    NIK (Nomor Induk Kependudukan)
                                </label>
                                <div class="relative">
                                    <input type="text" name="nik" id="nik"
                                        value="{{ auth()->user()->nik }}" disabled
                                        class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50 text-gray-500 focus:border-primary-500 focus:ring-0 transition-all duration-200 font-medium">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="space-y-2">
                                <label for="nama" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                    Nama Lengkap
                                </label>
                                <div class="relative">
                                    <input type="text" name="nama" id="nama"
                                        value="{{ auth()->user()->nama }}" disabled
                                        class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50 text-gray-500 focus:border-primary-500 focus:ring-0 transition-all duration-200 font-medium">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                    </svg>
                                    Alamat Email
                                </label>
                                <div class="relative">
                                    <input type="email" name="email" id="email"
                                        value="{{ auth()->user()->email }}"
                                        class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-0 transition-all duration-200 hover:border-gray-300">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="space-y-2">
                                <label for="no_telp" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                    </svg>
                                    Nomor Telepon
                                </label>
                                <div class="relative">
                                    <input type="tel" name="no_telp" id="no_telp"
                                        value="{{ auth()->user()->no_telp }}"
                                        class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-0 transition-all duration-200 hover:border-gray-300">
                                </div>
                            </div>


                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl shadow-lg hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-500/50 transition-all duration-200 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Additional Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <!-- Account Status -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Status Akun</h3>
                    </div>
                    <p class="text-gray-600 mb-2">Akun Anda aktif dan terverifikasi</p>
                    <div class="flex items-center text-sm text-green-600">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        Aktif
                    </div>
                </div>

                <!-- Security Info -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Keamanan</h3>
                    </div>
                    <p class="text-gray-600 mb-2">Akun Anda dilindungi dengan enkripsi</p>
                    
                    <!-- Password Change Button -->
                    <button id="changePasswordBtn" class="text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200" onclick="togglePasswordForm()">
                        Ubah Password →
                    </button>
                    
                    <!-- Password Change Form (Hidden by default) -->
                    <div id="passwordForm" class="hidden mt-4 space-y-4">
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <!-- Current Password -->
                            <div class="space-y-2">
                                <label for="current_password" class="block text-sm font-medium text-gray-700">
                                    Password Saat Ini
                                </label>
                                <input type="password" name="current_password" id="current_password" required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            
                            <!-- New Password -->
                            <div class="space-y-2">
                                <label for="new_password" class="block text-sm font-medium text-gray-700">
                                    Password Baru
                                </label>
                                <input type="password" name="password" id="new_password" required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            
                            <!-- Confirm New Password -->
                            <div class="space-y-2">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                    Konfirmasi Password Baru
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex space-x-3 pt-2">
                                <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm font-medium">
                                    Simpan Password
                                </button>
                                <button type="button" onclick="togglePasswordForm()" class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors duration-200 text-sm font-medium">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Form validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form[action="{{ route('profile.update') }}"]');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value;
                const phone = document.getElementById('no_telp').value;
                
                if (!email || !phone) {
                    e.preventDefault();
                    alert('Email dan nomor telepon harus diisi!');
                    return false;
                }
                
                // Email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    e.preventDefault();
                    alert('Format email tidak valid!');
                    return false;
                }
                
                // Phone validation
                const phoneRegex = /^[0-9]{10,15}$/;
                if (!phoneRegex.test(phone)) {
                    e.preventDefault();
                    alert('Nomor telepon harus berupa angka 10-15 digit!');
                    return false;
                }
            });
        }
    });
    
    // Preview image function
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                input.value = '';
                return;
            }
            
            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung! Gunakan JPG, PNG, atau GIF.');
                input.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                // Find the avatar container
                const avatarContainer = document.querySelector('.group.cursor-pointer');
                
                // Update the avatar image
                const existingImg = avatarContainer.querySelector('img');
                const existingDiv = avatarContainer.querySelector('div.w-24');
                
                if (existingImg) {
                    existingImg.src = e.target.result;
                } else if (existingDiv) {
                    // Replace the initial div with an image
                    const newImg = document.createElement('img');
                    newImg.src = e.target.result;
                    newImg.alt = 'Profile';
                    newImg.className = 'w-24 h-24 rounded-full border-4 border-white/30 backdrop-blur-sm shadow-lg object-cover transition-all duration-300 group-hover:brightness-75';
                    existingDiv.replaceWith(newImg);
                }
                
                // Create a form to upload the image
                const formData = new FormData();
                formData.append('image', file);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                
                // You can add AJAX upload here if needed
                console.log('Image selected and previewed');
            };
            reader.readAsDataURL(file);
        }
    }
    
    // Toggle password form function
    function togglePasswordForm() {
        const passwordForm = document.getElementById('passwordForm');
        const changePasswordBtn = document.getElementById('changePasswordBtn');
        
        if (passwordForm.classList.contains('hidden')) {
            passwordForm.classList.remove('hidden');
            changePasswordBtn.textContent = '← Tutup Form';
        } else {
            passwordForm.classList.add('hidden');
            changePasswordBtn.textContent = 'Ubah Password →';
            // Reset form
            passwordForm.querySelector('form').reset();
        }
    }
    
    // Password validation
    document.addEventListener('DOMContentLoaded', function() {
        const passwordForm = document.querySelector('#passwordForm form');
        
        if (passwordForm) {
            passwordForm.addEventListener('submit', function(e) {
                const currentPassword = document.getElementById('current_password').value;
                const newPassword = document.getElementById('new_password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;
                
                // Check if all fields are filled
                if (!currentPassword || !newPassword || !confirmPassword) {
                    e.preventDefault();
                    alert('Semua field password harus diisi!');
                    return false;
                }
                
                // Check password length
                if (newPassword.length < 8) {
                    e.preventDefault();
                    alert('Password baru minimal 8 karakter!');
                    return false;
                }
                
                // Check password confirmation
                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    alert('Konfirmasi password tidak cocok!');
                    return false;
                }
                
                // Check if new password is different from current
                if (currentPassword === newPassword) {
                    e.preventDefault();
                    alert('Password baru harus berbeda dari password saat ini!');
                    return false;
                }
            });
        }
    });
</script>
@endpush
