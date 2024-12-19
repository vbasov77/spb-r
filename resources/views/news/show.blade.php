@extends('layouts.app', ['title' => $post->title])
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
                    <br>
                    {!!nl2br(e($post->text))!!}
                    <br>
                    @if(!empty(count($images)))
                        <div class="container page-top">
                            <div class="row justify-content-center text-center">
                                @foreach($images as $image)
                                    @php($random = rand(-2, 2))
                                    <div class="col-lg-4 col-md-4 col-xs-6 thumb">

                                        <img src="{{$image}}" style="transform: rotate({{$random}}deg);"
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
                                            '{{route('admin.edit.news', ['id'=>$post->id])}}';">
                                Редактировать
                            </button>
                            <br>
                            <br>
                            <div class="btn btn-outline-danger btn-sm deletePost" type="submit">Удалить пост
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        {{--        @include('blocks.gallery')--}}

        @endsection
        @push('scripts')
            <script>
                var postId = @json($post->id);
            </script>
            <script src="{{ asset('js/deletes/delete_post_vk.js') }}" defer></script>
            <script src="{{ asset('js/gallery/gallery.js') }}" defer></script>
    @endpush