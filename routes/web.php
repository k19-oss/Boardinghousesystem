<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController; 

// ==========================================
// PUBLIC & ROOT ENTRY ROUTES
// ==========================================
Route::get('/', function () { 
    return redirect()->route('client.login'); 
});

// ==========================================
// DEDICATED ADMIN AUTHENTICATION
// ==========================================
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// ==========================================
// ADMIN MAIN CONSOLE GROUP
// ==========================================
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/api/dashboard-data', [AdminController::class, 'getAdminDashboardData'])->name('admin.api.data');
    
    // --- Tenant Management ---
    Route::get('/tenants', [AdminController::class, 'tenants'])->name('admin.tenants');
    Route::get('/tenants/create', [AdminController::class, 'create'])->name('admin.create-tenant'); 
    Route::post('/tenants/store', [AdminController::class, 'store'])->name('admin.tenants.store');
    Route::get('/tenants/{id}/edit', [AdminController::class, 'editTenant'])->name('admin.tenants.edit');
    Route::put('/tenants/{id}', [AdminController::class, 'updateTenant'])->name('admin.tenants.update');
    Route::delete('/tenants/{id}', [AdminController::class, 'destroyTenant'])->name('admin.tenants.destroy');
    
    // --- Room Interfaces ---
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('admin.rooms');
    Route::post('/rooms/store', [AdminController::class, 'storeRoom'])->name('admin.rooms.store');
    Route::get('/rooms/data', [AdminController::class, 'getRoomsData'])->name('admin.rooms.data');
    Route::put('/rooms/{id}', [AdminController::class, 'updateRoom'])->name('admin.rooms.update');
    
    // --- Payment Management ---
    Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');
    Route::post('/payments/store', [AdminController::class, 'storePayment'])->name('admin.payments.store');
    Route::post('/payments/approve/{id}', [AdminController::class, 'approve'])->name('admin.payments.approve');
    Route::get('/payments/data', [AdminController::class, 'getPaymentsData'])->name('admin.payments.data');
    // ✅ FIX: New secure receipt serving route (fixes 403 Forbidden)
    Route::get('/payments/receipt/{id}', [AdminController::class, 'viewReceipt'])->name('admin.payments.receipt');

    // --- System Settings ---
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::match(['POST', 'PUT'], '/payment-settings/update', [AdminController::class, 'updatePaymentSettings'])->name('admin.payment-settings.update');

    // --- Dashboard Actions ---
    Route::get('/send-reminder', [AdminController::class, 'sendReminder'])->name('admin.sendReminder');
    Route::get('/generate-invoice', [AdminController::class, 'generateInvoice'])->name('admin.generateInvoice');
});

// ==========================================
// CLIENT ISOLATED SYSTEM GROUP
// ==========================================
Route::prefix('client')->group(function () {
    Route::get('/login', [ClientController::class, 'showLogin'])->name('client.login');
    Route::post('/login', [ClientController::class, 'login'])->name('client.login.submit');

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
        Route::get('/api/dashboard-data', [ClientController::class, 'getDynamicDashboardData'])->name('client.api.data');
        
        // --- Payments ---
        Route::get('/payment', [ClientController::class, 'paymentPage'])->name('client.payment');
        Route::get('/payment/latest-info', [ClientController::class, 'getLatestPaymentInfo'])->name('client.payment.latest');
        Route::post('/payment/submit', [ClientController::class, 'submitPayment'])->name('client.payment.submit');
        
        Route::get('/history', [ClientController::class, 'historyPage'])->name('client.history');
        Route::get('/settings', [ClientController::class, 'settingsPage'])->name('client.settings');
        
        Route::post('/ticket/store', [ClientController::class, 'storeTicket'])->name('client.ticket.store');
        Route::post('/logout', [ClientController::class, 'logout'])->name('client.logout');
    });
});