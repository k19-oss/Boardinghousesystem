@extends('layouts.admin')

@section('title', 'Admin Profile')

@push('styles')
<style>
    .profile-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.025);
        margin-bottom: 22px;
    }

    .form-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        color: #7f8c8d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 13px 16px;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        background-color: #ffffff;
        color: #3E2723;
        font-size: 0.95rem;
        font-weight: 600;
        font-family: inherit;
        transition: all 0.2s;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: #3E2723;
        box-shadow: 0 0 0 3px rgba(62, 39, 35, 0.1);
    }

    .card-section-title {
        color: #3E2723;
        font-weight: 800;
        margin: 0 0 22px 0;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    /* Toggle Switch */
    .toggle-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 0;
        border-bottom: 1px solid #f5f5f4;
    }

    .toggle-row:last-child { border-bottom: none; }

    .toggle-label strong {
        color: #3E2723;
        display: block;
        font-size: 0.9rem;
        margin-bottom: 3px;
    }

    .toggle-label span {
        color: #7f8c8d;
        font-size: 0.82rem;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 48px;
        height: 26px;
        flex-shrink: 0;
    }

    .toggle-switch input { opacity: 0; width: 0; height: 0; }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #dcdde1;
        transition: .35s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .35s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 50%;
        box-shadow: 0 1px 4px rgba(0,0,0,0.15);
    }

    .toggle-switch input:checked + .slider { background-color: #3E2723; }
    .toggle-switch input:checked + .slider:before { transform: translateX(22px); }

    /* Toggle disabled visual state */
    .toggle-disabled-hint {
        display: none;
        font-size: 0.72rem;
        color: #ff7675;
        font-weight: 600;
        margin-top: 3px;
    }

    .submit-btn {
        width: 100%;
        background: #3E2723;
        color: white;
        border: none;
        padding: 15px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.95rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        transition: all 0.2s;
        font-family: inherit;
        box-shadow: 0 4px 14px rgba(62, 39, 35, 0.15);
    }

    .submit-btn:hover {
        background: #271815;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(62, 39, 35, 0.2);
    }
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div style="margin-bottom: 28px;">
    <h1 style="color: #3E2723; font-weight: 800; margin: 0; font-size: 1.7rem; letter-spacing: -0.5px;">Admin Configuration</h1>
    <p style="color: #636e72; font-size: 0.88rem; margin: 5px 0 0 0;">Manage your account credentials and system notification preferences.</p>
</div>

@if(session('success'))
    <div style="background-color: #e8f5e9; border: 1px solid #a3e635; color: #10b981; padding: 14px 18px; border-radius: 12px; margin-bottom: 22px; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background-color: #fce8e6; border: 1px solid #fad2cf; color: #ef4444; padding: 14px 18px; border-radius: 12px; margin-bottom: 22px; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div style="background-color: #fce8e6; border: 1px solid #fad2cf; color: #ef4444; padding: 14px 18px; border-radius: 12px; margin-bottom: 22px; font-weight: 600; font-size: 0.9rem;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.profile.update') }}" method="POST">
    @csrf
    @method('PUT')

    {{-- PROFILE IDENTITY CARD --}}
    <div class="profile-card">

        {{-- Avatar + Name Display --}}
        <div style="display: flex; flex-direction: column; align-items: center; text-align: center; border-bottom: 1px solid #f5f5f4; padding-bottom: 24px; margin-bottom: 24px;">
            <div style="width: 72px; height: 72px; background: #3E2723; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; font-weight: 800; margin-bottom: 14px;">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <h3 style="color: #3E2723; font-size: 1.2rem; font-weight: 800; margin: 0 0 4px 0;">
                {{ auth()->user()->name ?? 'System Administrator' }}
            </h3>
            <p style="color: #7f8c8d; font-size: 0.88rem; margin: 0;">
                {{ auth()->user()->email ?? 'admin@ipk.com' }}
            </p>
        </div>

        <div>
            <label class="form-label">Update Username</label>
            <input type="text" name="name" class="form-input"
                value="{{ old('name', auth()->user()->name ?? '') }}"
                required placeholder="Enter new username">
        </div>
    </div>

    {{-- SECURITY SETTINGS CARD --}}
    <div class="profile-card">
        <div class="card-section-title">
            <i class="fa-solid fa-shield-halved" style="color: #8d6e63;"></i>
            Security Settings
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Current Password</label>
            <input type="password" name="current_password" class="form-input" placeholder="Enter your current password">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <label class="form-label">New Password</label>
                <input type="password" name="password" class="form-input" placeholder="Min. 6 characters">
            </div>
            <div>
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-input" placeholder="Repeat new password">
            </div>
        </div>
    </div>

    {{-- SYSTEM NOTIFICATIONS CARD --}}
    <div class="profile-card">
        <div class="card-section-title">
            <i class="fa-solid fa-bell" style="color: #8d6e63;"></i>
            System Notifications
        </div>

        {{-- Payment Alerts Toggle --}}
        <div class="toggle-row" id="payment-alert-row">
            <div class="toggle-label">
                <strong>Payment Alerts</strong>
                <span>Receive in-system alerts when a tenant submits a payment.</span>
                <div class="toggle-disabled-hint" id="payment-disabled-hint">
                    <i class="fa-solid fa-ban"></i> Payment alerts are currently disabled — you won't be notified of new payments.
                </div>
            </div>
            <label class="toggle-switch">
                <input type="checkbox"
                       name="alert_payments"
                       id="toggle-payments"
                       value="1"
                       {{ old('alert_payments', $prefs['alert_payments'] ?? true) ? 'checked' : '' }}>
                <span class="slider"></span>
            </label>
        </div>

        {{-- Maintenance Tickets Toggle --}}
        <div class="toggle-row" id="maintenance-alert-row">
            <div class="toggle-label">
                <strong>Maintenance Tickets</strong>
                <span>Receive in-system alerts for new facility issues submitted by tenants.</span>
                <div class="toggle-disabled-hint" id="maintenance-disabled-hint">
                    <i class="fa-solid fa-ban"></i> Maintenance alerts are currently disabled — ticket notifications are silenced.
                </div>
            </div>
            <label class="toggle-switch">
                <input type="checkbox"
                       name="alert_maintenance"
                       id="toggle-maintenance"
                       value="1"
                       {{ old('alert_maintenance', $prefs['alert_maintenance'] ?? true) ? 'checked' : '' }}>
                <span class="slider"></span>
            </label>
        </div>
    </div>

    <button type="submit" class="submit-btn">
        <i class="fa-solid fa-floppy-disk"></i> Save All Configurations
    </button>
</form>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // === TOGGLE SOUND ENGINE ===
    function playToggleSound(isOn) {
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc  = ctx.createOscillator();
            const gain = ctx.createGain();

            osc.connect(gain);
            gain.connect(ctx.destination);

            osc.type = 'sine';

            if (isOn) {
                // ON: rising tone
                osc.frequency.setValueAtTime(400, ctx.currentTime);
                osc.frequency.linearRampToValueAtTime(700, ctx.currentTime + 0.12);
            } else {
                // OFF: falling tone
                osc.frequency.setValueAtTime(700, ctx.currentTime);
                osc.frequency.linearRampToValueAtTime(300, ctx.currentTime + 0.12);
            }

            gain.gain.setValueAtTime(0.15, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.15);

            osc.start(ctx.currentTime);
            osc.stop(ctx.currentTime + 0.15);
        } catch(e) {
            console.warn('Audio context blocked:', e);
        }
    }

    // === TOGGLE VISUAL FEEDBACK ===
    function applyToggleState(toggleEl, hintEl, rowEl) {
        const isOn = toggleEl.checked;

        if (isOn) {
            hintEl.style.display = 'none';
            rowEl.style.opacity = '1';
        } else {
            hintEl.style.display = 'block';
            rowEl.style.opacity = '0.75';
        }
    }

    // Payment Alerts
    const paymentToggle  = document.getElementById('toggle-payments');
    const paymentHint    = document.getElementById('payment-disabled-hint');
    const paymentRow     = document.getElementById('payment-alert-row');

    // Maintenance Alerts
    const maintenanceToggle = document.getElementById('toggle-maintenance');
    const maintenanceHint   = document.getElementById('maintenance-disabled-hint');
    const maintenanceRow    = document.getElementById('maintenance-alert-row');

    // Apply initial visual state on page load (no sound)
    applyToggleState(paymentToggle, paymentHint, paymentRow);
    applyToggleState(maintenanceToggle, maintenanceHint, maintenanceRow);

    // Payment toggle change
    paymentToggle.addEventListener('change', function () {
        playToggleSound(this.checked);
        applyToggleState(this, paymentHint, paymentRow);
    });

    // Maintenance toggle change
    maintenanceToggle.addEventListener('change', function () {
        playToggleSound(this.checked);
        applyToggleState(this, maintenanceHint, maintenanceRow);
    });
});
</script>
@endpush