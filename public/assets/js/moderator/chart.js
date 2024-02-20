const ctx = document.getElementById('myChart');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['publishers', 'Charity organizations', 'customers', 'Community moderators'],
    datasets: [{
      label: 'Popular books',
      data: [12, 19, 3, 5],
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(75, 192, 192)',
        'rgb(255, 205, 86)',
        'rgb(201, 203, 207)',
        'rgb(54, 162, 235)'
      ],
    }]
  },
});
