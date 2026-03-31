@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="booking-card">
                <h2 class="text-center mb-4">Daftar Akun</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-floating-group">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus placeholder="Nama Lengkap">
                        <label for="name">Nama Lengkap</label>
                        @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-floating-group">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="Email">
                        <label for="email">Email</label>
                        @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-floating-group">
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" required placeholder="No HP">
                        <label for="no_hp">No HP</label>
                        @error('no_hp')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-floating-group">
                        <input type="password" name="password" id="password" required placeholder="Password">
                        <label for="password">Password (Min. 8 Karakter)</label>
                        @error('password')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-floating-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Konfirmasi Password">
                        <label for="password_confirmation">Konfirmasi Password</label>
                    </div>

                    <button type="submit" class="btn-premium mb-3">Daftar</button>
                    
                    <div class="text-center">
                        <p class="small text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Login di sini</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
