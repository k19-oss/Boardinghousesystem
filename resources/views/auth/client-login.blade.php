<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Login | IPK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-brown: #3d2b1f; /* 60% Brown */
            --glass-white: rgba(255, 255, 255, 0.15);
            --accent-grey: #d7ccc8;   /* 10% Grey */
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Live Background remains the same */
        .live-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(-45deg, #3d2b1f, #5d4037, #d7ccc8, #f5f5f5);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* DYNAMIC LOGIN BOX */
        .login-card {
            background: var(--glass-white);
            backdrop-filter: blur(20px); /* Makes it feel like frosted glass */
            -webkit-backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 24px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); /* Deep shadow for depth */
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            animation: float 6s ease-in-out infinite; /* Floating animation */
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        .login-card h2 {
            color: white;
            font-size: 2rem;
            margin-bottom: 8px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .login-card p {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 35px;
            font-size: 0.9rem;
        }

        /* Dynamic Input Fields */
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            outline: none;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .input-group input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: var(--accent-grey);
            box-shadow: 0 0 15px rgba(215, 204, 200, 0.3);
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 16px;
            color: var(--accent-grey);
            transition: 0.3s;
        }

        .input-group input:focus + i {
            color: white;
            transform: scale(1.1);
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: var(--primary-brown);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 800;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 10px 15px -3px rgba(61, 43, 31, 0.4);
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 25px -5px rgba(61, 43, 31, 0.5);
            background: #2a1d15;
        }
    </style>
</head>
<body>
    <div class="live-bg"></div>

    <div class="login-card">
        <h2>IPK Boarding</h2>
        <p>Resident Access Portal</p>

        <form action="{{ route('client.login.submit') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="email" name="email" placeholder="Email Address" required>
                <i class="fa-solid fa-envelope"></i>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>

            <button type="submit" class="login-btn">
                Sign In <i class="fa-solid fa-arrow-right-to-bracket" style="margin-left: 8px;"></i>
            </button>
        </form>

        <div style="margin-top: 25px;">
            <a href="#" style="color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.85rem; transition: 0.3s;">
                Forgot password?
            </a>
        </div>
    </div>
</body>
</html>