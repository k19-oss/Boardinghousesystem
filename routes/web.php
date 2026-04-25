<?php
<<<<<<< HEAD

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Redirect the root to the dashboard
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/tenants', [AdminController::class, 'tenants'])->name('admin.tenants');
=======
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () { return view('auth.login'); })->name('login');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Tenant Management
    Route::get('/tenants', [AdminController::class, 'tenants'])->name('admin.tenants');
    Route::get('/tenants/add', [AdminController::class, 'createTenant'])->name('admin.tenants.create');
    Route::post('/tenants/add', [AdminController::class, 'storeTenant'])->name('admin.tenants.store'); // Fixed Route
    
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('admin.rooms');
    Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
>>>>>>> client
});