<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
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

        .forgot-wrapper {
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

        input[type="email"] {
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

        .link {
            margin-top: 1rem;
            display: block;
            color: #666;
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s;
        }

        .link:hover {
            color: #333;
        }

        .message {
            margin-bottom: 1rem;
            padding: 0.75rem;
            border-radius: 10px;
            font-size: 0.85rem;
        }

        .success-msg {
            background-color: #e6ffe6;
            color: #2d8a3e;
            border-left: 4px solid #2d8a3e;
        }

        .error-msg {
            background-color: #ffe6e6;
            color: #d8000c;
            border-left: 4px solid #d8000c;
        }
    </style>
</head>
<body>

<div class="forgot-wrapper">
    <h2>Forgot Password</h2>

    @if(session('success'))
        <div class="message success-msg">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="message error-msg">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/forgot-password">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Send Reset Link</button>
    </form>

    <a href="/login" class="link">Back to Login</a>
</div>

</body>
</html>
