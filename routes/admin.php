<?php

use App\Http\Controllers\AdminController;

use App\Http\Controllers\bannerController;

use Illuminate\Support\Facades\Route;

Route::redirect('/admin', '/admin/dashboard');

Route::middleware('auth', 'admin')->prefix('admin')->group(function(){
    Route::get('/dasboard',[AdminController::class, 'index'])->name('dasboard');
    Route::get('/banner', [bannerController::class, 'index'])->name('admin.banner');


});
