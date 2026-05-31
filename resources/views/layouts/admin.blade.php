<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IPK Boardinghouse System - @yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #3E2723;
            --secondary: #5D4037;
            --accent: #E91E63;
            --custom-gold: #d97706;
            --bg-body: #F5F5F4;
            --card-bg: #ffffff;
            --sidebar-width: 260px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --success: #10b981;
            --error: #ef4444;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background-color: var(--bg-body);
            display: flex;
            min-height: 100vh;
            color: #2d3436;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--primary);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: sticky;
            top: 0;
            z-index: 100;
            flex-shrink: 0;
        }

        .logo-section {
            padding: 28px 24px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            background: var(--custom-gold);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: white;
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #ffffff;
            line-height: 1.2;
        }

        .logo-sub {
            font-size: 0.65rem;
            color: rgba(255,255,255,0.4);
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .nav-container {
            flex-grow: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-container::-webkit-scrollbar { width: 0; }

        .nav-label {
            padding: 16px 12px 6px;
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255,255,255,0.25);
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 2px;
            font-weight: 500;
            font-size: 0.88rem;
            transition: var(--transition);
            width: 100%;
            border: none;
            background: transparent;
            cursor: pointer;
            text-align: left;
        }

        .nav-item i {
            font-size: 0.95rem;
            width: 18px;
            text-align: center;
            flex-shrink: 0;
        }

        .nav-item:hover {
            color: #ffffff;
            background: rgba(255,255,255,0.07);
        }

        .nav-item.active {
            background: var(--custom-gold);
            color: #ffffff;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(217,119,6,0.3);
        }

        .nav-item.active i { color: #ffffff; }

        /* Notification badge on nav */
        .nav-badge {
            margin-left: auto;
            background: var(--accent);
            color: white;
            font-size: 0.6rem;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 20px;
            min-width: 18px;
            text-align: center;
            display: none;
        }

        .nav-badge.visible { display: block; }

        /* Live pulse indicator */
        .live-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22c55e;
            margin-left: auto;
            position: relative;
            flex-shrink: 0;
        }

        .live-dot::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            background: rgba(34,197,94,0.3);
            animation: livePulse 2s infinite;
        }

        @keyframes livePulse {
            0%, 100% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.5); opacity: 0; }
        }

        .logout-section {
            padding: 14px 12px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }

        .logout-btn {
            color: rgba(255,118,117,0.8);
            background: rgba(255,118,117,0.08);
            border-radius: 10px;
        }

        .logout-btn:hover {
            background: #ff7675 !important;
            color: white !important;
        }

        /* ========== MAIN CONTENT ========== */
        .main-wrapper {
            flex-grow: 1;
            padding: 36px 44px;
            overflow-x: hidden;
            max-width: calc(100vw - var(--sidebar-width));
        }

        /* ========== ALERTS ========== */
        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 22px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success { background: #e6f4ea; color: var(--success); border: 1px solid #ceead6; }
        .alert-error   { background: #fce8e6; color: var(--error);   border: 1px solid #fad2cf; }

        .card {
            background: var(--card-bg);
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.025);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 11px 22px;
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background: #271815;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(62,39,35,0.2);
        }

        /* ========== TOAST NOTIFICATION ========== */
        #toast-container {
            position: fixed;
            top: 22px;
            right: 22px;
            z-index: 999999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }

        .toast-notification {
            background: #ffffff;
            border-left: 5px solid #ff7675;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12), 0 2px 8px rgba(0,0,0,0.08);
            padding: 14px 16px;
            border-radius: 12px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            width: 320px;
            pointer-events: all;
            transform: translateX(120%);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .toast-notification.show { transform: translateX(0); }
        .toast-notification.hide { transform: translateX(120%); }

        .toast-icon {
            background: #fdf2f2;
            color: #c0392b;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        .toast-icon.success { background: #e8f5e9; color: #27ae60; }
        .toast-icon.info    { background: #e3f2fd; color: #1976d2; }

        .toast-body { flex-grow: 1; }

        .toast-title {
            font-size: 0.75rem;
            font-weight: 800;
            color: #c0392b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 2px;
        }

        .toast-category {
            font-size: 0.65rem;
            font-weight: 700;
            color: #8c8c8c;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: block;
            margin-bottom: 4px;
        }

        .toast-message {
            font-size: 0.78rem;
            color: #57534e;
            font-style: italic;
            line-height: 1.4;
            display: block;
        }

        .toast-close {
            background: none;
            border: none;
            color: #b5b5b5;
            cursor: pointer;
            font-size: 0.85rem;
            padding: 0;
            line-height: 1;
            flex-shrink: 0;
            transition: color 0.2s;
        }

        .toast-close:hover { color: #636e72; }

        /* ========== SYNC INDICATOR ========== */
        #sync-indicator {
            position: fixed;
            bottom: 18px;
            right: 18px;
            background: #3E2723;
            color: rgba(255,255,255,0.7);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.65rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 9999;
            pointer-events: none;
        }

        #sync-indicator.visible { opacity: 1; }

        #sync-indicator i { font-size: 0.65rem; animation: spinSync 1s linear infinite; }

        @keyframes spinSync {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #dcdde1; border-radius: 10px; }
    </style>

    @stack('styles')
</head>
<body>

    {{-- ======== SIDEBAR ======== --}}
    <aside class="sidebar">
        <div class="logo-section">
            <div class="logo-icon">
                <i class="fa-solid fa-house-user"></i>
            </div>
            <div>
                <div class="logo-text">IPK Admin</div>
                <div class="logo-sub">Boardinghouse System</div>
            </div>
        </div>

        <nav class="nav-container">
            <div class="nav-label">Main Console</div>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i>
                Dashboard
                <span class="live-dot" title="Live sync active"></span>
            </a>

            <a href="{{ route('admin.tenants') }}"
               class="nav-item {{ request()->routeIs('admin.tenants*') ? 'active' : '' }}">
                <i class="fa-solid fa-users-viewfinder"></i>
                Tenants
            </a>

            <div class="nav-label">Operations</div>

            <a href="{{ route('admin.rooms') }}"
               class="nav-item {{ request()->routeIs('admin.rooms*') ? 'active' : '' }}">
                <i class="fa-solid fa-door-open"></i>
                Room Mgmt
            </a>

            <a href="{{ route('admin.payments') }}"
               class="nav-item {{ request()->routeIs('admin.payments*') ? 'active' : '' }}">
                <i class="fa-solid fa-sack-dollar"></i>
                Payments
                <span class="nav-badge" id="pending-payments-badge">0</span>
            </a>

            <div class="nav-label">Configuration</div>

            <a href="{{ route('admin.profile') }}"
               class="nav-item {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-gear"></i>
                Admin Profile
            </a>
        </nav>

        <div class="logout-section">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-item logout-btn">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Log Out System
                </button>
            </form>
        </div>
    </aside>

    {{-- ======== MAIN CONTENT ======== --}}
    <main class="main-wrapper">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    {{-- ======== TOAST CONTAINER ======== --}}
    <div id="toast-container"></div>

    {{-- ======== SYNC INDICATOR ======== --}}
    <div id="sync-indicator">
        <i class="fa-solid fa-arrows-rotate"></i>
        <span>Syncing...</span>
    </div>

    {{-- ======== NOTIFICATION SOUND ENGINE ======== --}}
    <script>
    // === SOUND ENGINE — Web Audio API (no external files needed) ===
    const SoundEngine = {
        ctx: null,
        unlocked: false,

        init() {
            if (!this.ctx) {
                this.ctx = new (window.AudioContext || window.webkitAudioContext)();
                
                // Unlock mechanism for strict browser autoplay policies
                const unlock = () => {
                    if (this.ctx.state === 'suspended') {
                        this.ctx.resume();
                    }
                    this.unlocked = true;
                    // Remove listeners once unlocked
                    ['click', 'touchstart', 'keydown'].forEach(evt => 
                        document.removeEventListener(evt, unlock)
                    );
                };

                // Listen for first interaction to unlock audio context
                ['click', 'touchstart', 'keydown'].forEach(evt => 
                    document.addEventListener(evt, unlock, { once: true })
                );
            }
        },

        // Plays a gentle 2-tone chime
        playAlert() {
            try {
                this.init();
                // If it hasn't been unlocked by user yet, silently return rather than throwing an error
                if (this.ctx.state === 'suspended' && !this.unlocked) return;

                const ctx = this.ctx;
                const playTone = (freq, startTime, duration, gainVal = 0.18) => {
                    const osc  = ctx.createOscillator();
                    const gain = ctx.createGain();

                    osc.connect(gain);
                    gain.connect(ctx.destination);

                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(freq, startTime);

                    gain.gain.setValueAtTime(0, startTime);
                    gain.gain.linearRampToValueAtTime(gainVal, startTime + 0.03);
                    gain.gain.exponentialRampToValueAtTime(0.001, startTime + duration);

                    osc.start(startTime);
                    osc.stop(startTime + duration);
                };

                const now = ctx.currentTime;
                playTone(880, now,        0.25);   // High A
                playTone(660, now + 0.18, 0.35);   // E — resolves softly
            } catch(e) {
                console.warn('Sound playback skipped:', e);
            }
        },

        // Soft success ping
        playSuccess() {
            try {
                this.init();
                if (this.ctx.state === 'suspended' && !this.unlocked) return;

                const ctx = this.ctx;
                const now = ctx.currentTime;

                const osc  = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.connect(gain);
                gain.connect(ctx.destination);

                osc.type = 'sine';
                osc.frequency.setValueAtTime(523, now);        // C5
                osc.frequency.linearRampToValueAtTime(784, now + 0.15); // G5

                gain.gain.setValueAtTime(0, now);
                gain.gain.linearRampToValueAtTime(0.12, now + 0.05);
                gain.gain.exponentialRampToValueAtTime(0.001, now + 0.4);

                osc.start(now);
                osc.stop(now + 0.4);
            } catch(e) {}
        }
    };

    // === TOAST NOTIFICATION SYSTEM ===
    const ToastManager = {
        container: null,

        init() {
            this.container = document.getElementById('toast-container');
        },

        show({ title = 'New Alert', category = '', message = '', type = 'alert', duration = 6000 }) {
            // Failsafe initialization
            if (!this.container) this.init();
            
            const toast = document.createElement('div');
            toast.className = 'toast-notification';

            const iconMap = {
                alert:   { icon: 'fa-triangle-exclamation', cls: '' },
                success: { icon: 'fa-circle-check',         cls: 'success' },
                info:    { icon: 'fa-circle-info',          cls: 'info' }
            };

            const { icon, cls } = iconMap[type] || iconMap.alert;

            toast.innerHTML = `
                <div class="toast-icon ${cls}">
                    <i class="fa-solid ${icon}"></i>
                </div>
                <div class="toast-body">
                    <span class="toast-title">${title}</span>
                    ${category ? `<span class="toast-category">${category}</span>` : ''}
                    ${message  ? `<span class="toast-message">"${message}"</span>` : ''}
                </div>
                <button class="toast-close" onclick="ToastManager.dismiss(this.closest('.toast-notification'))">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            `;

            this.container.appendChild(toast);

            // Trigger reflow to ensure the slide-in animation works reliably
            void toast.offsetWidth; 
            toast.classList.add('show');

            // Play sound
            if (type === 'alert')   SoundEngine.playAlert();
            if (type === 'success') SoundEngine.playSuccess();

            // Auto-dismiss
            setTimeout(() => this.dismiss(toast), duration);
        },

        dismiss(toast) {
            if (!toast || !toast.parentNode) return;
            toast.classList.remove('show');
            toast.classList.add('hide');
            setTimeout(() => { if (toast.parentNode) toast.remove(); }, 400);
        }
    };

    // === SILENT BACKGROUND SYNC (3 seconds) ===
    const LiveSync = {
        apiEndpoint: null,
        lastAlertCount: null,
        lastPendingCount: null,
        syncIndicator: null,
        initialized: false,

        init(endpoint) {
            this.apiEndpoint = endpoint;
            this.syncIndicator = document.getElementById('sync-indicator');
            ToastManager.init();
            this.initialized = true;
            this.startPolling();
        },

        showSyncing() {
            if (this.syncIndicator) {
                this.syncIndicator.classList.add('visible');
                clearTimeout(this._syncHideTimer);
                this._syncHideTimer = setTimeout(() => {
                    this.syncIndicator.classList.remove('visible');
                }, 800);
            }
        },

        updatePendingBadge(count) {
            const badge = document.getElementById('pending-payments-badge');
            if (!badge) return;
            if (count > 0) {
                badge.textContent = count > 99 ? '99+' : count;
                badge.classList.add('visible');
            } else {
                badge.classList.remove('visible');
            }
        },

        startPolling() {
            if (!this.apiEndpoint) return;

            const poll = () => {
                this.showSyncing();

                fetch(this.apiEndpoint, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error('Sync failed: ' + res.status);
                    return res.json();
                })
                .then(data => {
                    this.processData(data);
                })
                .catch(err => {
                    console.warn('[LiveSync] Poll error:', err.message);
                })
                .finally(() => {
                    setTimeout(poll, 3000); // 3-second interval
                });
            };

            // Initial delay of 3s before first poll
            setTimeout(poll, 3000);
        },

        processData(data) {
            if (!data) return;

            // --- UPDATE METRIC CARDS ---
            if (data.stats) {
                const fields = {
                    'total-revenue-count': data.stats.total_due,
                    'collected-count':     data.stats.collected,
                    'pending-count':       data.stats.pending,
                    'occupancy-count':     data.stats.occupancy
                };
                Object.entries(fields).forEach(([id, val]) => {
                    const el = document.getElementById(id);
                    if (el && val !== undefined) el.innerText = val;
                });
            }

            // --- PENDING PAYMENTS BADGE ---
            if (data.pendingPaymentsCount !== undefined) {
                const count = parseInt(data.pendingPaymentsCount) || 0;
                this.updatePendingBadge(count);

                // Notify if new pending payments appeared
                if (this.lastPendingCount !== null && count > this.lastPendingCount) {
                    const diff = count - this.lastPendingCount;
                    ToastManager.show({
                        title: 'New Payment Submitted',
                        category: 'Payment Alert',
                        message: `${diff} new payment${diff > 1 ? 's' : ''} awaiting your approval.`,
                        type: 'alert',
                        duration: 7000
                    });
                }
                this.lastPendingCount = count;
            }

            // --- NEW ALERTS DETECTION ---
            if (Array.isArray(data.alerts)) {
                const incoming = data.alerts.length;

                if (this.lastAlertCount !== null && incoming > this.lastAlertCount) {
                    const newest = data.alerts[0];
                    if (newest) {
                        ToastManager.show({
                            title: 'New System Alert',
                            category: newest.category || 'Notification',
                            message: newest.description || '',
                            type: 'alert',
                            duration: 7000
                        });
                    }
                }
                this.lastAlertCount = incoming;

                // Re-render alerts container if it exists on page
                const alertsContainer = document.getElementById('admin-alerts-container');
                if (alertsContainer) this.renderAlerts(alertsContainer, data.alerts);
            }

            // --- RECENT ACTIVITIES TABLE ---
            if (Array.isArray(data.upcomingDues)) {
                const tbody = document.getElementById('admin-activities-tbody');
                if (tbody) this.renderActivities(tbody, data.upcomingDues);
            }
        },

        renderAlerts(container, alerts) {
            if (alerts.length === 0) {
                container.innerHTML = `
                    <div style="display:flex;gap:10px;font-size:0.8rem;border-left:3px solid #00b894;padding-left:12px;">
                        <div style="color:#27ae60;line-height:1.4;font-weight:600;">
                            ✅ All resident profiles and accounts are currently in full operational compliance.
                        </div>
                    </div>`;
                return;
            }

            container.innerHTML = alerts.map(alert => `
                <div style="display:flex;flex-direction:column;gap:4px;border-left:3px solid #ff7675;padding-left:12px;font-size:0.8rem;margin-bottom:2px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-weight:800;text-transform:uppercase;color:#c0392b;font-size:0.7rem;background:#fdf2f2;padding:2px 6px;border-radius:4px;">
                            ${alert.category || 'ALERT'}
                        </span>
                        <span style="font-size:10px;color:#a3a3a3;">${alert.time_ago || ''}</span>
                    </div>
                    <div style="color:#57534e;line-height:1.4;font-style:italic;">"${alert.description || ''}"</div>
                    <div style="font-size:10px;color:#78716c;">Submitted by Resident ID #${alert.tenant_id || 'N/A'}</div>
                </div>`
            ).join('');
        },

        renderActivities(tbody, dues) {
            if (dues.length === 0) {
                tbody.innerHTML = `<tr><td colspan="4" style="text-align:center;padding:20px;color:#a3a3a3;font-size:0.9rem;">No recent activities found.</td></tr>`;
                return;
            }

            tbody.innerHTML = dues.map(due => {
                const status = (due.status || 'PENDING').toUpperCase();
                const badgeStyle = status === 'PAID'
                    ? 'background:#e3fcef;color:#00b894;border:1px solid #a3e635;'
                    : status === 'PENDING'
                        ? 'background:#fffbeb;color:#d97706;border:1px solid #fde68a;'
                        : 'background:#fff5f5;color:#ff7675;border:1px solid #fca5a5;';

                return `
                    <tr class="data-table-row" style="border-bottom:1px solid #fafaf9;">
                        <td style="padding:14px 12px;">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div style="width:36px;height:36px;border-radius:50%;background:#efebe9;display:flex;align-items:center;justify-content:center;font-size:0.85rem;color:#3E2723;font-weight:600;">👤</div>
                                <div>
                                    <div style="font-weight:700;font-size:0.9rem;color:#2d2d2d;">${due.tenant_name || (due.tenant && due.tenant.name) || 'Active Account'}</div>
                                    <div style="font-size:0.75rem;color:#78716c;margin-top:2px;">${due.room || due.room_number || 'N/A'}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding:14px 12px;font-size:0.85rem;color:#57534e;">${due.date || ''}</td>
                        <td style="padding:14px 12px;font-weight:700;color:#2d2d2d;font-size:0.9rem;">${due.amount || '₱0.00'}</td>
                        <td style="padding:14px 12px;text-align:right;">
                            <span style="padding:5px 12px;border-radius:20px;font-size:0.7rem;font-weight:800;letter-spacing:0.3px;display:inline-block;${badgeStyle}">${status}</span>
                        </td>
                    </tr>`;
            }).join('');
        }
    };

    // Expose globally for child views to start sync
    window.LiveSync    = LiveSync;
    window.ToastManager = ToastManager;
    window.SoundEngine  = SoundEngine;
    </script>

    @stack('scripts')
</body>
</html>