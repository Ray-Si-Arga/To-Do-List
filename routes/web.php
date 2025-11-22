<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListsController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Membuat rute form login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
});
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Rute yang sudah login
Route::middleware('auth')->group(function () {

    // Halaman dashboard user (bisa dilihat oleh admin & user)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Rute khusus Admin
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');    

    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::get('/list', [ListsController::class, 'index'])->name('lists.index');
    Route::get('/lists/create', [ListsController::class, 'create'])->name('lists.create');
    Route::get('/lists/show', [ListsController::class, 'show'])->name('lists.show');
    Route::post('/lists', [ListsController::class, 'store'])->name('lists.store');
});
