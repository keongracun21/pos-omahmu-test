@extends('layouts.layout')

@section('title', 'Laporan Penjualan')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">

<div class="d-flex min-vh-100">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column align-items-center me-3">
        <a href="dashboard" class="nav-link">
            <i class="bi bi-card-image fs-5"></i>
            <span>Menu</span>
        </a>
        <a href="#" class="nav-link">
            <i class="bi bi-cursor fs-5"></i>
            <span>PO</span>
        </a>
        <a href="{{ route('laporan.index') }}" class="nav-link active">
            <i class="bi bi-file-earmark-bar-graph fs-5"></i>
            <span>Laporan</span>
        </a>
        <a href="{{ route('barang.index') }}" class="nav-link">
            <i class="bi bi-pie-chart fs-5"></i>
            <span>Barang</span>
        </a>
        <a href="{{ route('pengaturan') }}" class="nav-link">
            <i class="bi bi-gear fs-5"></i> Pengaturan
        </a>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="nav-link text-danger"
                style="background:none; border:none; padding:0; width:70px;">
                <i class="bi bi-box-arrow-right fs-5"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4 container-fluid">
        <div class="row g-4">
            <!-- Kiri: Laporan dan Tabel -->
            <div class="col-lg-8">
                <h4 class="mb-3">Laporan Penjualan</h4>

                <!-- Ringkasan Penjualan -->
                <div class="card shadow-sm rounded mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Ringkasan Penjualan</h5>
                        <p class="card-text">Total Transaksi: <strong>Rp
                                {{ number_format($totalPenjualan, 0, ',', '.') }}</strong>
                        </p>
                    </div>
                </div>

                <!-- Detail Transaksi -->
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h5 class="card-title">Detail Transaksi</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>ID Transaksi</th>
                                    <th>Total</th>
                                    <th>Order Details</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($laporan as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y H:i') }}
                                        </td>
                                        <td>{{ $item->id_transaksi }}</td>
                                        <td>Rp
                                            {{ number_format($item->total, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            @php
                                                $details = is_array($item->order_details)
                                                ? $item->order_details
                                                : (is_string($item->order_details) ? json_decode($item->order_details,
                                                true) : []);
                                            @endphp
                                            @if($details && is_array($details))
                                                <ul class="mb-0 ps-3">
                                                    @foreach($details as $order)
                                                        <li>
                                                            {{ $order['nama'] }}
                                                            x{{ $order['qty'] }} @ Rp
                                                            {{ number_format($order['harga'], 0, ',', '.') }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kanan: Filter Tanggal -->
            <div class="col-lg-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h5 class="card-title">Filter Tanggal</h5>
                        <form method="GET" action="{{ route('laporan.index') }}">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn"
                                    style="background-color: #1E293B; color: #fff;">Terapkan Filter</button>
                                <a href="{{ route('laporan.index') }}"
                                    class="btn btn-secondary">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
