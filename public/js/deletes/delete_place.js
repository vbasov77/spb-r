const element = document.querySelector('.deletePost');
element.onclick = function () {
    if (confirm('Подтвердите удаление')) {
        send('/admin/delete-place/id' + id);
    } else {
        alert('Удаление отменено');
    }
};

async function send(url) {
    let response = await fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
    let result = await response.json();
    if (result === true) {
        window.location.replace('/index-place');
    } else {
        alert(result);
    }
}