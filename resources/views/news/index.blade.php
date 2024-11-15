@extends('layouts.app')
@section('content')
    <center><h1 style="margin: 60px 0 40px 0">News</h1></center>
    <style>
        a.link {
            color: black;
            text-decoration: none;
        }

        a.link:hover h4 {
            opacity: 1;
        }

        img.rightM {
            margin-left: 10px;
            float: right;
            width: 150px;
            height: 150px;
            background:#fff;
            border: solid black;
            border-color: black;
        }

        .box3{
            border-width: 5px 3px 3px 5px;
            border-radius:95% 4% 97% 5%/4% 94% 3% 95%;
            transform: rotate(2deg);
        }

        @media screen and (max-width: 640px) {
            .col-md-9 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            img.rightM {
                width: 100%;
                margin-bottom: 20px;
            }

        }

        .page-item.active .page-link {
            background-color: #fd7e14;
            border-color: #fd7e14;
        }

    </style>
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