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

</head>

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
