@extends('layouts.admin')

@section('title','Detail Pelanggan')

@section('content')

<div class="page-header">
    <div class="page-title">Detail Pelanggan</div>
</div>

<div class="table-card mt-3">

    <h4>{{ $pelanggan->name }}</h4>
    <p class="text-muted mb-1">{{ $pelanggan->email }}</p>
    <p class="text-muted">{{ $pelanggan->no_hp ?? '-' }}</p>

    <hr>

    <h5>Riwayat Reservasi</h5>

    <table class="modern-table">
        <thead>
            <tr>
                <th>Kode Booking</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Area / Meja</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pelanggan->reservasi as $r)
            <tr>
                <td>
                    <small class="fw-bold" style="font-family:monospace;color:#166534;background:#f0fdf4;padding:2px 8px;border-radius:5px;">
                        {{ $r->kode_booking }}
                    </small>
                </td>
                <td>{{ \Carbon\Carbon::parse($r->tanggal_reservasi)->format('d M Y') }}</td>
                <td>
                    {{ substr($r->jam_reservasi, 0, 5) }}
                    @if($r->jam_selesai) - {{ substr($r->jam_selesai, 0, 5) }} @endif
                </td>
                <td>
                    {{ $r->area->nama_area ?? '-' }}
                    @if($r->meja)
                        <br><small class="text-muted">{{ $r->meja->kode_meja }}</small>
                    @endif
                </td>
                <td>Rp {{ number_format($r->total_harga ?? 0, 0, ',', '.') }}</td>
                <td>
                    <span style="
                        background: {{ $r->status == 'confirmed' ? '#28a745' : '#6c757d' }};
                        color:white;
                        padding:4px 8px;
                        border-radius:5px;
                        font-size:12px;
                    ">
                        {{ ucfirst($r->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;">Belum ada reservasi</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary mt-3">
        Kembali
    </a>

</div>

@endsection