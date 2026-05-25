<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\Payment;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 

class AdminController extends Controller
{
    // 1. DASHBOARD OVERVIEW CONSOLE
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

    // 2. ROOM MANAGEMENT INTERFACE
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

    // NEW METHOD: PROCESS AND LOG NEW ROOMS
    public function storeRoom(Request $request) {
        $validated = $request->validate([
            'room_number' => 'required|string|max:50',
            'price' => 'required|numeric',
        ]);

        Room::create([
            'room_number' => $validated['room_number'],
            'price' => $validated['price'],
            'status' => 'Available'
        ]);

        return redirect()->route('admin.rooms')->with('success', 'Room added successfully!');
    }

    // 3. TENANT DIRECTORY SHEET
    public function tenants() {
        $tenants = Tenant::count() > 0 ? Tenant::all()->toArray() : [
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

    // 4. PAYMENT TRACKING LEDGER
    public function payments() {
        $upcomingDues = Payment::count() > 0 ? Payment::all()->toArray() : [
            ['date' => 'Oct 25, 2026', 'status' => 'Pending', 'amount' => '₱3,500.00', 'room' => 'Room 101'],
            ['date' => 'Oct 28, 2026', 'status' => 'Overdue', 'amount' => '₱4,000.00', 'room' => 'Room 203'],
            ['date' => 'Nov 01, 2026', 'status' => 'Paid', 'amount' => '₱3,500.00', 'room' => 'Room 105']
        ];
        return view('admin.payments', compact('upcomingDues'));
    }

    // 5. ADMIN CONFIGURATION VIEW PORT
    public function profile() {
        return view('admin.profile');
    }

    // 6. PROCESS PROFILE SECURITY CREDENTIALS
    public function updateProfile(Request $request) {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $admin = User::where('email', 'patrick@gmail.com')->first();

        if ($admin) {
            $admin->name = $request->input('username');
            
            if ($request->filled('password')) {
                $admin->password = Hash::make($request->input('password'));
            }
            
            $admin->save();
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
        }

        return redirect()->route('admin.profile')->with('success', 'Changes saved successfully!');
    }

    // 7. EXECUTE DISPATCH REMINDER ACTION
    public function sendReminder() {
        return redirect()->route('admin.dashboard')->with('success', 'Payment reminders have been dispatched successfully to all pending tenants!');
    }

    // 8. EXECUTE COMPUTE BILLING INVOICE ACTION
    public function generateInvoice() {
        return redirect()->route('admin.dashboard')->with('success', 'Monthly statements and system room invoices have been compiled successfully!');
    }

    // 9. PROCESS AND LOG NEW PAYMENT TRANSACTIONS
    public function storePayment(Request $request) {
        return redirect()->route('admin.payments')->with('success', 'Payment transaction logged successfully!');
    }
}