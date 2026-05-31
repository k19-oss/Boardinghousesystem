@extends('layouts.admin')

@section('content')

{{-- ✅ FIX: Single auto-dismissing session alert — no double popup --}}
@if(session('success'))
    <div id="session-alert-success" style="background-color: #e8f5e9; border: 1px solid #00b894; color: #00b894; padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; font-weight: 700; display: flex; align-items: center; gap: 8px; font-size: 0.9rem; transition: opacity 0.5s ease;">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div id="session-alert-error" style="background-color: #fff5f5; border: 1px solid #ff7675; color: #ff7675; padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; font-weight: 700; font-size: 0.9rem; transition: opacity 0.5s ease;">
        <i class="fa-solid fa-circle-exclamation"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

@if($errors->any())
    <div id="session-alert-validation" style="background-color: #fff5f5; border: 1px solid #ff7675; color: #ff7675; padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; font-weight: 700; font-size: 0.9rem; transition: opacity 0.5s ease;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: #4A3629; font-weight: 800; margin: 0; font-size: 1.75rem; letter-spacing: -0.5px;">Tenant Directory</h1>
    <a href="{{ route('admin.create-tenant') }}" style="background: #4A3629; color: white; padding: 12px 24px; border-radius: 12px; border: none; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-user-plus"></i> Register Tenant
    </a>
</div>

<div class="card" style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #f5f5f4; color: #4A3629; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                <th style="padding: 15px 10px;">Tenant Name</th>
                <th style="padding: 15px 10px;">Assigned Room</th>
                <th style="padding: 15px 10px;">Contact Number</th>
                <th style="padding: 15px 10px;">Lease Status</th>
                <th style="padding: 15px 10px; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody id="tenantsTableBody">
            @forelse($tenants as $tenant)
            <tr style="border-bottom: 1px solid #f5f5f4; font-size: 0.95rem; color: #2d3436; transition: background 0.2s;"
                onmouseover="this.style.background='#faf9f9'" onmouseout="this.style.background='transparent'">
                <td style="padding: 15px 10px; font-weight: 600; color: #4A3629;">{{ $tenant->name }}</td>
                <td style="padding: 15px 10px;">
                    <span style="font-weight: 700; color: #636e72;">
                        Room {{ $tenant->room->room_number ?? ($tenant->room_number ?? 'Unassigned') }}
                    </span>
                </td>
                <td style="padding: 15px 10px; color: #636e72;">{{ $tenant->phone }}</td>
                <td style="padding: 15px 10px;">
                    <span style="padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 800;
                        background: {{ $tenant->status == 'Active' ? '#e3fcef' : '#fff5f5' }};
                        color: {{ $tenant->status == 'Active' ? '#00b894' : '#ff7675' }};">
                        {{ $tenant->status }}
                    </span>
                </td>
                <td style="padding: 15px 10px;">
                    <div style="display: flex; justify-content: center; align-items: center; gap: 15px;">
                        <a href="{{ route('admin.tenants.edit', $tenant->id) }}"
                           style="color: #4A3629; text-decoration: none; font-size: 1.1rem;" title="Edit Tenant">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.tenants.destroy', $tenant->id) }}" method="POST"
                              style="margin: 0; display: inline-block;"
                              onsubmit="return confirm('Are you sure you want to completely remove this tenant and revoke their account access?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="border: none; background: none; color: #ff7675; cursor: pointer; padding: 0; font-size: 1.1rem;"
                                    title="Delete Tenant">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr id="empty-row">
                <td colspan="5" style="text-align: center; padding: 40px; color: #a3a3a3; font-style: italic; font-size: 0.9rem;">
                    <i class="fa-solid fa-users" style="display: block; font-size: 2rem; margin-bottom: 10px; opacity: 0.2;"></i>
                    No tenants registered yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
// ✅ FIX: Auto-dismiss all session alerts
document.addEventListener('DOMContentLoaded', function () {
    const alerts = [
        { id: 'session-alert-success',    delay: 4000 },
        { id: 'session-alert-error',      delay: 6000 },
        { id: 'session-alert-validation', delay: 6000 },
    ];

    alerts.forEach(({ id, delay }) => {
        const el = document.getElementById(id);
        if (el) {
            setTimeout(() => {
                el.style.opacity = '0';
                setTimeout(() => el.style.display = 'none', 500);
            }, delay);
        }
    });

    // ✅ FIX: 3-second silent background refresh for tenant table
    // Requires a getTenants JSON endpoint — add to AdminController & routes if not present:
    //   Route::get('/tenants/data', [AdminController::class, 'getTenantsData'])->name('admin.tenants.data');
    const tenantsDataUrl = "{{ Route::has('admin.tenants.data') ? route('admin.tenants.data') : '' }}";

    if (tenantsDataUrl) {
        setInterval(function () {
            fetch(tenantsDataUrl)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('tenantsTableBody');
                    if (!tbody || !data.tenants) return;

                    if (data.tenants.length === 0) {
                        tbody.innerHTML = `
                        <tr>
                            <td colspan="5" style="text-align:center;padding:40px;color:#a3a3a3;font-style:italic;font-size:0.9rem;">
                                <i class="fa-solid fa-users" style="display:block;font-size:2rem;margin-bottom:10px;opacity:0.2;"></i>
                                No tenants registered yet.
                            </td>
                        </tr>`;
                        return;
                    }

                    let rowsHtml = '';
                    data.tenants.forEach(tenant => {
                        const statusBg    = tenant.status === 'Active' ? '#e3fcef' : '#fff5f5';
                        const statusColor = tenant.status === 'Active' ? '#00b894' : '#ff7675';
                        const roomLabel   = tenant.room_number ? `Room ${tenant.room_number}` : 'Unassigned';
                        const csrfToken   = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

                        rowsHtml += `
                        <tr style="border-bottom:1px solid #f5f5f4;font-size:0.95rem;color:#2d3436;transition:background 0.2s;"
                            onmouseover="this.style.background='#faf9f9'" onmouseout="this.style.background='transparent'">
                            <td style="padding:15px 10px;font-weight:600;color:#4A3629;">${tenant.name}</td>
                            <td style="padding:15px 10px;">
                                <span style="font-weight:700;color:#636e72;">${roomLabel}</span>
                            </td>
                            <td style="padding:15px 10px;color:#636e72;">${tenant.phone ?? 'N/A'}</td>
                            <td style="padding:15px 10px;">
                                <span style="padding:4px 10px;border-radius:20px;font-size:0.75rem;font-weight:800;background:${statusBg};color:${statusColor};">
                                    ${tenant.status}
                                </span>
                            </td>
                            <td style="padding:15px 10px;">
                                <div style="display:flex;justify-content:center;align-items:center;gap:15px;">
                                    <a href="/admin/tenants/${tenant.id}/edit" style="color:#4A3629;text-decoration:none;font-size:1.1rem;" title="Edit Tenant">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="/admin/tenants/${tenant.id}" method="POST" style="margin:0;display:inline-block;"
                                          onsubmit="return confirm('Are you sure you want to completely remove this tenant and revoke their account access?');">
                                        <input type="hidden" name="_token" value="${csrfToken}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" style="border:none;background:none;color:#ff7675;cursor:pointer;padding:0;font-size:1.1rem;" title="Delete Tenant">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>`;
                    });

                    tbody.innerHTML = rowsHtml;
                })
                .catch(err => console.error('Tenants sync heartbeat error:', err));
        }, 3000);
    }
});
</script>
@endsection
