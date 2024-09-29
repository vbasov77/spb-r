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
                        <div id="info"></div>
                        @if($errors->any())
                            @foreach($errors -> all() as $error)
                                <x-alert type="danger" :message="$error"/>
                            @endforeach
                        @endif
                        <form id="form" action="{{route('admin.update.queue', ['id' => $data->id])}}" method="post">
                            @csrf
                            <div>
                                <label for="date_book"><b>Выберете дату:</b></label>
                                <input id="input-id" style="display:inline" name="date_book" type="text"
                                       class="form-control @error("date_book") is-invalid @enderror"
                                       value="{{date("d.m.Y", $data->date_in)}} - {{date("d.m.Y", $data->date_out)}}"
                                       placeholder="Нажмите для выбора даты" autocomplete="off" readonly="readonly"
                                       required>
                            </div>
                            <br>
                            <div>
                                <label for="Имя"><b>Имя:</b></label>
                                <input name="name" id="name" type="text"
                                       class="form-control @error("name") is-invalid @enderror"
                                       value="{{$data->name}}" placeholder="ФИО" required>
                            </div>
                            <br>
                            <div>
                                <label for="phone"><b>Телефон:</b></label><br>
                                <input name="phone" type="text"
                                       class="tel form-control @error("phone") is-invalid @enderror" id="phone"
                                       value="{{$data->phone}}" placeholder="+7(000) 000-0000" required>
                            </div>

                            <br>
                            <div>
                                <b>Предпочтительный мессенджер:</b><br>
                            </div>
                            <div class='form_radio_btn2 my_mobile' style="text-align: center;">
                                <input type='radio' id="WhatsApp" name="messenger" value="WhatsApp" required
                                ><label for='WhatsApp'>WhatsApp</label></div>

                            <div class='form_radio_btn2 my_mobile' style="text-align: center;">
                                <input type='radio' id="Telegram" name="messenger" value="Telegram" required
                                ><label for='Telegram'>Telegram</label></div>
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
            let messenger = @json($data ['messenger']);
            var datebook = @json($datesBook);
        </script>


        <script src="{{ asset('js/radio/radio.js') }}" defer></script>
        <script src="{{ asset('js/mask.js') }}" defer></script>
        <script src="{{ asset('js/calendar.js') }}" defer></script>
    @endpush
@endsection
