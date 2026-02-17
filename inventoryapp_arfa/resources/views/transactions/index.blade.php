@extends('layouts.app')

@section('content')

<h3>Data Transaksi</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">
    Tambah Transaksi
</a>

<table class="table table-bordered">
    <tr>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Tipe</th>
        <th>User</th>
        <th>Aksi</th>
    </tr>

    @foreach($transactions as $t)
    <tr>
        <td>{{ $t->product->name }}</td>
        <td>{{ $t->amount }}</td>
        <td>
            @if($t->type=='in')
                <span class="text-success">Masuk</span>
            @else
                <span class="text-danger">Keluar</span>
            @endif
        </td>
        <td>{{ $t->user->name }}</td>
        <td>
            <form action="{{ route('transactions.destroy',$t->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
