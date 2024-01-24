<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/moderator/challenges.css" />
  <title>Events</title>
</head>
<body>
  <?php require APPROOT . '/views/moderator/nav.php';?>
  <div class="sub-nav">
    <p class="table-head">Pending Events</p>
    <div class="search-bar">
        <input type="text" class="search" id="live-search" autocomplete="off" placeholder="Search..." >
    </div>
  </div>

  <div class="table-container">
    <table>
      <tr>
        <th>Event ID</th>
        <th>User Type</th>
        <th>Title</th>
        <th>Description</th>
        <th>Location</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Event Category</th>
        <th>Event Poster</th>
        <th>Action</th>
      </tr>
      <?php foreach($data['pendingEventDetails'] as $pendingEvent): ?>
        <tr>
          <td><?php echo $pendingEvent->id; ?></td>
          <td><?php echo $pendingEvent->user_type; ?></td>
          <td><?php echo $pendingEvent->title; ?></td>
          <td><?php echo $pendingEvent->description; ?></td>
          <td><?php echo $pendingEvent->location; ?></td>
          <td><?php echo $pendingEvent->start_date; ?></td>
          <td><?php echo $pendingEvent->end_date; ?></td>
          <td><?php echo $pendingEvent->category_name; ?></td>
          <td><img src="<?php echo URLROOT; ?>/assets/images/landing/addevents/<?php echo $pendingEvent->poster; ?>" onclick="fullView(this.src)" /></td>
          <td><a href="<?php echo URLROOT;?>/moderator/approveEvent/<?php echo $pendingEvent->id;?>"><button>Approve</button></a><button>Reject</button></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

</body>
</html>