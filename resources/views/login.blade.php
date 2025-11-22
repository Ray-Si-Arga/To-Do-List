<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-g">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login To-Do List</title>

    <style>
        body {
            font-family: sans-serif;
            display: grid;
            place-items: center;
            min-height: 90vh;
            background-color: #f4f4f4;
        }

        .login-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 300px;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .login-button {
            width: 100%;
            padding: 0.75rem;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h2>Login</h2>

        <form action="{{ route('login') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>

                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ingatkan Saya</label>
            </div>

            <button type="submit" class="login-button">Login</button>
        </form>
    </div>

</body>

</html>
