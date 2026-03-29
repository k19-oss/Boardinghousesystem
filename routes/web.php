<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Redirect the root to the dashboard
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/tenants', [AdminController::class, 'tenants'])->name('admin.tenants');
});