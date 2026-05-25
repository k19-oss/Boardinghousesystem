@extends('layouts.client')

@section('title', 'Resident Dashboard')

@section('content')
<style>
    /* Clean grid: Left Profile block, Right Overview block */
    .portal-inner-grid {
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 28px;
        align-items: start;
        width: 100%;
    }

    /* Premium Frosted Glass Container Styles matching your 60-30-10 palette */
    .glass-inner-card {
        background: rgba(255, 255, 255, 0.55); 
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 12px 40px rgba(61, 43, 31, 0.04);
    }

    .profile-display-box {
        text-align: center;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        padding: 30px 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        margin-bottom: 25px;
    }

    .avatar-circle-premium {
        width: 90px;
        height: 90px;
        background: var(--primary-brown);
        color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.4rem;
        font-weight: 800;
        margin: 0 auto 18px;
        box-shadow: 0 8px 20px rgba(61, 43, 31, 0.15);
    }

    .meta-details-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .meta-details-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 0;
        border-bottom: 1px solid rgba(61, 43, 31, 0.08);
        font-size: 0.88rem;
    }

    .meta-details-item:last-child {
        border-bottom: none;
    }

    .meta-details-item .label-text {
        color: #5D4037;
        font-weight: 700;
    }

    .meta-details-item .value-text {
        color: var(--primary-brown);
        font-weight: 600;
        max-width: 180px;
        text-align: right;
        word-break: break-all;
    }

    /* Content Area Metric Displays */
    .dashboard-metric-box {
        background: rgba(255, 255, 255, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        padding: 26px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.01);
        transition: transform 0.3s ease;
    }

    .dashboard-metric-box:hover {
        transform: translateY(-3px);
        background: rgba(255, 255, 255, 0.75);
    }

    .unit-pill-badge {
        background: var(--primary-brown); 
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .action-badge {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.5px;
    }
    
    .badge-success-glow { background: rgba(39, 174, 96, 0.14); color: #219653; border: 1px solid rgba(39, 174, 96, 0.1); }
    .badge-pending-glow { background: rgba(230, 126, 34, 0.14); color: #d35400; border: 1px solid rgba(230, 126, 34, 0.1); }

    .premium-ledger-table {
        width: 100%; 
        border-collapse: collapse;
    }

    .premium-ledger-table th {
        padding: 16px 14px; 
        color: #5D4037; 
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        border-bottom: 2px solid rgba(61, 43, 31, 0.1);
        text-align: left;
    }

    .premium-ledger-table td {
        padding: 18px 14px; 
        color: var(--primary-brown);
        font-size: 0.92rem;
        border-bottom: 1px solid rgba(61, 43, 31, 0.05);
    }
</style>

<div class="portal-inner-grid">
    
    <div class="glass-inner-card">
        <div class="profile-display-box">
            <div class="avatar-circle-premium">
                {{ strtoupper(substr($user->name ?? 'R', 0, 1)) }}
            </div>
            <h3 style="color: var(--primary-brown); font-weight: 800; margin: 0; font-size: 1.25rem;">{{ $user->name ?? 'Resident Tenant' }}</h3>
            <p style="color: #5D4037; font-size: 0.82rem; font-weight: 600; margin-top: 4px;">Verified Resident Account</p>
        </div>

        <h4 style="color: var(--primary-brown); font-weight: 800; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.75px; margin-bottom: 15px; padding-left: 2px;">My System Details</h4>
        <ul class="meta-details-list">
            <li class="meta-details-item"><span class="label-text">Email:</span> <span class="value-text">{{ $user->email ?? 'N/A' }}</span></li>
            <li class="meta-details-item"><span class="label-text">Phone:</span> <span class="value-text">{{ $phoneNumber }}</span></li>
            <li class="meta-details-item"><span class="label-text">Registered:</span> <span class="value-text">{{ $registrationDate }}</span></li>
            <li class="meta-details-item"><span class="label-text">Emergency No:</span> <span class="value-text">{{ $emergencyNumber }}</span></li>
        </ul>
    </div>

    <div class="glass-inner-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 38px;">
            <div>
                <h1 style="color: var(--primary-brown); font-weight: 800; margin: 0; font-size: 2rem; letter-spacing: -0.5px;">My Overview</h1>
                <p style="color: #5D4037; opacity: 0.8; margin-top: 4px; font-size: 0.95rem; font-weight: 500;">Welcome back to IPK Boarding House Portal console.</p>
            </div>
            <div class="unit-pill-badge"><i class="fa-solid fa-hotel"></i> {{ $roomNumber }}</div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 24px; margin-bottom: 30px;">
            <div class="dashboard-metric-box">
                <p style="font-size: 0.75rem; color: #5D4037; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Current Dues</p>
                <h2 style="color: var(--primary-brown); font-size: 2rem; font-weight: 800; margin: 12px 0; letter-spacing: -0.5px;">₱{{ number_format($currentDues, 2) }}</h2>
                <p style="font-size: 0.85rem; color: #d97706; font-weight: 700; display: flex; align-items: center; gap: 6px;"><i class="fa-solid fa-clock"></i> {{ $daysDueText }}</p>
            </div>

            <div class="dashboard-metric-box">
                <p style="font-size: 0.75rem; color: #5D4037; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Space Config</p>
                <h2 style="color: var(--primary-brown); font-size: 1.6rem; font-weight: 800; margin: 14px 0;">{{ $roomType }}</h2>
                <p style="font-size: 0.85rem; color: #27ae60; font-weight: 700; display: flex; align-items: center; gap: 6px;"><i class="fa-solid fa-circle-check"></i> Good Condition</p>
            </div>
        </div>

        <div class="dashboard-metric-box" style="padding: 28px;">
            <h3 style="color: var(--primary-brown); font-weight: 800; font-size: 1.15rem; margin-bottom: 22px; display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-clock-rotate-left" style="color: #d97706;"></i> Recent Account Actions
            </h3>
            <div style="overflow-x: auto;">
                <table class="premium-ledger-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Reference</th>
                            <th>Allocation</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentActions as $action)
                            <tr>
                                <td style="font-weight: 700;">{{ \Carbon\Carbon::parse($action->payment_date)->format('M d, Y') }}</td>
                                <td style="font-family: monospace; font-weight: 600; color: #5D4037;">{{ $action->reference_code }}</td>
                                <td style="color: #5D4037;">{{ $action->description ?? 'Monthly Space Rent' }}</td>
                                <td>
                                    <span class="action-badge {{ strtolower($action->status) === 'paid' ? 'badge-success-glow' : 'badge-pending-glow' }}">
                                        {{ strtoupper($action->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td style="font-weight: 700;">April 01, 2026</td>
                                <td style="font-family: monospace; font-weight: 600; color: #5D4037;">#PAY-9921</td>
                                <td style="color: #5D4037;">Monthly Space Rent</td>
                                <td><span class="action-badge badge-success-glow">PAID</span></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection