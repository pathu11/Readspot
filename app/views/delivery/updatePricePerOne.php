<?php
    $title = "Update Delivery Charge";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/addbooks.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />

</head>

<body>
    <div>
    <?php   require APPROOT . '/views/delivery/nav.php';?><div>
        <div class="form-container">
             
            <div class="form1">
                <h2>Enter the Details of the Admin</h2>
                <form action="<?php echo URLROOT; ?>/delivery/updatePricePerOne" method="POST">                    
                    <br>
                    <br>
                                   
                    <input type="number" name="priceperkilo" class="<?php echo (!empty($data['priceperkilo_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['priceperkilo']; ?>" placeholder="Delivery Charge per kilogram" required><br>
                    <span class="error"><?php echo $data['priceperkilo_err']; ?></span>
                               
                                   
                  
                    <input  type="submit" placeholder="Submit" name="submit" class="submit">
                    </div> 
                    <br>       
                    

                </form>
            </div>
        </div>

</div> 
    </div>
   

</body>

</html>
