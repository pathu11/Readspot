
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
      <a href="<?php echo URLROOT;?>/moderator/challenges"><div class="grid">
        <div class="grid-item">
          <i class="fa fa-solid fa-chess" style="color: #B197FC;"></i>
          <span>Ongoing Challenges</span>
        </div></a>
        <a href="<?php echo URLROOT;?>/moderator/topContents"><div class="grid-item">
          <i class="fa fa-solid fa-newspaper" style="color: #D65DB1;"></i>
          <span>Top Contents</span>
        </div></a>
        <a href="<?php echo URLROOT;?>/moderator/events"><div class="grid-item">
          <i class="fa fa-solid fa-calendar-day" style="color: #74C0FC;"></i>
          <span>Pending Events</span>
        </div></a>
        <a href="<?php echo URLROOT;?>/moderator/topChallenges"><div class="grid-item">
        <i class="fa fa-solid fa-trophy" style="color: #FF9671;"></i>
          <span>Top Challenges</span>
        </div></a>
      </div>

    <div class="chartMessage">
      <div class="chart">
        <canvas id="myChart1"></canvas>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
  </div>
      
    <script>
    // set up block
    const content=<?php echo $data['contentSubmissionCount']; ?>;
    const event=<?php echo $data['eventSubmissionCount']; ?>;
    const challenge=<?php echo $data['challengeSubmissionCount']; ?>;
    
    const data={
      labels: ['Contents', 'Challenges', 'Events'],
      datasets: [{
        label: 'Number of users',
        data: [content, challenge, event],
        backgroundColor: [
          '#333333', '#70BFBA', '#02514C'
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
            beginAtZero: true,
            ticks: {
              color: 'black',
              font: { size: 15, weight: 'bold' },
            },
            grid:{
              display: false,
            },
            border: {
              display: true,
              color: 'black',
              width: 2,
            },
          },
          y: {
            beginAtZero: true,
            border: {
              display: true,
              color: 'black',
              width: 2,
            },
            ticks: {
              color: 'black',
              font: {size: 15, weight: 'bold'},
              stepSize: 1,
            },
          }
        },
        plugins: {
          legend: {
            display: false // Set display to false to hide the legend
          },
          title: {
            display: true,
            text: 'User Participations', // Title text
            padding: {
              top: 10,
              bottom: 10
            }
          }
        },
        barThickness: 50
      }
    };
    // render block
    const myChart1 = new Chart(
      document.getElementById('myChart1'),config
    );

    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
    <!-- <div class="message-panel">
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
    </div> -->


  <!-- <script src="<?php echo URLROOT;?>/assets/js/moderator/chart.js"></script> -->

</body>
</html>

