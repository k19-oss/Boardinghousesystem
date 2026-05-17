@extends('layouts.admin')

@section('content')
<div style="margin-bottom: 30px;">
    <a href="{{ route('admin.tenants') }}" style="color: var(--secondary); text-decoration: none; font-size: 0.9rem; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 10px;">
        <i class="fa-solid fa-arrow-left"></i> Back to Directory
    </a>
    <h1 style="color: var(--primary); font-weight: 800; margin: 0;">Register New Tenant</h1>
</div>

<div class="card" style="background: white; border-radius: 20px; padding: 40px; max-width: 600px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02);">
    <form action="{{ route('admin.tenants.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
        @csrf
        <div>
            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Full Name</label>
            <input type="text" name="name" required placeholder="e.g. John Doe" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem;">
        </div>

        <div>
            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Contact Number</label>
            <input type="text" name="phone" required placeholder="e.g. 0912-345-6789" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem;">
        </div>

        <div>
            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Assign Room Number</label>
            <select name="room_id" required style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; background-color: white;">
                <option value="" disabled selected>Select an available room...</option>
                <option value="101">Room 101 (Premium Solo)</option>
                <option value="102">Room 102 (Bedspace)</option>
            </select>
        </div>

        <button type="submit" class="btn-primary" style="background: var(--primary); color: white; padding: 14px; border-radius: 10px; border: none; font-weight: 700; font-size: 1rem; cursor: pointer; text-align: center; justify-content: center; margin-top: 10px;">
            <i class="fa-solid fa-user-check"></i> Complete Registration
        </button>
    </form>
</div>
@endsection