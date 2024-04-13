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
        <?php if($topContent->pointsAdd==1):?>
          <p>Points already added</p>
        <?php else:?>
        <button onclick="pointsPopup('<?php echo $topContent->customer_id;?>','<?php echo $topContent->content_id;?>')">Give Points</button>
        <?php endif;?>
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
      <h1>Give Points</h1>
      <form action="<?php echo URLROOT;?>/moderator/addPoints" method="post">
      <div class="radio-container">
        <input type="radio" id="points1" name="numberOfPoints" value="10">
        <label class="radio-label" for="points1"></label>
        <span>10 point</span>
      </div>
      <div class="radio-container">
        <input type="radio" id="points2" name="numberOfPoints" value="5">
        <label class="radio-label" for="points2"></label>
        <span>5 points</span>
      </div>
      <div class="radio-container">
        <input type="radio" id="points3" name="numberOfPoints" value="3">
        <label class="radio-label" for="points3"></label>
        <span>3 points</span>
      </div>
        <input type="hidden" id="customer_id" name="customer_id">
        <input type="hidden" id="content_id" name="content_id">
        <button type="submit">Add</button>
      </form>
    </div>
  </div>


  <script>
    function pointsPopup(customer_id,content_id){
      document.getElementById("customer_id").value = customer_id;
      document.getElementById("content_id").value = content_id;
      document.getElementById("myModal").style.display = "block";
    }

    function closeModal(){
      document.getElementById("myModal").style.display = "none";
    }
  </script>

</body>
</html>