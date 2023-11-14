 // Sample data (replace with your actual data)
 var monthlySalesData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [{
        label: 'Monthly Sales',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
        data: [1500, 2000, 1800, 2200, 2500, 3000, 2800, 3200, 3500, 4000, 3800, 4200],
    }]
};
var monthlyIncomeData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [{
        label: 'Monthly Income',
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1,
        data: [1200, 1500, 1300, 1600, 1800, 2000, 2200, 2400, 2600, 2800, 3000, 3200],
    }]
};

// Get the context of the canvas elements we want to select
var ctxSales = document.getElementById('salesChart').getContext('2d');
var ctxIncome = document.getElementById('incomeChart').getContext('2d');

// Create the bar charts
var salesChart = new Chart(ctxSales, {
    type: 'bar',
    data: monthlySalesData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var incomeChart = new Chart(ctxIncome, {
    type: 'bar',
    data: monthlyIncomeData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});