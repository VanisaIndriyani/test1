@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-12">
        <h2 class="fw-bold mb-1">Dashboard Monitoring</h2>
        <p class="text-muted">Selamat datang kembali, berikut ringkasan stok material Anda hari ini.</p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="icon-box bg-teal-soft">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h6 class="text-muted fw-bold small text-uppercase mb-1">Total Material</h6>
                <h2 class="fw-bold mb-0">{{ $totalMaterial }}</h2>
                <p class="text-muted mb-0 mt-2 small">Item terdaftar</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="icon-box bg-success-soft">
                    <i class="bi bi-check2-circle"></i>
                </div>
                <h6 class="text-muted fw-bold small text-uppercase mb-1">Status Aman</h6>
                <h2 class="fw-bold mb-0 text-success">{{ $statusAman }}</h2>
                <p class="text-muted mb-0 mt-2 small">Stok mencukupi</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="icon-box bg-warning-soft">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <h6 class="text-muted fw-bold small text-uppercase mb-1">Status Warning</h6>
                <h2 class="fw-bold mb-0 text-warning">{{ $statusWarning }}</h2>
                <p class="text-muted mb-0 mt-2 small">Mendekati ROP</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="icon-box bg-danger-soft">
                    <i class="bi bi-x-octagon"></i>
                </div>
                <h6 class="text-muted fw-bold small text-uppercase mb-1">Kritis / Habis</h6>
                <h2 class="fw-bold mb-0 text-danger">{{ $statusKritis + $statusStockOut }}</h2>
                <p class="text-muted mb-0 mt-2 small">Butuh pengadaan</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-7 mb-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
                <i class="bi bi-pie-chart-fill text-teal me-2"></i>
                <span class="fw-bold">Kondisi Persediaan</span>
            </div>
            <div class="card-body">
                <div style="height: 350px;">
                    <canvas id="inventoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 mb-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
                <i class="bi bi-list-stars text-teal me-2"></i>
                <span class="fw-bold">Top 10 Material Kritis</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 small text-uppercase text-muted">Material</th>
                                <th class="py-3 small text-uppercase text-muted text-center">Stok</th>
                                <th class="pe-4 py-3 small text-uppercase text-muted text-end">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topKritis as $item)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $item->nama_material }}</div>
                                    <div class="small text-muted">{{ $item->kode_material }}</div>
                                </td>
                                <td class="text-center fw-bold">{{ $item->stok }}</td>
                                <td class="pe-4 text-end">
                                    @php
                                        $badgeClass = '';
                                        if($item->status == 'Aman') $badgeClass = 'bg-success';
                                        elseif($item->status == 'Warning') $badgeClass = 'bg-warning text-dark';
                                        elseif($item->status == 'Reorder/Kritis' || $item->status == 'Stock Out') $badgeClass = 'bg-danger';
                                        else $badgeClass = 'bg-dark';
                                    @endphp
                                    <span class="badge rounded-pill {{ $badgeClass }} px-3 py-2">{{ $item->status }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">Tidak ada data material kritis.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if($statusKritis > 0 || $statusStockOut > 0)
<div class="row">
    <div class="col-md-12">
        <div class="alert bg-white border-0 shadow-sm d-flex align-items-center p-4" style="border-radius: 20px;" role="alert">
            <div class="icon-box bg-danger-soft mb-0 me-4" style="width: 50px; height: 50px;">
                <i class="bi bi-megaphone-fill"></i>
            </div>
            <div class="flex-grow-1">
                <h5 class="fw-bold mb-1 text-dark">Perhatian!</h5>
                <p class="mb-0 text-muted">Ada <strong>{{ $statusKritis + $statusStockOut }} material</strong> yang membutuhkan tindakan segera karena stok di bawah batas aman.</p>
            </div>
            <a href="{{ route('prioritas') }}" class="btn btn-teal rounded-pill px-4 py-2">
                Lihat Prioritas <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        @if($notifications->count() > 0)
            let notifHtml = '<ul class="text-start small">';
            @foreach($notifications as $n)
                @if($n->status == 'Stock Out')
                    notifHtml += '<li><strong>{{ $n->nama_material }}</strong> telah habis (Stock Out)</li>';
                @elseif($n->status == 'Reorder/Kritis')
                    notifHtml += '<li><strong>{{ $n->nama_material }}</strong> di bawah Safety Stock</li>';
                @else
                    notifHtml += '<li><strong>{{ $n->nama_material }}</strong> di bawah ROP (Warning)</li>';
                @endif
            @endforeach
            notifHtml += '</ul>';

            Swal.fire({
                title: 'Notifikasi Stok Kritis!',
                html: notifHtml,
                icon: 'warning',
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#008080'
            });
        @endif
    });

    const ctx = document.getElementById('inventoryChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                data: {!! json_encode($chartData['data']) !!},
                backgroundColor: [
                    '#198754', // Aman
                    '#ffc107', // Warning
                    '#dc3545', // Kritis (Reorder)
                    '#b02a37'  // Stock Out (Merah Tua)
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
