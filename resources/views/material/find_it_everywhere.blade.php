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
                        <input type="hidden" name="objId" value="0">

                        <button type="submit"><img width="20px" src="{{asset('/icons/search.svg')}}"></button>
                    </form>
                    <br>
                    <button class="btn btn-outline-info btn-sm" type="submit" id="deleteSession">Очистить</button>
                </div>
            </div>
        </div>
    </section>
    <section>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="{{asset('js/search/search.js')}}" defer></script>
    </section>
@endsection
