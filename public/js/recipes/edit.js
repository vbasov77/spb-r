if (allButtons) {
    for (var i = 0; i < allButtons.length; i++) {
        allButtons[i].addEventListener('click', e => {
            e.preventDefault();
            let attrId = e.target.id;
            let id = document.getElementById('div' + attrId);
            let fileCode = id.getAttribute('data-code');

            id.id = "elements" + attrId;
            id.innerHTML = '';
            id.classList.add("elements" + attrId);

            deleteImgOnServer(e, recipeId, fileCode);
            addImg2(e.target.id);
        });
    }
}

document.getElementById('addIngredients').addEventListener('click', event => {
    addIngredients();
});

document.getElementById('addText').addEventListener('click', event => {
    addText();
});

document.getElementById('addImg').addEventListener('click', event => {
    addImg();
});

function addIngredients() {
    document.querySelector('.ingredient').insertAdjacentHTML('beforeend',
        '<br><input class="form-control" type="text" name="ingredients[' + countIngredients + ']"  placeholder="Введите текст"></input>');
    countIngredients++;
}

function addText() {
    document.querySelector('.elem').insertAdjacentHTML('beforeend',
        '<br><textarea class="form-control" type="text" name="text[' + count + ']"  placeholder="Введите текст"></textarea>');
    count++;
}

function addImg() {
    document.querySelector('.elem').insertAdjacentHTML('beforeend',
        '<br><input class="form-control" type="file" name="img[' + count + ']" ' +
        'onchange="showPreview(event, ' + count + ');"/>' +
        '<img style="margin: 10px" width="25%" height="auto" id="preview' + count + '">');
    count++;
}

function deleteImgOnServer(e, id, value) {
    if (confirm('Подтвердите удаление')) {
        send('/delete-recipe_img/' + id + '/' + value);
    } else {
        alert('Удаление отменено');
    }
}

async function send(url) {
    let response = await fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
}


function addImg2(id) {
    document.querySelector('.elements' + id).insertAdjacentHTML('beforeend',
        '<br><input class="form-control" type="file" name="img[' + id + ']" ' +
        'onchange="showPreview(event, ' + id + ');"/>' +
        '<img style="margin: 10px" width="25%" height="auto" id="preview' + id + '">');
}

function showPreview(event, x) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("preview" + x);
        preview.src = src;
        preview.style.display = "block";
    }
}