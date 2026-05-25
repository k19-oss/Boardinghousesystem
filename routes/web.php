<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Client / Public Root Entry Route
Route::get('/', function () { 
    return view('auth.login'); 
})->name('login');

// Dedicated Admin Authentication Channels
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Main Console Group
Route::prefix('admin')->group(function () {
    
    // Core Dashboard Link Map
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Tenant Management Directories
    Route::get('/tenants', [AdminController::class, 'tenants'])->name('admin.tenants');
    Route::get('/tenants/add', [AdminController::class, 'create'])->name('admin.create-tenant'); 
    Route::post('/tenants/store', [AdminController::class, 'store'])->name('admin.tenants.store');
    
    // Room Interfaces & Actions (ADDED admin.rooms.store TO FIX image_18fb83.png)
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('admin.rooms');
    Route::post('/rooms/store', [AdminController::class, 'storeRoom'])->name('admin.rooms.store');
    
    // Payment Management Interfaces
    Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');
    Route::post('/payments/store', [AdminController::class, 'storePayment'])->name('admin.payments.store');
    
    // System Settings Control Pages (Profile Routes)
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

    // Dashboard Quick Action Routes (Configured as GET to support clickable anchor links)
    Route::get('/send-reminder', [AdminController::class, 'sendReminder'])->name('admin.sendReminder');
    Route::get('/generate-invoice', [AdminController::class, 'generateInvoice'])->name('admin.generateInvoice');
});

// Client Isolated System Group
Route::prefix('client')->group(function () {
    if (file_exists(__DIR__.'/client.php')) {
        require __DIR__.'/client.php';
    }
});