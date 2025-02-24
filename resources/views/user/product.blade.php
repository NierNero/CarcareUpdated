<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/chblue.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/theme-responsive.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/dtb/jquery.dataTables.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" media="screen">
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.1.10.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/modernizr.js') }}"></script>
</head>

<body>
    <style>
        #chat-button {
            position: fixed;
            bottom: 30px; /* Adjusts the distance from the bottom of the screen */
            right: 30px;  /* Adjusts the distance from the right edge */
            background-color: #4a3df5; /* Background color for the button */
            border-radius: 50%; /* Makes it circular */
            width: 70px; /* Size of the button */
            height: 70px; /* Size of the button */
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999; /* Makes sure it stays on top of other elements */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 32px;
        }
        
        #chat-button:hover {
            transform: scale(1.1);
            /* Makes it slightly bigger when hovered */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        #chat-button .chat-icon {
            color: white;
            font-size: 24px;
            /* Increases the chat icon size */
            text-decoration: none;
        }

        .product-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        
        
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            padding: 20px;
        }
        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .product-card .details {
            padding: 10px;
        }
        .btn-add {
            background: #ff5722;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>

<div id="layout">
    <div class="info-head">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="visible-md visible-lg text-left">
                        <li><a href="tel:+911234567890"><i class="fa fa-phone"></i> +91-1234567890</a></li>
                        <li><a href="mailto:contact@carcaremedia.in"><i class="fa fa-envelope"></i> contact@carcaremedia.in</a></li>
                    </ul>
                    <ul class="visible-xs visible-sm">
                        <li class="text-left"><a href="tel:+911234567890"><i class="fa fa-phone"></i> +91-1234567890</a></li>
                        <li class="text-right"><a href="index.php/changelocation.html"><i class="fa fa-map-marker"></i> University of High Blood</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="visible-md visible-lg text-right">
                        <li><i class="fa fa-comment"></i> Live Chat</li>
                        <li><a href="index.php/changelocation.html"><i class="fa fa-map-marker"></i> University of High Blood</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <header id="header" class="header-v3">
        <nav class="flat-mega-menu">
            <label for="mobile-button"><i class="fa fa-bars"></i></label>
            <input id="mobile-button" type="checkbox">
            <ul class="collapse">
                <li class="title">
                    <a href="index.php"><img src="{{ asset('images/carcare.jpg') }}" alt="Carcare Logo"></a>
                </li>
                
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('user.services', $mechanic->id) }}">Service</a></li>
                <li>
                    <a href=""{{ Auth::user()->name }}>My Account</a>
                    <ul class="drop-down one-column hover-fade">
                        <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <div class="content_info content_resalt">
        <div class="container" style="margin-top: 30px;">
            <!-- Additional content can go here -->
        </div>
    </div>

    <div class="container">
        <h2 class="text-center">Products</h2>
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->ProductName }}">
                    <div class="details">
                        <h5>{{ $product->ProductName }}</h5>
                        <p class="text-danger">₱{{ number_format($product->Price, 2) }}</p>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="mechanic_id" value="{{ $mechanic->id }}">
                            <button type="submit" class="btn btn-success mt-3">🛒 Add to Cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div> <!-- End of product-grid -->
    </div> <!-- End of container -->

    <div id="chat-button">
        <a href="#" onclick="openChat()" class="chat-icon">
            <i class="fa fa-comment"></i>
        </a>
    </div>
</div> <!-- End of layout -->

<script>
    // JavaScript to trigger chat window (Example)
    function openChat() {
        alert("Chat feature coming soon!");
        // You can replace this with your chat window integration
    }
</script>

<script type="text/javascript" src="{{ asset('assets/js/nav/jquery.sticky.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/totop/jquery.ui.totop.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/accordion/accordion.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/maps/gmap3.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/fancybox/jquery.fancybox.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/carousel/carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/filters/jquery.isotope.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/twitter/jquery.tweet.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/flickr/jflickrfeed.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/theme-options/theme-options.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/theme-options/jquery.cookies.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap/bootstrap-slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/dtb/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/dtb/jquery.table2excel.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/dtb/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/validation-rule.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap3-typeahead.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
<!-- Removed duplicate jQuery include to avoid conflicts -->
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.tp-banner').show().revolution({
            dottedOverlay: "none",
            delay: 5000,
            startwidth: 1170,
            startheight: 480,
            minHeight: 250,
            navigationType: "none",
            navigationArrows: "solo",
            navigationStyle: "preview1"
        });
    });
</script>
</body>

</html>