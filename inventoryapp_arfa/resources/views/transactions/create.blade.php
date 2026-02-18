@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
    <div class="container mt-4">
        <h3>Tambah Transaksi Baru</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Produk</label>
                <select name="product_id" class="form-control" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} (Stok: {{ $product->stock }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="amount" class="form-control" min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipe</label>
                <select name="type" class="form-control" required>
                    <option value="in">Masuk (Tambah Stok)</option>
                    <option value="out">Keluar (Kurangi Stok)</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Catatan (opsional)</label>
                <textarea name="notes" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection