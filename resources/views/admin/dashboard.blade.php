@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<style>
    .btn-hover-action,
    .btn-report-action,
    .metric-card-node,
    .view-all-link,
    .data-table-row {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .btn-hover-action:hover {
        background: #271815 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(62, 39, 35, 0.2);
    }

    .btn-report-action:hover {
        background: #fcfbfb !important;
        border-color: #b5b5b5 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .metric-card-node:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -5px rgba(0, 0, 0, 0.1) !important;
    }

    .view-all-link:hover {
        color: #78350f !important;
        text-decoration: underline !important;
    }

    .data-table-row:hover { background-color: #faf9f9 !important; }

    #admin-alerts-container::-webkit-scrollbar { width: 5px; }
    #admin-alerts-container::-webkit-scrollbar-track { background: #f5f5f4; border-radius: 10px; }
    #admin-alerts-container::-webkit-scrollbar-thumb { background: #d6d3d1; border-radius: 10px; }
</style>
@endpush

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:28px;">
    <div>
        <h1 style="color:#3E2723;font-weight:800;letter-spacing:-1px;margin:0;font-size:1.7rem;">IPK Boardinghouse System</h1>
        <p style="color:#636e72;font-size:0.88rem;margin:5px 0 0 0;">Welcome back, Admin. Here is what's happening today.</p>
    </div>
    <div style="display:flex;gap:10px;">
        <a href="{{ Route::has('admin.create-tenant') ? route('admin.create-tenant') : '#' }}"
           class="btn-hover-action"
           style="background:#3E2723;color:#fff;padding:10px 18px;border-radius:10px;text-decoration:none;font-weight:600;font-size:0.88rem;display:inline-flex;align-items:center;gap:8px;">
            <i class="fa-solid fa-user-plus"></i> New Tenant
        </a>
        <button class="btn-report-action"
                style="background:#fff;color:#3E2723;border:1px solid #e0e0e0;padding:10px 18px;border-radius:10px;font-weight:600;font-size:0.88rem;display:inline-flex;align-items:center;gap:8px;cursor:pointer;">
            <i class="fa-solid fa-download"></i> Reports / Invoice
        </button>
    </div>
</div>

{{-- METRIC CARDS --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:28px;">
    <div class="card metric-card-node" style="padding:20px;border-left:5px solid #5d4037;">
        <div style="display:flex;justify-content:space-between;align-items:start;">
            <div>
                <p style="color:#8c8c8c;font-size:0.72rem;font-weight:700;text-transform:uppercase;margin:0;letter-spacing:0.5px;">Total Revenue</p>
                <h2 id="total-revenue-count" style="font-size:1.55rem;font-weight:800;color:#2d2d2d;margin:5px 0 0 0;">
                    {{ data_get($stats ?? [], 'total_due') ?? '₱0.00' }}
                </h2>
            </div>
            <div style="background:#efebe9;color:#5d4037;padding:10px;border-radius:10px;font-size:1.05rem;">
                <i class="fa-solid fa-wallet"></i>
            </div>
        </div>
    </div>

    <div class="card metric-card-node" style="padding:20px;border-left:5px solid #2ecc71;">
        <div style="display:flex;justify-content:space-between;align-items:start;">
            <div>
                <p style="color:#8c8c8c;font-size:0.72rem;font-weight:700;text-transform:uppercase;margin:0;letter-spacing:0.5px;">Collected</p>
                <h2 id="collected-count" style="font-size:1.55rem;font-weight:800;color:#2ecc71;margin:5px 0 0 0;">
                    {{ data_get($stats ?? [], 'collected') ?? '₱0.00' }}
                </h2>
            </div>
            <div style="background:#e8f5e9;color:#2ecc71;padding:10px;border-radius:10px;font-size:1.05rem;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
    </div>

    <div class="card metric-card-node" style="padding:20px;border-left:5px solid #e17055;">
        <div style="display:flex;justify-content:space-between;align-items:start;">
            <div>
                <p style="color:#8c8c8c;font-size:0.72rem;font-weight:700;text-transform:uppercase;margin:0;letter-spacing:0.5px;">Pending</p>
                <h2 id="pending-count" style="font-size:1.55rem;font-weight:800;color:#e17055;margin:5px 0 0 0;">
                    {{ data_get($stats ?? [], 'pending') ?? '₱0.00' }}
                </h2>
            </div>
            <div style="background:#fff3e0;color:#e17055;padding:10px;border-radius:10px;font-size:1.05rem;">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>
    </div>

    <div class="card metric-card-node" style="padding:20px;border-left:5px solid #8d6e63;">
        <div style="display:flex;justify-content:space-between;align-items:start;">
            <div>
                <p style="color:#8c8c8c;font-size:0.72rem;font-weight:700;text-transform:uppercase;margin:0;letter-spacing:0.5px;">Occupancy</p>
                <h2 id="occupancy-count" style="font-size:1.55rem;font-weight:800;color:#2d2d2d;margin:5px 0 0 0;">
                    {{ data_get($stats ?? [], 'occupancy') ?? '0%' }}
                </h2>
            </div>
            <div style="background:#f5f5f4;color:#8d6e63;padding:10px;border-radius:10px;font-size:1.05rem;">
                <i class="fa-solid fa-bed"></i>
            </div>
        </div>
    </div>
</div>

{{-- BOTTOM GRID --}}
<div style="display:grid;grid-template-columns:2fr 1fr;gap:22px;align-items:start;">

    {{-- RECENT ACTIVITIES --}}
    <div class="card" style="padding:24px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
            <h3 style="color:#3E2723;font-size:1rem;font-weight:700;margin:0;">
                <i class="fa-solid fa-list-ul" style="margin-right:8px;color:#8d6e63;"></i> Recent Activities
            </h3>
            <a href="#" class="view-all-link" style="font-size:0.78rem;color:#b45309;text-decoration:none;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">View All</a>
        </div>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="text-align:left;color:#a3a3a3;font-size:0.72rem;font-weight:700;letter-spacing:0.5px;border-bottom:1px solid #f5f5f4;">
                    <th style="padding:10px;">TENANT / ROOM</th>
                    <th style="padding:10px;">DATE</th>
                    <th style="padding:10px;">AMOUNT</th>
                    <th style="padding:10px;text-align:right;">STATUS</th>
                </tr>
            </thead>
            <tbody id="admin-activities-tbody">
                @forelse($upcomingDues ?? [] as $due)
                <tr class="data-table-row" style="border-bottom:1px solid #fafaf9;">
                    <td style="padding:13px 10px;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:34px;height:34px;border-radius:50%;background:#efebe9;display:flex;align-items:center;justify-content:center;font-size:0.8rem;color:#3E2723;font-weight:600;">👤</div>
                            <div>
                                <div style="font-weight:700;font-size:0.88rem;color:#2d2d2d;">
                                    {{ data_get($due, 'tenant.name') ?? data_get($due, 'tenant_name') ?? 'Active Account' }}
                                </div>
                                <div style="font-size:0.73rem;color:#78716c;margin-top:1px;">
                                    {{ data_get($due, 'room') ?? data_get($due, 'room_number') ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="padding:13px 10px;font-size:0.83rem;color:#57534e;">{{ data_get($due, 'date') }}</td>
                    <td style="padding:13px 10px;font-weight:700;color:#2d2d2d;font-size:0.88rem;">{{ data_get($due, 'amount') }}</td>
                    <td style="padding:13px 10px;text-align:right;">
                        @php $status = strtoupper(data_get($due, 'status', 'PENDING')); @endphp
                        <span style="padding:4px 11px;border-radius:20px;font-size:0.68rem;font-weight:800;letter-spacing:0.3px;display:inline-block;
                            {{ $status === 'PAID' ? 'background:#e3fcef;color:#00b894;border:1px solid #a3e635;' : ($status === 'PENDING' ? 'background:#fffbeb;color:#d97706;border:1px solid #fde68a;' : 'background:#fff5f5;color:#ff7675;border:1px solid #fca5a5;') }}">
                            {{ $status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;padding:20px;color:#a3a3a3;font-size:0.88rem;">No recent activities found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- RIGHT COLUMN — System Alerts only --}}
    <div>
        <div class="card" style="padding:22px;">
            <h4 style="margin:0 0 14px 0;color:#3E2723;font-size:0.9rem;font-weight:700;">
                <i class="fa-solid fa-bullhorn" style="color:#8d6e63;margin-right:6px;"></i> System Alerts
            </h4>
            <div id="admin-alerts-container" style="display:flex;flex-direction:column;gap:12px;max-height:380px;overflow-y:auto;padding-right:5px;">
                @forelse($systemAlerts ?? [] as $alert)
                    <div style="display:flex;flex-direction:column;gap:4px;border-left:3px solid #ff7675;padding-left:12px;font-size:0.78rem;">
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <span style="font-weight:800;text-transform:uppercase;color:#c0392b;font-size:0.68rem;background:#fdf2f2;padding:2px 6px;border-radius:4px;">
                                {{ $alert->category }}
                            </span>
                            <span style="font-size:10px;color:#a3a3a3;">{{ $alert->created_at->diffForHumans() }}</span>
                        </div>
                        <div style="color:#57534e;line-height:1.4;font-style:italic;">
                            "{!! Str::limit($alert->description, 65) !!}"
                        </div>
                        <div style="font-size:10px;color:#78716c;">Submitted by Resident ID #{{ $alert->tenant_id }}</div>
                    </div>
                @empty
                    <div style="display:flex;gap:10px;font-size:0.78rem;border-left:3px solid #00b894;padding-left:12px;">
                        <div style="color:#27ae60;line-height:1.4;font-weight:600;">
                            ✅ All resident profiles and accounts are currently in full operational compliance.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

{{-- Notification Assets --}}
<audio id="alert-sound" src="{{ asset('audio/alert.mp3') }}" preload="auto"></audio>
<div id="toast-container" style="position:fixed; bottom:24px; right:24px; z-index:9999; display:flex; flex-direction:column; gap:12px;"></div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const apiEndpoint = "{{ Route::has('admin.api.data') ? route('admin.api.data') : '' }}";
    if (!apiEndpoint) return;

    // Memory variable to track the newest alert
    let lastAlertIdentifier = null;

    // Function to trigger sound and pop-up
    function triggerNotification(alertData) {
        // 1. Play Sound
        const audio = document.getElementById('alert-sound');
        if (audio) {
            // Browsers require user interaction before autoplaying audio. 
            // Catch prevents console errors if the admin hasn't clicked anywhere yet.
            audio.play().catch(err => console.log("Audio blocked waiting for user interaction."));
        }

        // 2. Create and show Pop-up (Toast)
        const toastContainer = document.getElementById('toast-container');
        const toast = document.createElement('div');
        
        // Styling matches your 60-30-10 boarding house UI theme
        toast.style.cssText = "background:#fff; border-left:4px solid #ff7675; box-shadow:0 12px 24px -5px rgba(0,0,0,0.15); padding:16px 20px; border-radius:8px; width:320px; transform:translateX(120%); transition:transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid #f5f5f4;";
        
        toast.innerHTML = `
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                <strong style="color:#c0392b; font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">
                    <i class="fa-solid fa-bell"></i> New ${alertData.category || 'Alert'}
                </strong>
                <span style="font-size:0.7rem; color:#a3a3a3;">Just now</span>
            </div>
            <div style="color:#3E2723; font-size:0.85rem; font-weight:600; line-height:1.4;">
                ${alertData.description ? alertData.description.substring(0, 60) + '...' : 'System update detected.'}
            </div>
        `;
        
        toastContainer.appendChild(toast);

        // Slide in
        setTimeout(() => { toast.style.transform = "translateX(0)"; }, 50);

        // Slide out and remove after 6 seconds
        setTimeout(() => {
            toast.style.transform = "translateX(120%)";
            setTimeout(() => { toast.remove(); }, 300);
        }, 6000);
    }

    function syncDashboard() {
        fetch(apiEndpoint)
            .then(response => response.json())
            .then(data => {
                // --- Update metric cards ---
                const stats = data.stats ?? {};
                const totalEl    = document.getElementById('total-revenue-count');
                const collectedEl = document.getElementById('collected-count');
                const pendingEl  = document.getElementById('pending-count');
                const occupancyEl = document.getElementById('occupancy-count');

                if (totalEl    && stats.total_due) totalEl.textContent    = stats.total_due;
                if (collectedEl && stats.collected) collectedEl.textContent = stats.collected;
                if (pendingEl  && stats.pending)   pendingEl.textContent  = stats.pending;
                if (occupancyEl && stats.occupancy) occupancyEl.textContent = stats.occupancy;

                // --- Update recent activities table ---
                const tbody = document.getElementById('admin-activities-tbody');
                const dues  = data.upcomingDues ?? [];
                if (tbody && dues.length > 0) {
                    let rowsHtml = '';
                    dues.forEach(due => {
                        const statusUpper = (due.status || 'PENDING').toUpperCase();
                        let badgeStyle = '';
                        if (statusUpper === 'PAID') {
                            badgeStyle = 'background:#e3fcef;color:#00b894;border:1px solid #a3e635;';
                        } else if (statusUpper === 'PENDING') {
                            badgeStyle = 'background:#fffbeb;color:#d97706;border:1px solid #fde68a;';
                        } else {
                            badgeStyle = 'background:#fff5f5;color:#ff7675;border:1px solid #fca5a5;';
                        }
                        rowsHtml += `
                        <tr class="data-table-row" style="border-bottom:1px solid #fafaf9;">
                            <td style="padding:13px 10px;">
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div style="width:34px;height:34px;border-radius:50%;background:#efebe9;display:flex;align-items:center;justify-content:center;font-size:0.8rem;color:#3E2723;font-weight:600;">👤</div>
                                    <div>
                                        <div style="font-weight:700;font-size:0.88rem;color:#2d2d2d;">${due.tenant_name ?? 'Active Account'}</div>
                                        <div style="font-size:0.73rem;color:#78716c;margin-top:1px;">${due.room_number ?? 'N/A'}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding:13px 10px;font-size:0.83rem;color:#57534e;">${due.date ?? ''}</td>
                            <td style="padding:13px 10px;font-weight:700;color:#2d2d2d;font-size:0.88rem;">${due.amount ?? ''}</td>
                            <td style="padding:13px 10px;text-align:right;">
                                <span style="padding:4px 11px;border-radius:20px;font-size:0.68rem;font-weight:800;letter-spacing:0.3px;display:inline-block;${badgeStyle}">
                                    ${statusUpper}
                                </span>
                            </td>
                        </tr>`;
                    });
                    tbody.innerHTML = rowsHtml;
                }

                // --- Update system alerts panel ---
                const alertsContainer = document.getElementById('admin-alerts-container');
                const alerts = data.alerts ?? [];
                if (alertsContainer && alerts.length > 0) {
                    let alertsHtml = '';
                    alerts.forEach(alert => {
                        alertsHtml += `
                        <div style="display:flex;flex-direction:column;gap:4px;border-left:3px solid #ff7675;padding-left:12px;font-size:0.78rem;">
                            <div style="display:flex;justify-content:space-between;align-items:center;">
                                <span style="font-weight:800;text-transform:uppercase;color:#c0392b;font-size:0.68rem;background:#fdf2f2;padding:2px 6px;border-radius:4px;">
                                    ${alert.category ?? 'Maintenance'}
                                </span>
                                <span style="font-size:10px;color:#a3a3a3;">${alert.time_ago ?? ''}</span>
                            </div>
                            <div style="color:#57534e;line-height:1.4;font-style:italic;">"${alert.description ?? ''}"</div>
                            <div style="font-size:10px;color:#78716c;">Submitted by Resident ID #${alert.tenant_id ?? 'Unknown'}</div>
                        </div>`;
                    });
                    alertsContainer.innerHTML = alertsHtml;

                    // --- CHECK FOR NEW ALERT TRIGGER ---
                    // Use 'id' if available from your API, otherwise fallback to description text
                    const currentAlertIdentifier = alerts[0].id || alerts[0].description;
                    
                    if (lastAlertIdentifier !== null && lastAlertIdentifier !== currentAlertIdentifier) {
                        // A new alert is detected! Fire the popup and sound.
                        triggerNotification(alerts[0]);
                    }
                    
                    // Update our memory to the current newest alert
                    lastAlertIdentifier = currentAlertIdentifier;
                }
            })
            .catch(err => console.error('Dashboard sync heartbeat error:', err));
    }

    // Run the silent refresh every 3 seconds
    setInterval(syncDashboard, 3000);
});
</script>
@endpush