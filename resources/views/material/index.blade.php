@extends('layouts.admin')

@section('title', 'Data Material')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold mb-1">Master Data Material</h2>
        <p class="text-muted">Kelola informasi detail material dan stok gudang.</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('material.create') }}" class="btn btn-teal rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Tambah Material
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle datatable">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 small text-uppercase text-muted">Kode</th>
                        <th class="py-3 small text-uppercase text-muted">Nama Material</th>
                        <th class="py-3 small text-uppercase text-muted">Departemen</th>
                        <th class="py-3 small text-uppercase text-muted">Lokasi</th>
                        <th class="py-3 small text-uppercase text-muted text-center">Stok</th>
                        <th class="py-3 small text-uppercase text-muted text-center">Status</th>
                        <th class="pe-4 py-3 small text-uppercase text-muted text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $material)
                    <tr>
                        <td class="ps-4 fw-bold text-teal">{{ $material->kode_material }}</td>
                        <td class="fw-bold text-dark">{{ $material->nama_material }}</td>
                        <td>{{ $material->departemen }}</td>
                        <td><i class="bi bi-geo-alt me-1 text-muted"></i>{{ $material->lokasi_penyimpanan }}</td>
                        <td class="text-center fw-bold">{{ $material->stok }}</td>
                        <td class="text-center">
                            @php
                                $badgeClass = '';
                                if($material->status == 'Aman') $badgeClass = 'bg-success';
                                elseif($material->status == 'Warning') $badgeClass = 'bg-warning text-dark';
                                elseif($material->status == 'Reorder/Kritis' || $material->status == 'Stock Out') $badgeClass = 'bg-danger';
                                else $badgeClass = 'bg-dark';
                            @endphp
                            <span class="badge rounded-pill {{ $badgeClass }} px-3 py-2">{{ $material->status }}</span>
                        </td>
                        <td class="pe-4 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('material.edit', $material->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('material.destroy', $material->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-circle btn-delete" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
