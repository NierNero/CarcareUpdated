<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SurfsideMedia - Online Service Provider for your House Needs</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link href="assets/css/style.css" rel="stylesheet" media="screen">
    <link href="assets/css/chblue.css" rel="stylesheet" media="screen">
    <link href="assets/css/theme-responsive.css" rel="stylesheet" media="screen">
    <link href="assets/css/dtb/jquery.dataTables.min.css" rel="stylesheet" media="screen">
    <link href="assets/css/select2.min.css" rel="stylesheet" media="screen">
    <link href="assets/css/toastr.min.css" rel="stylesheet" media="screen">        
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.1.10.4.min.js"></script>
    <script type="text/javascript" src="assets/js/toastr.min.js"></script>
    <script type="text/javascript" src="assets/js/modernizr.js"></script>
</head>
<body>
    <div id="layout">
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
                            <li><a href="index.php/changelocation.html"><i class="fa fa-map-marker"></i> University of High Blood</a></li>
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
                    <li> <a href="{{ route('dashboard') }}">Home</a>
                    </li>

                    <li> <a href="{{ route('usershop') }}">Shop</a>
                    </li>

                    </li>    
                    <li> <a href="{{ Auth::user()->name }}">My Account</a>
                            <ul class="drop-down one-column hover-fade">
                                <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><form method="POST" action="{{ route('logout') }}">
                    <a href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                        </a>
                    @csrf
                    </li>
                            </ul>

                    
                            
                    </li>

            </nav>
        </header>
        <div class="section-title-01 honmob">
            <div class="bg_parallax image_01_parallax"></div>
            <div class="opacy_bg_02">
                <div class="container">
                    <h1>AC Services</h1>
                    <div class="crumbs">
                        <ul>
                            <li><a href="{{ route('services') }}">Home</a></li>
                            <li>/</li>
                            <li>AC</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section class="content-central">
            <div class="container">
                <div class="row" style="margin-top: -30px;">
                    <div class="titles">
                        <h2>AC <span>Services</span></h2>
                        <i class="fa fa-plane"></i>
                        <hr class="tall">
                    </div>
                </div>
            </div>
            <div class="content_info" style="margin-top: -70px;">
                <div>
                    <div class="container">
                        <div class="portfolioContainer">
                            <div class="col-xs-6 col-sm-4 col-md-3 nature hsgrids"
                                style="padding-right: 5px;padding-left: 5px;">
                                <a class="g-list" href="service-details/ac-wet-servicing.html">
                                    <div class="img-hover">
                                        <img src="images/services/thumbnails/thumbnail.jpg" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="info-gallery">
                                        <h3>AC Wet Servicing</h3>
                                        <hr class="separator">
                                        <p>AC Wet Servicing</p>
                                        <div class="content-btn"><a href="service-details/ac-wet-servicing.html"
                                                class="btn btn-primary">Book Now</a></div>
                                        <div class="price"><span>&#36;</span><b>From</b>200</div>
                                    </div>
                                </a>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>            
        </section>
        <footer id="footer" class="footer-v1">
            <div class="container">
                <div class="row visible-sm visible-xs">
                    <div class="col-md-6">
                        <h3 class="mlist-h">CONTACT US</h3>
                        <ul class="contact_footer mlist">
                            <li class="location">
                                <i class="fa fa-map-marker"></i> <a href="#"> Faridabad, Haryana, India</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> <a
                                    href="mailto:contact@surfsidemedia.in">contact@surfsidemedia.in</a>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> <a href="tel:+911234567890">+91-1234567890</a>
                            </li>
                        </ul>
                        <ul class="social mlist-h">
                            <li class="facebook"><span><i class="fa fa-facebook"></i></span><a href="#"></a></li>
                            <li class="twitter"><span><i class="fa fa-twitter"></i></span><a href="#"></a></li>
                            <li class="github"><span><i class="fa fa-instagram"></i></span><a href="#"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-down">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="nav-footer">
                                <li><a href="about-us.html">About Us</a> </li>
                                <li><a href="contact-us.html">Contact Us</a></li>
                                <li><a href="terms-of-use.html">Terms of Use</a></li>
                                <li><a href="privacy.html">Privacy</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <p class="text-xs-center crtext">&copy; 2024 Carcare. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>                
            </div>            
        </footer>
    </div>
    <script type="text/javascript" src="assets/js/nav/jquery.sticky.js"></script>
    <script type="text/javascript" src="assets/js/totop/jquery.ui.totop.js"></script>
    <script type="text/javascript" src="assets/js/accordion/accordion.js"></script>
    <script type="text/javascript" src="assets/js/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="assets/js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="assets/js/maps/gmap3.js"></script>
    <script type="text/javascript" src="assets/js/fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="assets/js/carousel/carousel.js"></script>
    <script type="text/javascript" src="assets/js/filters/jquery.isotope.js"></script>
    <script type="text/javascript" src="assets/js/twitter/jquery.tweet.js"></script>
    <script type="text/javascript" src="assets/js/flickr/jflickrfeed.min.js"></script>
    <script type="text/javascript" src="assets/js/theme-options/theme-options.js"></script>
    <script type="text/javascript" src="assets/js/theme-options/jquery.cookies.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/bootstrap-slider.js"></script>
    <script type="text/javascript" src="assets/js/dtb/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/dtb/jquery.table2excel.js"></script>
    <script type="text/javascript" src="assets/js/dtb/script.js"></script>
    <script type="text/javascript" src="assets/js/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="assets/js/validation-rule.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>