@extends('layouts.admin')

@section('title', 'Tambah Material')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Tambah Material Baru</h2>
    <p class="text-muted">Lengkapi form di bawah untuk menambahkan material.</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('material.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Material</label>
                    <input type="text" name="kode_material" class="form-control" required value="{{ old('kode_material') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Material</label>
                    <input type="text" name="nama_material" class="form-control" required value="{{ old('nama_material') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Departemen</label>
                    <input type="text" name="departemen" class="form-control" value="{{ old('departemen') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Lokasi Penyimpanan</label>
                    <input type="text" name="lokasi_penyimpanan" class="form-control" value="{{ old('lokasi_penyimpanan') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Stok Awal</label>
                    <input type="number" name="stok" class="form-control" required value="{{ old('stok', 0) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Lead Time (Hari)</label>
                    <input type="number" name="lead_time" class="form-control" required value="{{ old('lead_time', 0) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Periode Pemakaian (Hari/Bulan)</label>
                    <input type="number" name="periode" class="form-control" required value="{{ old('periode', 30) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-teal fw-bold">Usage Rate (Manual)</label>
                    <input type="number" step="0.01" name="usage_rate" class="form-control border-teal" required value="{{ old('usage_rate', 0) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-teal fw-bold">Safety Stock (Manual)</label>
                    <input type="number" step="0.01" name="safety_stock" class="form-control border-teal" required value="{{ old('safety_stock', 0) }}">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-teal">Simpan Material</button>
                <a href="{{ route('material.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
