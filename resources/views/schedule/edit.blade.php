@extends('layouts.app')
@section('content')

    <link href="{{ asset('css/hotel-datepicker.css') }}" rel="stylesheet">

    <script src="{{ asset('js/fecha.min.js') }}" defer></script>
    <script src="{{ asset('js/hotel-datepicker/hotel-datepicker.min.js') }}" defer></script>

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2>Редактировать</h2>
                    <form action="{{route("admin.edit.schedule.mass")}}" method="post">
                        @csrf
                        <h3> Изменить расписание </h3>
                        <br>
                        <h3> Выбор дат </h3><br>
                        <div class="size">
                            <label for="date_book"><b>Выберете даты, которые нужно изменить:</b></label>
                            <input  id="input-id" name="date_book" type="text" class="form-control"
                                   placeholder="Нажмите для выбора даты" autocomplete="off" required>
                        </div>
                        <br>
                        <div class="size">
                            <label for="cost"><b>Цена за ночь:</b></label>
                            <input   name="cost" type="number" class="form-control"
                                    placeholder="Цена..." autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <input class="btn btn-outline-primary" type="submit" value="Изменить">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{ asset('js/calendars/schedule_cal3.js') }}" defer></script>
    @endpush

@endsection
