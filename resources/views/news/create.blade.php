@extends('layouts.app')
@section('content')
    <style>
        /*.add {*/
        /*    width: 150px;*/
        /*    height: 75px;*/
        /*    line-height: 75px;*/
        /*    text-align: center;*/
        /*    border: 1px dashed grey;*/
        /*    margin: 10px 0;*/
        /*}*/

        /*.add:hover {*/
        /*    cursor: pointer;*/
        /*    background-color: #360581;*/
        /*}*/

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

        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }
    </style>
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-lg-10">
                    <form action="{{route("store.news")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h3 style="margin-top: 60px">New</h3>
                        <br>
                        <textarea rows='10' type="text" placeholder="Текст" class="form-control" name="text"
                                  required
                        >{{old("text")}}</textarea><br>

                        <br>
                        <label for="video">Видео</label>
                        <input id="video" type="file" class="form-control" name="video" value="{{old("text")}}">
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