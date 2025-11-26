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

// UBAH INI: Ganti GET menjadi POST untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Rute yang sudah login
Route::middleware('auth')->group(function () {

    // Halaman dashboard user (bisa dilihat oleh admin & user)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PERBAIKI ROUTE LISTS - GUNAKAN RESOURCE ROUTE YANG KONSISTEN
    Route::prefix('lists')->name('lists.')->group(function () {
        Route::get('/', [ListsController::class, 'index'])->name('index');
        Route::get('/create', [ListsController::class, 'create'])->name('create');
        Route::post('/', [ListsController::class, 'store'])->name('store');
        Route::get('/{list}', [ListsController::class, 'show'])->name('show');
        Route::get('/{list}/edit', [ListsController::class, 'edit'])->name('edit');
        Route::put('/{list}', [ListsController::class, 'update'])->name('update');
        Route::delete('/{list}', [ListsController::class, 'destroy'])->name('destroy');
    });

    // TASK ROUTES - PERBAIKI PENAMAAN
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
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