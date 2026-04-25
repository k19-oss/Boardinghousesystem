@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: var(--primary);">Payment History</h1>
    <button class="btn-primary"><i class="fa-solid fa-file-export"></i> Export Report</button>
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 2px solid #eee; color: #636e72; font-size: 0.8rem;">
                <th style="padding: 15px;">TRANSACTION ID</th>
                <th style="padding: 15px;">TENANT</th>
                <th style="padding: 15px;">AMOUNT PAID</th>
                <th style="padding: 15px;">DATE</th>
                <th style="padding: 15px;">METHOD</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom: 1px solid #f8f9fa;">
                <td style="padding: 15px;">#TXN-8821</td>
                <td style="padding: 15px; font-weight: 500;">Juan Dela Cruz</td>
                <td style="padding: 15px; color: #2ecc71; font-weight: bold;">₱3,500.00</td>
                <td style="padding: 15px;">April 20, 2026</td>
                <td style="padding: 15px;"><span style="background: #f1f2f6; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem;">Cash</span></td>
            </tr>
            <tr style="border-bottom: 1px solid #f8f9fa;">
                <td style="padding: 15px;">#TXN-8819</td>
                <td style="padding: 15px; font-weight: 500;">Maria Clara</td>
                <td style="padding: 15px; color: #2ecc71; font-weight: bold;">₱3,500.00</td>
                <td style="padding: 15px;">April 18, 2026</td>
                <td style="padding: 15px;"><span style="background: #f1f2f6; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem;">GCash</span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection