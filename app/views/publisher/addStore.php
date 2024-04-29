

<!DOCTYPE html>
<html lang="en">

<head>

    
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/addbooks.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/sidebar.css" />
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <title>Add Store</title>
</head>

<body>
<?php require APPROOT.'/views/publisher/sidebar.php';?>
    <div>
   
        <div class="form-container">
        
            <div class="form1">
                <h2>Add a Store </h2>
                <form action="<?php echo URLROOT; ?>/publisher/addStore/<?php echo $data['publisher_id']; ?>" method="POST">                    
                    <br>
                    <br>           
                    <input type="text" name="postal_name" class="<?php echo (!empty($data['postal_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_name']; ?>" placeholder=" Name" required><br>
                    <span class="error"><?php echo $data['postal_name_err']; ?></span>
                               
                                   
                    <input type="text" name="street_name" class="<?php echo (!empty($data['street_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['street_name']; ?>" placeholder="Street Name" required>
                                              
                    <input type="text" name="town"  class="<?php echo (!empty($data['town_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['town']; ?>"placeholder="City" required><br>
                    <span class="error"><?php echo $data['town_err']; ?></span>

                    <select class="select <?php echo (!empty($data['district_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['district']; ?>" name="district" required>
                                <option value="" selected disabled>Select Your District</option>
                                <option value="Ampara">Ampara</option>
                                <option value="Anuradhapura">Anuradhapura</option>
                                <option value="Badulla">Badulla</option>
                                <option value="Batticaloa">Batticaloa</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Galle">Galle</option>
                                <option value="Gampaha">Gampaha</option>
                                <option value="Hambantota">Hambantota</option>
                                <option value="Jaffna">Jaffna</option>
                                <option value="Kalutara">Kalutara</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Kegalla">Kegalla</option>
                                <option value="Kilinochchi">Kilinochchi</option>
                                <option value="Kurunegala">Kurunegala</option>
                                <option value="Mannar">Mannar</option>
                                <option value="Matale">Matale</option>
                                <option value="Matara">Matara</option>
                                <option value="Moneragala">Moneragala</option>
                                <option value="Mullaitivu">Mullaitivu</option>
                                <option value="Nuwara Eliya">Nuwara Eliya</option>
                                <option value="Polonnaruwa">Polonnaruwa</option>
                                <option value="Puttalam">Puttalam</option>
                                <option value="Ratnapura">Ratnapura</option>
                                <option value="Trincomalee">Trincomalee</option>
                                <option value="Vavuniya">Vavuniya</option>
                            </select>
                    <span class="error"><?php echo $data['district_err']; ?></span>

                    <input type="text" name="postal_code"  class="<?php echo (!empty($data['postal_code_err'])) ? 'is-invalid' : ''; ?>" pattern="\d{5}" title="Please enter exactly five digits"  value="<?php echo $data['postal_code']; ?>"placeholder="Postal Code" required><br>
                    <span class="error"><?php echo $data['postal_code_err']; ?></span>
                    <button class="submit" type="button" onclick="goBack()">Back</button>
                    <input  type="submit" placeholder="Submit" name="submit" class="submit">
                    </div> 
                    <br>       
                    

                </form>
            </div>
        </div>

</div> 
    </div>
   
    <?php
    require APPROOT . '/views/publisher/footer.php'; 
?>

<div id="myModal" class="modal">
        <div class="modal-content">
            <!-- <span class="close" onclick="closeModal()">&times;</span> -->
            <h2>Record Added!</h2>
            <p>Your record has been recorded. Wait for admin approval</p>
            <button onclick="closeModal()" class="confirm">OK</button>
        </div>
    </div>
    <!--div class="bg">
      <img src="<?php echo URLROOT;?>/assets/images/publisher/event2.webp">
    </div-->
  </div>
  


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
                window.location.href = "<?php echo URLROOT; ?>/publisher/stores"; // Redirect to the event page
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
