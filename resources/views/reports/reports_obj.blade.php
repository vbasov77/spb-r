@extends('layouts.app')
@section('content')
    <style>
        input#input-id {
            display: none;
        }

        .datepicker__info.datepicker__info--feedback.datepicker__info--help {
            display: none;
        }

        button#clear-input-id {
            display: none;
        }

        .datepicker__topbar {
            display: none;
        }

        div#datepicker-input-id {
            right: 0;
            left: 0;
            margin: auto;
        }
    </style>

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">

                    @php
                        $_monthsList = [
    "1"=>"Январь","2"=>"Февраль","3"=>"Март",
    "4"=>"Апрель","5"=>"Май", "6"=>"Июнь",
    "7"=>"Июль","8"=>"Август","9"=>"Сентябрь",
    "10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь"];
    $month = $_monthsList[date("n")];
                    @endphp
                    <div>
                        Занятых ночей <b>{{$month}} - {{$count_night}} </b><br>
                        Сумма <b>{{$month}} - {{$sum}} </b><br>
                    </div>

                    <div class="container picker">
                        <div style="margin-top: 40px">
                            <center>
                                <input id="input-id" name="date_book" type="text"
                                       class="form-control text-center"
                                       value="{{session('date_book') ?? '' }}"
                                       placeholder="Нажмите для просмотра" autocomplete="off"
                                       readonly="readonly"
                                       required>
                            </center>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            var datebook = @json($date_book);
        </script>
        <script src="{{ asset('js/calendars/calendar.js') }}" defer></script>
    @endpush
@endsection
