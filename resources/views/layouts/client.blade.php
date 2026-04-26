<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - IPK Boarding House</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            /* 60-30-10 Color Rule */
            --primary-brown: #3d2b1f; /* Primary 60% */
            --bg-cream: #F5F5DC;      /* Secondary 30% */
            --accent-tan: #D7CCC8;    /* Accent 10% */
            --glass-white: rgba(255, 255, 255, 0.85);
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        /* Animated Live Background */
        .live-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(45deg, #F5F5DC, #D7CCC8, #EFEBE9);
            background-size: 400% 400%;
            animation: gradientMove 15s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Sidebar - Cozy Habitat Style */
        .sidebar {
            width: 260px;
            background-color: var(--primary-brown);
            height: 100vh;
            color: white;
            padding: 30px 20px;
            position: fixed;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            z-index: 100;
        }

        .logo { 
            font-size: 1.4rem; 
            font-weight: 800; 
            margin-bottom: 40px; 
            letter-spacing: -1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            padding: 14px 18px;
            margin-bottom: 8px;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-item i { width: 20px; text-align: center; }

        .nav-item:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-item.active {
            background-color: var(--accent-tan);
            color: var(--primary-brown);
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .main-content { 
            margin-left: 260px; 
            padding: 40px; 
            min-height: 100vh;
            width: calc(100% - 260px);
            box-sizing: border-box;
        }
        
        /* Modern Glass Cards */
        .card {
            background: var(--glass-white);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 8px 32px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .card:hover { transform: translateY(-5px); }

        .btn-pay {
            background: var(--primary-brown);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            border: none;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-pay:hover { opacity: 0.9; box-shadow: 0 5px 15px rgba(61, 43, 31, 0.3); }
    </style>
</head>
<body>
    <div class="live-bg"></div>

    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-house-chimney-user"></i>
            <span>IPK RESIDENT</span>
        </div>
        
        <a href="{{ route('client.dashboard') }}" class="nav-item {{ Request::is('client/dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        
        <a href="{{ route('client.bills') }}" class="nav-item {{ Request::is('client/bills') ? 'active' : '' }}">
            <i class="fas fa-wallet"></i> My Billing
        </a>

        <div style="position: absolute; bottom: 30px; width: 220px;">
            <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px;">
            <a href="/" class="nav-item" style="color: #ff7675;">
                <i class="fas fa-power-off"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>