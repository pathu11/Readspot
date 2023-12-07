
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/style.css" />
  <title>Admin Dashboard</title>
</head>
<body>
  <?php require APPROOT . '/views/delivery/sidebar.php';
  
  ?>

  <div class="grid-container">
    <div class="grid-item"><i class="fa fa-duotone fa-book"></i><br><a href="#customers">Total Books</a></div>
    <div class="grid-item"><i class="fa fa-solid fa-address-book"></i><br><a href="#publishers">Total Orders</a></div>
    <div class="grid-item"><i class="fa fa-solid fa-heart"></i><br><a href="#orders">Total Income</a></div>
    <div class="grid-item"><i class="fa fa-solid fa-list"></i><br><a href="#payments">Total Income</a></div>
    
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

  <div class="table-container">
    <span class="table-head">Delivery Charging Table </span>
    <table>
                    <?php foreach($data['deliveryDetails'] as $deliveryDetails): ?>
                        
                        <tr>
                            <th style="width: 35%">Weight(kg)</th>
                            <th style="width: 45%">Price per unit(Rs)</th>
                            <th style="width: 20%">Edit</th>
                        </tr>
                        <tr>

                            <th>1</th>
                            <th><?php echo $deliveryDetails->priceperkilo; ?></th>
                            <th><a href="<?php echo URLROOT; ?>/delivery/updatepricePerOne/<?php echo $deliveryDetails->delivery_id; ?>"><i class="fa fa-edit" style="color:black;"></i></a></th>
                        </tr>
                        <tr>
                            <th>Additional per kilo</th>
                            <th><?php echo $deliveryDetails->priceperadditional; ?></th>
                            <th><a href="<?php echo URLROOT; ?>/delivery/updatepriceAdditional/<?php echo $deliveryDetails->delivery_id; ?>"><i class="fa fa-edit" style="color:black;"></i></a></th>
                        </tr>
                        <?php endforeach; ?>
                    </table>
  </div>

</body>
</html>

