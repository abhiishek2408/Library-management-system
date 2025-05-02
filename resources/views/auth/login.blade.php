<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-wrapper {
            background: #ffffff;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            max-width: 360px;
            width: 100%;
            text-align: center;
            animation: fadeInSlide 0.8s ease-out;
        }

        @keyframes fadeInSlide {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="email"],
        input[type="password"] {
            padding: 0.6rem 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 0.9rem;
            background: #f9f9f9;
            box-shadow: inset 2px 2px 4px #d4d4d4, inset -2px -2px 4px #ffffff;
            transition: 0.3s ease;
        }

        input:focus {
            border-color: #66a6ff;
            outline: none;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(102, 166, 255, 0.2);
        }

        label {
            font-size: 0.85rem;
            color: #555;
            text-align: left;
            margin-bottom: 1rem;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        button {
            background: linear-gradient(to right, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 0.6rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s;
        }

        button:hover {
            transform: scale(1.02);
            background: linear-gradient(to right, #5a67d8, #6b46c1);
        }

        .links {
            margin-top: 1rem;
            font-size: 0.85rem;
        }

        .links a {
            display: block;
            color: #666;
            text-decoration: none;
            margin-bottom: 0.5rem;
            transition: color 0.3s;
        }

        .links a:hover {
            color: #333;
        }

        .message {
            margin-bottom: 1rem;
            padding: 0.75rem;
            border-radius: 10px;
            font-size: 0.85rem;
        }

        .error-msg {
            background-color: #ffe6e6;
            color: #d8000c;
            border-left: 4px solid #d8000c;
        }

        .success-msg {
            background-color: #e6ffe6;
            color: #2d8a3e;
            border-left: 4px solid #2d8a3e;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <h2>Login</h2>

    @if(session('error'))
        <div class="message error-msg">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="message success-msg">{{ session('success') }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <label>
            <input type="checkbox" name="remember"> Remember Me
        </label>

        <button type="submit">Login</button>
    </form>

    <div class="links">
        <a href="/signup">Don't have an account? Signup here</a>
        <a href="/forgot-password">Forgot Password?</a>
    </div>
</div>

</body>
</html>
