<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Frontend routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'guestIndex'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Public admin routes (login)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest:admin')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest:admin')->name('login.post');

    // Protected admin routes
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/profile', [AdminController::class, 'showProfile'])->name('profile.show');
        Route::get('/profile/edit', [AdminController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Admin resource routes
        Route::resource('products', ProductController::class)->except(['show']);
        Route::resource('categories', CategoryController::class);
        Route::resource('slider', SliderController::class);
    });
});
