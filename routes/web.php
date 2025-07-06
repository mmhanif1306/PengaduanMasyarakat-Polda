<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'store']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
