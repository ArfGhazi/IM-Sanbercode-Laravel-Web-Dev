<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // Staff & admin boleh lihat daftar & detail transaksi
            new Middleware('role:staff,admin', only: ['index', 'show']),

            // HANYA admin yang boleh create, store, destroy
            new Middleware('role:admin', except: ['index', 'show']),
        ];
    }

    public function index()
    {
        $transactions = Transaction::with(['product', 'user'])
            ->latest()
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
{
    // Validasi ketat
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'amount'     => 'required|integer|min:1',
        'type'       => 'required|in:in,out',
        'notes'      => 'nullable|string|max:500',
    ]);

    // Cek user login
    if (!auth()->check()) {
        return back()->withErrors(['auth' => 'Anda harus login untuk membuat transaksi'])->withInput();
    }

    $product = Product::findOrFail($validated['product_id']);

    // Cek stok kalau keluar
    if ($validated['type'] === 'out' && $validated['amount'] > $product->stock) {
        return back()->withErrors(['amount' => 'Stok tidak mencukupi! Stok saat ini: ' . $product->stock])->withInput();
    }

    try {
        \DB::transaction(function () use ($validated, $product) {
            Transaction::create([
                'product_id' => $validated['product_id'],
                'user_id'    => auth()->id(),
                'type'       => $validated['type'],
                'amount'     => $validated['amount'],
                'notes'      => $validated['notes'] ?? null,
            ]);

            if ($validated['type'] === 'in') {
                $product->increment('stock', $validated['amount']);
            } else {
                $product->decrement('stock', $validated['amount']);
            }
        });

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil disimpan!');
    } catch (\Exception $e) {
        // Log error biar bisa dicek
        \Log::error('Transaction store error: ' . $e->getMessage(), [
            'request' => $request->all(),
            'trace'   => $e->getTraceAsString(),
        ]);

        return back()->withErrors(['error' => 'Gagal menyimpan transaksi: ' . $e->getMessage()])
                     ->withInput();
    }
}

    public function show($id)
    {
        $transaction = Transaction::with(['product', 'user'])->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        // Optional: rollback stok kalau hapus transaksi (tergantung bisnis logic kamu)
        // Kalau mau rollback, uncomment blok ini:
        /*
        if ($transaction->type === 'in') {
            $transaction->product->decrement('stock', $transaction->amount);
        } else {
            $transaction->product->increment('stock', $transaction->amount);
        }
        */

        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}