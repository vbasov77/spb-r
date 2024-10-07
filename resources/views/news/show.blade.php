@extends('layouts.app', ['title' => $post->title])
@section('content')
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
                                    <div class="col-lg-4 col-md-4 col-xs-6 thumb">

                                        <img src="{{$image}}"
                                             class="zoom img-fluid " alt="">

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <br>
                    @auth
                        @if(Auth::user()->isAdmin() || Auth::user()->isModerator())
                            <div>
                                <div>
                                    <br>
                                    <div class="btn btn-outline-danger btn-sm deletePost" type="submit">Удалить пост
                                    </div>
                                </div>
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