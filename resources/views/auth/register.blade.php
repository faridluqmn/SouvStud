<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Coza Store Theme</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .login-container h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .login-container p {
            color: #999;
            margin-bottom: 30px;
        }
        .login-container input {
            width: 90%;
            padding: 12px 20px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
        .login-container button {
            width: 100%;
            padding: 12px;
            background-color:rgb(0, 0, 0);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: 700;
        }
        .login-container button:hover {
            background-color:rgb(91, 92, 92);
        }
        .login-container a {
            display: block;
            margin-top: 20px;
            color:rgb(1, 1, 1);
            text-decoration: none;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Sign Up</h1>
        <p>Welcome back! Create your new account.</p>
        <form action="{{ route('regis.submit') }}" method="POST">
            @csrf
            <input type="name" name="name" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="#">Forgot Password?</a>
        <a href="{{ route('login') }}">Login</a>
    </div>
</body>
</html>
