<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::redirect('/admin', 'admin/dashboad');

// routes/web.php hoặc routes/admin.php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/product', [ProductController::class, 'create'])->name('products.create');
    Route::get('/product/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::delete('/product/{product}', [ProductController::class, 'delete'])->name('products.delete');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::prefix('/order')->name('orders.')->group(function () {
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    Route::get('/{order}/invoice', [OrderController::class, 'invoice'])->name('invoice');
});
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
});
// ->middleware(['auth', 'admin'])
