@extends('layouts.admin')

@section('title', 'IPK Boardinghouse System - Dashboard')

@section('content')
<<<<<<< HEAD
=======
<!-- Micro-interaction Stylesheets Integration -->
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
<style>
    /* Global Base Transition Setup for Interacting Elements */
    .btn-hover-action,
    .btn-report-action,
    .metric-card-node,
<<<<<<< HEAD
=======
    .quick-action-row,
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
    .view-all-link,
    .data-table-row {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    /* 1. Header Control Buttons */
    .btn-hover-action:hover {
<<<<<<< HEAD
        background: #271815 !important;
=======
        background: #271815 !important; /* Richer deep brown shift */
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(62, 39, 35, 0.2);
    }
    .btn-hover-action:active {
        transform: translateY(0);
    }

    .btn-report-action:hover {
        background: #fcfbfb !important;
        border-color: #b5b5b5 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    .btn-report-action:active {
        transform: translateY(0);
    }

    /* 2. Overview Metric Cards */
    .metric-card-node:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.08) !important;
    }

    /* 3. Text Anchor Controls */
    .view-all-link:hover {
<<<<<<< HEAD
        color: #78350f !important;
=======
        color: #78350f !important; /* Slightly deeper gold */
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
        text-decoration: underline !important;
    }

    /* 4. Tabular Data Records Rows */
    .data-table-row:hover {
        background-color: #faf9f9 !important;
    }

<<<<<<< HEAD
    /* Custom Scrollbar for the System Containers */
    .custom-scroll-area::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scroll-area::-webkit-scrollbar-track {
        background: #f5f5f4;
        border-radius: 10px;
    }
    .custom-scroll-area::-webkit-scrollbar-thumb {
        background: #d6d3d1;
        border-radius: 10px;
    }
    .custom-scroll-area::-webkit-scrollbar-thumb:hover {
        background: #a8a29e;
    }
</style>

{{-- Persistent AJAX Toast Response Target Banner --}}
<div id="ajax-status-alert-container" style="display: none; transition: all 0.3s ease;"></div>

=======
    /* 5. Right Column Action Links */
    .quick-action-row:hover {
        background: rgba(255, 255, 255, 0.15) !important;
        border-color: rgba(255, 255, 255, 0.3) !important;
        padding-left: 16px !important; /* Smooth internal text nudge */
    }
</style>

>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
@if(session('success'))
    <div style="background-color: #e8f5e9; border: 1px solid #a3e635; color: #2ecc71; padding: 14px 20px; border-radius: 12px; margin-bottom: 25px; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div>
        <h1 style="color: #3E2723; font-weight: 800; letter-spacing: -1px; margin: 0;">IPK Boardinghouse System</h1>
        <p style="color: #636e72; font-size: 0.9rem; margin: 5px 0 0 0;">Welcome back, Admin. Here is what's happening today.</p>
    </div>
    <div style="display: flex; gap: 12px;">
<<<<<<< HEAD
        <a href="{{ Route::has('admin.create-tenant') ? route('admin.create-tenant') : '#' }}" class="btn-hover-action" style="background: #3E2723; color: #ffffff; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <i class="fa-solid fa-user-plus"></i> New Tenant
        </a>
        
        <a href="#" onclick="executeQuickAction(event, '{{ Route::has('admin.generateInvoice') ? route('admin.generateInvoice') : '#' }}', 'Room Invoices generated and reports compiled successfully.')" class="btn-report-action" style="background: #ffffff; color: #3E2723; border: 1px solid #e0e0e0; padding: 10px 18px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; text-decoration: none;">
            <i class="fa-solid fa-file-invoice"></i> Reports / Invoice
        </a>
