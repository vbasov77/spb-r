@extends('layouts.create_material')
@section('content')
    <link rel="stylesheet" href="{{asset('css/search/search.css')}}">
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
    <section>
        <script src="{{ asset('js/autocomplite/autocomplite.js') }}" defer></script>
        <script type="text/javascript" src="{{asset('js/search/search.js')}}" defer></script>
    </section>
@endsection
