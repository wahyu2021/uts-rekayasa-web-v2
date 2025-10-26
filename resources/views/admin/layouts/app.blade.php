<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="admin-wrapper">
        <aside id="admin-sidebar">
            <div class="sidebar-heading">
                <a href="{{ route('admin.dashboard') }}" class="logo-link">
                    <img src="{{ asset('images/logo-taashop.png') }}" alt="TAASHOP Logo" class="logo-img">
                    <span class="logo-text">TAASHOP</span>
                </a>
            </div>
            <div class="sidebar-nav-wrapper">
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                            href="{{ route('admin.categories.index') }}">
                            <i class="fas fa-tags"></i> <span>Categories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                            href="{{ route('admin.products.index') }}">
                            <i class="fas fa-box"></i> <span>Products</span>
                        </a>
                    </li>
                </ul>

                <hr class="text-secondary">

                <ul class="nav flex-column">
                    <hr class="text-secondary">
                    <li class="nav-item">
                        <a class="nav-link nav-link-view-site" href="{{ route('home') }}">
                            <i class="fas fa-external-link-alt"></i> <span>View Site</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-logout" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </aside>

        <div id="admin-content">
            <header id="admin-header">
                <button id="sidebar-toggler"><i class="fas fa-bars"></i></button>
                <h1 class="h4 mb-0">@yield('title')</h1>

                <!-- Admin Profile Dropdown -->
                <div class="dropdown admin-profile-dropdown me-4">
                    <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle profile-icon"></i>
                        <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </header>
            <main class="p-4">
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    {{-- Large Warning Icon --}}
                    <div class="mb-3">
                        <i class="fas fa-exclamation-triangle fa-4x text-danger"></i>
                    </div>

                    {{-- Clearer Title and Text --}}
                    <h5 class="modal-title mb-2" id="deleteModalLabel">Confirm Deletion</h5>
                    <p class="text-muted">Are you sure you want to delete this item? This action cannot be undone.</p>

                    {{-- Action Buttons --}}
                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancel
                        </button>
                        <form id="deleteModalForm" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt me-1"></i> Yes, Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggle Script
            const wrapper = document.getElementById('admin-wrapper');
            const toggler = document.getElementById('sidebar-toggler');

            function checkWidth() {
                if (window.innerWidth < 992) {
                    wrapper.classList.add('collapsed');
                } else {
                    wrapper.classList.remove('collapsed');
                }
            }
            checkWidth();
            window.addEventListener('resize', checkWidth);
            if (toggler) {
                toggler.addEventListener('click', function() {
                    wrapper.classList.toggle('collapsed');
                });
            }

            // Delete Modal Script
            const deleteModal = document.getElementById('deleteModal');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const action = button.getAttribute('data-action');
                    const form = document.getElementById('deleteModalForm');
                    form.setAttribute('action', action);
                });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
