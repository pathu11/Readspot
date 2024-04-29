<?php 
if ($_POST['searchType'] == 'events') {
    if (!empty($data['eventSearchDetails'])) {
        echo '<div class="table-container">
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
                  </tr>';
        foreach ($data['eventSearchDetails'] as $event) {
            echo '<tr>'.
                    '<td>'.$event->id.'</td>'.
                    '<td>'.$event->user_type.'</td>'.
                    '<td>'.$event->title.'</td>'.
                    '<td>'.$event->description.'</td>'.
                    '<td>'.$event->location.'</td>'.
                    '<td>'.$event->start_date.'</td>'.
                    '<td>'.$event->end_date.'</td>'.
                    '<td>'.$event->category_name.'</td>'.
                    '<td><img src="'.URLROOT.'/assets/images/landing/addevents/'.$event->poster.'" onclick="fullView(this.src)" style="width: 30%;"/></td>'.
                    '<td>'.
                      '<button onclick="approvePopup('.$event->user_id.','.$event->id.')">Approve</button>'.
                      '<button onclick="rejectPopup('.$event->user_id.','.$event->id.')">Reject</button>'.
                    '</td>'.
                  '</tr>';
        }
        echo '</table>'.
            '</div>';
    } else {
      echo '<div class="no-result" style="display:flex; justify-content:center;"><p>No results found</p></div>';
    }
}

elseif ($_POST['searchType'] == 'challenges') {
    if (!empty($data['challengeSearchDetails'])) {
        echo '<div class="table-container">
                <table>
                  <tr>
                    <th>Challenge title</th>
                    <th>Time Limit</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Delete Challenge</th>
                  </tr>';
        foreach ($data['challengeSearchDetails'] as $challenge) {
            echo '<tr>'.
                    '<td>'.$challenge->title.'</td>'.
                    '<td>'.$challenge->time_limit.'</td>'.
                    '<td>'.$challenge->description.'</td>'.
                    '<td>'.$challenge->date.'</td>'.
                    '<td>'.$challenge->end_date.'</td>'.
                    '<td><i class="fa fa-solid fa-trash" onclick="deleteChallenge('.$challenge->quiz_id.')"></i></td>'.
                  '</tr>';
        }
        echo '</table>'.
            '</div>';
    } else {
      echo '<div class="no-result" style="display:flex; justify-content:center;"><p>No results found</p></div>';
    }
}

elseif ($_POST['searchType'] == 'complains') {
  if (!empty($data['complainSearchDetails'])) {
      echo '<div class="table-container">
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
            </tr>';
      foreach ($data['complainSearchDetails'] as $complain) {
          echo '<tr>' .
              '<td>' . $complain->name . '</td>' .
              '<td>' . $complain->email . '</td>' .
              '<td>' . $complain->contact_number . '</td>' .
              '<td>' . substr($complain->descript, 0, 20) . '<span class="see-more" onclick="showFullDescription(\'' . $complain->descript . '\')">See more..</span></td>' .
              '<td>' . $complain->other . '</td>' .
              '<td><img src="' . URLROOT . '/assets/images/customer/complain/' . $complain->err_img . '" onclick="fullView(this.src)" style="width: 30%;"/></td>' .
              '<td>';
          if ($complain->resolved_or_not == 0) {
              echo '<p>Pending</p>';
          } else {
              echo '<p>Resolved</p>';
          }
          echo '</td>' .
              '<td><button onclick="respondPopup(' . $complain->complaint_id . ',\'' . $complain->email . '\',\'' . $complain->name . '\')">Respond</button></td>' .
              '</tr>';
      }
      echo '</table>' .
          '</div>' .
          '<div id="myModal" class="modal">
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
                  <form action="' . URLROOT . '/moderator/respondComplain" method="post">
                      <textarea id="moderatorComment" name="moderatorComment" rows="4" cols="50" placeholder="Enter reject reason..."></textarea>
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
          </div>';
  } else {
      echo '<div class="no-result" style="display:flex; justify-content:center;"><p>No results found</p></div>';
  }
}

elseif($_POST['searchType']=='bookReviews'){
    if(!empty($data['bookReviewSearchDetails'])){
      echo '<div class="table-container">
      <table id="eventTable">
        <tr>
          <th>Profile Image</th>
          <th>Customer Name</th>
          <th>Book Name</th>
          <th>Book Review</th>
          <th>Delete Review</th>
        </tr>';
        foreach($data['bookReviewSearchDetails'] as $review):
        echo '<tr>
          <td><img src="'.URLROOT.'/assets/images/customer/ProfileImages/'.$review->profile_img.'" ></td>
          <td>'.$review->name.'</td>
          <td>'.$review->book_name.'</td>
          <td>'.$review->review.'</td>
          <td><button onclick="deletePopup('.$review->review_id.')">Delete</button></td>
        </tr>';
        endforeach;
      echo '</table>
    </div>';
    }else {
      echo '<div class="no-result" style="display:flex; justify-content:center;"><p>No results found</p></div>';
  }
}

elseif($_POST['searchType']=='contentReviews'){
  if(!empty($data["contentReviewSearchDetails"])){
    echo '<div class="table-container">
      <table id="eventTable">
        <tr>
          <th>Profile Image</th>
          <th>Customer Name</th>
          <th>Content Name</th>
          <th>Content Review</th>
          <th>Delete Review</th>
        </tr>';
        foreach($data['contentReviewSearchDetails'] as $review):
        echo '<tr>
          <td><img src="'.URLROOT.'/assets/images/customer/ProfileImages/'.$review->profile_img.'" ></td>
          <td>'.$review->name.'</td>
          <td>'.$review->topic.'</td>
          <td>'.$review->review.'</td>
          <td><button onclick="deletePopup('.$review->review_id.')">Delete</button></td>
        </tr>';
        endforeach;
      echo '</table>
    </div>';

  }else {
    echo '<div class="no-result" style="display:flex; justify-content:center;"><p>No results found</p></div>';
  }
}

?>
<script src="<?php echo URLROOT;?>/assets/js/moderator/table.js"></script>
<script src="<?php echo URLROOT;?>/assets/js/moderator/livesearch.js"></script>
