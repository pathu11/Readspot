<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/complains.css" />
  <title>Complains</title>
</head>
<body>
  <?php require APPROOT . '/views/admin/nav.php';?>
  <div class="sub-nav">
    <h2>Complains</h2>

    <div class="filter-bar">
      <span>Filter data by status: </span>
      <select name="live-search" id="live-search">
        <!-- <option value="all">All</option> -->
        <option value="1">Resolved</option>
        <option value="0">Pending</option>
      </select>
    </div>
    <!-- <div class="search-bar">
      <input type="text" class="search" id="live-search" autocomplete="off" placeholder="Search..." >
    </div> -->
  </div>

  <div id="searchresult"></div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
        $("#live-search").on('change',function(){
            var input = $(this).val();
            var searchType = 'complains';
            // alert(input);
            if(input != ""){
                $.ajax({
                    url:"<?php echo URLROOT;?>/admin/livesearch",
                    method:"POST",
                    data:{input:input, searchType:searchType},

                    success:function(data){
                        $(".table-container").hide();
                        $("#searchresult").html(data);
                        $("#searchresult").css("display","block");
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
        <th>Complainant name</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Complain</th>
        <th>Additional notes</th>
        <th>Complain Images</th>
        <th>Status</th>
        <th>Action</th>
        <th>Send to super admin</th>
      </tr>
      <?php foreach($data['complainDetails'] as $complain): ?>
        <tr>
          <td><?php echo $complain->name; ?></td>
          <td><?php echo $complain->email; ?></td>
          <td><?php echo $complain->contact_number; ?></td>
          <td><?php echo substr($complain->descript, 0, 20); ?>
            <span class="see-more" onclick="showFullDescription('<?php echo $complain->descript;?>')">See more..</span>
          </td>
          <td><?php echo $complain->other; ?></td>
          <td><img src="<?php echo URLROOT; ?>/assets/images/customer/complain/<?php echo $complain->err_img; ?>" onclick="fullView(this.src)"  style="width: 30%;"/></td>
          <td>
            <?php if($complain->resolved_or_not==0){
              echo '<span style="color:red;">Pending</span>';
            }
            else{
              echo '<span style="color:green;">Resolved</span>';
            }
            ?>
          </td>
          <td><button onclick="respondPopup('<?php echo $complain->complaint_id;?>','<?php echo $complain->email;?>','<?php echo $complain->name;?>')">Respond</button>
          <td><a href="<?php echo URLROOT;?>/admin/sendToSuperAdmin/<?php echo $complain->complaint_id;?>"><button>Send to super admin</button></a></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeFullView()">&times;</span>
      <h2>Complain Image</h2>
      <img id="large-event-poster" width="60%"/>
    </div>
  </div>

  <div id="myModal1" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeFullView()">&times;</span>
      <h2>Enter Your comments</h2>
      <form action="<?php echo URLROOT;?>/admin/respondComplain" method="post">
        <textarea id="adminComment" name="adminComment" rows="4" cols="50" placeholder="Enter reject reason..."></textarea>
        <input type="hidden" id="complaint_id" name="complaint_id">
        <input type="hidden" id="email" name="email">
        <input type="hidden" id="name" name="name">
        <button type="submit">Mark as Resolved</button>
      </form>
    </div>
  </div>

  <div id="myModal2" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeFullView()">&times;</span>
      <h1>Complain Description</h1><br>
      <p id="fullDescription"></p>
    </div>
  </div>

  <div id="myModal3" class="modal">
    <div class="modal-content">
      <!-- <span class="close" onclick="closeModal()">&times;</span> -->
      <h2>Complain was sent to super admin</h2>
      <button onclick="closeModal()">OK</button>
    </div>
  </div>

  <script type="text/javascript">
    function fullView(imgLink){
      document.getElementById("large-event-poster").src = imgLink;
      document.getElementById("myModal").style.display = "block";
    }

    function closeFullView(){
      document.getElementById("myModal").style.display = "none";
      document.getElementById("myModal1").style.display = "none";
      document.getElementById("myModal2").style.display = "none";
    }

    function respondPopup(complaint_id,email,name){
      document.getElementById("complaint_id").value = complaint_id;
      document.getElementById("email").value = email;
      document.getElementById("name").value = name;
      document.getElementById("myModal1").style.display = "block";
    }

    function showFullDescription(description){
      document.getElementById("fullDescription").innerText = description;
      document.getElementById("myModal2").style.display = "block";
    }

    // alert
    function showModal() {
      var modal = document.getElementById("myModal3");
      modal.style.display = "block";
    }

    function closeModal() {
      var modal = document.getElementById("myModal3");
      modal.style.display = "none";
      window.location.href = "<?php echo URLROOT; ?>/admin/complains"; // Redirect to the event page
    }

    <?php
      // Check if the showModal flag is set, then call showModal()
      if (isset($_SESSION['showModal']) && $_SESSION['showModal']) {
          echo "window.onload = showModal;";
          // Unset the session variable after use
          unset($_SESSION['showModal']);
      }
    ?>

  </script>


</body>
</html>