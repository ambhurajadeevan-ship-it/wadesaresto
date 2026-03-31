<!DOCTYPE html>
<html>
<head>
    <title>Wadesa Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    

    <style>

        body {
            background: #f4f4f4;
            font-family: 'Segoe UI', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #F3EFE7;
            color: #1a1a1a;
            position: fixed;
            padding: 25px 20px;
            border-right: 1px solid #e5e1d8;
            overflow-y: auto;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid #eee;
        }

        .logout-btn {
            background: #d52b2b; 
            color: black;        
            font-weight: bold;   
            text-align: center;
            padding: 12px;
            border-radius: 12px;
            text-decoration: none;
            display: block;
            transition: none; 
        }

        .logout-btn:hover {
            background: #d52b2b; 
            color: black;       
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .sidebar-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #1a1a1a;
        }

        .sidebar-group-title {
            font-size: 11px;
            font-weight: 600;
            color: #999;
            margin: 20px 0 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 40px;
            color: #1a1a1a;
        }

        .sidebar a {
            display: block;
            color: #333;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .sidebar a:hover {
            background: #e8dfcf;
            color: #000
        }

        .sidebar a.active {
            background: #0f3b34;
            color: white;
        }

        .sidebar-link.active {
            background: linear-gradient(90deg,#6f42c1,#9b59b6);
            color: #fff !important;
            border-radius: 10px;
        }

        .sidebar .btn-logout {
            background: #d9534f;
            color: white;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
        }

        .sidebar .btn-logout:hover {
            background: #c9302c;
        }

        /* MAIN */
        .main-content {
            margin-left: 240px;
            padding: 30px;
        }

        /* TOP NAV */
        .topbar {
            background: white;
            padding: 15px 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .topbar-left {
            flex: 1;
        }

        .topbar-center {
            flex: 2;
            display: flex;
            justify-content: center;
        }

        .topbar-right {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
        }

        /* STAT CARDS */
        .stat-card {
            padding: 25px;
            border-radius: 20px;
            color: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .gradient-1 { background: linear-gradient(45deg,#6366f1,#8b5cf6); }
        .gradient-2 { background: linear-gradient(45deg,#10b981,#06b6d4); }
        .gradient-3 { background: linear-gradient(45deg,#f59e0b,#ef4444); }
        .gradient-4 { background: linear-gradient(45deg,#3b82f6,#06b6d4); }

        .modern-card {
            border-radius: 20px;
            border: none;
            box-shadow: 0 5px 25px rgba(0,0,0,0.05);
        }

        .admin-container {
            padding: 30px;
        }

        .page-header {
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .page-header input {
            padding:10px 15px;
            border-radius:10px;
            border:1px solid #ddd;
            width:250px;
        }

        .stats-grid {
            display:grid;
            grid-template-columns: repeat(3,1fr);
            gap:20px;
            margin-bottom:25px;
        }

        .stat-card {
            padding:20px;
            border-radius:15px;
            color:#fff;
            box-shadow:0 8px 20px rgba(0,0,0,.08);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-card h6 {
            opacity:.8;
        }

        .stat-card.blue { background: linear-gradient(135deg,#2F80ED,#56CCF2); }
        .stat-card.yellow { background: linear-gradient(135deg,#F2994A,#F2C94C); }
        .stat-card.green { background: linear-gradient(135deg,#27AE60,#6FCF97); }
        .stat-card.red { background: linear-gradient(135deg,#EB5757,#F2994A); }

        .table-card {
            background:#fff;
            border-radius:15px;
            padding:20px;
            box-shadow:0 10px 25px rgba(0,0,0,.05);
        }

        .modern-table {
            width:100%;
            border-collapse:separate;
            border-spacing:0 10px;
        }

        .modern-table th {
            font-weight:600;
            color:#777;
        }

        .modern-table td {
            background:#f9f9f9;
            padding:15px;
            border-radius:10px;
        }

        .modern-table tr:hover td {
            background:#f1f3ff;
        }

        .user-info {
            display:flex;
            align-items:center;
            gap:10px;
        }

        .avatar {
            width:35px;
            height:35px;
            border-radius:50%;
            background:#6f42c1;
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:bold;
        }

        .badge.status {
            padding:6px 12px;
            border-radius:20px;
            font-size:12px;
        }

        .badge.pending { background:#F2C94C; color:#000; }
        .badge.confirmed { background:#27AE60; color:#fff; }
        .badge.cancelled { background:#EB5757; color:#fff; }

        .action-buttons {
            display:flex;
            gap:8px;
        }

        .btn-action {
            border:none;
            padding:6px 10px;
            border-radius:8px;
            cursor:pointer;
            font-size:14px;
        }

        .btn-action.confirm { background:#27AE60; color:#fff; }
        .btn-action.cancel { background:#F2994A; color:#fff; }
        .btn-action.delete { background:#EB5757; color:#fff; }

        .empty-state {
            text-align:center;
            padding:40px;
            color:#999;
        }

        .stats-row {
            display:flex;
            gap:20px;
            margin-bottom:25px;
        }

        .mini-stat {
            background:#fff;
            padding:20px;
            border-radius:15px;
            flex:1;
            box-shadow:0 8px 20px rgba(0,0,0,.05);
        }

        .mini-stat h6 {
            color:#888;
            margin-bottom:8px;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg,#6f42c1,#9b59b6);
            padding:10px 18px;
            border-radius:10px;
            color:#fff;
            text-decoration:none;
            font-weight:600;
        }

        .btn-primary-modern:hover {
            opacity:.9;
        }

        .table-top {
            margin-bottom:15px;
        }

        .table-top input {
            padding:10px 15px;
            border-radius:10px;
            border:1px solid #ddd;
            width:250px;
        }

        .menu-name {
            display:flex;
            align-items:center;
            gap:10px;
        }

        .menu-icon {
            width:35px;
            height:35px;
            background:#f1f3ff;
            border-radius:8px;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .harga {
            font-weight:600;
        }

        .badge.kategori {
            padding:6px 12px;
            border-radius:20px;
            font-size:12px;
        }

        .badge.makanan {
            background:#E3F2FD;
            color:#1565C0;
        }

        .badge.minuman {
            background:#E8F5E9;
            color:#2E7D32;
        }

        .btn-delete-modern {
            background:#ff4d4f;
            border:none;
            padding:6px 10px;
            border-radius:8px;
            color:#fff;
            cursor:pointer;
        }

        .btn-delete-modern:hover {
            opacity:.8;
        }

        /* SEARCH */
        .search-wrapper {
            position: relative;
            width: 100%;
            max-width: 450px;
        }

        .search-wrapper i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            font-size: 16px;
            color: #999;
            pointer-events: none;
        }

        .search-wrapper input {
            width: 100%;
            padding: 12px 18px 12px 45px; /* ruang untuk icon */
            border-radius: 30px;
            border: 1px solid #ddd;
            outline: none;
            font-size: 14px;
            transition: 0.2s ease;
        }

        .search-wrapper input:focus {
            border-color: #0f3b34;
            box-shadow: 0 0 0 2px rgba(15,59,52,0.1);
        }

        /* NOTIFICATION */
        .notification-wrapper {
            position: relative;
            cursor: pointer;
        }

        .notification-wrapper i {
            font-size: 20px;
        }

        .notif-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            font-size: 10px;
            padding: 3px 6px;
            border-radius: 50%;
        }

        /* PROFILE */
        .profile-wrapper {
            position: relative;
        }

        .profile-box {
            gap: 12px;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            object-fit: cover;
        }

        .profile-text {
            line-height: 1.2;
        }

        .profile-name {
            font-weight: 600;
            font-size: 14px;
            color: #111827;
        }

        .profile-email {
            font-size: 12px;
            color: #777;
        }

        .profile-arrow {
            font-size: 12px;
            color: #777;
            margin-left: 5px;
        }

        .modern-input {
            border-radius: 12px;
            padding: 10px 14px;
        }

        .image-upload-wrapper {
            background: #fafafa;
            border: 1px dashed #ddd;
            transition: 0.3s;
        }

        .image-upload-wrapper:hover {
            border-color: #0f3b34;
        }

        .card {
            background: #ffffff;
        }

        .pagination {
            justify-content: center;
        }

        .page-link {
            border-radius: 8px !important;
            margin: 0 4px;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg,#6f42c1,#9b59b6);
            border: none;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status.confirmed {
            background: #27AE60;
            color: #fff;
        }

        .status.pending {
            background: #F2C94C;
            color: #000;
        }

        .status.cancelled {
            background: #EB5757;
            color: #fff;
        }
        
    </style>
</head>

<body>

@php
    $admin = auth()->guard('admin')->user();
@endphp

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="sidebar-header">
        <img src="{{ asset('images/logo.png') }}" class="sidebar-logo">
        <div class="sidebar-title">WADESA</div>
    </div>

    <!-- MAIN -->
    <div class="sidebar-group-title">Main</div>

    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="{{ route('admin.reservasi') }}"
       class="{{ request()->routeIs('admin.reservasi*') ? 'active' : '' }}">
        <i class="bi bi-calendar-event"></i> Reservasi
    </a>

    <a href="{{ route('admin.pelanggan.index') }}"
       class="{{ request()->routeIs('admin.pelanggan*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Pelanggan
    </a>


    <!-- MASTER DATA -->
    <div class="sidebar-group-title">Master Data</div>

    <a href="{{ route('admin.area') }}"
       class="{{ request()->routeIs('admin.area*') ? 'active' : '' }}">
        <i class="bi bi-map"></i> Area
    </a>

    <a href="{{ route('admin.meja') }}"
       class="{{ request()->routeIs('admin.meja*') ? 'active' : '' }}">
        <i class="bi bi-grid-3x3-gap"></i> Meja
    </a>

    <a href="{{ route('admin.menu') }}"
       class="{{ request()->routeIs('admin.menu*') ? 'active' : '' }}">
        <i class="bi bi-list"></i> Menu
    </a>

    <a href="{{ route('admin.galeri') }}"
       class="{{ request()->routeIs('admin.galeri*') ? 'active' : '' }}">
        <i class="bi bi-image"></i> Galeri
    </a>


    <!-- SYSTEM -->
    <div class="sidebar-group-title">System</div>

    <a href="{{ route('admin.setting.index') }}"
       class="{{ request()->routeIs('admin.setting*') ? 'active' : '' }}">
        <i class="bi bi-gear"></i> Setting
    </a>


    <!-- LOGOUT -->
    <div class="sidebar-footer">
        <a href="{{ route('admin.logout') }}" class="logout-btn">
            Logout
        </a>
    </div>

</div>

<!-- MAIN CONTENT -->
<div class="main-content">

    <!-- TOPBAR -->
    <div class="topbar d-flex align-items-center">
        
        <!-- LEFT : PAGE TITLE -->
        <div class="topbar-left">
            <h5 class="mb-0 fw-semibold">
                @yield('title')
            </h5>
        </div>

        <!-- CENTER : SEARCH -->
        <div class="topbar-center">
            <form action="{{ route('admin.search') }}" method="GET" class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text"
                    name="q"
                    placeholder="Search menu / reservasi..."
                    value="{{ request('q') }}">
            </form>
        </div>                                                  

        <div class="topbar-right">
            <!-- NOTIFICATION -->
            <div class="notification-wrapper position-relative">
                <i class="bi bi-bell fs-5"
                   onclick="toggleNotif()"
                   style="cursor:pointer;"></i>

                <span id="notifBadge"
                      class="badge bg-danger position-absolute top-0 start-100 translate-middle"
                      style="font-size:10px;">
                    0
                </span>

                <div id="notifDropdown"
                     style="display:none; position:absolute; right:0; top:35px;
                            background:white; width:300px; padding:15px;
                            border-radius:10px; box-shadow:0 10px 25px rgba(0,0,0,.1);">

                    <div id="notifList">Loading...</div>

                </div>
            </div>

            <!-- PROFILE DROPDOWN -->
            <div class="dropdown profile-wrapper">

                <div class="profile-box d-flex align-items-center"
                    data-bs-toggle="dropdown"
                    style="cursor:pointer;">

                    <img src="{{ asset('images/logo.png') }}"
                        class="profile-avatar">

                    <div class="profile-text">
                        <div class="profile-name">
                            Hi, {{ $admin->nama_admin ?? 'Admin' }}
                        </div>
                        <div class="profile-email">
                            {{ $admin->email ?? '' }}
                        </div>
                    </div>

                    <i class="bi bi-chevron-down profile-arrow"></i>
                </div>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <a class="dropdown-item"
                        href="{{ route('admin.profile') }}">
                        <i class="bi bi-person"></i> Profile
                        </a>
                    </li>

                    <li>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>

            </div>

        </div>
    </div>

    @yield('content')

</div>


<script>
document.getElementById('searchMenu').addEventListener('keyup', function() {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll('#menuTable tbody tr');

    rows.forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value)
            ? ''
            : 'none';
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    function loadReservasi() {
        fetch("{{ route('admin.reservasi.json') }}")
            .then(res => res.json())
            .then(data => {

                let tableBody = document.getElementById('reservasiTableBody');
                if (!tableBody) return;

                tableBody.innerHTML = '';

                data.forEach(item => {
                    tableBody.innerHTML += `
                        <tr>
                            <td>${item.nama}</td>
                            <td>${item.tanggal_reservasi}</td>
                            <td>${item.jam}</td>
                            <td>${item.jumlah_orang}</td>
                            <td>${item.status}</td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.log("Fetch error:", error));
    }

    setInterval(loadReservasi, 3000);
});
</script>

<script>

function loadNotifikasi(){

    fetch("{{ route('admin.notifikasi') }}")
        .then(res => res.json())
        .then(response => {

            let badge = document.getElementById("notifBadge");
            let list  = document.getElementById("notifList");

            list.innerHTML = "";

            // Jika tidak ada notifikasi
            if(response.count === 0){

                badge.style.display = "none";

                list.innerHTML = `
                    <div class="text-center text-muted">
                        Tidak ada notifikasi
                    </div>
                `;

                return;
            }

            // tampilkan badge
            badge.style.display = "inline-block";
            badge.innerText = response.count;

            response.data.forEach(item => {

                list.innerHTML += `
                    <div onclick="openNotif(${item.id_reservasi})"
                        style="padding:10px 0; border-bottom:1px solid #eee; cursor:pointer;">

                        <strong>${item.nama_pelanggan}</strong><br>

                        <small>
                            ${item.tanggal_reservasi} - ${item.jam_reservasi}
                        </small>

                    </div>
                `;

            });

        })
        .catch(error => console.log("Notif error:", error));
}

function toggleNotif(){

    let dropdown = document.getElementById("notifDropdown");

    dropdown.style.display =
        dropdown.style.display === "none"
        ? "block"
        : "none";
}

function openNotif(id){

    fetch(`/admin/notifikasi/read/${id}`,{
        method:'POST',
        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        }
    })
    .then(()=>{

        // redirect ke halaman reservasi
        window.location.href="/admin/reservasi";

    });

}

// AUTO REFRESH SETIAP 3 DETIK
setInterval(loadNotifikasi, 3000);

// LOAD AWAL
loadNotifikasi();

</script>

<script>
document.getElementById('foto').addEventListener('change', function(event) {
    let reader = new FileReader();
    reader.onload = function(){
        document.getElementById('previewImage').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
});
</script>

<script>
document.getElementById('harga').addEventListener('input', function(e){
    let value = e.target.value.replace(/\D/g,'');
    e.target.value = value;
});
</script>

<script>
document.addEventListener("click", function(e){

    let dropdown = document.getElementById("notifDropdown");
    let bell = document.querySelector(".bi-bell");

    if(!dropdown.contains(e.target) && !bell.contains(e.target)){
        dropdown.style.display = "none";
    }

});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>