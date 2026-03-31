@extends('layouts.admin')

@section('content')

<div class="card p-4">

<h4>Edit Meja</h4>

<form method="POST"
action="{{ route('admin.meja.update',$meja->id_meja) }}">
@csrf

<div class="mb-3">
<label>Kode Meja</label>
<input type="text"
name="kode_meja"
value="{{ $meja->kode_meja }}"
class="form-control">
</div>

<div class="mb-3">
<label>Kapasitas</label>
<input type="number"
name="kapasitas"
value="{{ $meja->kapasitas }}"
class="form-control">
</div>

<div class="mb-3">
<label>Harga</label>
<input type="number"
name="harga"
value="{{ $meja->harga }}"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Area</label>
<select name="id_area" class="form-control">
@foreach($areas as $area)
<option value="{{ $area->id_area }}"
{{ $meja->id_area == $area->id_area ? 'selected' : '' }}>
{{ $area->nama_area }}
</option>
@endforeach
</select>
</div>

<button class="btn btn-success">
Simpan Perubahan
</button>

</form>

</div>

@endsection