<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/event.css" />

  <title>Events</title>
</head>
<body>
  <?php require APPROOT . '/views/publisher/sidebar.php';?>
  <div class="sub-nav">
    <p class="table-head">Events</p>
    <div class="search-bar">
        <input type="text" class="search" id="live-search" autocomplete="off" placeholder="Search..." >
    </div>
    <a href="<?php echo URLROOT;?>/publisher/addEvent"><button>Add an event</button></a>
  </div>

  <div class="table-container">
    <table>
      <tr>
        <th>Event ID</th>
        <th>Event Poster</th>
        <th>Title</th>
        <th>Description</th>
        <th>Location</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Event Category</th>
        <th>Status</th>
      </tr>
      <?php foreach($data['eventDetails'] as $event): ?>
        <tr>
          <td><?php echo $event->id; ?></td>
          <td><img src="<?php echo URLROOT; ?>/assets/images/landing/addevents/<?php echo $event->poster; ?>" onclick="fullView(this.src)" /></td>
          <td><?php echo $event->title; ?></td>
          <td><?php echo $event->description; ?></td>
          <td><?php echo $event->location; ?></td>
          <td><?php echo $event->start_date; ?></td>
          <td><?php echo $event->end_date; ?></td>
          <td><?php echo $event->category_name; ?></td>
          <td><?php echo $event->status; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
  
  <br>
  <div id="large-poster-view">
    <img id="large-event-poster"/>
    <button id="close-button" onclick="closeFullView()">X</button>
  </div>

  <script type="text/javascript">
    function fullView(imgLink){
      document.getElementById("large-event-poster").src = imgLink;
      document.getElementById("large-poster-view").style.display = "block";
    }

    function closeFullView(){
      document.getElementById("large-poster-view").style.display = "none";
    }
  </script>

  

</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</html>