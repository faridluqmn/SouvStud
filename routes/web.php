<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomizationController;       

Route::middleware(GuestMiddleware::class)->group(function () {
    Route::get('/', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/buat-akun', [AuthController::class, 'register'])->name('regis.submit');

    // Route::get('/otp', function () {
    //     return view('auth.otp');
    // })->name('otp.form');
    // Route::post('/otp', [AuthController::class, 'confirmOtp'])->name('otp.confirm');
    //buat otp


});

// Routes
// Route::get('/customizations', [CustomizationController::class, 'index'])->name('customizations.index');
// Route::get('/customizations/create', [CustomizationController::class, 'create'])->name('customizations.create');
// Route::post('/customizations', [CustomizationController::class, 'store'])->name('customizations.store');
// Route::get('/customizations/chat/{id}', [CustomizationController::class, 'chat'])->name('customizations.chat');
// Route::post('/customizations/chat/send', [CustomizationController::class, 'sendMessage'])->name('customizations.chat.send');

Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


