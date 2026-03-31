@extends('layouts.admin-auth')

@section('title','Lupa Password')

@section('content')

<div class="brand">WADESA</div>

<div class="auth-title">Lupa Password</div>
<div class="auth-sub">Masukkan email admin Anda</div>

{{-- GLOBAL ERROR --}}
@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.password.update') }}">
    @csrf

    <input type="email"
           name="email"
           value="{{ old('email') }}"
           class="form-control mb-2"
           placeholder="Email"
           required>

    <input type="password"
           name="password"
           class="form-control mb-2"
           placeholder="Password Baru"
           required>

    <input type="password"
           name="password_confirmation"
           class="form-control mb-3"
           placeholder="Konfirmasi Password"
           required>

    <button type="submit" class="btn-auth">
        Reset Password
    </button>
</form>

<a href="{{ route('admin.login') }}" class="auth-link">
    Kembali ke Login
</a>

@endsection