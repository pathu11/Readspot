<?php
    $title = "Update Admins";
    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Update Admin</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/addbooks.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
</head>

<body>
    <div>
        <?php require APPROOT . '/views/superadmin/nav.php';?>
        <div>
            <div class="form-container">
                <div class="form1">
               
                    <h2>Enter the Details of the Admin</h2>
                    <form action="<?php echo URLROOT; ?>/superadmin/updateAdmin/<?php echo $data['user_id']; ?>" method="POST">
                        <br>
                        <br>
                       
                        <input type="text" name="name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" placeholder="Full Name" required><br>
                        <span class="error"><?php echo isset($data['name_err']) ? $data['name_err'] : ''; ?></span>
                        <input type="email" name="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" placeholder="Email" required>
                        <div class="password-wrapper">
                        <input type="password" name="pass" placeholder="Password" <?php echo (!empty($data['pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pass']; ?>">
                        <i class="fa fa-eye-slash" id="togglePassword"></i> <br>
                        <span class="invalid-feedback"><?php echo $data['pass_err']; ?></span></div>

                        <div class="password-wrapper">
                        <input type="password" name="confirm_pass" placeholder="Confirm Password" <?php echo (!empty($data['confirm_pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_pass']; ?>"><br>
                        <i class="fa fa-eye-slash" id="togglePassword2"></i> <br>

                        <span class="invalid-feedback"><?php echo $data['confirm_pass_err']; ?></span></div>
                        <br>
                        <button onclick="goBack()" class="submit">  Back </button>   
                        <input  type="submit" placeholder="Submit" name="submit" class="submit">
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
    <script>
     document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordInput = document.querySelector('input[name="pass"]');
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        this.classList.toggle('fa-eye-slash'); // Toggle the slash on the icon
        this.classList.toggle('fa-eye');   // Toggle the eye icon itself
        });

        document.getElementById('togglePassword2').addEventListener('click', function() {
        var confirmPasswordInput = document.querySelector('input[name="confirm_pass"]');
        var type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);

        this.classList.toggle('fa-eye-slash'); // Toggle the slash on the icon
        this.classList.toggle('fa-eye');   // Toggle the eye icon itself
    });
 
        // Toggle the eye icon itself
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</html>
