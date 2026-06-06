@extends('layouts.admin')

@section('title', 'Barang Keluar')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold mb-1">Riwayat Barang Keluar</h2>
        <p class="text-muted">Pantau semua transaksi pengeluaran material dari gudang.</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('barang-keluar.create') }}" class="btn btn-teal rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Catat Barang Keluar
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
                        <th class="py-3 small text-uppercase text-muted">User / Departemen</th>
                        <th class="py-3 small text-uppercase text-muted">Material</th>
                        <th class="py-3 small text-uppercase text-muted text-center">Jumlah</th>
                        <th class="py-3 small text-uppercase text-muted">Keperluan</th>
                        <th class="pe-4 py-3 small text-uppercase text-muted text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangKeluars as $bk)
                    <tr>
                        <td class="ps-4 fw-bold text-dark">{{ \Carbon\Carbon::parse($bk->tanggal)->format('d/m/Y') }}</td>
                        <td class="fw-bold text-dark">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle p-2 me-2" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-building small text-muted"></i>
                                </div>
                                <span>{{ $bk->user_departemen }}</span>
                            </div>
                        </td>
                        <td class="fw-bold text-teal">{{ $bk->material->nama_material }}</td>
                        <td class="text-center fw-bold text-danger">-{{ $bk->jumlah_keluar }}</td>
                        <td><span class="text-muted small">{{ Str::limit($bk->keperluan, 40) }}</span></td>
                        <td class="pe-4 text-center">
                            <form action="{{ route('barang-keluar.destroy', $bk->id) }}" method="POST">
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
