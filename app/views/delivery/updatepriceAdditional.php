

<!DOCTYPE html>
<html lang="en">

<head>

<title>Update Price</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/addbooks.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
</head>

<body>
    <div>
    <div>
        <div class="form-container">
             
            <div class="form1">
                <h2>Enter Charge for per  additional kg </h2>
                <form action="<?php echo URLROOT; ?>/delivery/updatepriceAdditional/<?php echo $data['delivery_id']; ?>" method="POST">                    
                    <br>
                    <br>
                                   
                    <input type="number" name="priceperadditional" class="<?php echo (!empty($data['priceperadditional_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['priceperadditional']; ?>" placeholder="Delivery Charge per  Additional kilogram" required><br>
                    <span class="error"><?php echo $data['priceperadditional_err']; ?></span>
                               
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
<!-- <a href="#" class="go-back-link" onclick="goBack()">&lt;&lt; Back</a> -->
</html>
