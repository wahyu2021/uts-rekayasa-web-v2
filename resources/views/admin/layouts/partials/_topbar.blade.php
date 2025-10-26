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