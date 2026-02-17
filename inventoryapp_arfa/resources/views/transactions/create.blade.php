@extends('layouts.app')

@section('content')

<h3>Tambah Transaksi</h3>

<form method="POST" action="{{ route('transactions.store') }}">
    @csrf

    <div class="mb-3">
        <label>Produk</label>
        <select name="product_id" class="form-control">
            @foreach($products as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="amount" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Tipe</label>
        <select name="type" class="form-control">
            <option value="in">Barang Masuk</option>
            <option value="out">Barang Keluar</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Catatan</label>
        <textarea name="notes" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

@endsection
