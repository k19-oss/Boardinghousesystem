<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () { 
    return view('auth.login'); 
})->name('login');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Tenant Management
    Route::get('/tenants', [AdminController::class, 'tenants'])->name('admin.tenants');
    
    // Fixed: Matches the 'admin.tenants.create' call in your dashboard
    Route::get('/tenants/add', [AdminController::class, 'create'])->name('admin.tenants.create');
    
    // Fixed: Matches the 'admin.tenants.add' call in your tenants list
    // You can point both to the same 'create' method
    Route::get('/tenants/new', [AdminController::class, 'create'])->name('admin.tenants.add');
    
    Route::post('/tenants/store', [AdminController::class, 'store'])->name('admin.tenants.store');
    
    // Room and Payment Management
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('admin.rooms');
    Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    require __DIR__.'/client.php';
});