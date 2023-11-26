
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
  <?php require APPROOT . '/views/admin/nav.php';
  
  ?>

  <div class="grid-container">
    <div class="grid-item"><i class="fa fa-duotone fa-book"></i><br><a href="#customers">Customers</a></div>
    <div class="grid-item"><i class="fa fa-solid fa-address-book"></i><br><a href="#publishers">Publishers</a></div>
    <div class="grid-item"><i class="fa fa-solid fa-heart"></i><br><a href="#orders">Charity Organizations</a></div>
    <div class="grid-item"><i class="fa fa-solid fa-list"></i><br><a href="#payments">Orders</a></div>
    <!--div class="grid-item"><a href="#complains">Complains</a></div>
    <div class="grid-item"><a href="#charity organizations">Charity Organizations</a></div>
    
    <div class="grid-item"><a href="<?php echo URLROOT; ?>/admin/pendingRequestsPub">Pending Requests</a></div>
    <div class="grid-item"><a href="#">Categories</a></div>
    <div class="grid-item"><a href="#delivary status">Delivery Status</a></div!-->
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
    <span class="table-head">Pending Requests</span>
    <table>
      <thead>
        <tr>
          <th>Request ID</th>
          <th>Organization Name</th>
          <th>Type</th>
          <th>Request Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>123</td>
          <td>ABC Publishers</td>
          <td>Publisher</td>
          <td>2023-05-20 09:45 AM</td>
          <td class="actions">
            <button>Approve</button>
            <button>Reject</button>
            <i class="fa fa-solid fa-eye"></i>
          </td>
        </tr>
        <tr>
          <td>124</td>
          <td>XYZ Charity Org</td>
          <td>Charity Org</td>
          <td>2023-05-19 02:30 PM</td>
          <td class="actions">
            <button>Approve</button>
            <button>Reject</button>
            <i class="fa fa-solid fa-eye"></i>
          </td>
        </tr>
        <tr>
          <td>125</td>
          <td>LMN Publishers</td>
          <td>Publisher</td>
          <td>2023-05-18 11:15 AM</td>
          <td class="actions">
            <button>Approve</button>
            <button>Reject</button>
            <i class="fa fa-solid fa-eye"></i>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</body>
</html>

