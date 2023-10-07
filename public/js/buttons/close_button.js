
$('body').on('click', '#calendar', function (e) {
    let inputEl = document.getElementById("input-id");

    if (inputEl.value === "") {
        e.preventDefault(); // Отменить переход по ссылке
        let element = document.getElementById('info');

        element.scrollIntoView({behavior: "smooth"});
        let inHTML = ' <div class="alert alert-danger alert-dismissible" role="alert" > <button type="button" class="close" data-dismiss="allert"' +
            'aria-label="Close" > <span aria-hidden="true" >&times;</span></button> Обязательно для заполнения</div>';
        $('div#info').html(inHTML);
    }

});