<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Wadesa Resto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
            color: #111;
            padding-top: 120px;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }

        /* NAVBAR */
        .custom-navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 9999;
            background-color: #F3EFE7;
            padding: 20px 0;
            transition: 0.3s;
        }

        .custom-navbar.scrolled {
            padding: 12px 0;
        }

        .navbar .nav-link {
            color: #1F3D36 !important;
            margin-left: 20px;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .navbar .nav-link:hover {
            color: #0F2A24 !important;
        }

        .navbar-logo {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            object-fit: contain;
        }

        .brand-text {
            font-family:'Playfair Display', serif;
            font-weight: 600;
            font-size: 20px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #1F3D36;
        }

        .btn-gold {
            background-color: #1F3D36;
            border-color: #1F3D36;
            color: #fff;
            border-radius: 40px;
            font-weight: 500;
            padding: 10px 25px;
        }

        .btn-gold:hover {
            background-color: #162C27;
            border-color: #162C27;
            color: #fff;
        }

        /* ========================= */
        /* RESERVASI */
        /* ========================= */

        .booking-wrapper {
            padding: 90px 0 120px;
            background: linear-gradient(180deg, #ffffff 0%, #f8f8f8 100%);
        }

        .booking-card {
            background: #ffffff;
            padding: 60px;
            border-radius: 25px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.07);
            border: 1px solid #f1f1f1;
        }

        .reservation-header{
            background:#F3EFE7;
            padding:12px 0;
            color:#fff;
            margin-bottom: 25px;
        }

        .reservation-header .container{
            max-width:900px;
        }

        .booking-info{
            line-height: 1.3;
        }

        .open-label{
            font-size:12px;
            font-weight:600;
            letter-spacing:1px;
            color:#333;
        }

        .open-time{
            font-size:14px;
            font-weight:600;
            margin-top:2px;
            color: #0F2A24;
        }

        .open-address{
            font-size:12px;
            color:#555;
            margin-top:4px;
        }

        .reservation-name{
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            letter-spacing:3px;
            color: #1F3D36;
        }

        .menu-list .opacity-50 {
            pointer-events: none;
        }

        .open-time{
            font-weight:600;
        }

        .open-time span{
            font-weight:400;
            font-size:13px;
        }

        .reservation-address{
            opacity:0.7;
        }

        .form-floating-group {
            position: relative;
            margin-bottom: 30px;
        }

        .form-floating-group input,
        .form-floating-group select,
        .form-floating-group textarea {
            width: 100%;
            background: #ffffff;
            border: 1px solid #e5e5e5;
            padding: 16px 18px;
            border-radius: 14px;
            font-size: 15px;
            transition: 0.3s ease;
        }

        .form-floating-group input:focus,
        .form-floating-group select:focus,
        .form-floating-group textarea:focus {
            border-color: #1F3D36;
            box-shadow: 0 0 0 4px rgba(31,61,54,0.08);
            outline: none;
        }

        .form-floating-group label {
            position: absolute;
            top: -10px;
            left: 18px;
            background: #ffffff;
            padding: 0 8px;
            font-size: 12px;
            color: #888;
        }

        .btn-premium {
            width: 100%;
            padding: 16px;
            border-radius: 50px;
            background: #1F3D36;
            color: #ffffff;
            font-weight: 600;
            border: none;
            text-decoration: none !important;
        }

        .btn-premium:hover {
            background: #162C27;
            text-decoration: none !important;
        }

        /* FLATPICKR FIX */
        .flatpickr-calendar {
            z-index: 99999 !important;
            background: #ffffff;
            color: #111;
            border: 1px solid #eee;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .flatpickr-day.selected {
            background: #1F3D36;
            border-color: #1F3D36;
            color: #fff;
        }

        .flatpickr-day:hover {
            background: rgba(31,61,54,0.1);
        }

        html {
            scroll-behavior: smooth;
        }

        /* STEP FIX */
        .step-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-bottom: 50px;
        }

        .step-item {
            text-align: center;
        }

        .step-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #eaeaea;
            color: #999;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            transition: 0.3s;
        }

        .step-label {
            margin-top: 8px;
            font-size: 13px;
            color: #aaa;
        }

        .step-item.active .step-circle {
            background: #1F3D36;
            color: #fff;
            box-shadow: 0 8px 20px rgba(31,61,54,0.25);
        }

        .step-item.active .step-label {
            color: #1F3D36;
            font-weight: 600;
        }

        .step-line {
            width: 80px;
            height: 2px;
            background: #e5e5e5;
        }

        .step-line.active {
            background: #1F3D36;
        }

        .availability-box {
            margin-top: 10px;
            margin-bottom: 25px;
            min-height: 50px;
        }

        .availability-loading {
            background: #f5f5f5;
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 14px;
            color: #888;
            border: 1px solid #eee;
        }

        .availability-success {
            background: rgba(31,61,54,0.08);
            border: 1px solid rgba(31,61,54,0.2);
            padding: 15px 18px;
            border-radius: 14px;
            font-size: 14px;
            color: #1F3D36;
            font-weight: 500;
            animation: fadeIn 0.3s ease;
        }

        .availability-full {
            background: rgba(200, 50, 50, 0.08);
            border: 1px solid rgba(200, 50, 50, 0.25);
            padding: 15px 18px;
            border-radius: 14px;
            font-size: 14px;
            color: #b33;
            font-weight: 500;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .step-line.active {
            background: #1F3D36;
        }

        .confirmation-box {
            background: #ffffff;
            border-radius: 18px;
            padding: 30px;
            border: 1px solid #eee;
        }

        .confirm-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #f1f1f1;
            font-size: 15px;
        }

        .confirm-row:last-child {
            border-bottom: none;
        }

        .confirm-row span {
            color: #777;
        }

        .confirm-row strong {
            color: #1F3D36;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 13px;
        }

        .status-badge.pending {
            background: #f4e7c5;
            color: #8a6d3b;
        }

        .status-badge.confirmed {
            background: #d4edda;
            color: #155724;
        }

        .status-badge.cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .note-box {
            background: #F3EFE7;
            padding: 16px 20px;
            border-radius: 16px;
            font-size: 14px;
            line-height: 1.7;
            color: #333;
        }

        .form-floating-group select {
            height: 55px;
            padding-top: 20px;
        }

        .btn-disabled{
            background:#cfcfcf !important;
            cursor:not-allowed !important;
            opacity:0.6;
            pointer-events:none;
        }

        .btn-enabled{
            background:#234d45 !important;
            cursor:pointer !important;
            opacity:1;
            pointer-events:auto;
        }

        .input-icon{
            position:absolute;
            right:14px;
            top:50%;
            transform:translateY(-50%);
            color:#999;
            font-size:14px;
        }

        textarea{
            min-height:80px;
            resize:none;
        }

        .btn-outline-secondary{
            border-radius:40px;
            height:48px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <img src="{{ asset('images/logo.png') }}" class="navbar-logo">
            <span class="brand-text">Wadesa</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><a class="nav-link" href="/#home">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="/#about">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="/#menu">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="/#gallery">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="/#location">Lokasi</a></li>

                @guest
                    {{-- Guest: tampilkan link Login --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    {{--
                        Tombol Reservasi untuk guest diarahkan ke /booking (bukan ke /login).
                        Middleware auth:web akan otomatis redirect ke /login
                        dan menyimpan /booking sebagai intended URL.
                        Setelah login, user langsung diarahkan balik ke /booking.
                    --}}
                    <li class="nav-item ms-3">
                        <a href="/booking" class="btn btn-gold btn-sm">
                            Reservasi
                        </a>
                    </li>
                @else
                    {{-- User sudah login --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('booking.history') }}">
                                    Riwayat Reservasi
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item ms-3">
                        <a href="/booking" class="btn btn-gold btn-sm">
                            Reservasi
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
window.addEventListener("scroll", function() {
    let navbar = document.querySelector(".custom-navbar");
    if (window.scrollY > 80) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (document.querySelector("#tanggal_reservasi")) {
        flatpickr("#tanggal_reservasi", {
            dateFormat: "Y-m-d",
            minDate: "today",
            allowInput: true
        });
    }
});
</script>

</body>
</html>