@extends('layouts.app')
@section('content')
    <center><h1 style="margin: 60px 0 40px 0">Posts</h1></center>
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
            width: 150px;
            height: 150px;

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
                @auth
                    @if(Auth::user()->isAdmin())
                        <div>
                            <div>
                                <br>
                                <div class="btn btn-outline-danger btn-sm deleteFile" type="submit">Удалить файл
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
                <br>
                <br>
                @if(count($posts))
                    <br>
                    <br>
                    @foreach($posts as $item)
                        <div class="card" style="margin-top: 25px;">
                            <div class="card-body" style="text-align: left;">
                                <a target="_blank" class="link" style="text-decoration: none"
                                   href="https://vk.com/wall{{$item['group_id']}}_{{$item['post_id']}}">
                                    <b>{{$item['name_group']}}</b><br><br>
                                    @if(!empty($item['url']))
                                        <img src="{{$item['url']}}"
                                             height="150px" width="auto" class="rightM" style="object-fit: cover;">
                                    @else
                                        <img src="{{ asset("images/no_image/no_image.jpg") }}"
                                             height="150px" width="auto"
                                             class="rightM">
                                    @endif
                                    <div class="textBlock">
                                        {{$item ['text']}}...
                                    </div>
                                    <br>
                                    <br>
                                    <div style="font-size: 10px">{{$item ['date_post']}}</div>
                                    <img width="20px" height="auto" src="{{asset("icons/like.svg")}}">
                                    {{$item ['count_likes']}}
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    Нет материала
                @endif
            </div>
        </div>
    </div>
    <script>
        var fileName = @json($fileName);
    </script>

    <script src="{{ asset('js/deletes/delete_file.js') }}" defer></script>

@endsection