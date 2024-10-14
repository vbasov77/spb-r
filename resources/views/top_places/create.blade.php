@extends('layouts.app')
@section('content')
    <style>
        .imageThumb {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }
    </style>
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-lg-10">
                    <form action="{{route("admin.store.place")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h3 style="margin-top: 60px">Новое место</h3>
                        <br>
                        <label for="title">Заголовок</label><br>
                        <input type="text" name="title" placeholder="Заголовок" class="form-control" required>
                        <br>
                        <label for="description">Описание</label><br>
                        <textarea rows='6' type="text" placeholder="Описание" class="form-control" name="description"
                                  required id="description"
                        >{{old("description")}}</textarea>
                        <br>
                        <label for="text">Текст</label>
                        <textarea id="text" rows='10' type="text" placeholder="Текст" class="form-control" name="text"
                                  required
                        >{{old("text")}}</textarea><br>

                        <br>
                        <label for="files">Фото</label>
                        <input class="form-control" type="file" accept="image/*" id="files"
                               name="img[]" multiple/>
                        <br>
                        <br>
                        <div id="result"></div>
                        <br>
                        <br>
                        <input class="btn btn-outline-success" type="submit" value="Сохранить">
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            if (window.File && window.FileList && window.FileReader) {

                $("#files").on("change", function (e) {
                    document.querySelectorAll('.pip').forEach(element => element.remove());
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i];
                        var fileReader = new FileReader();
                        fileReader.onload = (function (e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                "<br/>" +
                                "</span>").insertAfter("#files");
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });

    </script>

@endsection