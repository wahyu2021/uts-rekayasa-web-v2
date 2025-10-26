@extends('layouts.app')

@section('title', 'Login - TAASHOP')

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="auth-card">
                    <h2 class="auth-title text-center">Login Akun</h2>
                    <p class="auth-subtitle text-center">Selamat datang kembali! Silakan masuk untuk melanjutkan.</p>

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                            <a href="#" class="auth-link">Lupa Password?</a>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>
                    </form>
                    <p class="auth-bottom-text text-center mt-4">Belum punya akun? <a href="{{ route('register') }}" class="auth-link">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
