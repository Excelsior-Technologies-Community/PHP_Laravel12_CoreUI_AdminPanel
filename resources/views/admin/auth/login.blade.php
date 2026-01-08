<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="c-app flex-row align-items-center">
<div class="container">
    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <h2>Admin Login</h2>

        <div class="mb-2">
            <input name="email" placeholder="Email" class="form-control" />
        </div>

        <div class="mb-2">
            <input name="password" type="password" placeholder="Password" class="form-control" />
        </div>

        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>
</body>
</html>
