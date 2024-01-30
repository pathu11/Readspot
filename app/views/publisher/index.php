
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/style.css" />
  <title>Publisher Dashboard</title>
</head>
<body>
  <?php require APPROOT . '/views/publisher/sidebar.php';
  ?>
  <div class="grid-container">
    <div class="grid-item"><i class="fa fa-duotone fa-book"></i>&nbsp;&nbsp;<a href="#">Total Books</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['bookCount']; ?></span></div>
    <div class="grid-item"><i class="fa fa-solid fa-address-book"></i>&nbsp;&nbsp;<a href="#">Total Orders</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['orderCount']; ?></span></div>
    <div class="grid-item"><i class="fa fa-solid fa-heart"></i>&nbsp;&nbsp;<a href="#">Total Income</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10</span></div>
    <div class="grid-item"><i class="fa fa-solid fa-list"></i>&nbsp;&nbsp;<a href="#">Total Income</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10</span></div>
    
  </div>

  <div class="chart-container">
    <div class="chart">
      <canvas id="myChart1"></canvas>
    </div>
    <div class="chart">
      <canvas id="myChart2"></canvas>
    </div>
  </div>
  <a href="<?php echo URLROOT; ?>/publisher/test">test</a>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            text: 'Number of Orders', // Title text
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
  <script src="<?php echo URLROOT;?>/assets/js/admin/chart2.js"></script>
</body>
</html>

