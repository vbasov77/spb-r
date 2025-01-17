var nightCanvas = document.getElementById("countNight");
var arrDataCN = countNight.split(',');

var densityData = {
    label: 'Занятость ночей в месяц',
    data: arrDataCN
};

var barChart = new Chart(nightCanvas, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [densityData]
    }
});