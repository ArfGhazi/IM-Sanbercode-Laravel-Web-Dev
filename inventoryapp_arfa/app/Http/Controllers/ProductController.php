<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('role:staff,admin', only: ['index', 'show']),
            new Middleware('role:admin', except: ['index', 'show']),
        ];
    }

    public function index()
    {
        $products = Product::with('category')->latest()->paginate(12);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price'       => 'required|numeric|min:0',
        'stock'       => 'required|integer|min:0',
        'description' => 'nullable|string',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['name', 'category_id', 'price', 'stock', 'description']);

    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil diperbarui!');
}

public function edit(Product $product)
{
    $categories = Category::all();
    return view('products.edit', compact('product', 'categories'));
}

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // show, edit, update, destroy → sama seperti sebelumnya, tambah description di update kalau perlu

    /**
 * Menampilkan detail satu produk
 * Boleh diakses oleh staff & admin
 */
public function show(Product $product)
{
    // Load category kalau perlu (untuk tampilkan nama kategori di view)
    $product->load('category');

    return view('products.show', compact('product'));
}


public function destroy(Product $product)
{
   
    if ($product->image) {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
    }


    $product->delete();

    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil dihapus!');
}

}