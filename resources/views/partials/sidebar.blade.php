<div class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('images/9700334a6a74713fc8b77fdf69662bdc353cc38d.png') }}" alt="Jasamarga Logo" class="sidebar-logo">
    </div>
    
    <div class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }} d-flex align-items-center" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2 me-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('location*') ? 'active' : '' }} d-flex align-items-center" href="#" data-bs-toggle="collapse" data-bs-target="#locationMenu" aria-expanded="{{ request()->is('location*') ? 'true' : 'false' }}">
                    <i class="bi bi-geo-alt me-3"></i>
                    <span>Location</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <div class="collapse {{ request()->is('location*') ? 'show' : '' }}" id="locationMenu">
                    <ul class="nav flex-column ps-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('check-location') ? 'active' : '' }} d-flex align-items-center" href="{{ route('check-location') }}">
                                <i class="bi bi-eye me-2"></i>
                                <span>Cek Lokasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('input-location') ? 'active' : '' }} d-flex align-items-center" href="{{ route('input-location') }}">
                                <i class="bi bi-pencil-square me-2"></i>
                                <span>Input Lokasi</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('daftar-sfo') ? 'active' : '' }} d-flex align-items-center" href="{{ route('daftar-sfo') }}">
                    <i class="bi bi-file-earmark-excel me-3"></i>
                    <span>Daftar SFO</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('settings') ? 'active' : '' }} d-flex align-items-center" href="{{ route('settings') }}">
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