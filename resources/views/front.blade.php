@extends('layouts.app')
@section('content')

    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>

    <link href="{{ asset('css/checkbox/radio.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pulse_button.css') }}" rel="stylesheet">
    <script src="{{ asset('js/fecha.min.js') }}" defer></script>
    <link href="{{ asset('css/hotel-datepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('js/hotel-datepicker/hotel-datepicker.min.js') }}" defer></script>
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">
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
                                    <img width="30px" src="{{asset("icons/check.svg")}}"> 100 м до набережной Невы<br>
                                    <img width="30px" src="{{asset("icons/check.svg")}}"> 10 мин пешком до метро<br>

                                    <img width="30px" src="{{asset("icons/check.svg")}}"> 1 станция метро до центра
                                    СПб<br>
                                    <img width="30px" src="{{asset("icons/phone.svg")}}"> +7 911 012 09 12<br>
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
    <section class="about-section text-center marginTop" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="body-front">
                        @auth
                            @if(Auth::user()->isAdmin() || Auth::user()->isModerator())
                                <div class="icons">
                                    <a href="{{route('create.news')}}"> <img style="color: white"
                                                                             src="{{asset('icons/post.svg')}}"
                                                                             width="50px"
                                                                             height="auto"></a>
                                </div>
                            @endif
                        @endauth
                        <br>
                        @php

                            $firstMonth = explode(",", $dataSettings[0]);
                            $secondMonth = explode(",", $dataSettings[1]);
                        @endphp

                        {!! $firstMonth[0]   !!}- {!!$firstMonth[1]!!} руб / сут<br>
                        {!! $secondMonth[0]   !!}- {!!$secondMonth[1]!!} руб / сут<br>
                        от 5-ти суток<br>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @include('blocks.btn-ap')
    <!-- Projects-->
    <br>
    <br>
    <section class="projects-section bg-light marginTop" id="projects">
        <div class="container px-4 px-lg-5">
            <!-- Featured Project Row-->
            <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                <div class="col-xl-8 col-lg-7">
                    {{--                Slider--}}
                    <div class="width-adaptive80">
                        <div id="carusel" class="carousel slide carousel-fade" data-ride="carousel">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <li data-target="#carusel" data-slide-to="0" class="active"></li>
                                <li data-target="#carusel" data-slide-to="1"></li>
                                <li data-target="#carusel" data-slide-to="2"></li>

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
                    <div class="featured-text text-center text-lg-center">
                        <div style="text-align: center" class="body-front">
                            <br>
                            <img width="30px" src="{{asset("icons/coff.svg")}}"> оборудованная кухня<br>
                            <div class="fontawesome"><i class="fas fa-bed"></i> двуспальная кровать<br></div>
                            <div class="fontawesome"><i class="fas fa-snowflake"></i> холодильник<br></div>
                            <div class="fontawesome"><i class="fas fa-tv"></i> телевизор<br></div>
                            <div class="fontawesome"><i class="fas fa-check"></i> утюг<br></div>
                            <div class="fontawesome"><i class="fas fa-fan"></i> фен<br></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row align-items-center marginTop">
                <div class="col-lg-7">
                    {{--                Карта--}}
                    <div class="width-adaptive60" style="float: right">
                        <div id="carusel_8" class="carousel slide carousel-fade" data-ride="carousel">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <li data-target="#carusel_8" data-slide-to="0" class="active"></li>
                                <li data-target="#carusel_8" data-slide-to="1"></li>
                                <li data-target="#carusel_8" data-slide-to="2"></li>
                                <li data-target="#carusel_8" data-slide-to="3"></li>

                            </ul>
                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('img/slider/4.jpg')}}" alt="">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/slider/5.jpg')}}" alt="">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/slider/6.jpg')}}" alt="">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/slider/7.jpg')}}" alt="">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carusel_8" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#carusel_8" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 order-lg-first">
                    <div class="featured-text text-center text-lg-left">
                        <div class="body-front">
                            <br>
                            <br>
                            <center><h4>Задать вопрос:</h4></center>
                            <br>
                            <center>
                                <button class="btn btn-outline-success"
                                        onclick="window.location.href = 'https://wa.clck.bar/79110120912';">
                                    <i class="fab fa-whatsapp"></i> по WhatsApp
                                </button>
                            </center>
                            <br>
                            <center>
                                <button class="btn btn-outline-primary"
                                        onclick="window.location.href = 'tel:+79110120912';"><i
                                            class="fas fa-phone-alt"></i> по телефону
                                </button>
                            </center>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <br>
            <!-- Project One Row-->
            <div class="marginTop">
                <form action="{{route("add.dates")}}" method="post">
                    @csrf
                    <center><h4 class="marginTop">Забронировать квартиру</h4></center>
                    <br>
                    <div style="color: red">
                        <center><i> Узнать точную цену на свои даты. Начните бронировать...</i></center>
                    </div>
                    @if($errors->any())
                        @foreach($errors -> all() as $error)
                            <x-alert type="danger" :message="$error"/>
                        @endforeach
                    @endif
                    <br>
                    <div class="row gx-0 mb-5 mb-lg-0">
                        <div class="col-lg-6">
                            <div id="info"></div>
                            <div>
                                <label for="date_book"><b>Выберете дату:</b></label>
                                <input id="input-id" style="display:inline" name="date_book" type="text"
                                       class="form-control @error("user_name") is-invalid @enderror"
                                       placeholder="Нажмите для выбора даты" autocomplete="off" readonly="readonly"
                                       required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <br>
                            <div class="featured-text text-center text-lg-left">
                                <b>Количество гостей:</b><br>
                                <div class='form_radio_btn2 my_mobile' style="text-align: center;">
                                    <input type='radio' id="initial1" name="guests" value="1" required
                                    ><label for='initial1'>1 гость</label></div>

                                <div class='form_radio_btn2 my_mobile' style="text-align: center;">
                                    <input type='radio' id="initial2" name="guests" value="2" required
                                    ><label for='initial2'>2 гостя</label></div>

                                <br>
                                <br>
                                <div>
                                    <input class="btn btn-outline-primary" id="calendar" type="submit"
                                           value="Продолжить">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <br>
            <!-- Project Two Row-->
            <center><h4 class="marginTop">Местоположение</h4></center>
            <br>
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6">
                    {{--                Карта--}}
                    <img src="{{ asset('img/map.jpg')}}" width="100%" height="auto" alt="">
                    {{--                    <iframe--}}
                    {{--                            src="https://yandex.ru/map-widget/v1/?um=constructor%3A65a07ea5894c7a1a22f3328ad7c44cc0d8d500728d59c4d65fc15f4df663c572&amp;source=constructor"--}}
                    {{--                            width="500" height="300" frameborder="0"></iframe>--}}
                </div>
                <div class="col-lg-6 order-lg-first">
                    {{--                <div class="bg-black text-center h-100 project">--}}
                    <div class="d-flex h-100">
                        <div class="project-text w-100 my-auto text-left text-lg-left">
                            <div class="body-front">
                                Мы рады предложить вам уютную небольшую студию в апарт-отеле, который расположен на
                                самой набережной Невы, всего в 10 минутах ходьбы от станции метро «Елизаровская».
                                Апарт-отель находится по адресу проспект Обуховской обороны, дом 123а. В
                                непосредственной близости от него вы найдете множество кафе, ресторанов и супермаркетов,
                                таких как «Магнит», «Дикси» и «Красное & Белое».
                                @include('blocks.popup')
                                <br>
                                <center><a href="#" class="open-popup">Правила въезда</a></center>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <br>
            <div class="row gx-0 mb-4 mb-lg-5 align-items-center marginTop">
                <div class="col-xl-8 col-lg-7">
                    {{--                Slider--}}
                    <div class="width-adaptive80">
                        <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
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
                            <button class="btn btn-outline-primary"
                                    onclick="window.location.href = 'tel:+79110120912';"><i
                                        class="fas fa-phone-alt"></i> по телефону
                            </button>
                        </center>
                        <br>

                    </div>
                </div>
            </div>
            <center><h4 class="marginTop">Достопримечательности</h4></center>
            <br>
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6">
                    {{--                Карта--}}
                    <div id="carusel_2" class="carousel slide carousel-fade" data-ride="carousel">
                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <li data-target="#carusel_2" data-slide-to="0" class="active"></li>
                            <li data-target="#carusel_2" data-slide-to="1"></li>
                            <li data-target="#carusel_2" data-slide-to="2"></li>
                            <li data-target="#carusel_2" data-slide-to="3"></li>
                            <li data-target="#carusel_2" data-slide-to="4"></li>
                            <li data-target="#carusel_2" data-slide-to="5"></li>
                            <li data-target="#carusel_2" data-slide-to="6"></li>
                            <li data-target="#carusel_2" data-slide-to="7"></li>
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
                        <a class="carousel-control-prev" href="#carusel_2" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#carusel_2" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-first">
                    {{--                <div class="bg-black text-center h-100 project">--}}
                    <div class="d-flex h-100">

                        <div style="float: left" class="body-front">
                            <em>Одна станция метро:</em> <br><img style="width: 30px; opacity: .6; margin-bottom: 10px;"
                                                                  src="{{ asset('icons/metro.svg')}}" alt="">
                            <strong>Площадь Александра Невского</strong>:
                            Свято-Троицкая
                            Александро-Невская лавра.<br>
                            <em>Две станции</em>: <strong><img style="width: 30px; opacity: .6; margin-bottom: 10px;"
                                                               src="{{ asset('icons/metro.svg')}}">
                                Маяковская, <img style="width: 30px; opacity: .6; margin-bottom: 10px;"
                                                 src="{{ asset('icons/metro.svg')}}"
                                                 alt=""> Площадь Восстания</strong>: ТРЦ Галерея,
                            БКЗ
                            Октябрьский.<br>
                            <em>Три станции</em>: <strong><img style="width: 30px; opacity: .6; margin-bottom: 10px;"
                                                               src="{{ asset('icons/metro.svg')}}" alt="">
                                Гостинный Двор</strong>: Казанский Собор, Спас на
                            Крови,
                            Гостинный Двор, Эрмитаж.
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <center><h4 class="marginTop">Смотреть видео</h4></center>
            <br>
            @include('blocks.video')
            <br>
        </div>
    </section>
    <section class="about-section marginTop" id="about">
        <div class="container">
            <br>
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-8 one">
                    <div class="d-flex h-100">
                        <div class="body-front i_am">
                            Приветствую!<br>
                            Я НЕ агент, я собственник.<br> Давайте знакомиться! Меня зовут Виталий😊<br>
                            Мой аккаунт в <i class="fab fa-vk"></i>(
                            <a href="https://vk.com/id642803932" target="_blank">Здесь</a>).
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 two justify-content-center ">
                    <div class="i_am">
                        <img src="{{ asset('img/ljbqpfwXe0A.png')}}">
                    </div>
                </div>
            </div>
            <br>
            <br>
            <center><h4 class="marginTop">Задать вопрос:</h4></center>
            <br>
            <center>
                <button class="btn btn-outline-success"
                        onclick="window.location.href = 'https://wa.clck.bar/79110120912';">
                    <i class="fab fa-whatsapp"></i> в WhatsApp
                </button>
            </center>
            <br>
            <center>
                <button class="btn btn-outline-primary" onclick="window.location.href = 'tel:+79110120912';"><i
                            class="fas fa-phone-alt"></i> по телефону
                </button>
            </center>
            <br>
            <br>
        </div>
    </section>

    @include('blocks.news')
    <br>
    <br>
    <!-- Put this script tag to the <head> of your page -->

    @include('blocks.buttons')
    @include('blocks.vidgetVk')

    <script src="{{asset('js/preloader/preloader.js')}}"></script>
    <script>
        var datebook = @json($data['date_book']);
    </script>
    <script src="{{ asset('js/buttons/close_button.js') }}" defer></script>
    <script src="{{ asset('js/close/close.js') }}" defer></script>
    <script src="{{ asset('js/calendar.js') }}" defer></script>
    <script src="{{ asset('js/popup/popup.js') }}" defer></script>
@endsection