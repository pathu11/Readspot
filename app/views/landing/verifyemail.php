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
    <link rel="icon" type="image/jpg" href="<?php echo URLROOT; ?>/assets/images/customer/logo.png">
</head>
<body>
    <div class="container">
        <form class="login" action="<?php echo URLROOT; ?>/landing/verifyemail" method="post">
        <h1>Verify Your Email</h1><br>
            <h4 style="color:red;" >We sent an OTP to your  email address. Check your inbox and enter the OTP for  verifying entered email address</h4>
            <br>
            <span class="invalid-feedback"><?php echo $data['otp_err']; ?></span>
            <input type="text" name="otp"  placeholder="Enter the OTP code" required><br>
           
                               
            <!-- Add this code where you want to display the remaining time -->
            <!-- <p>Remaining Time:</p> -->
          <label>  Remaining Time:</label><p id="remainingTime" style="font-size:30px;color:red;"></p>
           
            <button class="btn" name="submit" type="submit">sign up</button>
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
           <button onclick="goBack()" class="submit">  Cancel </button>
        </div>  
      </div>
      <!-- <div id="myModal_err" class="modal">
        <div class="modal-content">
            
            <h2>Invalid otp!</h2>
            <p>We've noticed an invalid OTP attempt on your account. Please try again later.</p><br><br>
            <button onclick="closeModalErr()" class="confirm">OK</button>
        </div>
    </div>
    <div id="myModal_success" class="modal">
        <div class="modal-content">
            
            <h2>Correct!</h2>
            <p>Your entered Otp is correct .</p><br><br>
            <button onclick="closeModalSuccess()" class="confirm">OK</button>
        </div>
    </div> -->
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
        function updateRemainingTime() {
            var remainingTimeElement = document.getElementById('remainingTime');
            var remainingTime = sessionStorage.getItem('remainingTime'); 
            if (remainingTime && remainingTime > 0) {
                remainingTimeElement.innerText = formatTime(remainingTime);
                remainingTime--; 
                sessionStorage.setItem('remainingTime', remainingTime); 
            } else {
                remainingTimeElement.innerText = 'Expired';
                
            }
        }

        function formatTime(seconds) {
            var minutes = Math.floor(seconds / 60);
            var remainingSeconds = seconds % 60;
            return minutes + ':' + (remainingSeconds < 10 ? '0' : '') + remainingSeconds;
        }
        document.addEventListener('DOMContentLoaded', function() {
            updateRemainingTime();
            setInterval(updateRemainingTime, 1000); // 
            if (!sessionStorage.getItem('remainingTime')) {
                sessionStorage.setItem('remainingTime', 60); 
            }
    });
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
        function goBack() {
            window.history.back();
        }
 
        // function showModalErr() {
        //         var modal1 = document.getElementById("myModal_err");
        //         modal1.style.display = "block";
        //     }
        //     function goBack() {
        //     window.history.back();
        // }
        //     function closeModalErr() {
        //         var modal1 = document.getElementById("myModal_err");
        //         modal1.style.display = "none";
        //         window.location.href = "<?php echo URLROOT; ?>/landing/sendEmailCustomer"; // Redirect to the event page
        //     }

        //     <?php
               
        //         if (isset($_SESSION['otp_err']) && !empty($_SESSION['otp_err'])) {
        //             echo "window.onload = showModalErr;";
        //             unset($_SESSION['otp_err']);
        //         }
        //         if (isset($_SESSION['otp_success']) && !empty($_SESSION['otp_success'])) {
        //             echo "window.onload = showModalSuccess;";
        //             unset($_SESSION['otp_success']);
        //         }
        //     ?>

        //     function showModalSuccess() {
        //         var modal2 = document.getElementById("myModal_success");
        //         modal2.style.display = "block";
        //     }

        //     function closeModalSuccess() {
        //         var modal2 = document.getElementById("myModal_success");
        //         modal2.style.display = "none";
        //         window.location.href = "<?php echo URLROOT; ?>/landing/signupCustomer"; // Redirect to the event page
        //     }

          
    </script>
</html>
                     