<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        PORTFOLIO
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{--    Styles--}}
    <link rel="stylesheet" href="{{asset('themes/funder/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('themes/funder/css/style.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <script src="{{asset('js/jquery/jquery-3.2.1.js')}}"></script>
    <script src="{{asset('js/bootstrap/v4.6.2.js')}}"></script>
</head>
<body style="background-image: url('{{asset('themes/funder/images/bg.jpg')}}');">
<script src="{{asset('js/preloader/preloader.js')}}"></script>
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
                                                      class="font-weight-bold">PORTFOLIO</a>
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
                                    @endguest

                                    <li>
                                        <a href="{{route('articles')}}">Заметки</a>
                                        {{--                                        @include('blocks.tools')--}}
                                    </li>
                                    <li class="active"><a href="{{route('front')}}">{{__('Home')}}</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="py-4">
        <link rel="stylesheet" href="{{asset('themes/funder/fonts/icomoon/style.css')}}">
        <link rel="stylesheet" href="{{asset('themes/funder/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('themes/funder/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('bgscroll/css/normalize.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset('bgscroll/css/demo.css')}}">
        <link href="{{ asset('css/chart.css') }}" rel="stylesheet">
        <style>
            .top60 {
                margin-top: 60px
            }

            @media screen and (max-width: 640px) {
                .top_mobil {
                    margin-top: 60px;
                }

                .top60 {
                    margin-top: 0px
                }

                .bg {
                    height: 72vh;
                }

                .forMobileArticles {
                    margin-top: 60px;
                }
            }

            .preloader {

                height: auto;
                position: absolute;
                top: 50%;
                left: 50%;
                margin-right: -50%;
                transform: translate(-50%, -50%)
            }

            .myBg {
                background-color: rgba(0, 0, 0, 0.5);
                padding: 10px;
            }

            .carousel-indicators {
                bottom: -21px;
            }

            #custom_html-89 {
                border-bottom: 5px solid white;
            }


        </style>
        <link rel="stylesheet" href="{{asset('css/articles/all_article.css')}}">
        <div class="container-fluid">
            <div class="row">
                <div class="slide-one-item home-slider owl-carousel">
                    <div class="bg bg--1">
                        <div class="w-block">
                            <div class="font_slider" style="text-align: -webkit-left;">
                                <h1 style="color: white; "
                                    class="font-secondary font-weight-bold text-uppercase"><span
                                            class="inner">PHP</span>
                                </h1>
                                <span style="font-family: Century Gothic;" class="caption d-block text-white inner">Программирование на Laravel</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg bg--2">
                        <div class="w-block">
                            <div class="font_slider" style="text-align: -webkit-right;">
                                <span style="font-family: Century Gothic;" class="caption d-block text-white inner">Программирование на Spring Boot</span>
                                <h1 style="color: white; "
                                    class="font-secondary font-weight-bold text-uppercase"><span
                                            class="inner">Java</span>
                                </h1></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        {{--    ABAUT--}}

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <center>
                        <img src="{{asset('img/ljbqpfwXe0A.png')}}" alt="Image" style="margin-top: 60px"
                             class="img-fluid rounded-circle">
                        <h1 id="down_about" style="padding: 25px">О себе</h1>
                    </center>
                </div>
            </div>

            <div class="row top60" style="font-size: 17px; font-family: Century Gothic;">
                <div class="col-md-6 top_mobil" style="line-height: 1.5">
                    Приветствую Вас!<br>
                    <br>
                    Меня зовут Виталий, я занимаюсь программированием на <b>PHP(Laravel)</b> и <b>Java(Spring Boot)</b>.
                    <br><br>
                    Выпускник Российской it-компании в сфере онлайн-образования - <b style="color: #2C009F">GeekBrains</b>.
                    Срок обучения 2 года. Факультет <b>“Разработчик — Web-разработка на Java”</b>.
                    <br><br>
                    Немного о себе.
                    Разработкой сайтов занимаюсь с 2013 года. Приходилось собирать сайты на таких CMS, как Wordpress и
                    Drupal. Делал сайты для себя и знакомых, немного фрилансил. В 2017 году прошёл курсы по <b>PHP</b> и
                    по сей
                    день предпочитаю программировать на <b>Laravel</b>. В 2022 поступил учиться в <b>GeekBrains</b> для
                    изучения более
                    сложного языка - <b>Java</b>. Помимо данного языка, также было множество прикладных дисциплин: <b>Git,
                        Docker,
                        MySQL, Postgres...</b> В марте 2024го с отличием сдал дипломный проект.
                    <br><br>
                    В портфолио имеются примеры моего кода, как на <a target="_blank"
                                                                      href="https://github.com/vbasov77/spb-r">
                        PHP(Laravel)</a>, так и на <a target="_blank" href="https://github.com/vbasov77/mietenJ17">
                        Java(Spring Boot)</a>.
                    <br><br>
                    Мои языки и оценка владения на мой взгляд:<br>
                    <b>PHP</b> - хорошо,<br>
                    <b>Java</b> - выше среднего,<br>
                    <b>Js</b> - ниже среднего,<br>
                    <b>SQL</b> - хорошо<br><br>
                    Ниже я постараюсь подробнее описать свои некоторые проекты!
                </div>
                <div class="col-lg-6">
                    <div class="chart top_mobil">
                        <div class="progressBar" data="max85">
                            <div data-show="PHP">PHP</div>
                        </div>
                        <div class="progressBar" data="max75">
                            <div data-show="Laravel">Laravel</div>
                        </div>
                        <div class="progressBar margin-top" data="max70">
                            <div data-show="JAVA">JAVA</div>
                        </div>

                        <div class="progressBar" data="max65">
                            <div data-show="Spring Boot">Spring Boot</div>
                        </div>

                        <div class="progressBar" data="max45">
                            <div data-show="Javascript">Javascript</div>
                        </div>
                        <div class="progressBar" data="max75">
                            <div data-show="SQL">SQL</div>
                        </div>
                        <br>
                    </div>

                    <div>
                        <img src="{{asset('img/Java1.jpg')}}" alt="Image"
                             class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        {{--                                                              Работы--}}
        <div class="container-fluid" style="margin-top: 60px">
            <div class="row">
                <div class="col-md-12 text-center" id="down_work">
                    <h2 class="site-section-heading text-uppercase text-center font-secondary">Некоторые работы</h2>
                </div>
            </div>
        </div>

        <section style="margin-top: 40px" class="section text-center">
            <div class="container-fluid px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    @if(!empty(count($works)))
                        @foreach($works as $work)
                            <div class="card"
                                 style="width: 20rem;">                            @if($work->image != null)
                                    <img src="{{asset('/storage/images/' . $work->image)}}" class="card-img-top"
                                         alt="...">
                                @else
                                    <img src="{{ asset("images/no_image/no_image.jpg") }}" class="card-img-top"
                                         alt="..">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{!! $work->name !!}</h5>
                                    <p class="card-text">{!! $work['description'] !!}</p>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-outline-success"
                                            onclick="window.location.href = '{{route('work.id', ['id'=>$work->id])}}';">
                                        Подробнее
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <div class="container-fluid" style="margin-top: 60px">
            <div class="row">
                <div class="col-md-8 text-center">
                    <h5>Пройденные курсы в GeekBrains</h5>
                    @if(!empty(count($images)))
                        <div style="margin-top: 60px" id="carusel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                @for ($s = 0; $s < count($images); $s++)
                                    @php
                                        if ($s == 0){
                                             $active = "active";
                                        } else {$active = "";}
                                    @endphp
                                    <li data-target="#carusel" data-slide-to="{{$s}}" class="{{$active}}"></li>
                                @endfor
                            </ul>
                            <!-- The slideshow -->
                            <div class="carousel-inner">

                                @for ($i = 0; $i < count($images); $i++)
                                    @php
                                        if ($i == 0){
                                            $carusel = "carousel-item active";
                                             } else {$carusel = "carousel-item";}
                                    @endphp
                                    <div class="{{$carusel}}">
                                        <img src="{{ asset('images/slider_img/' . $images[$i]['path'])}}" alt="">
                                        <div class="carousel-caption d-none d-md-block" style="color: #0b2e13">
                                            <h5 style="color: black;">Курс {{$images[$i]['description']}}</h5>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <a class="carousel-control-prev" href="#carusel" data-slide="prev">
                                <div class="ic">
                                    <span class="carousel-control-prev-icon myBg"></span>
                                </div>
                            </a>
                            <a class="carousel-control-next" href="#carusel" data-slide="next">
                                <div class="ic">
                                    <span class="carousel-control-next-icon myBg"></span>
                                </div>
                            </a>
                        </div>

                    @endif
                </div>
                <div class="col-md-4 text-center forMobileArticles">
                    <h5>Последнее в заметках</h5>
                    @if(!empty(count($articles)))
                        @foreach($articles as $value)
                            <div class="card" style="margin-top: 25px;">
                                <div class="card-body">
                                    @if(str_contains($value->tags, "php"))
                                        <img src="{{asset("images/programming_language/php.svg")}}"
                                             height="30px" width="30px" class="rightM">
                                    @elseif(str_contains($value->tags, "java"))
                                        <img src="{{asset("images/programming_language/java.svg")}}"
                                             height="35px" width="35px" class="rightM">
                                    @elseif(str_contains($value->tags, "js"))
                                        <img src="{{asset("images/programming_language/js.svg")}}"
                                             height="30px" width="30px" class="rightM">
                                    @elseif(str_contains($value->tags, "jq"))
                                        <img src="{{asset("images/programming_language/jq.svg")}}"
                                             height="35px" width="35px" class="rightM">
                                    @elseif(str_contains($value->tags, "css"))
                                        <img src="{{asset("images/programming_language/css.svg")}}"
                                             height="30px" width="30px" class="rightM">
                                    @else
                                        <img src="{{asset("images/programming_language/abra.svg")}}"
                                             height="30px" width="30px" class="rightM">
                                    @endif
                                    <a class="link" style="text-decoration: none"
                                       href="{{route('article', ["id"=>$value['id']])}}">
                                        <h4>{{$value->title}}</h4></a>
                                    <small><i>{{$value ['description']}}</i></small>
                                    <br>

                                </div>
                            </div>
                        @endforeach
                        <a href="{{route('articles')}}" style="text-decoration: none">Все заметки</a>
                    @else
                        Нет материала
                    @endif
                </div>
            </div>
        </div>
        {{--                                                                   Контакты--}}
        @include('blocks.btn-ap')
        <div class="row">
            <div class="col-12" style="margin-top: 60px; margin-bottom: 60px;" id="custom_html-89">

            </div>
        </div>

    </main>
