<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;

// DASHBOARD
Route::get('/', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');
});

// PRODUCT & CATEGORY
Route::middleware(['auth'])->group(function(){

    // Product routes menggunakan controller middleware
    Route::resource('products', ProductController::class);

    // Category hanya admin
    Route::resource('categories', CategoryController::class)
        ->middleware('role:admin');

});

Route::resource('categories', CategoryController::class)->middleware('auth');

// TRANSACTIONS
Route::middleware(['auth','role:admin,staff'])->group(function(){
    Route::resource('transactions', TransactionController::class);
});

require __DIR__.'/auth.php';
