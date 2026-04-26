<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::prefix('client')->group(function () {
    Route::get('/login', function () {
        return view('auth.client-login'); 
    })->name('client.login');

    // This name fixes the 405 error on the login form
    Route::post('/login', [ClientController::class, 'login'])->name('client.login.submit');

    // These names fix the RouteNotFound errors in your sidebar
    Route::get('/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('/bills', [ClientController::class, 'bills'])->name('client.bills');
    Route::get('/logout', [ClientController::class, 'logout'])->name('client.logout');
});