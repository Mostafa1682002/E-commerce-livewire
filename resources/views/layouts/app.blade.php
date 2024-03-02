@inject('categories', 'App\Models\Category')
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'E-commerce' }}</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets-front/imgs/theme/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets-front/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-front/css/custom.css') }}">
    {{-- Toster --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
</head>

<body>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li>
                                    <a class="language-dropdown-active" href="#"> <i class="fi-rs-world"></i>
                                        English <i class="fi-rs-angle-small-down"></i></a>
                                    <ul class="language-dropdown">
                                        <li><a href="#"><img
                                                    src="{{ asset('assets-front/imgs/theme/flag-fr.png') }}"
                                                    alt="">Français</a></li>
                                        <li><a href="#"><img
                                                    src="{{ asset('assets-front/imgs/theme/flag-dt.png') }}"
                                                    alt="">Deutsch</a></li>
                                        <li><a href="#"><img
                                                    src="{{ asset('assets-front/imgs/theme/flag-ru.png') }}"
                                                    alt="">Pусский</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li>Get great devices up to 50% off <a href="{{ route('shop') }}">View details</a>
                                    </li>
                                    <li>Supper Value Deals - Save more with coupons</li>
                                    <li>Trendy 25silver jewelry, save up 35% off today <a
                                            href="{{ route('shop') }}">Shop now</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                @auth
                                    <li>
                                        <i class="fi-rs-user"></i><a
                                            href="{{ route('my_account') }}">{{ auth()->user()->name }}</a> / <a
                                            href="#"
                                            onclick="event.preventDefault();document.getElementById('form_logout').submit()">Logout</a>
                                        <form action="{{ route('logout') }}" method="POST" id="form_logout">
                                            @csrf
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <i class="fi-rs-key"></i><a href="{{ route('login.form') }}">Log In </a> / <a
                                            href="{{ route('register.form') }}">Sign Up</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="{{ route('home') }}"><img src="{{ \App\Models\Setting::first()->logo }}"
                                alt="logo"></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-1">
                            <form action="{{ route('shop') }}">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search for items...">
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                @livewire('wishlist-iconcomponent')
                                @livewire('cart-icon-component')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="{{ route('home') }}"><img src="{{ \App\Models\Setting::first()->logo }}"
                                alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categori-button-active" href="#">
                                <span class="fi-rs-apps"></span> Browse Categories
                            </a>
                            <div class="categori-dropdown-wrap categori-dropdown-active-large">
                                <ul>
                                    @foreach ($categories->all() as $category)
                                        <li><a href="{{ route('shop') }}"><i
                                                    class="surfsidemedia-font-high-heels"></i>{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li><a class="{{ $title == 'Home' ? 'active' : '' }}"
                                            href="{{ route('home') }}">Home
                                        </a></li>
                                    <li><a class="{{ $title == 'About' ? 'active' : '' }}"
                                            href="{{ route('about') }}">About</a></li>
                                    <li><a class="{{ $title == 'Shop' || $title == 'Details Product' ? 'active' : '' }}"
                                            href="{{ route('shop') }}">Shop</a></li>
                                    <li><a class="{{ $title == 'Contact' ? 'active' : '' }}"
                                            href="{{ route('contact') }}">Contact</a></li>
                                    @auth
                                        <li><a class="{{ $title == 'My Account' ? 'active' : '' }}"
                                                href="{{ route('my_account') }}">My Account</a>
                                        </li>
                                    @endauth
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-block">
                        <p><i class="fi-rs-smartphone"></i><span>Toll Free</span>
                            {{ \App\Models\Setting::first()->phone }}</p>
                    </div>
                    <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%
                    </p>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">

                            @livewire('wishlist-icon-component')
                            @livewire('cart-icon-component')
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{ route('home') }}"><img src="{{ \App\Models\Setting::first()->logo }}"
                            alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="{{ route('shop') }}">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search for items…">
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <div class="main-categori-wrap mobile-header-border">
                        <a class="categori-button-active-2" href="#">
                            <span class="fi-rs-apps"></span> Browse Categories
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-small">
                            <ul>
                                @foreach ($categories->all() as $category)
                                    <li><a href="{{ route('shop') }}"><i
                                                class="surfsidemedia-font-high-heels"></i>{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                    href="{{ route('home') }}">Home</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                    href="{{ route('shop') }}">shop</a></li>
                            @auth
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                        href="{{ route('my_account') }}">My Account</a></li>
                            @endauth
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                    href="#">Language</a>
                                <ul class="dropdown">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Spanish</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                    <div class="single-mobile-header-info mt-30">
                        <a href="{{ route('contact') }}"> Contact </a>
                    </div>
                    @auth
                        <div class="single-mobile-header-info">
                            <a href="{{ route('my_account') }}">{{ auth()->user()->name }} </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="#"
                                onclick="event.preventDefault();document.getElementById('form_logout_m').submit()">Logout</a>
                            <form action="{{ route('logout') }}" method="POST" id="form_logout_m">
                                @csrf
                            </form>
                        </div>
                    @else
                        <div class="single-mobile-header-info">
                            <a href="{{ route('login.form') }}">Log In </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('register.form') }}">Sign Up</a>
                        </div>
                    @endauth
                    <div class="single-mobile-header-info">
                        <a href="#">(+1) 0000-000-000 </a>
                    </div>
                </div>
                <div class="mobile-social-icon">
                    <h5 class="mb-15 text-grey-4">Follow Us</h5>
                    <a href="#"><img src="{{ asset('assets-front/imgs/theme/icons/icon-facebook.svg') }}"
                            alt=""></a>
                    <a href="#"><img src="{{ asset('assets-front/imgs/theme/icons/icon-twitter.svg') }}"
                            alt=""></a>
                    <a href="#"><img src="{{ asset('assets-front/imgs/theme/icons/icon-instagram.svg') }}"
                            alt=""></a>
                    <a href="#"><img src="{{ asset('assets-front/imgs/theme/icons/icon-pinterest.svg') }}"
                            alt=""></a>
                    <a href="#"><img src="{{ asset('assets-front/imgs/theme/icons/icon-youtube.svg') }}"
                            alt=""></a>
                </div>
            </div>
        </div>
    </div>
    {{ $slot ?? '' }}
    @yield('content')
    <footer class="main">
        <section class="newsletter p-30 text-white wow fadeIn animated">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-md-3 mb-lg-0">
                        <div class="row align-items-center">
                            <div class="col flex-horizontal-center">
                                <img class="icon-email"
                                    src="{{ asset('assets-front/imgs/theme/icons/icon-email.svg') }}" alt="">
                                <h4 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h4>
                            </div>
                            <div class="col my-4 my-md-0 des">
                                <h5 class="font-size-15 ml-4 mb-0">...and receive <strong>$25 coupon for first
                                        shopping.</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- Subscribe Form -->
                        <form class="form-subcriber d-flex wow fadeIn animated">
                            <input type="email" class="form-control bg-white font-small"
                                placeholder="Enter your email">
                            <button class="btn bg-dark text-white" type="submit">Subscribe</button>
                        </form>
                        <!-- End Subscribe Form -->
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <a href="{{ route('home') }}"><img src="{{ \App\Models\Setting::first()->logo }}"
                                        alt="logo"></a>
                            </div>
                            <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5>
                            <p class="wow fadeIn animated">
                                <strong>Address: </strong>{{ \App\Models\Setting::first()->address }}
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Phone: </strong>{{ \App\Models\Setting::first()->phone }}
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Email: </strong>{{ \App\Models\Setting::first()->email }}
                            </p>
                            <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Follow Us</h5>
                            <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                                <a href="{{ \App\Models\Setting::first()->face_link }}"><img
                                        src="{{ asset('assets-front/imgs/theme/icons/icon-facebook.svg') }}"
                                        alt=""></a>
                                <a href="{{ \App\Models\Setting::first()->tw_link }}"><img
                                        src="{{ asset('assets-front/imgs/theme/icons/icon-twitter.svg') }}"
                                        alt=""></a>
                                <a href="{{ \App\Models\Setting::first()->ins_link }}"><img
                                        src="{{ asset('assets-front/imgs/theme/icons/icon-instagram.svg') }}"
                                        alt=""></a>

                                <a href="{{ \App\Models\Setting::first()->you_link }}"><img
                                        src="{{ asset('assets-front/imgs/theme/icons/icon-youtube.svg') }}"
                                        alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title wow fadeIn animated">About</h5>
                        <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="#">Delivery Information</a></li>
                            <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms_condistions') }}">Terms &amp; Conditions</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2  col-md-3">
                        <h5 class="widget-title wow fadeIn animated">My Account</h5>
                        <ul class="footer-list wow fadeIn animated">
                            @auth
                                <li><a href="{{ route('my_account') }}">My Account</a></li>
                            @endauth
                            <li><a href="{{ route('cart') }}">View Cart</a></li>
                            <li><a href="{{ route('wishlist') }}">My Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="{{ route('my_account') }}">Order</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 mob-center">
                        <h5 class="widget-title wow fadeIn animated">Install App</h5>
                        <div class="row">
                            <div class="col-md-8 col-lg-12">
                                <p class="wow fadeIn animated">From App Store or Google Play</p>
                                <div class="download-app wow fadeIn animated mob-app">
                                    <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active"
                                            src="{{ asset('assets-front/imgs/theme/app-store.jpg') }}"
                                            alt=""></a>
                                    <a href="#" class="hover-up"><img
                                            src="{{ asset('assets-front/imgs/theme/google-play.jpg') }}"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                                <p class="mb-20 wow fadeIn animated">Secured Payment Gateways</p>
                                <img class="wow fadeIn animated"
                                    src="{{ asset('assets-front/imgs/theme/payment-method.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated mob-center">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">
                        <a href="{{ route('privacy_policy') }}">Privacy Policy</a> | <a
                            href="{{ route('terms_condistions') }}">Terms &
                            Conditions</a>
                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        &copy; {{ date('Y') }} <strong class="text-brand">Mostafa Hossam</strong> All rights
                        reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Vendor JS-->
    <script src="{{ asset('assets-front/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets-front/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets-front/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets-front/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('assets-front/js/main.js?v=3.3') }}"></script>
    <script src="{{ asset('assets-front/js/shop.js?v=3.3') }}"></script>

    {{-- Toster --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @livewireScripts

    @stack('js')
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif
    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

</body>

</html>
