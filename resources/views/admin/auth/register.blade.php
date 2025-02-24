<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Carcare Admin - Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .button-row {
            grid-column: 1 / 3; /* spans both columns */
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        /* Buttons */
        .btn-cancel {
            background-color: #fff;
            color: #0C2E5B;
            border: 2px solid #0C2E5B;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-cancel:hover {
            background-color: #f0f0f0;
        }

        .btn-register {
  background: linear-gradient(90deg, #0C2E5B 0%, #233f6f 100%);
  color: #fff;
  border: none;
  padding: 12px 24px;
  font-size: 1rem;
  font-weight: 600;
  border-radius: 4px;
  cursor: pointer;
  transition: background 0.3s ease, box-shadow 0.3s ease;
}

/* Hover & focus effects */
.btn-register:hover,
.btn-register:focus {
  background: linear-gradient(90deg, #0c2655 0%, #1e3252 100%);
  box-shadow: 0 4px 8px rgba(0,0,0,0.15);
  outline: none;
}

/* Optional “active” or “pressed” effect */
.btn-register:active {
  transform: scale(0.98);
  box-shadow: none;
}


        /* Label and Input Styles */
        label {
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 0.95rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Base Body Styles */
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

        /* Left panel: used for admin branding or instructions */
        .left-panel {
            flex: 1;
            background-color: #0C2E5B; /* Dark blue tone */
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px 20px;
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
            max-width: 250px;
        }

        /* Right panel: contains the Blade form for admin registration */
        .right-panel {
            flex: 1;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
        }

        /* Center the form in the right panel */
        .form-container {
            max-width: 400px; /* Limit the form width */
            margin: 0 auto;
        }

        /* Form spacing adjustments */
        .form-container form > div {
            margin-bottom: 15px;
        }

        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Optional: responsive design for smaller screens */
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
        <!-- LEFT PANEL: Logo/Branding or instructions -->
        <div class="left-panel">
            <!-- Replace this placeholder image with your brand's admin logo -->
            <img src="https://via.placeholder.com/200x80?text=Admin+Logo" alt="Admin Logo">
            <h1>Welcome, Admin!</h1>
            <p>Create a new administrator account to manage the Carcare platform.</p>
        </div>

        <!-- RIGHT PANEL: Admin Register Form -->
        <div class="right-panel">
            <div class="form-container">
                <h3 class="text-center mb-3">Admin Register Page</h3>
                <form method="POST" action="{{ route('admin.register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input 
                            id="name" 
                            class="block mt-1 w-full" 
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required 
                            autofocus 
                            autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input 
                            id="email" 
                            class="block mt-1 w-full" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input 
                            id="password" 
                            class="block mt-1 w-full"
                            type="password" 
                            name="password"
                            required 
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input 
                            id="password_confirmation" 
                            class="block mt-1 w-full"
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="button-row">
                        @if (Route::has('admin.login'))
                        <a class="btn-cancel" href="{{ route('admin.login') }}">
                            {{ __('Cancel') }}
                        </a>
                    @endif
                        <button type="submit" class="btn-register">
                            Register
                          </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
