@extends('layouts.app')
@section('content')


    <script src="{{ asset('datetimepicker/jquery.datetimepicker.full.min.js') }}" defer></script>
    <link href="{{ asset('datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">

    <style>
        .xdsoft_timepicker.active {
            display: block;
            width: 350px;
        }
    </style>
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h3>Редактировать заказ</h3>
                    <form action="/add_tourism" method="post">
                        @csrf
                        <div class="border_none">
                            <label for="id"><b>Дата</b></label><br>

                            <input class="form-control" value="<?= $data['date_tour'] ?>" readonly="readonly"
                                   type="text"
                                   name="date_tour"
                                   method="post"><br>
                        </div>
                        <div>
                            <label for="timep"><b>Выберете время:</b></label><br>
                            <input type="text" id="datetimepicker" name="time_tour" class="form-control" required>
                        </div>

                        <br>
                        <div>
                            <label for="phone"><b>Телефон:</b></label><br>
                            <input class="tel form-control" value="<?= $data['phone'] ?? ''?>" type="text"
                                   name="phone" required
                                   method="post"><br>
                        </div>
                        <input type="hidden" name="name_tour" value="Пушкин&Павловск">
                        <div>
                            <label for="user_name"><b>Имя:</b></label><br>
                            <input class="form-control" value="<?= $data ['user_name'] ?? '' ?>" type="text"
                                   name="user_name" required
                                   method="post"><br>

                        </div>
                        <label for="email"><b>Email:</b></label><br>
                        <input id="foo" class="form-control" value="<?= $data ['email'] ?? '' ?>" type="email"
                               name="email" onKeypress="javascript:if(event.keyCode == 32)event.returnValue = false;" required
                               method="post"><br>
                        <div>
                            <br>
                            <label for="guests"><b>Количество персон:</b></label><br>
                            <label><input type="radio" name="guests" value="1" required> 1 персона</label>
                            <label><input type="radio" name="guests" value="2" required> 2 персоны</label>
                            <label><input type="radio" name="guests" value="3" required> 3 персоны</label>
                            <br>
                        </div>
                        <br>
                        <div>
                            <label for="total"><b>Сумма:</b></label><br>
                            <input class="form-control" value="<?= $data ['total'] ?>" type="text"
                                   name="total" readonly
                                   method="post"><br>
                        </div>
                        <div>
                            <input class="btn btn-outline-primary" type="submit" value="Забронировать">
                        </div>
                        <br>
                        <br>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <script src="{{ asset('js/email.js') }}" defer></script>
    <script src="{{ asset('js/mask.js') }}" defer></script>
    <script src="{{ asset('datetimepicker/time.js') }}" defer></script>
@endsection
