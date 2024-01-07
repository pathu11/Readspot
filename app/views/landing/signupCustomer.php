<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/LoginPageCSS.css">
</head>
<body>
    <div class="container">
        <form class="login" action="<?php echo URLROOT; ?>/landing/signupCustomer" method="post">
            <h1>Sign up</h1>
            <input type="text" name="name" placeholder="Full Name" <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
           
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>

            <input type="email" name="email" placeholder="Email" <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>"  >

            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>

            <input type="password" name="pass" placeholder="Password" <?php echo (!empty($data['pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pass']; ?>">

            <span class="invalid-feedback"><?php echo $data['pass_err']; ?></span>
            <input type="password" name="confirm_pass" placeholder="Confirm Password" <?php echo (!empty($data['confirm_pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_pass']; ?>"><br>

            <span class="invalid-feedback"><?php echo $data['confirm_pass_err']; ?></span>
            <button onclick="goBack()" class="submit">  Cancel</button> 
            <button class="btn" name="submit" type="submit">sign up</button>
            <div>
                <span class="copyright">&copy;2023</span> 
            </div>  
        </form>
        <div class="register">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/logo.png">
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introducing a web-based Platform for Buying
                Selling, exchanging, and Donating both new & used books.</p>
            <a href="<?php echo URLROOT; ?>landing/login"><button>login</button></a>
        </div>  
      </div>
      <script>
         document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.querySelector('input[type="email"]');
            const emailError = document.getElementById('email-error');
            emailInput.addEventListener('input', function() {
                if (!/@/.test(emailInput.value)) {
                    emailError.textContent = 'Please enter a valid email address';
                    emailError.style.display = 'block';
                } else {
                    emailError.textContent = '';
                    emailError.style.display = 'none';
                }
            });
        });
      </script>
</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</html>
                     