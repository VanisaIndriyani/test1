@extends('layouts.admin')

@section('title', 'Laporan Barang Keluar')

@section('styles')
<style>
    @media print {
        #sidebar, .navbar, .no-print, .dt-buttons, .dataTables_filter, .dataTables_length, .dataTables_info, .dataTables_paginate {
            display: none !important;
        }
        #content {
            margin-left: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }
        .report-card {
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
        }
        body {
            background-color: white !important;
        }
    }
    .report-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
    }
</style>
@endsection

@section('content')
<div class="row mb-4 align-items-center no-print">
    <div class="col-md-6">
        <h2 class="fw-bold mb-1">Laporan Barang Keluar</h2>
        <p class="text-muted">Riwayat transaksi pengeluaran material dari gudang.</p>
    </div>
    <div class="col-md-6 text-md-end">
        <button onclick="window.print()" class="btn btn-teal rounded-pill px-4 shadow-sm">
            <i class="bi bi-printer me-2"></i> Cetak Laporan
        </button>
        <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary rounded-pill px-4 ms-2">
            Kembali
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm report-card">
    <div class="report-header text-center mb-5">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="img-fluid mb-3" style="max-height: 80px; border-radius: 10px;">
        <h3 class="fw-bold text-teal mb-1">LAPORAN BARANG KELUAR</h3>
        <p class="text-muted text-uppercase small fw-bold mb-0">Sistem Monitoring Inventory Consumable</p>
        @if(request('start_date') && request('end_date'))
            <p class="text-dark small mt-2">Periode: {{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') }}</p>
        @endif
        <div class="mx-auto mt-2" style="height: 2px; width: 100px; background-color: var(--primary-teal);"></div>
        <p class="text-muted small mt-2">Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle datatable">
            <thead class="bg-light">
                <tr class="text-center">
                    <th class="small text-uppercase">No</th>
                    <th class="small text-uppercase">Tanggal</th>
                    <th class="small text-uppercase">User / Departemen</th>
                    <th class="small text-uppercase">Material</th>
                    <th class="small text-uppercase">Jumlah Keluar</th>
                    <th class="small text-uppercase">Keperluan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangKeluars as $index => $bk)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($bk->tanggal)->format('d/m/Y') }}</td>
                    <td class="fw-bold text-dark text-center">{{ $bk->user_departemen }}</td>
                    <td class="fw-bold text-teal text-center">{{ $bk->material->nama_material }}</td>
                    <td class="text-center fw-bold text-danger">-{{ $bk->jumlah_keluar }}</td>
                    <td>{{ $bk->keperluan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-5 d-flex justify-content-end">
        <div class="text-center" style="width: 250px;">
            <p class="mb-5 small text-muted">Petugas Inventaris,</p>
            <br><br>
            <p class="fw-bold mb-0" style="text-decoration: underline;">{{ Auth::guard('admin')->user()->name }}</p>
            <p class="small text-muted">Administrator</p>
        </div>
    </div>
</div>
@endsection
