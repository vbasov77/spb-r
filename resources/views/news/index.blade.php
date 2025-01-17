@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{asset('css/articles/all_article.css')}}">
    <center><h1 style="margin: 60px 0 40px 0">News</h1></center>
    <link rel="stylesheet" href="{{asset('css/for_index/for_index.css')}}">

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div id="col-md" class="col-md-9">
                @if(count($news))
                    @foreach($news as $item)
                        @php
                            $img = json_decode($item->img)
                        @endphp

                        <div class="card" style="margin-top: 25px;">
                            <div class="card-body" style="text-align: left;">
                                <a class="link" style="text-decoration: none"
                                   href="{{route('post', ["id"=>$item['id']])}}">
                                    @if(!empty($img[0]))

                                        <img src="{{$img[0]}}"
                                             height="150px" width="auto" class="rightM box3" style="object-fit: cover;">
                                    @else
                                        <img src="{{ asset("images/no_image/no_image.jpg") }}"
                                             height="150px" width="auto"
                                             class="rightM box3">
                                    @endif
                                    <div class="textBlock">
                                        {{mb_substr($item ['text'],  0, 250, 'UTF-8') }}...
                                        <br>
                                        <p style="font-size: 10px; margin-top: 20px; float: left">{{date('d.m.Y', strtotime($item['created_at']))}}</p>
                                    </div>
                                    <br>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <br>
                    {{$news->links()}}

                @else
                    Нет материала
                @endif
            </div>
        </div>
    </div>
@endsection