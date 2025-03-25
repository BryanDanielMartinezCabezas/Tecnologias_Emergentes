<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Vista del formulario de login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Procesar login
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboards específicos
Route::middleware('auth')->group(function () {
    Route::get('/dashboard-estudiante', function () {
        return "Bienvenido Estudiante";
    })->middleware('auth')->name('dashboard.estudiante');

    Route::get('/dashboard-profesor', function () {
        return "Bienvenido Profesor";
    })->middleware('auth')->name('dashboard.profesor');
});
