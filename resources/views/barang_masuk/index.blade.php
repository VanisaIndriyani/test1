@extends('layouts.admin')

@section('title', 'Barang Masuk')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold mb-1">Riwayat Barang Masuk</h2>
        <p class="text-muted">Pantau semua transaksi masuk material ke gudang.</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('barang-masuk.create') }}" class="btn btn-teal rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Catat Barang Masuk
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle datatable">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 small text-uppercase text-muted">Tanggal</th>
                        <th class="py-3 small text-uppercase text-muted">No. PO</th>
                        <th class="py-3 small text-uppercase text-muted">Supplier</th>
                        <th class="py-3 small text-uppercase text-muted">Material</th>
                        <th class="py-3 small text-uppercase text-muted text-center">Jumlah</th>
                        <th class="py-3 small text-uppercase text-muted">Petugas</th>
                        <th class="pe-4 py-3 small text-uppercase text-muted text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangMasuks as $bm)
                    <tr>
                        <td class="ps-4 fw-bold text-dark">{{ \Carbon\Carbon::parse($bm->tanggal)->format('d/m/Y') }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $bm->nomor_po }}</span></td>
                        <td>{{ $bm->supplier }}</td>
                        <td class="fw-bold text-teal">{{ $bm->material->nama_material }}</td>
                        <td class="text-center fw-bold text-success">+{{ $bm->jumlah_masuk }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle p-2 me-2" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-person small text-muted"></i>
                                </div>
                                <span>{{ $bm->petugas }}</span>
                            </div>
                        </td>
                        <td class="pe-4 text-center">
                            <form action="{{ route('barang-masuk.destroy', $bm->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger rounded-circle btn-delete" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
