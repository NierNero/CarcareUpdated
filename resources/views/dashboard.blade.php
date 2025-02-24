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
          <li class="title" style="margin-top: 10px">
            <a href="index.php.html"><img src="{{ ('images/carcare.jpg') }}" alt="Carcare Logo"></a>
          </li>
          <li>
            <a href="" style="margin-top: 8px; margin-right: 20px;">My Orders</a>
            <ul class="drop-down one-column hover-fade">
              <li><a href="{{ route('cart.index') }}">Cart</a></li>
              <li><a href="{{ route('orders.index') }}">My Orders</a></li>
            </ul>
          </li>
          <li style="margin-right: 100px;">
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
           <div class="container">  {{--style="margin-top: 10px;" --}}
            <div class="row">
              @if(isset($mechanics) && $mechanics->count())
                @foreach($mechanics as $mechanic)
                  <!-- Each card column with data-shopname attribute for filtering -->
                  <div class="col-xs-12 col-sm-6 col-md-3" style="margin-bottom: 20px;" data-shopname="{{ $mechanic->shopname }}">
                    <div class="card" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">
                      <!-- Top Image -->
                      <div style="background-image: url('{{ $mechanic->image ? asset('upload/' . $mechanic->image) : asset('img/avatar.png') }}'); background-size: cover; background-position: center; height: 180px;"></div>
          
                      <!-- Card Body -->
                      <div class="card-body text-center" style="padding: 15px;">
                        <!-- Shop Name with icon -->
                        <h5 style="font-weight: bold; color: #333; margin-bottom: 5px;">
                          <i class="fa fa-wrench" style="margin-right: 6px;"></i>
                          {{ $mechanic->shopname }}
                        </h5>
          
                        <!-- Location with icon -->
                        <p style="color: #777; margin-bottom: 10px;">
                          <i class="fa fa-map-marker" style="margin-right: 6px;"></i>
                          {{ $mechanic->Address }}
                        </p>
          
                        <!-- Rating Section with icons -->
                        <div style="margin-bottom: 10px;">
                          <i class="fa fa-star" style="color: #FFD700;"></i>
                          <i class="fa fa-star" style="color: #FFD700;"></i>
                          <i class="fa fa-star" style="color: #FFD700;"></i>
                          <i class="fa fa-star" style="color: #FFD700;"></i>
                          <i class="fa fa-star" style="color: #ccc;"></i>
                          <span style="color: #777; font-size: 14px;">(4 Ratings)</span>
                        </div>
          
                        <!-- Buttons -->
                        <div>
                          <a href="{{ route('user.services', $mechanic->id) }}" class="btn btn-primary" style="background-color: #ff7f50; border: none; margin-right: 5px;">Visit Now</a>
                          <a href="{{ route('user.product', $mechanic->id) }}" class="btn btn-primary" style="background-color: #333; border: none;">Shop</a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              @else
                <p class="text-center" style="font-size: 16px; color: #777;">
                  No mechanics available.
                </p>
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

    // Updated search function filtering based on the data-shopname attribute
    function filterShops() {
      var input = document.getElementById("searchMechanic").value.toLowerCase().trim();
      var shopCards = document.querySelectorAll(".col-xs-12.col-sm-6.col-md-3[data-shopname]");
      
      shopCards.forEach(function(card) {
        var shopName = card.getAttribute("data-shopname").toLowerCase();
        if (shopName.indexOf(input) !== -1) {
          card.style.display = "";
        } else {
          card.style.display = "none";
        }
      });
    }

    // Attach event listeners for real-time filtering
    document.getElementById("searchMechanic").addEventListener("keyup", filterShops);
    document.getElementById("searchButton").addEventListener("click", filterShops);
  </script>
</body>
</html>
