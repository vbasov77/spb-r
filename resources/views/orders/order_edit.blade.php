@extends('layouts.app')
@section('content')

    <style>
        input.tel {
            margin-bottom: 15px;
        }
    </style>

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h3>Редактировать заказ</h3>

                    <form action="/order_edit" method="post">

                        @csrf
                        <div class="border_none">
                            <label for="id"><b>ID заказа</b></label><br>

                            <input class="form-control" value="{{$order[0]['id']}}" readonly="readonly" type="text"
                                   name="id"
                                   method="post"><br>

                        </div>


                        <div class="border_none">
                            <label for="date_book"><b>Выбранные даты:</b></label><br>

                            <input class="form-control" value="
                                      {!!  $order[0]['no_in']  !!}
                                    - {!!  $order[0]['no_out'] !!}"
                                   readonly="readonly" type="text"
                                   name="date_book"
                                   method="post"><br>

                        </div>

                        <div class="border_none">
                            <label for="user_name"><b>ФИО:</b></label><br>

                            <input class="form-control" value="{!! $order[0]['user_name'] !!}" type="text"
                                   name="user_name"
                                   method="post"><br>

                        </div>

                        <div class="border_none">
                            <label for="phone"><b>Телефон:</b></label><br>

                            <input class="tel" value="{!! $order[0]['phone'] !!}" type="text"
                                   name="phone"
                                   method="post"><br>

                        </div>

                        <div class="border_none">
                            <label for="email"><b>Email:</b></label><br>

                            <input class="form-control" value="{!! $order[0]['email'] !!}" type="text"
                                   name="email"
                                   method="post"><br>

                        </div>

                        <div class="border_none">
                            <label for="nationality"><b>Гражданство:</b></label><br>

                            <input class="form-control" value="{!! $order[0]['nationality'] !!}" type="text"
                                   name="nationality"
                                   method="post"><br>

                        </div>
                        <br>


                        <div class="border_none">
                            <label for="total"><b>Сумма:</b></label><br>

                            <input class="form-control" value="{!! $order[0]['total'] !!}" type="text"
                                   name="total"
                                   method="post"><br>

                        </div>

                        <div>
                            <input class="btn btn-outline-primary" type="submit" value="Редактировать">
                        </div>
                        <br>
                        <br>

                    </form>
                </div>
            </div>

        </div>
    </section>
    <script src="{{ asset('js/mask.js') }}" defer></script>
@endsection
