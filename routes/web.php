<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/profile/edit', function () {
    return view('profile.edit');
})->name('profile.edit');

Route::put('/profile/edit', function () {
    return redirect()->route('profile.edit')->with('status', 'El guardado del perfil todavía no está configurado.');
})->name('profile.update');

use App\Http\Controllers\SaludoController;
Route::get('/saludo', [SaludoController::class, 'index']);
