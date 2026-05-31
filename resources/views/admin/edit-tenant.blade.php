@extends('layouts.admin')

@section('content')
<div style="margin-bottom: 30px;">
    <a href="{{ route('admin.tenants') }}" style="color: var(--secondary); text-decoration: none; font-size: 0.9rem; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 10px;">
        <i class="fa-solid fa-arrow-left"></i> Back to Directory
    </a>
    <h1 style="color: var(--primary); font-weight: 800; margin: 0;">Edit Tenant</h1>
</div>

@if ($errors->any())
    <div style="background-color: #fff5f5; border: 1px solid #ff7675; color: #ff7675; padding: 15px; border-radius: 10px; max-width: 600px; margin-bottom: 20px; font-weight: 600; font-size: 0.9rem; box-sizing: border-box;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card" style="background: white; border-radius: 20px; padding: 40px; max-width: 600px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); box-sizing: border-box;">
    <form action="{{ route('admin.tenants.update', $tenant->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
        @csrf
        @method('PUT')

        {{-- PROFILE DATA --}}
        <div>
            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $tenant->name) }}" required placeholder="e.g. John Doe"
                style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Contact Number</label>
            <input type="text" name="phone" value="{{ old('phone', $tenant->phone) }}" required placeholder="e.g. 0912-345-6789"
                style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Assign Room Number</label>
            <select name="room_id" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; background-color: white; box-sizing: border-box;">
                <option value="">Leave Unassigned / Select Later...</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('room_id', $tenant->room_id) == $room->id ? 'selected' : '' }}>
                        Room {{ $room->room_number }} (₱{{ number_format($room->price, 2) }}/mo)
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Lease Status</label>
            <select name="status" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; background-color: white; box-sizing: border-box;">
                <option value="Active"   {{ old('status', $tenant->status) == 'Active'   ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ old('status', $tenant->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        {{-- ACCOUNT LOGIN SECTION --}}
        <div style="border-top: 2px solid #f5f5f4; padding-top: 15px; margin-top: 5px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Portal Login Email</label>
            <input type="email" name="email" value="{{ old('email', $tenant->user->email ?? '') }}" required placeholder="tenant@email.com"
                style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; box-sizing: border-box;">
            <small style="color: #636e72; font-size: 0.8rem; margin-top: 4px; display: block;">This is their unique username for logging into the system.</small>
        </div>

        <div>
            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">New Password <span style="color:#a3a3a3;font-weight:500;text-transform:none;">(leave blank to keep current)</span></label>
            <input type="password" name="password" placeholder="Leave blank to keep existing password"
                style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; box-sizing: border-box;">
        </div>

        <div style="display: flex; gap: 12px; margin-top: 10px;">
            <a href="{{ route('admin.tenants') }}"
               style="flex: 1; background: #f1f2f6; color: #2f3542; padding: 14px; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none;">
                Cancel
            </a>
            <button type="submit" class="btn-primary"
                style="flex: 2; background: var(--primary); color: white; padding: 14px; border-radius: 10px; border: none; font-weight: 700; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                <i class="fa-solid fa-floppy-disk"></i> Save Changes
            </button>
        </div>
    </form>
</div>
@endsection