

<!DOCTYPE html>
<html lang="en">

<head>

    
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/addbooks.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/sidebar.css" />
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <title>Edit Account Details</title>
</head>

<body>
<?php require APPROOT.'/views/publisher/sidebar.php';?>
    <div>
   
        <div class="form-container">
             
            <div class="form1">
                <h2>Enter the Account Details </h2>
                <form action="<?php echo URLROOT; ?>/publisher/editAccountForBooks/<?php echo $data['book_id']; ?>" method="POST">                    
                    <br>
                    <br>
                                   
                    <input type="text" name="account_name" class="<?php echo (!empty($data['account_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['account_name']; ?>" placeholder="Account Holder Name" required><br>
                    <span class="error"><?php echo $data['account_name_err']; ?></span>
                               
                                   
                    <input type="text" name="account_no" class="<?php echo (!empty($data['account_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['account_no']; ?>" placeholder="Account Number" required>
                                              
                    <input type="text" name="bank_name"  class="<?php echo (!empty($data['bank_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['bank_name']; ?>"placeholder="Bank Name" required><br>
                    <span class="error"><?php echo $data['bank_name_err']; ?></span>

                    <input type="text" name="branch_name"  class="<?php echo (!empty($data['branch_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['branch_name']; ?>"placeholder="Branch Name" required><br>
                    <span class="error"><?php echo $data['branch_name_err']; ?></span>
                    <button class="submit" type="button" onclick="goBack()">Back</button>
                    <input  type="submit" placeholder="Submit" name="submit" class="submit">
                    </div> 
                    <br>       
                    

                </form>
            </div>
        </div>

</div> 
    </div>
   
    <div id="myModal" class="modal">
            <div class="modal-content">
                <!-- <span class="close" onclick="closeModal()">&times;</span> -->
                <h2>Record Added!</h2>
                <p>Your record has been recorded. Wait for admin approval</p>
                <button  class="confirm" onclick="closeModal()">OK</button>
            </div>
        </div>
</body>
<script>
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
                window.location.href = "<?php echo URLROOT; ?>/NewBooks/productGallery"; // Redirect to the event page
            }

            <?php
            // Check if the showModal flag is set, then call showModal()
            if (isset($_SESSION['showModal']) && $_SESSION['showModal']) {
                echo "window.onload = showModal;";
                // Unset the session variable after use
                unset($_SESSION['showModal']);
            }
            ?>

            // Submit form function
            // function submitForm() {
            //     document.getElementById("eventForm").submit();
            // }
    
    </script>
</body>

</html>
