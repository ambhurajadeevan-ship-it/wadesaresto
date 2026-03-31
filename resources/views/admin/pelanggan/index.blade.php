@extends('layouts.admin')

@section('title','Pelanggan')

@section('content')

<div class="page-header">
    <div class="page-title">Data Pelanggan</div>
</div>

<div class="table-card mt-3">

    {{-- 🔍 SEARCH --}}
    <form method="GET" style="margin-bottom:15px;">
        <input type="text" name="search" placeholder="Cari pelanggan..."
               value="{{ request('search') }}"
               style="padding:8px; width:250px;">
        <button type="submit">Cari</button>
    </form>

    <table class="modern-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Total Reservasi</th>
                <th>Riwayat Reservasi</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pelanggan as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->reservasi_count ?? 0 }}</td>

                {{-- ✅ RIWAYAT --}}
                
                <td>
                    <a href="{{ route('admin.pelanggan.show', $p->id) }}" 
                        class="btn btn-sm btn-primary">
                        Detail
                    </a>
                </td>
                

                {{-- STATUS --}}
                <td>
                    @if(($p->reservasi_count ?? 0) > 2)
                        <span style="background:#28a745;color:white;padding:4px 8px;border-radius:5px;">
                            Aktif
                        </span>
                    @else
                        <span style="background:#6c757d;color:white;padding:4px 8px;border-radius:5px;">
                            Pasif
                        </span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection