<?php
    if($_POST['searchType']=='customer'){
      if(!empty($data['customerSearchDetails'])){
        echo '<div class="table-container" >
        <table>
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Register Date</th>
            </tr>' ;       
    foreach($data['customerSearchDetails'] as $customer): 
    echo '<tr>'.
         '<td>' .$customer->customer_id .'</td>'.
         '<td>' .$customer->name . '</td>'.
         '<td>' .$customer->email . '</td>'.
         '<td>' .$customer->created_at. '</td>';
   endforeach;                
       echo '</table>'.
        
    '</div>';
    }else{
      echo '<div class="no-result" style="display:flex; justify-content:center;"><p>No results found</p></div>';
    }
  }

    elseif($_POST['searchType']=='publisher'){
      if(!empty($data['publisherSearchDetails'])){
        echo '<div class="table-container" >
        <table>
            <tr>
            <th>Publisher ID</th>
            <th>Name</th>
            <th>Company Name</th>
            <th>Register Number</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Postal Name</th>
            <th>Street Name</th>
            <th>Town</th>
            <th>District</th>
            <th>Postal Code</th>
            <th>Account Name</th>
            <th>Account Number</th>
            <th>Bank Name</th>
            <th>Branch Name</th>
            <th>Registerd Date</th>
            </tr>' ;       
    foreach($data['publisherSearchDetails'] as $publisher): 
    echo '<tr>'.
         '<td>' .$publisher->publisher_id .'</td>'.
         '<td>' .$publisher->name .'</td>'.
         '<td>' .$publisher->company_name.'</td>'.
         '<td>' .$publisher->reg_no . '</td>'.
         '<td>' .$publisher->email.'</td>'.
         '<td>' .$publisher->contact_no. '</td>'.
         '<td>' .$publisher->postal_name. '</td>'.
         '<td>' .$publisher->street_name.'</td>'.
         '<td>' .$publisher->town.'</td>'.
         '<td>' .$publisher->district.'</td>'.
         '<td>' .$publisher->postal_code.'</td>'.
         '<td>' .$publisher->account_name.'</td>'.
         '<td>' .$publisher->account_no.'</td>'.
         '<td>' .$publisher->bank_name.'</td>'.
         '<td>' .$publisher->branch_name.'</td>'.
         '<td>' .$publisher->created_at.'</td>';
   endforeach;                
       echo '</table>'.
        
    '</div>';
    }
    else{
      echo '<div class="no-result" style="display:flex; justify-content:center;"><p>No results found</p></div>';
    }
  }

    elseif($_POST['searchType']=='charity'){
      if(!empty($data['charitySearchDetails'])){
        echo '<div class="table-container" >
        <table>
            <tr>
                <th>Charity Organization ID</th>
                <th>Name</th>
                <th>Organization Name</th>
                <th>Register Number</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Registerd Date</th>
            </tr>';
           
    foreach($data['charitySearchDetails'] as $charity):
    echo '<tr>'.
         '<td>' .$charity->charity_id .'</td>'.
         '<td>' .$charity->name .'</td>'.
         '<td>' .$charity->org_name . '</td>'.
         '<td>' .$charity->reg_no .'</td>'.
         '<td>' .$charity->email.'</td>'.
         '<td>' .$charity->contact_no. '</td>'.
         '<td>' .$charity->created_at .'</td>';
    endforeach;               
        echo '</table>'.
        
    '</div>';
    }
    echo '<div class="no-result" style="display:flex; justify-content:center;"><p>No results found</p></div>';
  }
    elseif($_POST['searchType']=='order'){
      $inputType = null;
      if($_POST['inputType']=='word') $inputType='orderSearchDetailsByID';
      else $inputType = 'orderSearchDetailsByDate';
      
      if(!empty($data[$inputType])){
        echo '<div class="table-container">

    <table>
      <tr>
          <th>Order ID</th>
          <th>Book ID</th>
          <th>Customer ID</th>
          <th>Quantitiy</th>
          <th>Order Date</th>
          <th>Status</th>
          <th>Total Price</th>
          <th>Total Weight</th>
      </tr>';
           
      foreach($data[$inputType] as $order):
        echo '<tr>
            <td>'.$order->order_id.'</td>
            <td>'.$order->book_id.'</td>
            <td>'.$order->customer_id.'</td>
            <td>'.$order->quantity.'</td>
            <td>'.$order->order_date.'</td>
            <td>'; 
                if($order->status == 'delivered'){
                  echo '<span style="color: purple;">'.$order->status.'</span>';
                }
                elseif($order->status == 'cancel'){
                  echo '<span style="color: red;">'.$order->status.'</span>';
                }
                elseif($order->status == 'processing'){
                  echo '<span style="color: blue;">'.$order->status.'</span>';
                }
                elseif($order->status == 'pending'){
                  echo '<span style="color: orange;">'.$order->status.'</span>';
                }      
            echo '</td>
            <td>'.$order->total_price.'</td>
            <td>'.$order->total_weight.'</td>
        </tr>';
      endforeach;             
    echo '</table>
  </div>';
    }
    else{
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
                echo '<span style="color:red;">Pending</span>';
            } else {
                echo '<span style="color:green;">Resolved</span>';
            }
            echo '</td>' .
                '<td><button onclick="respondPopup(' . $complain->complaint_id . ',\'' . $complain->email . '\',\'' . $complain->name . '\')">Respond</button></td>
                <td><a href="'.URLROOT.'/admin/sendToSuperAdmin/'.$complain->complaint_id.'"><button>Send to super admin</button></a></td>
                </tr>';
        }
        echo '</table>' .
            '</div>';
    } else {
        echo '<div class="no-result" style="display:flex; justify-content:center;"><p>No results found</p></div>';
    }
  }


?>




