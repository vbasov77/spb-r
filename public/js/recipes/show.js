const quantity = document.getElementById('quantity0').value;
document.getElementById('сountTheIngredients').addEventListener('click', event => {
    сountTheIngredients();
});


function сountTheIngredients() {
    console.log(quantity);
    const value = document.getElementById('quantity0').value;
    const percent = value / quantity * 100 - 100;
    console.log(percent);
    for (let i = 1; i < counter; i++) {
        const newValue = document.getElementById('quantity' + i).innerText * (1 + percent / 100);
        document.getElementById('quantity' + i).innerText = newValue.toFixed(2);
    }
    const button = document.getElementById('сountTheIngredients');
    button.innerHTML = "Перезагрузить страницу";
    button.id = "reboot";
    document.getElementById('reboot').addEventListener('click', event => {
        location.reload()
    });
}
