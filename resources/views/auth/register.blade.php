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

        /* Example register button with subtle gradient & hover effect */


        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f5f5f5;
        }

        /* Container for side-by-side layout */
        .container {
            display: flex;
            min-height: 100vh; /* Full viewport height */
            width: 100%;
        }

        /* Left panel: branding or instructions */
        .left-panel {
            flex: 1;  /* occupies 1 part, adjust as needed */
            background-color: #0C2E5B; /* Dark blue tone */
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px 20px;
        }
        .left-panel h1 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        .left-panel p {
            font-size: 1rem;
            line-height: 1.4;
            max-width: 280px;
        }

        /* Right panel: the registration form */
        .right-panel {
            flex: 2;  /* occupies 2 parts, adjust as needed */
            background-color: #fff;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-panel h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        /* Two-column form layout */
        form {
            display: grid;
            grid-template-columns: 1fr 1fr; /* two columns */
            gap: 20px;
        }

        /* Full-width row (spanning both columns) */
        .full-width {
            grid-column: 1 / 3;
        }

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

        /* Car info box styling */
        .car-info {
            border: 1px solid #eee;
            padding: 10px;
            border-radius: 4px;
            background-color: #fafafa;
            margin-bottom: 10px;
        }

        /* Image Preview */
        #image-preview {
            margin-top: 10px;
            max-width: 120px;
            max-height: 120px;
            display: none;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        /* Buttons row */
        .button-row {
            grid-column: 1 / 3; 
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        /* Button styling */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-cancel {
            background-color: #fff;
            color: #0C2E5B;
            border: 2px solid #0C2E5B;
        }
        .btn-cancel:hover {
            background-color: #f3f3f3;
        }
        .btn-register {
            background-color: #0C2E5B;
            color: #fff;
        }
        .btn-register:hover {
            background-color: #0a2246;
        }

        /* Responsive stacking */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .left-panel, .right-panel {
                width: 100%;
                flex: none;
                padding: 30px 20px;
            }
            form {
                grid-template-columns: 1fr; /* single column on mobile */
            }
            .button-row {
                grid-column: 1 / 2;
            }
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- LEFT PANEL: Branding / Instructions -->
        <div class="left-panel">
            <h1>Welcome!</h1>
            <p>Join Carcare to access top-notch<br>car services and support.</p>
        </div>

        <!-- RIGHT PANEL: Registration Form -->
        <div class="right-panel">
            <h2>Register</h2>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- First Name -->
                <div>
                    <label for="first_name">User Name</label>
                    <input id="first_name" type="text" name="first_name" required autofocus autocomplete="first_name">
                </div>

                <!-- Email -->
                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required autocomplete="username">
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number">Contact Number</label>
                    <input id="phone_number" type="number" name="phone_number" required autocomplete="phone_number">
                </div>

                <!-- Address -->
                <div>
                    <label for="address">Address</label>
                    <input id="address" type="text" name="address" required autocomplete="address">
                </div>

                <!-- Province -->
                <div>
                    <label for="province">Province</label>
                    <input id="province" type="text" name="province" required autocomplete="province">
                </div>

                <!-- Region -->
                <div>
                    <label for="region">Region</label>
                    <input id="region" type="text" name="region" required autocomplete="region">
                </div>

                <!-- Zip Code -->
                <div>
                    <label for="zip_code">Zip Code</label>
                    <input id="zip_code" type="number" name="zip_code" required autocomplete="zip_code">
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name">Last Name</label>
                    <input id="last_name" type="text" name="last_name" required autocomplete="last_name">
                </div>

                <!-- Password -->
                <div>
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>

                <!-- Profile Image (Full width row) -->
                <div class="full-width">
                    <label for="image">Profile Image</label>
                    <input id="image" type="file" name="image" accept="image/*">
                    <img id="image-preview" src="#" alt="Image Preview">
                </div>

                <!-- Car Information Section (Full width row) -->
                <div class="full-width">
                    <h4>Car Information</h4>
                    <div id="car-inputs">
                        <div class="car-info">
                            <label for="car_type_0">Car Type</label>
                            <input id="car_type_0" type="text" name="car_type[]" required>
                            <label for="car_model_0">Car Model</label>
                            <input id="car_model_0" type="text" name="car_model[]" required>
                        </div>
                    </div>
                    <button type="button" id="add-car" class="btn btn-cancel" style="margin-top:10px;">Add another car</button>
                </div>

                <!-- Footer Actions: Cancel + Register buttons -->
                <div class="button-row">
                    <a href="{{ route('login') }}" class="btn btn-cancel">Cancel</a>
                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for Car Inputs & Image Preview -->
    <script>
        // Dynamic Car Inputs
    

        // Image Preview
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const preview = document.getElementById('image-preview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });
    </script>
</body>
</html>
