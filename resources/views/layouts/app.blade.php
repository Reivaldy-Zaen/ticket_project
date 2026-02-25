<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Secure Ticketing') - SMK Wikrama Bogor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-soft: #88d3ce;
            --primary-dark: #6ebfb9;
            --bg-body: #f4f7f6;
            --text-dark: #2d3436;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: white !important;
            border-bottom: 1px solid #e0e6ed;
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--text-dark) !important;
            display: flex;
            align-items: center;
        }

        .brand-icon {
            background: var(--primary-soft);
            color: white;
            padding: 8px;
            border-radius: 10px;
            margin-right: 10px;
            display: flex;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            background: white;
        }

        .btn-primary {
            background-color: var(--primary-soft);
            border: none;
            color: #2d3436;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 12px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            color: white;
        }

        .dropdown-header {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            color: #95a5a6;
            padding: 0.5rem 1.25rem;
        }

        .footer {
            background-color: white;
            border-top: 1px solid #e0e6ed;
            padding: 2rem 0;
            margin-top: auto;
        }

        pre code {
            font-size: 0.85rem;
        }
    </style>

    @stack('styles')
</head>

<body>
    {{-- ============================================ --}}
    {{-- NAVIGATION --}}
    {{-- ============================================ --}}
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <div class="brand-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <span>SECURE TICKET</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto align-items-center">
                    @auth
                        {{-- Tickets --}}
                        <li class="nav-item">
                            <a class="nav-link fw-medium {{ request()->routeIs('tickets.*') ? 'text-primary' : '' }}"
                                href="{{ route('tickets.index') }}">
                                <i class="bi bi-ticket-detailed me-1"></i> Tickets
                            </a>
                        </li>

                        {{-- Security Testing --}}
                        <li class="nav-item">
                            <a class="nav-link fw-medium {{ request()->routeIs('security-testing.*') ? 'text-primary' : '' }}"
                                href="{{ route('security-testing.index') }}">
                                <i class="bi bi-shield-shaded me-1"></i> Security Testing
                            </a>
                        </li>

                        {{-- Validation Lab --}}
                        <li class="nav-item">
                            <a class="nav-link fw-medium {{ request()->routeIs('validation-lab.*') ? 'text-primary' : '' }}"
                                href="{{ route('validation-lab.index') }}">
                                <i class="bi bi-check-circle me-1"></i> Validation Lab
                            </a>
                        </li>

                        {{-- Demo Blade Dropdown --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-medium {{ request()->routeIs('demo-blade.*') ? 'text-primary' : '' }}" 
                                href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-code-slash me-1"></i> Demo Blade
                            </a>
                            <ul class="dropdown-menu border-0 shadow-lg">
                                <li><a class="dropdown-item" href="{{ route('demo-blade.index') }}">Overview</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('demo-blade.directives') }}">Directives</a></li>
                                <li><a class="dropdown-item" href="{{ route('demo-blade.components') }}">Components</a></li>
                                <li><a class="dropdown-item" href="{{ route('demo-blade.includes') }}">Includes</a></li>
                                <li><a class="dropdown-item" href="{{ route('demo-blade.stacks') }}">Stacks</a></li>
                            </ul>
                        </li>

                        {{-- XSS Lab Dropdown --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-medium {{ request()->routeIs('xss-lab.*') ? 'text-primary' : '' }}" 
                                href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-shield-exclamation me-1"></i> XSS Lab
                            </a>
                            <ul class="dropdown-menu border-0 shadow-lg">
                                <li><a class="dropdown-item" href="{{ route('xss-lab.index') }}">Overview</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="dropdown-header">Reflected XSS</li>
                                <li><a class="dropdown-item text-danger" href="{{ route('xss-lab.reflected.vulnerable') }}">Vulnerable</a></li>
                                <li><a class="dropdown-item text-success" href="{{ route('xss-lab.reflected.secure') }}">Secure</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="dropdown-header">Stored XSS</li>
                                <li><a class="dropdown-item text-danger" href="{{ route('xss-lab.stored.vulnerable') }}">Vulnerable</a></li>
                                <li><a class="dropdown-item text-success" href="{{ route('xss-lab.stored.secure') }}">Secure</a></li>
                            </ul>
                        </li>

                        {{-- CSRF Lab Dropdown (NEW) --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-medium {{ request()->routeIs('csrf-lab.*') ? 'text-primary' : '' }}" 
                                href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-key me-1"></i> CSRF Lab
                            </a>
                            <ul class="dropdown-menu border-0 shadow-lg">
                                <li><a class="dropdown-item" href="{{ route('csrf-lab.index') }}">Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('csrf-lab.how-it-works') }}"><i class="bi bi-lightbulb text-info me-2"></i>How It Works</a></li>
                                <li><a class="dropdown-item" href="{{ route('csrf-lab.attack-demo') }}"><i class="bi bi-bug text-danger me-2"></i>Attack Demo</a></li>
                                <li><a class="dropdown-item" href="{{ route('csrf-lab.protection-demo') }}"><i class="bi bi-shield-check text-success me-2"></i>Protection Demo</a></li>
                                <li><a class="dropdown-item" href="{{ route('csrf-lab.ajax-demo') }}"><i class="bi bi-lightning text-warning me-2"></i>AJAX Demo</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>

                {{-- User Menu --}}
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle bg-light px-3 py-2 rounded-pill shadow-sm" href="#"
                                data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-primary" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- ============================================ --}}
    {{-- MAIN CONTENT --}}
    {{-- ============================================ --}}
    <main class="container py-5">
        {{-- Flash Success --}}
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Flash Error --}}
        @if (session('error'))
            <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div>{{ session('error') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-exclamation-octagon-fill me-2"></i>
                    <strong>Terjadi Kesalahan Input:</strong>
                </div>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- ============================================ --}}
    {{-- FOOTER --}}
    {{-- ============================================ --}}
    <footer class="footer">
        <div class="container text-center">
            <p class="mb-1 fw-bold">
                <i class="bi bi-shield-lock"></i> SECURE TICKET SYSTEM
            </p>
            <p class="mb-0 text-muted small">
                &copy; {{ date('Y') }} Bootcamp Secure Coding - SMK Wikrama Bogor
            </p>
            <div class="mt-3">
                <span class="badge rounded-pill bg-light text-dark border">Hari 3: CSRF</span>
                <span class="badge rounded-pill bg-light text-dark border">Hari 4: Blade & XSS</span>
                <span class="badge rounded-pill bg-light text-dark border">Hari 5: Final Lab</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Global CSRF Setup untuk AJAX --}}
    <script>
        // Ambil token dari meta tag
        window.csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Global Helper untuk Fetch API agar otomatis membawa CSRF Token
        window.secureFetch = function(url, options = {}) {
            options.headers = {
                ...options.headers,
                'X-CSRF-TOKEN': window.csrfToken,
                'Accept': 'application/json',
            };
            return fetch(url, options);
        };

        // Jika menggunakan Axios (opsional, jika librarynya ada)
        if (typeof axios !== 'undefined') {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = window.csrfToken;
        }
    </script>

    @stack('scripts')
</body>

</html>