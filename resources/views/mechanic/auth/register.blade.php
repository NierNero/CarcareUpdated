<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Carcare - Mechanic Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Corrected CSS for image preview using all lowercase id */
        #image-preview {
            margin-top: 10px;
            max-width: 120px;
            max-height: 120px;
            display: none;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f5f5f5;
        }

        /* Container for side-by-side layout */
        .container {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }
        /* LEFT PANEL: Steps / Illustrations */
        .left-panel {
            width: 30%;
            background-color: #0C2E5B;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 40px 20px;
            align-items: center;
            justify-content: flex-start;
        }
        .left-panel h2 {
            font-size: 1.6rem;
            margin-bottom: 20px;
            text-align: center;
        }
        .step {
            margin-bottom: 30px;
            text-align: center;
        }
        .step img {
            width: 100%;
            max-width: 150px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .step p {
            font-size: 0.95rem;
            line-height: 1.4;
        }
        /* RIGHT PANEL: Mechanic Register Form */
        .right-panel {
            width: 70%;
            background-color: #fff;
            padding: 50px;
        }
        .right-panel h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        /* Success message styling */
        .alert.alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        /* Two-column form layout */
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        /* Full-width row styling */
        .full-width {
            grid-column: 1 / 3;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 0.95rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        /* Buttons row */
        .button-row {
            grid-column: 1 / 3;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }
        .btn-cancel {
            background-color: #fff;
            color: #0C2E5B;
            border: 2px solid #0C2E5B;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
        }
        .btn-cancel:hover {
            background-color: #f0f0f0;
        }
        .btn-submit {
            background-color: #0C2E5B;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-submit:hover {
            background-color: #0a2246;
        }
        /* Error text styling */
        .text-red-600, .text-red-500 {
            color: #dc3545;
        }
        small {
            font-size: 0.85rem;
            display: inline-block;
            margin-top: 5px;
        }
        /* Responsive: stacking layout */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .left-panel, .right-panel {
                width: 100%;
                flex: none;
                padding: 20px;
            }
            form {
                grid-template-columns: 1fr;
            }
            .button-row {
                grid-column: 1 / 2;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- LEFT PANEL: Steps/Illustrations -->
        <div class="left-panel">
            <h2>Register Steps</h2>
            <div class="step">
                <img src="https://via.placeholder.com/150x100" alt="Illustration 1">
                <p>Register with us, enter your details, and click “Register Button.”</p>
            </div>
            <div class="step">
                <img src="https://via.placeholder.com/150x100" alt="Illustration 2">
                <p>Select “7 day trial” or “Pay for Enterprise Package” after registering.</p>
            </div>
        </div>
        
        <!-- RIGHT PANEL: Mechanic Register Form -->
        <div class="right-panel">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <h3>Mechanic Register Page</h3>
            <form action="{{ route('mechanic.create') }}" method="POST" enctype="multipart/form-data">
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

                <!-- Email -->
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

                <!-- Contact Number -->
                <div>
                    <x-input-label for="ContactNo" :value="__('ContactNo')" />
                    <x-text-input 
                        id="ContactNo"
                        class="block mt-1 w-full"
                        type="text"
                        name="ContactNo"
                        :value="old('ContactNo')" />
                    <x-input-error :messages="$errors->get('ContactNo')" class="mt-2" />
                </div>

                <!-- Address -->
                <div>
                    <x-input-label for="Address" :value="__('Address')" />
                    <x-text-input 
                        id="Address"
                        class="block mt-1 w-full"
                        type="text"
                        name="Address"
                        :value="old('Address')" />
                    <x-input-error :messages="$errors->get('Address')" class="mt-2" />
                </div>

                <!-- Shop Name -->
                <div>
                    <x-input-label for="shopname" :value="__('Shop Name')" />
                    <x-text-input
                        id="shopname"
                        class="block mt-1 w-full"
                        type="text"
                        name="shopname"
                        :value="old('shopname')" />
                    <x-input-error :messages="$errors->get('shopname')" class="mt-2" />
                </div>

                <!-- Shop Image -->
                <div >
                    <x-input-label for="image" :value="__('Shop Image')" />
                    <x-text-input
                        id="image"
                        class="block mt-1 w-full"
                        type="file"
                        name="image" 
                        accept="image/*" />
                    <!-- Preview image will show after file selection -->
                    <img id="image-preview" src="" alt="Image Preview">
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
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

                <!-- Actions -->
                <div class="button-row">
                    @if (Route::has('mechanic.register'))
                        <a class="btn-cancel" href="{{ route('mechanic.login') }}">
                            {{ __('Cancel') }}
                        </a>
                    @endif
                    <button type="submit" class="btn-submit">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div><!-- .right-panel -->
    </div><!-- .container -->
    
    <script>
        // Dynamic Car Inputs
        document.getElementById('add-car').addEventListener('click', function() {
            let container = document.getElementById('car-inputs');
            let index = container.getElementsByClassName('car-info').length;
            let div = document.createElement('div');
            div.classList.add('car-info');
            div.innerHTML = `
                <label for="car_type_${index}">Car Type</label>
                <input id="car_type_${index}" type="text" name="car_type[]" required>
                <label for="car_model_${index}">Car Model</label>
                <input id="car_model_${index}" type="text" name="car_model[]" required>
            `;
            container.appendChild(div);
        });

        // Image Preview after file selection
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
