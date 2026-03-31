<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Wadesa Resto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .admin-navbar {
            background: #111;
        }

        .admin-navbar .nav-link {
            color: #ccc;
            font-size: 14px;
            margin-right: 15px;
        }

        .admin-navbar .nav-link:hover {
            color: #fff;
        }

        .admin-navbar .active {
            color: #d4b16a !important;
            font-weight: 600;
        }

        .admin-content {
            padding: 30px 0;
        }
    </style>
</head>
<body>

<!-- TOP NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark admin-navbar">
    <div class="container">

        <a class="navbar-brand fw-semibold" href="{{ route('admin.dashboard') }}">
            Admin Panel
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNav">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/menu*') ? 'active' : '' }}"
                       href="{{ route('admin.menu') }}">
                        Menu
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/reservasi*') ? 'active' : '' }}"
                       href="{{ route('admin.reservasi') }}">
                        Reservasi
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/galeri*') ? 'active' : '' }}"
                       href="{{ route('admin.galeri') }}">
                        Galeri
                    </a>
                </li>

            </ul>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>

        </div>

    </div>
</nav>

<!-- CONTENT -->
<div class="container admin-content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
