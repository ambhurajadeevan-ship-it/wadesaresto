@extends('layouts.app')

@section('content')

<section class="py-5 bg-light">
    <div class="container">

        <h2 class="text-center mb-5 fw-bold">Menu</h2>

        <div class="row g-4">

            @foreach($menus as $menu)
            <div class="col-md-4 col-sm-6">

                <div class="menu-card">

                    <div class="menu-img-wrapper">
                        <img src="{{ asset('storage/menu/'.$menu->foto) }}"
                             class="card-img-top"
                             alt="{{ $menu->nama }}">
                    </div>

                    <div class="p-3 text-center">

                        <h5 class="fw-semibold mb-1">
                            {{ $menu->nama }}
                        </h5>

                        <small class="text-muted text-uppercase">
                            {{ $menu->kategori }}
                        </small>

                        <div class="mt-3 fw-bold text-dark">
                            Rp {{ number_format($menu->harga,0,',','.') }}
                        </div>

                    </div>

                </div>

            </div>
            @endforeach

        </div>

    </div>
</section>

@endsection