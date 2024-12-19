$('body').on('click', '.del', function () {
    if (!confirm('Подтвердите удаление')) return false;
    var $this = $(this);
    file = $this.data('file');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin/drop_img_material/id' + id,
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
    url: "/admin/store_img/material" + id,
    maxFilesize: 1,
    maxFiles: 10,
    parallelUploads: 1,
    acceptedFiles: ".png,.jpg,.gif,.jpeg",
    dictInvalidFileType: "Разрешены к загрузке только файлы .png, .jpg, .gif, .jpeg",
    dictMaxFilesExceeded: "Максимум 10 фото",
    dictFileSizeUnits: "Максимум 2 MB",
    dictDefaultMessage: '<div class="dz-button" type="button">Нажмите здесь или перетащите сюда файлы для загрузки</div>',
    success: function (file, response) {
        var res = JSON.parse(response);
        var str = String(res.images);
        if (res.answer === 'error') {
            $('.preview').html(' <div class="alert alert-danger alert-dismissible" role="alert" > <button type="button" class="close" data-dismiss="allert"' +
                'aria-label="Close" > <span aria-hidden="true" >&times;</span></button>' + res.mess + '</div>');
        } else {
            var img = document.createElement ('IMG');
            var randomNum = getRandomArbitrary(-2, 2);
            img.src = str;
            img.style.marginBottom = "20px";
            img.style.width = "250px";
            img.style.margin = "5px";
            img.style.cursor = "pointer";
            img.style.rotate = randomNum + "deg";
            img.className = "zoom img-fluid box3 del";
            document.getElementById ('files').prepend(img);
        }

        $(this.element).html(this.options.dictDefaultMessage).delay(500).fadeIn('slow');
    },



    init: function () {
        $(this.element).html(this.options.dictDefaultMessage);
    },

});

function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}

$('#form').on('submit', function (e) {
    e.preventDefault();
    var his = $(this),
        data = $("#form").serialize(),
        preloader = $('.preloader-img');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin/update-material/id' + id,
        type: 'POST',
        data: data,
        dataType: "html", //формат данных
        beforeSend: function () {
            preloader.fadeIn(300);
        },
        success: function (response) {
            preloader.delay(500).fadeOut('slow', function () {
                var res = JSON.parse(response);
                var button = document.querySelector('#close');

                if (res.answer === 'ok') {
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
