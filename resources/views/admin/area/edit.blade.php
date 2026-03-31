@extends('layouts.admin')

@section('content')

<div class="card shadow p-4">

<h4 class="mb-4">Edit Area</h4>

<form action="{{ route('admin.area.update',$area->id_area) }}"
method="POST">
@csrf

<div class="mb-3">
<label>Nama Area</label>
<input type="text"
name="nama_area"
class="form-control"
value="{{ $area->nama_area }}"
required>
</div>

<div class="mb-3">
<label>Kapasitas</label>
<input type="number"
name="kapasitas"
class="form-control"
value="{{ $area->kapasitas }}"
required>
</div>

<div class="mb-3">
<label>Harga</label>
<input type="number"
name="harga"
class="form-control"
value="{{ $area->harga }}"
required>
</div>

<button type="submit"
class="btn btn-success">
Simpan Perubahan
</button>

<a href="{{ route('admin.area') }}"
class="btn btn-secondary">
Kembali
</a>

</form>

</div>

@endsection