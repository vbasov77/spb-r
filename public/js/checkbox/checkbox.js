$(window).keyup(function (e) {
    let target = $('.checkbox-btn2 input:focus');
    if (e.keyCode == 9 && $(target).length) {
        $(target).parent().addClass('focused');
    }
});

$('.checkbox-btn2 input').focusout(function () {
    $(this).parent().removeClass('focused');
});


let rooms = document.getElementById('rooms');
let countId = document.getElementById('count');
if (rooms.checked) {
    countId.value = "";
    countId.disabled = true;
}

document.querySelector("#rooms").onclick = function () {
    if (rooms.checked) {
        countId.value = "";
        countId.disabled = true;
    } else{
        countId.disabled = false;
    }
};


$('#countRooms').find(':checkbox[name="countRooms"]').each(function() {
    if (countRooms === "студия") {
        $(this).prop('checked', true);
    }
});