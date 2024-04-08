<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/moderator/challenges.css" />
  <title>Challenges</title>
</head>
<body>
  <?php require APPROOT . '/views/moderator/nav.php';?>
  <div class="sub-nav">
    <h2>Ongoing Challenges</h2>
    <div class="search-bar">
        <input type="text" class="search" id="live-search" autocomplete="off" placeholder="Search..." >
    </div>
    <a href="<?php echo URLROOT;?>/moderator/createChallenge"><button>Create a challenge</button></a>
  </div>

  <div class="table-container">
    <table>
      <tr> 
        <th>Challenge title</th>
        <th>Time Limit</th>
        <th>Description</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Delete Challenge</th>
      </tr>
      <?php foreach($data['challengeDetails'] as $challenge): ?>
        <tr>
          <td><?php echo $challenge->title;?></td>
          <td><?php echo $challenge->time_limit.' minutes';?></td>
          <td>
            <div id="description-wrapper">
              <p><?php echo $challenge->description;?></p>
              <!-- <button class="see-more-btn" onclick="view()">See more..</button> -->
            </div>
            <button class="see-more-btn" onclick="view()">See more..</button>
          </td>
          <td><?php echo $challenge->date;?></td>
          <td><?php echo $challenge->end_date;?></td>
          <td><i class="fa fa-solid fa-trash"></i></td>
        </tr>
      <?php endforeach;?>
    </table>

    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Full Description</h2>
        <table id="eventDetailsTable">
            <!-- Event details will go here -->
        </table>
      </div>
    </div>
  </div>

  <script>
    function view() {
      var eventDetails = '<p><?php echo $challenge->description;?></p>';
      var table = document.getElementById("eventDetailsTable");
      table.innerHTML = eventDetails;
      document.getElementById("myModal").style.display = "block";
    }


  function closeModal() {
      document.getElementById("myModal").style.display = "none";
  }
  </script>

</body>
</html>