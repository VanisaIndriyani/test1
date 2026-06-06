@extends('layouts.admin')

@section('title', 'Catat Barang Masuk')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Catat Barang Masuk</h2>
    <p class="text-muted">Input data transaksi penerimaan material.</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('barang-masuk.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor PO</label>
                    <input type="text" name="nomor_po" class="form-control" required value="{{ old('nomor_po') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Supplier</label>
                    <input type="text" name="supplier" class="form-control" required value="{{ old('supplier') }}">
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
                    <label class="form-label">Jumlah Masuk</label>
                    <input type="number" name="jumlah_masuk" class="form-control" required min="1" value="{{ old('jumlah_masuk') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Petugas</label>
                    <input type="text" name="petugas" class="form-control" required value="{{ Auth::guard('admin')->user()->name }}">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-teal">Simpan Transaksi</button>
                <a href="{{ route('barang-masuk.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
