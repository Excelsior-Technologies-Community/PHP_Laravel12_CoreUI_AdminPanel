<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CoreUI CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.6/dist/css/coreui.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .form-control {
            height: 45px;
            font-size: 1rem;
        }

        .btn-login {
            height: 45px;
            font-size: 1rem;
            font-weight: 500;
        }

        .footer-text {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #888;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <h2>Admin Login</h2>

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-login">Login</button>
        </form>

        <div class="footer-text">
            &copy; {{ date('Y') }} Admin Panel
        </div>
    </div>

</body>

</html>