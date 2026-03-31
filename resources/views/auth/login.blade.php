@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="booking-card">
                <h2 class="text-center mb-4">Login Pelanggan</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-floating-group">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                        <label for="email">Email</label>
                        @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-floating-group">
                        <input type="password" name="password" id="password" required placeholder="Password">
                        <label for="password">Password</label>
                        @error('password')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ingat Saya</label>
                    </div>

                    <button type="submit" class="btn-premium mb-3">Login</button>
                    
                    <div class="text-center">
                        <p class="small text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar Sekarang</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
