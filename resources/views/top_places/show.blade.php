@extends('layouts.app')
@section('content')
    <style>
        .width-slider {
            width: 60%;
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
        }

        @media (max-width: 500px) {
            .width-slider {
                width: 100%;
            }
        }
    </style>

    <section class="projects-section bg-light" id="projects">
        <div class="container px-4 px-lg-5">
            <div class="row align-items-center">
                <div style="padding: 20px">
                    <h3>{{$place->title}}</h3><br>
                </div>
                <div style="margin-bottom: 50px; text-align: left">
                    {!!nl2br(e($place->text))!!}
                </div>
            </div>
        </div>
    </section>
    <section class="projects-section bg-light" id="projects">
        <div class="container px-4 px-lg-5">
            <div class="row align-items-center">
                <div class="col-xl-12">
                    <div class="width-slider">
                        <div id="carusel" class="carousel slide" data-ride="carousel">
                            <ul class="carousel-indicators">
                                @if(!empty($images))
                                    @for ($s = 0; $s < count($images); $s++)
                                        @php
                                            if ($s == 0){
                                                 $active = "active";
                                            } else {$active = "";}
                                        @endphp
                                        <li data-target="#carusel" data-slide-to="{{$s}}" class="{{$active}}"></li>
                                    @endfor
                                @endif
                            </ul>
                            <div class="carousel-inner">
                                @if(!empty($images))
                                    @for ($i = 0; $i < count($images); $i++)
                                        @php
                                            if ($i == 0){
                                                $carusel = "carousel-item active";
                                                 } else {$carusel = "carousel-item";}
                                        @endphp
                                        <div class="{{$carusel}}">
                                            <img src="{{ asset('images/places/' . $images[$i]->path)}}" alt="">
                                        </div>
                                    @endfor
                                @else
                                    <img src="{{ asset('images/no_image/no_image.jpg')}}" alt="">
                                @endif
                                <a class="carousel-control-prev" href="#carusel" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </a>
                                <a class="carousel-control-next" href="#carusel" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </a>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </section>
    <section class="projects-section bg-light" id="projects">
        <div class="container px-4 px-lg-5">
            <div class="row align-items-center">
                <div class="col-xl-12">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <div>
                                <div>
                                    <br>
                                    <button class="btn btn-success" style="color: white; margin-top: 25px"
                                            onclick="window.location.href =
                                                    '{{route('admin.edit.place', ['id'=>$place->id])}}';">
                                        Редакторовать
                                    </button>
                                    <br>
                                    <br>
                                    <div class="btn btn-outline-danger btn-sm deletePost" type="submit">
                                        Удалить пост
                                    </div>

                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </section>


@endsection
