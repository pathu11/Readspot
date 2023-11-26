const ctx = document.getElementById('myChart1');

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['publishers', 'Cahrity organizations', 'customers', 'Community moderators'],
      datasets: [{
        label: 'Number of users',
        data: [12, 19, 3, 5],
        backgroundColor:[
          '#333333', '#70BFBA', '#02514C', '000000', '404040'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });