<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;

// DASHBOARD - hanya satu route ini saja
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $totalProducts   = \App\Models\Product::count() ?? 0;
        $totalCategories = \App\Models\Category::count() ?? 0;
        $totalIn         = \App\Models\Transaction::where('type', 'in')->sum('amount') ?? 0;
        $totalOut        = \App\Models\Transaction::where('type', 'out')->sum('amount') ?? 0;

        $lowStock = \App\Models\Product::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->get() ?? collect();

        $latestTransactions = \App\Models\Transaction::with(['product', 'user'])
            ->latest()
            ->take(10)
            ->get() ?? collect();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalIn',
            'totalOut',
            'lowStock',
            'latestTransactions'
        ));
    })->name('dashboard');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // PRODUCT & CATEGORY
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class)->middleware('role:admin');

    // TRANSACTIONS
    Route::resource('transactions', TransactionController::class)->middleware('role:admin,staff');
});

require __DIR__.'/auth.php';