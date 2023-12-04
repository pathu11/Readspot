
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
    <div class="grid-item"><i class="fa fa-duotone fa-book"></i><br><a href="<?php  echo URLROOT;?>/admin/customers">Customers</a></div>
    <div class="grid-item"><i class="fa fa-solid fa-address-book"></i><br><a href="<?php  echo URLROOT;?>/admin/publishers">Publishers</a></div>
    <div class="grid-item"><i class="fa fa-solid fa-heart"></i><br><a href="<?php  echo URLROOT;?>/admin/charity">Charity Organizations</a></div>
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
    <div class="filter-bar">
        <form action="<?php echo URLROOT;?>/admin/" method="get">
            <select name="user_role" class="select-bar">
                <option value="">Select User Role</option>
                <option value="publisher" <?php isset($_GET['user_role'])==true ? ($_GET['user_role']=='publisher'? 'selected':''):''?> >Publisher
                </option>
                <option value="charity" <?php isset($_GET['user_role'])==true ? ($_GET['user_role']=='charity'? 'selected':''):''?> >Charity Organization
                </option>
            </select>
            <button type="submit" class="filter-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
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
        <?php foreach($data['pendingUserDetails'] as $PendingUser): ?>
        <tr>
          <td><?php echo $PendingUser->user_id;?></td>
          <td><?php echo $PendingUser->email;?></td>
          <td><?php echo $PendingUser->user_role;?></td>
          <td><?php echo $PendingUser->created_at;?></td>
          <td class="actions">
          <?php
            $userRole = '';
            if($PendingUser->user_role=='publisher'){
              $userRole = 'approvePub';
            } else{
              $userRole = 'approveCharity';
            }
          ?>
          
          <a href='<?php echo URLROOT; ?>/admin/<?php echo $userRole; ?>/<?php echo $PendingUser->user_id; ?>'><button>Approve</button></a>
            <button>Reject</button>
            <i class="fa fa-solid fa-eye"></i>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</body>
</html>

