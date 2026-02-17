@extends('layouts.app')

@section('title','Tambah Product')

@section('content')

<h3 class="mb-4">Tambah Product</h3>

<form action="{{ route('products.store') }}" 
      method="POST" 
      enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Nama Product</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Category</label>
        <select name="category_id" class="form-control" required>
            <option value="">-- Pilih Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Stock</label>
        <input type="number" name="stock" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control" required>
    </div>

    <div class="mb-3">
    <label class="form-label">Deskripsi Produk</label>
    <textarea name="description" class="form-control" rows="4" placeholder="Masukkan deskripsi lengkap produk...">
        {{ old('description', $product->description ?? '') }}
    </textarea>
    @error('description')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

    <button class="btn btn-primary">Simpan</button>

</form>

@endsection
