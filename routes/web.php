<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\GuestMiddleware;

Route::middleware(GuestMiddleware::class)->group(function () {
    Route::get('/', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/buat-akun', [AuthController::class, 'register'])->name('regis.submit');
});

Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
