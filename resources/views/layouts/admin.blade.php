<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cozy Habitat - @yield('title')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #A68069; display: flex; min-height: 100vh; }

        /* Sidebar - Reverting to original dark brown */
        .sidebar { width: 220px; background-color: #5D4037; color: white; padding: 20px 0; }
        .logo { display: flex; align-items: center; padding: 0 20px; margin-bottom: 30px; font-weight: bold; font-size: 1.2rem; }
        .logo-icon { margin-right: 10px; background: white; padding: 5px; border-radius: 5px; font-size: 1.1rem;}
        
        .nav-item { padding: 12px 20px; display: block; cursor: pointer; color: #D7CCC8; text-decoration: none; transition: 0.3s; }
        .nav-item:hover, .nav-item.active { background-color: #795548; color: white; border-radius: 0 20px 20px 0; margin-right: 10px; }

        /* Glossy Main Content Area - Keeping Laravel structure, changing colors */
        .main-content { flex: 1; padding: 30px; overflow-y: auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .header h1 { color: #fff; font-size: 1.5rem; }
        
        .btn-group button { padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; margin-left: 10px; font-size: 0.8rem;}
        .btn-add { background-color: #fff; color: #5D4037; }
        .btn-process { background-color: #D7A98C; color: #fff; }

        /* Summary Stats - Specific card colors from image */
        .stats-container { display: flex; gap: 20px; margin-bottom: 25px; }
        .stat-card { flex: 1; background-color: #8D6E63; padding: 20px; border-radius: 15px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .stat-card h3 { font-size: 0.9rem; opacity: 0.9; margin-bottom: 10px; }
        .stat-card p { font-size: 1.8rem; font-weight: bold; }

        /* Table Sections - The "cards" the tables sit in */
        .section-card { background-color: #8D6E63; border-radius: 15px; padding: 20px; margin-bottom: 25px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .section-card h2 { font-size: 1.1rem; margin-bottom: 15px; }
        
        /* The Actual Tables - White background from image */
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; color: #333; }
        th, td { text-align: left; padding: 12px 15px; border-bottom: 1px solid #eee; font-size: 0.9rem; }
        th { background-color: #f8f9fa; color: #555; }

        /* Badges & Buttons - From image */
        .badge { padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; }
        .paid, .active { background-color: #4CAF50; color: white; }
        .overdue, .pending { background-color: #E57373; color: white; }

        /* Action Buttons */
        .btn-edit { background: #42A5F5; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; margin-right: 5px; }
        .btn-delete { background: #EF5350; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <span class="logo-icon">🏠</span> Cozy Habitat
        </div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.tenants') }}" class="nav-item {{ request()->routeIs('admin.tenants') ? 'active' : '' }}">Tenants</a>
        <a href="#" class="nav-item">Bills</a>
        <a href="#" class="nav-item">Profile</a>
        <a href="#" class="nav-item">Settings</a>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>