</div>


<section>
    <footer style="padding: 35px; " class="footer bg-black small text-center">
        <div style="color: white" class="container px-4 px-lg-5">PORTFOLIO &copy; {{date('Y')}}</div>
    </footer>
</section>

<script src="{{asset('themes/funder/js/aos.js')}}"></script>
<script src="{{asset('themes/funder/js/main.js')}}"></script>
<script src="{{asset('themes/funder/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('themes/funder/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/chart.js')}}"></script>
<script src="{{ asset('js/mask.js') }}" defer></script>
<script src="{{asset('bgscroll/js/bgscroll.js')}}"></script>
<script>
    $(window).scroll(function () {
        $('.bg--1').bgscroll({
            direction: 'bottom', // направление bottom или top
            bgpositionx: 50, // x позиция фонового изображения, от 0 до 100, размерность в %, 50 - означает по центру
            debug: false, // Режим отладки
            min: 0, // минимальное положение (в %) на которое может смещаться фон
            max: 90 // максимальное положение (в %) на которое может смещаться фон
        });
        $('.bg--2').bgscroll({
            direction: 'bottom',
            bgpositionx: 50, // x позиция фонового изображения, от 0 до 100, размерность в %, 50 - означает по центру
            debug: false, // Режим отладки
            min: 0, // минимальное положение (в %) на которое может смещаться фон
            max: 90 // максимальное положение (в %) на которое может смещаться фон
        });
    })
</script>

</body>
</html>
