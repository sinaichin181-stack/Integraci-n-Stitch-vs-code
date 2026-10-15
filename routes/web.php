<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', function () {
        return view('profile.edit');
    })->name('profile.edit');

    Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

use App\Http\Controllers\SaludoController;
Route::get('/saludo', [SaludoController::class, 'index']);
