<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\bannerController;

use Illuminate\Support\Facades\Route;

Route::redirect('/admin', 'admin/dashboad');

// routes/web.php hoặc routes/admin.php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/product', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/product/{id}', fn() => view('admin.products.edit'))->name('products.edit');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
});
// ->middleware(['auth', 'admin'])
