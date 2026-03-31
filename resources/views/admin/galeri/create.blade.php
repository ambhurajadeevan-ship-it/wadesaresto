@extends('layouts.admin')


@section('content')

<div class="container mt-4">

    <h3>Tambah Foto Galeri</h3>

    <form action="{{ route('admin.galeri.store') }}" 
          method="POST" 
          enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label class="form-label">Upload Foto</label>
            <input type="file" name="foto" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">
            Upload
        </button>

    </form>

</div>

@endsection
