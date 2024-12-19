@extends('layouts.app')
@section('content')
    <style>
        .file img {
            max-width: 200px;
            margin-bottom: 20px;
            cursor: pointer;
        }
        .preloader-img {
            display: none;
        }
    </style>

    <section class="about-section text-center" id="about">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    {{--                                                                Сообщения об ошибках--}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <br>

                    <h3>Редактировать</h3><br>
                    <form id="form">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div>
                            <label for="title"><b>Заголовок:</b></label>
                            <input name="title" type="text" value="{{$data->title ?? old('title')}}"
                                   class="form-control"
                                   placeholder="Заголовок" autocomplete="off" required>
                        </div>

                        <div>
                            <label for="description">Описание</label><br>
                            <textarea rows='6' type="text" placeholder="Описание" class="form-control"
                                      name="description"
                                      required id="description"
                            >{{$data->description ?? old("description")}}</textarea>
                        </div>
                        <br>
                        <div>
                            <label for="text">Текст</label>
                            <textarea id="text" rows='10' type="text" placeholder="Текст" class="form-control"
                                      name="text"
                                      required
                            >{{$data->text ?? old("text")}}</textarea><br>
                        </div>
                        <br>
                        <div id="file" class="upload"></div>
                        <br>

                        <div class="files" id="files"></div>
                        <div class="file" id="file">
                            @if (!empty($images))
                                @foreach ($images as $item)
                                    <img class="img-thumbnail del" src="{{$item->path}}/"
                                         alt=""
                                         data-file="{{$item}}">
                                @endforeach
                            @endif
                        </div>

                        <button class="btn btn-primary btn-sm submit" id="submit" type="submit">Сохранить</button>
                        <a class="btn btn-success btn-sm" style="color: white;"
                           type='button' onclick="window.location.href = '{{route('show.place', ['id'=>$data->id])}}';">
                            Просмотр
                        </a>
                        <div class="btn btn-danger btn-sm deleteArticle" type="submit">Удалить пост</div>
                        <img src="{{ asset('images/loader/preloader.svg') }}" width="30px" height="auto" alt=""
                             class="preloader-img"/>
                        <br>
                        <div class="preview"></div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('dropzone/dropzone.min.js') }}" defer></script>
        <link href="{{ asset('dropzone/dropzone.min.css') }}" rel="stylesheet">
        <script>
            var id = @json($data->id);
        </script>
        <script src="{{ asset('dropzone/drop_places.js') }}" defer></script>

        <script src="{{ asset('js/deletes/delete_place.js') }}" defer></script>
    @endpush
@endsection
