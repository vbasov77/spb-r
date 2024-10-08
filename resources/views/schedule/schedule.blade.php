@extends('layouts.app')
@section('content')
    <link href="{{ asset('css/hotel-datepicker.css') }}" rel="stylesheet">

    <script src="{{ asset('js/fecha.min.js') }}" defer></script>
    <script src="{{ asset('js/hotel-datepicker/hotel-datepicker.min.js') }}" defer></script>

    <div class="container mt-5 mb-5">
        <form action="{{route('admin.schedule.add')}}" method="post">
            @csrf
            <h3> Создать расписание </h3>
            <br>
            <h3> Выбор дат </h3><br>
            <div>
                <label for="date_book"><b>Выберете даты:</b></label>
                <input id="input-id" name="date_book" type="text" class="form-control"
                       placeholder="Нажмите для выбора даты" autocomplete="off" required>
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

    @push("scripts")
        <script>
            var datebook = @json($dateBook);
        </script>
        <script src="{{ asset('js/calendars/schedule_cal2.js') }}" defer></script>
    @endpush

@endsection
