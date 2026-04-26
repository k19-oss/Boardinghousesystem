@extends('layouts.client')

@section('title', 'Resident Dashboard')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f5f5dc 0%, #d7ccc8 100%);
        background-attachment: fixed;
    }

    .glass-container {
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
    }

    .stat-card-glass {
        background: rgba(255, 255, 255, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 18px;
        padding: 20px;
        transition: transform 0.3s ease;
    }

    .stat-card-glass:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.8);
    }

    .brown-badge {
        background: #3d2b1f;
        color: white;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
    }
</style>

<div class="glass-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px;">
        <div>
            <h1 style="color: #3d2b1f; font-weight: 800; margin: 0;">My Overview</h1>
            <p style="color: #5d4037; opacity: 0.8; margin-top: 5px;">Welcome back to IPK Boarding House.</p>
        </div>
        <div class="brown-badge">UNIT 101</div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <div class="stat-card-glass">
            <p style="font-size: 0.75rem; color: #8d8d8d; font-weight: 800; text-transform: uppercase;">Current Balance</p>
            <h2 style="color: #3d2b1f; font-size: 1.8rem; margin: 10px 0;">₱3,500.00</h2>
            <p style="font-size: 0.85rem; color: #e67e22;"><i class="fa-solid fa-clock"></i> Due in 5 days</p>
        </div>

        <div class="stat-card-glass">
            <p style="font-size: 0.75rem; color: #8d8d8d; font-weight: 800; text-transform: uppercase;">Room Type</p>
            <h2 style="color: #3d2b1f; font-size: 1.5rem; margin: 10px 0;">Premium Solo</h2>
            <p style="font-size: 0.85rem; color: #2ecc71;"><i class="fa-solid fa-check-circle"></i> Good Condition</p>
        </div>
    </div>

    <div class="stat-card-glass" style="margin-top: 30px;">
        <h3 style="color: #3d2b1f; margin-bottom: 20px;">Payment History</h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; border-bottom: 1px solid rgba(0,0,0,0.05);">
                        <th style="padding: 15px; color: #8d8d8d; font-size: 0.8rem;">DATE</th>
                        <th style="padding: 15px; color: #8d8d8d; font-size: 0.8rem;">REFERENCE</th>
                        <th style="padding: 15px; color: #8d8d8d; font-size: 0.8rem;">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 15px; font-weight: 600;">April 01, 2026</td>
                        <td style="padding: 15px;">#PAY-9921</td>
                        <td style="padding: 15px;"><span style="color: #27ae60; font-weight: 800;">PAID</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div style="margin-top: auto; padding: 20px;">
    <a href="{{ route('client.logout') }}" class="nav-item" style="color: #ff7675;">
        <i class="fas fa-power-off"></i> Logout
    </a>
</div>

@endsection