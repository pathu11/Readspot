
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
    <div class="grid-item"><i class="fa fa-solid fa-address-book"></i>&nbsp;&nbsp;<a href="#">Total Orders</a><br><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10</span></div>
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="<?php echo URLROOT;?>/assets/js/admin/chart1.js"></script>
  <script src="<?php echo URLROOT;?>/assets/js/admin/chart2.js"></script>
</body>
</html>

