<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Квартира посуточно в Санкт-Петербурге</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">
    <link href="{{ asset('css/hotel-datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/checkbox/radio.css') }}" rel="stylesheet">

    <script src="{{ asset('js/fecha.min.js') }}" defer></script>
    <script src="{{ asset('js/hotel-datepicker/hotel-datepicker.min.js') }}" defer></script>
    <script src="{{ asset('jquery/jquery.min.js') }}" defer></script>
    <script src="{{ asset('bootstrap/popper.min.js') }}" defer></script>
    <script src="{{ asset('bootstrap/bootstrap.min.js') }}" defer></script>

    <link rel="stylesheet" href="{{asset('themes/funder/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('themes/funder/css/style.css')}}">

</head>
<div class="site-navbar-wrap js-site-navbar bg-white">
    <div class="container">
        <div class="site-navbar bg-light">
            <div class="row align-items-center">
                <div class="col-2">
                    <h2 class="mb-0 site-logo"><a style="text-decoration: none;" href="{{route('front')}}"
                                                  class="font-weight">MIETEN</a>
                    </h2>
                </div>
                <div class="col-10">
                    <nav class="site-navigation text-right" role="navigation">
                        <div class="container">
                            <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#"
                                                                                          class="site-menu-toggle js-menu-toggle text-black"><span
                                            class="icon-menu h3"></span></a></div>
                            <ul class="site-menu js-clone-nav d-none d-lg-block">
                                @guest

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
                                <li>
                                    {{--                                        @include('blocks.tools')--}}
                                </li>
                                <li class="active"><a href="{{route('front')}}">{{__('Главная')}}</a></li>
                                <li class="active"><a href="{{route('list.places')}}">{{__('Куда сходить')}}</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<body id="page-top">
@if (!empty($error))
    <div style="background-color: red; color:#ffffff; padding: 5px;margin: 15px">
        <center> {{$error}}</center>
    </div>
@endif

@if (!empty($message))
    <div style="background-color: #43b143; color:#ffffff; padding: 5px;margin: 15px">
        <center> {{$message}}</center>
    </div>
@endif


<main class="py-4">
    @yield('content')
</main>

@stack('scripts')
{{--<x-yandex />--}}

<!-- Footer-->
<footer class="footer bg-black small text-center text-white-50">
    <div class="container px-4 px-lg-5">Апартаменты посуточно &copy; {{date('Y')}}</div>
    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
</footer>

</body>
</html>
