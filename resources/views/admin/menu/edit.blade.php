@extends('layouts.admin')

@section('content')

<div class="container">
    <h3 class="mb-4">Edit Menu</h3>

    <form action="{{ route('admin.menu.update', $menu->id_menu) }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Menu</label>
            <input type="text"
                   name="nama_menu"
                   value="{{ old('nama_menu', $menu->nama_menu) }}"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="Makanan" {{ $menu->kategori == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="Minuman" {{ $menu->kategori == 'Minuman' ? 'selected' : '' }}>Minuman</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number"
                   name="harga"
                   value="{{ old('harga', $menu->harga) }}"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Saat Ini</label><br>
            <img src="{{ asset('storage/'.$menu->foto) }}"
                 width="150"
                 class="rounded shadow mb-2">
        </div>

        <div class="mb-3">
            <label class="form-label">Ganti Foto (Opsional)</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            Update Menu
        </button>

    </form>
</div>

@endsection
