<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController; 

<<<<<<< HEAD
// ==========================================
// PUBLIC & ROOT ENTRY ROUTES
// ==========================================
Route::get('/', function () { 
    return redirect()->route('client.login'); 
});

// ==========================================
// DEDICATED ADMIN AUTHENTICATION
// ==========================================
=======
// Client / Public Root Entry Route
Route::get('/', function () { 
    return view('auth.login'); 
})->name('login');

// Dedicated Admin Authentication Channels
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout'); 

<<<<<<< HEAD
// ==========================================
// ADMIN MAIN CONSOLE GROUP
// ==========================================
Route::prefix('admin')->middleware(['auth'])->group(function () {
=======
// Admin Main Console Group
Route::prefix('admin')->group(function () {
    
    // Core Dashboard Link Map
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/api/dashboard-data', [AdminController::class, 'getAdminDashboardData'])->name('admin.api.data');
    
<<<<<<< HEAD
    // --- Tenant Management ---
    Route::get('/tenants', [AdminController::class, 'tenants'])->name('admin.tenants'); 
    Route::get('/tenants/create', [AdminController::class, 'create'])->name('admin.create-tenant'); 
=======
    // Tenant Management Directories
    Route::get('/tenants', [AdminController::class, 'tenants'])->name('admin.tenants');
    Route::get('/tenants/add', [AdminController::class, 'create'])->name('admin.create-tenant'); 
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
    Route::post('/tenants/store', [AdminController::class, 'store'])->name('admin.tenants.store');
    Route::get('/tenants/{id}/edit', [AdminController::class, 'editTenant'])->name('admin.tenants.edit');
    Route::put('/tenants/{id}', [AdminController::class, 'updateTenant'])->name('admin.tenants.update');
    Route::delete('/tenants/{id}', [AdminController::class, 'destroyTenant'])->name('admin.tenants.destroy');
    
<<<<<<< HEAD
    // FIXED: Removed the redundant /admin prefix here to match your fetch call
    Route::get('/tenants/data', [AdminController::class, 'getTenantsData'])->name('admin.tenants.data');

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

    // --- System Settings ---
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile'); 
    Route::match(['POST', 'PUT'], '/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::match(['POST', 'PUT'], '/payment-settings/update', [AdminController::class, 'updatePaymentSettings'])->name('admin.payment-settings.update');

    // --- Dashboard Actions ---
=======
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
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
    Route::get('/send-reminder', [AdminController::class, 'sendReminder'])->name('admin.sendReminder');
    Route::get('/generate-invoice', [AdminController::class, 'generateInvoice'])->name('admin.generateInvoice');
});

<<<<<<< HEAD
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
        
        // --- Navigation ---
        Route::get('/history', [ClientController::class, 'historyPage'])->name('client.history');
        Route::get('/settings', [ClientController::class, 'settingsPage'])->name('client.settings');
        
        // --- Tickets & Logout ---
        Route::post('/ticket/store', [ClientController::class, 'storeTicket'])->name('client.ticket.store');
        Route::post('/logout', [ClientController::class, 'logout'])->name('client.logout');
    });
=======
// Client Isolated System Group
Route::prefix('client')->group(function () {
    if (file_exists(__DIR__.'/client.php')) {
        require __DIR__.'/client.php';
    }
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
});