=======
        <a href="{{ route('admin.create-tenant') }}" class="btn-hover-action" style="background: #3E2723; color: #ffffff; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <i class="fa-solid fa-user-plus"></i> New Tenant
        </a>
        <button class="btn-report-action" style="background: #ffffff; color: #3E2723; border: 1px solid #e0e0e0; padding: 10px 18px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
            <i class="fa-solid fa-download"></i> Reports
        </button>
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
    <div class="card metric-card-node" style="background: #ffffff; padding: 20px; border-radius: 16px; border-left: 5px solid #5d4037; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="color: #8c8c8c; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin: 0; letter-spacing: 0.5px;">Total Revenue</p>
                <h2 id="total-revenue-count" style="font-size: 1.6rem; font-weight: 800; color: #2d2d2d; margin: 5px 0 0 0;">{{ data_get($stats ?? [], 'total_due') ?? '₱0.00' }}</h2>
            </div>
            <div style="background: #efebe9; color: #5d4037; padding: 10px; border-radius: 10px; font-size: 1.1rem;"><i class="fa-solid fa-wallet"></i></div>
        </div>
    </div>
    
    <div class="card metric-card-node" style="background: #ffffff; padding: 20px; border-radius: 16px; border-left: 5px solid #2ecc71; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="color: #8c8c8c; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin: 0; letter-spacing: 0.5px;">Collected</p>
                <h2 id="collected-count" style="font-size: 1.6rem; font-weight: 800; color: #2ecc71; margin: 5px 0 0 0;">{{ data_get($stats ?? [], 'collected') ?? '₱0.00' }}</h2>
            </div>
            <div style="background: #e8f5e9; color: #2ecc71; padding: 10px; border-radius: 10px; font-size: 1.1rem;"><i class="fa-solid fa-circle-check"></i></div>
        </div>
    </div>

    <div class="card metric-card-node" style="background: #ffffff; padding: 20px; border-radius: 16px; border-left: 5px solid #e17055; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="color: #8c8c8c; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin: 0; letter-spacing: 0.5px;">Pending</p>
                <h2 id="pending-count" style="font-size: 1.6rem; font-weight: 800; color: #e17055; margin: 5px 0 0 0;">{{ data_get($stats ?? [], 'pending') ?? '₱0.00' }}</h2>
            </div>
            <div style="background: #fff3e0; color: #e17055; padding: 10px; border-radius: 10px; font-size: 1.1rem;"><i class="fa-solid fa-clock-rotate-left"></i></div>
        </div>
    </div>

    <div class="card metric-card-node" style="background: #ffffff; padding: 20px; border-radius: 16px; border-left: 5px solid #8d6e63; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="color: #8c8c8c; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin: 0; letter-spacing: 0.5px;">Occupancy</p>
                <h2 id="occupancy-count" style="font-size: 1.6rem; font-weight: 800; color: #2d2d2d; margin: 5px 0 0 0;">{{ data_get($stats ?? [], 'occupancy') ?? '0%' }}</h2>
            </div>
            <div style="background: #f5f5f4; color: #8d6e63; padding: 10px; border-radius: 10px; font-size: 1.1rem;"><i class="fa-solid fa-bed"></i></div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px; align-items: start;">
    
    {{-- ================= LEFT COLUMN: STACKED RECENT ACTIVITIES ================= --}}
    <div class="card" style="background: #ffffff; padding: 24px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="color: #3E2723; font-size: 1.1rem; font-weight: 700; margin: 0;"><i class="fa-solid fa-list-ul" style="margin-right: 8px; color: #8d6e63;"></i> Recent Activities</h3>
<<<<<<< HEAD
        </div>
        
        {{-- MATCHING SCROLL WRAPPER & STACKED LAYOUT (380px) --}}
        <div id="admin-activities-container" class="custom-scroll-area" style="display: flex; flex-direction: column; gap: 12px; max-height: 380px; overflow-y: auto; scroll-behavior: smooth; padding-right: 6px;">
            @forelse($upcomingDues ?? [] as $due)
                <div class="data-table-row" style="display: flex; justify-content: space-between; align-items: center; padding: 14px; border: 1px solid #f5f5f4; border-radius: 12px; background: #ffffff;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 36px; height: 36px; border-radius: 50%; background: #efebe9; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; color: #3E2723; font-weight: 600;">👤</div>
                        <div>
                            <div style="font-weight: 700; font-size: 0.9rem; color: #2d2d2d;">
                                {{ data_get($due, 'tenant.name') ?? data_get($due, 'tenant_name') ?? 'Active Account' }}
                            </div>
                            <div style="font-size: 0.75rem; color: #78716c; margin-top: 2px;">
                                {{ data_get($due, 'room') ?? data_get($due, 'room_number') ?? 'N/A' }} • {{ \Carbon\Carbon::parse(data_get($due, 'date'))->format('M d, Y') }}
