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

                    <form action="/to_pay" method="post">

                        @csrf
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="border_none">
                            <label for="summ"><b>Сумма</b></label><br>
                            <input class="form-control" name="summ" value="" type="number" required><br>
                        </div>

                        <div>
                            <input class="btn btn-outline-primary" type="submit" value="Внести">
                        </div>
                        <br>

                    </form>
                </div>
            </div>

        </div>
    </section>

@endsection
