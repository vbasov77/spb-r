@extends('layouts.recipes')
@section('content')
    <link href="{{ asset('css/checkbox/radio.css') }}" rel="stylesheet">
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-lg-10">
                    <h3 style="margin-top: 60px">Новый рецепт</h3>
                    @if($errors->any())
                        @foreach($errors -> all() as $error)
                            <x-alert type="danger" :message="$error"/>
                        @endforeach
                    @endif
                    <form action="{{route("store.recipe")}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <label for="title"><b>Название</b></label><br>
                        <input type="text" placeholder="Название"
                               class="form-control @error("title") is-invalid @enderror" name="title"
                               required value="{{old('title')}}"
                        ><br>
                        <br>
                        <label for="description"><b>Описание</b></label><br>
                        <textarea type="text" placeholder="Описание"
                                  class="form-control @error("description") is-invalid @enderror" name="description"
                                  required
                        >{{old('description')}}</textarea><br>

{{--                        @if(!empty(old('text')))--}}
{{--                            @php--}}
{{--                                $i = 0;--}}
{{--                                    !empty(old('text')) ? $countText = count(old('text')) : $countText = 0;--}}
{{--                                    $count = $countText;--}}
{{--                                    dd($_FILES, old('text'));--}}
{{--                            @endphp--}}
{{--                            @foreach(old("text") as $text)--}}
{{--                                <textarea class="form-control @error("text") is-invalid @enderror" type="text" name="text[{{$i}}]"--}}
{{--                                          placeholder="Введите текст">{{$text}}</textarea><br>--}}
{{--                                @php($i++)--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
                        <div class="elements"></div>
                        <br>
                        <div class='form_radio_btn2 my_mobile' style="text-align: center;">
                            <input type='radio' id="addText"
                            ><label for='addText'>Добавить текст</label></div>

                        <div class='form_radio_btn2 my_mobile' style="text-align: center;">
                            <input type='radio' id="addImg"
                            ><label for='addImg'>Добавить фото</label></div>
                        <br>
                        <br> <br>
                        <input class="btn btn-outline-success" type="submit" value="Сохранить">
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        let x = 0;

        document.getElementById('addText').addEventListener('click', event => {  // Наведение мыши
            addText();
        });

        document.getElementById('addImg').addEventListener('click', event => {  // Наведение мыши
            addImg();
        });

        function addText() {
            document.querySelector('.elements').insertAdjacentHTML('beforeend',
                '<br><textarea class="form-control" type="text" name="text[' + x + ']"  placeholder="Введите текст"></textarea>');
            x++;
        }

        function addImg() {
            document.querySelector('.elements').insertAdjacentHTML('beforeend',
                '<br><input class="form-control" type="file" name="img[' + x + ']" ' +
                'onchange="showPreview(event, ' + x + ');"/>' +
                '<img style="margin: 10px" width="25%" height="auto" id="preview' + x + '">');
            x++;
        }

        function showPreview(event, x) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("preview" + x);
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection