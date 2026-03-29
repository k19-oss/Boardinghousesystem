<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
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
}