// function onLoad(ymaps) {
//     var suggestView = new ymaps.SuggestView('suggest');
// }
ymaps.ready(init);

function init() {
    // Создаем выпадающую панель с поисковыми подсказками и прикрепляем ее к HTML-элементу по его id.
    var suggestView = new ymaps.SuggestView('suggest');

}