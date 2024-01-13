<?php
    $title = "Add Admins";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/addbooks.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />

</head>

<body>
    <div>
    <?php   require APPROOT . '/views/superadmin/nav.php';?><div>
        <div class="form-container">
             
            <div class="form1">
                <h2>Enter the Details of the Admin</h2>
                <form action="<?php echo URLROOT; ?>/superadmin/addAdmin" method="POST">                    
                    <br>
                    <br>
                                   
                    <input type="text" name="name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" placeholder="Full Name" required><br>
                    <span class="error"><?php echo $data['name_err']; ?></span>
                               
                                   
                    <input type="email" name="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" placeholder="Email" required>
                                              
                    <input type="password" name="pass"  class="<?php echo (!empty($data['pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pass']; ?>"placeholder="Password" required><br>
                    <span class="error"><?php echo $data['pass_err']; ?></span>

                    <input type="password" name="confirm_pass"  class="<?php echo (!empty($data['confirm_pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_pass']; ?>"placeholder="Confirm Password" required><br>
                    <span class="error"><?php echo $data['confirm_pass_err']; ?></span>
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
