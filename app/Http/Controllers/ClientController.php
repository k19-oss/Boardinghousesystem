<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Helper to get common resident data context.
     */
    private function getResidentData()
    {
        $user = Auth::user();
        $tenantProfile = $user ? $user->tenantProfile : null;

        return [
            'user' => $user,
            'roomNumber' => $tenantProfile->room_number ?? 'UNIT 101',
            'roomType' => $tenantProfile->room_type ?? 'Premium Solo',
            'phoneNumber' => $tenantProfile->phone ?? '09171234567',
            'emergencyNumber' => $tenantProfile->emergency_phone ?? '09187654321',
            'registrationDate' => $tenantProfile && $tenantProfile->created_at ? $tenantProfile->created_at->format('M d, Y') : 'May 12, 2026',
            'currentDues' => $tenantProfile->current_balance ?? 3500.00,
            'daysDueText' => 'Due in 5 days',
            'recentActions' => $tenantProfile ? $tenantProfile->payments()->orderBy('payment_date', 'desc')->get() : collect()
        ];
    }

    // --- PUBLIC AUTHENTICATION METHODS ---

    public function showLogin()
    {
        // 🌟 Reconnected to point straight to resources/views/auth/client-login.blade.php
        return view('auth.client-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('client.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // --- PROTECTED DASHBOARD CORE METHODS ---

    public function index()
    {
        return view('client.dashboard', $this->getResidentData());
    }

    public function paymentPage()
    {
        return view('client.payment', $this->getResidentData());
    }

    public function historyPage()
    {
        return view('client.history', $this->getResidentData());
    }

    public function settingsPage()
    {
        return view('client.settings', $this->getResidentData());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('client.login');
    }
}