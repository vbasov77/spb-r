@extends('layouts.app')
@section('content')
    <center><h1 style="margin: 60px 0 40px 0">Куда сходить в СПб</h1></center>
    <style>
        a.link {
            color: black;
            text-decoration: none;
        }

        a.link:hover h4 {
            opacity: 1;
        }

        img.rightM {
            float: right;
            width: 200px;
            height: 200px;

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
            <div id="col-md" class="col-md-10">
                @if(count($places))
                    @foreach($places as $place)
                        <div class="card" style="margin-top: 25px;">
                            <div class="card-body" style="text-align: left;">
                                <a class="link" style="text-decoration: none"
                                   href="{{route('show.place', ["id" => $place->id])}}">
                                    @if(!empty($place->path))
                                        <img src="{{$place->path}}"
                                             height="150px" width="auto" class="rightM" style="object-fit: cover;">
                                    @else
                                        <img src="{{ asset("images/no_image/no_image.jpg") }}"
                                             height="150px" width="auto"
                                             class="rightM">
                                    @endif
                                    <div class="textBlock">
                                        <b>{{$place->title}}</b><br>
                                        <br>
                                        {{mb_substr($place->description,  0, 250, 'UTF-8') }}...
                                    </div>
                                    <br>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <br>
                    {{--                    {{$places->links()}}--}}
                @else
                    Нет материала
                @endif
            </div>
        </div>
    </div>
@endsection