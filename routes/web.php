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
