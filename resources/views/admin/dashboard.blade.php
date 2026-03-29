@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="header">
        <h1>Admin Dashboard</h1>
        <button style="background: #5D4037; color: white; padding: 10px; border: none; border-radius: 5px;">+ Add Tenant</button>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <h3>Total Due</h3>
            <p>{{ $stats['total_due'] }}</p>
        </div>
        <div class="stat-card">
            <h3>Collected</h3>
            <p>{{ $stats['collected'] }}</p>
        </div>
    </div>

    <div class="section-card">
        <h2>Upcoming Dues</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Room</th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcomingDues as $due)
                <tr>
                    <td>{{ $due['date'] }}</td>
                    <td><span class="badge {{ strtolower($due['status']) }}">{{ $due['status'] }}</span></td>
                    <td>{{ $due['amount'] }}</td>
                    <td>{{ $due['room'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection