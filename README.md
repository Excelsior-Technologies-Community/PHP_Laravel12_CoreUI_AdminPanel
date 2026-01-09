# PHP_Laravel12_CoreUI_AdminPanel

A **beginner‑friendly Admin Panel** built using **Laravel 12** and **CoreUI Free Admin Template**.
It demonstrates how to implement a simple admin authentication system, a dashboard, and user management features in a clean and modular Laravel structure.

---

## Key Features


### Admin Authentication

- Admins can log in and log out securely.

- Uses a custom authentication guard (auth:admin) for admins.

- Admin users are created manually using Tinker.


### Dashboard

- A responsive dashboard layout using CoreUI and Bootstrap.

- Serves as the landing page after admin login.


### User Listing

- Displays a simple list of users (users.index view).

- Users are also created via Tinker, not through the UI.


### Responsive Layout

- Master layout includes header, sidebar, and footer.

- Built with CoreUI components for clean and modern styling.

---


## Purpose of This Project

- The project is designed to help beginners understand:

- How to set up a custom admin login system in Laravel.

- How to create a dashboard layout using CoreUI.

- How to list users in a structured view.

- How Laravel models, controllers, and views interact in a simple admin panel.

---


## 🛠 Requirements

| Tool | Version |
|----|----|
| PHP | >= 8.2 |
| Composer | Latest |
| Node.js | >= 18 |
| NPM | Latest |
| MySQL | Any |
| Laravel | 12 |

---

##  Step 1: Create Laravel 12 Project

```bash
composer create-project laravel/laravel PHP_Laravel12_CoreUI_AdminPanel "12.*"
```

```bash
cd PHP_Laravel12_CoreUI_AdminPanel
```

Start server:
```bash
php artisan serve
```

---

## Step 2: Configure .env for DB

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=coreui_admin_panel
DB_USERNAME=root
DB_PASSWORD=
```

Create database using this command

```bash
php artisan migrate
```

---

##  Step 3: Install Frontend Dependencies

Install CoreUI and Bootstrap using NPM:

```bash
npm install @coreui/coreui bootstrap @popperjs/core
```

---

##  Step 4: Configure Vite

### resources/js/app.js

```js
import './bootstrap';
import 'bootstrap';
import '@coreui/coreui';
```

### resources/css/app.css

```css
@import 'bootstrap/dist/css/bootstrap.min.css';
@import '@coreui/coreui/dist/css/coreui.min.css';
```

Build Commands:
```bash
npm install
npm run dev
```

---

## Step 5: Authentication (Admin Login) 

Laravel has built-in Auth scaffolding, but for control we’ll make manual.

**5.1 Create Admin**

```bash
php artisan make:model Admin -m
```

Migration database/migrations/xxxx_create_admins_table.php:

```
Schema::create('admins', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->timestamps();
});
```

Run:

```bash
php artisan migrate
```

**5.2 Admin Model**

app/Models/Admin.php:

```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}
```

**5.3 Auth Guard**

In config/auth.php add:
```
'guards' => [
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
],

'providers' => [
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
],
```
---

## Step 6: Admin Login System

**6.1 AuthController**

Create:

```bash
php artisan make:controller Admin/AuthController
```

app/Http/Controllers/Admin/AuthController.php:

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email'=>'Invalid Credentials']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
```

**6.2 Login View**

Create resources/views/admin/auth/login.blade.php:

```html
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
```

---

## Step 7: Admin Blade Layouts

**Master Layout**

resources/views/admin/layouts/app.blade.php:

```html
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
```

**Header**

resources/views/admin/layouts/header.blade.php:

```
<header class="c-header c-header-light c-header-fixed d-flex justify-content-between align-items-center px-3">
   <br>
    <div>
        <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>
</header>
```

**Sidebar**

resources/views/admin/layouts/sidebar.blade.php:

```
<div class="sidebar sidebar-dark sidebar-fixed">
    <div class="sidebar-brand">Admin Panel</div>

    <ul class="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
        </li>
    </ul>
</div>
```

**Footer**

resources/views/admin/layouts/footer.blade.php:

```
<footer class="c-footer mt-auto">
    <div>© {{ date('Y') }} PHP Laravel Admin</div>
</footer>
```

---


## Step 8: Dashboard

Create Controller:

```bash
php artisan make:controller Admin/DashboardController
```

app/Http/Controllers/Admin/DashboardController.php:

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    return view('admin.dashboard');
}

}
```

View resources/views/admin/dashboard.blade.php:

```
@extends('admin.layouts.app')

