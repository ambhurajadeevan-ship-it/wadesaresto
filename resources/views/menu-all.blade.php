@extends('layouts.app')

@section('content')

<style>

.menu-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:25px;
    max-width: 1000px;
    margin: auto;
}

.menu-item{
    position:relative;
    aspect-ratio:3/4;
    overflow:hidden;
    border-radius:0px;
    cursor:pointer;
}

.menu-item img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:.5s;
    border-radius: 0px:
}

.menu-overlay{
    position:absolute;
    bottom:0;
    left:0;
    right:0;
    padding:20px;
    background:linear-gradient(
        to top,
        rgba(0,0,0,0.85),
        transparent
    );
    color:white;
    opacity:0;
    transition:0.4s;
}

.menu-item:hover img{
    transform:scale(1.1);
}

.menu-item:hover .menu-overlay{
    opacity:1;
}

@media(max-width:768px){
    .menu-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:500px){
    .menu-grid{
        grid-template-columns:1fr;
    }
}

.menu-all-section{
    padding-bottom:60px;
    background:#ffffff;
    min-height:100vh;
}

.menu-header{
    max-width:1000px;
    margin:0px auto 25px auto;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
}

.menu-title-left{
    font-family:'Playfair Display', serif;
    font-size:50px;
    letter-spacing:5px;
    color:#0F3B34;
    margin:0;
}

.menu-filter-wrapper{
    display:flex;
    gap:12px;
}

.menu-filter{
    padding:8px 22px;
    border-radius:40px;
    border:1px solid #ddd;
    text-decoration:none;
    font-size:14px;
    color:#555;
    transition:0.3s;
}

.menu-filter:hover{
    background:#f3efe7;
}

.menu-filter.active{
    background:#0F3B34;
    color:#fff;
    border-color:#0F3B34;
}

@media(max-width:768px){
    .menu-header{
        flex-direction:column;
        gap:20px;
        align-items:flex-start;
    }
}

.pt-navbar-fix{
    padding-top:80px;
}

</style>


<section class="menu-all-section pt-navbar-fix">
<div class="container">

    {{-- HEADER MENU --}}
    <div class="menu-header">

        <h2 class="menu-title-left">
            SEMUA MENU
        </h2>

        <div class="menu-filter-wrapper">

            <a href="{{ route('menu.all') }}"
            class="menu-filter {{ request('kategori') ? '' : 'active' }}">
                Semua
            </a>

            <a href="{{ route('menu.all', ['kategori' => 'makanan']) }}"
            class="menu-filter {{ request('kategori') == 'makanan' ? 'active' : '' }}">
                Makanan
            </a>

            <a href="{{ route('menu.all', ['kategori' => 'minuman']) }}"
            class="menu-filter {{ request('kategori') == 'minuman' ? 'active' : '' }}">
                Minuman
            </a>

        </div>

    </div>

    {{-- MENU GRID --}}
    <div class="menu-grid">

        @forelse($menus as $menu)

        <div class="menu-item">

            <img src="{{ asset('storage/'.$menu->foto) }}">

            <div class="menu-overlay">
                <span>{{ $menu->kategori }}</span>
                <h5>{{ $menu->nama_menu }}</h5>
                <p>
                    Rp {{ number_format($menu->harga,0,',','.') }}
                </p>
            </div>

        </div>

        @empty
            <div class="text-center w-100">
                <p>Tidak ada menu ditemukan.</p>
            </div>
        @endforelse

    </div>

</div>
</section>

@endsection