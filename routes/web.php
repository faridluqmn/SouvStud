<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\KeranjangController;


Route::middleware(GuestMiddleware::class)->group(function () {
    Route::get('/', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/buat-akun', [AuthController::class, 'register'])->name('regis.submit');
});

Route::middleware('auth')->group(function () {
    // Rute admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // Rute user
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//kategori
Route::get('/kategori', [ProductController::class, 'showCategories'])->name('categories.index');
Route::post('/kategori/simpan', [ProductController::class, 'storeCat'])->name('categories.store');
Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('categories.edit');
Route::put('/{id}', [ProductController::class, 'update'])->name('categories.update');
Route::delete('/{id}', [ProductController::class, 'destroy'])->name('categories.destroy');

//produk
Route::get('/produk', [ProductController::class, 'showProduct'])->name('product.index');
Route::post('/produk/simpan', [ProductController::class, 'storeProd'])->name('product.store');
Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

//chat
Route::get('/chat/{receiverId}', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/{receiverId}', [ChatController::class, 'store'])->name('chat.store');

//addcart
Route::post('/cart/add', [KeranjangController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/checkout', [KeranjangController::class, 'checkout'])->name('cart.checkout');
Route::delete('/cart/remove/{productId}', [KeranjangController::class, 'remove'])->name('cart.remove');

//kupon
Route::get('/kupon', [AdminController::class, 'coupons'])->name('admin.coupons');


Route::get('/blog', function () {
    return view('blog');
});
Route::get('/about', function () {
    return view('about');
});


Route::get('/cek', function () {
    return view('welcome');
});
