@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="container mt-4">
        <h3>Edit Kategori: {{ $category->name }}</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Kategori</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Deskripsi Kategori</label>
                <textarea name="description" class="form-control" rows="5">
                    {{ old('description', $category->description ?? '') }}
                </textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection