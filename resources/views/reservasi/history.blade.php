@extends('layouts.app')

@section('content')
<section class="booking-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="booking-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-0">Riwayat Reservasi</h3>
                        <a href="{{ route('booking.create') }}" class="btn btn-gold">Buat Reservasi Baru</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kode Booking</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Area / Meja</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservasi as $r)
                                <tr>
                                    <td><strong>{{ $r->kode_booking }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($r->tanggal_reservasi)->format('d M Y') }}</td>
                                    <td>{{ substr($r->jam_reservasi, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }}</td>
                                    <td>
                                        {{ $r->area->nama_area ?? '-' }} 
                                        @if($r->meja)
                                            / {{ $r->meja->kode_meja }}
                                        @endif
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $r->status }}">
                                            {{ ucfirst($r->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('booking.confirmation', $r->id_reservasi) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted"> Belum ada riwayat reservasi </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
