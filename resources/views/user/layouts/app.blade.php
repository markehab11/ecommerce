<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Home Version One || limupa - Digital Products Store eCommerce Bootstrap 4 Template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="/assets/user/images/favicon.png">
        <!-- Material Design Iconic Font-V2.2.0 -->
        <link rel="stylesheet" href="/assets/user/css/material-design-iconic-font.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/assets/user/css/font-awesome.min.css">
        <!-- Font Awesome Stars-->
        <link rel="stylesheet" href="/assets/user/css/fontawesome-stars.css">
        <!-- Meanmenu CSS -->
        <link rel="stylesheet" href="/assets/user/css/meanmenu.css">
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="/assets/user/css/owl.carousel.min.css">
        <!-- Slick Carousel CSS -->
        <link rel="stylesheet" href="/assets/user/css/slick.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="/assets/user/css/animate.css">
        <!-- Jquery-ui CSS -->
        <link rel="stylesheet" href="/assets/user/css/jquery-ui.min.css">
        <!-- Venobox CSS -->
        <link rel="stylesheet" href="/assets/user/css/venobox.css">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="/assets/user/css/nice-select.css">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="/assets/user/css/magnific-popup.css">
        <!-- Bootstrap V4.1.3 Fremwork CSS -->
        <link rel="stylesheet" href="/assets/user/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Helper CSS -->
        <link rel="stylesheet" href="/assets/user/css/helper.css">
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="/assets/user/css/style.css">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="/assets/user/css/responsive.css">
        <!-- Modernizr js -->
        <script src="/assets/user/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="/assets/user/http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
        <!-- Begin Body Wrapper -->
        <div class="body-wrapper">
            <!-- Begin Header Area -->
            <header>
                <!-- Begin Header Top Area -->
                @include('user.layouts.header')
                <!-- Mobile Menu Area End Here -->
            </header>

            <!-- Li's Trendding Products Area End Here -->
            <!-- Begin Footer Area -->

            @yield('content')

            @include('user.layouts.footer')
            <!-- Footer Area End Here -->
            <!-- Begin Quick View | Modal Area -->

            <!-- Quick View | Modal Area End Here -->

        </div>
        <!-- Body Wrapper End Here -->
        <!-- jQuery-V1.12.4 -->
        <script src="/assets/user/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @if(session()->has('message'))
            <script>
                toastr.success(`{{ session()->get('message') }}`, 'Shopy')
            </script>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $error)
            <script>
                toastr.error(`{{ $error }}`, 'Shopy')
            </script>
        @endforeach
        @endif
        <!-- Popper js -->
        <script src="/assets/user/js/vendor/popper.min.js"></script>
        <!-- Bootstrap V4.1.3 Fremwork js -->
        <script src="/assets/user/js/bootstrap.min.js"></script>
        <!-- Ajax Mail js -->
        <script src="/assets/user/js/ajax-mail.js"></script>
        <!-- Meanmenu js -->
        <script src="/assets/user/js/jquery.meanmenu.min.js"></script>
        <!-- Wow.min js -->
        <script src="/assets/user/js/wow.min.js"></script>
        <!-- Slick Carousel js -->
        <script src="/assets/user/js/slick.min.js"></script>
        <!-- Owl Carousel-2 js -->
        <script src="/assets/user/js/owl.carousel.min.js"></script>
        <!-- Magnific popup js -->
        <script src="/assets/user/js/jquery.magnific-popup.min.js"></script>
        <!-- Isotope js -->
        <script src="/assets/user/js/isotope.pkgd.min.js"></script>
        <!-- Imagesloaded js -->
        <script src="/assets/user/js/imagesloaded.pkgd.min.js"></script>
        <!-- Mixitup js -->
        <script src="/assets/user/js/jquery.mixitup.min.js"></script>
        <!-- Countdown -->
        <script src="/assets/user/js/jquery.countdown.min.js"></script>
        <!-- Counterup -->
        <script src="/assets/user/js/jquery.counterup.min.js"></script>
        <!-- Waypoints -->
        <script src="/assets/user/js/waypoints.min.js"></script>
        <!-- Barrating -->
        <script src="/assets/user/js/jquery.barrating.min.js"></script>
        <!-- Jquery-ui -->
        <script src="/assets/user/js/jquery-ui.min.js"></script>
        <!-- Venobox -->
        <script src="/assets/user/js/venobox.min.js"></script>
        <!-- Nice Select js -->
        <script src="/assets/user/js/jquery.nice-select.min.js"></script>
        <!-- ScrollUp js -->
        <script src="/assets/user/js/scrollUp.min.js"></script>
        <!-- Main/Activator js -->
        <script src="/assets/user/js/main.js"></script>
    </body>

<!-- index30:23-->
</html>
