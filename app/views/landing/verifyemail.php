<?php
    $title = "Verify Email";
    
    // Retrieve the remaining time from your PHP backend
    $remainingTime = $data['remaining_time']; // Make sure this value is set in your PHP logic
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/addbooks.css" />

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
</head>

<body>
    <div>
        <div class="form-container">
            <div class="form1">
                
                <span>We sent an OTP to your registered email address. Check your inbox and enter the OTP</span>
                
                <form action="<?php echo URLROOT; ?>/landing/verifyemail" method="POST">                    
                    <br>
                    <br>               
                    <input type="text" name="otp"  placeholder="Enter the OTP code" required><br>
                    <span class="error"><?php echo $data['otp_err']; ?></span>
                               
                    <!-- Add this code where you want to display the remaining time -->
                    <p>Remaining Time: <span id="remainingTime"></span></p>

                    <input type="submit" placeholder="Submit" name="submit" class="submit">
                </form>
            </div>
        </div>
    </div>

</body>

</html>
