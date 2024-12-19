$('body').on('click', '.del', function () {
    if (!confirm('Подтвердите удаление')) return false;
    var $this = $(this);
    file = $this.data('file');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin/delete_img_places/id' + id,
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
    url: "/admin/store_img/places" + id,
    maxFilesize: 2,
    maxFiles: 10,
    parallelUploads: 1,
    acceptedFiles: ".png,.jpg,.gif,.jpeg",
    dictInvalidFileType: "Разрешены к загрузке только файлы .png, .jpg, .gif, .jpeg",
    dictMaxFilesExceeded: "Максимум 20 фото",
    dictFileSizeUnits: "Максимум 2 MB",
    dictDefaultMessage: '<div class="dz-button" type="button">Нажмите здесь или перетащите сюда файлы для загрузки</div>',
    success: function (file, response) {
        var res = JSON.parse(response);
        var str = String(res.images);
        array = str.split('^');
        var inHTML = '';
        if (res.answer === 'error') {
            $('.preview').html(' <div class="alert alert-danger alert-dismissible" role="alert" > <button type="button" class="close" data-dismiss="allert"' +
                'aria-label="Close" > <span aria-hidden="true" >&times;</span></button>' + res.mess + '</div>');
        } else {
            $('div#file').empty();
            $.each(array, function (key, value) {
                $('div#files').empty();
                var html = "<img style='max-width: 200px; margin-bottom: 20px; cursor: pointer;' class=\"img-thumbnail del\" src=\"" + value + "\"  data-file=\"" + value + "\" />";
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
