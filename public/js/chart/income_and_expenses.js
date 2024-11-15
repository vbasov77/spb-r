var speedCanvas = document.getElementById("incomeAndExpensesChart");
var ArrExpenses = expensesStr.split(',');
var arrDataSum = dataSum.split(',');
var arrTotal = total.split(',');

var dataFirst = {
    label: "Оборот",
    data: arrDataSum,
    lineTension: 0,
    fill: false,
    borderColor: 'red'
};

var dataSecond = {
    label: "Затраты",
    data: ArrExpenses,
    lineTension: 0,
    fill: false,
    borderColor: 'black'
};
var dataThird= {
    label: "Итого",
    data: arrTotal,
    lineTension: 0,
    fill: false,
    borderColor: 'green'
};
var speedData = {
    labels: ["Январь", "Февраль", "Март", "Апрель", "Май",
        "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
    datasets: [dataFirst, dataSecond, dataThird]
};

var chartOptions = {
    legend: {
        display: true,
        position: 'top',
        labels: {
            boxWidth: 80,
            fontColor: 'black'
        }
    }
};

var lineChart = new Chart(speedCanvas, {
    type: 'line',
    data: speedData,
    options: chartOptions
});

