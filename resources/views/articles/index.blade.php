@extends('layouts.articles', ['title' => 'Заметки'])
@section('content')
    <link rel="stylesheet" href="{{asset('css/articles/all_article.css')}}">
    @include('blocks.btn-ap')
    @include('blocks.search_article')
    <!-------------------------------------------------------------    Форма поиска-->

    <style>
        .rightM {
            width: auto;
            height: auto;
        }
    </style>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <center><h4 style="margin: 60px 0 10px 0">Поиск по тегам</h4></center>
                    @if(!empty(count($tags)))
                        @foreach($tags as $tag)
                            <a href="{{route('search.tag', ['tag'=>$tag]) }}"> {!!$tag!!}</a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <center><h3 style="margin: 60px 0 40px 0; ">Заметки</h3></center>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div id="col-md" class="col-md-9">
                @if(count($articles))
                    @foreach($articles as $value)
                        <div class="card" style="margin-top: 25px;">
                            <div class="card-body">
                                @if(str_contains($value->tags, "php"))
                                    <img src="{{asset("images/programming_language/php.svg")}}"
                                         height="30px" width="30px" class="rightM">
                                @elseif(str_contains($value->tags, "java"))
                                    <img src="{{asset("images/programming_language/java.svg")}}"
                                         height="35px" width="35px" class="rightM">
                                @elseif(str_contains($value->tags, "js"))
                                    <img src="{{asset("images/programming_language/js.svg")}}"
                                         height="30px" width="30px" class="rightM">
                                @elseif(str_contains($value->tags, "jq"))
                                    <img src="{{asset("images/programming_language/jq.svg")}}"
                                         height="35px" width="35px" class="rightM">
                                @elseif(str_contains($value->tags, "css"))
                                    <img src="{{asset("images/programming_language/css.svg")}}"
                                         height="30px" width="30px" class="rightM">
                                @else
                                    <img src="{{asset("images/programming_language/abra.svg")}}"
                                         height="30px" width="30px" class="rightM">
                                @endif
                                <a class="link" style="text-decoration: none"
                                   href="{{route('article', ["id"=>$value->id])}}">
                                    <h4>{{$value->title}}</h4></a>
                                <small><i>{{$value->description}}</i></small>
                                <br>

                            </div>
                        </div>
                    @endforeach
                    <br>
                    {{$articles->links()}}
                @else
                    Нет материала
                @endif
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <center><h4 style="margin: 60px 0 10px 0">Поиск по тегам</h4></center>
                    @if(!empty(count($tags)))
                        @foreach($tags as $tag)
                            <a href="{{route('search.tag', ['tag'=>$tag]) }}"> {!!$tag!!}</a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