=======
            <a href="#" class="view-all-link" style="font-size: 0.8rem; color: #b45309; text-decoration: none; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">View All</a>
        </div>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; color: #a3a3a3; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px; border-bottom: 1px solid #f5f5f4;">
                    <th style="padding: 12px;">TENANT / ROOM</th>
                    <th style="padding: 12px;">DATE</th>
                    <th style="padding: 12px;">AMOUNT</th>
                    <th style="padding: 12px; text-align: right;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcomingDues as $due)
                <tr class="data-table-row" style="border-bottom: 1px solid #fafaf9;">
                    <td style="padding: 14px 12px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 36px; height: 36px; border-radius: 50%; background: #efebe9; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; color: #3E2723; font-weight: 600;">👤</div>
                            <div>
                                <div style="font-weight: 700; font-size: 0.9rem; color: #2d2d2d;">Active Account</div>
                                <div style="font-size: 0.75rem; color: #78716c; margin-top: 2px;">{{ $due['room'] }}</div>
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 6px;">
                        <div style="font-weight: 700; color: #2d2d2d; font-size: 0.9rem;">₱{{ number_format(data_get($due, 'amount', 0), 2) }}</div>
                        <span style="padding: 4px 10px; border-radius: 20px; font-size: 0.65rem; font-weight: 800; letter-spacing: 0.3px; display: inline-block;
                            @if(ucfirst(strtolower(data_get($due, 'status'))) == 'Paid')
                                background: #e3fcef; color: #00b894; border: 1px solid #a3e635;
                            @elseif(ucfirst(strtolower(data_get($due, 'status'))) == 'Pending')
                                background: #fffbeb; color: #d97706; border: 1px solid #fde68a;
                            @else
                                background: #fff5f5; color: #ff7675; border: 1px solid #fca5a5;
                            @endif">
                            {{ strtoupper(data_get($due, 'status') ?? 'PENDING') }}
                        </span>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 20px; color: #a3a3a3; font-size: 0.9rem; border: 1px dashed #e0e0e0; border-radius: 12px;">
                    No recent activities found.
                </div>
            @endforelse
        </div>
    </div>

    {{-- ================= RIGHT COLUMN: SYSTEM ALERTS ================= --}}
    <div style="display: flex; flex-direction: column; gap: 25px;">
<<<<<<< HEAD
=======
        <div class="card" style="background: #3E2723; color: #ffffff; padding: 24px; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(62, 39, 35, 0.15);">
            <h4 style="margin: 0 0 15px 0; font-size: 1rem; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;"><i class="fa-solid fa-bolt" style="color: #fbbf24; margin-right: 6px;"></i> Quick Actions</h4>
            <div style="display: grid; gap: 10px;">
                <a href="{{ route('admin.sendReminder') }}" class="quick-action-row" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: #f5f5f4; padding: 12px; border-radius: 10px; text-decoration: none; font-size: 0.85rem; font-weight: 500; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-envelope" style="color: #fbbf24;"></i> Send Payment Reminder
                </a>
                <a href="{{ route('admin.generateInvoice') }}" class="quick-action-row" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: #f5f5f4; padding: 12px; border-radius: 10px; text-decoration: none; font-size: 0.85rem; font-weight: 500; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-print" style="color: #fbbf24;"></i> Generate Room Invoice
                </a>
            </div>
        </div>
        
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
        <div class="card" style="background: #ffffff; padding: 24px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f5f5f4;">
            <h4 style="margin: 0 0 15px 0; color: #3E2723; font-size: 1rem; font-weight: 700;"><i class="fa-solid fa-bullhorn" style="color: #8d6e63; margin-right: 6px;"></i> System Alerts</h4>
            
            {{-- MATCHING SCROLL WRAPPER (380px) --}}
            <div id="admin-alerts-container" class="custom-scroll-area" style="display: flex; flex-direction: column; gap: 14px; max-height: 380px; overflow-y: auto; scroll-behavior: smooth; padding-right: 6px;">
                @forelse($systemAlerts ?? [] as $alert)
                    <div style="display: flex; flex-direction: column; gap: 4px; border-left: 3px solid #ff7675; padding-left: 12px; font-size: 0.8rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                            <span style="font-weight: 800; text-transform: uppercase; color: #c0392b; font-size: 0.7rem; background: #fdf2f2; padding: 2px 6px; border-radius: 4px;">
                                {{ $alert->category }}
                            </span>
                            <span style="font-size: 10px; color: #a3a3a3;">{{ $alert->created_at->diffForHumans() }}</span>
                        </div>
                        <div style="color: #57534e; line-height: 1.4; font-style: italic;">
                            "{!! Str::limit($alert->description, 65) !!}"
                        </div>
                        <div style="font-size: 10px; color: #78716c;">
                            Submitted by <span style="font-weight: 600;">{{ $alert->tenant->name ?? 'Resident #' . $alert->tenant_id }}</span>
                        </div>
                    </div>
                @empty
                    <div style="display: flex; gap: 10px; font-size: 0.8rem; border-left: 3px solid #00b894; padding-left: 12px;">
                        <div style="color: #27ae60; line-height: 1.4; font-weight: 600;">
                            ✅ All resident profiles and accounts are currently in full operational compliance.
                        </div>
                    </div>
                @endforelse
            </div>

            <div style="margin-top: 15px; padding-top: 12px; border-top: 1px dashed #efebe9; font-size: 0.75rem; color: #78716c; display: flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-circle-info" style="color: #8d6e63;"></i>
                <span>Audio chimes and sound channels can be configured directly in your <a href="{{ Route::has('admin.profile') ? route('admin.profile') : '#' }}" style="color: #3E2723; font-weight: 700; text-decoration: underline;">Admin Profile</a>.</span>
            </div>
        </div>
    </div>
