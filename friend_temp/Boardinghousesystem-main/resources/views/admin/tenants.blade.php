@extends('layouts.admin')

@section('content')
@if(session('success'))
    <div style="background-color: #e8f5e9; border: 1px solid #00b894; color: #00b894; padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; font-weight: 700; display: flex; align-items: center; gap: 8px; font-size: 0.9rem;">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: var(--primary); font-weight: 800; margin: 0;">Tenant Directory</h1>
    <a href="{{ route('admin.create-tenant') }}" class="btn-primary" style="background: var(--primary); color: white; padding: 12px 24px; border-radius: 12px; border: none; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-user-plus"></i> Register Tenant
    </a>
</div>

<div class="card" style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #f5f5f4; color: var(--secondary); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                <th style="padding: 15px 10px;">Tenant Name</th>
                <th style="padding: 15px 10px;">Assigned Room</th>
                <th style="padding: 15px 10px;">Contact Number</th>
                <th style="padding: 15px 10px;">Lease Status</th>
                <th style="padding: 15px 10px; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenants as $tenant)
            <tr style="border-bottom: 1px solid #f5f5f4; font-size: 0.95rem; color: #2d3436; transition: background 0.2s;">
                <td style="padding: 15px 10px; font-weight: 600; color: var(--primary);">{{ $tenant['name'] }}</td>
                <td style="padding: 15px 10px;">
                    <span style="font-weight: 700; color: var(--secondary);">
                        Room {{ $tenant['room_id'] ?? ($tenant['room'] ?? 'N/A') }}
                    </span>
                </td>
                <td style="padding: 15px 10px; color: #636e72;">{{ $tenant['phone'] }}</td>
                <td style="padding: 15px 10px;">
                    <span style="padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 800;
                        background: {{ $tenant['status'] == 'Active' ? '#e3fcef' : '#fff5f5' }};
                        color: {{ $tenant['status'] == 'Active' ? '#00b894' : '#ff7675' }};">
                        {{ $tenant['status'] }}
                    </span>
                </td>
                <td style="padding: 15px 10px; text-align: center;">
                    <button style="border: none; background: none; color: var(--secondary); cursor: pointer; margin-right: 10px;"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button style="border: none; background: none; color: #ff7675; cursor: pointer;"><i class="fa-solid fa-trash-can"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection