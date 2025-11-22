<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\TaskController;

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

    Route::get('/list', [ListsController::class, 'index'])->name('lists.index');
    Route::get('/lists/create', [ListsController::class, 'create'])->name('lists.create');
    Route::post('/lists', [ListsController::class, 'store'])->name('lists.store');
    Route::get('/lists/show/{list}', [ListsController::class, 'show'])->name('lists.show');
    Route::get('/lists/edit/{list}', [ListsController::class, 'edit'])->name('lists.edit');
    Route::put('/lists/update/{list}', [ListsController::class, 'update'])->name('lists.update');
    Route::delete('/lists/{list}', [ListsController::class, 'destroy'])->name('lists.destroy');

    Route::post('/task', [TaskController::class, 'store'])->name('task.store');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggle');
});

// Rute khusus Admin
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
});
