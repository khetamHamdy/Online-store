<!DOCTYPE html>
<html @if(app()->getLocale() == 'ar')
lang="ar" dir="rtl"
@else
lang="en" dir="ltr"
@endif
>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Collab KW</title>
    <!-- Stylesheets -->
    <link rel="icon" href="{{$setting->fav_icon}}">
    <link href="{{asset('website/css/style.css')}}" rel="stylesheet">
    <!-- Responsive -->
    <link href="{{asset('website/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]>
    <script src="{{asset('website/js/respond.js')}}"></script><![endif]-->
    <script src="{{asset('website/js/jquery-3.2.1.min.js')}}"></script>
    <style>
    :root {
        --main-color: <?php echo $setting->color_webSite;
        ?>;
    }
    </style>
</head>
@yield('css')
@include('sweetalert::alert')
<livewire:styles />
<livewire:scripts />

<body>

    <div class="main-wrapper">


        <header id="header">
            <div class="container">
                <div class="hd-left">
                    <div class="logo-site">
                        <a href="{{route('home')}}">
                            <h4>{{$setting->title}}</h4>
                        </a>
                    </div>
                    <div class="deliver-hd">
                        <i class="fa-solid fa-location-dot"></i>
                        <a href="">
                            <span>{{__('cp.deliver_to')}}</span>
                            {{$setting->Delivery_company_name}}
                        </a>
                    </div>
                    <div class="lang-site">
                        <a href="index.blade.php" class="page-scroll">
                            <i class="fa-solid fa-globe"></i>
                            العربية
                        </a>
                    </div>
                </div>
                <div class="search-hd">
                    <form class="form-search" method="get" action="{{route('search.products')}}">
                        <i class="fa-solid fa-magnifying-glass">
                            <button type="button"></button>
                        </i>
                        <input type="text" value="{{old('title')}}" name="title" class="form-control"
                            placeholder="{{__('cp.SearchHere')}}" />
                    </form>
                </div>

                <ul class="main_menu clearfix">
                    <li>
                        <form action="{{route('currency.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <select class="form-control" name="currency_code" onchange="this.form.submit()">
                                    <option value="USD" @selected('USD', session('currency_code') )>USD $</option>
                                    <option value="EUR" @selected('EUR', session('currency_code') )>EUR €</option>
                                    <option value="GBP" @selected('GBP', session('currency_code') )>GBP £</option>
                                    <option value="JPY" @selected('JPY', session('currency_code') )>JPY ¥</option>
                                </select>
                            </div>

                        </form>

                    </li>


                    <li class="lang-site">

                        @if(getLocal() == 'en')
                        <a class="page-scroll" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                            <i class="fa-solid fa-globe"></i>
                            العربية
                        </a>
                        @else
                        <a class="page-scroll" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                            <i class="fa-solid fa-globe"></i>
                            English</a>
                        @endIf
                    </li>
                    @guest()
                    <li>
                        <a class="page-scroll" href="{{ route('login.form') }}">
                            <i class="fa-regular fa-user"></i>
                            Login / Sign Up
                        </a>


                    </li>
                    @endguest

                    @auth('web')
                    <li>
                        <a class="page-scroll" href="{{ route('profile') }}">
                            <i class="fa-regular fa-user"></i>
                            {{Auth('web')->user()->user_name}}
                        </a>
                    </li>
                    @endauth

                    <li>

                        <a class="page-scroll" href="{{route('cart.index')}}">
                            <i class="fa-solid fa-cart-shopping"></i>
                            {{__('cp.cart')}}

                            <livewire:cart-counter>

                        </a>

                    </li>

                </ul>




                <div class="opt-mobail">
                    <ul>
                        {{-- <li class="hamburger">--}}
                        <option>GBP £</option>
                        {{-- <i class="fa-solid fa-bars"></i>--}}
                        {{-- <p>More</p>--}}
                        {{-- </li>--}}
                        <li class="user">
                            <a href="{{ route('login.form') }}">
                                <i class="fa-solid fa-user"></i>
                                <p>{{__('cp.login')}}</p>
                            </a>
                        </li>
                        <li class="cart">
                            <a href="{{route('cart.index')}}">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <p>{{__('cp.cart')}}</p>
                            </a>
                        </li>
                        <li class="home active">
                            <a href="{{route('home')}}">
                                <i class="fa-solid fa-house"></i>
                                <p>{{__('cp.home')}}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <!--header-->
        @include('sweetalert::alert')

        @yield('content')

        <footer id="footer">
            <div class="top-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="cont-ft wow fadeInUp">
                                <figure class="logo-ft wow fadeInUp">
                                    <img src="{{asset($setting->app_logo)}}" alt="Logo" class="img-fluid">
                                </figure>
                                <ul class="social-media">
                                    <li><a href="{{ $setting->facebook }}"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li><a href="{{$setting->twitter}}"><i class="fa-brands fa-twitter"></i></a></li>
                                    <li><a href="{{$setting->instagram}}"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="menu-ft">
                                <h5>{{__('cp.UsefulLinks')}}</h5>
                                <ul class="li-ft wow fadeInUp">
                                    <li><a href="{{ route('pages', 'about-us') }}">{{__('cp.AboutUs')}}</a></li>
                                    <li><a href="{{ route('pages', 'contact-us') }}">{{__('cp.ContactUs')}}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="menu-ft">
                                <h5>{{__('cp.terms')}}</h5>
                                <ul class="li-ft wow fadeInUp">
                                    <li><a href="{{ route('pages', 'terms-of-use') }}">{{__('cp.TAC')}}</a></li>
                                    <li><a href="{{ route('pages', 'privacy-policy') }}">{{__('cp.PrivacyPolicy')}}</a>
                                    </li>
                                    <li><a
                                            href="{{ route('pages', 'return_policy_page') }}">{{__('cp.ReturnPolicy')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="menu-ft">
                                <h5>{{__('cp.contact')}}</h5>
                                <ul class="list-contact wow fadeInUp">
                                    <li>
                                        <p>
                                            {{$setting->description_contact}}
                                        </p>
                                    </li>
                                    <li>
                                        <a href="mailto:info@collabekw.com">
                                            {{$setting->info_email}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-ft">
                <div class="container">
                    <div class="cont-bt">
                        <p class="copyRight wow fadeInUp">Copyright © 2023 CollabKW - All Rights Reserved</p>
                        <p>Powered By <a href="https://hexacit.com/">HexaCIT</a></p>
                    </div>

                </div>
            </div>
        </footer>
        <!--footer-->
        @yield('model')
    </div>
    <!--main-wrapper-->

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="{{asset('website/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('website/js/all.min.js')}}"></script>
    <script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('website/js/wow.js')}}"></script>
    <script src="{{asset('website/js/jquery.easing.min.js')}}"></script>

    <script src="{{asset('website/js/slick.min.js')}}"></script>
    <script src="{{asset('website/js/jquery.zoom.js')}}"></script>
    <script
        src='https://wp.incredibbble.com/writsy-shop/wp-content/themes/writsy-shop/assets/vendor/jquery-zoom/jquery.zoom.min.js?ver=1.7.18'>
    </script>
    <script src="{{asset('website/js/script.js')}}"></script>
    <script>
    new WOW().init();
    </script>
    <script src="https://js.stripe.com/v3/"></script>

    @yield('js')
    @yield('script')
    @livewireScripts

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />

    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    <x-livewire-alert::flash />
</body>

<script>
$(".add_cart").click(function(e) {
    alert(123)
});
</script>

</html>
