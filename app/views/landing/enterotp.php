<?php
    $title = "OTP";
    
    // Retrieve the remaining time from your PHP backend
    $remainingTime = $data['remaining_time']; // Make sure this value is set in your PHP logic
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/addbooks.css" />

    <!-- Set the initial remaining time from PHP variable -->
    <script>
        var initialRemainingTime = <?php echo $remainingTime; ?>;
    </script>
</head>

<body>
    <div>
        <div class="form-container">
            <div class="form1">
                <span>We sent an OTP to your registered email address. Check your inbox and enter the OTP</span>
                
                <form action="<?php echo URLROOT; ?>/landing/enterotp" method="POST">                    
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

    <!-- Add this script to handle the countdown timer -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Set the initial remaining time from PHP variable
            var remainingTime = initialRemainingTime;
            updateRemainingTime(remainingTime);

            // Update the remaining time every second
            var countdownInterval = setInterval(function () {
                remainingTime = Math.max(0, remainingTime - 1);
                updateRemainingTime(remainingTime);

                // Stop the countdown when the remaining time reaches 0
                if (remainingTime === 0) {
                    clearInterval(countdownInterval);
                }
            }, 1000);

            function updateRemainingTime(timeInSeconds) {
                // Convert seconds to minutes and seconds
                var minutes = Math.floor(timeInSeconds / 60);
                var seconds = timeInSeconds % 60;

                // Update the content of the remainingTime element
                document.getElementById('remainingTime').innerText = minutes + 'm ' + seconds + 's';
            }
        });
    </script>
</body>

</html>
