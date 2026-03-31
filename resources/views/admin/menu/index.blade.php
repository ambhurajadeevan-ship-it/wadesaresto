@extends('layouts.admin')

@section('title', 'MENU')

@section('content')

<div class="admin-container">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Kelola Menu</h4>
        </div>

        <a href="{{ route('admin.menu.create') }}"
           class="btn btn-dark-green px-4 rounded-3 shadow-sm">
            <i class="bi bi-plus-lg"></i> Tambah Menu
        </a>
    </div>


    <!-- MINI STATS -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="mini-stat-card">
                <div>Total Menu</div>
                <h3>{{ $total }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="mini-stat-card">
                <div>Makanan</div>
                <h3>{{ $makanan }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="mini-stat-card">
                <div>Minuman</div>
                <h3>{{ $minuman }}</h3>
            </div>
        </div>
    </div>


    <!-- FILTER + SEARCH -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div class="d-flex gap-2">
            <a href="{{ route('admin.menu') }}"
               class="btn btn-light btn-sm rounded-3">Semua</a>

            <a href="{{ route('admin.menu',['kategori'=>'makanan']) }}"
               class="btn btn-light btn-sm rounded-3">Makanan</a>

            <a href="{{ route('admin.menu',['kategori'=>'minuman']) }}"
               class="btn btn-light btn-sm rounded-3">Minuman</a>
        </div>

        <form method="GET" class="search-mini">
            <i class="bi bi-search"></i>
            <input type="text"
                   name="q"
                   placeholder="Cari menu..."
                   value="{{ request('q') }}">
        </form>
    </div>


    <!-- TABLE CARD -->
    <div class="modern-table-card">

        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($menus as $menu)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('storage/'.$menu->foto) }}"
                                 class="menu-thumb">
                            <div>
                                <div class="fw-semibold">
                                    {{ $menu->nama_menu }}
                                </div>
                                <small class="text-muted">
                                    ID: {{ $menu->id_menu }}
                                </small>
                            </div>
                        </div>
                    </td>

                    <td>
                        <span class="badge-soft {{ $menu->kategori }}">
                            {{ ucfirst($menu->kategori) }}
                        </span>
                    </td>

                    <td class="fw-semibold">
                        Rp {{ number_format($menu->harga,0,',','.') }}
                    </td>

                    <td>
                        @if($menu->is_available)
                            <span style="background:#28a745;color:white;padding:5px 10px;border-radius:5px;">
                                Tersedia
                            </span>
                        @else
                            <span style="background:#dc3545;color:white;padding:5px 10px;border-radius:5px;">
                                Tidak Tersedia
                            </span>
                        @endif
                    </td>

                    <td class="text-end">
                        <div class="d-inline-flex gap-2">

                            <form action="{{ route('admin.menu.toggle', $menu->id_menu) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')

                                <button type="submit" style="padding:5px 10px;">
                                    {{ $menu->is_available ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>

                            <a href="{{ route('admin.menu.edit',$menu->id_menu) }}"
                               class="btn-icon btn-edit">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.menu.destroy',$menu->id_menu) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-icon btn-delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Belum ada menu tersedia</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $menus->links() }}
        </div>

    </div>

</div>

<style>
.mini-stat-card {
    background: #fff;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0,0,0,.05);
    font-weight: 500;
}

.mini-stat-card h3 {
    font-weight: 700;
    margin-top: 8px;
}

.modern-table-card {
    background: #fff;
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,.05);
}

.menu-thumb {
    width: 55px;
    height: 55px;
    object-fit: cover;
    border-radius: 14px;
}

.table tbody tr {
    transition: .2s ease;
}

.table tbody tr:hover {
    background: #f9fafb;
    transform: scale(1.01);
}

.btn-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    border: none;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition:.2s;
}

.btn-edit {
    background:#eef2ff;
    color:#4338ca;
}

.btn-edit:hover {
    background:#c7d2fe;
}

.btn-delete {
    background:#fee2e2;
    color:#dc2626;
}

.btn-delete:hover {
    background:#fecaca;
}

.badge-soft {
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:500;
}

.badge-soft.makanan {
    background:#e0f2fe;
    color:#0369a1;
}

.badge-soft.minuman {
    background:#dcfce7;
    color:#15803d;
}

.search-mini {
    position:relative;
    width:250px;
}

.search-mini i {
    position:absolute;
    left:12px;
    top:50%;
    transform:translateY(-50%);
    color:#aaa;
}

.search-mini input {
    width:100%;
    padding:8px 12px 8px 35px;
    border-radius:10px;
    border:1px solid #ddd;
}

.empty-state {
    text-align:center;
    padding:40px;
    color:#999;
}

.empty-state i {
    font-size:40px;
    display:block;
    margin-bottom:10px;
}

.btn-dark-green {
    background: #0f3b34;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 12px;
    font-weight: 600;
    transition: 0.3s ease;
}

.btn-dark-green:hover {
    background: #0c2f2a;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(15,59,52,0.3);
    color: #fff;
}
</style>

@endsection