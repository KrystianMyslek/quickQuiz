<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;


Route::middleware(['guest'])->group(function () {
    Route::inertia('/', 'home')->name('home');
    
    Route::inertia('/login', 'auth/login')->name('login');
    Route::post('login', [authController::class, 'login']);

    Route::inertia('/register', 'auth/register')->name('register');
    Route::post('register', [authController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [authController::class, 'logout'])->name('logout');

    Route::inertia('/dashboard', 'dashboard', [authController::class, 'dashboard'])->name('dashboard');
});
