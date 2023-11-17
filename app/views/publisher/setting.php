
<?php
    $title = "Settings";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Settings</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/set.css" />
</head>

<body>
<?php   require APPROOT . '/views/publisher/sidebar.php';?>
    <div class="con">
    <?php foreach($data['publisherDetails'] as $publisherDetails): ?>
    

        <div class="l_col">
        
                <img style="border-radius:60%;width:60%;" src="<?php echo URLROOT; ?>/assets/images/publisher/person.jpg">
                
                <h3><?php echo $publisherDetails->name; ?></h3><br>
                <p><?php echo $publisherDetails->email; ?></p><br>
                <p><?php echo $publisherDetails->contact_no; ?></p>
                
            <button id="btnclick" class="my-button">Edit Profile</button><br>
            
        </div>

        <div class="r_col">
            
            <div class="r_a_col">
                <h2>Postal Details</h2>
                <table>
                
                        <tr>
                        <td> 
                            <label>Name</label><br>
                            <span><?php echo $publisherDetails->name; ?></span><br>
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
               

             
                <button id="btnClick1" class="my-button">Edit</button>
            </div>
            <div class="r_b_col">
                <h2>Account Details</h2>
                <table>
                
                        <tr>
                        <td> 
                            <label>Name</label><br>
                            <span><?php echo $publisherDetails->name; ?></span><br>
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
               

             
                <button id="btnClick1" class="my-button">Edit</button>
            </div>
            
            
        </div>
        <?php endforeach; ?>
    </div>

</body>

</html>

