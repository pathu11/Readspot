

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/style.css" /> -->
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/delivery/homepage.css" />
  <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <title>Delivery System Dashboard</title>
</head>
<body>
  <?php require APPROOT . '/views/delivery/sidebar.php';
  
  ?>
<div class="img-container">
      <div class="profile">
        <h2>Welcome Back, <br><span style="color: red; font-size: 43px;"><?php echo $data['deliveryName']; ?></span> 
        <i class="fas fa-hand-paper wave-icon"></i>
        </h2>
      </div>
      <div class="image">
        <img id="image1" src="<?php echo URLROOT;?>/assets/images/publisher/delivery2.png" width="700px" height="150px" >
       
      </div>
     
  </div>
  <div class="chart-container">
      <div class="chart">
        <canvas id="myChart1"></canvas>
      </div>
      <div class="chart">
        <canvas id="orderStatusChart"></canvas>
      </div>
     
  </div>
  
  <div class="table-container">
    <span class="table-head">Delivery Charging Table </span>
    <table>
    
                        <tr>
                            <th style="width: 35%">Weight(kg)</th>
                            <th style="width: 45%">Price per unit(Rs)</th>
                            <th style="width: 20%">Edit</th>
                        </tr>
                        <tr>
                        <?php foreach($data['deliveryDetails'] as $deliveryDetails): ?>
                            <td>1</td>
                            <td><?php echo $deliveryDetails->priceperkilo; ?></td>
                            <td><a href="<?php echo URLROOT; ?>/delivery/updatepricePerOne/<?php echo $deliveryDetails->delivery_id; ?>"><i class="fa fa-edit" style="color:black;"></i></a></td>
                        </tr>
                        <tr>
                            <td>Additional per kilo</td>
                            <td><?php echo $deliveryDetails->priceperadditional; ?></td>
                            <td><a href="<?php echo URLROOT; ?>/delivery/updatepriceAdditional/<?php echo $deliveryDetails->delivery_id; ?>"><i class="fa fa-edit" style="color:black;"></i></a></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
  </div>

</body>
</html>
<script>
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
  
  const myChart1 = new Chart(document.getElementById('myChart1'), myChartConfig);
</script>
<script>
    const orderData = <?php echo json_encode($data['orderData']); ?>;
    console.log(orderData); 
    const labels = orderData.map(item => item.day);
    const deliveredCounts = orderData.map(item => item.delivered_count);
    const shippingCounts = orderData.map(item => item.shipping_count);

    const chartDataForOrders = {
        labels: labels,
        datasets: [
            {
                label: 'Delivered Orders',
                data: deliveredCounts,
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false
            },
            {
                label: 'Shipping Orders',
                data: shippingCounts,
                borderColor: 'rgba(255, 99, 132, 1)',
                fill: false
            }
        ]
    };

    const chartConfigForOrders = {
        type: 'line',
        data: chartDataForOrders,
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Order Status by Day'
                }
            }
        }
    };

    const orderStatusChart = new Chart(document.getElementById('orderStatusChart'), chartConfigForOrders);
</script>
