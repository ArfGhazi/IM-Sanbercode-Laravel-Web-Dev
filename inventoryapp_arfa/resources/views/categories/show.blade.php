@extends('layouts.app')

@section('title', 'Detail Kategori - ' . $category->name)

@section('content')
    <div class="container mt-4">
        <div class="card shadow border-0">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Detail Kategori</h4>
            </div>

            <div class="card-body">
                <h3 class="fw-bold mb-3">{{ $category->name }}</h3>

                <div class="mb-4">
                    <strong>Deskripsi:</strong>
                    <p class="mt-2 text-muted border-start border-info ps-3">
                        {{ $category->description ?? 'Tidak ada deskripsi untuk kategori ini.' }}
                    </p>
                </div>

                <div class="mb-4">
                    <strong>Jumlah Produk:</strong> 
                    <span class="badge bg-primary fs-5 px-3 py-2">
                        {{ $category->products_count }}
                    </span>
                </div>

                @if ($category->products->isNotEmpty())
                    <h5 class="mb-3">Daftar Produk dalam Kategori Ini</h5>
                    <ul class="list-group">
                        @foreach ($category->products as $product)
                            <li class="list-group-item">
                                <a href="{{ route('products.show', $product) }}">
                                    {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                </a>
                                <span class="badge bg-secondary ms-2">Stok: {{ $product->stock }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Belum ada produk dalam kategori ini.</p>
                @endif

                @if (auth()->user()->role === 'admin')
                    <div class="mt-4">
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit Kategori</a>
                    </div>
                @endif
            </div>

            <div class="card-footer text-muted text-center">
                Dibuat: {{ $category->created_at->format('d M Y H:i') }}
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Kembali ke Daftar Kategori</a>
        </div>
    </div>
@endsection