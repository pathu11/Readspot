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
    <p class="table-head">Ongoing Challenges</p>
    <div class="search-bar">
        <input type="text" class="search" id="live-search" autocomplete="off" placeholder="Search..." >
    </div>
    <button>Create a challenge</button>
  </div>

  <div class="table-container">
    <table>
      <tr>
        <th>Challenge ID</th>
        <th>Challenge title</th>
        <th>Description</th>
        <th>Start Date</th>
        <th>End Date</th>
      </tr>
      <?php foreach($data['challengeDetails'] as $challenge): ?>
        <tr>
          <td><?php echo $challenge->challenge_id; ?></td>
          <td><?php echo $challenge->title; ?></td>
          <td><?php echo $challenge->description; ?></td>
          <td><?php echo $challenge->start_date; ?></td>
          <td><?php echo $challenge->end_date; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

</body>
</html>