<head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/index.css" />
  <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
  <title>Homepage</title>
</head>
<body>
  <?php require APPROOT . '/views/publisher/sidebar.php'; ?>
  <div class="img-container">
      <div class="profile">
        <h2>Welcome Back, <span style="color: red; font-size: 43px;"><?php echo $data['publisherName'];?></span> 
        <i class="fas fa-hand-paper wave-icon"></i>
        </h2>
      </div>
      <div class="image">
        <img id="image1" src="<?php echo URLROOT;?>/assets/images/publisher/books2.png" width="700px" height="150px" >
       
      </div>
     
  </div>
  <div class="grid-container">
    <div class="grid-item"><span class="span">Total Books</span>&ensp;&ensp;&ensp;<i class="fa fa-duotone fa-book"></i><br><span class="span1"> <?php echo $data['bookCount']; ?></span></div>
    <div class="grid-item"><span class="span">Total Orders</span >&ensp;&ensp;&ensp;<i class="fa fa-solid fa-address-book"></i><br><span class="span1"> <?php echo $data['orderCount']; ?></span></div>
    <div class="grid-item"><span  class="span">Total Income</span >&ensp;&ensp;&ensp;<i class="fa fa-solid fa-heart"></i><br><span class="span2">Rs.<?php echo $data['paymentCount']; ?></span></div>
    <div class="grid-item"><span  class="span">Pending Income</span >&ensp;&ensp;&ensp;<i class="fa fa-solid fa-list"></i><br><span class="span2"> Rs.<?php echo $data['pendingPayment']; ?></span></div>
  </div>

  <div class="chat-container">
    <div class="chat-container-left">
      <div class="chat">
        <canvas id="revenueChart"></canvas>
      </div>
      <div class="chat">
        <canvas id="myChart1"></canvas>
      </div>
    </div>
    <div class="chat-container-right">
      <div class="chat1">
        <h3>Summary Based on Book Categories(Add)</h3><br><br>
        <canvas id="myPieChart"></canvas>
      </div>
    </div>
    <div class="chat-container-right">
      <div class="chat1">
        <h3>Summary Based on Book Categories(Buy)</h3><br><br>
        <canvas id="myPieChart1"></canvas>
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Sample data for the pie chart (Add)
  const bookCategoryCount = <?php echo json_encode($data['bookCategoryCount']); ?>;
  
  // Extract labels and data for the pie chart (Add)
  const labels = bookCategoryCount.map(item => item.category);
  const data = bookCategoryCount.map(item => item.count);
  const backgroundColor = getRandomColorArray(labels.length);
  
  // Chart data for Add pie chart
  const chartDataPie = {
    labels: labels,
    datasets: [{
      label: 'Book Categories',
      data: data,
      backgroundColor: backgroundColor,
      borderWidth: 1
    }]
  };
  
  // Configuration options for the pie chart (Add)
  const config = {
    type: 'pie',
    data: chartDataPie,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top', // Position the legend at the top of the chart
        }
      },
      animation: {
        animateRotate: true, // Add animation to rotation
        duration: 2000 // Add animation duration
      }
    },
  };
  
  // Create the Add pie chart
  const myPieChart = new Chart(
    document.getElementById('myPieChart'),
    config
  );
  
  function getRandomColorArray(length) {
    const colorArray = [];
    for (let i = 0; i < length; i++) {
      colorArray.push('#' + Math.floor(Math.random() * 16777215).toString(16));
    }
    return colorArray;
  }

  // Sample data for the pie chart (Buy)
  const bookCategoryCountBuy = <?php echo json_encode($data['bookCategoryCountBuy']); ?>;
  
  // Extract labels and data for the pie chart (Buy)
  const labelsBuy = bookCategoryCountBuy.map(item => item.category);
  const dataBuy = bookCategoryCountBuy.map(item => item.count);
  const backgroundColorBuy = getRandomColorArray(labelsBuy.length);
  
  // Chart data for Buy pie chart
  const chartDataPieBuy = {
    labels: labelsBuy,
    datasets: [{
      label: 'Book Categories',
      data: dataBuy,
      backgroundColor: backgroundColorBuy,
      borderWidth: 1
    }]
  };
  
  // Configuration options for the pie chart (Buy)
  const config1 = {
    type: 'pie',
    data: chartDataPieBuy,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top', // Position the legend at the top of the chart
        }
      },
      animation: {
        animateRotate: true, // Add animation to rotation
        duration: 2000 // Add animation duration
      }
    },
  };
  
  // Create the Buy pie chart
  const myPieChart1 = new Chart(
    document.getElementById('myPieChart1'),
    config1
  );
</script>

<script>
  // Chart data
  const chartData = {
    labels: ['Delivered Orders', 'Shipping Orders', 'Processed Orders', 'Returned Orders'],
    datasets: [{
      label: 'Order Type',
      data: [
        <?php echo $data['orderDelCount']; ?>,
        <?php echo $data['orderShipCount']; ?>,
        <?php echo $data['orderProCount']; ?>,
        <?php echo $data['orderReturnedCount']; ?>
      ],
      backgroundColor: ['#333333', '#70BFBA', '#02514C', '#000000']
    }]
  };
  
  // Chart configuration
  const myChartConfig = {
    type: 'bar',
    data: chartData,
    options: {
      indexAxis: 'x',
      scales: {
        x: { beginAtZero: true },
        y: { barPercentage: 0.3, categoryPercentage: 0.5 }
      },
      plugins: {
        legend: { display: false },
        title: {
          display: true,
          text: 'Number of Orders',
          padding: { top: 10, bottom: 10 }
        }
      },
      animation: {
        duration: 2000, // Add animation duration
        easing: 'easeInOutQuad', // Add animation easing
        onComplete: function(animation) { // Add animation onComplete callback
          console.log('Animation complete');
        }
      }
    }
  };
  
  // Render chart
  const myChart1 = new Chart(document.getElementById('myChart1'), myChartConfig);
</script>

<script>
  // Dummy weekly payments data
  const weeklyPayments = <?php echo $data['weeklyPaymentsJson']; ?>;
  
  // Chart data
  const revenueData = {
    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'], // Assuming 5 weeks maximum
    datasets: [{
      label: 'Revenue Of The Month',
      data: weeklyPayments, // Use dummy data here
      borderColor: 'rgba(75, 192, 192, 1)',
      borderWidth: 2,
      fill: false
    }]
  };
  
  // Chart configuration
  const revenueChartConfig = {
    type: 'line',
    data: revenueData,
    options: {
      scales: {
        x: {
          title: {
            display: true,
            text: 'Week'
          }
        },
        y: {
          title: {
            display: true,
            text: 'Revenue'
          }
        }
      },
      animation: {
        duration: 2000, // Add animation duration
        easing: 'easeInOutCubic', // Add animation easing
        onProgress: function(animation) { // Add animation onProgress callback
          console.log('Animation progress');
        }
      }
    }
  };
  
  // Create the chart
  const revenueChart = new Chart(document.getElementById('revenueChart'), revenueChartConfig);
</script>
</html>
