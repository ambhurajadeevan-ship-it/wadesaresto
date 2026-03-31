@extends('layouts.admin')

@section('title', 'AREA')

@section('content')

<div class="card shadow-sm p-4">

<h4 class="mb-4 fw-bold">Kelola Area</h4>

<form action="{{ route('admin.area.store') }}" method="POST" class="row g-2 mb-4">
@csrf
<div class="d-flex justify-content-start mb-3">

<a href="{{ route('admin.area.create') }}"
class="btn btn-dark-green px-4 rounded-3 shadow-sm">
        <i class="bi bi-plus-lg"></i> Tambah Area
</a>

</div>
</form>

<div class="table-responsive">

<table class="table align-middle">

<thead class="table-light">
<tr>
<th>Nama Area</th>
<th>Kapasitas</th>
<th>Harga</th>
<th width="180">Aksi</th>
</tr>
</thead>

<tbody>

@foreach($areas as $area)

<tr>

<td>
<div class="form-control bg-light" 
style="pointer-events:none;">
{{ $area->nama_area }}
</div>
</td>

<td>
<div class="form-control bg-light text-center" 
style="pointer-events:none;">
{{ $area->kapasitas }}
</div>
</td>

<td>
<div class="form-control bg-light" 
style="pointer-events:none;">
Rp {{ number_format($area->harga, 0, ',', '.') }}
</div>
</td>

<td>
<a href="{{ route('admin.area.edit',$area->id_area) }}"
class="btn btn-sm btn-warning">
<i class="bi bi-pencil-square"></i>edit
</a>

<form action="{{ route('admin.area.delete', $area->id_area) }}"
      method="POST"
      style="display:inline;"
      onsubmit="return confirm('Yakin ingin menghapus area ini?')">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger btn-sm">
        hapus
    </button>

</form>

</td>

</tr>

@endforeach

</tbody>
</table>

</div>

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