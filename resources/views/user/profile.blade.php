@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    Informasi profile Anda.
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Nama
                                            Lengkap</label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" name="name" id="name"
                                                value="{{ auth()->user()->name }}" disabled
                                                class="block w-full rounded-md border-gray-300 bg-gray-100 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat
                                            Email</label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="email" name="email" id="email"
                                                value="{{ auth()->user()->email }}"
                                                class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        </div>
                                        @error('email')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor
                                            Telepon</label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="tel" name="phone" id="phone"
                                                value="{{ auth()->user()->phone }}" disabled
                                                class="block w-full rounded-md border-gray-300 bg-gray-100 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                                        <div class="mt-1">
                                            <textarea id="address" name="address" rows="3" disabled
                                                class="block w-full rounded-md border-gray-300 bg-gray-100 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ auth()->user()->address }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <button type="submit"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        Simpan Perubahan
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
