@extends('layouts.admin')

@section('title', 'Monitoring Persediaan')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Monitoring Persediaan</h2>
    <p class="text-muted">Pantau status persediaan dan parameter ROP.</p>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Material</th>
                        <th>Stok</th>
                        <th>Usage Rate</th>
                        <th>Safety Stock</th>
                        <th>ROP</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $material)
                    <tr>
                        <td>{{ $material->kode_material }}</td>
                        <td>{{ $material->nama_material }}</td>
                        <td>{{ $material->stok }}</td>
                        <td>{{ number_format($material->usage_rate, 2) }}</td>
                        <td>{{ number_format($material->safety_stock, 2) }}</td>
                        <td>{{ number_format($material->rop, 2) }}</td>
                        <td>
                            @php
                                $badgeClass = '';
                                if($material->status == 'Aman') $badgeClass = 'badge-aman';
                                elseif($material->status == 'Warning') $badgeClass = 'badge-warning';
                                elseif($material->status == 'Reorder/Kritis') $badgeClass = 'badge-kritis';
                                else $badgeClass = 'badge-stockout';
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $material->status }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
