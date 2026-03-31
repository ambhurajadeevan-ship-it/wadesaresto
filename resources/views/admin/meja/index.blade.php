@extends('layouts.admin')

@section('title','Meja')

@section('content')

<div class="admin-container">

    <h4>Kelola Meja</h4>

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('admin.meja.create') }}" 
        class="btn btn-dark-green px-4 rounded-3 shadow-sm">
            <i class="bi bi-plus-lg"></i> Tambah Meja
    </a>

    <br>

    <table class="modern-table">
        <thead>
            <tr>
                <th>Kode Meja</th>
                <th>Kapasitas</th>
                <th>Area</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($mejas as $meja)
        <tr>
            <td>{{ $meja->kode_meja }}</td>
            <td>{{ $meja->kapasitas }}</td>
            <td>{{ $meja->nama_area }}</td>
            <td>Rp {{ number_format($meja->harga, 0, ',', '.') }}</td>
            <td class="align-middle">

                <div class="d-flex align-items-center gap-2">

                    <a href="{{ route('admin.meja.edit',$meja->id_meja) }}"
                        class="btn btn-sm btn-warning d-flex align-items-center">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>

                    <form action="{{ route('admin.meja.destroy',$meja->id_meja) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus meja ini?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="btn btn-sm btn-danger d-flex align-items-center">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>

                    </form>
                </div>

            </td>   
        </tr>
        @endforeach
        </tbody>
    </table>

</div>

<style>
    .btn-dark-green {
        background: #0f3b34;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .btn-dark-green:hover {
        background: #0c2f2a;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(15,59,52,0.3);
        color: #fff;
    }
</style>

@endsection