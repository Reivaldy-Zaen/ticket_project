<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Secure Ticketing') - SMK Wikrama Bogor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

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
        }
    </style>

    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <div class="brand-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <span>SECURE TICKET</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto align-items-center">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link fw-medium {{ request()->routeIs('tickets.*') ? 'text-primary' : '' }}"
                                href="{{ route('tickets.index') }}">
                                <i class="bi bi-ticket-detailed me-1"></i> Tickets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium {{ request()->routeIs('security-testing.*') ? 'text-primary' : '' }}"
                                href="{{ route('security-testing.index') }}">
                                <i class="bi bi-shield-check me-1"></i> Security Testing
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium {{ request()->routeIs('validation-lab.*') ? 'text-primary' : '' }}"
                                href="{{ route('validation-lab.index') }}">
                                <i class="bi bi-shield-check me-1"></i> Validation Lab
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-medium" href="#" role="button"
                                data-bs-toggle="dropdown">
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

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-medium" href="#" role="button"
                                data-bs-toggle="dropdown">
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
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                    {{-- @guest
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-primary" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                    @endguest --}}

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
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>