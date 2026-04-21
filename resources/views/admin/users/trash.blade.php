<!DOCTYPE html>
<html>

<head>
    <title>Trash Users</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CoreUI -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.6/dist/css/coreui.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
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

        .card {
            border-radius: 15px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body class="c-app">

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

            <div class="text-start mb-3">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">← Back to Users</a>
            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="alert alert-success text-center mb-3">
                    {{ session('success') }}
                </div>
            @endif

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-danger">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Restore</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('admin.users.restore', $user->id) }}" class="btn btn-success btn-sm">
                                        Restore
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Trash Users Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
</body>

</html>