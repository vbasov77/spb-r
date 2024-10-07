@extends('layouts.app')
@section('content')

    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h3>Парсер со стен групп.</h3>
                    <p>Файл с id групп создан заранее. После того, как вы нажмёте на кнопку "Парсить"
                        <br>парсер начнёт собирать информацию со стен групп за выбранный период.</p>

                    <form action="{{route("admin.parser.store-wallGroupsNews")}}" method="post">
                        @csrf
                        <label for="calendar">Выберете дату:</label><br>
                        <input id="calendar" name="date" class="form-control" type="date" value="{{$date}}"/>
                        <br>
                        <br>
                        <div>
                            <input class="btn btn-outline-success btn-sm" type="submit" value="Парсить">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>




@endsection