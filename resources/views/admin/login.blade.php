<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Wadesa Resto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(180deg, #ffffff 0%, #fafafa 100%);
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            width: 420px;
            background: #ffffff;
            padding: 50px 45px;
            border-radius: 24px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.08);
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            letter-spacing: 4px;
            color: #0F3B34;
            text-align: center;
        }

        .divider {
            width: 60px;
            height: 2px;
            background: #c8a96a;
            margin: 18px auto 30px auto;
        }

        .login-title {
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 5px;
            color: #111;
        }

        .login-sub {
            text-align: center;
            font-size: 13px;
            color: #777;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 40px;
            padding: 14px 20px;
            border: 1px solid #ddd;
            transition: 0.3s ease;
        }

        .form-control:focus {
            border-color: #c8a96a;
            box-shadow: 0 0 0 2px rgba(200,169,106,0.15);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            border-radius: 40px;
            background: #0F3B34;
            border: none;
            color: white;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .btn-login:hover {
            background: #0c2f2a;
            transform: translateY(-3px);
        }

        .alert {
            font-size: 13px;
            border-radius: 12px;
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="brand">WADESA</div>
    <div class="divider"></div>

    <div class="login-title">Admin Login</div>
    <div class="login-sub">Access your dashboard</div>

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <div class="form-group">
            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Email"
                   required>
        </div>

        <div class="form-group">
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Password"
                   required>
        </div>

        <div class="text-end mb-3">
            <a href="{{ route('admin.password.request') }}" 
            style="font-size:13px; color:#0F3B34;">
            Lupa Password?
            </a>
        </div>

        <button type="submit" class="btn-login">
            Login
        </button>

    </form>

</div>

</body>
</html>