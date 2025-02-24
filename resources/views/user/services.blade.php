<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/chblue.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/theme-responsive.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/dtb/jquery.dataTables.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" media="screen">

    <!-- Scripts (jQuery first) -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.1.10.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/modernizr.js') }}"></script>

    <style>
        /* Floating Chat Button */
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
            margin-bottom: 32px;
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
    </style>
</head>

<body>
    <!-- HEADER / NAVIGATION -->
    <header id="header" class="header-v3">
        <nav class="flat-mega-menu">
            <label for="mobile-button"><i class="fa fa-bars"></i></label>
            <input id="mobile-button" type="checkbox">
            <ul class="collapse">
                <!-- Brand / Logo -->
                <li class="title" style="margin-top: 10px">
                    <a href="index.php.html">
                        <img src="{{ asset('images/carcare.jpg') }}" alt="Carcare Logo">
                    </a>
                </li>
                <!-- Navigation Items -->
                <li style="margin-top: 7px">
                    <a href="{{ route('cart.index') }}">My Cart</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('user.product', $mechanic->id) }}">Shop</a>
                </li>
                <li style="margin-right: 100px;">
                    <a href="{{ Auth::user()->name }}">My Account</a>
                    <ul class="drop-down one-column hover-fade">
                        <li>
                            <a href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <!-- REDESIGNED "BOOK A SERVICE" BANNER -->
    <section 
        style="
            background: url('{{ asset('assets/img/slide/mechanic1.jpeg') }}') center center/cover no-repeat;
            padding: 60px 0;
            position: relative;
            min-height: 300px;
        "
    >
        <!-- Dark overlay to improve text readability (optional) -->
        <div 
            style="
                position: absolute; 
                top: 0; 
                left: 0; 
                width: 100%; 
                height: 100%; 
                background: rgba(0, 0, 0, 0.4);
                z-index: 1;
            "
        ></div>

        <div class="container text-center" style="position: relative; z-index: 2;">
            <h2 style="color: #fff; font-size: 36px; margin-top: 50px">
                BOOK A SERVICE
            </h2>
            <p class="lead" style="color: #fff;">
                Book a service at a very affordable price
            </p>
            <!-- Search Form -->
        </div>
    </section>

    <!-- MAIN SERVICES SECTION -->
    <section style="padding: 60px 0; background-color: #f9f9f9;">
        <div class="container">

            <!-- Services Grid -->
            <div class="row justify-content-center">
                @if($mechanic->services->isEmpty())
                    <p class="text-center text-muted">No services found.</p>
                @else
                    @foreach($mechanic->services as $service)
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                            <div 
                                class="card h-100"
                                style="
                                    border: none; 
                                    border-radius: 8px; 
                                    overflow: hidden; 
                                    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                                "
                            >
                                <!-- Service Image -->
                                <img 
                                    src="{{ $service->image ? asset('upload/' . $service->image) : asset('img/default_service.jpg') }}"
                                    alt="{{ $service->name }}"
                                    style="width: 100%; height: 120px; object-fit: cover;"
                                />
                                <!-- Card Body -->
                                <div class="card-body text-center">
                                    <h5 class="card-title" style="margin-bottom: 10px;">
                                        {{ $service->name }}
                                    </h5>
                                    <p class="card-text text-primary font-weight-bold" style="margin-bottom: 10px;">
                                        ${{ $service->price }}
                                    </p>
                                    <a href="#" class="btn btn-primary">
                                        Book Now
                                    </a>
                                </div>
                            </div> <!-- /card -->
                        </div> <!-- /col -->
                    @endforeach
                @endif
            </div> <!-- /row -->
        </div> <!-- /container -->
    </section>

    <!-- FLOATING CHAT BUTTON (unchanged) -->
    <div id="chat-button">
        <a href="#" onclick="openChat()" class="chat-icon">
            <i class="fa fa-comment"></i>
        </a>
    </div>
    <script>
        function openChat() {
            alert("Chat feature coming soon!");
        }
    </script>

    <!-- SCRIPTS -->
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

    <!-- Initialize Revolution Slider (if used) -->
    <script type="text/javascript">
        jQuery(document).ready(function () {
            // Only if .tp-banner is present for Revolution Slider
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
