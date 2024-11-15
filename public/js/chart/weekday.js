var densityCanvas = document.getElementById("weekday");
var arrWeekday = weekday.split(',');

var densityData = {
    label: 'Въезды по дням. Статистика за всё время (' + arrWeekday.length + ' бронирований)',
    data: arrWeekday
};

var barChart = new Chart(densityCanvas, {
    type: 'bar',
    data: {
        labels: ["Поекдельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
        datasets: [densityData]
    }
});