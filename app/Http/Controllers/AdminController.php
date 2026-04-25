<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
<<<<<<< HEAD
    public function dashboard()
    {
        // Static data for the dashboard
        $stats = [
            'total_due' => '$1,250',
            'collected' => '$800'
        ];

        $upcomingDues = [
            ['date' => 'Oct 5', 'status' => 'Paid', 'amount' => '$1,250', 'room' => 'Room 1'],
            ['date' => 'Oct 10', 'status' => 'Overdue', 'amount' => '$700', 'room' => 'Room 2'],
        ];

        return view('admin.dashboard', compact('stats', 'upcomingDues'));
    }

    public function tenants()
    {
        // Static data for the tenants list
        $tenants = [
            ['name' => 'Maria Santos', 'room' => '101', 'phone' => '0912-345-6789', 'status' => 'Active'],
            ['name' => 'Alex Reyes', 'room' => '102', 'phone' => '0998-765-4321', 'status' => 'Active'],
            ['name' => 'Juan Dela Cruz', 'room' => '201', 'phone' => '0917-111-2222', 'status' => 'Pending'],
        ];

        return view('admin.tenants', compact('tenants'));
    }
=======
    public function index() {
        $stats = ['total_due' => '₱25,000.00', 'collected' => '₱18,500.00'];
        $upcomingDues = [
            ['date' => 'Oct 25, 2026', 'status' => 'Pending', 'amount' => '₱3,500.00', 'room' => 'Room 101'],
            ['date' => 'Oct 28, 2026', 'status' => 'Overdue', 'amount' => '₱4,000.00', 'room' => 'Room 203'],
            ['date' => 'Nov 01, 2026', 'status' => 'Paid', 'amount' => '₱3,500.00', 'room' => 'Room 105']
        ];
        return view('admin.dashboard', compact('stats', 'upcomingDues'));
    }

    public function tenants() { return view('admin.tenants'); }
    public function createTenant() { return view('admin.create-tenant'); }

    public function storeTenant(Request $request) {
        // This is where you will later add $request->validate([...])
        return redirect()->route('admin.tenants')->with('success', 'New tenant added!');
    }

    public function rooms() { return view('admin.rooms'); }
    public function payments() { return view('admin.payments'); }
    public function profile() { return view('admin.profile'); }
>>>>>>> client
}