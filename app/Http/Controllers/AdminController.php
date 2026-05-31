<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\Payment;
use App\Models\User;
use App\Models\MaintenanceTicket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Carbon\Carbon;
use Exception;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    // ==========================================
    // --- 1. DASHBOARD OVERVIEW CONSOLE ---
    // ==========================================

    public function index(): View
    {
        $dashboardData = $this->calculateDashboardStats();

        $upcomingDues = Payment::with(['tenant.room'])
            ->latest()
            ->take(3)
            ->get();

        $systemAlerts = MaintenanceTicket::where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'stats'        => $dashboardData,
            'upcomingDues' => $upcomingDues,
            'systemAlerts' => $systemAlerts,
        ]);
    }

    // ==========================================
    // --- 2. BACKGROUND HEARTBEAT CHANNELS ---
    // ==========================================

    public function getAdminDashboardData(): JsonResponse
    {
        $dashboardData = $this->calculateDashboardStats();

        $upcomingDues = Payment::with(['tenant.room'])
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($due) {
                return [
                    'room_number' => $due->room_number ?? $due->tenant?->room?->room_number ?? 'N/A',
                    'date'        => Carbon::parse($due->date)->format('M d, Y'),
                    'amount'      => '₱' . number_format($due->amount, 2),
                    'raw_amount'  => $due->amount,
                    'status'      => ucfirst(strtolower($due->status ?? 'pending')),
                    'tenant_name' => $due->tenant?->name ?? 'Unknown Tenant',
                ];
            });

        $systemAlerts = MaintenanceTicket::where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($alert) {
                return [
                    'category'    => $alert->category ?? 'Maintenance',
                    'time_ago'    => $alert->created_at->diffForHumans(),
                    'description' => $alert->description,
                    'tenant_id'   => $alert->tenant_id ?? 'Unknown',
                ];
            });

        $pendingPaymentsCount = Payment::where('status', 'Pending')->count();

        return response()->json([
            'stats'                => $dashboardData,
            'upcomingDues'         => $upcomingDues,
            'alerts'               => $systemAlerts,
            'pendingPaymentsCount' => $pendingPaymentsCount,
        ]);
    }

    public function getPaymentsData(Request $request): JsonResponse
    {
        $query = Payment::with('tenant.room')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('room_number', 'like', "%{$search}%")
                  ->orWhere('reference_number', 'like', "%{$search}%");
            });
        }

        $payments = $query->get()->map(function ($payment) {
            return [
                'id'               => $payment->id,
                'room_number'      => $payment->room_number,
                'reference_number' => $payment->reference_number,
                'date'             => Carbon::parse($payment->date)->format('M d, Y'),
                'amount'           => $payment->amount,
                'receipt_path'     => $payment->receipt_path,
                'status'           => $payment->status,
            ];
        });

        return response()->json(['payments' => $payments]);
    }

    // ==========================================
    // --- 3. ROOM MANAGEMENT INTERFACE ---
    // ==========================================

    public function rooms(): View
    {
        $rooms = Room::all();
        return view('admin.rooms', compact('rooms'));
    }

    public function storeRoom(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'room_number' => 'required|string|max:50|unique:rooms,room_number',
            'price'       => 'required|numeric|min:0',
            'room_type'   => 'required|string|in:Normal,Premium',
        ]);

        Room::create([
            'room_number' => $validated['room_number'],
            'price'       => $validated['price'],
            'room_type'   => $validated['room_type'],
            'status'      => 'Available',
        ]);

        return redirect()->route('admin.rooms')->with('success', 'Room added successfully!');
    }

    public function getRoomsData(): JsonResponse
    {
        return response()->json([
            'rooms' => Room::all(),
        ]);
    }

    public function updateRoom(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'room_number' => 'required|string|max:50|unique:rooms,room_number,' . $id,
            'price'       => 'required|numeric|min:0',
            'room_type'   => 'required|string|in:Normal,Premium',
            'status'      => 'required|string|in:Available,Occupied,Maintenance',
        ]);

        $room = Room::findOrFail($id);
        $room->update($validated);

        return redirect()->route('admin.rooms')->with('success', 'Room updated successfully!');
    }

    // ==========================================
    // --- 4. TENANT DIRECTORY SHEET ---
    // ==========================================

    public function tenants(): View
    {
        $tenants = Tenant::with(['room', 'user'])->latest()->get();
        return view('admin.tenants', compact('tenants'));
    }

    public function create(): View
    {
        $availableRooms = Room::where('status', 'Available')->get();
        return view('admin.create-tenant', compact('availableRooms'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone'    => 'required|string|max:20',
            'room_id'  => 'nullable|exists:rooms,id',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $user = User::create([
                    'name'     => $validated['name'],
                    'email'    => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role'     => 'client',
                ]);

                Tenant::create([
                    'user_id' => $user->id,
                    'name'    => $validated['name'],
                    'phone'   => $validated['phone'],
                    'room_id' => $validated['room_id'] ?? null,
                    'status'  => 'Active',
                ]);

                if (!empty($validated['room_id'])) {
                    Room::where('id', $validated['room_id'])->update(['status' => 'Occupied']);
                }
            });

            return redirect()->route('admin.tenants')->with('success', 'Tenant registered and account provisioned successfully!');

        } catch (Exception $e) {
            Log::error('Tenant Creation Failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to register tenant. Please try again.');
        }
    }

    public function editTenant($id): View
    {
        $tenant = Tenant::with(['user', 'room'])->findOrFail($id);

        $rooms = Room::where('status', 'Available')
                     ->orWhere('id', $tenant->room_id)
                     ->get();

        return view('admin.edit-tenant', compact('tenant', 'rooms'));
    }

    public function updateTenant(Request $request, $id): RedirectResponse
    {
        $tenant = Tenant::with('user')->findOrFail($id);
        $userIdToExclude = $tenant->user_id ?? 0;

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $userIdToExclude . ',id',
            'password' => 'nullable|string|min:6',
            'phone'    => 'required|string|max:20',
            'room_id'  => 'nullable|exists:rooms,id',
            'status'   => 'required|string|in:Active,Inactive,Pending',
        ]);

        try {
            DB::transaction(function () use ($request, $validated, $tenant) {

                if ($tenant->user_id && $tenant->user) {
                    $userUpdate = [
                        'name'  => $validated['name'],
                        'email' => $validated['email'],
                    ];

                    if ($request->filled('password')) {
                        $userUpdate['password'] = Hash::make($validated['password']);
                    }

                    $tenant->user->update($userUpdate);
                }

                $newRoomId = $validated['room_id'] ?? null;

                if ($tenant->room_id != $newRoomId) {
                    if ($tenant->room_id) {
                        Room::where('id', $tenant->room_id)->update(['status' => 'Available']);
                    }
                    if ($newRoomId) {
                        Room::where('id', $newRoomId)->update(['status' => 'Occupied']);
                    }
                }

                $tenant->update([
                    'name'    => $validated['name'],
                    'phone'   => $validated['phone'],
                    'room_id' => $newRoomId,
                    'status'  => $validated['status'],
                ]);
            });

            return redirect()->route('admin.tenants')->with('success', 'Tenant updated successfully.');

        } catch (Exception $e) {
            Log::error('Tenant Update Failed: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());
            return redirect()->back()->withInput()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function destroyTenant($id): RedirectResponse
    {
        $tenant = Tenant::findOrFail($id);

        try {
            DB::transaction(function () use ($tenant) {
                if ($tenant->room_id) {
                    Room::where('id', $tenant->room_id)->update(['status' => 'Available']);
                }
                if ($tenant->user_id) {
                    User::where('id', $tenant->user_id)->delete();
                }
                $tenant->delete();
            });

            return redirect()->route('admin.tenants')->with('success', 'Tenant and account access removed successfully.');

        } catch (Exception $e) {
            Log::error('Tenant Deletion Failed: ' . $e->getMessage());
            return redirect()->route('admin.tenants')->with('error', 'Failed to delete tenant. Please try again.');
        }
    }

    // ==========================================
    // --- 5. PAYMENT TRACKING LEDGER ---
    // ==========================================

    public function payments(): View
    {
        $payments = Payment::with('tenant.room')->latest()->get();

        $defaultSettings = [
            'gcash_number'   => '0917-123-4567',
            'gcash_name'     => 'IPK MANAGER',
            'paymaya_number' => '0917-765-4321',
            'paymaya_name'   => 'IPK MANAGER',
        ];

        if (Storage::disk('local')->exists('payment_settings.json')) {
            $savedSettings = json_decode(Storage::disk('local')->get('payment_settings.json'), true);
            if (is_array($savedSettings)) {
                $defaultSettings = array_merge($defaultSettings, $savedSettings);
            }
        }

        $settings = (object) $defaultSettings;

        return view('admin.payments', compact('payments', 'settings'));
    }

    public function approve($id): RedirectResponse
    {
        $payment = Payment::findOrFail($id);

        if ($payment->status === 'Paid') {
            return redirect()->route('admin.payments')->with('info', 'Payment is already marked as Paid.');
        }

        $payment->update(['status' => 'Paid']);
        return redirect()->route('admin.payments')->with('success', 'Payment approved and marked as Paid!');
    }

    public function storePayment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'room_number'      => 'required|string',
            'amount'           => 'required|numeric|min:1',
            'payment_channel'  => 'nullable|string',
            'reference_number' => 'nullable|string|max:100',
        ]);

        $room = Room::where('room_number', $validated['room_number'])->first();
        $tenantId = null;

        if ($room) {
            $activeTenant = Tenant::where('room_id', $room->id)
                                  ->where('status', 'Active')
                                  ->first();
            if ($activeTenant) {
                $tenantId = $activeTenant->id;
            }
        }

        Payment::create([
            'room_number'      => $validated['room_number'],
            'amount'           => $validated['amount'],
            'date'             => now()->toDateString(),
            'status'           => 'Pending',
            'payment_channel'  => $validated['payment_channel'] ?? 'Cash',
            'reference_number' => $validated['reference_number'] ?? null,
            'tenant_id'        => $tenantId,
        ]);

        return redirect()->route('admin.payments')->with('success', 'Payment recorded successfully!');
    }

    // ==========================================
    // --- 5b. RECEIPT VIEWER (FIXES 403) ---
    // ==========================================

    /**
     * Serve receipt files securely through the controller.
     *
     * Clients upload receipts to Storage::disk('public') → 'receipts/...'
     * This method checks the public disk first, then falls back to local.
     * Fixes 403 Forbidden caused by direct asset() links to non-symlinked paths.
     */
    public function viewReceipt(int $id): StreamedResponse|RedirectResponse
    {
        $payment = Payment::findOrFail($id);

        if (!$payment->receipt_path) {
            abort(404, 'No receipt attached to this payment.');
        }

        // Primary: public disk (where ClientController stores uploaded receipts)
        if (Storage::disk('public')->exists($payment->receipt_path)) {
            $mime = Storage::disk('public')->mimeType($payment->receipt_path);
            return Storage::disk('public')->response($payment->receipt_path, null, [
                'Content-Type'        => $mime,
                'Content-Disposition' => 'inline',
            ]);
        }

        // Fallback: local disk
        if (Storage::disk('local')->exists($payment->receipt_path)) {
            $mime = Storage::disk('local')->mimeType($payment->receipt_path);
            return Storage::disk('local')->response($payment->receipt_path, null, [
                'Content-Type'        => $mime,
                'Content-Disposition' => 'inline',
            ]);
        }

        abort(404, 'Receipt file not found on disk.');
    }

    // ==========================================
    // --- 6. CONFIGURATION ENGINE DESKS ---
    // ==========================================

    public function updatePaymentSettings(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'gcash_number'   => 'required|string|max:30',
                'gcash_name'     => 'required|string|max:100',
                'paymaya_number' => 'required|string|max:30',
                'paymaya_name'   => 'required|string|max:100',
            ]);

            Storage::disk('local')->put('payment_settings.json', json_encode($validated, JSON_PRETTY_PRINT));

            return response()->json([
                'status'  => 'success',
                'message' => 'Gateway parameters updated successfully.',
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $ve) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed.',
                'errors'  => $ve->errors(),
            ], 422);

        } catch (Exception $e) {
            Log::error('Payment Settings Update Failed: ' . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => 'System error saving configuration.',
            ], 500);
        }
    }

    public function profile(): View
    {
        $prefs = [
            'alert_payments'    => true,
            'alert_maintenance' => true,
        ];

        if (Storage::disk('local')->exists('admin_prefs.json')) {
            $savedPrefs = json_decode(Storage::disk('local')->get('admin_prefs.json'), true);
            if (is_array($savedPrefs)) {
                $prefs = array_merge($prefs, $savedPrefs);
            }
        }

        $admin = Auth::user();

        return view('admin.profile', compact('prefs', 'admin'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        /** @var \App\Models\User $admin */
        $admin = Auth::user();

        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'Session expired. Please log in again.');
        }

        $request->validate([
            'name'             => 'required|string|max:255',
            'current_password' => 'nullable',
            'password'         => 'nullable|string|min:6|confirmed',
        ]);

        $admin->name = $request->input('name');

        if ($request->filled('password')) {
            if (!$request->filled('current_password') || !Hash::check($request->input('current_password'), $admin->password)) {
                return back()->withErrors(['current_password' => 'The current password you entered is incorrect.'])->withInput();
            }
            $admin->password = Hash::make($request->input('password'));
        }

        $admin->save();

        $prefs = [
            'alert_payments'    => $request->has('alert_payments'),
            'alert_maintenance' => $request->has('alert_maintenance'),
        ];

        Storage::disk('local')->put('admin_prefs.json', json_encode($prefs, JSON_PRETTY_PRINT));

        return redirect()->route('admin.profile')->with('success', 'Profile and notification settings saved successfully!');
    }

    public function sendReminder(): JsonResponse
    {
        return response()->json(['status' => 'success', 'message' => 'Payment reminders dispatched.']);
    }

    public function generateInvoice(): JsonResponse
    {
        return response()->json(['status' => 'success', 'message' => 'Invoices generated successfully.']);
    }

    // ==========================================
    // --- PRIVATE HELPER METHODS ---
    // ==========================================

    private function calculateDashboardStats(): array
    {
        $totalRooms      = Room::count();
        $totalDueAmount  = Payment::sum('amount');
        $collectedAmount = Payment::where('status', 'Paid')->sum('amount');
        $pendingAmount   = Payment::whereIn('status', ['Pending', 'Overdue'])->sum('amount');

        $occupancyRate = $totalRooms > 0
            ? round((Room::where('status', 'Occupied')->count() / $totalRooms) * 100) . '%'
            : '0%';

        return [
            'total_due' => '₱' . number_format($totalDueAmount, 2),
            'collected' => '₱' . number_format($collectedAmount, 2),
            'pending'   => '₱' . number_format($pendingAmount, 2),
            'occupancy' => $occupancyRate,
        ];
    }
}