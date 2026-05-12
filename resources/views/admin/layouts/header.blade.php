<header class="header header-sticky mb-4 border-bottom shadow-sm bg-white">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" 
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="icon icon-lg cil-menu"></i>
        </button>

        <a class="header-brand d-md-none" href="#">
            <strong>Admin</strong>
        </a>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item text-muted">Admin</li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>

        <ul class="header-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link py-0 d-flex align-items-center" data-coreui-toggle="dropdown" href="#" role="button">
                    <div class="avatar avatar-md me-2">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="rounded-circle shadow-sm" width="35" height="35" style="object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" class="rounded-circle" width="35">
                        @endif
                    </div>
                    <span class="d-none d-md-block fw-semibold">{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                    <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                        <i class="cil-user me-2"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger" type="submit">
                            <i class="cil-account-logout me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</header>