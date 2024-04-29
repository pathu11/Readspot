<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/LoginPageCSS.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg" href="<?php echo URLROOT; ?>/assets/images/customer/logo.png">
</head>
<body>
    <div class="container">
        <form class="login" action="<?php echo URLROOT; ?>/landing/enteremail" method="post">
        <br><br>
            <h2>Enter your registered email address</h2>
            <br><br><br>
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
              
              <input type="email" name="email"  placeholder="Email address " required><br>
              
           <br>
            <button class="btn" onclick="handleEmailEnterButtonClick()" name="submit" type="submit">Submit</button><br>
            <div>
                <span class="copyright">&copy;2023</span> 
            </div>  
        </form>
        <div class="register">
            <div class="back-btn-div-login">
                <button class="back-btn-login" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
            </div>
            <img src="<?php echo URLROOT; ?>/assets/images/customer/logo.png">
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introducing a web-based Platform for Buying
                Selling, exchanging, and Donating both new & used books.</p>
            <a href="#"><button onclick="goBack()" class="submit">  Back </button> </a>
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
            window.history.back();
        }
        // Function to clear sessionStorage
        function clearSessionStorage() {
            sessionStorage.removeItem('remainingTime');
        }
        function handleEmailEnterButtonClick() {
            clearSessionStorage();
        }
    </script>
    
</html>
                     