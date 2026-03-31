@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0 rounded-4 p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Tambah Menu</h4>
                <small class="text-muted">Tambahkan menu baru ke sistem</small>
            </div>
            <a href="{{ route('admin.menu') }}" class="btn btn-light rounded-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">

                <!-- LEFT SIDE -->
                <div class="col-md-7">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Menu</label>
                        <input type="text"
                               name="nama_menu"
                               class="form-control modern-input @error('nama_menu') is-invalid @enderror"
                               value="{{ old('nama_menu') }}"
                               placeholder="Contoh: Nasi Goreng">

                        @error('nama_menu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="kategori"
                                class="form-select modern-input @error('kategori') is-invalid @enderror">
                            <option value="">Pilih kategori</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>

                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text"
                                   id="harga"
                                   name="harga"
                                   class="form-control modern-input @error('harga') is-invalid @enderror"
                                   placeholder="24000">

                            @error('harga')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="col-md-5">

                    <label class="form-label fw-semibold">Foto Menu</label>

                    <div class="image-upload-wrapper text-center p-4 rounded-4 border">
                        <img id="previewImage"
                             src="https://via.placeholder.com/200x150?text=Preview"
                             class="img-fluid rounded-3 mb-3"
                             style="max-height:150px; object-fit:cover;">

                        <input type="file"
                               name="foto"
                               id="foto"
                               class="form-control modern-input @error('foto') is-invalid @enderror">

                        @error('foto')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="mt-4 text-end">
                <button class="btn btn-success px-4 rounded-3 fw-semibold">
                    <i class="bi bi-check-circle"></i> Simpan Menu
                </button>
            </div>

        </form>

    </div>

</div>

@endsection