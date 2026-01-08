<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="c-app">

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Main Wrapper -->
    <div class="c-wrapper d-flex flex-column min-vh-100">

        <!-- Header -->
        @include('admin.layouts.header')

        <!-- Content -->
        <div class="c-body flex-grow-1 p-4">
            @yield('content')
        </div>

         <!-- Footer -->
        @include('admin.layouts.footer')

    </div>

</body>
</html>
