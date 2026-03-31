@extends('layouts.admin')

@section('content')

<div class="card shadow p-4">

<h4 class="mb-4">Tambah Meja</h4>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.meja.store') }}" method="POST">
@csrf

<div class="mb-3">
<label>Kode Meja</label>
<input type="text" name="kode_meja" value="{{ old('kode_meja') }}"
class="form-control">
</div>

<div class="mb-3">
<label>Kapasitas</label>
<input type="number"
       name="kapasitas"
       value="{{ old('kapasitas') }}"
       class="form-control">

@error('kapasitas')
<div class="text-danger small mt-1">
    {{ $message }}
</div>
@enderror
</div>

<div class="mb-3">
<label>Harga</label>
<input type="number"
       name="harga"
       value="{{ old('harga') }}"
       class="form-control"
       required>

@error('harga')
<div class="text-danger small mt-1">
    {{ $message }}
</div>
@enderror
</div>

<div class="mb-3">
<label>Area</label>
<select name="id_area" class="form-control">
@foreach($areas as $area)
<option value="{{ $area->id_area }}"
    {{ old('id_area') == $area->id_area ? 'selected' : '' }}>
    {{ $area->nama_area }}
</option>
@endforeach
</select>
</div>

<button type="submit"
class="btn btn-success">
Simpan
</button>

<a href="{{ route('admin.meja') }}"
class="btn btn-secondary">
Kembali
</a>

</form>

</div>

@endsection