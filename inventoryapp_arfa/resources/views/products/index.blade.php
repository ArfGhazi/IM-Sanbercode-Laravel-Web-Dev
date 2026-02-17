@extends('layouts.app')

@section('title', 'Data Product')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Data Product</h3>
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    Tambah Product
                </a>
            @endif
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($products->isEmpty())
            <div class="alert alert-info text-center">
                Belum ada data produk.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($products as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <div style="height: 180px; overflow: hidden;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         class="card-img-top" 
                                         alt="{{ $product->name }}"
                                         style="object-fit: cover; height: 100%;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                        <span class="text-muted">No Image</span>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                
                                <p class="text-muted small mb-2">
                                    Kategori: {{ $product->category->name ?? '-' }}
                                </p>

                                <p class="card-text text-muted small mb-3 flex-grow-1" 
                                   style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                    {{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}
                                </p>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="fs-5 fw-bold text-success">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                        <span class="badge bg-{{ $product->stock > 0 ? 'primary' : 'danger' }} rounded-pill">
                                            Stok: {{ $product->stock }}
                                        </span>
                                    </div>

                                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary btn-sm w-100 mb-2">
                                        Lihat Detail
                                    </a>

                                    @if (auth()->user()->role === 'admin')
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm flex-fill">
                                                Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline flex-fill">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-100"
                                                        onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection