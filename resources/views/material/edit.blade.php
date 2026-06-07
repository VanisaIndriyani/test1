@extends('layouts.admin')

@section('title', 'Edit Material')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Edit Material</h2>
    <p class="text-muted">Perbarui informasi material: {{ $material->nama_material }}</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('material.update', $material->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Material</label>
                    <input type="text" name="kode_material" class="form-control" required value="{{ old('kode_material', $material->kode_material) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Material</label>
                    <input type="text" name="nama_material" class="form-control" required value="{{ old('nama_material', $material->nama_material) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Departemen</label>
                    <input type="text" name="departemen" class="form-control" value="{{ old('departemen', $material->departemen) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Lokasi Penyimpanan</label>
                    <input type="text" name="lokasi_penyimpanan" class="form-control" value="{{ old('lokasi_penyimpanan', $material->lokasi_penyimpanan) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" required value="{{ old('stok', $material->stok) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Lead Time (Hari)</label>
                    <input type="number" name="lead_time" class="form-control" required value="{{ old('lead_time', $material->lead_time) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Periode Pemakaian (Hari/Bulan)</label>
                    <input type="number" name="periode" class="form-control" required value="{{ old('periode', $material->periode) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-teal fw-bold">Usage Rate (Manual)</label>
                    <input type="number" name="usage_rate" class="form-control border-teal" required value="{{ old('usage_rate', $material->usage_rate) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-teal fw-bold">Safety Stock (Manual)</label>
                    <input type="number" name="safety_stock" class="form-control border-teal" required value="{{ old('safety_stock', $material->safety_stock) }}">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-teal">Update Material</button>
                <a href="{{ route('material.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
