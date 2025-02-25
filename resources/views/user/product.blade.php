<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}"> --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/chblue.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/theme-responsive.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/dtb/jquery.dataTables.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" media="screen">
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
</head>

<body>

<style>
    /* Chat Button */
    #chat-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #4a3df5;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    #chat-button:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    }
    #chat-button .chat-icon {
        color: white;
        font-size: 24px;
        text-decoration: none;
    }

    /* Product Cards */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
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
        padding-bottom: 10px;
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
        padding: 15px;
    }
    .btn-add, .btn-buy {
        display: block;
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        border: none;
    }
    .btn-add {
        background: #ff5722;
        color: white;
    }
    .btn-buy {
        background: #4CAF50;
        color: white;
    }
    .product-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }
</style>

<div id="layout">

    <header id="header" class="header-v3" >
        <nav class="flat-mega-menu">
            <label for="mobile-button"><i class="fa fa-bars"></i></label>
            <input id="mobile-button" type="checkbox">
            <ul class="collapse">
                <li class="title" >
                    <a href="{{ route('dashboard') }}"><img src="{{ asset('images/carcare.jpg') }}" alt="Carcare Logo"></a>
                </li>
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('cart.index') }}">Cart</a></li>
                <li><a href="{{ route('user.services', $mechanic->id ?? '') }}">Service</a></li>
                <li>
                    <a href="#">{{ Auth::user()->name }}</a>
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

    <div class="container">
        <h2 class="text-center">Products</h2>
        <div class="product-grid">
            @foreach($products as $product)
                <a href="{{ route('product-view', ['id' => $product->id]) }}" class="product-link">
                    <div class="product-card" style="margin-top: 60px">
                        <img src="{{ $product->image ? asset('upload/' . $product->image) : asset('assets/img/default-product.jpg') }}" 
                             alt="{{ $product->ProductName }}" width="300">
                        <div class="details">
                            <h5>{{ $product->ProductName }}</h5>
                            <p class="text-danger">₱{{ number_format($product->Price, 2) }}</p>

                            <!-- Add to Cart Form -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-add">🛒 Add to Cart</button>
                            </form>

                            <!-- Buy Now Form -->
                            <form action="{{ route('payments.buyNow', $product->id) }}" method="GET">
                                <button type="submit" class="btn btn-buy">💳 Buy Now</button>
                            </form>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <div id="chat-button">
        <a href="#" onclick="openChat()" class="chat-icon">
            <i class="fa fa-comment"></i>
        </a>
    </div>

</div>

<script>
    function openChat() {
        alert("Chat feature coming soon!");
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
