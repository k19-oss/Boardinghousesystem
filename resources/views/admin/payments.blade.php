@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: var(--primary); font-weight: 800; margin: 0;">Payment Transaction History</h1>
    <button class="btn-primary" style="background: var(--primary); color: white; padding: 12px 24px; border-radius: 12px; border: none; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-plus"></i> Record New Payment
    </button>
</div>

<div class="card" style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #f5f5f4; color: var(--secondary); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                <th style="padding: 15px 10px;">Target Room</th>
                <th style="padding: 15px 10px;">Billing Period Date</th>
                <th style="padding: 15px 10px;">Amount Invoiced</th>
                <th style="padding: 15px 10px;">Collection Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($upcomingDues as $due)
            <tr style="border-bottom: 1px solid #f5f5f4; font-size: 0.95rem; color: #2d3436;">
                <td style="padding: 15px 10px; font-weight: 700; color: var(--primary);">{{ $due['room'] }}</td>
                <td style="padding: 15px 10px; color: #636e72;">{{ $due['date'] }}</td>
                <td style="padding: 15px 10px; font-weight: 700; color: var(--secondary);">{{ $due['amount'] }}</td>
                <td style="padding: 15px 10px;">
                    <span style="padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 800;
                        background: {{ $due['status'] == 'Paid' ? '#e3fcef' : ($due['status'] == 'Pending' ? '#fef5e7' : '#fff5f5') }};
                        color: {{ $due['status'] == 'Paid' ? '#00b894' : ($due['status'] == 'Pending' ? '#d97706' : '#ff7675') }};">
                        {{ $due['status'] }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection