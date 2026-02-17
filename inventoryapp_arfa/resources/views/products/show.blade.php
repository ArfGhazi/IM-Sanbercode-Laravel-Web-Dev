@extends('layouts.app')

@section('title', 'Detail Produk: ' . $product->name)

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Detail Produk</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- Gambar -->
                            <div class="col-md-5 text-center mb-4 mb-md-0">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="img-fluid rounded shadow" 
                                         style="max-height: 400px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                                        <span class="text-muted fs-4">Tidak ada gambar</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Info -->
                            <div class="col-md-7">
                                <h3 class="fw-bold mb-3">{{ $product->name }}</h3>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <strong>Kategori:</strong><br>
                                        {{ $product->category->name ?? 'Tidak ada' }}
                                    </div>
                                    <div class="col-6">
                                        <strong>Harga:</strong><br>
                                        <span class="fs-4 text-success fw-bold">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <strong>Stok Saat Ini:</strong><br>
                                    <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }} fs-5 px-3 py-2">
                                        {{ $product->stock }}
                                    </span>
                                    @if ($product->stock <= 5 && $product->stock > 0)
                                        <span class="text-danger ms-2 small">Stok hampir habis!</span>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <strong>Deskripsi:</strong>
                                    <p class="text-muted mt-2 border-start border-primary ps-3">
                                        {{ $product->description ?? 'Tidak ada deskripsi.' }}
                                    </p>
                                </div>

                                <!-- Tombol aksi hanya untuk admin -->
                                @if (auth()->user()->role === 'admin')
                                    <div class="d-flex gap-3 mt-4">
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                                            Edit Produk
                                        </a>

                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Yakin hapus produk ini?')">
                                                Hapus Produk
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-muted text-center">
                        Dibuat: {{ $product->created_at->format('d M Y H:i') }}
                        | Diperbarui: {{ $product->updated_at->format('d M Y H:i') }}
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg">
                        Kembali ke Daftar Produk
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection