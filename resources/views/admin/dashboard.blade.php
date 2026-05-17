@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div>
        <h1 style="color: #3E2723; font-weight: 800; letter-spacing: -1px; margin: 0;">Dashboard Overview</h1>
        <p style="color: #636e72; font-size: 0.9rem; margin: 5px 0 0 0;">Welcome back, Admin. Here is what's happening today.</p>
    </div>
    <div style="display: flex; gap: 12px;">
        <a href="{{ route('admin.create-tenant') }}" class="btn-primary" style="background: #3E2723; color: #ffffff; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <i class="fa-solid fa-user-plus"></i> New Tenant
        </a>
        <button class="btn-primary" style="background: #ffffff; color: #3E2723; border: 1px solid #e0e0e0; padding: 10px 18px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
            <i class="fa-solid fa-download"></i> Reports
        </button>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
    <div class="card" style="background: #ffffff; padding: 20px; border-radius: 16px; border-left: 5px solid #5d4037; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="color: #8c8c8c; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin: 0; tracking-spacing: 0.5px;">Total Revenue</p>
                <h2 style="font-size: 1.6rem; font-weight: 800; color: #2d2d2d; margin: 5px 0 0 0;">{{ $stats['total_due'] }}</h2>
            </div>
            <div style="background: #efebe9; color: #5d4037; padding: 10px; border-radius: 10px; font-size: 1.1rem;"><i class="fa-solid fa-wallet"></i></div>
        </div>
    </div>
    
    <div class="card" style="background: #ffffff; padding: 20px; border-radius: 16px; border-left: 5px solid #2ecc71; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="color: #8c8c8c; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin: 0; tracking-spacing: 0.5px;">Collected</p>
                <h2 style="font-size: 1.6rem; font-weight: 800; color: #2ecc71; margin: 5px 0 0 0;">{{ $stats['collected'] }}</h2>
            </div>
            <div style="background: #e8f5e9; color: #2ecc71; padding: 10px; border-radius: 10px; font-size: 1.1rem;"><i class="fa-solid fa-circle-check"></i></div>
        </div>
    </div>

    <div class="card" style="background: #ffffff; padding: 20px; border-radius: 16px; border-left: 5px solid #e17055; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="color: #8c8c8c; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin: 0; tracking-spacing: 0.5px;">Pending</p>
                <h2 style="font-size: 1.6rem; font-weight: 800; color: #e17055; margin: 5px 0 0 0;">{{ $stats['pending'] }}</h2>
            </div>
            <div style="background: #fff3e0; color: #e17055; padding: 10px; border-radius: 10px; font-size: 1.1rem;"><i class="fa-solid fa-clock-rotate-left"></i></div>
        </div>
    </div>

    <div class="card" style="background: #ffffff; padding: 20px; border-radius: 16px; border-left: 5px solid #8d6e63; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="color: #8c8c8c; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin: 0; tracking-spacing: 0.5px;">Occupancy</p>
                <h2 style="font-size: 1.6rem; font-weight: 800; color: #2d2d2d; margin: 5px 0 0 0;">{{ $stats['occupancy'] }}</h2>
            </div>
            <div style="background: #f5f5f4; color: #8d6e63; padding: 10px; border-radius: 10px; font-size: 1.1rem;"><i class="fa-solid fa-bed"></i></div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">
    <div class="card" style="background: #ffffff; padding: 24px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="color: #3E2723; font-size: 1.1rem; font-weight: 700; margin: 0;"><i class="fa-solid fa-list-ul" style="margin-right: 8px; color: #8d6e63;"></i> Recent Activities</h3>
            <a href="#" style="font-size: 0.8rem; color: #b45309; text-decoration: none; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">View All</a>
        </div>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; color: #a3a3a3; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px; border-bottom: 1px solid #f5f5f4;">
                    <th style="padding: 12px;">TENANT / ROOM</th>
                    <th style="padding: 12px;">DATE</th>
                    <th style="padding: 12px;">AMOUNT</th>
                    <th style="padding: 12px; text-align: right;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcomingDues as $due)
                <tr style="border-bottom: 1px solid #fafaf9;">
                    <td style="padding: 14px 12px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 36px; height: 36px; border-radius: 50%; background: #efebe9; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; color: #3E2723; font-weight: 600;">👤</div>
                            <div>
                                <div style="font-weight: 700; font-size: 0.9rem; color: #2d2d2d;">Student Name</div>
                                <div style="font-size: 0.75rem; color: #78716c; margin-top: 2px;">{{ $due['room'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 14px 12px; font-size: 0.85rem; color: #57534e;">{{ $due['date'] }}</td>
                    <td style="padding: 14px 12px; font-weight: 700; color: #2d2d2d; font-size: 0.9rem;">{{ $due['amount'] }}</td>
                    <td style="padding: 14px 12px; text-align: right;">
                        <span style="padding: 5px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 800; letter-spacing: 0.3px; display: inline-block;
                            @if($due['status'] == 'Paid')
                                background: #e3fcef; color: #00b894; border: 1px solid #a3e635;
                            @elseif($due['status'] == 'Pending')
                                background: #fffbeb; color: #d97706; border: 1px solid #fde68a;
                            @else
                                background: #fff5f5; color: #ff7675; border: 1px solid #fca5a5;
                            @endif">
                            {{ strtoupper($due['status']) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="display: flex; flex-direction: column; gap: 25px;">
        <div class="card" style="background: #3E2723; color: #ffffff; padding: 24px; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(62, 39, 35, 0.15);">
            <h4 style="margin: 0 0 15px 0; font-size: 1rem; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;"><i class="fa-solid fa-bolt" style="color: #fbbf24; margin-right: 6px;"></i> Quick Actions</h4>
            <div style="display: grid; gap: 10px;">
                <button style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: #f5f5f4; padding: 12px; border-radius: 10px; cursor: pointer; text-align: left; font-size: 0.85rem; font-weight: 500; display: flex; align-items: center; gap: 10px; transition: background 0.2s;">
                    <i class="fa-solid fa-envelope" style="color: #fbbf24;"></i> Send Payment Reminder
                </button>
                <button style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: #f5f5f4; padding: 12px; border-radius: 10px; cursor: pointer; text-align: left; font-size: 0.85rem; font-weight: 500; display: flex; align-items: center; gap: 10px; transition: background 0.2s;">
                    <i class="fa-solid fa-print" style="color: #fbbf24;"></i> Generate Room Invoice
                </button>
            </div>
        </div>
        
        <div class="card" style="background: #ffffff; padding: 24px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f5f5f4;">
            <h4 style="margin: 0 0 15px 0; color: #3E2723; font-size: 1rem; font-weight: 700;"><i class="fa-solid fa-bullhorn" style="color: #8d6e63; margin-right: 6px;"></i> System Alerts</h4>
            <div style="display: flex; flex-direction: column; gap: 14px;">
                <div style="display: flex; gap: 10px; font-size: 0.8rem; border-left: 3px solid #ff7675; padding-left: 12px;">
                    <div style="color: #57534e; line-height: 1.4;"><strong style="color: #1c1917;">Room 203</strong> is 3 days overdue on lease balance.</div>
                </div>
                <div style="display: flex; gap: 10px; font-size: 0.8rem; border-left: 3px solid #00b894; padding-left: 12px;">
                    <div style="color: #57534e; line-height: 1.4;">Maintenance log check in <strong style="color: #1c1917;">Room 105</strong> marked complete.</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection