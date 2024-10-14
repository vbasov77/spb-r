$(function () {
    $('body').on('click', '.del', function () {
        if (!confirm('Подтвердите удаление')) return false;
        var $this = $(this);
        file = $this.data('file');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/delete_img',
            data: {file: file},
            type: 'delete',
            success: function (res) {
                console.log(res);
                $this.fadeOut();
            },

            error: function () {
                alert('Ошибка!!!')
            }
        });
    });

    let myDropzone = new Dropzone("div#file", {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/upload_img/place" + id,
        maxFilesize: 2,
        maxFiles: 25,
        parallelUploads: 1,
        acceptedFiles: ".png,.jpg,.gif,.jpeg",
        dictInvalidFileType: "Разрешены к загрузке только файлы .png, .jpg, .gif, .jpeg",
        dictMaxFilesExceeded: "Максимум 20 фото",
        dictFileSizeUnits: "Максимум 2 MB",
        dictDefaultMessage: '<div class="dz-button" type="button">Нажмите здесь или перетащите сюда файлы для загрузки</div>',
        success: function (file, response) {
            var url = file.dataURL;
            var res = JSON.parse(response);
            var str = String(res.images);
            array = str.split(',');
            var inHTML = '';
            if (res.answer === 'error') {
                $('.preview').html(' <div class="alert alert-danger alert-dismissible" role="alert" > <button type="button" class="close" data-dismiss="allert"' +
                    'aria-label="Close" > <span aria-hidden="true" >&times;</span></button>' + res.mess + '</div>');
            } else {
                $('div#file').empty();
                $.each(array, function (key, value) {
                    $('div#files').empty();
                    var html = "<img style='max-width: 200px; margin-bottom: 20px; cursor: pointer;' class=\"img-thumbnail del\" src=\"/images/places/" + value + "\"  data-file=\"" + value + "\" />";
                    inHTML += html;
                    $('div#files').html(inHTML);
                })
            }
            this.removeFile(file);
            $(this.element).html(this.options.dictDefaultMessage).delay(500).fadeIn('slow');
        },

        init: function () {
            $(this.element).html(this.options.dictDefaultMessage);
        },

    });

    $('#form').on('submit', function (e) {
        e.preventDefault();
        var his = $(this),
            btn = his.find("button.submit"),
            data = $("#form").serialize(),
            preloader = $('.preloader-img');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/edit_place/id' + id,
            type: 'POST',
            data: data,
            dataType: "html", //формат данных
            beforeSend: function () {
                preloader.fadeIn(300);
            },
            success: function (response) {
                console.log(response);
                preloader.delay(500).fadeOut('slow', function () {
                    var res = JSON.parse(response);
                    var button = document.querySelector('#close');


                    if (res.answer === 'ok') {
                        // Закрыть при клике
                        // $('body').on('click', '.close', function () {
                        //     $('.preview').hide('slow');
                        // });

                        let message = $('.preview').html(' <div  class="alert alert-success alert-dismissible" role="alert" > <button id="close" type="button" class="close" data-dismiss="allert"' +
                            'aria-label="Close" > <span aria-hidden="true" ></span></button> Данные сохранены</div>');
                        // Закрыть через 5 сек
                        $(message).show().delay(3000).hide('slow');
                    } else {
                        let message = $('.preview').html(' <div class="alert alert-danger alert-dismissible" role="alert" > <button type="button" id="close"  class="close" data-dismiss="allert"' +
                            'aria-label="Close" > <span aria-hidden="true" >&times;</span></button> Ошибка сохранения данных</div>');

                        $(message).show().delay(3000).hide('slow');
                    }
                    myDropzone.removeAllFiles();
                });
                return false;
            },
            error: function () {
                alert('Ошибка');
            }
        });
    });
});


