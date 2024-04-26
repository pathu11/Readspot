<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="./assets/css/LoginPageCSS.css"> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/signupCss.css" />
</head>
<body>
    <div class="container">
        <?php flash('register_success'); ?>
        <form class="login" action="<?php echo URLROOT; ?>/landing/login" method="post">
            <h1>Log in</h1>
            <input type="email" name="email" placeholder="Email" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>" required >
            <div class="password-wrapper">
            <input type="password" name="pass" placeholder="password"  value="<?= isset($_COOKIE['pass']) ? $_COOKIE['pass'] : '' ?>" required ><i class="fa fa-eye-slash" id="togglePassword"></i> <br></div>
          
            <input type="checkbox" id="rememberMe" name="rememberMe" <?= (isset($_COOKIE['email']) && isset($_COOKIE['pass'])) ? "checked" : '' ?> value=1>
            <span id="rememberme"><label for="rememberme">Remember me</label></span>
            <a href="<?php echo URLROOT; ?>/landing/enteremail">Forgot password !</a>
            <button class="btn" name="submit" type="submit">log in</button>
           
            <div>
                <span class="copyright">Readspot&copy;2023</span> 
            </div>  
        </form>


        <div class="register">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/logo.png">
            <!-- <i class="fas fa-user-plus fa-5x"></i> -->
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introducing a web-based Platform for Buying
                Selling, exchanging, and Donating both new & used books.</p>
            <a href="<?php echo URLROOT; ?>/landing/selectuser"><button>SignUp</button></a>
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

</script>
          
