<?php 
if ($_POST['searchType'] == 'events') {
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
}
?>
