
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/style.css" />
  <title>Super Admin Dashboard</title>
  <script>
        const rootUrl = '<?php echo URLROOT; ?>';
    </script>
</head>
<body>
  <?php require APPROOT . '/views/superadmin/nav.php';
  ?>
  <div class="grid-container">
    <div class="grid-item"><i class="fa fa-duotone fa-book"></i>&nbsp;&nbsp;<a href="<?php echo URLROOT; ?>/superadmin/admins">Admins</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['countAdmins']; ?></span></div>
    <div class="grid-item"><i class="fa fa-solid fa-address-book"></i>&nbsp;&nbsp;<a href="<?php echo URLROOT; ?>/superadmin/moderators">Moderators</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['countModerators']; ?></span></div>
    <div class="grid-item"><i class="fa fa-duotone fa-book"></i>&nbsp;&nbsp;<a href="<?php echo URLROOT; ?>/superadmin/delivery">Delivery Systems</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['countDelivery']; ?></span></div>
    <div class="grid-item"><i class="fa fa-solid fa-address-book"></i>&nbsp;&nbsp;<a href="<?php echo URLROOT; ?>/superadmin/customers">Customers</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['countCustomers']; ?></span></div>
  </div>
  <div class="grid-container" style="margin:30px;">
    <div class="grid-item"><i class="fa fa-duotone fa-book"></i>&nbsp;&nbsp;<a href="<?php echo URLROOT; ?>/superadmin/publishers">Publishers</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['countPublishers']; ?></span></div>
    <div class="grid-item"><i class="fa fa-solid fa-address-book"></i>&nbsp;&nbsp;<a href="<?php echo URLROOT; ?>/superadmin/charity">Charity Organizations</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['countCharity']; ?></span></div>
    <div class="grid-item"><i class="fa fa-duotone fa-book"></i>&nbsp;&nbsp;<a href="<?php echo URLROOT; ?>/superadmin/orders">Orders</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['countModerators']; ?></span></div>
    <div class="grid-item"><i class="fa fa-solid fa-address-book"></i>&nbsp;&nbsp;<a href="<?php echo URLROOT; ?>/superadmin/complaigns">Complaigns</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['countModerators']; ?></span></div>
  </div>
  <div class="chart-container">
    <div class="chart">
      <canvas id="myChart1"></canvas>
    </div>
    <div class="chart">
      <canvas id="myChart2"></canvas>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // set up block
    const publishers=<?php echo json_encode($data['countPublishers']); ?>;
    const charity=<?php echo json_encode($data['countCharity']); ?>;
    const customers=<?php echo json_encode($data['countCustomers']); ?>;
    const moderators=<?php echo json_encode($data['countModerators']); ?>;
    const admins=<?php echo json_encode($data['countAdmins']); ?>;
    const delivery=<?php echo json_encode($data['countDelivery']); ?>;
    const data={
      labels: ['Publishers', 'Charity organizations', 'Customers', 'Community moderators','Admins','Delivery Systems'],
      datasets: [{
        label: 'Number of users',
        data: [publishers, charity, customers, moderators,admins,delivery],
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
            text: 'Number of Users', // Title text
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
  <script src="<?php echo URLROOT;?>/assets/js/superadmin/chart2.js"></script>
</body>
</html>

