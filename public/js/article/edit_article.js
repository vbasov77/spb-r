const btn = document.getElementById("submit");
const preloader = document.getElementById("preloader-img");
preloader.style.display = "none";


btn.addEventListener("click", function (e) {
    e.preventDefault();
    let data = $("#form").serialize();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/update_article",
        type: 'POST',
        data: data,
        dataType: "html", //формат данных
        beforeSend: function () {
            preloader.style.display = "inline-block";
        },
        success: function (response) {
            var res = JSON.parse(response);
            $(preloader).show().delay(300).hide('slow');
            if (res.answer === 'ok') {
                let message = $('.preview').html(' <div  class="alert alert-success alert-dismissible" role="alert" > <button id="close" type="button" class="close" data-dismiss="allert"' +
                    'aria-label="Close" > <span aria-hidden="true" ></span></button> Данные сохранены</div>');

                $(message).show().delay(3000).hide('slow');
            } else {
                let message = $('.preview').html(' <div class="alert alert-danger alert-dismissible" role="alert" > <button type="button" id="close"  class="close" data-dismiss="allert"' +
                    'aria-label="Close" > <span aria-hidden="true" >&times;</span></button> Ошибка сохранения данных</div>');

                $(message).show().delay(3000).hide('slow');
            }

        }

    });


});

