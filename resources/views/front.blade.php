<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Квартира посуточно</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet"/>
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/hotel-datepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('js/fecha.min.js') }}" defer></script>
    <script src="{{ asset('js/hotel-datepicker.min.js') }}" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
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
                            <a class="dropdown-item" href="/settings">Настройки</a>
                            @if(Auth::user()->isAdmin())
                                <a class="dropdown-item" href="/orders">Заказы</a>
                                <a class="dropdown-item" href="/schedule">Расписание</a>
                                <a class="dropdown-item" href="{{route('reports')}}">Отчёты</a>
                            @endif
                            <a class="dropdown-item" href="/profile">Профиль</a>
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
<!-- Navigation-->
<script>
    var datebook = @json($data ['date_book']);
</script>
<?php if (!empty($error)): ?>
<div style="background-color: red; color:#ffffff; padding: 5px;margin: 15px">
    <center> <?= $error ?></center>
</div>
<?php endif; ?>
<?php if (!empty($message)): ?>
<div style="background-color: #43b143; color:#ffffff; padding: 5px;margin: 15px">
    <center> <?= $message ?></center>
</div>
<?php endif; ?>

<style>
    /* Make the image fully responsive */
    .carousel-inner img {
        width: 100%;
        height: 100%;
    }
</style>
<!-- Masthead-->
<header class="masthead">
    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
        <div class="bg-banner">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto mt-2 mb-5" style="color: white">Апартаменты-студия</h1>
                    <h2 class="mx-auto mt-2 mb-5">
                        <div class="body-white">
                            <div class="line-height" style="color: white">
                                <div class="fontawesome"><i class="fa fa-check"></i> 100 м до набережной Невы<br>
                                </div>
                                <div class="fontawesome"><i class="fa fa-check"></i> 10 мин пешком до метро<br>
                                </div>
                                <div class="fontawesome"><i class="fa fa-check"></i> 1 станция метро до центра
                                    СПб<br>
                                </div>
                                <div class="fontawesome"><i class="fa fa-phone"></i> +7 911 012 09 12<br></div>
                            </div>
                        </div>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</header>
<br><br>
<!-- About-->
<section class="about-section text-center" id="about">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8">
                <div class="body-front">
                    <h2>от 900 руб.</h2>
                    <p> от 30 дней - 900 руб <br>
                        до 30 дней - 1100 руб<br>
                        на 1 сутки не сдаётся<br>

                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Projects-->
