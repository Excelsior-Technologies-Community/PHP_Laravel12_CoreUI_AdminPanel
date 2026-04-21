<!DOCTYPE html>
<html>

<head>
    <title>Users List</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CoreUI -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.6/dist/css/coreui.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            height: 100%;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .status-badge {
            pointer-events: none;
            /* makes it unclickable */
        }

        .action-btns form,
        .action-btns a {
            display: inline-block;
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar bg-dark text-white p-3">
        <h4 class="text-center mb-4">Admin Panel</h4>

        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">🏠 Dashboard</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white bg-secondary rounded" href="{{ route('admin.users.index') }}">👤 Users</a>
            </li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- HEADER -->
        <div class="d-flex justify-content-end mb-3">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>

        <!-- CARD -->
        <div class="card shadow p-4">

            <h3 class="text-center mb-4">👤 Users Management</h3>

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- SEARCH -->
            <form method="GET" class="d-flex mb-3">
                <input type="text" name="search" class="form-control w-50" placeholder="Search..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary ms-2">Search</button>
                <a href="{{ route('admin.users.trash') }}" class="btn btn-warning ms-2">Trash</a>
            </form>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>

                                <!-- SHOW STATUS ONLY -->
                                <td>
                                    <span
                                        class="btn btn-sm {{ $user->status ? 'btn-success' : 'btn-secondary' }} status-badge">
                                        {{ $user->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                <!-- ACTIONS -->
                                <td class="action-btns">
                                    <!-- Toggle Button -->
                                    <a href="{{ route('admin.users.status', $user->id) }}" class="btn btn-sm btn-warning">
                                        Toggle
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure to delete?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <!-- PAGINATION -->
            <div class="d-flex justify-content-center mt-3">
                {{ $users->links() }}
            </div>

        </div>

    </div>

</body>

</html>