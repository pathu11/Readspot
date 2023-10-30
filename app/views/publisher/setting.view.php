<?php
    $title = "Settings";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/publisher/set.css">
    <link rel="icon" type="image/png" href="http://localhost/Group-27/public/assets/images/publisher/ReadSpot.png">
    <title>Settings</title>
    
</head>

<body>
    <?php include 'nav.view.php';?> 
    <div class="con">
        <div class="l_col">
        
                <img style="border-radius:60%;width:60%;" src="http://localhost/Group-27/public/assets/images/publisher/person.jpg">
                <h3><?php echo $publisherName; ?></h3><br>
                <p><?php echo $publisheremail; ?></p><br>
                <p><?php echo $publishercontact_no; ?></p>
                
            <button id="btnclick" class="my-button">Edit Profile</button><br>
            
        </div>

        <div class="r_col">
            
            <div class="r_a_col">
                <h2>Postal Details</h2>
                <table>
                
                        <tr>
                        <td> 
                            <label>Name</label><br>
                            <span><?php echo $publisherName; ?></span><br>
                        </td>
                        <td>
                            <label>Address</label><br>
                            <span><?php echo $publisherStreet; ?></span><br> 
                        </td>

                    <tr>
                    <tr>
                        <td>
                            <label>City</label><br>
                            <span><?php echo $publishertown; ?></span><br>
                        </td>
                        <td>
                            <label>District</label><br>
                            <span><?php echo $publisherdistrict; ?></span><br>
                        </td>
                        <td>
                            <label>Postal Code</label><br>
                            <span><?php echo $publisherPostalcode; ?></span><br>
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
                            <span><?php echo $publisheraccount_name; ?></span><br>
                        </td>
                        <td>
                            <label>Account Number</label><br>
                            <span><?php echo $publisheraccount_no; ?></span><br> 
                        </td>

                    <tr>
                    <tr>
                        <td>
                            <label>Bank Name</label><br>
                            <span><?php echo $publisherbank_name; ?></span><br>
                        </td>
                        <td>
                            <label>Branch Name</label><br>
                            <span><?php echo $publisherbranch_name; ?></span><br>
                        </td>
                       

                    <tr>


                </table>
               

             
                <button id="btnClick1" class="my-button">Edit</button>
            </div>
            
            
        </div>
    </div>

    <?php include 'footer.view.php'; ?>  
   
</body>

</html>
