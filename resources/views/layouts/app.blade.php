<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Secure Ticketing')</title>

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
    </style>
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
                <ul class="navbar-nav ms-auto align-items-center">

                    @guest
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-primary" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <a class="nav-link fw-medium me-3" href="{{ route('tickets.index') }}">Tickets</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle bg-light px-3 py-2 rounded-pill shadow-sm" href="#"
                                data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a>
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
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
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
