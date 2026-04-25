@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: var(--primary); font-weight: 700;">Register New Tenant</h1>
    <a href="{{ route('admin.tenants') }}" style="text-decoration: none; color: var(--secondary); font-size: 0.9rem;">
        <i class="fa-solid fa-arrow-left"></i> Back to List
    </a>
</div>

<div class="card" style="max-width: 900px; border-top: 4px solid var(--primary);">
    <form action="{{ route('admin.tenants.store') }}" method="POST">
        @csrf <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
            <div>
                <label style="display:block; margin-bottom: 8px; font-size: 0.8rem; font-weight: 600; color: #636e72;">FULL NAME</label>
                <input type="text" name="name" class="form-control" required placeholder="e.g. John Doe">
            </div>
            <div>
                <label style="display:block; margin-bottom: 8px; font-size: 0.8rem; font-weight: 600; color: #636e72;">ROOM ASSIGNMENT</label>
                <select name="room" class="form-control" required>
                    <option value="">Select a Room...</option>
                    <option value="101">Room 101</option>
                    <option value="102">Room 102</option>
                    <option value="201">Room 201</option>
                </select>
            </div>
            <div>
                <label style="display:block; margin-bottom: 8px; font-size: 0.8rem; font-weight: 600; color: #636e72;">CONTACT NUMBER</label>
                <input type="text" name="contact" class="form-control" placeholder="09XX XXX XXXX">
            </div>
            <div>
                <label style="display:block; margin-bottom: 8px; font-size: 0.8rem; font-weight: 600; color: #636e72;">MONTHLY RENT (₱)</label>
                <input type="number" name="rent" class="form-control" placeholder="3500">
            </div>
        </div>

        <div style="margin-top: 35px; border-top: 1px solid #eee; padding-top: 20px; display: flex; gap: 15px;">
            <button type="submit" class="btn-primary" style="padding: 12px 30px;">
                <i class="fa-solid fa-check"></i> Complete Registration
            </button>
            <button type="reset" style="background: #f1f2f6; border: none; padding: 12px 30px; border-radius: 10px; cursor: pointer; color: #636e72; font-weight: 600;">
                Clear Form
            </button>
        </div>
    </form>
</div>
@endsection