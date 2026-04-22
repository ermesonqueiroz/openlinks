<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', LoginController::class)->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', HomeController::class)->name('home');
        Route::resource('links', LinkController::class)->names('links');
        Route::resource('users', UserController::class)->names('users');
        Route::post('/logout', LogoutController::class)->name('logout');
    });
});

Route::get('/{link:alias}', RedirectController::class);
