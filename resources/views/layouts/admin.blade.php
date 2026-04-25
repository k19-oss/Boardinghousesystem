<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cozy Habitat - @yield('title')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #1e272e;      /* Deep Slate */
            --secondary: #485e6a;    /* Muted Blue-Grey */
            --accent: #fab1a0;       /* Soft Peach/Copper */
            --bg-body: #f1f2f6;      /* Light Grey */
            --card-bg: #ffffff;
            --sidebar-width: 280px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

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

        .logo-section i {
            color: var(--accent);
            font-size: 1.6rem;
        }

        .nav-container {
            flex-grow: 1;
            padding: 0 15px;
        }

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
        }

        .nav-item i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .nav-item:hover {
            color: #ffffff;
            background: rgba(255,255,255,0.05);
        }

        .nav-item.active {
            background: var(--accent);
            color: var(--primary);
            font-weight: 700;
            box-shadow: 0 10px 20px rgba(250, 177, 160, 0.2);
        }

        .logout-section {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .logout-btn {
            color: #ff7675;
            background: rgba(255,118,117,0.1);
        }

        .logout-btn:hover {
            background: #ff7675;
            color: white;
        }

        /* --- Main Content Area --- */
        .main-wrapper {
            flex-grow: 1;
            padding: 40px 50px;
            max-width: calc(100vw - var(--sidebar-width));
        }

        /* --- Global Component Classes --- */
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

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: #f9f9f9;
            border: 2px solid #f1f2f6;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: var(--transition);
            outline: none;
        }

        .form-control:focus {
            border-color: var(--accent);
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(250, 177, 160, 0.15);
        }

        /* Scrollbar Styling for Modern Browsers */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #dcdde1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #b2bec3; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo-section">
            <i class="fa-solid fa-house-user"></i>
            <span>COZY HABITAT</span>
        </div>

        <nav class="nav-container">
            <div class="nav-label">Main Console</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.tenants') }}" class="nav-item {{ request()->routeIs('admin.tenants') ? 'active' : '' }}">
                <i class="fa-solid fa-users-viewfinder"></i>
                Tenants
            </a>

            <div class="nav-label">Operations</div>
            <a href="{{ route('admin.rooms') }}" class="nav-item {{ request()->routeIs('admin.rooms') ? 'active' : '' }}">
                <i class="fa-solid fa-door-open"></i>
                Room Mgmt
            </a>
            <a href="{{ route('admin.payments') }}" class="nav-item {{ request()->routeIs('admin.payments') ? 'active' : '' }}">
                <i class="fa-solid fa-sack-dollar"></i>
                Payments
            </a>

            <div class="nav-label">Configuration</div>
            <a href="{{ route('admin.profile') }}" class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                <i class="fa-solid fa-user-gear"></i>
                Admin Profile
            </a>
        </nav>

        <div class="logout-section">
            <a href="{{ route('login') }}" class="nav-item logout-btn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Log Out System
            </a>
        </div>
    </aside>

    <main class="main-wrapper">
        @yield('content')
    </main>

</body>
</html>