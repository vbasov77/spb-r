@extends('layouts.app')
@section('content')

    <link href="{{ asset('css/checkbox/radio.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Предварительное бронирование</div>
                    <div class="card-body">
                        <div id="info"></div>
                        <form id="form" action="{{route('admin.update.queue', ['id' => $data->id])}}" method="post">
                            @csrf
                            <div>
                                <label for="date_book"><b>Выберете дату:</b></label>
                                <input id="input-id" style="display:inline" name="date_book" type="text"
                                       class="form-control"
                                       value="{{date("d.m.Y", $data->date_in)}} - {{date("d.m.Y", $data->date_out)}}"
                                       placeholder="Нажмите для выбора даты" autocomplete="off" readonly="readonly"
                                       required>
                            </div>
                            <br>
                            <div>
                                <label for="Имя"><b>Имя:</b></label>
                                <input name="name" id="name" type="text" class="form-control"
                                       value="{{$data->name}}" placeholder="ФИО" required>
                            </div>
                            <br>
                            <div>
                                <label for="phone"><b>Телефон:</b></label><br>
                                <input name="phone" type="text" class="tel form-control" id="phone"
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
