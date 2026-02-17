@extends('layouts.app')

@section('content')

<h3>Detail Transaksi</h3>

<p>Produk: {{ $transaction->product->name }}</p>
<p>Jumlah: {{ $transaction->amount }}</p>
<p>Tipe: {{ $transaction->type }}</p>
<p>User: {{ $transaction->user->name }}</p>
<p>Catatan: {{ $transaction->notes }}</p>

@endsection
