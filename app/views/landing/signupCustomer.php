<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/LoginPageCSS.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .invalid-feedback{
            background-color:white;
            color: red;
            padding-left: 15px;
            padding-right: 15px;
            padding:5px;
}
        </style>
</head>
<body>
    <div class="container">
        <form class="login" action="<?php echo URLROOT; ?>/landing/signupCustomer" method="post">
            <h1>Sign Up As A Customer</h1>
            <input type="text" name="first_name" placeholder="First Name" <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['first_name']; ?>" required>
           
            <span class="invalid-feedback"><?php echo $data['first_name_err']; ?></span>
            
            <input type="text" name="last_name" placeholder="Last Name" <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['last_name']; ?>" required>
           
            <span class="invalid-feedback"><?php echo $data['last_name_err']; ?></span>

            <!-- <input type="email" name="email" placeholder="Email" <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>"  >

            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span> -->

            <div class="password-wrapper">
            <input type="password" name="pass" placeholder="Password" <?php echo (!empty($data['pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pass']; ?>" required>
            <i class="fa fa-eye-slash" id="togglePassword"></i> <br>
            <span class="invalid-feedback"><?php echo $data['pass_err']; ?></span></div>

            <div class="password-wrapper">
            <input type="password" name="confirm_pass" placeholder="Confirm Password" <?php echo (!empty($data['confirm_pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_pass']; ?>" required><br>
            <i class="fa fa-eye-slash" id="togglePassword2"></i> <br>

            <span class="invalid-feedback"><?php echo $data['confirm_pass_err']; ?></span></div>

            <!-- <button onclick="goBack()" class="btn">  Cancel</button>  -->
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
            <a href="<?php echo URLROOT; ?>/landing/login"><button>login</button></a>
        </div>  
      </div>
      <div id="myModal" class="modal">
        <div class="modal-content">
            <!-- <span class="close" onclick="closeModal()">&times;</span> -->
            <h2>Registration Successfull!</h2>
            <p>Congratulations! You have been successfully added as a customer. Welcome to our platform!</p><br><br>
            <button onclick="closeModal()" class="confirm">OK</button>
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
        
        function showModal() {
                var modal = document.getElementById("myModal");
                modal.style.display = "block";
            }

            function closeModal() {
                var modal = document.getElementById("myModal");
                modal.style.display = "none";
                window.location.href = "<?php echo URLROOT; ?>/landing/login"; // Redirect to the event page
            }

            <?php
            // Check if the showModal flag is set, then call showModal()
            if (isset($_SESSION['showModal']) && $_SESSION['showModal']) {
                echo "window.onload = showModal;";
                // Unset the session variable after use
                unset($_SESSION['showModal']);
            }
            ?>
    </script>
</html>
                     