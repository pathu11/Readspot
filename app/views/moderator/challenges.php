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

  <div id="searchresult"></div>
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $("#live-search").keyup(function(){
          var input = $(this).val();
          var searchType = 'challenges';
          //alert(input);
          if(input != ""){
              $.ajax({
                url:"<?php echo URLROOT;?>/moderator/livesearch",
                method:"POST",
                data:{input:input, searchType:searchType},

                success:function(data){
                    $(".table-container").hide();
                    $("#searchresult").html(data);
                    $("#searchresult").css("display","block");
                    console.log(data);
                }
              });
          }else{
              $(".table-container").show();
              $("#searchresult").css("display","none");
          }
      });
    });
  </script>

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
          <td><?php echo substr($challenge->description, 0, 10); ?>...
            <button onclick="showFullDescription('<?php echo $challenge->description;?>')">See more..</button>
          </td>
          <td><?php echo $challenge->date;?></td>
          <td><?php echo $challenge->end_date;?></td>
          <td><i class="fa fa-solid fa-trash" onclick="deleteChallenge('<?php echo $challenge->quiz_id;?>')"></i></td>
        </tr>
      <?php endforeach;?>
    </table>

    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2></h2>
        <table id="eventDetailsTable">
            <!-- Event details will go here -->
        </table>
      </div>
    </div>
  </div>

  <div id="myModal2" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2>Challenge Description</h2>
      <p id="fullDescription"></p>
    </div>
  </div>

  <script>
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
        document.getElementById("myModal2").style.display = "none";
    }

    function deleteChallenge(challengeId){
      var deleteChallenge = '<div class="deleteChallenge"><p>Are you sure you want to delete this challenge?</p><br><a href="<?php echo URLROOT;?>/moderator/deleteChallenge/'+ `${challengeId}`+'"><button>Delete</button></a><button onclick="closeModal()">Cancel</button></div>';
      var table = document.getElementById("eventDetailsTable");
      table.innerHTML = deleteChallenge;
      document.getElementById("myModal").style.display = "block";
    }

    function showFullDescription(description){
      document.getElementById("fullDescription").innerText = description;
      document.getElementById("myModal2").style.display = "block";
    }

  </script>

</body>
</html>