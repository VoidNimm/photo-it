<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route untuk mengubah bahasa
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Route publik
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/services', [ServiceController::class, 'index'])->name('services');

// Group untuk form submissions 60 req per menit
Route::middleware(['throttle:60,1'])->group(function () {
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
});

// Route GET untuk form (tanpa throttle)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');

// Route untuk autentikasi, hanya user yang belum login yang bisa mengakses
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Route untuk logout, hanya user yang sudah login yang bisa mengakses
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// forgot password
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');