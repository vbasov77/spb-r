<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @isset($title)
            {{ $title }} |
        @endisset
        {{ config('app.name') }}
    </title>

    <!-- Scripts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('themes/funder/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('themes/funder/css/style.css')}}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>

</head>


<body id="page-top">
<div class="site-wrap">

    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->

    <div class="site-navbar-wrap js-site-navbar bg-white">

        <div class="container">
            <div class="site-navbar bg-light">

                <div class="row align-items-center">
                    <div class="col-2">
                        <h2 class="mb-0 site-logo"><a style="text-decoration: none;" href="{{route('front')}}"
                                                      class="font-weight-bold">MIETEN</a>
                        </h2>
                    </div>

                    <div class="col-9">
                        <nav class="site-navigation text-right" role="navigation">
                            <div class="container">
                                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">
                                    <a href="#" class="site-menu-toggle js-menu-toggle text-black"><span
                                                class="icon-menu h3"></span></a></div>
                                <ul class="site-menu js-clone-nav d-none d-lg-block">
                                    @guest
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Логин') }}</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        @if(Auth::user()->isAdmin())
                                            <li class="has-children">
                                                <a href="#">Админ</a>
                                                <ul class="dropdown arrow-top">
                                                    @include('blocks.admin_menu')
                                                </ul>
                                            </li>
                                        @endif
                                        <li class="has-children">
                                            <a href="#"> {{ Auth::user()->name }}</a>
                                            <ul class="dropdown arrow-top">
                                                @include('blocks.user_menu')
                                            </ul>
                                        </li>

                                    @endguest
                                    <li class="active"><a href="{{route('front')}}">{{__('Главная')}}</a></li>
                                </ul>

                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <center>
        <main class="py-4">
            @include('blocks.btn-ap')
            @yield('content')
        </main>
    </center>
</div>
<!-- Footer-->
<footer class="footer bg-black small text-center text-white-50">
    <div class="container px-4 px-lg-5">Апартаменты посуточно &copy; {{date('Y')}}</div>
    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

</footer>

<script src="{{asset('themes/funder/js/aos.js')}}"></script>
<script src="{{asset('themes/funder/js/main.js')}}"></script>
@stack('scripts')

</body>
</html>
