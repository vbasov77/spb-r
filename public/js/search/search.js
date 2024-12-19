const inputEl = document.querySelector('#input');
inputEl.addEventListener('focus', event => { //Покрасит рамку
    event.target.style.outline = "1px solid #f57106";

});
inputEl.addEventListener('blur', event => { //Покрасит рамку
    event.target.style.removeProperty('outline')
});
document.getElementById('deleteSession').addEventListener('click', (e) => {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin/delete_session',
        success: function (res) {
            console.log(res);
            inputEl.value = '';
        },
    });
});