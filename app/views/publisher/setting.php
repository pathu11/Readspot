


<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Settings</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/set.css" />
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
</head>

<body>
<?php   require APPROOT . '/views/publisher/sidebar.php';?>
    <div class="con">
    <?php foreach($data['publisherDetails'] as $publisherDetails): ?>
        <div class="r_col">
            <div class="r_c_col">
                <div class="r_c_a_col">
                <?php
                        $profileImage = empty($publisherDetails->profile_img) ? URLROOT . '/assets/images/publisher/person.jpg' : URLROOT . '/assets/images/landing/profile/' . $publisherDetails->profile_img ;
                    ?>
                    <img  src="<?php echo $profileImage; ?>" ><br><br><br>
                   <p><a href="<?php echo URLROOT; ?>/publisher/editProfile/<?php echo  $publisherDetails->publisher_id; ?>" id="btnclick" class="my-button">Edit Profile</a></p><br>
                </div> 
                <div class="r_c_a_col1">
                    <table>
                        <tr>
                        <td>Name </td>
                        <td><span><?php echo $publisherDetails->name; ?></span></td>
                        </tr>
                        <tr>
                        <td>Company Name </td>
                        <td><span><?php echo $publisherDetails->company_name; ?></span></td>
                        </tr>
                        
                        <tr>
                        <td><label>Email</label> 
                        <td><span><?php echo $publisherDetails->email; ?></span>
                        </tr>
                        <tr>
                        <td><label>Contact Number</label> 
                        <td><span><?php echo $publisherDetails->contact_no; ?></span>
                        </tr>
    </table>                
                    <!-- <a href="<?php echo URLROOT; ?>/publisher/editProfile/<?php echo  $publisherDetails->publisher_id; ?>" id="btnclick" class="my-button">Edit Profile</a><br> -->
                </div>    
            </div>
            
            <div class="r_a_col">
                <h2>Postal Details</h2>
                <table>
                
                        <tr>
                        <td> 
                            <label>Name</label><br>
                            <span><?php echo $publisherDetails->postal_name; ?></span><br>
                        </td>
                        <td>
                            <label>Address</label><br>
                            <span><?php echo $publisherDetails->street_name; ?></span><br> 
                        </td>

                    <tr>
                    <tr>
                        <td>
                            <label>City</label><br>
                            <span><?php echo $publisherDetails->town; ?></span><br>
                        </td>
                        <td>
                            <label>District</label><br>
                            <span><?php echo $publisherDetails->district; ?></span><br>
                        </td>
                        <td>
                            <label>Postal Code</label><br>
                            <span><?php echo  $publisherDetails->postal_code; ?></span><br>
                        </td>

                    <tr>                   
                </table>
                <a href="<?php echo URLROOT; ?>/publisher/editpostal/<?php echo  $publisherDetails->publisher_id; ?>" id="btnClick1" class="my-button">Edit</a>     
            </div>
            <div class="r_b_col">
                <h2>Account Details</h2>
                <table>
                        <tr>
                        <td> 
                            <label>Name</label><br>
                            <span><?php echo $publisherDetails->account_name; ?></span><br>
                        </td>
                        <td>
                            <label>Account Number</label><br>
                            <span><?php echo $publisherDetails->account_no; ?></span><br> 
                        </td>

                    <tr>
                    <tr>
                        <td>
                            <label>Bank Name</label><br>
                            <span><?php echo $publisherDetails->bank_name; ?></span><br>
                        </td>
                        <td>
                            <label>Branch Name</label><br>
                            <span><?php echo $publisherDetails->branch_name; ?></span><br>
                        </td>
                    <tr>
                </table>
                <a href="<?php echo URLROOT; ?>/publisher/editAccount/<?php echo $publisherDetails->publisher_id; ?>" id="btnClick1" class="my-button">Edit</a>
            </div>   
        </div>
        <?php endforeach; ?>
    </div>
    <!-- <?php
            require APPROOT . '/views/publisher/footer.php'; //path changed
        ?> -->
</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }    
    </script>
</html>

