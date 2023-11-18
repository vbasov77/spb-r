$('#form').on('submit', function (e) {

    let email = document.getElementById("email");
    let phone = document.getElementById("phone");
    let element = document.getElementById('info');

    if (!validateEmail(email.value)) {
        e.preventDefault(); // Отменить переход по ссылке
        element.scrollIntoView({behavior: "smooth"});

        let inHTMLEm = ' <div class="alert alert-danger alert-dismissible" role="alert" > <button type="button" class="close" data-dismiss="allert"' +
            'aria-label="Close" > <span aria-hidden="true" >&times;</span></button>Проверьте правильность заполнения поля Email <br> </div>';
        $('div#info').html(inHTMLEm);
    }
    if (validatePhone(phone.value) === false) {
        e.preventDefault(); // Отменить переход по ссылке


        element.scrollIntoView({behavior: "smooth"});

        let inHTMLPh = ' <div class="alert alert-danger alert-dismissible" role="alert" > <button type="button" class="close" data-dismiss="allert"' +
            'aria-label="Close" > <span aria-hidden="true" >&times;</span></button>Проверьте правильность заполнения поля Телефон <br> </div>';
        $('div#info').html(inHTMLPh);
    }

    if (!confirm(`Подтвердите\nEmail - ` + email.value +
        `\nТелефон - ` + phone.value)) return false;

});

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validatePhone(phone) {
    if (phone.length === 17) {
        return true
    }
    return false;
}