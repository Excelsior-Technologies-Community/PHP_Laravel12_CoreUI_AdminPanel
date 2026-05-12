<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.6/dist/css/coreui.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/icons/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --sidebar-width: 256px;
        }

        body {
            background-color: #f8f9fa;
        }

       
        #sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            z-index: 1030;
        }

    
        .wrapper {
            width: 100%;
            padding-left: var(--sidebar-width);
            transition: padding-left 0.15s ease-in-out;
        }

        @media (max-width: 991.98px) {
            .wrapper {
                padding-left: 0;
            }
        }

       
        .sidebar-narrow-unfoldable ~ .wrapper {
            padding-left: 64px;
        }

        .body {
            padding: 1.5rem 0;
        }
    </style>
</head>
<body>

    @include('admin.layouts.sidebar')

    <div class="wrapper d-flex flex-column min-vh-100">
        
        @include('admin.layouts.header')

        <div class="body flex-grow-1 px-3">
            @yield('content')
        </div>

        <footer class="footer px-3 py-2 border-top bg-white">
            <div class="small">© {{ date('Y') }} Admin Dashboard</div>
            <div class="ms-auto small">Built with Laravel & CoreUI</div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.6/dist/js/coreui.bundle.min.js"></script>
</body>
</html>