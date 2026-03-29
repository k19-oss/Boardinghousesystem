@extends('layouts.admin')

@section('title', 'Tenants List')

@section('content')
    <div class="header">
        <h1>Tenants Management</h1>
        <button style="background: white; color: #5D4037; padding: 10px 20px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
            + Add New Tenant
        </button>
    </div>

    <div class="section-card">
        <h2>All Residents</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Room #</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tenants as $tenant)
                <tr>
                    <td>{{ $tenant['name'] }}</td>
                    <td>{{ $tenant['room'] }}</td>
                    <td>{{ $tenant['phone'] }}</td>
                    <td><span class="badge {{ strtolower($tenant['status']) }}">{{ $tenant['status'] }}</span></td>
                    <td>
                        <button class="btn-action" style="background: #42A5F5;">View</button>
                        <button class="btn-action" style="background: #EF5350;">Remove</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection