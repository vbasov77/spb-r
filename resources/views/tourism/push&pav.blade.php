@extends('layouts.app')
@section('content')

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/all.js') }}" defer></script>
    <script src="{{ asset('datetimepicker/jquery.datetimepicker.full.min.js') }}" defer></script>
    <link href="{{ asset('datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
    <style>
        .air-datepicker.-inline- {
            width: 100%;
        }
    </style>
    <script>
        var datedis = @json($datedis);
    </script>



    <div class="align-items-center">
        <section
            style="background-size: cover; background-image: url({{ url("img/bg_image/rr.jpg")}});height: 550px">
            <h1 style="color: white; font-family: Century Gothic; padding-top: 80px;">
                Пушкин & Павловск</h1>
            <div class="container-fluid">

                <div class="row  justify-content-center align-items-center d-flex text-center h-100">
                    <div class="col-12 col-md-8  h-50 ">


                        <form action="/book_tourism" method="post">
                            @csrf
                            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                                <div class="col-8">
                                    <label for="el" style="color: white"><b>Забронируйте
                                            дату:</b></label>

                                    <br>
                                    {{--                                    <div>--}}
                                    {{--                                        <input type="text" id="el" name="el" class="form-control" placeholder="Выберете дату" autocomplete="off"--}}
                                    {{--                                               required>--}}
                                    {{--                                    </div>--}}
                                    <div>
                                        <input type="text" id="datetimepicker" name="el" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div>
                                <input class="btn btn-danger" type="submit" style="color: white"
                                       value="Забронировать">
                            </div>
                        </form>
                        <div class="btn-container-wrapper p-relative d-block  zindex-1">
                            <a class="btn btn-link btn-lg   mt-md-3 mb-4 scroll align-self-center text-light"
                               href="#">
                                <i class="fa fa-angle-down fa-4x text-light"></i>
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </section>
    </div>
    <br>
    <section style="font-family: Century Gothic">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h4 style="padding: 20px">Посетите сразу два исторических места Санкт-Петербурга - Екатерининский
                        Дворец (Пушкин)
                        и Павловск</h4>
                </div>
            </div>
            <h2 style="color: red; font-size: 30px; font-weight: bold; margin-top: 40px">от 2500 руб</h2>
            <br>
            <div>
                <h1 style="margin-top: 40px; margin-bottom: 40px">Екатерининский Дворец</h1>
            </div>
            <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                <div class="col-lg ">
                    <div class="width-adaptive">
                        <div class="theme-default">
                            <div id="slider4" class="nivoSlider">
                                <img src="{{ asset('img/tour/ekaterininskij-park1.jpg')}}" alt=""/>
                                <img src="{{ asset('img/tour/ekaterininskij-park2.jpg')}}" alt=""/>
                                <img src="{{ asset('img/tour/ekaterininskij-park3.jpg')}}" alt=""/>
                                <img src="{{ asset('img/tour/ekaterininskij-park4.jpg')}}" alt=""/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg ">
                    Екатерининский Дворец - поистине, невероятное место Санкт-Петербурга, является Объектом
                    культурного наследия
                    России. Сам дворец был заложен в 1717 году под руководством немецкого архитектора Иоганна
                    Фридриха Браунштейна как летняя резиденция императрицы Екатерины I. Здесь каждая комната дышит
                    царской роскошью — там вершилась история...<br><br>
                    Екатерининский парк — это уникальная территория площадью в 107 га. Здесь августейшие особы имели
                    удовольствие отдыхать. Парк состоит из двух частей: регулярного Старого сада и пейзажного
                    Английского парка.
                    Старый (Голландский) сад основал, по преданию, сам Петр I, а примерно в 1770-х, к югу от дворца
                    и вокруг Большого пруда, был разбит пейзажный «английский сад»

                </div>
            </div>
            <div>
                <h1 style="margin-top: 40px; margin-bottom: 40px">Павловск</h1>
            </div>
            <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                <div class="col-lg order-sm-first order-last">
                    Государственный художественно-архитектурный дворцово-парковый музей-заповедник (ГМЗ) «Павловск» — дворцово-парковый ансамбль конца XVIII — начала XIX веков, расположенный в Павловске, современном пригороде Санкт-Петербурга.
                    <br>Ядро комплекса — Павловский дворец, летняя резиденция императора Павла I.

                    Ко дворцу примыкает Павловский парк площадью около 600 га, раскинувшийся по обоим берегам реки Славянки, что делает его одним из крупнейших пейзажных парков в Европе.
                    <br>Дворцово-парковый ансамбль строили на протяжении около 50 лет три поколения архитекторов и оформителей: Чарлз Камерон, Винченцо Бренна, Джакомо Кваренги, Андрей Воронихин, Карло Росси.

                </div>
                <div class="col-lg order-sm-last order-first">

                    <div class="width-adaptive">
                        <div class="theme-default">
                            <div id="slider" class="nivoSlider">
                                <img src="{{ asset('img/tour/pavlovsk1.jpg')}}" alt=""/>
                                <img src="{{ asset('img/tour/pavlovsk2.jpg')}}" alt=""/>
                                <img src="{{ asset('img/tour/pavlovsk3.jpg')}}" alt=""/>
                                <img src="{{ asset('img/tour/pavlovsk4.jpg')}}" alt=""/>
                                <img src="{{ asset('img/tour/pavlovsk5.jpg')}}" alt=""/>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>
    <script src="{{ asset('datetimepicker/date.js') }}" defer></script>
    <script src="{{ asset('js/slider/slider4.js') }}" defer></script>
    <script src="{{ asset('js/slider/slider.js') }}" defer></script>
@endsection
