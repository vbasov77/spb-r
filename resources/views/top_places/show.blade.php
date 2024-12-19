@extends('layouts.app')
@section('content')
    <style>
        .zoom {
            border: solid black;
            border-color: black;
        }

        .box3 {
            border-width: 5px 3px 3px 5px;
            border-radius: 95% 4% 97% 5%/4% 94% 3% 95%;
        }
    </style>
    <link href="{{ asset('css/gallery.css') }}" rel="stylesheet">
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
                    @if(!empty(count($images)))
                        <div class="container">
                            <div class="row justify-content-center text-center">
                                @foreach($images as $image)
                                    @php($random = rand(-2, 2))
                                    <div class="col-lg-4 col-md-4 col-xs-6 thumb">

                                        <img src="{{$image->path}}" style="transform: rotate({{$random}}deg);"
                                             class="zoom img-fluid box3" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
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
                                        Редактировать
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
