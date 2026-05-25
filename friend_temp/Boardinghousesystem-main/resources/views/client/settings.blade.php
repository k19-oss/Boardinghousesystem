@extends('layouts.client')

@section('title', 'Portal Settings')

@section('content')
<style>
    .settings-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 30px;
    }
    .settings-card {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    .settings-card h3 {
        color: var(--primary-brown);
        margin-top: 0;
        font-size: 1.4rem;
        margin-bottom: 20px;
        border-bottom: 2px solid var(--accent-tan);
        padding-bottom: 8px;
    }
    .profile-meta-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed rgba(61, 43, 31, 0.2);
    }
    .profile-meta-row span:first-child {
        font-weight: 700;
        color: var(--primary-brown);
    }
</style>

<div class="settings-grid">
    <div class="settings-card">
        <h3>Resident Metadata</h3>
        <div class="profile-meta-row">
            <span>Room Assignment</span>
            <span>{{ $roomNumber }}</span>
        </div>
        <div class="profile-meta-row">
            <span>Room Style Tier</span>
            <span>{{ $roomType }}</span>
        </div>
        <div class="profile-meta-row">
            <span>Registered Mobile</span>
            <span>{{ $phoneNumber }}</span>
        </div>
        <div class="profile-meta-row">
            <span>Emergency Contact</span>
            <span>{{ $emergencyNumber }}</span>
        </div>
        <div class="profile-meta-row" style="border: none;">
            <span>Move-in Date</span>
            <span>{{ $registrationDate }}</span>
        </div>
    </div>

    <div class="settings-card">
        <h3>IPK Resident Help Desk</h3>
        <p>Notice a maintenance issue or have an issue with your billing? Submit a ticket straight to the building manager below.</p>
        
        <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            @csrf
            <div style="display: flex; flex-direction: column; gap: 6px;">
                <label style="font-weight:600; color:var(--primary-brown);">Category</label>
                <select style="padding:12px; border:1px solid var(--accent-tan); border-radius:8px;">
                    <option value="plumbing">Plumbing & Water Facility</option>
                    <option value="electrical">Electrical Grid / Light Bulbs</option>
                    <option value="billing">Billing Dispute Inquiry</option>
                    <option value="other">General Feedback</option>
                </select>
            </div>

            <div style="display: flex; flex-direction: column; gap: 6px;">
                <label style="font-weight:600; color:var(--primary-brown);">Problem Description</label>
                <textarea rows="4" style="padding:12px; border:1px solid var(--accent-tan); border-radius:8px; font-family:inherit; resize:none;" placeholder="Describe your concern in detail..."></textarea>
            </div>

            <button type="button" class="submit-btn" style="background:var(--primary-brown); color:white; padding:14px; border:none; border-radius:10px; font-weight:700; cursor:pointer;">
                Submit Support Request
            </button>
        </form>
    </div>
</div>
@endsection