<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/moderator/events.css" />
  <title>Events</title>
</head>
<body>
  <?php require APPROOT . '/views/moderator/nav.php';?>
  <div class="sub-nav">
    <h2>Pending Events</h2>
    <div class="search-bar">
        <input type="text" class="search" id="live-search" autocomplete="off" placeholder="Search..." >
    </div>
  </div>

  <div id="searchresult"></div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#live-search").keyup(function(){
                var input = $(this).val();
                var searchType = 'events';
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
          <td><?php echo substr($pendingEvent->description, 0, 20); ?>
            <span class="see-more" onclick="showFullDescription('<?php echo $pendingEvent->description;?>')">See more..</span>
          </td>
          <td><?php echo $pendingEvent->location; ?></td>
          <td><?php echo $pendingEvent->start_date; ?></td>
          <td><?php echo $pendingEvent->end_date; ?></td>
          <td><?php echo $pendingEvent->category_name; ?></td>
          <td><img src="<?php echo URLROOT; ?>/assets/images/landing/addevents/<?php echo $pendingEvent->poster; ?>" onclick="fullView(this.src)"  style="width: 30%;"/></td>
          <td><button onclick="approvePopup('<?php echo $pendingEvent->user_id;?>','<?php echo $pendingEvent->id; ?>')">Approve</button>
          <button onclick="rejectPopup('<?php echo $pendingEvent->user_id;?>','<?php echo $pendingEvent->id; ?>')">Reject</button></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

  <!-- <div id="large-poster-view">
    <img id="large-event-poster"/>
    <button id="close-button" onclick="closeFullView()">X</button>
  </div> -->

    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeFullView()">&times;</span>
        <h2></h2>
        <img id="large-event-poster" width="60%"/>
      </div>
    </div>

    <div id="myModal1" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeFullView()">&times;</span>
        <h2>Approve Event</h2>
        <table id="eventApprovalTable">
            <!-- Event details will go here -->
        </table>
      </div>
    </div>

    <div id="myModal2" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeFullView()">&times;</span>
        <h2>Reject Reason</h2>
        <form action="<?php echo URLROOT;?>/moderator/rejectEvent" method="post">
          <textarea id="rejectReason" name="rejectReason" rows="4" cols="50" placeholder="Enter reject reason..."></textarea>
          <input type="hidden" id="user_id" name="user_id">
          <input type="hidden" id="event_id" name="event_id">
          <button type="submit">Send Rejection Email</button>
        </form>
      </div>
    </div>

    <div id="myModal3" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeFullView()">&times;</span>
        <h1>Event Description</h1><br>
        <p id="fullDescription"></p>
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
      document.getElementById("myModal3").style.display = "none";
    }

    function approvePopup(user_id,event_id){
      var approval = '<p>Send approval email</p><br> <a href="<?php echo URLROOT;?>/moderator/approveEvent/'+`${user_id}`+'/'+`${event_id}`+'"</a><button>Send</button></a>';
      var eventApproval = document.getElementById("eventApprovalTable");
      eventApproval.innerHTML = approval;
      document.getElementById("myModal1").style.display = "block";
    }

    function rejectPopup(user_id, event_id) {
      document.getElementById("user_id").value = user_id;
      document.getElementById("event_id").value = event_id;
      document.getElementById("myModal2").style.display = "block";
    }

    function showFullDescription(description){
      document.getElementById("fullDescription").innerText = description;
      document.getElementById("myModal3").style.display = "block";
    }

  </script>

</body>
</html>