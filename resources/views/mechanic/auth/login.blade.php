<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <title>Mechanic Login</title>
  <style>
    /* Reset some default styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
      color: #333;
    }

    /* Main container for side-by-side layout */
    .container {
      display: flex;
      min-height: 100vh; /* Occupies full viewport height */
    }

    /* Left panel: mechanic branding or illustration */
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

    /* Right panel: holds the card-like login form */
    .right-panel {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
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

    /* Session Status */
    .session-status {
      margin-bottom: 1rem;
      font-size: 0.9rem;
      color: #28a745; /* Green */
    }

    /* Label */
    .form-wrapper label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
      color: #333;
    }

    /* Text input */
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

    /* Remember me checkbox + label */
    .remember-me {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }
    .remember-me input[type="checkbox"] {
      width: 16px;
      height: 16px;
      margin-right: 0.5rem;
      cursor: pointer;
    }

    /* Link and Button row */
    .action-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 1rem;
    }
    .action-row a {
      font-size: 0.9rem;
      color: #646cff;
      text-decoration: none;
    }
    .action-row a:hover {
      text-decoration: underline;
    }

    /* Button */
    .btn-primary {
      background-color: #646cff;
      border: none;
      color: #fff;
      padding: 0.75rem 1.25rem;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.2s ease-in-out;
    }
    .btn-primary:hover {
      background-color: #414fb5;
    }

    /* Error messages */
    .error-message {
      color: #dc3545; /* Red */
      font-size: 0.9rem;
      margin-top: 0.25rem;
      margin-bottom: 0.75rem;
    }

    /* Responsive design: stack layout on smaller screens */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
      .left-panel, .right-panel {
        width: 100%;
        flex: none;
        min-height: 200px;
      }
      .left-panel {
        padding: 20px 20px;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <!-- LEFT PANEL: Mechanic branding or illustration -->
  <div class="left-panel">
    <!-- Example mechanic logo or illustration -->
    <img src="https://via.placeholder.com/200x80?text=Mechanic+Logo" alt="Mechanic Logo">
    <h2>Mechanic Portal</h2>
    <p>Manage repairs, service requests,<br>and client communication easily.</p>
  </div>

  <!-- RIGHT PANEL: Card-based login form -->
  <div class="right-panel">
    <div class="form-wrapper">
      <!-- Session Status -->
      <x-auth-session-status class="session-status" :status="session('status')" />

      <h3>Mechanic Login Page</h3>

      <form method="POST" action="{{ route('mechanic.login') }}">
        @csrf

        <!-- Email Address -->
        <div>
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input 
            id="email"
            type="email"
            name="email"
            :value="old('email')"
            required 
            autofocus 
            autocomplete="username"
          />
          <x-input-error :messages="$errors->get('email')" class="error-message" />
        </div>

        <!-- Password -->
        <div>
          <x-input-label for="password" :value="__('Password')" />
          <x-text-input 
            id="password"
            type="password"
            name="password"
            required 
            autocomplete="current-password"
          />
          <x-input-error :messages="$errors->get('password')" class="error-message" />
        </div>

        <!-- Remember Me -->
        <div class="remember-me">
          <input id="remember_me" type="checkbox" name="remember">
          <label for="remember_me">{{ __('Remember me') }}</label>
        </div>

        <!-- Actions Row -->
        <div class="action-row">
          @if (Route::has('mechanic.register'))
            <a href="{{ route('mechanic.register') }}">
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
