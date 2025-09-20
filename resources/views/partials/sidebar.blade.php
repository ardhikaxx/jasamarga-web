<div class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('images/9700334a6a74713fc8b77fdf69662bdc353cc38d.png') }}" alt="Jasamarga Logo"
            class="sidebar-logo">
    </div>

    <div class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }} d-flex align-items-center"
                    href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2 me-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('projects*') ? 'active' : '' }} d-flex align-items-center"
                    href="{{ route('projects.index') }}">
                    <i class="bi bi-folder me-3"></i>
                    <span>Manajemen Projek</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('locations*') && !request()->is('locations/create') ? 'active' : '' }} d-flex align-items-center"
                    href="{{ route('locations.index') }}">
                    <i class="bi bi-list-check me-3"></i>
                    <span>Manajemen Lokasi</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('work*') ? 'active' : '' }} d-flex align-items-center"
                    href="{{ route('work.index') }}">
                    <i class="bi bi-briefcase me-3"></i>
                    <span>Manajemen Pekerjaan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('sfo*') ? 'active' : '' }} d-flex align-items-center"
                    href="{{ route('sfo.index') }}">
                    <i class="bi bi-clipboard-data me-3"></i>
                    <span>Manajemen SFO</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('check-location') ? 'active' : '' }} d-flex align-items-center"
                    href="{{ route('check-location') }}">
                    <i class="bi bi-geo-alt me-3"></i>
                    <span>Cek Lokasi</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('settings') ? 'active' : '' }} d-flex align-items-center"
                    href="{{ route('settings') }}">
                    <i class="bi bi-gear me-3"></i>
                    <span>Settings</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <a class="nav-link d-flex align-items-center text-danger" href="#" onclick="confirmLogout(event)">
                    <i class="bi bi-box-arrow-left me-3"></i>
                    <span>Logout</span>
                </a>
                <form id="sidebar-logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
