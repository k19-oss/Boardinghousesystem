<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cozy Habitat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #5D4037; --accent: #D7A98C; }
        body { margin: 0; display: flex; height: 100vh; font-family: 'Inter', sans-serif; background: #F8F9FA; }
        .login-container { margin: auto; width: 400px; background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        .logo { text-align: center; color: var(--primary); font-size: 1.8rem; font-weight: 800; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 0.85rem; color: #636e72; margin-bottom: 8px; font-weight: 600; }
        input { width: 100%; padding: 12px; border: 1px solid #dfe6e9; border-radius: 10px; outline: none; transition: 0.3s; }
        input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(215, 169, 140, 0.2); }
        .btn-login { width: 100%; padding: 14px; background: var(--primary); color: white; border: none; border-radius: 10px; font-weight: 700; cursor: pointer; transition: 0.3s; margin-top: 10px; text-decoration: none; display: block; text-align: center; }
        .btn-login:hover { background: #4e342e; transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo"><i class="fa-solid fa-house-chimney"></i> Cozy Habitat</div>
        <form action="{{ route('admin.dashboard') }}" method="GET">
            <div class="form-group">
                <label>EMAIL ADDRESS</label>
                <input type="email" placeholder="admin@chmsu.edu.ph" required>
            </div>
            <div class="form-group">
                <label>PASSWORD</label>
                <input type="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-login">Sign In to Dashboard</button>
        </form>
    </div>
</body>
</html>