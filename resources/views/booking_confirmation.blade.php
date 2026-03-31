@extends('layouts.app')

@section('content')

<section class="booking-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">

                <div class="booking-card">

                    {{-- HEADER --}}
                    <div class="reservation-header px-4 py-3">
                        <div class="d-flex justify-content-between align-items-center">

                            {{-- LEFT --}}
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('images/logo.png') }}"
                                    width="60"
                                    height="60"
                                    style="object-fit:contain">

                                <div>
                                    <div class="reservation-name">
                                        WADESA
                                    </div>
                                    <small class="text-muted">
                                        Warung Kopi & Resto
                                    </small>
                                </div>
                            </div>

                            {{-- RIGHT --}}
                            <div class="text-end booking-info">
                                <div class="open-label">
                                    OPEN DAILY
                                </div>
                                <div class="open-time">
                                    07.00 AM - 20.00 PM
                                </div>
                                <div class="open-address">
                                    Batunya, Kec. Baturiti,<br>
                                    Kab. Tabanan, Bali 82191
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- STEP --}}
                    <div class="step-wrapper mt-3">

                        <div class="step-item">
                            <div class="step-circle">1</div>
                            <div class="step-label">Reservasi</div>
                        </div>

                        <div class="step-line active"></div>

                        <div class="step-item">
                            <div class="step-circle">2</div>
                            <div class="step-label">Informasi</div>
                        </div>

                        <div class="step-line active"></div>

                        <div class="step-item active">
                            <div class="step-circle">3</div>
                            <div class="step-label">Konfirmasi</div>
                        </div>

                    </div>

                    <hr class="divider-gold">

                    {{-- SUCCESS TITLE --}}
                    <div class="text-center mb-4">
                        <h4 class="fw-bold mb-3">Reservasi Berhasil</h4>
                        <div class="mb-3">
                            <span class="status-badge {{ $reservasi->status }}">
                                {{ ucfirst($reservasi->status) }}
                            </span>
                            <span class="status-badge {{ $reservasi->status_pembayaran == 'paid' ? 'confirmed' : 'pending' }}">
                                {{ $reservasi->status_pembayaran == 'paid' ? 'Lunas' : 'Belum Bayar' }}
                            </span>
                        </div>

                        <p class="mt-3 text-muted small">
                            Informasi konfirmasi reservasi telah dikirim ke email anda <b>{{ $reservasi->email }}</b>.
                        </p>
                    </div>

                    {{-- DETAIL BOX --}}
                    <div class="confirmation-box">
                        
                        <div class="confirm-row">
                            <span>Kode Booking</span>
                            <strong>{{ $reservasi->kode_booking }}</strong>
                        </div>
                        
                        <div class="confirm-row">
                            <span>Nama</span>
                            <strong>{{ $reservasi->nama_pelanggan }}</strong>
                        </div>

                        <div class="confirm-row">
                            <span>Email</span>
                            <strong>{{ $reservasi->email }}</strong>
                        </div>

                        <div class="confirm-row">
                            <span>Tanggal</span>
                            <strong>
                                {{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->translatedFormat('d F Y') }}
                            </strong>
                        </div>

                        <div class="confirm-row">
                            <span>Jam</span>
                            <strong>
                                {{ \Carbon\Carbon::parse($reservasi->jam_reservasi)->format('H:i') }}
                                -
                                {{ $reservasi->jam_selesai 
                                    ? \Carbon\Carbon::parse($reservasi->jam_selesai)->format('H:i') 
                                    : '-' }}
                            </strong>
                        </div>

                        <div class="confirm-row">
                            <span>Jumlah Orang</span>
                            <strong>{{ $reservasi->jumlah_orang }}</strong>
                        </div>

                        <div class="confirm-row">
                            <span>Area</span>
                            <strong>{{ $reservasi->area->nama_area ?? '-' }}</strong>
                        </div>

                        <div class="confirm-row">
                            <span>Meja</span>
                            <strong>{{ $reservasi->meja->kode_meja ?? '-' }}</strong>
                        </div>

                        <div class="confirm-row">
                            <span>Metode Pembayaran</span>
                            <strong>{{ $reservasi->metode_pembayaran ?? '-' }}</strong>
                        </div>

                        @if($reservasi->kode_meja)
                            <div class="confirm-row">
                            <span>Meja</span>
                            <strong>
                            {{ $reservasi->meja->kode_meja }} ({{ $reservasi->meja->kapasitas }} Orang)
                            </strong>
                            </div>
                        @endif

                        <h6 class="mt-4 mb-2">Pesanan Menu:</h6>
                        @foreach($reservasi->menus as $menu)
                        <div class="confirm-row py-1 border-0">
                            <span class="small">{{ $menu->nama_menu }} (x{{ $menu->pivot->jumlah }})</span>
                            <strong class="small">Rp {{ number_format($menu->pivot->harga_saat_ini * $menu->pivot->jumlah, 0, ',', '.') }}</strong>
                        </div>
                        @endforeach

                        <div class="confirm-row mt-3 border-top pt-3">
                            <span class="fw-bold text-dark">Grand Total</span>
                            <strong class="text-primary fs-5">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</strong>
                        </div>

                        @if($reservasi->catatan)
                            <div class="confirm-row flex-column align-items-start mt-3">
                                <span class="mb-2">Catatan</span>
                                <div class="note-box w-100">
                                    {{ $reservasi->catatan }}
                                </div>
                            </div>
                        @endif

                    </div>

                    {{-- BUTTONS --}}
                    <div class="d-flex flex-column align-items-center gap-3 mt-5">
                        <a href="/" class="btn-premium px-5">
                            Kembali ke Beranda
                        </a>
                        
                        <form action="{{ route('reservasi.cancel.page', $reservasi->kode_booking) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin membatalkan reservasi?')">
                            @csrf
                            <button type="submit" class="btn btn-link text-danger text-decoration-none small">
                                Batalkan Reservasi
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

@endsection