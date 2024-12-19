@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{asset('css/search/search.css')}}">
    <section class="about-section text-center">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-8" style="margin-top: 60px">
                    <form class="example" method="post" action="{{route('admin.search')}}">
                        @csrf
                        <input id="input" type="search" value="{{session("search")}}" placeholder="Поиск...."
                               name="search" required>
                        <input type="hidden" name="objId" value="{{$objId}}">
                        <button type="submit"><img width="20px" src="{{asset('/icons/search.svg')}}"></button>
                    </form>
                    <br>
                    <button class="btn btn-outline-info btn-sm" type="submit" id="deleteSession">Очистить</button>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="row justify-content-center ">
            <div class="col">
                <h1 style="margin-top: 50px">Все материалы</h1>
                <br>
                <br>
                @if (!empty(count($data)))
                    <table style="text-align: left; font-size: 11px;" class="table">
                        <thead>
                        <tr>
                            <th scope="col">Название</th>
                            <th scope="col">Количество</th>
                            <th scope="col">Сумма</th>
                            <th scope="col">Инструмент</th>
                        </tr>
                        </thead>
                        @php($total = 0)
                        <tbody>
                        @foreach($data as $value)
                            @php($total += $value->price)
                            <tr>
                                <th scope="row"> {{ $value->title }}</th>
                                <th scope="row"> {{ $value->quantity }}</th>
                                <th scope="row">{{ $value->price }}</th>
                                <th scope="row">
                                    <a onClick="return confirm('Подтвердите редактирование!')"
                                       title="Редактировать"
                                       href='{{route('admin.edit.material', ['id' => $value->id])}}' type='button'
                                       class='btn btn-outline-success btn-sm' style="margin: 5px">
                                        <img src="{{asset('icons/edit.svg')}}" width="16px" alt="">
                                    </a>
                                    <a onClick="return confirm('Подтвердите просиотр!')"
                                       title="Редактировать"
                                       href='{{route('admin.show.material', ['id' => $value->id])}}' type='button'
                                       class='btn btn-outline-success btn-sm' style="margin: 5px">
                                        <img src="{{asset('icons/eye.svg')}}" width="16px" alt="">
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <h4>ИТОГО:</h4>
                    <h5>{{$total}} руб.</h5>
                @else
                    Нет материала
                @endif
            </div>
        </div>
    </div>
    <section>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="{{asset('js/search/search.js')}}" defer></script>
    </section>
@endsection
