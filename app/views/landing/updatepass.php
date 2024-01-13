<?php
    $title = "Update Password";
    
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
                <span>Change your password</span>
                
                
                <form action="<?php echo URLROOT; ?>/landing/updatepass/<?php echo $data['user_id'];?>" method="POST">                    
                    <br>
                    <br>
                                   
                    <input type="password" name="pass"  placeholder="New password " required><br>
                    <span class="error"><?php echo $data['pass_err']; ?></span>

                    <input type="password" name="confirm_pass"  placeholder="Confirm the new password " required><br>
                    <span class="error"><?php echo $data['confirm_pass_err']; ?></span>
                    <button onclick="goBack()" class="submit">  Cancel </button> 
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
