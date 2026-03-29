<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::prefix('client')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('/bills', [ClientController::class, 'bills'])->name('client.bills');
});