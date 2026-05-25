@extends('layouts.admin')

@section('content')

@if(session('success'))
    <div style="background-color: #efebe9; border: 1px solid #3E2723; color: #3E2723; padding: 12px 20px; border-radius: 10px; max-width: 600px; margin-bottom: 20px; font-weight: 700;">
        {{ session('success') }}
    </div>
@endif

<div style="margin-bottom: 30px;">
    <h1 style="color: #3E2723; font-weight: 800; margin: 0;">Admin Configuration</h1>
</div>

<div class="card" style="background: white; border-radius: 20px; padding: 40px; max-width: 600px; box-shadow: 0 10px 40px rgba(0,0,0,0.02);">
    
    <!-- Form wrapper added around your fields -->
    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        
        <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 10px;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: #3E2723; color: white; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700; margin-bottom: 15px;">
                A
            </div>
            <h3 style="color: #3E2723; font-weight: 800; margin: 0 0 5px 0; font-size: 1.3rem;">System Administrator</h3>
            <p style="color: #7f8c8d; font-size: 0.9rem; margin: 0;">cozyhabitat.admin@gmail.com</p>
        </div>

        <hr style="border: 0; border-top: 1px solid #f5f5f4; margin: 5px 0;">

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #3E2723; margin-bottom: 8px; text-transform: uppercase;">Update Username</label>
            <!-- Added name attribute -->
            <input type="text" name="username" value="Admin" required style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #3E2723; margin-bottom: 8px; text-transform: uppercase;">Change System Password</label>
            <!-- Changed type to "password" and added name attribute -->
            <input type="password" name="password" placeholder="••••••••••••" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; box-sizing: border-box;">
        </div>

        <!-- Button type changed to submit -->
        <button type="submit" style="width: 100%; background: #3E2723; color: #ffffff; border: none; padding: 14px; border-radius: 10px; font-weight: 700; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
            <i class="fa-solid fa-floppy-disk"></i> Save Changes
        </button>
    </form>
</div>
@endsection