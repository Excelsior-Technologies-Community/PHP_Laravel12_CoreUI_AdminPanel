<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <h5 class="mb-0">Admin Panel</h5>
    </div>

    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="nav-icon cil-speedometer"></i> Dashboard
            </a>
        </li>

        <li class="nav-title">Management</li>

        <li class="nav-group {{ request()->is('admin/users*') ? 'show' : '' }}">
            <a class="nav-link nav-group-toggle" href="#">
                <i class="nav-icon cil-people"></i> User Manager
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                        <span class="nav-icon"></span> All Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users.trash') ? 'active' : '' }}" href="{{ route('admin.users.trash') }}">
                        <span class="nav-icon"></span> Trash Bin
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-title">Account</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.profile.edit') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}">
                <i class="nav-icon cil-user"></i> My Profile
            </a>
        </li>

        <li class="nav-item mt-auto">
            <form method="POST" action="{{ route('admin.logout') }}" id="logout-form">
                @csrf
                <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon cil-account-logout"></i> Logout
                </a>
            </form>
        </li>
    </ul>
    
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>