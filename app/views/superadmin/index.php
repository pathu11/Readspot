
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/index.css" />
  <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
  <title>Super Admin Dashboard</title>
  <script>
        const rootUrl = '<?php echo URLROOT; ?>';
    </script>
</head>
<body>
  <?php require APPROOT . '/views/superadmin/nav.php';
  ?>

<div class="img-container">
      <div class="profile">
        <h2>Welcome Back, <br><span style="color: red; font-size: 43px;"><?php echo $data['superadminName'];?></span> 
        <i class="fas fa-hand-paper wave-icon"></i>
        </h2>
      </div>
      <div class="image">
        <img id="image1" src="<?php echo URLROOT;?>/assets/images/publisher/admin.jpg" width="700px" height="150px" >
       
      </div>
     
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
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</html>

