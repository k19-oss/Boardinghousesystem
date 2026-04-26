<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $stats = [
            'total_due' => '₱42,500', 
            'collected' => '₱31,200',
            'pending' => '₱11,300',
            'occupancy' => '88%'
        ];

        $upcomingDues = [
            ['date' => 'Oct 25, 2026', 'status' => 'Pending', 'amount' => '₱3,500.00', 'room' => 'Room 101'],
            ['date' => 'Oct 28, 2026', 'status' => 'Overdue', 'amount' => '₱4,000.00', 'room' => 'Room 203'],
            ['date' => 'Nov 01, 2026', 'status' => 'Paid', 'amount' => '₱3,500.00', 'room' => 'Room 105']
        ];
        
        return view('admin.dashboard', compact('stats', 'upcomingDues'));
    }

    public function tenants() { 
        $tenants = [
            ['name' => 'Maria Santos', 'room' => '101', 'phone' => '0912-345-6789', 'status' => 'Active'],
            ['name' => 'Alex Reyes', 'room' => '102', 'phone' => '0998-765-4321', 'status' => 'Active'],
            ['name' => 'Juan Dela Cruz', 'room' => '201', 'phone' => '0917-111-2222', 'status' => 'Pending'],
        ];
        return view('admin.tenants', compact('tenants')); 
    }

    public function create() { 
        return view('admin.create-tenant'); 
    }

    public function store(Request $request) {
        return redirect()->route('admin.tenants')->with('success', 'Tenant added!');
    }

    public function rooms() { return view('admin.rooms'); }
    public function payments() { return view('admin.payments'); }
    public function profile() { return view('admin.profile'); }
}