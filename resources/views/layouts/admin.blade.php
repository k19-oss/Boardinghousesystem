<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

=======
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
    <title>IPK Boardinghouse System - @yield('title')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            /* --- IPK boardinghouse System 60-30-10 Rule Palette --- */
            --primary: #3E2723;       /* 60% Dominant Color (Deep Rich Espresso Brown) */
            --secondary: #5D4037;     /* Secondary Supportive Accent (Warm Coffee) */
            --accent: #E91E63;        /* 10% Core Highlight Badge Color */
            --custom-gold: #d97706;   /* Active Menu Item Tab Highlight Accent */
            --bg-body: #F5F5F4;       /* 30% Canvas Area (Soft, Warm Stone Grey/Off-White) */
            --card-bg: #ffffff;
            --sidebar-width: 280px;
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

        /* --- Sidebar Styles --- */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--primary);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: sticky;
            top: 0;
            box-shadow: 10px 0 30px rgba(0,0,0,0.05);
            z-index: 100;
        }

        .logo-section {
            padding: 40px 30px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: -1px;
            color: #ffffff;
        }

        .logo-section i { color: var(--custom-gold); font-size: 1.6rem; }

        .nav-container { flex-grow: 1; padding: 0 15px; }

        .nav-label {
            padding: 25px 15px 10px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.3);
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 5px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
            width: 100%;
            border: none;
            background: transparent;
            cursor: pointer;
            text-align: left;
        }

        .nav-item i { font-size: 1.1rem; width: 20px; text-align: center; }

        .nav-item:hover { color: #ffffff; background: rgba(255,255,255,0.05); }

        .nav-item.active {
            background: var(--custom-gold);
            color: #ffffff;
            font-weight: 700;
            box-shadow: 0 10px 20px rgba(217, 119, 6, 0.25);
        }

        .logout-section { padding: 20px; border-top: 1px solid rgba(255,255,255,0.05); }

        .logout-btn { color: #ff7675; background: rgba(255,118,117,0.1); }

        .logout-btn:hover { background: #ff7675; color: white; }

        /* --- Main Content Area --- */
        .main-wrapper {
            flex-grow: 1;
            padding: 40px 50px;
            max-width: calc(100vw - var(--sidebar-width));
        }

        /* --- Global Session Alerts --- */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }
        .alert-success { background: #e6f4ea; color: var(--success); border: 1px solid #ceead6; }
        .alert-error { background: #fce8e6; color: var(--error); border: 1px solid #fad2cf; }

        .card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.02);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background: #dcdde1; border-radius: 10px; }
    </style>
    @stack('styles')
</head>
<body>

    <aside class="sidebar">
        <div class="logo-section">
            <i class="fa-solid fa-house-user"></i>
<<<<<<< HEAD
            <span>IPK Admin</span>
=======
            <span>IPK Boardinghouse</span>
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
        </div>

        <nav class="nav-container">
            <div class="nav-label">Main Console</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.tenants') }}" class="nav-item {{ request()->routeIs('admin.tenants*') ? 'active' : '' }}">
                <i class="fa-solid fa-users-viewfinder"></i>
                Tenants
            </a>

            <div class="nav-label">Operations</div>
            <a href="{{ route('admin.rooms') }}" class="nav-item {{ request()->routeIs('admin.rooms*') ? 'active' : '' }}">
                <i class="fa-solid fa-door-open"></i>
                Room Mgmt
            </a>
            <a href="{{ route('admin.payments') }}" class="nav-item {{ request()->routeIs('admin.payments*') ? 'active' : '' }}">
                <i class="fa-solid fa-sack-dollar"></i>
                Payments
            </a>

            <div class="nav-label">Configuration</div>
            <a href="{{ route('admin.profile') }}" class="nav-item {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
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

    <main class="main-wrapper">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>