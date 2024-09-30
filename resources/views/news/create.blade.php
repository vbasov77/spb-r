@extends('layouts.app')
@section('content')
    <style>
        .add {
            width: 150px;
            height: 75px;
            line-height: 75px;
            text-align: center;
            border: 1px dashed grey;
            margin: 10px 0;
        }

        .add:hover {
            cursor: pointer;
            background-color: #360581;
        }
    </style>
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-lg-10">
                    <form action="{{route("admin.store.news")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h3 style="margin-top: 60px">New</h3>
                        <label for="name"><b>Заголовок</b></label><br>
                        <input type="text" placeholder="Заголовок" class="form-control" name="title"
                               required value="{{old("title")}}"
                        ><br>
                        <br>
                        <label for="description"><b>Описание</b></label><br>
                        <textarea type="text" placeholder="Описание" class="form-control" name="description"
                                  required
                        >{{old("description")}}</textarea><br>

                        <br>
                        <textarea type="text" placeholder="Текст" class="form-control" name="text"
                                  required
                        >{{old("text")}}</textarea><br>
                        <div class="elements"></div>
                        <br>
                        <div class="add" id="addImg">Добавить фото</div>

                        <br>
                        <input class="btn btn-outline-success" type="submit" value="Сохранить">
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        var x = 0;

        document.getElementById('addImg').addEventListener('click', event => {  // Наведение мыши
            addImg();
        });

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