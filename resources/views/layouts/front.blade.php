<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Квартира посуточно</title>
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
</head>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            MIETEN.RU
            {{--                    {{ config('app.name', 'Laravel') }}--}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('settings')}}">Настройки</a>
                            @if(Auth::user()->isAdmin())
                                <a class="dropdown-item" href="{{route('orders')}}">Заказы</a>
                                <a class="dropdown-item" href="{{route('to.queue')}}">В очередь</a>
                                <a class="dropdown-item" href="{{route('view.queue')}}">Очереди</a>
                                <a class="dropdown-item" href="{{route('reports')}}">Отчёты</a>
                                <a class="dropdown-item" href="{{route('archive')}}">Архив</a>
                                <a class="dropdown-item" href="{{route('del.schedule')}}">Очистить базу</a>
                            @endif
                            <a class="dropdown-item" href="{{route('profile')}}">Профиль</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
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

<!-- Footer-->
<footer class="footer bg-black small text-center text-white-50">
    <div class="container px-4 px-lg-5">Апартаменты посуточно &copy; {{date('Y')}}</div>
</footer>

</body>
</html>
