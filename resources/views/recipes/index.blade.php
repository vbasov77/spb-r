@extends('layouts.recipes')
@section('content')
    <link rel="stylesheet" href="{{asset('css/for_index/for_index.css')}}">
    <link rel="stylesheet" href="{{asset('css/articles/all_article.css')}}">

    <center><h1 style="margin: 60px 0 40px 0">Рецепты</h1></center>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div id="col-md" class="col-md-9">
                @if(count($recipes))
                    @foreach($recipes as $item)
                        @php
                            $elements = json_decode($item->elements);
                            $count = count($elements);
                            $img = null;
                            for ($i = 0; $i < $count; $i++) {
                                if ($elements[$i]->elem === 'img') {
                                    $img = $elements[$i]->v;
                                    break;
                                }
                            }
                        @endphp
                        <div class="card" style="margin-top: 25px;">
                            <div class="card-body" style="text-align: left;">
                                <a class="link" style="text-decoration: none"
                                   href="{{route('recipe', ["id"=>$item['id']])}}">
                                    @if(!empty($img))
                                        <img src="{{$img}}"
                                             height="150px" width="auto" class="rightM box3" style="object-fit: cover;">
                                    @else
                                        <img src="{{ asset("images/no_image/no_image.jpg") }}"
                                             height="150px" width="auto"
                                             class="rightM box3">
                                    @endif
                                    <div class="textBlock">
                                        <h3>{{$item ['title']}}<br></h3>
                                        {{$item ['description']}}...
                                        <br>
                                    </div>
                                    <br>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <br>
                    {{$recipes->links()}}
                @else
                    Нет материала
                @endif
            </div>
        </div>
    </div>
@endsection