@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Edit Produk: {{ $product->name }}</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required min="0">
            </div>

            <div class="mb-3">
                <label class="form-label">Stock Awal</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required min="0">
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ganti Gambar (kosongkan jika tidak ingin ubah)</label>
                <input type="file" name="image" class="form-control">
                @if ($product->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar saat ini" width="150" class="img-thumbnail">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection