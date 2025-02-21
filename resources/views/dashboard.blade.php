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

  <!-- Responsive Search Form Styles -->
  <style>
    .search-wrapper {
      display: flex;
      flex-direction: row;
      align-items: center;
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
    }
    .search-input {
      flex: 1;
      padding: 12px 15px;
      border: 1px solid #ccc;
      border-right: none;
      border-radius: 4px 0 0 4px;
      font-size: 16px;
    }
    .search-button {
      padding: 12px 20px;
      border: 1px solid #ccc;
      background-color: #0C2E5B;
      color: #fff;
      border-left: none;
      border-radius: 0 4px 4px 0;
      cursor: pointer;
      transition: background 0.3s;
    }
    .search-button:hover {
      background-color: #0a2246;
    }
    @media (max-width: 600px) {
      .search-wrapper {
        flex-direction: column;
      }
      .search-input,
      .search-button {
        width: 100%;
        border-radius: 4px;
        margin: 5px 0;
        border: 1px solid #ccc;
      }
      .search-button {
        border-top: none;
      }
    }
  </style>
</head>

<body>
  <div id="">
    <!-- Header / Navigation -->
    <header id="header" class="header-v3">
      <nav class="flat-mega-menu">
        <label for="mobile-button"><i class="fa fa-bars"></i></label>
        <input id="mobile-button" type="checkbox">
        <ul class="collapse">
          <li class="title">
            <a href="index.php.html"><img src="{{ ('images/carcare.jpg') }}" alt="Carcare Logo"></a>
          </li>
          <li>
            <a href="">My Cart</a>
            <ul class="drop-down one-column hover-fade">
              <li><a href="{{ route('cart.index') }}">Cart</a></li>
            </ul>
          </li>
          <li>
            <a href="" {{ Auth::user()->name }}>My Account</a>
            <ul class="drop-down one-column hover-fade">
              <li><a href="{{ route('profile.edit') }}">Profile</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                  </a>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>

    <!-- Banner Section -->
    <section class="tp-banner-container">
      <div class="tp-banner">
        <ul>
          <li data-transition="slidevertical" data-slotamount="1" data-masterspeed="1000"
              data-saveperformance="off" data-title="Slide">
            <img src="{{ ('assets/img/slide/mechanic1.jpeg') }}" alt="Slide 1"
                 data-bgposition="center center" data-kenburns="on" data-duration="6000"
                 data-ease="Linear.easeNone" data-bgfit="130" data-bgfitend="100"
                 data-bgpositionend="right center">
          </li>
          <li data-transition="slidehorizontal" data-slotamount="1" data-masterspeed="1000"
              data-saveperformance="off" data-title="Slide">
            <img src="{{ ('assets/img/slide/car1.jpg') }}" alt="Slide 2" data-bgposition="top center"
                 data-kenburns="on" data-duration="6000" data-ease="Linear.easeNone" data-bgfit="130"
                 data-bgfitend="100" data-bgpositionend="right center">
          </li>
        </ul>
        <div class="tp-bannertimer"></div>
      </div>
      <div class="filter-title">
        <div class="title-header">
          <h2 style="color:#fff;">Visit SHOP</h2>
          <p class="lead">Visit shop at very affordable price,</p>
        </div>
        <!-- Responsive Search Form -->
        <div class="filter-header" style="margin-top: 20px; text-align: center;">
          <form id="searchForm" onsubmit="return false;">
            <div class="search-wrapper">
              <input type="text" name="q" id="searchMechanic" placeholder="Search for a shop name..." class="search-input" autocomplete="off">
              <button type="button" id="searchButton" class="search-button">Search</button>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- Content Section with Shop Cards -->
    <section class="content-central">
      <div class="content_info">
        <div class="container">
          <div class="row">
            <div class="titles">
              <h2>Choose <span>Your Best</span> Repair Shop</h2>
              <i class="fa fa-plane"></i>
              <hr class="tall">
            </div>
          </div>
          <!-- Shop Cards Container -->
          <div class="container" style="margin-top: -50px; padding: 20px;">
            <div class="row">
              @if(isset($mechanics) && $mechanics->count())
                @foreach ($mechanics as $mechanic)
                  <!-- Each shop card has the class "hsgrids" and a data-shopname attribute -->
                  <div class="col-xs-6 col-sm-4 col-md-3 hsgrids" data-shopname="{{ $mechanic->shopname }}" style="padding: 10px; display: flex; justify-content: center;">
                    <div class="info-gallery" style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: box-shadow 0.3s ease, transform 0.3s ease; width: 260px; height: 340px; max-width: 100%;">
                      <div class="showPhoto"
                           style="background-image: url('{{ $mechanic->image ? asset('upload/' . $mechanic->image) : asset('img/avatar.png') }}');
                                  background-size: cover;
                                  background-position: center;
                                  background-repeat: no-repeat;
                                  width: 100%;
                                  height: 250px;
                                  position: relative;
                                  overflow: hidden;
                                  border-top-left-radius: 12px;
                                  border-top-right-radius: 12px;
                                  transition: transform 0.3s ease, box-shadow 0.3s ease;"
                           onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 15px rgba(0, 0, 0, 0.2)'; this.querySelector('.overlay').style.opacity='1';"
                           onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 10px rgba(0, 0, 0, 0.1)'; this.querySelector('.overlay').style.opacity='0';">
                        <!-- Overlay Effect -->
                        <div class="overlay"
                             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                                    background: rgba(0, 0, 0, 0.4); display: flex; justify-content: center;
                                    align-items: center; opacity: 0; transition: opacity 0.3s ease;">
                          <a href="{{ route('user.services', $mechanic->id) }}"
                             class="btn btn-primary"
                             style="padding: 10px 20px; background-color: #ff7f50; border: none;
                                    color: white; border-radius: 8px; text-decoration: none;">
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
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Scripts -->
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

    // Function to filter shops by shopname
    function filterShops() {
      var input = document.getElementById("searchMechanic").value.toLowerCase();
      var shopCards = document.querySelectorAll(".hsgrids");
      shopCards.forEach(function(card) {
        // Try to get the shop name from the data attribute; if not available, use inner text.
        var shopName = card.getAttribute("data-shopname") || card.querySelector(".shop-name span").textContent;
        if (shopName.toLowerCase().indexOf(input) > -1) {
          card.style.display = "";
        } else {
          card.style.display = "none";
        }
      });
    }

    // Attach event listeners to the search input and button
    document.getElementById("searchMechanic").addEventListener("keyup", filterShops);
    document.getElementById("searchButton").addEventListener("click", filterShops);
  </script>
</body>
</html>
