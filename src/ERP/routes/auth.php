<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Wyświetlenie formularza rejestracji
    Route::get('register',  [RegisteredUserController::class, 'create'])->name('register');
    // Obsługa POST /register
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Wyświetlenie formularza logowania
    Route::get('login',  [AuthenticatedSessionController::class, 'create'])->name('login');
    // Obsługa POST /login
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    // Wylogowanie
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
