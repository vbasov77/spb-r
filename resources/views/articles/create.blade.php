<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Добавить заметку</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('themes/funder/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('themes/funder/fonts/icomoon/style.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
            integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2"
            crossorigin="anonymous"></script>


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
                                    <li class="active"><a href="{{route('front')}}">{{__('Home')}}</a></li>
                                    <li class="has-children">
                                        <a href="#">Инструменты</a>
                                        @include('blocks.tools')
                                    </li>
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
    </style>
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-lg-10">
                    <form action="{{route("admin.store.article")}}" method="post">
                        @csrf
                        <h3 style="margin-top: 60px">Новая статья</h3>
                        <label for="name"><b>Название</b></label><br>
                        <input type="text" placeholder="Название" class="form-control" name="name"
                               value="{{ $_POST['name'] ?? '' }}"
                               required><br>
                        <br>
                        <label for="description"><b>Описание</b></label><br>
                        <input type="text" placeholder="Описание" class="form-control" name="description"
                               value="{{$_POST['description'] ?? '' }}"
                               required><br>
                        <br>

                        <div class="form-group">
                            <label for="text"><b>Текст</b></label>
                            <textarea class="form-control" name="text" id="text"
                                      placeholder="Введите данные">{{$_POST['text'] ?? '' }}</textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="block_up"><b>Верхний блок</b></label>
                            <textarea class="form-control" name="block_up" id="text"
                                      placeholder="Введите данные">{{ old('block_up') }}</textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="block"><b>Блок</b></label>
                            <textarea class="form-control" name="block" id="text"
                                      placeholder="Введите данные">{{ old('block') }}</textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="block_down"><b>Нижний блок</b></label>
                            <textarea class="form-control" name="block_down"
                                      placeholder="Введите данные">{{ old('block_down') }}</textarea>
                        </div>
                        <br>
                        <div>
                            <label for="tags"><b>Теги:</b>(через запятую)</label>
                            <input name="tags" type="text" value="{{ old('tags') }}"
                                   class="form-control"
                                   placeholder="Теги" autocomplete="off" required>
                        </div>
                        <br>
                        <input class="btn btn-outline-success" type="submit" value="Сохранить">
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('/summernote/lang/summernote-ru-RU.min.js') }}"></script>
    <script>
        $(function () {
            $('#text').summernote({});
        });
    </script>
    <section>
        <footer style="padding: 35px; margin-top: 60px" class="footer bg-black small text-center">
            <div style="color: white" class="container px-4 px-lg-5">
                {{config('app.name')}} &copy; {{date('Y')}}</div>
        </footer>
    </section>
    <script src="{{asset('themes/funder/js/aos.js')}}"></script>
    <script src="{{asset('themes/funder/js/main.js')}}"></script>
</div>
</body>
</html>