<head>
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/index.css" />
</head><body>
  <?php require APPROOT . '/views/publisher/sidebar.php'; ?>
  
  <div class="grid-container">
    <div class="grid-item">
      <span class="span">Total Books</span>&ensp;&ensp;&ensp;<i class="fa fa-duotone fa-book"></i><br>
      <span class="span1"><?php echo $data['bookCount']; ?></span>
    </div>

    <div class="grid-item">
      <span class="span">Total Orders</span>&ensp;&ensp;&ensp;<i class="fa fa-solid fa-address-book"></i><br>
      <span class="span1"><?php echo $data['orderCount']; ?></span>
    </div>

    <div class="grid-item">
      <span class="span">Total Income</span>&ensp;&ensp;&ensp;<i class="fa fa-solid fa-heart"></i><br>
      <span class="span1">10</span>
    </div>

    <div class="grid-item">
      <span class="span">Total Income</span>&ensp;&ensp;&ensp;<i class="fa fa-solid fa-list"></i><br>
      <span class="span1">10</span>
    </div>
  </div>

  <div class="chat-container">
    <div class="chat-container-left">
      <div class="chat">
        <canvas id="revenueChart"></canvas>
      </div>
      <div class="chat">
        <canvas id="myChart2"></canvas>
      </div>
    </div>

    <div class="chat-container-right">
      <div class="chat1">
        <canvas id="myPieChart"></canvas>
      </div>
    </div>
  </div>

  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Sample data for the pie chart
    const data = {
      labels: ['backgroundColorbackgroundColor', 'BluebackgroundColor', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: 'My Dataset',
        data: [12, 19, 3, 5, 2, 3], // Sample values for each label
        backgroundColor: [
          'red',
          'blue',
          'yellow',
          'green',
          'purple',
          'orange'
        ],
        borderWidth: 1
      }]
    };

    // Configuration options for the pie chart
    const config = {
      type: 'pie',
      data: data,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top', // Position the legend at the top of the chart
          }
        }
      },
    };

    // Create the pie chart
    const myPieChart = new Chart(
      document.getElementById('myPieChart'),
      config
    );
    
  </script>
<script>
  // set up block
  const Delivered=<?php echo json_encode($data['orderDelCount']); ?>;
  const Shipping=<?php echo json_encode($data['orderShipCount']); ?>;
  const Processed=<?php echo json_encode($data['orderProCount']); ?>;
  const Returned=<?php echo json_encode($data['orderReturnedCount']); ?>;
 
  const data={
    labels: ['Delivered Orders', 'Shipping Orders', 'Proccessed Orders', 'Returned Orders'],
    datasets: [{
      label: 'Order Type',
      data: [Delivered, Shipping, Processed, Returned],
      backgroundColor: [
        '#333333', '#70BFBA', '#02514C', '000000', '404040','#70BFBA'
      ],
      borderWidth: 0,
      borderRadius: 5,
    }]

  };
  // config block
  const config={
    type: 'bar',
    data,
    options: {
      indexAxis: 'x', 
      scales: {
        x: {
          beginAtZero: true
        },
        y: {
          barPercentage: 0.3, 
          categoryPercentage: 0.5 
        }
      },
      plugins: {
        legend: {
          display: false 
        },
        title: {
          display: true,
          text: 'Number of Orders', 
          padding: {
            top: 10,
            bottom: 10
          }
        }
      }
    }
  };
  // render block
  const myChart1 = new Chart(
    document.getElementById('myChart1'),config
  );


</script>  
<script >
  const ctx2 = document.getElementById('myChart2');

new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: ['publishers', 'Charity organizations', 'customers', 'Community moderators'],
    datasets: [{
      label: 'Popular books',
      data: [12, 19, 3, 5],
      backgroundColor: [
        '#333333', '#70BFBA', '#02514C', '000000', '404040'
      ],
      borderWidth: 1
    }]
  },
  options: {
    indexAxis: 'x', 
    scales: {
      x: {
        beginAtZero: true
      }
    }
  }
});

</script>
<script>
    // Sample revenue data
    const revenueData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Revenue',
        data: [1000, 1500, 2000, 1800, 2200, 2500], // Sample revenue values
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 2,
        fill: false
      }]
    };

    // Chart configuration
    const chartConfig = {
      type: 'line',
      data: revenueData,
      options: {
        scales: {
          x: {
            title: {
              display: true,
              text: 'Month'
            }
          },
          y: {
            title: {
              display: true,
              text: 'Revenue (USD)'
            }
          }
        }
      }
    };

    // Create the chart
    const revenueChart = new Chart(document.getElementById('revenueChart'), chartConfig);
  </script>