@extends('layouts.app')

@section('title', 'Login - Secure Ticketing')

@section('content')
    <div class="container-fluid px-md-5">
        <div class="row g-0 shadow-lg rounded-4 overflow-hidden border bg-white" style="min-height: 80vh;">

            {{-- PANEL KIRI: BRANDING & VISUAL --}}
            <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center p-5 text-white text-center"
                style="background: linear-gradient(135deg, #88d3ce 0%, #6ebfb9 100%);">
                <div class="mb-4">
                    <i class="bi bi-shield-lock-fill" style="font-size: 5rem;"></i>
                </div>
                <h1 class="fw-bold mb-3">Selamat Datang Kembali</h1>
                <p class="lead opacity-75">Sistem bantuan terpadu untuk solusi cepat dan aman bagi seluruh warga SMK Wikrama
                    Bogor.</p>

                <div class="mt-4 p-3 bg-white bg-opacity-10 rounded-4 border border-white border-opacity-25 w-75">
                    <small class="d-block mb-1 opacity-75 text-uppercase letter-spacing-1">Keamanan Prioritas Kami</small>
                    <span class="small">Pastikan Anda menggunakan akun resmi yang terdaftar.</span>
                </div>
            </div>

            {{-- PANEL KANAN: FORM LOGIN --}}
            <div class="col-md-6 p-5 bg-white d-flex align-items-center">
                <div class="w-100 px-lg-5">
                    <div class="mb-5">
                        <h2 class="fw-bold h3 mb-2 text-dark">Login Ke Akun</h2>
                        <p class="text-muted small">Silakan masukkan kredensial Anda untuk melanjutkan.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email"
                                class="form-label fw-bold small text-muted uppercase letter-spacing-1">ALAMAT EMAIL</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light px-3 text-muted">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" name="email" id="email"
                                    class="form-control form-control-lg border-0 bg-light px-3 py-3 @error('email') is-invalid @enderror"
                                    placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between">
                                <label for="password"
                                    class="form-label fw-bold small text-muted uppercase letter-spacing-1">PASSWORD</label>
                                <a href="#" class="text-decoration-none small"
                                    style="color: var(--primary-soft);">Lupa Password?</a>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light px-3 text-muted">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password" id="password"
                                    class="form-control form-control-lg border-0 bg-light px-3 py-3 @error('password') is-invalid @enderror"
                                    placeholder="••••••••" required>
                                {{-- Ikon Mata --}}
                                <button class="btn btn-light border-0 bg-light text-muted px-3" type="button"
                                    id="togglePassword" style="border-radius: 0 12px 12px 0;">
                                    <i class="bi bi-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small text-muted" for="remember">
                                    Ingat saya di perangkat ini
                                </label>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg py-3 shadow-lg border-0 fw-bold">
                                Masuk Sekarang <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>

                        <p class="text-center text-muted small mb-0">
                            Belum punya akun? <a href="#" class="fw-bold text-decoration-none"
                                style="color: var(--primary-soft);">Hubungi Admin</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (min-width: 992px) {
            body {
                overflow: hidden;
                height: 100vh;
            }

            main.container {
                display: flex;
                align-items: center;
                justify-content: center;
                height: calc(100vh - 120px);
            }
        }

        .form-control:focus {
            background-color: #f1f3f5 !important;
            box-shadow: none;
            border: 1px solid var(--primary-soft) !important;
        }

        .input-group-text {
            border-radius: 12px 0 0 12px;
        }

        .form-control {
            border-radius: 0 12px 12px 0;
        }

        .letter-spacing-1 {
            letter-spacing: 1px;
        }

        .uppercase {
            text-transform: uppercase;
        }

        /* Custom Checkbox Color */
        .form-check-input:checked {
            background-color: var(--primary-soft);
            border-color: var(--primary-soft);
        }
    </style>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function(e) {
            // Toggle tipe input
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle ikon
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });
    </script>
@endsection
