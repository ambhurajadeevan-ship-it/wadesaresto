@extends('layouts.admin')

@section('title','Detail Pelanggan')

@section('content')

<div class="page-header">
    <div class="page-title">Detail Pelanggan</div>
</div>

<div class="table-card mt-3">

    <h4>{{ $pelanggan->name }}</h4>
    <p>{{ $pelanggan->email }}</p>

    <hr>

    <h5>Riwayat Reservasi</h5>

    <table class="modern-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Meja</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pelanggan->reservasi as $r)
            <tr>
                <td>{{ $r->tanggal_reservasi }}</td>
                <td>{{ $r->jam_reservasi }}</td>
                <td>{{ $r->meja->kode_meja ?? '-' }}</td>
                <td>Rp {{ number_format($r->total_harga ?? 0,0,',','.') }}</td>
                <td>
                    <span style="
                        background: {{ $r->status == 'confirmed' ? '#28a745' : '#6c757d' }};
                        color:white;
                        padding:4px 8px;
                        border-radius:5px;
                    ">
                        {{ ucfirst($r->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;">Belum ada reservasi</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary mt-3">
        Kembali
    </a>

</div>

@endsection