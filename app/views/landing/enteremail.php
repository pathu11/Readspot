<?php
    $title = "Enter email";
    
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
                <span>Enter your registered email address </span>
                
                <form action="<?php echo URLROOT; ?>/landing/enteremail" method="POST">                    
                    <br>
                    <br>
                    <span class="error"><?php echo $data['email_err']; ?></span>
              
                    <input type="email" name="email"  placeholder="Email address " required><br>
                    
                    
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
