$('#form').on('submit', function (e) {

    let email = document.getElementById("email");
    let phone = document.getElementById("phone");

    if (!confirm(`Подтвердите\nEmail - ` + email.value +
        `\nТелефон - ` + phone.value)) return false;

    if (!validateEmail(email.value)) {
        e.preventDefault(); // Отменить переход по ссылке
        let element = document.getElementById('info');

        element.scrollIntoView({behavior: "smooth"});

        let inHTML = ' <div class="alert alert-danger alert-dismissible" role="alert" > <button type="button" class="close" data-dismiss="allert"' +
            'aria-label="Close" > <span aria-hidden="true" >&times;</span></button>Проверьте правильность заполнения поля Email <br> </div>';
        $('div#info').html(inHTML);
    }
});

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
