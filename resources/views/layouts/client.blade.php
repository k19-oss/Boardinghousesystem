<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Cozy Habitat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-brown: #5D4037; /* Same as Admin */
            --light-cream: #F5F5DC;
            --accent-tan: #D7CCC8;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--light-cream);
            margin: 0;
            display: flex;
        }

        /* Sidebar - Only Tenant Links */
        .sidebar {
            width: 250px;
            background-color: var(--primary-brown);
            height: 100vh;
            color: white;
            padding: 20px;
            position: fixed;
        }

        .logo { font-size: 1.5rem; font-weight: bold; margin-bottom: 30px; }
        
        .nav-item {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px;
            margin-bottom: 5px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .nav-item:hover, .nav-item.active {
            background-color: rgba(255,255,255,0.1);
        }

        .main-content { margin-left: 270px; padding: 30px; width: 100%; }
        
        /* Matching Cards Style */
        .stat-card {
            background: white; /* Changed to white for contrast on cream bg */
            padding: 20px;
            border-radius: 12px;
            border-left: 5px solid var(--primary-brown);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">🏠 Tenant Portal</div>
        <a href="{{ route('client.dashboard') }}" class="nav-item {{ Request::is('client/dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> My Dashboard
        </a>
        <a href="{{ route('client.bills') }}" class="nav-item {{ Request::is('client/bills') ? 'active' : '' }}">
            <i class="fas fa-receipt"></i> My Bills
        </a>
        
        <div style="position: absolute; bottom: 20px; width: 210px;">
            <a href="/" class="nav-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>