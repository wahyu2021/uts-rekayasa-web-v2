@extends('layouts.app')

@section('title', 'Daftar Akun - TAASHOP')

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="auth-card">
                    <h2 class="auth-title text-center">Buat Akun Baru</h2>
                    <p class="auth-subtitle text-center">Bergabunglah dengan kami dan nikmati layanan terbaik.</p>

                    <form action="{{ route('register.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Daftar</button>
                        </div>
                    </form>
                    <p class="auth-bottom-text text-center mt-4">Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
