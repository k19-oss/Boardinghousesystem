@extends('layouts.app')

@section('title', 'Tenants Management')

@section('content')
<div class="header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="font-weight: 800; color: #1e272e;">Tenants Management</h1>
    <a href="{{ route('admin.tenants.add') }}" class="btn-primary" style="background: #e77e6e; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: bold;">
        <i class="fa-solid fa-user-plus"></i> Add New Tenant
    </a>
</div>

<div class="card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    <h2 style="font-size: 1.1rem; margin-bottom: 20px; color: #485e6a;">All Residents</h2>
    <table style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
        <thead>
            <tr style="text-align: left; color: #b2bec3; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">
                <th style="padding: 10px;">Name</th>
                <th style="padding: 10px;">Room #</th>
                <th style="padding: 10px;">Phone Number</th>
                <th style="padding: 10px;">Status</th>
                <th style="padding: 10px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenants as $tenant)
            <tr style="background: #f9f9f9;">
                <td style="padding: 15px; border-radius: 10px 0 0 10px; font-weight: 600;">{{ $tenant['name'] }}</td>
                <td style="padding: 15px;">{{ $tenant['room'] }}</td>
                <td style="padding: 15px;">{{ $tenant['phone'] }}</td>
                <td style="padding: 15px;">
                    <span style="padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; 
                        background: {{ $tenant['status'] == 'Active' ? '#ebfbee' : '#fff4e6' }}; 
                        color: {{ $tenant['status'] == 'Active' ? '#2f9e44' : '#d9480f' }};">
                        {{ $tenant['status'] }}
                    </span>
                </td>
                <td style="padding: 15px; border-radius: 0 10px 10px 0;">
                    <button style="background: none; border: none; color: #42A5F5; cursor: pointer; margin-right: 10px;"><i class="fa-solid fa-eye"></i></button>
                    <button style="background: none; border: none; color: #EF5350; cursor: pointer;"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection