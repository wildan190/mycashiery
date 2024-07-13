<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MyCashiery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #38a169);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            padding: 20px;
        }

        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 40px;
        }

        .welcome {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .welcome a {
            color: #333;
            text-decoration: none;
        }

        .welcome a:hover {
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            background-color: #6a11cb;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #38a169;
        }
    </style>
</head>
<body>
    <div class="welcome">
        <h1>Welcome to MyCashiery</h1>
        <p>MyCashiery is a simple point of sale system built with Laravel.</p>
        <p>You can start using it by logging in to the admin panel.</p>
        <p><button class="btn" onclick="window.location.href='{{ route('login') }}'">Admin Login</button></p>
    </div>
</body>
</html>

