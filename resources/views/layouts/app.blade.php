<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TAASHOP - Jasa Konveksi Profesional')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
<body>
    <!-- Navigation -->
    @include('components.navbar')
    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    @include('components.footer')
    

    <!-- Bootstrap JS -->
    @stack('scripts')
</body>
</html>
