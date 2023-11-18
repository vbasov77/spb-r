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
                    <h3>Заполните форму</h3>
                    @if($errors->any())
                        @foreach($errors -> all() as $error)
                            <x-alert type="danger" :message="$error"/>
                        @endforeach
                    @endif
                    <form id="form" action="{{route("add.order.info")}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{implode(",", $date_view) }}" name="date_view">

                        <input type="hidden" name="sum" value="{{$sum}}">
                        <div class="border_none">
                            <label for="date_book"><b>Выбранные даты:</b></label><br>

                            <input class="form-control" value="{{$data['date_book']}}"
                                   readonly="readonly" type="text"
                                   name="date_book"
                                  ><br>
                        </div>
                        <br>
                        <div style="background: #e9ecef; padding: 15px;">
                            @foreach($date_view as $dat)
                                {!! $dat !!}<br>
                            @endforeach

                        </div>
                        <br>
                        <div id="info"></div>
                        <br>
                        <div>
                            <label for="phone"><b>Телефон:</b></label><br>
                            <input name="phone" type="text"
                                   class="tel form-control @error("phone") is-invalid @enderror" id="phone"
                                   value="{{old("phone")}}" placeholder="+7(000) 000-0000" required>
                        </div>
                        <br>

                        <div>
                            <label for="email"><b>Email:</b></label>
                            <input name="email" type="email"
                                   class="form-control @error("email") is-invalid @enderror" id="email"
                                   value="{{old("email")}}" placeholder="Email" required>
                        </div>

                        <br>

                        @for ($i = 1; $i <= $data['guests']; $i++)
                            <h3> {!! $i !!} гость</h3>

                            <div>
                                <label for="ФИО"><b>ФИО:</b></label>
                                <input name="user_name[]" id="user_name" type="text"
                                       class="form-control @error("user_name") is-invalid @enderror"
                                       value="{{old("user_name")}}" placeholder="ФИО" required>
                            </div>

                            <div>
                                <label for="age"><b>Возраст:</b></label>
                                <input name="age[]" type="text"
                                       class="form-control @error("age") is-invalid @enderror"
                                       value="{{old("age")}}" placeholder="Полных лет" required>
                            </div>

                            <div>
                                <label for="district"><b>Район:</b></label>
                                <input name="district[]" type="text"
                                       class="form-control  @error("district") is-invalid @enderror"
                                       value="{{old("district")}}"
                                       placeholder="Город, область жительства" required>
                            </div>
                            <br>
                        @endfor

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

        <script src="{{ asset('js/mask.js') }}" defer></script>
        <script src="{{ asset('js/checks/check_add_calendar.js') }}" defer></script>
        <script src="{{ asset('js/close/close.js') }}" defer></script>

    @endpush
@endsection
