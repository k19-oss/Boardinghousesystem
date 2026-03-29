<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Cozy Habitat</title>
    <style>
        :root { --primary: #5D4037; --bg: #F5F5DC; }
        body { font-family: sans-serif; background: var(--bg); display: flex; margin: 0; }
        .sidebar { width: 250px; background: var(--primary); height: 100vh; color: white; padding: 20px; position: fixed; }
        .main-content { margin-left: 270px; padding: 30px; width: 100%; }
        .nav-item { display: block; color: white; padding: 10px; text-decoration: none; border-radius: 5px; margin-bottom: 5px; }
        .nav-item:hover, .active { background: rgba(255,255,255,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .stat-card { background: var(--primary); color: white; padding: 20px; border-radius: 10px; display: inline-block; min-width: 200px; margin-right: 15px; }
        .section-card { background: white; padding: 20px; border-radius: 10px; margin-top: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid #eee; }
        .badge { padding: 4px 8px; border-radius: 12px; font-size: 0.8rem; }
        .pending { background: #fff3cd; color: #856404; }
        .overdue { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>🏠 Cozy Habitat</h2>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.tenants') }}" class="nav-item {{ Request::is('admin/tenants') ? 'active' : '' }}">Manage Tenants</a>
        <hr>
        <a href="{{ route('client.dashboard') }}" class="nav-item">Switch to Client</a>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>