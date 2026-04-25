@extends('layouts.client') {{-- Use the new separated client layout --}}

@section('title', 'Tenant Portal')

@section('content')
    <div class="header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="color: #5D4037;">My Resident Portal</h1>
        <button class="btn-process" style="background: #4CAF50; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: bold;">
            <i class="fas fa-wallet"></i> Pay via GCash
        </button>
    </div>

    <div class="stats-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; border-left: 8px solid #5D4037; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <h3 style="color: #888; margin-top: 0;">My Assigned Room</h3>
            <p style="font-size: 2rem; font-weight: bold; margin: 10px 0; color: #333;">{{ $myStatus['room'] }}</p>
        </div>
        
        <div class="stat-card" style="background-color: {{ $myStatus['is_overdue'] ? '#E57373' : '#8D6E63' }}; color: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h3 style="margin-top: 0; opacity: 0.9;">Current Balance</h3>
            <p style="font-size: 2rem; font-weight: bold; margin: 10px 0;">₱{{ $myStatus['balance'] }}</p>
            <span style="font-size: 0.9rem; background: rgba(0,0,0,0.1); padding: 4px 8px; border-radius: 5px;">
                Due on: {{ $myStatus['due_date'] }}
            </span>
        </div>
    </div>

    <div class="section-card" style="background: #FFF; padding: 20px; border-radius: 15px; margin-bottom: 30px; border-left: 5px solid #5D4037;">
        <h2 style="margin-top: 0;"><i class="fas fa-bullhorn"></i> Announcements</h2>
        <div style="background: #F9F9F9; color: #333; padding: 15px; border-radius: 10px;">
            <p><strong>Note:</strong> Please settle your March rent to avoid the late fee. - Management</p>
        </div>
    </div>

    <div class="section-card" style="background: #FFF; padding: 20px; border-radius: 15px;">
        <h2 style="margin-top: 0;"><i class="fas fa-history"></i> My Recent Payments</h2>
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="text-align: left; border-bottom: 2px solid #eee;">
                    <th style="padding: 12px;">Month</th>
                    <th style="padding: 12px;">Amount Paid</th>
                    <th style="padding: 12px;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f0f0f0;">
                    <td style="padding: 12px;">February 2026</td>
                    <td style="padding: 12px;">₱3,500.00</td>
                    <td style="padding: 12px;"><span style="color: green; font-weight: bold;">Verified</span></td>
                </tr>
                <tr style="border-bottom: 1px solid #f0f0f0;">
                    <td style="padding: 12px;">January 2026</td>
                    <td style="padding: 12px;">₱3,500.00</td>
                    <td style="padding: 12px;"><span style="color: green; font-weight: bold;">Verified</span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection