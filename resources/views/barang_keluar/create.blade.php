@extends('layouts.admin')

@section('title', 'Catat Barang Keluar')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Catat Barang Keluar</h2>
    <p class="text-muted">Input data transaksi pengeluaran material.</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('barang-keluar.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">User / Departemen</label>
                    <input type="text" name="user_departemen" class="form-control" required value="{{ old('user_departemen') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Material</label>
                    <select name="material_id" class="form-select" required>
                        <option value="">-- Pilih Material --</option>
                        @foreach($materials as $material)
                            <option value="{{ $material->id }}">{{ $material->kode_material }} - {{ $material->nama_material }} (Stok: {{ $material->stok }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jumlah Keluar</label>
                    <input type="number" name="jumlah_keluar" class="form-control" required min="1" value="{{ old('jumlah_keluar') }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Keperluan</label>
                    <textarea name="keperluan" class="form-control" rows="3" required>{{ old('keperluan') }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-teal">Simpan Transaksi</button>
                <a href="{{ route('barang-keluar.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
