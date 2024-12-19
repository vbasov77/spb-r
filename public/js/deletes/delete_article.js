const element = document.querySelector('.deleteArticle');
element.onclick = function () {
    if (confirm('Подтвердите удаление')) {
        send('/admin/delete-post/id' + articleId);
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
        window.location.replace('/articles');
    } else {
        alert(result);
    }
}