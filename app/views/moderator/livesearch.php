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
?>
