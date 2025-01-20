<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <meta name="keywords" content="Carcare, Car Service, Maintenance, Online Services">
    <meta name="description" content="Get top-quality car services and maintenance online with Carcare.">
    <meta name="author" content="Carcare">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External styles and font-awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            background-color: #f8f8f8;
            color: #black;
        }

        /* Header styles */
        #header {
            background-color: white;
            padding: 10px 0;
            color: #fff;
        }

        #header .navbar {
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }

        #header .navbar .navbar-nav {
            display: flex;
            list-style: none;
        }

        #header .navbar .navbar-nav li {
            margin-right: 20px;
        }

        #header .navbar .navbar-nav li a {
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 60vh;
            background-image: url('{{ ('assets/img/slide/mechanic1.jpeg') }}');
            background-size: cover;
            background-position: center;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero-content {
            padding: 20px;
        }

        .hero-content h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .cta-btn {
            background-color: #ff6600;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }

        .cta-btn:hover {
            background-color: #e55b00;
        }

        /* Service Section */
        .service-section {
            padding: 50px 20px;
            text-align: center;
        }

        .service-section h2 {
            font-size: 32px;
            margin-bottom: 30px;
        }

        .service-box {
            display: inline-block;
            width: 30%;
            margin: 10px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
        }

        .service-box h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .service-box p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* Footer Section */
        #footer {
            background-color: #333;
            color: #fff;
            padding: 20px 20px;
        }

        #footer .contact-info {
            list-style: none;
            padding: 0;
        }

        #footer .contact-info li {
            margin-bottom: 10px;
        }

        #footer .social-links {
            list-style: none;
            display: flex;
            justify-content: center;
        }

        #footer .social-links li {
            margin-right: 15px;
        }

        #footer .social-links li a {
            color: #fff;
            font-size: 20px;
        }

        .footer-bottom {
            background-color: #222;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }

    </style>
</head>
<body>

    <!-- Header with Navigation -->
    <header id="header">
        <div class="navbar">
            <a href="index.php.html" class="logo"><img src="{{ ('images/carcare.jpg') }}" alt="Carcare Logo" width="150"></a>
            <ul class="navbar-nav">
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            </ul>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1>Top-Notch Car Services at Your Doorstep</h1>
            <p>We bring trusted car care to your home, anytime, anywhere.</p>
            <a href="{{ route('login') }}" class="cta-btn">Explore Our Services</a>
        </div>
    </section>

    <!-- Service Section -->
    
    <!-- Footer Section -->
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>CONTACT US</h3>
                    <ul class="contact-info">
                        <li><i class="fa fa-map-marker"></i> Faridabad, Haryana, India</li>
                        <li><i class="fa fa-envelope"></i> <a href="mailto:contact@carcaremedia.in">contact@carcaremedia.in</a></li>
                        <li><i class="fa fa-phone"></i> <a href="tel:+911234567890">+91-1234567890</a></li>
                    </ul>
                </div>
                <div class="col-md-6 text-right">
                    <ul class="social-links">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Carcare. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
