@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Laporan Sistem</h2>
    <p class="text-muted">Pilih jenis laporan yang ingin dicetak.</p>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card h-100 text-center py-4">
            <div class="card-body">
                <i class="bi bi-box-seam text-teal mb-3" style="font-size: 3rem; color: var(--primary-teal);"></i>
                <h5 class="card-title">Laporan Material</h5>
                <p class="card-text text-muted small">Daftar semua material dan stok saat ini.</p>
                <a href="{{ route('reports.material') }}" class="btn btn-teal w-100">Buka Laporan</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 text-center py-4">
            <div class="card-body">
                <i class="bi bi-arrow-down-circle text-success mb-3" style="font-size: 3rem;"></i>
                <h5 class="card-title">Laporan Barang Masuk</h5>
                <p class="card-text text-muted small">Riwayat transaksi masuk berdasarkan periode.</p>
                <button type="button" class="btn btn-teal w-100" data-bs-toggle="modal" data-bs-target="#modalMasuk">Buka Laporan</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 text-center py-4">
            <div class="card-body">
                <i class="bi bi-arrow-up-circle text-danger mb-3" style="font-size: 3rem;"></i>
                <h5 class="card-title">Laporan Barang Keluar</h5>
                <p class="card-text text-muted small">Riwayat transaksi keluar berdasarkan periode.</p>
                <button type="button" class="btn btn-teal w-100" data-bs-toggle="modal" data-bs-target="#modalKeluar">Buka Laporan</button>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 text-center py-4">
            <div class="card-body">
                <i class="bi bi-exclamation-triangle text-warning mb-3" style="font-size: 3rem;"></i>
                <h5 class="card-title">Prioritas Pengadaan</h5>
                <p class="card-text text-muted small">Daftar material kritis yang harus dipesan.</p>
                <a href="{{ route('reports.prioritas') }}" class="btn btn-teal w-100">Buka Laporan</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Barang Masuk -->
<div class="modal fade" id="modalMasuk" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter Laporan Barang Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('reports.barang-masuk') }}" method="GET">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-teal">Tampilkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Barang Keluar -->
<div class="modal fade" id="modalKeluar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter Laporan Barang Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('reports.barang-keluar') }}" method="GET">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-teal">Tampilkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
