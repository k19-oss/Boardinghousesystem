@extends('layouts.admin')

@section('title', 'Admin Profile')

@section('content')
<div class="header">
    <h1 style="color: white; margin-bottom: 20px;">Admin Profile</h1>
</div>

<div class="section-card">
    <div style="display: flex; align-items: center; gap: 40px;">
        <div style="text-align: center;">
            <div style="width: 120px; height: 120px; background: #fff; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #5D4037;">
                👤
            </div>
        </div>
        
        <div style="flex: 1;">
            <h2 style="border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px; margin-bottom: 15px;">Personal Information</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label style="font-size: 0.8rem; opacity: 0.7; display: block;">FULL NAME</label>
                    <p style="font-weight: bold; font-size: 1.1rem;">{{ auth()->user()->name ?? 'Patrick Dela Cruz' }}</p>
                </div>
                <div>
                    <label style="font-size: 0.8rem; opacity: 0.7; display: block;">EMAIL ADDRESS</label>
                    <p style="font-weight: bold; font-size: 1.1rem;">{{ auth()->user()->email ?? 'admin@chmsu.edu.ph' }}</p>
                </div>
                <div>
                    <label style="font-size: 0.8rem; opacity: 0.7; display: block;">DESIGNATION</label>
                    <p style="font-weight: bold; font-size: 1.1rem;">Lead Developer / Admin</p>
                </div>
                <div>
                    <label style="font-size: 0.8rem; opacity: 0.7; display: block;">CAMPUS</label>
                    <p style="font-weight: bold; font-size: 1.1rem;">CHMSU - Binalbagan</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection