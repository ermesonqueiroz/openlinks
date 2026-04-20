<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', LoginController::class)->name('login.store');

Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::resource('links', LinkController::class)->names('links');
});

Route::view('/logout', 'app.home')->name('logout');
