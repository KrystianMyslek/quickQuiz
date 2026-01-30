<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\quizController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [authController::class, 'home'])->name('home');
    
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

    Route::group(['prefix' => 'quiz'], function () {
        Route::get('/', [quizController::class, 'index'])->name('quiz_index');
        Route::get('/mylist', [quizController::class, 'mylist'])->name('quiz_mylist');
        Route::get('/create', [quizController::class, 'create'])->name('quiz_create');
        Route::post('/create', [quizController::class, 'store'])->name('quiz_store');
        Route::get('/{id}/edit', [quizController::class, 'edit'])->name('quiz_edit');
        Route::post('/{id}/edit', [quizController::class, 'update'])->name('quiz_update');
        Route::delete('/{id}', [quizController::class, 'destroy'])->name('quiz_destroy');
        
        Route::get('/solve/{id}', [quizController::class, 'solve'])->name('quiz_solve');
    });

});