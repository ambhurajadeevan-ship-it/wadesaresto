@extends('layouts.admin')

@section('content')

<div class="card shadow p-4">

<h4 class="mb-4">Tambah Area</h4>

<form action="{{ route('admin.area.store') }}"
method="POST">
@csrf

<div class="mb-3">
<label>Nama Area</label>
<input type="text"
name="nama_area"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Kapasitas</label>
<input type="number"
name="kapasitas"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Harga</label>
<input type="number"
name="harga"
class="form-control"
required>
</div>

<button type="submit"
class="btn btn-success">
Simpan
</button>

<a href="{{ route('admin.area') }}"
class="btn btn-secondary">
Kembali
</a>

</form>

</div>

@endsection