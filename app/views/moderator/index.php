
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/moderator/style.css" />
  <title>Moderator Dashboard</title>
</head>
<body>
  <?php require APPROOT . '/views/moderator/nav.php';?>

  <div class="dashboard">
    <div class="stat-itmes">
      <div class="grid">
        <div class="grid-item">
          <i class="fa fa-solid fa-chess" style="color: #B197FC;"></i>
          <span>Ongoing Challenges</span>
        </div>
        <div class="grid-item">
          <i class="fa fa-solid fa-newspaper" style="color: #FFD43B;"></i>
          <span>Top Contents</span>
        </div>
        <div class="grid-item">
          <i class="fa fa-solid fa-calendar-day" style="color: #74C0FC;"></i>
          <span>Pending Events</span>
        </div>
      </div>
      <div class="chart">

      </div>
      
    </div>
    <div class="message-panel">
      <h3>Messages for you</h3>
      <div class="messages">
        <div class="message">
          <i class="bx bxs-user-circle icon"></i>
          <span>Admin</span>
          <p>There are some events you have to approve quickly</p>
        </div>

        <div class="message">
          <i class="bx bxs-user-circle icon"></i>
          <span>Admin</span>
          <p>There are some events you have to approve quickly</p>
        </div>
      </div>
    </div>
  </div>

</body>
</html>

