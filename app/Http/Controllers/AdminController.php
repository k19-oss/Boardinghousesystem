<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\Payment;

class AdminController extends Controller
{
    // 1. DASHBOARD OPERATION
    public function index() {
        $paymentCount = Payment::count();
        $totalRooms = Room::count();

        if ($paymentCount > 0) {
            $totalDueAmount = Payment::sum('amount'); 
            $collectedAmount = Payment::where('status', 'Paid')->sum('amount');
            $pendingAmount = Payment::whereIn('status', ['Pending', 'Overdue'])->sum('amount');
            
            $stats = [
                'total_due' => '₱' . number_format($totalDueAmount), 
                'collected' => '₱' . number_format($collectedAmount),
                'pending' => '₱' . number_format($pendingAmount),
            ];
            $upcomingDues = Payment::latest()->take(3)->get()->toArray();
        } else {
            // Safe Fallback Display
            $stats = [
                'total_due' => '₱42,500', 'collected' => '₱31,200', 'pending' => '₱11,300',
            ];
            $upcomingDues = [
                ['date' => 'Oct 25, 2026', 'status' => 'Pending', 'amount' => '₱3,500.00', 'room' => 'Room 101'],
                ['date' => 'Oct 28, 2026', 'status' => 'Overdue', 'amount' => '₱4,000.00', 'room' => 'Room 203'],
                ['date' => 'Nov 01, 2026', 'status' => 'Paid', 'amount' => '₱3,500.00', 'room' => 'Room 105']
            ];
        }

        $stats['occupancy'] = $totalRooms > 0 ? round((Room::where('status', 'Occupied')->count() / $totalRooms) * 100) . '%' : '88%';
        
        return view('admin.dashboard', compact('stats', 'upcomingDues'));
    }

    // 2. ROOM MANAGEMENT OPERATION
    public function rooms() {
        $rooms = Room::count() > 0 ? Room::all() : collect([
            (object)['room_number' => '101', 'status' => 'Occupied', 'price' => 3500],
            (object)['room_number' => '102', 'status' => 'Available', 'price' => 3500],
            (object)['room_number' => '103', 'status' => 'Available', 'price' => 3500],
            (object)['room_number' => '201', 'status' => 'Occupied', 'price' => 4000],
            (object)['room_number' => '202', 'status' => 'Available', 'price' => 4000],
            (object)['room_number' => '203', 'status' => 'Occupied', 'price' => 4000],
        ]);

        return view('admin.rooms', compact('rooms'));
    }

    // 3. TENANT DIRECTORY OPERATION
    public function tenants() {
        $tenants = Tenant::count() > 0 ? Tenant::all()->toArray() : [
            ['name' => 'Maria Santos', 'room' => '101', 'phone' => '0912-345-6789', 'status' => 'Active'],
            ['name' => 'Alex Reyes', 'room' => '102', 'phone' => '0998-765-4321', 'status' => 'Active'],
            ['name' => 'Juan Dela Cruz', 'room' => '201', 'phone' => '0917-111-2222', 'status' => 'Pending'],
        ];

        return view('admin.tenants', compact('tenants'));
    }

    // 4. CREATE TENANT FORM OPERATION
    public function create() {
        return view('admin.create-tenant');
    }

    // 5. STORE TENANT SUBMISSION HANDLING
    public function store(Request $request) {
        // Validates form input fields and saves them directly into the database
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
        ]);

        Tenant::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'status' => 'Active'
        ]);

        return redirect()->route('admin.tenants')->with('success', 'Tenant registered successfully!');
    }

    // 6. PAYMENTS LEDGER LOG OPERATION
    public function payments() {
        $upcomingDues = Payment::count() > 0 ? Payment::all()->toArray() : [
            ['date' => 'Oct 25, 2026', 'status' => 'Pending', 'amount' => '₱3,500.00', 'room' => 'Room 101'],
            ['date' => 'Oct 28, 2026', 'status' => 'Overdue', 'amount' => '₱4,000.00', 'room' => 'Room 203'],
            ['date' => 'Nov 01, 2026', 'status' => 'Paid', 'amount' => '₱3,500.00', 'room' => 'Room 105']
        ];

        return view('admin.payments', compact('upcomingDues'));
    }

    // 7. SYSTEM PROFILE SETTING OPERATION
    public function profile() {
        return view('admin.profile');
    }
}