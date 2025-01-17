@extends('layouts.create_material')
@section('content')
    <link rel="stylesheet" href="{{asset('css/search/search.css')}}">
    <link rel="stylesheet" href="{{asset('css/for_index/for_index.css')}}">
    <section class="about-section text-center">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-8" style="margin-top: 60px">
                    <form class="example" method="post" action="{{route('admin.search')}}">
                        @csrf
                        <input id="value" type="search" value="{{session("search")}}" placeholder="Поиск...."
                               name="title" required>
                        <input type="hidden" name="objId" value="0">
                        <button type="submit"><img width="20px" src="{{asset('/icons/search.svg')}}"></button>
                        <br>
                        <div id="dropdown">
                            <select style="background-color: gainsboro; margin-top: 5px; position: relative; float: left;" class="select" name="list" id="list"></select>
                        </div>

                    </form>
                    <br>
                    <button class="btn btn-outline-info btn-sm" type="submit" id="deleteSession">Очистить</button>
                </div>
            </div>
        </div>
    </section>

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div id="col-md" class="col-md-9">
                @if(count($materials))
                    @foreach($materials as $material)
                        <div class="card" style="margin-top: 25px;">
                            <div class="card-body" style="text-align: left;">
                                <a class="link" style="text-decoration: none"
                                   href="{{route('admin.show.material', ["id"=>$material->id])}}">
                                    @if(!empty($material->path))
                                        <img src="{{$material->path}}"
                                             height="150px" width="auto" class="rightM box3" style="object-fit: cover;">
                                    @else
                                        <img src="{{ asset("images/no_image/no_image.jpg") }}"
                                             height="150px" width="auto"
                                             class="rightM box3">
                                    @endif
                                    <div class="textBlock">
                                        <div class="textBlock">
                                            <h3 style="font-family: cursive">{{$material->title}}</h3>
                                            <br>
                                            <small><i>{{$material->description}}</i></small>
                                            <br>
                                            <small><i><b>Сумма: {{$material->price}}</b></i>
                                                <img width="17px" height="auto" src="{{asset('icons/ruble.svg')}} "></small>
                                            <br>
                                            <small><i><b>Количество: {{$material->quantity}}</b></i></small>
                                            <br>
                                        </div>
                                    </div>
                                    <br>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <br>
                @else
                    Нет материала
                @endif
            </div>
        </div>
    </div>

    <section>
        <script src="{{ asset('js/autocomplite/autocomplite.js') }}" defer></script>
        <script type="text/javascript" src="{{asset('js/search/search.js')}}" defer></script>
    </section>
@endsection
