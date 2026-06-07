@extends('layouts.admin')

@section('title', 'Prioritas Pengadaan')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Prioritas Pengadaan</h2>
    <p class="text-muted">Daftar material yang harus segera dipesan berdasarkan tingkat kekritisan.</p>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle datatable">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 small text-uppercase text-muted">Ranking</th>
                        <th class="py-3 small text-uppercase text-muted">Kode</th>
                        <th class="py-3 small text-uppercase text-muted">Nama Material</th>
                        <th class="py-3 small text-uppercase text-muted text-center">Stok</th>
                        <th class="py-3 small text-uppercase text-muted text-center">Safety Stock</th>
                        <th class="py-3 small text-uppercase text-muted text-center">ROP</th>
                        <th class="py-3 small text-uppercase text-muted text-center">Status</th>
                        <th class="pe-4 py-3 small text-uppercase text-muted text-center">Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $index => $material)
                    <tr>
                        <td class="ps-4 text-center fw-bold">{{ $index + 1 }}</td>
                        <td class="fw-bold text-teal">{{ $material->kode_material }}</td>
                        <td class="fw-bold text-dark">{{ $material->nama_material }}</td>
                        <td class="text-center fw-bold">{{ $material->stok }}</td>
                        <td class="text-center">{{ number_format($material->safety_stock, 0, ',', '.') }}</td>
                        <td class="text-center fw-bold text-primary">{{ number_format($material->rop, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @php
                                $badgeClass = '';
                                $status = strtolower($material->status);
                                if(str_contains($status, 'aman')) $badgeClass = 'bg-success';
                                elseif(str_contains($status, 'warning')) $badgeClass = 'bg-warning text-dark';
                                elseif(str_contains($status, 'kritis') || str_contains($status, 'reorder') || str_contains($status, 'stock out')) $badgeClass = 'bg-danger';
                                else $badgeClass = 'bg-dark';
                            @endphp
                            <span class="badge rounded-pill {{ $badgeClass }} px-3 py-2">{{ $material->status }}</span>
                        </td>
                        <td class="pe-4 text-center">
                            @if($material->status == 'Aman')
                                <span class="text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Stok Aman</span>
                            @else
                                <span class="text-danger fw-bold"><i class="bi bi-exclamation-triangle-fill me-1"></i> Perlu Pengadaan</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
