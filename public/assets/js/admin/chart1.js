const ctx = document.getElementById('myChart1');


new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['publishers', 'Charity organizations', 'customers', 'Community moderators'],
    datasets: [{
      label: 'Number of users',
      data: [12, 19, 3, 5],
      backgroundColor: [
        '#333333', '#70BFBA', '#02514C', '000000', '404040'
      ],
      borderWidth: 0,
      borderRadius: 5,
    }]
  },
  options: {
    indexAxis: 'x', // Set indexAxis to 'y' for a horizontal bar chart
    scales: {
      x: {
        beginAtZero: true
      },
      y: {
        barPercentage: 0.3, // Adjust the bar height (default is 0.9)
        categoryPercentage: 0.5 // Adjust the spacing between bars (default is 0.8)
      }
    },
    plugins: {
      legend: {
        display: false // Set display to false to hide the legend
      },
      title: {
        display: true,
        text: 'Number of Users', // Title text
        padding: {
          top: 10,
          bottom: 10
        }
      }
    }
  }
});
