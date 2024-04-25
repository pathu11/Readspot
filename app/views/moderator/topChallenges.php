<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/moderator/topChallenges.css" />
  <title>Top Challenges</title>
</head>
<body>
  <?php require APPROOT . '/views/moderator/nav.php';?>
  <div class="scoreboard">
    <div class="topic">
      <i class="fa fa-solid fa-trophy"></i><h2>Scoreboard</h2><i class="fa fa-solid fa-trophy"></i>
    </div>
    <div class="table-container">
      <table>
        <tr>
          <th>Name</th>
          <th>Challenge Points</th>
          <th>Challenge Score</th>
          <th>Give Points</th>
        </tr>
        <?php foreach($data['challengeScoreDetails'] as $challengeScore):?>
        <tr>  
          <td><?php echo $challengeScore->name;?></td>
          <td><?php echo $challengeScore->challnege_point?></td>
          <td><?php echo $challengeScore->total_score;?></td>
          <?php 
            $isPointAdd = false;
            if(!empty($data['pointsAddDate'])){
              foreach($data['pointsAddDate'] as $date):
                if ($date->user_id == $challengeScore->user_id){
                  $isPointAdd = true;
                }
              endforeach;
            }
          ?>
          <td><button onclick="pointsPopup('<?php echo $challengeScore->user_id;?>','<?php echo $isPointAdd;?>')">Add Points</button></td>
        </tr>
        <?php endforeach;?>
      </table>
    </div>
  </div>

  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h1>Give Points</h1>
      <form action="<?php echo URLROOT;?>/moderator/addPointsChallenge" method="post">
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
        <input type="hidden" id="user_id" name="user_id">
        <button type="submit">Add</button>
      </form>
    </div>
  </div>

  <div id="myModal2" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <p id="fullDescription"></p>
    </div>
    </div>

  <script>
    function pointsPopup(user_id,isPointAdd){
      console.log(isPointAdd);
      if(isPointAdd==true){
        var points = '<p>Points already added</p>';
        var pointadd = document.getElementById("fullDescription");
        pointadd.innerHTML = points;
        document.getElementById("myModal2").style.display = "block";
      }
      else{
        document.getElementById("user_id").value = user_id;
        document.getElementById("myModal").style.display = "block";
      }
    }

    function closeModal(){
      document.getElementById("myModal").style.display = "none";
      document.getElementById("myModal2").style.display = "none";
    }
  </script>
</body>
</html>