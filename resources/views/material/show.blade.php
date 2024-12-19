@extends('layouts.app', ['title' => $material->title])
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
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-lg-9">
                    <h1>{{$material->title}}</h1>
                    <b>Сумма:</b>
                    {{$material->price}}
                    <br>
                    <b>Количество:</b>
                    {{$material->quantity}}
                    <br>
                    @if(!empty($material->description))
                        Подробнее:<br>
                        {!!$material->description!!}
                    @endif
                    <br>
                    @if(!empty(count($images)))
                        <div class="container page-top">
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
                    <br>
                    @auth
                        @if(Auth::user()->isAdmin() || Auth::user()->isModerator())
                            <br>
                            <button class="btn btn-success" style="color: white; margin-top: 25px"
                                    onclick="window.location.href =
                                            '{{route('admin.edit.material', ['id'=>$material->id])}}';">
                                Редактировать
                            </button>
                            <br>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        @endsection
        @push('scripts')
            <script src="{{ asset('js/gallery/gallery.js') }}" defer></script>
    @endpush