@section('content')
<h1 style="text-align: center;">Welcome to Admin Dashboard</h1>
@endsection
```

---

## Step 9: Users

**Model + Migration  (default Use)**

```bash
php artisan make:model User -m
```

**9.1 Migration (Default Use):**

```
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamps();
});
```

Run:

```
php artisan migrate
```

**9.2 Model (Default Use):**

```
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
```

**9.3 Controller**

```bash
php artisan make:controller Admin/UsersController --resource
```

app/Http/Controllers/Admin/UsersController.php:

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
}
```

**9.4 Views**

resources/views/admin/users/index.blade.php:

```
@extends('admin.layouts.app')

@section('content')
<h2>Users List</h2>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
    </tr>
    @endforeach
</table>
@endsection
```

Add create/edit forms similarly.


## Step 10: Web routes

```
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;

Route::get('admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Group all admin routes with prefix 'admin' and name 'admin.'
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users routes
    Route::resource('users', UsersController::class);
});


Route::get('/', function () {
    return view('welcome');
});
```

---

## Step 11: Admin And User Create Using Seeder

```bash
php artisan tinker
```

**Create Admin**

```
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

Admin::create([
    'name' => 'xxxx',            //choose name
    'email' => 'xxxx',          // choose email
    'password' => Hash::make('password'),  //choose your own password
]);
```

**Create User**   //same for User also

```
use App\Models\User;
User::create([
    'name' => '',
    'email' => '',
    'password' => bcrypt(''),
]); 
```
---

## Step 12: Start Development Server 

To run the Laravel CoreUI Admin Panel correctly, you must start BOTH backend and frontend servers.

### 12.1 Start Laravel Backend Server

Open Terminal / CMD and run:

```bash
php artisan serve
```

This starts Laravel routes, controllers, authentication, and database logic.

After this, Laravel will run on:

```bash
http://127.0.0.1:8000
```

### 12.2 Start Frontend (CoreUI + Bootstrap Assets)

Open another terminal in the same project folder and run:

```bash
npm run dev
```

This compiles:

- CoreUI CSS

- Bootstrap

- JavaScript

- Sidebar & Admin UI styles

- Without this, Admin Panel design will NOT appear correctly.


### 12.3 Open Admin Panel in Browser

```
http://127.0.0.1:8000/admin/login
```

Login using Admin credentials created via tinker.
You can use Hash also in Create User

---

## Project Folder Structure 

```text
PHP_Laravel12_CoreUI_AdminPanel
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Controller.php
│   │   │   │
│   │   │   └── Admin/
│   │   │       ├── AuthController.php
│   │   │       ├── DashboardController.php
│   │   │       └── UsersController.php
│   │   │
│   │   └── Kernel.php
│   │
│   ├── Models/
│   │   ├── User.php
│   │   └── Admin.php
│   │
│   └── Providers/
│
├── bootstrap/
│   └── app.php
│
├── config/
│   ├── app.php
│   └── auth.php
│
├── database/
│   ├── migrations/
│   │   ├── xxxx_xx_xx_create_users_table.php
│   │   └── xxxx_xx_xx_create_admins_table.php
│   │
│   └── factories/
│
├── public/
│   ├── build/              ← Vite compiled CoreUI assets
│   └── index.php
│
├── resources/
│   ├── views/
│   │   │
│   │   └── admin/
│   │       ├── auth/
│   │       │   └── login.blade.php
│   │       │
│   │       ├── layouts/
│   │       │   ├── app.blade.php
│   │       │   ├── header.blade.php
│   │       │   ├── sidebar.blade.php
│   │       │   └── footer.blade.php
│   │       │
│   │       ├── dashboard.blade.php
│   │       │
│   │       └── users/
│   │           └── index.blade.php
│   │
│   ├── css/
│   │   └── app.css
│   │
│   └── js/
│       └── app.js
│
├── routes/
│   └── web.php
│
├── node_modules/
│
├── package.json
├── vite.config.js
├── .env
├── artisan
└── README.md
```

---

## Output

**Admin Login**

<img width="1916" height="1037" alt="Screenshot 2026-01-08 130524" src="https://github.com/user-attachments/assets/1248511c-f716-459f-9041-388653069692" />


**Admin Dashboard**

<img width="1919" height="1034" alt="Screenshot 2026-01-08 130433" src="https://github.com/user-attachments/assets/479b22fc-e9bb-4732-ab87-cd067fa76965" />


**Users List**

<img width="1919" height="1030" alt="Screenshot 2026-01-08 130441" src="https://github.com/user-attachments/assets/bf57c46f-8827-4a5b-a097-6fcd0b902f47" />

---

Your PHP_Laravel12_CoreUI_AdminPanel Project is Now Ready!
