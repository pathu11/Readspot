<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <title>Update Password</title>
    
    <!-- <link rel="stylesheet" href="./assets/css/LoginPageCSS.css"> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/signupCss.css" />
</head>
<body>
    <div class="container">
        <?php flash('register_success'); ?>
        <form class="login" action="<?php echo URLROOT; ?>/landing/updatepass/<?php echo $data['user_id'];?>" method="post">
            <h1>Update your Password</h1>
            <input type="password" name="pass"  placeholder="New password " required><i class="fa fa-eye-slash" id="togglePassword"></i><br>
            <span class="error"><?php echo $data['pass_err']; ?></span>
            <input type="password" name="confirm_pass"  placeholder="Confirm the new password " required><i class="fa fa-eye-slash" id="togglePassword2"></i></i><br>
            <span class="error"><?php echo $data['confirm_pass_err']; ?></span>
            <button class="btn" name="submit" type="submit">log in</button>
            <div>
                <span class="copyright">&copy;2023</span> 
            </div>  
        </form>
        <div class="register">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/logo.png">
            <!-- <i class="fas fa-user-plus fa-5x"></i> -->
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introducing a web-based Platform for Buying
                Selling, exchanging, and Donating both new & used books.</p>
            <a href="#"><button onclick="goBack()" class="submit">  Cancel </button> </a>
            
        </div>  
      </div>
</body>
</html>
<script>
   document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordInput = document.querySelector('input[name="pass"]');
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        this.classList.toggle('fa-eye-slash'); // Toggle the slash on the icon
        this.classList.toggle('fa-eye');   // Toggle the eye icon itself
        });
        document.getElementById('togglePassword2').addEventListener('click', function() {
        var passwordInput = document.querySelector('input[name="confirm_pass"]');
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        this.classList.toggle('fa-eye-slash'); // Toggle the slash on the icon
        this.classList.toggle('fa-eye');   // Toggle the eye icon itself
        });
function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
</script>
          
