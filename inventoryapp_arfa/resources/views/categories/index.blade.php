@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Data Kategori</h3>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    Tambah Kategori
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($categories->isEmpty())
            <div class="alert alert-info text-center py-5">
                Belum ada data kategori.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($categories as $category)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 hover-shadow">
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title mb-3 fw-bold">{{ $category->name }}</h5>

                                <p class="card-text text-muted small mb-4 flex-grow-1" 
                                   style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; min-height: 80px;">
                                    {{ $category->description ?? 'Tidak ada deskripsi.' }}
                                </p>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge bg-primary rounded-pill px-3 py-2">
                                            {{ $category->products_count }} Produk
                                        </span>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="{{ route('categories.show', $category) }}" class="btn btn-outline-info btn-sm">
                                            Lihat Detail
                                        </a>

                                        @if (auth()->user()->role === 'admin')
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm flex-fill">
                                                    Edit
                                                </a>

                                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline flex-fill">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm w-100"
                                                            onclick="return confirm('Yakin hapus kategori ini?\nProduk terkait mungkin terpengaruh!')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection

<style>
    .hover-shadow:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }
</style>