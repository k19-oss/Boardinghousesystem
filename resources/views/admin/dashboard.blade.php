@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="header">
        <h1>Dashboard</h1>
        <div class="btn-group">
            <button class="btn-add">Add New Tenant</button>
            <button class="btn-process">Process Payment</button>
        </div>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <h3>Total Due (Oct)</h3>
            <p>{{ $stats['total_due'] }}</p>
        </div>
        <div class="stat-card">
            <h3>Collected (Oct)</h3>
            <p>{{ $stats['collected'] }}</p>
        </div>
    </div>

    <div class="section-card">
        <h2>Upcoming Due Dates</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Room</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcomingDues as $due)
                <tr>
                    <td>{{ $due['date'] }}</td>
                    <td><span class="badge {{ strtolower($due['status']) }}">{{ $due['status'] }}</span></td>
                    <td>{{ $due['amount'] }}</td>
                    <td>{{ $due['room'] }}</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection