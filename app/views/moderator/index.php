
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
      <a href="<?php echo URLROOT;?>/moderator/challenge"><div class="grid">
        <div class="grid-item">
          <i class="fa fa-solid fa-chess" style="color: #B197FC;"></i>
          <span>Ongoing Challenges</span>
        </div></a>
        <a href="<?php echo URLROOT;?>/moderator/topContents"><div class="grid-item">
          <i class="fa fa-solid fa-newspaper" style="color: #FFD43B;"></i>
          <span>Top Contents</span>
        </div></a>
        <a href="<?php echo URLROOT;?>/moderator/events"><div class="grid-item">
          <i class="fa fa-solid fa-calendar-day" style="color: #74C0FC;"></i>
          <span>Pending Events</span>
        </div></a>
      </div>
      <div class="chart">
        <canvas id="myChart"></canvas>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
    </div>
    <div class="message-panel">
      <h3>Messages for you</h3>
      <div class="messages">
        <?php foreach($data['messageDetails'] as $message): ?>
        <a href="<?php echo URLROOT;?>/Chats/chat/<?php echo $message->outgoing_msg_id;?>">
        <div class="message">
          <div class="user-message">
            <i class="bx bxs-user-circle icon"></i>
            <span><?php echo $message->outgoing_user_name;?></span>
          </div>
          <p><?php echo $message->msg;?></p>
        </div></a>
        <?php endforeach;?>
      </div>
    </div>
  </div>

  <script src="<?php echo URLROOT;?>/assets/js/moderator/chart.js"></script>

</body>
</html>

