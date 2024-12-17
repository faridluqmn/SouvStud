<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
<<<<<<< HEAD
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
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

=======
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\ChatController;
<<<<<<< Updated upstream
<<<<<<< HEAD
use App\Http\Controllers\CustomizationController;       
=======
use App\Http\Controllers\CustomizationController;   
use App\Http\Controllers\KeranjangController;    
>>>>>>> 5bf4f071861607f9f8b8b8ea4441d3789ff3f026
=======
use App\Http\Controllers\CustomizationController;
>>>>>>> Stashed changes

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

<<<<<<< HEAD
=======

>>>>>>> 5bf4f071861607f9f8b8b8ea4441d3789ff3f026
// Routes
// Route::get('/customizations', [CustomizationController::class, 'index'])->name('customizations.index');
// Route::get('/customizations/create', [CustomizationController::class, 'create'])->name('customizations.create');
// Route::post('/customizations', [CustomizationController::class, 'store'])->name('customizations.store');
// Route::get('/customizations/chat/{id}', [CustomizationController::class, 'chat'])->name('customizations.chat');
// Route::post('/customizations/chat/send', [CustomizationController::class, 'sendMessage'])->name('customizations.chat.send');

Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

<<<<<<< HEAD
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
>>>>>>> 9e3fae605f9826c83057db3cad8c33aa87cf42ba
    Route::get('/chat/{receiverId}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/{receiverId}', [ChatController::class, 'store'])->name('chat.store');
});

<<<<<<< HEAD
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

//addcart
Route::post('/cart/add', [KeranjangController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/checkout', [KeranjangController::class, 'checkout'])->name('cart.checkout');

Route::get('/dashboard', [DashboardController::class, 'showProducts'])->name('user.produk');

Route::get('/d', function () {
    return view('welcome');
});
<<<<<<< HEAD
=======
=======
Route::middleware(['auth'])->group(function () {
    // Route to show the cart (keranjang index)
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    
    // Route to redirect to the cart from the dashboard (keranjang redirect)
    Route::get('/keranjang/redirect', [KeranjangController::class, 'redirectToCart'])->name('keranjang.redirect');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
>>>>>>> 5bf4f071861607f9f8b8b8ea4441d3789ff3f026
>>>>>>> 9e3fae605f9826c83057db3cad8c33aa87cf42ba
=======

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/about', function () {
    return view('about');
});
>>>>>>> farid
