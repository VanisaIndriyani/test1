<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Manajemen Persediaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .password-toggle {
            cursor: pointer;
            transition: color 0.2s;
        }
        .password-toggle:hover {
            color: var(--primary-teal) !important;
        }
        .input-group {
            transition: all 0.3s;
            border-radius: 10px;
            overflow: hidden;
        }
        .input-group:focus-within {
            box-shadow: 0 0 0 0.25rem rgba(0, 128, 128, 0.1);
            border-color: var(--primary-teal) !important;
        }
        .login-logo-img {
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));
            transition: transform 0.3s;
        }
        .login-logo-img:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="login-container px-3">
        <div class="card login-card shadow-lg border-0">
            <div class="row g-0">
                <!-- Left Side: Logo & Branding -->
                <div class="col-md-6 login-logo-section d-none d-md-flex">
                    <div class="text-center p-4">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="img-fluid login-logo-img mb-4" style="max-height: 280px; border-radius: 20px;">
                        <h2 class="fw-bold mb-2" style="color: var(--primary-teal); letter-spacing: 2px;">INVENTORY MASTER</h2>
                        <div class="mx-auto bg-teal mb-3" style="height: 4px; width: 60px; background-color: var(--primary-teal); border-radius: 2px;"></div>
                        <p class="text-muted text-uppercase small fw-bold" style="letter-spacing: 1px;">Sistem Monitoring Inventory Consumable</p>
                    </div>
                </div>
                
                <!-- Right Side: Login Form -->
                <div class="col-md-6 login-form-section bg-white">
                    <div class="mb-4 text-center d-md-none">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="img-fluid rounded shadow-sm mb-3" style="max-height: 100px;">
                        <h4 class="fw-bold text-teal">SIMPM</h4>
                    </div>
                    
                    <div class="mb-5">
                        <h2 class="fw-bold text-dark">Selamat Datang!</h2>
                        <p class="text-muted">Masukkan kredensial Anda untuk mengakses sistem.</p>
                    </div>
                    
                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label small fw-bold text-uppercase text-muted">Email Address</label>
                            <div class="input-group border">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-envelope-fill text-muted"></i></span>
                                <input type="email" name="email" id="email" class="form-control bg-light border-0 py-2" placeholder="admin@gmail.com" required value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label small fw-bold text-uppercase text-muted">Password</label>
                            <div class="input-group border">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-lock-fill text-muted"></i></span>
                                <input type="password" name="password" id="password" class="form-control bg-light border-0 py-2" placeholder="••••••••" required>
                                <span class="input-group-text bg-light border-0 password-toggle" onclick="togglePassword()">
                                    <i class="bi bi-eye-fill text-muted" id="toggleIcon"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                            </div>
                        
                        </div>

                        <div class="d-grid gap-2 pt-2">
                            <button type="submit" class="btn btn-teal py-3 fw-bold text-uppercase shadow" style="letter-spacing: 1px;">
                                Sign In Now <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                    
                    <div class="mt-5 text-center">
                        <p class="text-muted small mb-0">&copy; {{ date('Y') }}  Versi 1.0.0</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
            }
        }
    </script>
</body>
</html>
