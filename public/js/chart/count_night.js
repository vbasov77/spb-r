var nightCanvas = document.getElementById("countNight");
var arrDataCN = countNight.split(',');
console.log(arrDataCN);

var densityData = {
    label: 'Занятость ночей в месяц',
    data: arrDataCN
};

var barChart = new Chart(nightCanvas, {
    type: 'bar',
    data: {
        labels: ["Январь", "Февраль", "Март", "Апрель", "Май",
            "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
        datasets: [densityData]
    }
});