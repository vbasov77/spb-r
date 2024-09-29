@extends('layouts.app')
@section('content')

    <script src="{{ asset('js/fecha.min.js') }}" defer></script>
    <link href="{{ asset('css/hotel-datepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('js/hotel-datepicker/hotel-datepicker.min.js') }}" defer></script>

    <link href="{{ asset('css/checkbox/radio.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Предварительное бронирование</div>
                    <div class="card-body">
                        @if($errors->any())
                            @foreach($errors -> all() as $error)
                                <x-alert type="danger" :message="$error"/>
                            @endforeach
                        @endif
                        <div id="info"></div>
                        <form id="form" action="{{route('admin.in.queue')}}" method="post">
                            @csrf
                            <div>
                                <label for="date_book"><b>Выберете дату:</b></label>
                                <input id="input-id" style="display:inline" name="date_book" type="text"
                                       value="{{old('date_book')}}"
                                       class="form-control @error("date_book") is-invalid @enderror"
                                       placeholder="Нажмите для выбора даты" autocomplete="off" readonly="readonly"
                                       required>
                            </div>
                            <br>
                            <div>
                                <label for="Имя"><b>Имя:</b></label>
                                <input name="name" id="name" type="text"
                                       class="form-control @error("name") is-invalid @enderror"
                                       value="{{old('name')}}" placeholder="ФИО" required>
                            </div>
                            <br>
                            <div>
                                <label for="phone"><b>Телефон:</b></label><br>
                                <input name="phone" type="text"
                                       class="tel form-control @error("phone") is-invalid @enderror" id="phone"
                                       value="{{old('phone')}}" placeholder="+7(000) 000-0000" required>
                            </div>

                            <br>
                            <div>
                                <b>Предпочтительный мессенджер:</b><br>
                            </div>
                            <div class='form_radio_btn2 my_mobile' style="text-align: center;">
                                <input type='radio' id="initial1" name="messenger" value="WhatsApp" required
                                ><label for='initial1'>WhatsApp</label></div>

                            <div class='form_radio_btn2 my_mobile' style="text-align: center;">
                                <input type='radio' id="initial2" name="messenger" value="Telegram" required
                                ><label for='initial2'>Telegram</label></div>
                            <div>
                                <input class="btn btn-outline-primary" id="calendar" type="submit" value="Продолжить">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var datebook = @json($data['date_book']);

        </script>
        <script src="{{ asset('js/mask.js') }}" defer></script>
        <script src="{{ asset('js/calendar.js') }}" defer></script>
    @endpush
@endsection
