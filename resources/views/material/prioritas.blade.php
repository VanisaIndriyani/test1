@extends('layouts.admin')

@section('title', 'Prioritas Pengadaan')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Prioritas Pengadaan</h2>
    <p class="text-muted">Daftar material yang harus segera dipesan berdasarkan tingkat kekritisan.</p>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Ranking</th>
                        <th>Kode</th>
                        <th>Nama Material</th>
                        <th>Stok</th>
                        <th>Safety Stock</th>
                        <th>ROP</th>
                        <th>Status</th>
                        <th>Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $index => $material)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $material->kode_material }}</td>
                        <td>{{ $material->nama_material }}</td>
                        <td>{{ $material->stok }}</td>
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
                        <td>
                            @if($material->status == 'Stock Out')
                                <span class="text-danger fw-bold">Segera Order! (Stok Habis)</span>
                            @elseif($material->status == 'Reorder/Kritis')
                                <span class="text-danger fw-bold">Segera Order! (Di bawah Safety Stock)</span>
                            @elseif($material->status == 'Warning')
                                <span class="text-warning fw-bold">Siapkan Order (Di bawah ROP)</span>
                            @else
                                <span class="text-success">Stok Aman</span>
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
