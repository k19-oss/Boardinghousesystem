@extends('layouts.admin')

@section('content')
@if(session('success'))
    <div style="background-color: #e8f5e9; border: 1px solid #00b894; color: #00b894; padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; font-weight: 700; display: flex; align-items: center; gap: 8px; font-size: 0.9rem;">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div style="background-color: #fff5f5; border: 1px solid #ff7675; color: #ff7675; padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; font-weight: 700; font-size: 0.9rem;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: var(--primary); font-weight: 800; margin: 0;">Payment Transaction History</h1>
    <button onclick="togglePaymentModal(true)" class="btn-primary" style="background: var(--primary); color: white; padding: 12px 24px; border-radius: 12px; border: none; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-plus"></i> Record New Payment
    </button>
</div>

<div class="card" style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #f5f5f4; color: var(--secondary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                <th style="padding: 15px 12px;">Target Room</th>
                <th style="padding: 15px 12px;">Billing Period Date</th>
                <th style="padding: 15px 12px;">Amount Invoiced</th>
                <th style="padding: 15px 12px; text-align: right;">Collection Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($upcomingDues as $due)
            <tr style="border-bottom: 1px solid #f5f5f4; font-size: 0.95rem; color: #2d3436;">
                <td style="padding: 15px 12px; font-weight: 700; color: #2d2d2d;">{{ $due['room'] }}</td>
                <td style="padding: 15px 12px; color: #636e72;">{{ $due['date'] }}</td>
                <td style="padding: 15px 12px; font-weight: 700; color: #2d2d2d;">{{ $due['amount'] }}</td>
                <td style="padding: 15px 12px; text-align: right;">
                    <span style="padding: 5px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 800; letter-spacing: 0.3px; display: inline-block;
                        @if($due['status'] == 'Paid' || $due['status'] == 'PAID')
                            background: #e3fcef; color: #00b894;
                        @@elseif($due['status'] == 'Pending' || $due['status'] == 'PENDING')
                            background: #fffbeb; color: #d97706;
                        @else
                            background: #fff5f5; color: #ff7675;
                        @endif">
                        {{ strtoupper($due['status']) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="recordPaymentModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); z-index: 9999; align-items: center; justify-content: center;">
    <div class="card" style="background: white; border-radius: 20px; padding: 35px; width: 100%; max-width: 480px; box-shadow: 0 20px 50px rgba(0,0,0,0.15); border: 1px solid rgba(0,0,0,0.05); position: relative; margin: 20px;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h2 style="color: var(--primary); font-weight: 800; margin: 0; font-size: 1.4rem;">Record New Payment</h2>
            <button onclick="togglePaymentModal(false)" style="background: none; border: none; color: #636e72; font-size: 1.2rem; cursor: pointer;">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('admin.payments.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Select Room</label>
                <input type="text" name="room_id" required placeholder="e.g. 101" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Amount (₱)</label>
                <input type="number" step="0.01" name="amount" required placeholder="e.g. 3500" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Billing Date</label>
                <input type="date" name="date" required value="{{ date('Y-m-d') }}" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Collection Status</label>
                <select name="status" required style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; background-color: white;">
                    <option value="Paid">Paid</option>
                    <option value="Pending">Pending</option>
                    <option value="Overdue">Overdue</option>
                </select>
            </div>

            <div style="display: flex; gap: 12px; margin-top: 10px;">
                <button type="button" onclick="togglePaymentModal(false)" style="flex: 1; background: #f1f2f6; color: #2f3542; padding: 12px; border-radius: 10px; border: none; font-weight: 700; font-size: 0.95rem; cursor: pointer;">
                    Cancel
                </button>
                <button type="submit" class="btn-primary" style="flex: 1; background: var(--primary); color: white; padding: 12px; border-radius: 10px; border: none; font-weight: 700; font-size: 0.95rem; cursor: pointer;">
                    Save Record
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function togglePaymentModal(show) {
    const modal = document.getElementById('recordPaymentModal');
    if (show) {
        modal.style.display = 'flex';
    } else {
        modal.style.display = 'none';
    }
}
</script>
@endsection