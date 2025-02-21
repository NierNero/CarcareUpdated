<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Carcare Admin - Online Service Provider for your Car Needs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Container for side-by-side layout */
        .container {
            display: flex;
            min-height: 100vh; /* Full viewport height */
        }

        /* Left panel: Dark background with optional brand details */
        .left-panel {
            flex: 1;
            background-color: #0C2E5B; /* Dark blue tone */
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px 20px;
            text-align: center;
        }
        .left-panel img {
            max-width: 200px;
            margin-bottom: 20px;
        }
        .left-panel h1 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        .left-panel p {
            font-size: 1rem;
            line-height: 1.4;
        }

        /* Right panel: white background for the admin login form */
        .right-panel {
            flex: 1;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
        }
        .right-panel .form-container {
            max-width: 400px; /* Limit form width */
            margin: 0 auto;
        }

        /* Header for the login form */
        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form elements */
        form .form-group {
            margin-bottom: 15px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 0.95rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Remember Me row */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        .remember-row input {
            margin: 0;
        }

        /* Buttons and Links */
        .actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }
        a {
            font-size: 0.85rem;
            color: #0C2E5B;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        button {
            background-color: #0C2E5B;
            color: #fff;
            border: none;
            padding: 10px 18px;
            font-size: 0.9rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0a2246;
        }

        /* Optional media query to stack layout on small screens */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .left-panel, .right-panel {
                width: 100%;
                flex: none;
                min-height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- LEFT PANEL: Brand or Illustration -->
        <div class="left-panel">
            <!-- Optional brand image or admin illustration -->
            <img src="https://via.placeholder.com/200x80?text=Admin+Logo" alt="Admin Logo">
            <h1>Carcare Admin</h1>
            <p>Manage all car services and users through<br>our secure admin dashboard.</p>
        </div>

        <!-- RIGHT PANEL: Admin Login Form -->
        <div class="right-panel">
            <div class="form-container">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <h3 class="text-center mb-3">Admin Login Page</h3>
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <!-- Email Address -->
                    <div class="form-group">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input 
                            id="email" 
                            class="block mt-1 w-full" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input 
                            id="password" 
                            class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="remember-row">
                        <input id="remember_me" 
                               type="checkbox" 
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                               name="remember">
                        <label for="remember_me" class="inline-flex items-center">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Actions -->
                    <div class="actions">
                        @if (Route::has('admin.register'))
                            <a href="{{ route('admin.register') }}">{{ __('Create Account?') }}</a>
                        @endif
                        <button type="submit">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </form>
            </div> <!-- .form-container -->
        </div><!-- .right-panel -->
    </div><!-- .container -->
</body>
</html>
