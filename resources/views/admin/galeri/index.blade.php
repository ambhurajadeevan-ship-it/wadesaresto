@extends('layouts.admin')

@section('title', 'GALERI')

@section('content')

<div class="admin-page">

    <!-- HEADER -->
    <div class="page-header">
        <a href="{{ route('admin.galeri.create') }}" class="btn-add">
            + Tambah Foto
        </a>
    </div>

    <!-- GRID -->
    <div class="gallery-grid">

        @forelse($galeris as $galeri)
            <div class="gallery-card">

                <div class="img-wrapper">
                    <img src="{{ asset('storage/'.$galeri->foto) }}">

                    <!-- Overlay -->
                    <div class="overlay">
                        <form action="{{ route('admin.galeri.destroy', $galeri->id_galeri) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                            @csrf
                            @method('DELETE')

                            <button class="btn-delete">
                                🗑 Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <div class="gallery-info">
                    <small>
                        {{ \Carbon\Carbon::parse($galeri->created_at)->format('d M Y') }}
                    </small>
                </div>

            </div>
        @empty
            <div class="empty-state">
                <p>Belum ada foto galeri.</p>
            </div>
        @endforelse

    </div>

</div>


<style>

/* PAGE */
.admin-page {
    padding: 20px;
}

/* HEADER */
.page-header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.page-header h2 {
    font-weight:600;
}

.btn-add {
    background: linear-gradient(135deg,#0f3b34,#145c4c);
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    font-weight:500;
    transition:0.3s;
}

.btn-add:hover {
    opacity:0.9;
    transform:translateY(-2px);
}

/* GRID */
.gallery-grid {
    display:grid;
    grid-template-columns: repeat(auto-fill, minmax(260px,1fr));
    gap:25px;
}

/* CARD */
.gallery-card {
    background:white;
    border-radius:16px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,0.05);
    transition:0.3s;
}

.gallery-card:hover {
    transform:translateY(-6px);
    box-shadow:0 15px 35px rgba(0,0,0,0.1);
}

/* IMAGE */
.img-wrapper {
    position:relative;
    height:220px;
    overflow:hidden;
}

.img-wrapper img {
    width:100%;
    height:100%;
    object-fit:cover;
    transition:0.5s;
}

.gallery-card:hover img {
    transform:scale(1.08);
}

/* OVERLAY */
.overlay {
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.5);
    display:flex;
    justify-content:center;
    align-items:center;
    opacity:0;
    transition:0.3s;
}

.gallery-card:hover .overlay {
    opacity:1;
}

.btn-delete {
    background:#e74a3b;
    color:white;
    border:none;
    padding:8px 14px;
    border-radius:6px;
    cursor:pointer;
    font-size:14px;
    transition:0.3s;
}

.btn-delete:hover {
    background:#c0392b;
}

/* INFO */
.gallery-info {
    padding:12px;
    text-align:center;
    font-size:13px;
    color:#777;
}

/* EMPTY */
.empty-state {
    text-align:center;
    padding:40px;
    color:#777;
}

</style>

@endsection
