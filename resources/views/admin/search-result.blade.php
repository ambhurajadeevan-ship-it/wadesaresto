@extends('layouts.admin')

@section('title', 'Search Result')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h5 class="fw-bold">
            Search Result
        </h5>
        <small class="text-muted">
            Ditemukan {{ $total }} hasil untuk 
            "<strong>{{ $keyword }}</strong>"
        </small>
    </div>

    @php
        function highlight($text, $keyword) {
            return str_ireplace(
                $keyword,
                '<span class="highlight">'.$keyword.'</span>',
                $text
            );
        }
    @endphp

    {{-- MENU SECTION --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <h6 class="fw-bold mb-0">
                    Menu ({{ $menus->count() }})
                </h6>
            </div>

            @forelse($menus as $menu)
                <a href="{{ route('admin.menu.edit', ['id' => $menu->id_menu]) }}"
                    class="result-item">
                    <div>
                        <div class="fw-semibold">
                            {!! highlight($menu->nama_menu, $keyword) !!}
                        </div>
                        <small class="text-muted">
                            Rp {{ number_format($menu->harga,0,',','.') }}
                        </small>
                    </div>
                    <i class="bi bi-arrow-right"></i>
                </a>
            @empty
                <div class="text-muted small">
                    Tidak ada menu ditemukan
                </div>
            @endforelse

        </div>
    </div>

    {{-- RESERVASI SECTION --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h6 class="fw-bold mb-3">
                Reservasi ({{ $reservasis->count() }})
            </h6>

            @forelse($reservasis as $r)
                <a href="{{ route('admin.reservasi') }}"
                   class="result-item">
                    <div>
                        <div class="fw-semibold">
                            {!! highlight($r->nama_pelanggan, $keyword) !!}
                        </div>
                        <small class="text-muted">
                            {{ $r->tanggal_reservasi }} • {{ ucfirst($r->status) }}
                        </small>
                    </div>
                    <i class="bi bi-arrow-right"></i>
                </a>
            @empty
                <div class="text-muted small">
                    Tidak ada reservasi ditemukan
                </div>
            @endforelse

        </div>
    </div>

</div>

<style>

.highlight {
    background: #fff3cd;
    padding: 2px 6px;
    border-radius: 6px;
}

.result-item {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:12px 15px;
    border-radius:12px;
    text-decoration:none;
    color:#111;
    transition:.2s ease;
}

.result-item:hover {
    background:#f4f6ff;
    transform:translateX(3px);
}

</style>

@endsection