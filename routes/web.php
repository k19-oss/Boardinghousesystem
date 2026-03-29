<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Admin Interface
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/tenants', [AdminController::class, 'tenants'])->name('admin.tenants');
});

// Client Interface
Route::prefix('client')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('/bills', [ClientController::class, 'bills'])->name('client.bills');
});