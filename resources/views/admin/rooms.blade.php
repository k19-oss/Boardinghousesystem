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
    <h1 style="color: var(--primary); font-weight: 800; margin: 0;">Room Management</h1>
    <button onclick="toggleRoomModal(true)" class="btn-primary" style="background: var(--primary); color: white; padding: 12px 24px; border-radius: 12px; border: none; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-door-open"></i> Add New Room
    </button>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 25px;">
    @foreach($rooms as $room)
    <div class="card" style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); text-align: center; position: relative;">
        <h3 style="margin: 0 0 10px 0; color: var(--primary); font-size: 1.3rem; font-weight: 800;">Room {{ $room->room_number }}</h3>
        
        <p style="margin: 0 0 15px 0; font-size: 0.85rem; font-weight: 700; 
            color: {{ $room->status == 'Available' ? '#00b894' : '#ff7675' }};">
            {{ $room->status }}
        </p>
        
        <p style="margin: 0 0 20px 0; color: var(--secondary); font-weight: 700; font-size: 0.95rem;">
            ₱{{ number_format($room->price) }} / month
        </p>
        
        <button style="border: none; background: none; color: var(--secondary); cursor: pointer; font-size: 1rem;">
            <i class="fa-solid fa-pen-to-square"></i>
        </button>
    </div>
    @endforeach
</div>

<div id="addRoomModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); z-index: 9999; align-items: center; justify-content: center;">
    <div class="card" style="background: white; border-radius: 20px; padding: 35px; width: 100%; max-width: 450px; box-shadow: 0 20px 50px rgba(0,0,0,0.15); border: 1px solid rgba(0,0,0,0.05); position: relative; margin: 20px;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h2 style="color: var(--primary); font-weight: 800; margin: 0; font-size: 1.4rem;">Add New Room Entry</h2>
            <button onclick="toggleRoomModal(false)" style="background: none; border: none; color: #636e72; font-size: 1.2rem; cursor: pointer;">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('admin.rooms.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Room Number / Name</label>
                <input type="text" name="room_number" required placeholder="e.g. 104 or Room 302" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Monthly Rental Rate (₱)</label>
                <input type="number" name="price" required placeholder="e.g. 3500" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem; box-sizing: border-box;">
            </div>

            <div style="display: flex; gap: 12px; margin-top: 10px;">
                <button type="button" onclick="toggleRoomModal(false)" style="flex: 1; background: #f1f2f6; color: #2f3542; padding: 12px; border-radius: 10px; border: none; font-weight: 700; font-size: 0.95rem; cursor: pointer;">
                    Cancel
                </button>
                <button type="submit" class="btn-primary" style="flex: 1; background: var(--primary); color: white; padding: 12px; border-radius: 10px; border: none; font-weight: 700; font-size: 0.95rem; cursor: pointer;">
                    Save Room
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleRoomModal(show) {
    const modal = document.getElementById('addRoomModal');
    if (show) {
        modal.style.display = 'flex';
    } else {
        modal.style.display = 'none';
    }
}
</script>
@endsection