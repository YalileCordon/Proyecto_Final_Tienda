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

Route::get('/products/by-category', [ProductController::class, 'showByCategory'])->name('products.showByCategory');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('products',ProductController::class);

Route::post('/password/reset', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.update');

Route::resource('categories', CategoryController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/users', UserController::class);