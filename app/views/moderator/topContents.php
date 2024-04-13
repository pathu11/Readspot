<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/moderator/topContents.css" />
  <title>Top Contents</title>
</head>
<body>
  <?php require APPROOT . '/views/moderator/nav.php';?>
  <div class="sub-nav">
    <h2>Top Contents</h2>
    <a href="<?php echo URLROOT;?>/moderator/contents"><button>Pending Contents</button></a>
  </div>

  <div class="top-contents">
  <?php 
  $counter = 1;
  foreach($data['topContentDetails'] as $topContent):
  ?>
    <div class="content">
      <div class="content-number"><?php echo $counter; ?></div>
      <img src="<?php echo URLROOT;?>/assets/images/landing/addContents/<?php echo $topContent->img?>">
      <div class="content-description">
        <h3><?php echo $topContent->topic ?></h3>
        <span><?php echo $topContent->text?></span>
        <button onclick="pointsPopup('<?php echo $topContent->customer_id;?>')">Give Points</button>
      </div>
    </div>
    <?php 
    $counter++;
    endforeach;
    ?>
  </div>

  <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2></h2>

      </div>
    </div>

</body>
</html>