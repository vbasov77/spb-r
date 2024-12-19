<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Редактировать коллекцию</title>

    <link rel="stylesheet" href="{{asset("css/bootstrap/v4.0.0/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset('themes/funder/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('themes/funder/fonts/icomoon/style.css')}}">

    <script src="{{asset('js/jquery/jquery-1.12.4.js')}}"></script>
    <script src="{{asset('js/popper/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap/4.6.1/bootstrap.min.js')}}"></script>


</head>
<body>
<div class="site-wrap">
    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    <div class="site-navbar-wrap js-site-navbar bg-white">
        <div class="container">
            <div class="site-navbar bg-light">
                <div class="row align-items-center">
                    <div class="col-2">
                        <h2 class="mb-0 site-logo"><a style="text-decoration: none;" href="{{route('front')}}"
                                                      class="font-weight-bold">PORTFOLIO</a>
                        </h2>
                    </div>
                    <div class="col-10">
                        <nav class="site-navigation text-right" role="navigation">
                            <div class="container">
                                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#"
                                                                                              class="site-menu-toggle js-menu-toggle text-black"><span
                                                class="icon-menu h3"></span></a></div>
                                <ul class="site-menu js-clone-nav d-none d-lg-block">
                                    @guest
                                    @else
                                        @if(Auth::user()->isAdmin())
                                            <li class="has-children">
                                                <a href="#">Админ</a>
                                                <ul class="dropdown arrow-top">
                                                    @include('blocks.admin_menu')
                                                </ul>
                                            </li>
                                        @endif
                                    @endguest

                                    <li class="has-children">
                                        <a href="#">Инструменты</a>
                                        @include('blocks.tools')
                                    </li>
                                    <li class="active"><a href="{{route('front')}}">{{__('Home')}}</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link href="{{ asset('/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
    <style>
        .note-toolbar {
            text-align: left;
        }

        pre {
            display: block;
            padding: 10px;
            margin: 0 0 10.5px;
            font-size: 14px;
            line-height: 1.42857143;
            word-break: break-all;
            word-wrap: break-word;
            color: #7b8a8b;
            background-color: #ecf0f1;
            border: 1px solid #cccccc;
            border-radius: 4px;
        }

        .preloader-img {
            display: none;
        }
    </style>
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-lg-10">
                    <form id="form" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$article['id']}}">
                        <h3>Редактировать</h3>
                        <label for="name"><b>Название</b></label><br>
                        <input type="text" placeholder="Название" class="form-control" name="name"
                               value="{{ $article['title'] ?? '' }}"
                               required><br>
                        <br>
                        <label for="description"><b>Описание</b></label><br>
                        <input type="text" placeholder="Описание" class="form-control" name="description"
                               value="{{$article['description'] ?? '' }}"
                               required><br>
                        <br>

                        <div class="form-group">
                            <label for="text">Текст</label>
                            <textarea class="form-control" name="text" id="text"
                                      placeholder="Введите данные">{{$article['text'] ?? '' }}</textarea>
                        </div>
                        <br>
                        <label for="block_up"><b>Верхний блок</b></label><br>
                        <textarea type="text" placeholder="Верхний блок" class="form-control" name="block_up"
                        >{{$article['block_up'] ?? '' }}</textarea><br>
                        <br>
                        <label for="block"><b>Блок</b></label><br>
                        <textarea type="text" placeholder="Верхний блок" class="form-control" name="block"
                        >{{$article['block'] ?? '' }}</textarea><br>
                        <br>
                        <label for="block_down"><b>Нижний блок</b></label><br>
                        <textarea type="text" placeholder="Нижний блок" class="form-control" name="block_down"
                        >{{$article['block_down'] ?? '' }}</textarea><br>
                        <br>
                        <div>
                            <label for="tags"><b>Теги:</b>(через запятую)</label>
                            <input name="tags" type="text" value="{{ $article->tags }}"
                                   class="form-control"
                                   placeholder="Теги" autocomplete="off" required>
                        </div>
                        <br>
                        <div class="preview"></div>
                        <br>

                        <input class="btn btn-outline-success btn-sm submit" id="submit" type="submit"
                               value="Сохранить">

                        <img src="{{ asset('images/loader/preloader.svg') }}" width="35px" height="auto" alt=""
                             id="preloader-img"/>
                        <br>
                        <br>
                        <div class="btn btn-danger btn-sm deleteArticle" type="submit">Удалить пост</div>
                        <img src="{{ asset('images/loader/preloader.svg') }}" width="30px" height="auto" alt=""
                             class="preloader-img"/>
                        <br>
                        <div class="preview"></div>
                    </form>

                    <br>
                    <br>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('/summernote/lang/summernote-ru-RU.min.js') }}"></script>
    <script>
        var articleId = @json($article->id);
    </script>
    <script>
        $(function () {
            $('#text').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'Arial Black']],
                ],
                height: 300
            });
        });
    </script>
    <section>
        <footer style="padding: 35px; " class="footer bg-black small text-center">
            <div style="color: white" class="container px-4 px-lg-5">
                {{config('app.name')}} &copy; {{date('Y')}}</div>
        </footer>
    </section>

    <script src="{{asset('/js/article/edit_article.js')}}" defer></script>
    <script src="{{asset('/js/deletes/delete_article.js')}}" defer></script>

</div>
</body>
</html>