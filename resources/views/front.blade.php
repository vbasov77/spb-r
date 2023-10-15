@extends('layouts.front')
@section('content')

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
                        @php
                            $firstMonth = explode(",", $dataSettings[0]);
                            $secondMonth = explode(",", $dataSettings[1]);
                        @endphp

                        {!! $firstMonth[0]   !!}- {!!$firstMonth[1]!!} руб / сут<br>
                        {!! $secondMonth[0]   !!}- {!!$secondMonth[1]!!} руб / сут<br>
                        от 4-х суток<br>
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
                        <div id="carusel" class="carousel slide carousel-fade" data-ride="carousel">
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
                <button class="btn btn-outline-success"
                        onclick="window.location.href = 'https://wa.clck.bar/79110120912';">
                    <i class="fab fa-whatsapp"></i> по WhatsApp
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
            <!-- Project One Row-->
            <form action="{{route("add.calendar")}}" method="post">
                @csrf
                <center><h4>Забронировать квартиру</h4></center>
                <br>
                <div style="color: red">
                    <center><i> Узнать точную цену на свои даты. Начните бронировать...</i></center>
                </div>
                <br>
                <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                    <div class="col-lg-6">
                        <div id="info"></div>
                        <div>
                            <label for="date_book"><b>Выберете дату:</b></label>
                            <input id="input-id" style="display:inline" name="date_book" type="text"
                                   class="form-control"
                                   placeholder="Нажмите для выбора даты" autocomplete="off" readonly="readonly"
                                   required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <br>
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
                            <input class="btn btn-outline-primary" id="calendar" type="submit" value="Продолжить">
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
                            <button class="btn btn-outline-primary" onclick="window.location.href = 'tel:+79110120912';"><i
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
                            <em>Одна станция метро:</em> <img style="width: 40px; opacity: .6"
                                                              src="{{ asset('img/metro.svg')}}" alt="">
                            <strong>Площадь Александра Невского</strong>:
                            Свято-Троицкая
                            Александро-Невская лавра.<br>
                            <em>Две станции</em>: <strong><img style="width: 40px; opacity: .6"
                                                               src="{{ asset('img/metro.svg')}}">
                                Маяковская, <img style="width: 40px; opacity: .6" src="{{ asset('img/metro.svg')}}"
                                                 alt=""> Площадь Восстания</strong>: ТРЦ Галерея,
                            БКЗ
                            Октябрьский.<br>
                            <em>Три станции</em>: <strong><img style="width: 40px; opacity: .6"
                                                               src="{{ asset('img/metro.svg')}}" alt="">
                                Гостинный Двор</strong>: Казанский Собор, Спас на
                            Крови,
                            Гостинный Двор, Эрмитаж.
                        </div>
                        <hr class="d-none d-lg-block mb-0 me-0"/>

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
                <button class="btn btn-outline-success"
                        onclick="window.location.href = 'https://wa.clck.bar/79110120912';">
                    <i
                            class="fab fa-whatsapp"></i> в WhatsApp
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
    <br>
    <br>


    <script src="{{asset('js/preloader/preloader.js')}}"></script>
    <script>
        var datebook = @json($data['date_book']);

    </script>

    <script src="{{ asset('js/buttons/close_button.js') }}" defer></script>
    <script src="{{ asset('js/close/close.js') }}" defer></script>
    <script src="{{ asset('js/calendar.js') }}" defer></script>
@endsection