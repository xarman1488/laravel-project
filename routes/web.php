<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Дашборд
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Редирект home на dashboard
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');

    Route::resource('tasks', TaskController::class);
    Route::resource('attachments', AttachmentController::class);
});

// Маршруты для администратора
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/requests', [App\Http\Controllers\Admin\AdminRequestController::class, 'index'])
        ->name('requests.index');

    Route::get('/requests/{id}', [App\Http\Controllers\Admin\AdminRequestController::class, 'show'])
        ->name('requests.show');

    Route::patch('/requests/{id}/status', [App\Http\Controllers\Admin\AdminRequestController::class, 'updateStatus'])
        ->name('requests.updateStatus');

    Route::post('/requests/{id}/comments', [App\Http\Controllers\Admin\AdminRequestController::class, 'storeComment'])
        ->name('requests.storeComment');

    Route::get('/users/{userId}', [App\Http\Controllers\Admin\AdminRequestController::class, 'showUser'])
        ->name('users.show');
});
