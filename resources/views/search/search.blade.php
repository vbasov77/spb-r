@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{asset('css/search/search.css')}}">
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
            background: #fff;
            border: solid black;
            border-color: black;
        }

        .box3 {
            border-width: 5px 3px 3px 5px;
            border-radius: 95% 4% 97% 5%/4% 94% 3% 95%;
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
    <!-------------------------------------------------------------    Форма поиска-->
    <section class="about-section text-center">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-9" style="margin-top: 60px">
                    <form class="example" method="post" action="{{route('admin.search')}}">
                        @csrf
                        <input id="input" type="search" value="{{session('search')}}"
                               placeholder="Поиск...." name="search" required>
                        <button style="float: right" type="submit"><img width="20px"
                                                                        src="{{asset('/icons/search.svg')}}"></button>
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
                                        <h3>{{$material->title}}</h3><br>
                                        {{$material->description}}
                                        <br>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script type="text/javascript" src="{{asset('js/search/search.js')}}" defer></script>
    </section>
@endsection
