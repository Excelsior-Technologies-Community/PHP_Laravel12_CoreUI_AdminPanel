<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

// Login
Route::get('admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.post');

// Logout
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| Admin Protected Routes (Login Required)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // ✅ CUSTOM ROUTES FIRST
        Route::get('users/trash', [UsersController::class, 'trash'])->name('users.trash');
        Route::get('users/restore/{id}', [UsersController::class, 'restore'])->name('users.restore');
        Route::get('users/status/{id}', [UsersController::class, 'toggleStatus'])->name('users.status');

        // ✅ RESOURCE LAST
        Route::resource('users', UsersController::class);
    });

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});