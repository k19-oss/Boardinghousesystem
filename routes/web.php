<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// 1. Client / Public Root Route
Route::get('/', function () { 
    return view('auth.login'); // Displays your resident/client login by default
})->name('login');

// 2. Dedicated Admin Login Routes (Dynamic Handling)
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// 3. Admin Main Console Group
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Tenant Management
    Route::get('/tenants', [AdminController::class, 'tenants'])->name('admin.tenants');
    Route::get('/tenants/add', [AdminController::class, 'create'])->name('admin.create-tenant'); // Matches layout links
    Route::post('/tenants/store', [AdminController::class, 'store'])->name('admin.tenants.store');
    
    // Room and Payment Management
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('admin.rooms');
    Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    
    // Client specific routes inside the admin directory
    require __DIR__.'/client.php';
});