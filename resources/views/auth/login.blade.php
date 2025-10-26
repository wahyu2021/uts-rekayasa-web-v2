@extends('layouts.auth')

@section('title', 'Login - TAASHOP')

@section('auth-title', 'Masuk ke Akun Anda')

@section('auth-form')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Alamat Email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">
            Ingat Saya
        </label>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg">
            Login
        </button>
    </div>
</form>
@endsection

@section('auth-footer-link')
<p class="text-muted">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
@endsection