<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/moderator/createChallenge.css" />
  <title>Create Challenge</title>
</head>
<body>
  <?php require APPROOT . '/views/moderator/nav.php';?>
  <div class="form-container">
    <h2><strong>Enter Quiz Details</strong></h2>
    <div class="form-grid">
      <form action="<?php echo URLROOT;?>/moderator/createChallenge" method="post" enctype="multipart/form-data">
        <input type="text" name="title" id="title" placeholder="Enter Quiz Title">
        <input type="number" name="number_of_questions" id="number_of_questions" placeholder="Enter total number of questions">
        <input type="number" name="time_limit" id="time_limit" placeholder="Enter Time Limit in minutes">
        <input type="textarea" name="description" id="description" placeholder="Enter Quiz Description">
        <input type="file" name="img" id="img" accept="image/*"> 
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>

</body>
</html>