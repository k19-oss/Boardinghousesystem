@extends('layouts.admin')

@section('content')
<div style="margin-bottom: 30px;">
    <h1 style="color: var(--primary); font-weight: 800; margin: 0;">Admin Configuration</h1>
</div>

<div class="card" style="background: white; border-radius: 20px; padding: 40px; max-width: 600px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02);">
    <div style="text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #f5f5f4;">
        <div style="width: 80px; height: 80px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 15px auto; font-weight: 700;">
            A
        </div>
        <h2 style="color: var(--primary); margin: 0; font-weight: 800;">System Administrator</h2>
        <p style="color: var(--secondary); margin: 5px 0 0 0; font-size: 0.9rem;">cozyhabitat.admin@gmail.com</p>
    </div>

    <form style="display: flex; flex-direction: column; gap: 20px;">
        <div>
            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Update Username</label>
            <input type="text" value="Admin" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem;">
        </div>

        <div>
            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase;">Change System Password</label>
            <input type="password" placeholder="••••••••••••" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #dcdde1; font-family: inherit; font-size: 0.95rem;">
        </div>

        <button type="button" class="btn-primary" style="background: var(--primary); color: white; padding: 14px; border-radius: 10px; border: none; font-weight: 700; font-size: 1rem; cursor: pointer; text-align: center; justify-content: center;">
            <i class="fa-solid fa-floppy-disk"></i> Save Changes
        </button>
    </form>
</div>
@endsection