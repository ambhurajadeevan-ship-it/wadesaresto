@extends('layouts.admin')

@section('title', 'PROFILE')

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4 p-4">

        <div class="text-center mb-4">

            @php
                $admin = auth()->guard('admin')->user();
            @endphp

            @if($admin->photo)
                <img src="{{ asset('storage/'.$admin->photo) }}"
                     class="rounded-circle"
                     width="120"
                     height="120"
                     style="object-fit:cover;">
            @else
                <div class="avatar-large mx-auto">
                    {{ strtoupper(substr($admin->nama_admin,0,1)) }}
                </div>
            @endif

            <h4 class="mt-3">{{ $admin->nama_admin }}</h4>
            <p class="text-muted">{{ $admin->email }}</p>

        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama</label>
                <input type="text"
                       name="nama_admin"
                       class="form-control"
                       value="{{ $admin->nama_admin }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email"
                       class="form-control"
                       value="{{ $admin->email }}"
                       disabled>
            </div>

            <div class="mb-3">
                <label>Foto Profile</label>
                @if($admin->photo)
                    <div class="mb-3">
                        <img src="{{ asset('storage/'.$admin->photo) }}"
                            style="width:120px;height:120px;border-radius:10px;object-fit:cover;">
                    </div>
                @endif
                <input type="file" name="photo" class="form-control">
            </div>

            <hr>

            <h6>Ganti Password</h6>

            <div class="mb-3">
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Password baru">
            </div>

            <div class="mb-3">
                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Konfirmasi password">
            </div>

            <button class="btn btn-primary w-100">
                Simpan Perubahan
            </button>

        </form>

    </div>
</div>

@endsection