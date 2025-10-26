@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header text-center mb-4">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo-taashop.png') }}" alt="TAASHOP Logo" class="auth-logo">
            </a>
            <h3 class="auth-title mt-3">@yield('auth-title')</h3>
        </div>

        <div class="auth-body">
            @yield('auth-form')
        </div>

        <div class="auth-footer mt-4 text-center">
            @yield('auth-footer-link')
        </div>
    </div>
</div>
@endsection
