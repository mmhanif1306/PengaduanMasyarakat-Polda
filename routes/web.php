<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('guest')->group(function (){
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'create'])->name('register');
});

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/profile/show', [AuthController::class, 'showProfile'])->name('profile.show');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    
    Route::get('/laporan/{laporan}/pdf', [AdminLaporanController::class, 'downloadPdf'])->name('laporan.pdf');
});

Route::middleware(['auth', 'user'])->group(function (){
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Laporan Routes
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/create', function () {
            return view('user.laporan.create');
        })->name('create');
        Route::post('/', [LaporanController::class, 'create'])->name('store');
        Route::get('/{id}', [LaporanController::class, 'detailLaporan'])->name('show');
        Route::get('/{laporan}/edit', [LaporanController::class, 'edit'])->name('edit');
        Route::put('/{laporan}', [LaporanController::class, 'update'])->name('update');
        Route::delete('/{laporan}', [LaporanController::class, 'delete'])->name('destroy');
    });
    // Notifikasi Routes
    Route::prefix('notifikasi')->name('notifikasi.')->group(function () {
        Route::get('/preview', [\App\Http\Controllers\NotifikasiController::class, 'preview'])->name('preview');
        Route::get('/', [\App\Http\Controllers\NotifikasiController::class, 'index'])->name('index');
        Route::get('/{notifikasi}', [\App\Http\Controllers\NotifikasiController::class, 'show'])->name('show');
        Route::put('/{notifikasi}/read', [\App\Http\Controllers\NotifikasiController::class, 'markAsRead'])->name('read');
        Route::delete('/{notifikasi}', [\App\Http\Controllers\NotifikasiController::class, 'destroy'])->name('destroy');
    });
});

// API Routes for Wilayah (Indonesia Region Data)
Route::prefix('api/wilayah')->name('api.wilayah.')->group(function () {
    Route::get('/provinces', [WilayahController::class, 'getProvinces'])->name('provinces');
    Route::get('/cities/{provinceId}', [WilayahController::class, 'getCities'])->name('cities');
    Route::get('/districts/{cityId}', [WilayahController::class, 'getDistricts'])->name('districts');
    Route::get('/villages/{districtId}', [WilayahController::class, 'getVillages'])->name('villages');
    Route::post('/clear-cache', [WilayahController::class, 'clearCache'])->name('clear-cache');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{laporan}', [AdminLaporanController::class, 'show'])->name('laporan.show');
    Route::put('/laporan/{laporan}', [AdminLaporanController::class, 'updateStatus'])->name('laporan.update');
});
