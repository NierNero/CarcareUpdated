<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ ('assets/img/favicon.png') }}">
    <link href="{{ ('assets/css/style.css') }}" rel="stylesheet" media="screen">
    <link href="{{ ('assets/css/chblue.css') }}" rel="stylesheet" media="screen">
    <link href="{{ ('assets/css/theme-responsive.css') }}" rel="stylesheet" media="screen">
    <link href="{{ ('assets/css/dtb/jquery.dataTables.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ ('assets/css/select2.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ ('assets/css/toastr.min.css') }}" rel="stylesheet" media="screen">
    <script type="text/javascript" src="{{ ('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/jquery-ui.1.10.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/modernizr.js') }}"></script>
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
            transform: scale(1.1); /* Makes it slightly bigger when hovered */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }
    
        #chat-button .chat-icon {
            color: white;
            font-size: 24px; /* Increases the chat icon size */
            text-decoration: none;
        }
    </style>
    
    <div id="">
        <div class="info-head">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="visible-md visible-lg text-left">
                            <li><a href="tel:+911234567890"><i class="fa fa-phone"></i> +91-1234567890</a></li>
                            <li><a href="mailto:contact@surfsidemedia.in"><i class="fa fa-envelope"></i>
                                    contact@carcaremedia.in</a></li>
                        </ul>
                        <ul class="visible-xs visible-sm">
                            <li class="text-left"><a href="tel:+911234567890"><i class="fa fa-phone"></i>
                                    +91-1234567890</a></li>
                            <li class="text-right"><a href="index.php/changelocation.html"><i
                                        class="fa fa-map-marker"></i> University of High Blood</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="visible-md visible-lg text-right">
                            <li><i class="fa fa-comment"></i> Live Chat</li>
                            <li><a href="index.php/changelocation.html"><i class="fa fa-map-marker"></i> University of
                                    High Blood</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <header id="header" class="header-v3">
            <nav class="flat-mega-menu">
                <label for="mobile-button"> <i class="fa fa-bars"></i></label>
                <input id="mobile-button" type="checkbox">

                <ul class="collapse">
                    <li class="title">
                        <a href="index.php.html"><img src="{{ ('images/carcare.jpg') }}"></a>
                    </li>
                    <li> <a href="">My Cart</a>
                        <ul class="drop-down one-column hover-fade">
                            <li><a href="{{ route('cart') }}">Cart</a></li>
                        </ul>
                    </li>


                    </li>
                    <li> <a href="" {{ Auth::user()->name }}>My Account</a>
                        <ul class="drop-down one-column hover-fade">
                            <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    <a href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                    @csrf
                            </li>
                        </ul>



                    </li>

            </nav>
        </header>
        <section class="tp-banner-container">
            <div class="tp-banner">
                <ul>
                    <li data-transition="slidevertical" data-slotamount="1" data-masterspeed="1000"
                        data-saveperformance="off" data-title="Slide">
                        <img src="{{ ('assets/img/slide/mechanic1.jpeg') }}" alt="fullslide1"
                            data-bgposition="center center" data-kenburns="on" data-duration="6000"
                            data-ease="Linear.easeNone" data-bgfit="130" data-bgfitend="100"
                            data-bgpositionend="right center">
                    </li>

                    <li data-transition="slidehorizontal" data-slotamount="1" data-masterspeed="1000"
                        data-saveperformance="off" data-title="Slide">
                        <img src="{{ ('assets/img/slide/car1.jpg') }}" alt="fullslide1" data-bgposition="top center"
                            data-kenburns="on" data-duration="6000" data-ease="Linear.easeNone" data-bgfit="130"
                            data-bgfitend="100" data-bgpositionend="right center">
                    </li>

                </ul>
                <div class="tp-bannertimer"></div>
            </div>
            <div class="filter-title">
                <div class="title-header">
                    <h2 style="color:#fff;">Visit SHOP</h2>
                    <p class="lead">Visit shop at very affordable price, </p>
                </div>
                <div class="filter-header" style="margin-top: 20px; text-align: center;">
                    <form id="form" action="{{ route('dashboard') }}" method="GET">
                        @csrf
                        <input type="text" name="q" id="searchMechanic" placeholder="Search for a mechanic..."
                            class="input-large typeahead" autocomplete="off">
                        <input type="submit" name="submit" value="Search">
                    </form>
                </div>

            </div>
        </section>
        <section class="content-central">
            <div class="content_info content_resalt">
                <div class="container" style="margin-top: 40px;">
                    <div class="row">
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
            </div>
            <div class="semiboxshadow text-center">
                <img src="{{ ('assets/img/img-theme/shp.png') }}" class="img-responsive" alt="">
            </div>
            <div class="content_info">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="titles">
                                <h2>Choose <span>Your Best</span> Repair Shop</h2>
                                <i class="fa fa-plane"></i>
                                <hr class="tall">
                            </div>
                        </div>
                        <div class="portfolioContainer"
                            style="margin-top: -50px; display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; padding: 20px;">
                            @if(isset($mechanics) && $mechanics->count())
                                        @foreach ($mechanics as $mechanic)
                                                    <div class="col-xs-6 col-sm-4 col-md-3 hsgrids"
                                                        style="padding: 10px; display: flex; justify-content: center;">
                                                        <div class="info-gallery" style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: box-shadow 0.3s ease, transform 0.3s ease; 
                                            width: 260px; height: 340px; max-width: 100%;">

                                                            <div class="showPhoto" style="
                                                background-image: url('{{ $mechanic->image ? asset('upload/' . $mechanic->image) : asset('img/avatar.png') }}');
                                                background-size: cover;
                                                background-position: center;
                                                background-repeat: no-repeat;
                                                width: 100%;
                                                height: 250px;
                                                position: relative;
                                                overflow: hidden;
                                                border-top-left-radius: 12px;
                                                border-top-right-radius: 12px;
                                                transition: transform 0.3s ease, box-shadow 0.3s ease;
                                            " onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 15px rgba(0, 0, 0, 0.2)'; this.querySelector('.overlay').style.opacity='1';"
                                                                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 10px rgba(0, 0, 0, 0.1)'; this.querySelector('.overlay').style.opacity='0';">

                                                                <!-- Overlay Effect -->
                                                                <div class="overlay" style="
                                                    position: absolute;
                                                    top: 0;
                                                    left: 0;
                                                    width: 100%;
                                                    height: 100%;
                                                    background: rgba(0, 0, 0, 0.4);
                                                    display: flex;
                                                    justify-content: center;
                                                    align-items: center;
                                                    opacity: 0;
                                                    transition: opacity 0.3s ease;
                                                ">
                                                                    <a href="{{ route('user.services', $mechanic->id) }}"
                                                                        class="btn btn-primary"
                                                                        style="padding: 10px 20px; background-color: #ff7f50; border: none; color: white; border-radius: 8px; text-decoration: none;">
                                                                        View Shop
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="shop-name"
                                                                style="padding: 15px; text-align: center; font-weight: bold; font-size: 18px; color: #333;">
                                                                <span>{{ $mechanic->shopname }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                        @endforeach
                            @else
                                <p style="text-align: center; font-size: 16px; color: #777;">No mechanics available.</p>
                            @endif
                        </div>


                        </a>
                    </div>


                </div>
            </div>
    </div>
    </div>
    <div id="chat-button">
        <a href="#" onclick="openChat()" class="chat-icon">
            <i class="fa fa-comment"></i>
        </a>
    </div>

    <script>
        // JavaScript to trigger chat window (Example)
        function openChat() {
            alert("Chat feature coming soon!");
            // You can replace this with your chat window integration
        }
    </script>

    </section>

    </div>
    <script type="text/javascript" src="{{ ('assets/js/nav/jquery.sticky.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/totop/jquery.ui.totop.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/accordion/accordion.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/maps/gmap3.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/fancybox/jquery.fancybox.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/carousel/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/filters/jquery.isotope.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/twitter/jquery.tweet.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/flickr/jflickrfeed.min.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/theme-options/theme-options.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/theme-options/jquery.cookies.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/bootstrap/bootstrap-slider.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/dtb/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/dtb/jquery.table2excel.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/dtb/script.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/validation-rule.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/bootstrap3-typeahead.min.js') }}"></script>
    <script type="text/javascript" src="{{ ('assets/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    
</body>

</html>

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