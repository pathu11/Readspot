
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/style.css" />
  <title>Super Admin Dashboard</title>
</head>
<body>
  <?php require APPROOT . '/views/superadmin/nav.php';?>

  <div class="grid-container">
    <div class="grid-item"><a href="#admins">Admins</a></div>
    <div class="grid-item"><a href="#moderators">Moderators</a></div>
    <div class="grid-item"><a href="#customers">Customers</a></div>
    <div class="grid-item"><a href="#publishers">Publishers</a></div>
    <div class="grid-item"><a href="#orders">Orders</a></div>
    <div class="grid-item"><a href="#payments">Payments</a></div>
    <div class="grid-item"><a href="#complains">Complains</a></div>
    <div class="grid-item"><a href="#charity organizations">Charity Organizations</a>
  </div>
    <div class="grid-item"><a href="#delivary status">Delivery Status</a></div>
  </div>

</body>
</html>

