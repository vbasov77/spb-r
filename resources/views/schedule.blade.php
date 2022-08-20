@extends('layouts.app')
@section('content')

    <script>

        var datebook = @json($date_book);
        {{--var noin= @json($no_in);--}}
        {{--var noout= @json($no_out);--}}
    </script>

    <div class="container mt-5 mb-5" >
        <form action="/add_schedule" method="post">
            @csrf
            <h3> Создать расписание </h3>
            <br>
            <h3> Выбор дат </h3><br>
            <div>
                <label for="date_book"><b>Выберете даты:</b></label>
                <input id="input-id" name="date_book" type="text" class="form-control"
                       placeholder="Нажмите для выбора даты" autocomplete="off"required>
            </div>
            <br>
            <div>
                <label for="cost"><b>Минимальная стоимость:</b></label>
                <input name="cost" type="text" class="form-control"
                       placeholder="Минимальная цена" required>
            </div>
            <br>
            <div>
                <input class="btn btn-outline-primary" type="submit" value="Создать">
            </div>
        </form>

    </div>


    <script src="{{ asset('js/calendars/schedule_cal2.js') }}" defer></script>




    {{--    <form action="/add_calendar" method="post" >--}}
    {{--        @csrf--}}
    {{--        <div>--}}
    {{--            <input type="text" id="el" name="el" class="datepicker-here" data-position="right top" method="post"/>--}}

    {{--        </div>--}}
    {{--        <input class="form_button" type="submit" value="Отправить">--}}
    {{--    </form>--}}


@endsection
