const ctx2 = document.getElementById('myChart2');

new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: ['publishers', 'Charity organizations', 'customers', 'Community moderators'],
    datasets: [{
      label: 'Number of users',
      data: [12, 19, 3, 5],
      backgroundColor: [
        '#333333', '#70BFBA', '#02514C', '000000', '404040'
      ],
      borderWidth: 1
    }]
  },
  options: {
    indexAxis: 'y', // Set indexAxis to 'y' for a horizontal bar chart
    scales: {
      x: {
        beginAtZero: true
      }
    }
  }
});
