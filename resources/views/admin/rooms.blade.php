@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: var(--primary);">Room Management</h1>
    <button class="btn-primary"><i class="fa-solid fa-door-open"></i> Add New Room</button>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
    @foreach(['101', '102', '103', '201', '202', '203'] as $roomNum)
    <div class="card" style="text-align: center; border-top: 5px solid {{ $loop->index % 3 == 0 ? '#ff7675' : '#00b894' }};">
        <h2 style="color: var(--primary);">Room {{ $roomNum }}</h2>
        <p style="margin: 10px 0; color: #636e72;">{{ $loop->index % 3 == 0 ? 'Occupied' : 'Vacant' }}</p>
        <span style="font-size: 0.8rem; font-weight: bold; color: var(--secondary);">₱3,500 / month</span>
        <div style="margin-top: 15px;">
            <button style="border: none; background: none; color: var(--primary); cursor: pointer;"><i class="fa-solid fa-pen-to-square"></i></button>
        </div>
    </div>
    @endforeach
</div>
@endsection