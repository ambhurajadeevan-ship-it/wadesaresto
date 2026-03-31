<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f8f8f8;
            font-family: 'Poppins', sans-serif;
        }

        .auth-card {
            width: 400px;
            background: white;
            padding: 45px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            letter-spacing: 4px;
            color: #0F3B34;
            text-align: center;
        }

        .brand::after {
            content: "";
            display: block;
            width: 60px;
            height: 2px;
            background: #c59d5f;
            margin: 12px auto 25px auto;
            border-radius: 2px;
        }

        .auth-title {
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 5px;
            color: #111;
        }

        .auth-sub {
            text-align: center;
            font-size: 13px;
            color: #777;
            margin-bottom: 35px;
        }

        .form-control {
            border-radius: 30px;
            padding: 12px 20px;
        }

        .btn-auth {
            width: 100%;
            padding: 12px;
            border-radius: 30px;
            background: #1f3d3a;
            border: none;
            color: white;
            font-weight: 600;
        }

        .btn-auth:hover {
            background: #17302d;
        }

        .auth-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: #1f3d3a;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="auth-card">
    @yield('content')
</div>

</body>
</html>