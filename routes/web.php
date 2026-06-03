<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/catalogue', [ProductController::class, 'index'])->name('products.index');
Route::get('/catalogue/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegistration'])->name('register.store');
    Route::redirect('/admin/login', '/login');
});

Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::get('/cart/processing', [CartController::class, 'processing'])->name('cart.processing');
    Route::post('/cart/process', [CartController::class, 'process'])->name('cart.process');

    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/orders/{order}', [CartController::class, 'showOrder'])->name('orders.show');

  
});

//
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class)->except('show');
    Route::resource('orders', OrderController::class)
            ->only(['index', 'show', 'destroy']);
    Route::patch('/orders/{order}/toggle-status', [OrderController::class, 'toggleStatus'])
    ->name('orders.toggle-status');
     Route::resource('users', UserController::class)
        ->only(['index', 'edit', 'update', 'destroy']);
});
