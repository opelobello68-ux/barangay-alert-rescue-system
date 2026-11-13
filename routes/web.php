<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResponderController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return match(auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'responder' => redirect()->route('responder.dashboard'),
            default => redirect()->route('resident.dashboard'),
        };
    })->name('dashboard');

    Route::get('/resident', [AlertController::class, 'residentDashboard'])->middleware('role:resident')->name('resident.dashboard');
    Route::get('/alerts/create', [AlertController::class, 'create'])->middleware('role:resident')->name('alerts.create');
    Route::post('/alerts', [AlertController::class, 'store'])->middleware('role:resident')->name('alerts.store');
    Route::get('/alerts', [AlertController::class, 'index'])->middleware('role:resident')->name('alerts.index');
    Route::get('/alerts/{alert}', [AlertController::class, 'show'])->middleware('role:resident')->name('alerts.show');

    Route::get('/responder', [ResponderController::class, 'dashboard'])->middleware('role:responder')->name('responder.dashboard');
    Route::get('/responder/alerts/{alert}', [ResponderController::class, 'show'])->middleware('role:responder')->name('responder.alerts.show');
    Route::patch('/responder/alerts/{alert}/status', [ResponderController::class, 'updateStatus'])->middleware('role:responder')->name('responder.alerts.status');

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/alerts', [AdminController::class, 'alerts'])->name('admin.alerts');
        Route::patch('/alerts/{alert}/assign', [AdminController::class, 'assign'])->name('admin.alerts.assign');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    });
});
