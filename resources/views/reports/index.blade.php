@extends('layouts.app')
@section('content')
    <style>
        .custom-tooltip .tooltip-text {
            visibility: hidden;
            position: absolute;
            background-color: black;
            color: white;
            font-family: emoji;
            padding: 10px;
        }

        @media (max-width: 600px) {
            .indexTable {
                font-size: 7px;
            }
            .mob{
                display: none;
            }
        }


        .custom-tooltip:hover .tooltip-text {
            visibility: visible; /* Вот такое чудо! */
        }
    </style>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <section class="about-section text-center" id="about">
        <div class="container-fluid">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-9 indexTable">
                    <h1 style="margin-top: 40px">Весь период</h1>
                    @if(!empty(count($reports)))
                        <table style="text-align: left" class="table">
                            <thead>
                            <tr>
                                <th scope="col">Период</th>
                                <th scope="col">Ночей</th>
                                <th scope="col">Сумма</th>
                                <th scope="col">Затраты</th>
                                <th scope="col">Итог</th>
                                <th scope="col">Панель</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <th scope="row"> {{$report->v_period}} </th>
                                    <th scope="row"> {{$report->count_night}} </th>
                                    <th scope="row"> {{$report->sum}}<img class="mob" style="padding-bottom: 2px;" width="14px"
                                                                          src="{{asset("icons/ruble.svg")}}">
                                    </th>
                                    <th scope="row"
                                        class="custom-tooltip"
                                        title="">{{$report->expenses}}
                                        <img  class="mob" style="padding-bottom: 2px;" width="13px"
                                              src="{{asset("icons/ruble.svg")}}">
                                        <span class="tooltip-text">{{ $report->info_expenses }}</span>
                                    </th>

                                    <th scope="row"> {{$report->sum - $report->expenses}}
                                        <img class="mob" style="padding-bottom: 2px;" width="14px"
                                             src="{{asset("icons/ruble.svg")}}">
                                    </th>

                                    <th scope="row">
                                        <a title="Редактировать" class="rem"
                                           href="{{route('admin.create.report', ['id' => $report->id])}}">
                                            <img src="{{ asset('icons/edit.svg') }}" style="width: 14px;"></a></th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <h2 style="margin-top: 50px">Графики</h2>
                        <canvas id="popChart" width="600" height="300"></canvas>
                        <br>
                        <canvas id="incomeAndExpensesChart" width="600" height="300"></canvas>
                        <br>
                        <canvas id="weekday" width="600" height="300"></canvas>
                        <br>
                        <canvas id="countNight" width="600" height="300"></canvas>

                    @else
                        Отчётов пока не найдено...
                    @endif
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            var dataSum = @json($sumStr);
            var expensesStr = @json($expensesStr);
            var total = @json($total);
            var weekday = @json($weekday);
            var countNight = @json($countNight);
            var months = @json($months);
        </script>
        <script src="{{ asset('js/chart/chart.min.js') }}" defer></script>
        <script src="{{ asset('js/chart/v_chart.js') }}" defer></script>
        <script src="{{ asset('js/chart/income_and_expenses.js') }}" defer></script>
        <script src="{{ asset('js/chart/weekday.js') }}" defer></script>
        <script src="{{ asset('js/chart/count_night.js') }}" defer></script>

    @endpush
@endsection
