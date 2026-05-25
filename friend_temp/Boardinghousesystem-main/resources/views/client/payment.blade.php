@extends('layouts.client')

@section('title', 'Online Payment')

@section('content')
<style>
    .payment-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }
    .payment-card {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    .payment-card h3 {
        color: var(--primary-brown);
        margin-top: 0;
        font-size: 1.5rem;
        border-bottom: 2px solid var(--accent-tan);
        padding-bottom: 10px;
    }
    .bank-details {
        background: var(--primary-brown);
        color: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .form-group label {
        font-weight: 600;
        color: var(--primary-brown);
    }
    .form-group input, .form-group select {
        padding: 12px;
        border: 1px solid var(--accent-tan);
        border-radius: 8px;
        background: white;
        font-size: 1rem;
        outline: none;
    }
    .form-group input:focus {
        border-color: var(--primary-brown);
        box-shadow: 0 0 0 3px rgba(61, 43, 31, 0.1);
    }
    .submit-btn {
        background: var(--primary-brown);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        width: 100%;
    }
    .submit-btn:hover {
        background: #2a1d15;
        transform: translateY(-2px);
    }
</style>

<div class="payment-container">
    <div class="payment-card">
        <h3>Payment Instructions</h3>
        <p>Please transfer your outstanding balance to any of our official channels listed below. Once complete, upload a clear screenshot of your receipt on the right side of this portal.</p>
        
        <div class="bank-details">
            <div style="font-weight: 700; font-size: 1.1rem; margin-bottom: 10px;"><i class="fas fa-university"></i> Bank Transfer</div>
            <div><strong>Bank Name:</strong> BDO Unibank</div>
            <div><strong>Account Name:</strong> IPK Boarding House Inc.</div>
            <div><strong>Account Number:</strong> 1234-5678-9012</div>
        </div>

        <div class="bank-details" style="background: #0063e5;">
            <div style="font-weight: 700; font-size: 1.1rem; margin-bottom: 10px;"><i class="fas fa-mobile-screen"></i> e-Wallet Access</div>
            <div><strong>Channel:</strong> GCash</div>
            <div><strong>Account Name:</strong> IPK MANAGER</div>
            <div><strong>Mobile Number:</strong> 0917-123-4567</div>
        </div>
    </div>

    <div class="payment-card">
        <h3>Submit Proof of Payment</h3>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Amount Paid (PHP)</label>
                <input type="number" name="amount" placeholder="e.g. 3500" value="{{ $currentDues }}" required>
            </div>

            <div class="form-group">
                <label>Payment Method</label>
                <select name="payment_method" required>
                    <option value="gcash">GCash</option>
                    <option value="bdo">BDO Bank Transfer</option>
                    <option value="cash">Over-the-counter Cash</option>
                </select>
            </div>

            <div class="form-group">
                <label>Upload Receipt Document</label>
                <input type="file" name="receipt" accept="image/*,application/pdf" required>
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-cloud-arrow-up"></i> Upload Payment Verification
            </button>
        </form>
    </div>
</div>
@endsection