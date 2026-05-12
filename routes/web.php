<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes (Guest)
|--------------------------------------------------------------------------
*/
Route::get('admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.post');


/*
|--------------------------------------------------------------------------
| Admin Protected Routes (Login Required)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profile Management
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        // ✅ CUSTOM USER ROUTES FIRST (To avoid collision with Resource)
        Route::get('users/trash', [UsersController::class, 'trash'])->name('users.trash');
        Route::get('users/restore/{id}', [UsersController::class, 'restore'])->name('users.restore');
        Route::get('users/status/{id}', [UsersController::class, 'toggleStatus'])->name('users.status');

        // ✅ RESOURCE LAST
        Route::resource('users', UsersController::class);

        // Logout (Inside Auth for security)
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });