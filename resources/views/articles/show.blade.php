@extends('layouts.articles', ['title' => $article['name']])
@section('content')

    <style>
        img.rightM {
            float: right;
            opacity: .6;
        }
    </style>
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    @isset($article["block_up"])
                        {!! $article["block_up"] !!}
                    @endisset
                </div>
            </div>
        </div>
    </section>
    @include('blocks.search_article')
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="block-s">
                        @guest()
                        @else
                            @if(Auth::user()->isAdmin())
                                <div style="margin: 60px 0 40px 0">
                                    <button class="btn btn-outline-info btn-sm"
                                            style="margin: 5px"
                                            onclick="window.location.href = '{{route("update.article", ['id'=>$article['id']])}}'">
                                        Редактировать
                                    </button>
                                </div>
                            @endif
                        @endguest
                        @if(str_contains($article->tags, "php"))
                            <img src="{{asset("images/programming_language/php.svg")}}"
                                 height="70px" width="70px" class="rightM">
                        @elseif(str_contains($article->tags, "java"))
                            <img src="{{asset("images/programming_language/java.svg")}}"
                                 height="75px" width="75px" class="rightM">
                        @elseif(str_contains($article->tags, "js"))
                            <img src="{{asset("images/programming_language/js.svg")}}"
                                 height="70px" width="70px" class="rightM">
                        @elseif(str_contains($article->tags, "jq"))
                            <img src="{{asset("images/programming_language/jq.svg")}}"
                                 height="75px" width="75px" class="rightM">
                        @elseif(str_contains($article->tags, "css"))
                            <img src="{{asset("images/programming_language/css.svg")}}"
                                 height="70px" width="70px" class="rightM">
                        @else
                            <img src="{{asset("images/programming_language/abra.svg")}}"
                                 height="70px" width="70px" class="rightM">
                        @endif
                        <h3 style="margin: 60px 0 40px 0">{{$article['title']}}</h3>

                        @isset($article["block"])
                            {!! $article["block"] !!}
                        @endisset
                        <div style="text-align: left; margin-top: 40px">
                            {!!  $article ['text'] !!}
                        </div>

                        @if(str_contains($article->tags, "php"))
                            <img src="{{asset("images/programming_language/php.svg")}}"
                                 height="70px" width="70px">
                        @elseif(str_contains($article->tags, "java"))
                            <img src="{{asset("images/programming_language/java.svg")}}"
                                 height="75px" width="75px">
                        @elseif(str_contains($article->tags, "js"))
                            <img src="{{asset("images/programming_language/js.svg")}}"
                                 height="70px" width="70px">
                        @elseif(str_contains($article->tags, "jq"))
                            <img src="{{asset("images/programming_language/jq.svg")}}"
                                 height="75px" width="75px">
                        @elseif(str_contains($article->tags, "css"))
                            <img src="{{asset("images/programming_language/css.svg")}}"
                                 height="70px" width="70px">
                        @else
                            <img src="{{asset("images/programming_language/abra.svg")}}"
                                 height="70px" width="70px">
                        @endif
                    </div>
                    @guest()
                    @else
                        @if(Auth::user()->isAdmin())
                            <div style="margin: 60px 0 40px 0">
                                <button class="btn btn-outline-info btn-sm"
                                        style="margin: 5px"
                                        onclick="window.location.href = '{{route("update.article", ['id'=>$article['id']])}}'">
                                    Редактировать
                                </button>
                            </div>
                        @endif
                    @endguest
                </div>
            </div>
        </div>
        @include('blocks.btn-ap')
    </section>

@endsection