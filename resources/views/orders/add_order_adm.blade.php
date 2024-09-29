@extends('layouts.app')
@section('content')
    <script src="{{ asset('js/fecha.min.js') }}" defer></script>
    <link href="{{ asset('css/hotel-datepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('js/hotel-datepicker/hotel-datepicker.min.js') }}" defer></script>
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h3>Заполните форму</h3>
                    @if($errors->any())
                        @foreach($errors -> all() as $error)
                            <x-alert type="danger" :message="$error"/>
                        @endforeach
                    @endif
                    <form id="form" action="{{route("admin.add_order_is_admin")}}" method="POST">
                        @csrf
                        <div>
                            <label for="date_book"><b>Выберете дату:</b></label>
                            <input id="input-id" style="display:inline" name="date_book" type="text"
                                   class="form-control @error("user_name") is-invalid @enderror"
                                   placeholder="Нажмите для выбора даты" autocomplete="off" readonly="readonly"
                                   required>
                        </div>
                        <br>
                        <div>
                            <label for="phone"><b>Телефон:</b></label><br>
                            <input name="phone" type="text"
                                   class="tel form-control @error("phone") is-invalid @enderror" id="phone"
                                   value="{{old("phone")}}" placeholder="+7(000) 000-0000" required>
                        </div>
                        <br>
                        <div>
                            <label for="ФИО"><b>ФИО:</b></label>
                            <input name="user_name" id="user_name" type="text"
                                   class="form-control @error("user_name") is-invalid @enderror"
                                   value="{{old("user_name")}}" placeholder="ФИО" required>
                        </div>

                        <div>
                            <label for="age"><b>Возраст:</b></label>
                            <input name="age" type="text"
                                   class="form-control @error("age") is-invalid @enderror"
                                   value="{{old("age")}}" placeholder="Полных лет" required>
                        </div>

                        <div>
                            <label for="district"><b>Район:</b></label>
                            <input name="district" type="text"
                                   class="form-control  @error("district") is-invalid @enderror"
                                   value="{{old("district")}}"
                                   placeholder="Город, область жительства" required>
                        </div>

                        <div>
                            <label for="total"><b>Сумма:</b></label>
                            <input name="total" type="number"
                                   class="form-control  @error("total") is-invalid @enderror"
                                   value="{{old("total")}}"
                                   placeholder="Сумма" required>
                        </div>
                        <br>
                        <div>
                            <input class="btn btn-outline-primary" id="submit" type="submit" value="Продолжить">
                        </div>
                        <br>
                        <br>
                    </form>
                </div>
            </div>

        </div>
    </section>
    @push("scripts")
        <script>
            var datebook = @json($data['date_book']);
        </script>

        <script src="{{ asset('js/mask.js') }}" defer></script>
        <script src="{{ asset('js/checks/check_add_calendar.js') }}" defer></script>
        <script src="{{ asset('js/close/close.js') }}" defer></script>
        <script src="{{ asset('js/calendars/cal_for_admin.js') }}" defer></script>
    @endpush
@endsection
