@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h4 class="mb-4">Hasil Pencarian: "{{ $q }}"</h4>

    <div class="modern-card p-4 mb-4">
        <h5>Menu</h5>
        @forelse($menus as $menu)
            <div class="mb-2">
                <strong>{{ $menu->nama_menu }}</strong>
                <span class="text-muted">({{ $menu->kategori }})</span>
            </div>
        @empty
            <p class="text-muted">Tidak ada menu ditemukan.</p>
        @endforelse
    </div>

    <div class="modern-card p-4">
        <h5>Reservasi</h5>
        @forelse($reservasis as $r)
            <div class="mb-2">
                <strong>{{ $r->nama_lengkap }}</strong>
                - {{ $r->tanggal_reservasi }}
            </div>
        @empty
            <p class="text-muted">Tidak ada reservasi ditemukan.</p>
        @endforelse
    </div>

</div>

@endsection
