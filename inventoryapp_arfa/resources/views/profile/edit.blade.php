@extends('layouts.app')

@section('title','Profile')

@section('content')

<h3 class="mb-4">Profile</h3>

@if(session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" 
               class="form-control"
               value="{{ old('name', auth()->user()->name) }}" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" 
               class="form-control"
               value="{{ old('email', auth()->user()->email) }}" required>
    </div>

    <button class="btn btn-primary">
        Update Profile
    </button>
</form>

<hr class="my-4">

<h5>Ubah Password</h5>

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Password Lama</label>
        <input type="password" name="current_password" class="form-control">
    </div>

    <div class="mb-3">
        <label>Password Baru</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button class="btn btn-warning">
        Update Password
    </button>
</form>

@endsection
