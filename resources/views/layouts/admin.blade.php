<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Manajemen Persediaan</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">


    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>
<body>
    <div class="d-flex wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="img-fluid mb-2 rounded bg-white p-1" style="max-height: 100px; width: 100px; object-fit: contain;">
                <h3 class="fs-5 fw-bold text-white">SIMPM</h3>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                </li>
                <li class="{{ Request::is('material*') ? 'active' : '' }}">
                    <a href="{{ route('material.index') }}"><i class="bi bi-box-seam me-2"></i> Data Material</a>
                </li>
                <li class="{{ Request::is('barang-masuk*') ? 'active' : '' }}">
                    <a href="{{ route('barang-masuk.index') }}"><i class="bi bi-arrow-down-circle me-2"></i> Barang Masuk</a>
                </li>
                <li class="{{ Request::is('barang-keluar*') ? 'active' : '' }}">
                    <a href="{{ route('barang-keluar.index') }}"><i class="bi bi-arrow-up-circle me-2"></i> Barang Keluar</a>
                </li>
                <li class="{{ Request::is('monitoring') ? 'active' : '' }}">
                    <a href="{{ route('monitoring') }}"><i class="bi bi-display me-2"></i> Monitoring</a>
                </li>
                <li class="{{ Request::is('prioritas') ? 'active' : '' }}">
                    <a href="{{ route('prioritas') }}"><i class="bi bi-exclamation-triangle me-2"></i> Prioritas Pengadaan</a>
                </li>
                <li class="{{ Request::is('reports*') ? 'active' : '' }}">
                    <a href="{{ route('reports.index') }}"><i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div id="content" class="p-0">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
                <div class="container-fluid px-4">
                    <button type="button" id="sidebarCollapse" class="btn">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <span class="navbar-brand ms-3 fw-bold text-teal d-none d-md-inline">INVENTORY MASTER</span>
                    
                    <div class="ms-auto d-flex align-items-center py-2">
                        <div class="d-flex align-items-center me-3 border-end pe-3">
                            <div class="bg-teal rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; background-color: rgba(0,128,128,0.1);">
                                <i class="bi bi-person-fill text-teal"></i>
                            </div>
                            <span class="d-none d-md-inline fw-semibold text-dark">{{ Auth::guard('admin')->user()->name }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // Global SweetAlert for Success
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            // Global SweetAlert for Error
            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: '<ul class="text-start">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>'
                });
            @endif

            $('.datatable').DataTable({
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Lanjut",
                        "previous": "Kembali"
                    }
                }
            });

            // Reusable Delete Confirmation
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        document.getElementById('sidebarCollapse')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
    @yield('scripts')
</body>
</html>
