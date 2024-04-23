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
<?php require APPROOT . '/views/delivery/sidebar.php';?>
    <div>
    <div>
        <div class="form-container">
             
            <div class="form1">
                <h2>Enter the charge for first kg</h2>
                <form action="<?php echo URLROOT; ?>/delivery/updatePricePerOne/<?php echo $data['delivery_id']; ?>" method="POST">                    
                    <br>
                    <br>
                                   
                    <input type="number" name="priceperkilo" class="<?php echo (!empty($data['priceperkilo_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['priceperkilo']; ?>" placeholder="Delivery Charge per kilogram" required><br>
                    <span class="error"><?php echo $data['priceperkilo_err']; ?></span>
                               
                                   
                    <button onclick="goBack()" class="submit">  Back </button>   
                    <input  type="submit" placeholder="Submit" name="submit" class="submit">
                    </div> 
                    <br>       
                    

                </form>
            </div>
        </div>

</div> 
    </div>
   

</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</html>
