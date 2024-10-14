@extends('layouts.app')
@section('content')
    <center><h1 style="margin: 60px 0 40px 0">Files<h1></center>
    <style>
        a.link {
            color: black;
            text-decoration: none;
        }

        a.link:hover h4 {
            opacity: 1;
        }

        @media screen and (max-width: 640px) {
            .col-md-9 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

    </style>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div id="col-md" class="col-md-9">
                @if(count($files))
                    @foreach($files as $item)
                        <div class="card" style="margin-top: 25px;">
                            <div class="card-body" style="text-align: left;">
                                <a class="link" style="text-decoration: none"
                                   href="{{route('admin.read.file', ['file'=>$item])}}">
                                    <div class="textBlock">
                                        {{$item}}
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
@endsection