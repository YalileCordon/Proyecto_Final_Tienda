<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::resource('/', ProductController::class);

Auth::routes();

Route::resource('products',ProductController::class)->except('show');

Route::get('/products/by-category', [ProductController::class, 'showByCategory'])->name('products.showByCategory');

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::resource('categories', CategoryController::class)->except('show');

Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/password/reset', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.update');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/users', UserController::class);

