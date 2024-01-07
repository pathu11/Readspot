<?php
    if($_POST['searchType']=='customer'){
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
    }

    elseif($_POST['searchType']=='publisher'){
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

    elseif($_POST['searchType']=='charity'){
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


?>




