@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div>
        <h1 style="color: var(--primary); font-weight: 800; letter-spacing: -1px;">Dashboard Overview</h1>
        <p style="color: #636e72; font-size: 0.9rem;">Welcome back, Admin. Here is what's happening today.</p>
    </div>
    <div style="display: flex; gap: 12px;">
        <a href="{{ route('admin.tenants.create') }}" class="btn-primary" style="background: var(--accent); color: var(--primary);">
            <i class="fa-solid fa-user-plus"></i> New Tenant
        </a>
        <button class="btn-primary" style="background: #fff; color: var(--primary); border: 1px solid #ddd;">
            <i class="fa-solid fa-download"></i> Reports
        </button>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
    <div class="card" style="border-left: 5px solid #0984e3;">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="color: #636e72; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Total Revenue</p>
                <h2 style="font-size: 1.6rem; margin-top: 5px;">₱42,500</h2>
            </div>
            <div style="background: #e1f5fe; color: #0984e3; padding: 10px; border-radius: 10px;"><i class="fa-solid fa-wallet"></i></div>
        </div>
    </div>
    
    <div class="card" style="border-left: 5px solid #2ecc71;">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="color: #636e72; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Collected</p>
                <h2 style="font-size: 1.6rem; margin-top: 5px;">₱31,200</h2>
            </div>
            <div style="background: #e8f5e9; color: #2ecc71; padding: 10px; border-radius: 10px;"><i class="fa-solid fa-circle-check"></i></div>
        </div>
    </div>

    <div class="card" style="border-left: 5px solid #e17055;">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="color: #636e72; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Pending</p>
                <h2 style="font-size: 1.6rem; margin-top: 5px;">₱11,300</h2>
            </div>
            <div style="background: #fff3e0; color: #e17055; padding: 10px; border-radius: 10px;"><i class="fa-solid fa-clock-rotate-left"></i></div>
        </div>
    </div>

    <div class="card" style="border-left: 5px solid var(--primary);">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="color: #636e72; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Occupancy</p>
                <h2 style="font-size: 1.6rem; margin-top: 5px;">88%</h2>
            </div>
            <div style="background: #efebe9; color: var(--primary); padding: 10px; border-radius: 10px;"><i class="fa-solid fa-bed"></i></div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="color: var(--primary); font-size: 1.1rem;"><i class="fa-solid fa-list-ul" style="margin-right: 8px;"></i> Recent Activities</h3>
            <a href="#" style="font-size: 0.8rem; color: var(--secondary); text-decoration: none; font-weight: 600;">View All</a>
        </div>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; color: #b2bec3; font-size: 0.7rem; letter-spacing: 1px; border-bottom: 1px solid #eee;">
                    <th style="padding: 12px;">TENANT / ROOM</th>
                    <th style="padding: 12px;">DATE</th>
                    <th style="padding: 12px;">AMOUNT</th>
                    <th style="padding: 12px;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcomingDues as $due)
<<<<<<< HEAD
                <tr>
                    <td>{{ $due['date'] }}</td>
                    <td><span class="badge {{ strtolower($due['status']) }}">{{ $due['status'] }}</span></td>
                    <td>{{ $due['amount'] }}</td>
                    <td>{{ $due['room'] }}</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
=======
                <tr style="border-bottom: 1px solid #f8f9fa;">
                    <td style="padding: 15px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 35px; height: 35px; border-radius: 50%; background: #eee; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; color: var(--primary);">👤</div>
                            <div>
                                <div style="font-weight: 700; font-size: 0.9rem;">Student Name</div>
                                <div style="font-size: 0.75rem; color: #636e72;">{{ $due['room'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 15px; font-size: 0.85rem; color: #2d3436;">{{ $due['date'] }}</td>
                    <td style="padding: 15px; font-weight: 700; color: #2d3436;">{{ $due['amount'] }}</td>
                    <td style="padding: 15px;">
                        <span style="padding: 5px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 800; 
                            background: {{ $due['status'] == 'Paid' ? '#e3fcef' : '#fff5f5' }}; 
                            color: {{ $due['status'] == 'Paid' ? '#00b894' : '#ff7675' }}; border: 1px solid currentColor;">
                            {{ strtoupper($due['status']) }}
                        </span>
>>>>>>> client
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<<<<<<< HEAD
=======

    <div style="display: flex; flex-direction: column; gap: 25px;">
        <div class="card" style="background: var(--primary); color: white;">
            <h4 style="margin-bottom: 15px;"><i class="fa-solid fa-bolt"></i> Quick Actions</h4>
            <div style="display: grid; gap: 10px;">
                <button style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white; padding: 10px; border-radius: 8px; cursor: pointer; text-align: left; font-size: 0.85rem;">
                    <i class="fa-solid fa-envelope"></i> Send Payment Reminder
                </button>
                <button style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white; padding: 10px; border-radius: 8px; cursor: pointer; text-align: left; font-size: 0.85rem;">
                    <i class="fa-solid fa-print"></i> Generate Room Invoice
                </button>
            </div>
        </div>
        
        <div class="card">
            <h4 style="margin-bottom: 15px; color: var(--primary);"><i class="fa-solid fa-bullhorn"></i> System Alerts</h4>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <div style="display: flex; gap: 10px; font-size: 0.8rem; border-left: 3px solid #ff7675; padding-left: 10px;">
                    <div><strong>Room 203</strong> is 3 days overdue.</div>
                </div>
                <div style="display: flex; gap: 10px; font-size: 0.8rem; border-left: 3px solid #00b894; padding-left: 10px;">
                    <div>Maintenance in <strong>Room 105</strong> completed.</div>
                </div>
            </div>
        </div>
    </div>
</div>
>>>>>>> client
@endsection