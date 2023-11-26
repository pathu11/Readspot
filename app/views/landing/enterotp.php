<?php
    $title = "OTP";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/addbooks.css" />
    

</head>

<body>
    <div>
   
        <div class="form-container">
             
            <div class="form1">
                <span>We sent a otp to your registered email address.Check your inbox and enter the otp</span>
                
                <form action="<?php echo URLROOT; ?>/landing/enterotp" method="POST">                    
                    <br>
                    <br>
                                   
                    <input type="text" name="otp"  placeholder="Enter the Otp code " required><br>
                    <span class="error"><?php echo $data['otp_err']; ?></span>
                               
                    
                    
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
