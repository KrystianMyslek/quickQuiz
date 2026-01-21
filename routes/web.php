<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\categoryController;

Route::middleware(['guest'])->group(function () {
    Route::inertia('/', 'home')->name('home');
    
    Route::inertia('/login', 'auth/login')->name('login');
    Route::post('login', [authController::class, 'login']);

    Route::inertia('/register', 'auth/register')->name('register');
    Route::post('register', [authController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [authController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [authController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [categoryController::class, 'index'])->name('category_index');
        Route::get('/create', [categoryController::class, 'create'])->name('category_create');
        Route::post('/create', [categoryController::class, 'store'])->name('category_store');
        Route::get('/{id}/edit', [categoryController::class, 'edit'])->name('category_edit');
        Route::post('/{id}/edit', [categoryController::class, 'update'])->name('category_update');
        Route::delete('/{id}', [categoryController::class, 'destroy'])->name('category_destroy');
    });

});