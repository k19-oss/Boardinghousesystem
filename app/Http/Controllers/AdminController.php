<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Data for the stat cards
        $stats = [
            'total_due' => '₱25,000.00',
            'collected' => '₱18,500.00'
        ];

        // Data for the upcoming dues table
        $upcomingDues = [
            [
                'date' => 'Oct 25, 2026',
                'status' => 'Pending',
                'amount' => '₱3,500.00',
                'room' => 'Room 101'
            ],
            [
                'date' => 'Oct 28, 2026',
                'status' => 'Overdue',
                'amount' => '₱4,000.00',
                'room' => 'Room 203'
            ],
            [
                'date' => 'Nov 01, 2026',
                'status' => 'Paid',
                'amount' => '₱3,500.00',
                'room' => 'Room 105'
            ]
        ];

        return view('admin.dashboard', compact('stats', 'upcomingDues'));
    }

    public function tenants()
    {
        return view('admin.tenants');
    }
}