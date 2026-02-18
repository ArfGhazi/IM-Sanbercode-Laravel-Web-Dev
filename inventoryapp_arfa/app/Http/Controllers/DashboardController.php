<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalIn         = Transaction::where('type', 'in')->sum('amount');
        $totalOut        = Transaction::where('type', 'out')->sum('amount');

        $lowStock = Product::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->get();

        $latestTransactions = Transaction::with(['product', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalIn',
            'totalOut',
            'lowStock',
            'latestTransactions'
        ));
    }
}