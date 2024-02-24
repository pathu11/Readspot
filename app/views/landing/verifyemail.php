<?php
    $title = "Verify Email";
    
    // Retrieve the remaining time from your PHP backend
    $remainingTime = $data['remaining_time']; // Make sure this value is set in your PHP logic
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/LoginPageCSS.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <form class="login" action="<?php echo URLROOT; ?>/landing/verifyemail" method="post">
        <h1>Verify Your Email</h1><br>
            <h4 style="color:red;" >We sent an OTP to your  email address. Check your inbox and enter the OTP for  verifying entered email address</h4>
            <br>
                
            <input type="text" name="otp"  placeholder="Enter the OTP code" required><br>
            <span class="error"><?php echo $data['otp_err']; ?></span>
                               
            <!-- Add this code where you want to display the remaining time -->
            <!-- <p>Remaining Time:</p> -->
          <label>  Remaining Time:</label><p id="remainingTime" style="font-size:30px;color:red;"></p>
           
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
            <a href="#"> <button onclick="goBack()" class="submit">  Cancel </button></a>
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
        // Set the initial remaining time from PHP variable
        var initialRemainingTime = <?php echo $remainingTime; ?>;
        
        // Function to update the remaining time
        function updateRemainingTime() {
            var remainingTimeElement = document.getElementById('remainingTime');
            if (initialRemainingTime > 0) {
                remainingTimeElement.innerText = formatTime(initialRemainingTime);
                initialRemainingTime--;
            } else {
                remainingTimeElement.innerText = 'Expired';
                // You can perform additional actions here when the time expires
            }
        }

        // Function to format time in MM:SS format
        function formatTime(seconds) {
            var minutes = Math.floor(seconds / 60);
            var remainingSeconds = seconds % 60;
            return minutes + ':' + (remainingSeconds < 10 ? '0' : '') + remainingSeconds;
        }

        // Call the updateRemainingTime function every second
        setInterval(updateRemainingTime, 1000);
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
                     