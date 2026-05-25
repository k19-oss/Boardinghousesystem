@extends('layouts.client')

@section('title', 'Billing History')

@section('content')
<style>
    .history-card {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        padding: 35px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    .history-card h3 {
        color: var(--primary-brown);
        margin-top: 0;
        font-size: 1.6rem;
        margin-bottom: 25px;
    }
    .history-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }
    .history-table th {
        background-color: var(--primary-brown);
        color: white;
        padding: 14px 18px;
        font-weight: 600;
        font-size: 0.95rem;
    }
    .history-table th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
    .history-table th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }
    
    .history-table td {
        padding: 16px 18px;
        border-bottom: 1px solid var(--accent-tan);
        color: #4a4a4a;
        font-weight: 500;
    }
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .status-badge.approved { background: rgba(46, 204, 113, 0.15); color: #27ae60; }
    .status-badge.pending { background: rgba(241, 196, 15, 0.15); color: #f39c12; }
</style>

<div class="history-card">
    <h3>Complete Billing Ledger</h3>
    
    <table class="history-table">
        <thead>
            <tr>
                <th>Reference ID</th>
                <th>Billing Cycle</th>
                <th>Amount Paid</th>
                <th>Date Submitted</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#TRX-99821</td>
                <td>May 2026 Room Rent</td>
                <td>₱3,500.00</td>
                <td>May 02, 2026</td>
                <td><span class="status-badge approved"><i class="fas fa-circle-check"></i> Approved</span></td>
            </tr>
            <tr>
                <td>#TRX-98410</td>
                <td>April 2026 Room Rent</td>
                <td>₱3,500.00</td>
                <td>Apr 03, 2026</td>
                <td><span class="status-badge approved"><i class="fas fa-circle-check"></i> Approved</span></td>
            </tr>
            <tr>
                <td>#TRX-97102</td>
                <td>March 2026 Room Rent</td>
                <td>₱3,500.00</td>
                <td>Mar 01, 2026</td>
                <td><span class="status-badge approved"><i class="fas fa-circle-check"></i> Approved</span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection