<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Carcare - Online Service Provider for your Car Needs</title>
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
        }

        /* Main container: side-by-side layout */
        .container {
            display: flex;
            min-height: 100vh; /* Occupies the full viewport height */
        }

        /* Left panel with a background image */
        .left-panel {
            flex: 1;
            background: url('https://via.placeholder.com/900x1200?text=Carcare+Background') no-repeat center center/cover;
            position: relative;
        }
        /* A translucent overlay to darken the image for better text visibility */
        .overlay {
            position: absolute;
            inset: 0; /* stretches overlay to all edges */
            background-color: rgba(0,0,0,0.4);
        }
        .left-panel {
      flex: 1;
      background-color: #0C2E5B;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #fff;
      text-align: center;
      padding: 40px 20px;
    }
    .left-panel img {
      max-width: 200px;
      margin-bottom: 20px;
    }
    .left-panel h2 {
      font-size: 1.8rem;
      margin-bottom: 10px;
    }
    .left-panel p {
      font-size: 1rem;
      line-height: 1.4;
      max-width: 250px;
    }

        /* Right panel: the login form in a card */
        .right-panel {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

        /* Card container for the form */
        .card {
            width: 100%;
            max-width: 400px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .card h2 {
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #333;
        }

        /* Laravel Session Status, if any */
        .status-message {
            margin-bottom: 15px;
            color: green;
        }

        /* Form controls */
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 0.95rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Remember me checkbox */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 5px;
        }

        /* Action row for links / buttons */
        .action-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        /* Buttons & link */
        a {
            color: #0C2E5B;
            text-decoration: none;
            font-size: 0.9rem;
        }
        a:hover {
            text-decoration: underline;
        }

        .btn-primary {
            background-color: #0C2E5B;
            color: #fff;
            border: none;
            padding: 10px 18px;
            font-size: 0.95rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0a2246;
        }

        /* Responsive adjustments (optional): stack panels on mobile */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .left-panel, .right-panel {
                width: 100%;
                flex: none;
                min-height: 300px;
            }
            .left-panel {
        padding: 20px 20px;
      }
        }

        /* Card-like wrapper for the login form */
    .form-wrapper {
      background-color: #fff;
      width: 100%;
      max-width: 400px;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* Heading */
    .form-wrapper h3 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #333;
    }

    .form-wrapper label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
      color: #333;
    }

    .form-wrapper input[type="email"],
    .form-wrapper input[type="password"] {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1rem;
      margin-bottom: 0.75rem;
      outline: none;
      transition: border-color 0.2s ease-in-out;
    }
    .form-wrapper input[type="email"]:focus,
    .form-wrapper input[type="password"]:focus {
      border-color: #646cff; /* Accent color */
    }
    </style>
</head>
<body>
    <div class="container">
        <!-- LEFT PANEL: Background Image + Overlaid Text -->
        <div class="left-panel">
            <div class="overlay"></div>
            <div class="left-panel-content">
                <h1>Welcome to Carcare</h1>
                <p>Your trusted online service provider<br>for all your vehicle needs.</p>
            </div>
        </div>

        <!-- RIGHT PANEL: Card with Login Form -->
        <div class="right-panel">
            <div class="form-wrapper">
                <h3>Log In</h3>

                <!-- Session Status (Laravel Blade) -->
                <x-auth-session-status class="mb-4 status-message" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="remember-row">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">{{ __('Remember me') }}</label>
                    </div>

                    <!-- Actions: Register link + Login Button -->
                    <div class="action-row">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">
                                {{ __('Create Account?') }}
                            </a>
                        @endif
                        <button type="submit" class="btn-primary">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </form>
            </div>
        </div><!-- .right-panel -->
    </div><!-- .container -->
</body>
</html>
