@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Dashboard</h2>
            <div>
                <span class="me-3 text-muted">Selamat datang, {{ auth()->user()->name }}</span>
                <span class="badge bg-{{ auth()->user()->role === 'admin' ? 'success' : 'info' }}">
                    {{ strtoupper(auth()->user()->role) }}
                </span>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle p-3 me-3">
                                <i class="bi bi-box-seam fs-4"></i>
                            </div>
                            <div>
                                <h6 class="card-title mb-0 text-muted">Total Produk</h6>
                                <h3 class="fw-bold mb-0">{{ $totalProducts ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-success text-white rounded-circle p-3 me-3">
                                <i class="bi bi-tags fs-4"></i>
                            </div>
                            <div>
                                <h6 class="card-title mb-0 text-muted">Total Kategori</h6>
                                <h3 class="fw-bold mb-0">{{ $totalCategories ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-info text-white rounded-circle p-3 me-3">
                                <i class="bi bi-arrow-down-circle fs-4"></i>
                            </div>
                            <div>
                                <h6 class="card-title mb-0 text-muted">Transaksi Masuk</h6>
                                <h3 class="fw-bold mb-0">{{ $totalIn ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning text-white rounded-circle p-3 me-3">
                                <i class="bi bi-arrow-up-circle fs-4"></i>
                            </div>
                            <div>
                                <h6 class="card-title mb-0 text-muted">Transaksi Keluar</h6>
                                <h3 class="fw-bold mb-0">{{ $totalOut ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jika semua data masih 0 -->
        @if (($totalProducts ?? 0) == 0 && ($totalCategories ?? 0) == 0 && ($totalIn ?? 0) == 0 && ($totalOut ?? 0) == 0)
            <div class="alert alert-warning text-center py-5">
                <h5>Belum ada data sama sekali</h5>
                <p class="mb-0">Mulai dengan menambahkan produk, kategori, atau transaksi di menu samping.</p>
            </div>
        @endif

        <!-- Chart & Tabel -->
        <div class="row g-4">
            <!-- Chart Stok Rendah -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Produk Stok Rendah (≤ 5)</h5>
                    </div>
                    <div class="card-body">
                        @if (empty($lowStock) || $lowStock->isEmpty())
                            <p class="text-muted text-center py-4">Tidak ada produk dengan stok rendah.</p>
                        @else
                            <canvas id="lowStockChart" height="200"></canvas>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Transaksi Terbaru -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Transaksi Terbaru</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Produk</th>
                                        <th>Tipe</th>
                                        <th>Jumlah</th>
                                        <th>User</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($latestTransactions ?? [] as $trans)
                                        <tr>
                                            <td>{{ $trans->id }}</td>
                                            <td>{{ $trans->product->name ?? '-' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $trans->type === 'in' ? 'success' : 'danger' }}">
                                                    {{ $trans->type === 'in' ? 'Masuk' : 'Keluar' }}
                                                </span>
                                            </td>
                                            <td>{{ $trans->amount }}</td>
                                            <td>{{ $trans->user->name ?? 'System' }}</td>
                                            <td>{{ $trans->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">Belum ada transaksi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @if (!empty($lowStock) && !$lowStock->isEmpty())
        <script>
            const lowStockChart = new ApexCharts(document.querySelector("#lowStockChart"), {
                series: [{
                    name: 'Stok',
                    data: @json($lowStock->pluck('stock')->toArray())
                }],
                chart: {
                    type: 'bar',
                    height: 250,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: false,
                        columnWidth: '55%',
                    },
                },
                dataLabels: { enabled: false },
                xaxis: {
                    categories: @json($lowStock->pluck('name')->toArray()),
                },
                yaxis: {
                    title: { text: 'Jumlah Stok' }
                },
                colors: ['#dc3545'],
                tooltip: { y: { formatter: val => val + " unit" } }
            });
            lowStockChart.render();
        </script>
    @endif
@endsection