<br>
<br>
<section class="projects-section bg-light" id="projects">
    <div class="container px-4 px-lg-5">
        <!-- Featured Project Row-->
        <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
            <div class="col-xl-8 col-lg-7">
                {{--                Slider--}}
                <div class="width-adaptive60">
                    <div id="carusel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <li data-target="#carusel" data-slide-to="0" class="active"></li>
                            <li data-target="#carusel" data-slide-to="1"></li>
                            <li data-target="#carusel" data-slide-to="2"></li>
                            <li data-target="#carusel" data-slide-to="3"></li>
                            <li data-target="#carusel" data-slide-to="4"></li>
                        </ul>
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('img/slider/1.jpg')}}" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/slider/2.jpg')}}" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/slider/3.jpg')}}" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/slider/4.jpg')}}" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/slider/5.jpg')}}" alt="">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carusel" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#carusel" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="featured-text text-center text-lg-left">
                    {{--                    <h4>Shoreline</h4>--}}
                    <div class="body-front">
                        <div class="fontawesome"><i class="fas fa-bed"></i> двуспальная кровать<br></div>
                        <div class="fontawesome"><i class="fas fa-coffee"></i> оборудованная кухня<br></div>
                        <div class="fontawesome"><i class="fas fa-snowflake"></i> холодильник<br></div>
                        <div class="fontawesome"><i class="fas fa-tv"></i> телевизор<br></div>
                        <div class="fontawesome"><i class="fas fa-fan"></i> фен<br></div>
                        <div class="fontawesome"><i class="fas fa-check"></i> утюг<br></div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <center><h4>Задать вопрос:</h4></center>
        <br>
        <center>
            <button class="btn btn-outline-success" onclick="window.location.href = 'https://wa.clck.bar/79110120912';">
                <i class="fab fa-whatsapp"></i> по WhatsApp
            </button>
        </center>
        <br>
        <center>
            <button class="btn btn-outline-info" onclick="window.location.href = 'tel:+79110120912';"><i
                        class="fas fa-phone-alt"></i> по телефону
            </button>
        </center>
        <br>
        <br>
        <!-- Project One Row-->
        <form action="/add_calendar" method="post">
            @csrf
            <center><h4>Забронировать квартиру</h4></center>
            <br>
            <div style="color: red">
                <center><i> Узнать точную цену на свои даты. Начните бронировать...</i></center>
            </div>
            <br>
            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                <div class="col-lg-6">
                    <div>
                        <label for="date_book"><b>Выберете дату:</b></label>
                        <input id="input-id" style="display:inline" name="date_book" type="text"
                               class="form-control"
                               placeholder="Нажмите для выбора даты" autocomplete="off" readonly="readonly" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <br>
                    <label for="guests"><b>Количество гостей:</b></label><br>
                    <label><input type="radio" name="guests" value="1" required> 1 гость</label><br>
                    <label><input type="radio" name="guests" value="2" required> 2 гостя</label>
                    <br>
                    <br>
                    <div>
                        <input class="btn btn-outline-primary" type="submit" value="Продолжить">
                    </div>
                </div>

            </div>
        </form>
        <br>
        <br>
        <!-- Project Two Row-->
        <center><h4>Местоположение</h4></center>
        <br>
        <div class="row gx-0 justify-content-center">
            <div class="col-lg-6">
                {{--                Карта--}}
                <iframe
                        src="https://yandex.ru/map-widget/v1/?um=constructor%3A65a07ea5894c7a1a22f3328ad7c44cc0d8d500728d59c4d65fc15f4df663c572&amp;source=constructor"
                        width="500" height="300" frameborder="0"></iframe>
            </div>
            <div class="col-lg-6 order-lg-first">
                {{--                <div class="bg-black text-center h-100 project">--}}
                <div class="d-flex h-100">
                    <div class="project-text w-100 my-auto text-center text-lg-right">
                        <div class="body-front">
                            Вашему вниманию предлагаются отличные апартаменты в
                            трёхзвёздочном отеле, расположенные в шаговой доступности от станции метро
                            Елизаровская (10 мин. пешком). Проспект Обуховской обороны 123а. В окружении кафе,
                            ресторанов, а также супермаркетов — Магнит, Дикси, Красное & Белое
                        </div>
                        {{--                        <hr class="d-none d-lg-block mb-0 me-0"/>--}}
                    </div>
                </div>
                {{--                </div>--}}
            </div>
        </div>
        <br>
        <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
            <div class="col-xl-8 col-lg-7">
                {{--                Slider--}}
                <div class="width-adaptive80">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ul>
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('img/slider/l1.jpg')}}" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/slider/l2.jpg')}}" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/slider/l3.jpg')}}" alt="">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="featured-text text-center text-lg-left">
                    {{--                    <h4>Shoreline</h4>--}}
                    <br>
                    <center><h4>Задать вопрос:</h4></center>
                    <br>
                    <center>
                        <button class="btn btn-outline-success"
                                onclick="window.location.href = 'https://wa.clck.bar/79110120912';">
                            <i
                                    class="fab fa-whatsapp"></i> в WhatsApp
                        </button>
                    </center>
                    <br>
                    <center>
                        <button class="btn btn-outline-info" onclick="window.location.href = 'tel:+79110120912';"><i
                                    class="fas fa-phone-alt"></i> по телефону
                        </button>
                    </center>
                    <br>

                </div>
            </div>
        </div>
        <center><h4>Достопримечательности</h4></center>
        <br>
        <div class="row gx-0 justify-content-center">
            <div class="col-lg-6">
                {{--                Карта--}}
                <div id="carisel_2" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <li data-target="#carisel_2" data-slide-to="0" class="active"></li>
                        <li data-target="#carisel_2" data-slide-to="1"></li>
                        <li data-target="#carisel_2" data-slide-to="2"></li>
                        <li data-target="#carisel_2" data-slide-to="3"></li>
                        <li data-target="#carisel_2" data-slide-to="4"></li>
                        <li data-target="#carisel_2" data-slide-to="5"></li>
                        <li data-target="#carisel_2" data-slide-to="6"></li>
                        <li data-target="#carisel_2" data-slide-to="7"></li>
                    </ul>
                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('img/slider/b1.jpg')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/slider/b2.jpg')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/slider/b3.jpg')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/slider/b4.jpg')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/slider/b5.jpg')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/slider/b6.jpg')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/slider/b7.jpg')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/slider/b8.jpg')}}" alt="">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carisel_2" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#carisel_2" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 order-lg-first">
                {{--                <div class="bg-black text-center h-100 project">--}}
                <div class="d-flex h-100">
                    <div class="project-text w-100 my-auto text-center text-lg-right">
                        <div class="body-front">
                            <em>Одна станция метро.</em> <strong>Площадь Александра Невского</strong>: Свято-Троицкая
                            Александро-Невская лавра.
                            <em>Вторая станция</em>. <strong>Маяковская, Площадь Восстания</strong>: ТРЦ Галерея, БКЗ
                            Октябрьский.
                            <em>Третья станция</em>.  <strong>Гостинный Двор</strong>: Казанский Собор, Спас на Крови,
                            Гостинный Двор, Эрмитаж.
                        </div>
                        <hr class="d-none d-lg-block mb-0 me-0"/>
                    </div>
                </div>
                {{--                </div>--}}
            </div>
        </div>
        <br>
        <center><h4>Смотреть видео</h4></center>
        <br>
        <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
            <div class="col-lg">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/2XLNlCXYVdY"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
            <div class="col-lg">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/pUeHjTWTH_Q"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
        <br>
        <center><h4>Задать вопрос:</h4></center>
        <br>
        <center>
            <button class="btn btn-outline-success" onclick="window.location.href = 'https://wa.clck.bar/79110120912';">
                <i
                        class="fab fa-whatsapp"></i> в WhatsApp
            </button>
        </center>
        <br>
        <center>
            <button class="btn btn-outline-info" onclick="window.location.href = 'tel:+79110120912';"><i
                        class="fas fa-phone-alt"></i> по телефону
            </button>
        </center>
        <br>
        <br>
    </div>
</section>
<br>
<br>
<!-- Footer-->
<footer class="footer bg-black small text-center text-white-50">
    <div class="container px-4 px-lg-5">Апартаменты посуточно &copy; 2022</div>
</footer>
<script src="{{ asset('js/calendar.js') }}" defer></script>
</body>
</html>