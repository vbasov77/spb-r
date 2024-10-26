@extends('layouts.app')
@section('content')
    <style>
        /*-------------------------------Чекбоксы*/
        .checkbox-btn2 {
            display: inline-block;
            margin: 5px;
            user-select: none;
            position: relative;
        }

        @media screen and (max-width: 640px) {
            .checkbox-btn2, .checkbox-btn2 span {
                width: 100%;
            }
        }

        .checkbox-btn2 input[type=checkbox] {
            z-index: -1;
            opacity: 0;
            display: block;
            width: 0;
            height: 0;
        }

        .checkbox-btn2 span {
            display: inline-block;
            cursor: pointer;
            padding: 15px;

            border: 1px solid #999;
            border-radius: 4px;
            transition: background 0.2s ease;
        }

        /* Checked */
        .checkbox-btn2 input[type=checkbox]:checked + span {
            background: #5cc4ef;
            color: white;
        }

        /* Focus */
        .focused span {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        /* Hover */
        .checkbox-btn2:hover {
            color: #666;
        }

        /* Active */
        .checkbox-btn2 input[type=checkbox]:active:not(:disabled) + span {
            color: #000;
        }

        /* Disabled */
        .checkbox-btn2 input[type=checkbox]:disabled + span {
            background: #efefef;
            color: #666;
            cursor: default;
        }


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

                        <div style="margin-top: 50px; margin-bottom: 50px">

                            <b>Опубликовать только:</b><br>
                            <label class="checkbox-btn2">
                                <input type="checkbox" name="this_site"
                                       value="this_site">
                                <span>Этот сайт</span>
                            </label>

                            <label class="checkbox-btn2">
                                <input type="checkbox" name="telegram"
                                       value="telegram">
                                <span>Telegram</span>
                            </label>

                            <label class="checkbox-btn2">
                                <input type="checkbox" name="vk_go"
                                       value="vk_go">
                                <span>ВК куда сходить</span>
                            </label>

                            <label class="checkbox-btn2">
                                <input type="checkbox" name="animal"
                                       value="animal">
                                <span>ВК пушистые</span>
                            </label>
                            <br>
                            <label class="checkbox-btn2">
                                <input type="checkbox" name="all"
                                       value="all">
                                <span>ВЕЗДЕ</span>
                            </label>
                        </div>
                        <br>
                        <label for="video">Видео</label>
                        <input id="video" type="file" class="form-control" name="video" value="{{old("video")}}">
                        <br>
                        <label for="title_video">Название видео</label>
                        <input id="title_video" placeholder="Название видео" type="text" class="form-control" name="title_video" value="{{old("title_video")}}">
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