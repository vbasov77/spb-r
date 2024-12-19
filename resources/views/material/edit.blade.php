@extends('layouts.create_material')
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
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <br>
                    @if (!empty($message))
                        <div class="alert alert-success">
                            {{$message}}
                        </div>
                    @endif
                    <h1 style="margin: 40px 0 60px 0">Добавить материал</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="form">
                        @csrf
                        <input type="hidden" name="obj_id" value="1">
                        <br>
                        <div>
                            <label for="value"><b>Название:</b></label>
                            <input id="value" name="title" type="text" value="{{$material->title ?? old('title')}}"
                                   class="form-control"
                                   placeholder="Название" autocomplete="off" required>
                        </div>
                        <div id="dropdown">
                            <select style="background-color: gainsboro; z-index: 10" class="select" name="list"
                                    id="list"></select>
                        </div>
                        <br>
                        <div>
                            <label for="description"><b>Описание:</b></label>
                            <input name="description" type="text" value="{{$material->description ?? old('description') }}"
                                   class="form-control"
                                   placeholder="Описание" autocomplete="off">
                        </div>
                        <br>
                        <div>
                            <label for="price"><b>Цена:</b></label>
                            <input name="price" type="number" value="{{$material->price ?? old('price') }}"
                                   class="form-control"
                                   placeholder="Цена" autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <label for="quantity"><b>Количество:</b></label>
                            <input name="quantity" type="number" value="{{$material->quantity ?? old('quantity') }}"
                                   class="form-control"
                                   placeholder="Количество" autocomplete="off" required>
                        </div>
                        <br>
                        <div id="file" class="upload"></div>
                        <br>
                        <div class="files" id="files"></div>
                        <div class="file" id="file">
                            @if (!empty($images))
                                @foreach($images as $image)
                                    @php($random = rand(-2, 2))
                                    <img class="zoom img-fluid box3 del" src="{{asset($image)}}/"
                                         style="transform: rotate({{$random}}deg);"
                                         data-file="{{$material->path}}">
                                @endforeach
                            @endif
                        </div>
                        <br>
                        <div class="preview" id="preview"></div>
                        <br>
                        <button class="btn btn-outline-success btn-sm " id="submit" type="submit">Сохранить</button>
                        <a href='{{route('admin.show.material', ['id' => $material->id])}}' type='button'
                           class='btn btn-outline-secondary btn-sm' style="margin: 5px">Смотреть</a>
                        <a href='{{route('admin.index.material', ['id' => $material->obj_id])}}' type='button'
                           class='btn btn-outline-info btn-sm' style="margin: 5px">Все материалы</a>
                        <a href='{{route('admin.create.material', ['id' => $material->obj_id])}}' type='button'
                           class='btn btn-outline-primary btn-sm' style="margin: 5px">Создать новый</a>
                        <img src="{{ asset('images/loader/preloader.svg') }}" width="35px" height="auto" alt=""
                             class="preloader-img"/>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('dropzone/dropzone.min.js') }}" defer></script>
        <link href="{{ asset('dropzone/dropzone.min.css') }}" rel="stylesheet">
        <script>
            var id = @json($material->id);
        </script>
        <script src="{{ asset('dropzone/drop_material.js') }}" defer></script>
        <script src="{{ asset('js/autocomplite/autocomplite.js') }}" defer></script>
    @endpush
@endsection
