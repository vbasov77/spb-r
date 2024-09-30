@extends('layouts.app', ['title' => $post->title])
@section('content')
    <style>
        .imgI {
            width: 50%;
            height: auto;
        }

        @media screen and (max-width: 640px) {
            .imgI {
                width: 100%;
                height: auto;
            }
        }
    </style>
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-lg-9">
                    <div>
                        <h1 style="margin-top: 50px">{{$post->title}}</h1>
                    </div>
                    <br>
                    <br>
                    {!!nl2br(e($post->text))!!}
                    <br>
                    <br>
                    @if(!empty(count($images)))
                        <div>
                            @foreach($images as $image)
                                <img src="{{$image}}" width="45%" height="auto">
                            @endforeach
                        </div>
                    @endif
                    <br>
                    @auth
                        @if(Auth::user()->isAdmin())
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
    </section>
    {{-- Комментарии --}}

@endsection
@push('scripts')

    <script>
        var postId = @json($post->id);
    </script>

    <script src="{{ asset('js/deletes/delete_post_vk.js') }}" defer></script>

@endpush