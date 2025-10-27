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
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
                    href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-shopping-cart"></i> <span>Orders</span>
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