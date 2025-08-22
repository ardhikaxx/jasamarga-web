<nav class="navbar-top navbar navbar-light bg-white sticky-top">
    <div class="container-fluid px-3">
        <button class="btn sidebar-toggle d-block d-md-none">
            <i class="bi bi-list"></i>
        </button>
        
        <div class="d-flex align-items-center ms-auto">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(Auth::guard('admin')->user()->photo)
                        <img src="{{ asset('storage/photos/' . Auth::guard('admin')->user()->photo) }}" alt="Profile" class="user-profile">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('admin')->user()->fullname) }}&background=00a4f4&color=fff" alt="Profile" class="user-profile">
                    @endif
                    <span class="user-name ms-2 d-none d-lg-inline">{{ Auth::guard('admin')->user()->fullname }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="#" onclick="confirmLogout(event)">
                            <i class="bi bi-box-arrow-left me-2"></i>Sign out
                        </a>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>