</div>

<script>
    window.AdminPreferences = {
        alert_payments: true, 
        alert_maintenance: true 
    };

    let systemAudioCtx = null;
    let audioUnlocked = false;

    // 1. THE AUDIO UNLOCKER
    document.addEventListener('click', function() {
        if (audioUnlocked) return; 
        try {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            systemAudioCtx = new AudioContext();
            
            let osc = systemAudioCtx.createOscillator();
            let gain = systemAudioCtx.createGain();
            gain.gain.value = 0; 
            osc.connect(gain);
            gain.connect(systemAudioCtx.destination);
            osc.start(0);
            osc.stop(systemAudioCtx.currentTime + 0.1);
            
            audioUnlocked = true;
            console.log("🔓 Browser audio engine unlocked successfully.");
        } catch (e) {
            console.warn("Could not unlock audio engine.", e);
        }
    }, { once: true });

    // System synthesized audio engine
    function playAlertNotificationChime() {
        if (!window.AdminPreferences.alert_maintenance) return;
        
        if (!audioUnlocked || !systemAudioCtx) {
            console.log("🔈 Audio blocked: Waiting for user to click anywhere on the page first.");
            return;
        }

        try {
            if (systemAudioCtx.state === 'suspended') {
                systemAudioCtx.resume();
            }
            
            let osc1 = systemAudioCtx.createOscillator();
            let gain1 = systemAudioCtx.createGain();
            osc1.type = 'sine';
            osc1.frequency.setValueAtTime(523.25, systemAudioCtx.currentTime); 
            gain1.gain.setValueAtTime(0.15, systemAudioCtx.currentTime);
            gain1.gain.exponentialRampToValueAtTime(0.01, systemAudioCtx.currentTime + 0.15);
            osc1.connect(gain1);
            gain1.connect(systemAudioCtx.destination);
            osc1.start();
            osc1.stop(systemAudioCtx.currentTime + 0.15);

            setTimeout(() => {
                let osc2 = systemAudioCtx.createOscillator();
                let gain2 = systemAudioCtx.createGain();
                osc2.type = 'sine';
                osc2.frequency.setValueAtTime(659.25, systemAudioCtx.currentTime); 
                gain2.gain.setValueAtTime(0.15, systemAudioCtx.currentTime);
                gain2.gain.exponentialRampToValueAtTime(0.01, systemAudioCtx.currentTime + 0.2);
                osc2.connect(gain2);
                gain2.connect(systemAudioCtx.destination);
                osc2.start();
                osc2.stop(systemAudioCtx.currentTime + 0.2);
            }, 100);
        } catch (e) {
            console.log("Audio contextual workspace execution restricted.", e);
        }
    }

    // AJAX Action interceptor
    window.executeQuickAction = function(event, endpointUrl, absoluteSuccessMessage) {
        event.preventDefault();
        if (endpointUrl === '#' || endpointUrl === '') {
            console.warn('Action route not created in web.php yet. Simulation mode active.');
            return;
        }
        
        fetch(endpointUrl, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            const statusTarget = document.getElementById('ajax-status-alert-container');
            statusTarget.style.display = 'flex';
            statusTarget.style.backgroundColor = '#e8f5e9';
            statusTarget.style.border = '1px solid #a3e635';
            statusTarget.style.color = '#2ecc71';
            statusTarget.style.padding = '14px 20px';
            statusTarget.style.borderRadius = '12px';
            statusTarget.style.marginBottom = '25px';
            statusTarget.style.fontWeight = '700';
            statusTarget.style.fontSize = '0.9rem';
            statusTarget.style.alignItems = 'center';
            statusTarget.style.gap = '10px';
            statusTarget.innerHTML = `<i class="fa-solid fa-circle-check"></i> <span>${absoluteSuccessMessage}</span>`;
            setTimeout(() => { statusTarget.style.display = 'none'; }, 4000);
        })
        .catch(error => console.warn('Quick action connection handshake interrupted:', error));
    };

    // System Alert Notification Builder
    function triggerToastNotification(category, description) {
        if (!window.AdminPreferences.alert_maintenance) return;

        playAlertNotificationChime();

        const toast = document.createElement('div');
        toast.style.position = 'fixed';
        toast.style.top = '25px';
        toast.style.right = '25px';
        toast.style.zIndex = '999999';
        toast.style.background = '#ffffff';
        toast.style.borderLeft = '6px solid #ff7675';
        toast.style.boxShadow = '0 10px 30px rgba(0,0,0,0.15)';
        toast.style.padding = '16px 20px';
        toast.style.borderRadius = '12px';
        toast.style.display = 'flex';
        toast.style.alignItems = 'start';
        toast.style.gap = '14px';
        toast.style.width = '340px';
        toast.style.transition = 'all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        toast.style.transform = 'translateX(130%)';

        toast.innerHTML = `
            <div style="background: #fdf2f2; color: #c0392b; padding: 8px 10px; border-radius: 8px; font-size: 1.1rem; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div style="flex-grow: 1; font-family: inherit;">
                <strong style="display: block; font-size: 0.85rem; color: #c0392b; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 800;">New System Alert</strong>
                <span style="display: block; font-size: 0.75rem; color: #8c8c8c; font-weight: 700; margin-top: 2px; text-transform: uppercase;">${category}</span>
                <span style="display: block; font-size: 0.8rem; color: #57534e; margin-top: 4px; font-style: italic; line-height: 1.3;">"${description}"</span>
            </div>
            <button onclick="this.parentElement.remove()" style="background: none; border: none; color: #b5b5b5; cursor: pointer; font-size: 0.9rem; padding: 0; margin-top: 2px;">
                <i class="fa-solid fa-xmark"></i>
            </button>
        `;

        document.body.appendChild(toast);
        setTimeout(() => { toast.style.transform = 'translateX(0)'; }, 100);
        setTimeout(() => {
            toast.style.transform = 'translateX(130%)';
            setTimeout(() => toast.remove(), 400);
        }, 7000);
    }

    // Payment Status Notification Builder
    function triggerPaymentToastNotification(tenantName, amount, status) {
        if (!window.AdminPreferences.alert_payments) return;

        playAlertNotificationChime();

        const toast = document.createElement('div');
        toast.style.position = 'fixed';
        toast.style.top = '25px';
        toast.style.right = '25px';
        toast.style.zIndex = '999999';
        toast.style.background = '#ffffff';
        toast.style.borderLeft = '6px solid #2ecc71';
        toast.style.boxShadow = '0 10px 30px rgba(0,0,0,0.15)';
        toast.style.padding = '16px 20px';
        toast.style.borderRadius = '12px';
        toast.style.display = 'flex';
        toast.style.alignItems = 'start';
        toast.style.gap = '14px';
        toast.style.width = '340px';
        toast.style.transition = 'all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        toast.style.transform = 'translateX(130%)';

        toast.innerHTML = `
            <div style="background: #e8f5e9; color: #2ecc71; padding: 8px 10px; border-radius: 8px; font-size: 1.1rem; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div style="flex-grow: 1; font-family: inherit;">
                <strong style="display: block; font-size: 0.85rem; color: #2ecc71; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 800;">Payment State Updated</strong>
                <span style="display: block; font-size: 0.8rem; color: #57534e; margin-top: 4px; line-height: 1.3;">
                    Account transaction for <strong>${tenantName}</strong> of <strong>${amount}</strong> was logged as <span style="font-weight:700;">${status}</span>.
                </span>
            </div>
            <button onclick="this.parentElement.remove()" style="background: none; border: none; color: #b5b5b5; cursor: pointer; font-size: 0.9rem; padding: 0; margin-top: 2px;">
                <i class="fa-solid fa-xmark"></i>
            </button>
        `;

        document.body.appendChild(toast);
        setTimeout(() => { toast.style.transform = 'translateX(0)'; }, 100);
        setTimeout(() => {
            toast.style.transform = 'translateX(130%)';
            setTimeout(() => toast.remove(), 400);
        }, 7000);
    }

    // Main Polling Engine
    document.addEventListener("DOMContentLoaded", function () {
        let lastKnownAlertsJson = null; 
        let lastKnownActivityJson = null;
        
        const apiEndpoint = "{{ Route::has('admin.api.data') ? route('admin.api.data') : '' }}";

        // FAST 3-SECOND POLLING
        setInterval(function () {
            if (!apiEndpoint) return; 

            fetch(apiEndpoint, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Admin background connection issue');
                return response.json();
            })
            .then(data => {
                
                // PHASE 1: EVALUATE NEW ALERTS & RE-RENDER LIST
                if (data && Array.isArray(data.alerts)) {
                    const currentAlertsJson = JSON.stringify(data.alerts);
                    
                    if (lastKnownAlertsJson !== currentAlertsJson) {
                        if (lastKnownAlertsJson !== null) {
                            try {
                                const oldAlerts = JSON.parse(lastKnownAlertsJson);
                                const topNewAlert = data.alerts[0];
                                const topOldAlert = oldAlerts[0];

                                if (topNewAlert && (!topOldAlert || topNewAlert.id !== topOldAlert.id || topNewAlert.description !== topOldAlert.description)) {
                                    triggerToastNotification(topNewAlert.category || 'System Alert', topNewAlert.description || '');
                                }
                            } catch(err) {
                                console.error("Alert differential check failed:", err);
                            }
                        }

                        const alertsContainer = document.getElementById('admin-alerts-container');
                        if (alertsContainer) {
                            if (data.alerts.length === 0) {
                                alertsContainer.innerHTML = `
                                    <div style="display: flex; gap: 10px; font-size: 0.8rem; border-left: 3px solid #00b894; padding-left: 12px;">
                                        <div style="color: #27ae60; line-height: 1.4; font-weight: 600;">
                                            ✅ All resident profiles and accounts are currently in full operational compliance.
                                        </div>
                                    </div>`;
                            } else {
                                let alertsHtml = '';
                                data.alerts.forEach(alert => {
                                    alertsHtml += `
                                        <div style="display: flex; flex-direction: column; gap: 4px; border-left: 3px solid #ff7675; padding-left: 12px; font-size: 0.8rem; margin-bottom: 12px;">
                                            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                                <span style="font-weight: 800; text-transform: uppercase; color: #c0392b; font-size: 0.7rem; background: #fdf2f2; padding: 2px 6px; border-radius: 4px;">
                                                    ${alert.category || 'ALERT'}
                                                </span>
                                                <span style="font-size: 10px; color: #a3a3a3;">${alert.time_ago || alert.created_at || ''}</span>
                                            </div>
                                            <div style="color: #57534e; line-height: 1.4; font-style: italic;">
                                                "${alert.description || ''}"
                                            </div>
                                            <div style="font-size: 10px; color: #78716c;">
                                                Submitted by <span style="font-weight: 600;">${alert.tenant_name || 'N/A'}</span>
                                            </div>
                                        </div>`;
                                });
                                alertsContainer.innerHTML = alertsHtml;
                            }
                        }
                    }
                    lastKnownAlertsJson = currentAlertsJson;
                }

                // PHASE 2: EVALUATE PAYMENT UPDATES & RE-RENDER LEDGER STACK
                if (data && Array.isArray(data.upcomingDues)) {
                    const currentActivityJson = JSON.stringify(data.upcomingDues);
                    
                    if (lastKnownActivityJson !== currentActivityJson) {
                        if (lastKnownActivityJson !== null) {
                            try {
                                const oldActivities = JSON.parse(lastKnownActivityJson);
                                const topNewActivity = data.upcomingDues[0];
                                const topOldActivity = oldActivities[0];

                                if (topNewActivity && (!topOldActivity || topNewActivity.id !== topOldActivity.id || topNewActivity.status !== topOldActivity.status)) {
                                    triggerPaymentToastNotification(
                                        topNewActivity.tenant_name || 'Resident Account',
                                        topNewActivity.amount || '₱0.00',
                                        topNewActivity.status || 'Pending'
                                    );
                                }
                            } catch(err) {
                                console.error("Ledger differential check failed:", err);
                            }
                        }

                        const activitiesContainer = document.getElementById('admin-activities-container');
                        if (activitiesContainer) {
                            let activitiesHtml = '';
                            if (data.upcomingDues.length === 0) {
                                activitiesContainer.innerHTML = `<div style="text-align: center; padding: 20px; color: #a3a3a3; font-size: 0.9rem; border: 1px dashed #e0e0e0; border-radius: 12px;">No recent activities found.</div>`;
                            } else {
                                data.upcomingDues.forEach(due => {
                                    let badgeStyles = '';
                                    const statusRaw = due.status ? String(due.status).trim() : 'Pending';
                                    const normalizedStatus = statusRaw.toUpperCase();
                                    
                                    if (normalizedStatus === 'PAID') {
                                        badgeStyles = 'background: #e3fcef; color: #00b894; border: 1px solid #a3e635;';
                                    } else if (normalizedStatus === 'PENDING') {
                                        badgeStyles = 'background: #fffbeb; color: #d97706; border: 1px solid #fde68a;';
                                    } else {
                                        badgeStyles = 'background: #fff5f5; color: #ff7675; border: 1px solid #fca5a5;';
                                    }

                                    const tenantDisplayName = due.tenant_name || (due.tenant && due.tenant.name) || 'Active Account';
                                    const roomDisplayName = due.room || due.room_number || 'N/A';
                                    const dateVal = due.date || '';
                                    const amountVal = due.amount || '₱0.00';

                                    activitiesHtml += `
                                        <div class="data-table-row" style="display: flex; justify-content: space-between; align-items: center; padding: 14px; border: 1px solid #f5f5f4; border-radius: 12px; background: #ffffff;">
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div style="width: 36px; height: 36px; border-radius: 50%; background: #efebe9; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; color: #3E2723; font-weight: 600;">👤</div>
                                                <div>
                                                    <div style="font-weight: 700; font-size: 0.9rem; color: #2d2d2d;">${tenantDisplayName}</div>
                                                    <div style="font-size: 0.75rem; color: #78716c; margin-top: 2px;">${roomDisplayName} • ${dateVal}</div>
                                                </div>
                                            </div>
                                            <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 6px;">
                                                <div style="font-weight: 700; color: #2d2d2d; font-size: 0.9rem;">${amountVal}</div>
                                                <span style="padding: 4px 10px; border-radius: 20px; font-size: 0.65rem; font-weight: 800; letter-spacing: 0.3px; display: inline-block; ${badgeStyles}">
                                                    ${statusRaw.toUpperCase()}
                                                </span>
                                            </div>
                                        </div>`;
                                });
                                activitiesContainer.innerHTML = activitiesHtml;
                            }
                        }
                    }
                    lastKnownActivityJson = currentActivityJson;
                }

                // PHASE 3: RE-WRITE CARDS METRICS
                if (data && data.stats) {
                    const revenueEl = document.getElementById('total-revenue-count');
                    if (revenueEl) revenueEl.innerText = data.stats.total_due || '₱0.00';
                    const collectedEl = document.getElementById('collected-count');
                    if (collectedEl) collectedEl.innerText = data.stats.collected || '₱0.00';
                    const pendingEl = document.getElementById('pending-count');
                    if (pendingEl) pendingEl.innerText = data.stats.pending || '₱0.00';
                    const occupancyEl = document.getElementById('occupancy-count');
                    if (occupancyEl) occupancyEl.innerText = data.stats.occupancy || '0%';
                }
            })
            .catch(error => console.warn('Sync trace skipped or failed backend format verification:', error));
        }, 3000);
    });
</script>
@endsection