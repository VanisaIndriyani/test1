@extends('layouts.admin')

@section('title', 'Monitoring Persediaan')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Monitoring Persediaan</h2>
    <p class="text-muted">Pantau status persediaan dan parameter ROP.</p>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle datatable">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 small text-uppercase text-muted">Kode</th>
                        <th class="py-3 small text-uppercase text-muted">Nama Material</th>
                        <th class="py-3 small text-uppercase text-muted text-center">Stok</th>
                        <th class="py-3 small text-uppercase text-muted text-center">Usage Rate</th>
                        <th class="py-3 small text-uppercase text-muted text-center">Safety Stock</th>
                        <th class="py-3 small text-uppercase text-muted text-center">ROP</th>
                        <th class="py-3 small text-uppercase text-muted text-center">Status</th>
                        <th class="pe-4 py-3 small text-uppercase text-muted text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $material)
                    <tr>
                        <td class="ps-4 fw-bold text-teal">{{ $material->kode_material }}</td>
                        <td class="fw-bold text-dark">{{ $material->nama_material }}</td>
                        <td class="text-center fw-bold">{{ $material->stok }}</td>
                        <td class="text-center">{{ number_format($material->usage_rate, 0, ',', '.') }}</td>
                        <td class="text-center">{{ number_format($material->safety_stock, 0, ',', '.') }}</td>
                        <td class="text-center fw-bold text-primary">{{ number_format($material->rop, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @php
                                $badgeClass = '';
                                if($material->status == 'Aman') $badgeClass = 'bg-success';
                                elseif($material->status == 'Warning') $badgeClass = 'bg-warning text-dark';
                                elseif($material->status == 'Reorder/Kritis') $badgeClass = 'bg-danger';
                                else $badgeClass = 'bg-dark';
                            @endphp
                            <span class="badge rounded-pill {{ $badgeClass }} px-3 py-2">{{ $material->status }}</span>
                        </td>
                        <td class="pe-4 text-center">
                            <a href="{{ route('material.edit', $material->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Edit Parameter">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
