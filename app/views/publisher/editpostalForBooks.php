

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/addbooks.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/sidebar.css" />
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <style>
      
        .new-store-form,
        .select-store-form,
        .default-store-form {
            display: none;
        }
    </style>
     <title>Edit Postal Details</title>
</head>

<body>
<?php require APPROOT . '/views/publisher/sidebar.php';?>
    <div>
        <div class="form-container">
            <div class="form1">
                <h2>Select Your  Picked Up address</h2>
                <br>
                    <br>

                    <div class="radio-group">
                        <label>
                            <input type="radio" name="addressType" value="selectStore">
                            Select Address from Store Table
                        </label>
                        <label>
                            <input type="radio" name="addressType" value="newStore">
                            Add New Store
                        </label>
                        <label>
                            <input type="radio" name="addressType" value="defaultAddress">
                            Use Default Address
                        </label>
                    </div>
                    
                    <br><br>
                    <div class="new-store-form">
                    <form action="<?php echo URLROOT; ?>/publisher/editPostalForBooks/<?php echo $data['book_id']; ?>" method="POST">
                        <input type="hidden" name="form_type" value="addStoreToBooks">
                        
                        <input type="text" name="postal_name" class="<?php echo (!empty($data['postal_name_err'])) ? 'is-invalid' : ''; ?>" placeholder="Name" required><br>
                        <span class="error"><?php echo $data['postal_name_err']; ?></span>

                        <input type="text" name="street_name" class="<?php echo (!empty($data['street_name_err'])) ? 'is-invalid' : ''; ?>"  placeholder="Street Name" required>

                        <input type="text" name="town" class="<?php echo (!empty($data['town_err'])) ? 'is-invalid' : ''; ?>"  placeholder="City" required><br>
                        <span class="error"><?php echo $data['town_err']; ?></span>

                        <select class="select <?php echo (!empty($data['district_err'])) ? 'is-invalid' : ''; ?>"  name="district" required>
                                <option value="" selected disabled>Select Your district</option>
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

                        <input type="text" name="postal_code" class="<?php echo (!empty($data['postal_code_err'])) ? 'is-invalid' : ''; ?>" pattern="\d{5}" title="Please enter exactly five digits"  placeholder="Postal Code" required><br>
                        <span class="error"><?php echo $data['postal_code_err']; ?></span>
                        <button class="submit" type="button" onclick="goBack()">Back</button>
                        <input type="submit" value="Next" name="submit" class="submit">
                    </form>
                    </div>
                    <div class="select-store-form">
                        <form action="<?php echo URLROOT; ?>/publisher/editPostalForBooks/<?php echo $data['book_id']; ?>" method="POST">
                            <input type="hidden" name="form_type" value="selectStore">
                            <?php foreach($data['storeDetails'] as $store): ?>
                                <input type="radio" id="<?php echo $store->store_id; ?>" name="selectedStore" value="<?php echo $store->store_id; ?>" <?php if(isset($_POST['selectedStore']) && $_POST['selectedStore'] == $store->store_id) echo 'checked'; ?>>
                                <label for="<?php echo $store->store_id; ?>">
                                    <?php echo  $store->postal_name . ", " . $store->street_name . ", " . $store->town . ", " . $store->district . ", " . $store->postal_code; ?>
                                </label>
                            <?php endforeach; ?>
                            <br><br>
                            <button class="submit" type="button" onclick="goBack()">Back</button>
                            <input type="submit" value="Next" name="submit" class="submit">
                        </form>
                    </div>
                    <div class="default-store-form">
                    <form action="<?php echo URLROOT; ?>/publisher/editPostalForBooks/<?php echo $data['book_id']; ?>" method="POST">
                        <input type="hidden" name="form_type" value="default_address">
                        <input type="text" name="postal_name" class="<?php echo (!empty($data['postal_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_name']; ?>" placeholder="Name" readonly><br>
                        <span class="error"><?php echo $data['postal_name_err']; ?></span>

                        <input type="text" name="street_name" class="<?php echo (!empty($data['street_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['street_name']; ?>" placeholder="Street Name" readonly>

                        <input type="text" name="town" class="<?php echo (!empty($data['town_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['town']; ?>" placeholder="City" readonly><br>
                        <span class="error"><?php echo $data['town_err']; ?></span>

                        <select class="select <?php echo (!empty($data['district_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['district']; ?>" name="district" disabled>
                            
                                    <?php
                                        $district = array(
                                            "Ampara", "Anuradhapura", "Badulla", "Batticaloa", "Colombo", "Galle", "Gampaha",
                                            "Hambantota", "Jaffna", "Kalutara", "Kandy", "Kegalla", "Kilinochchi", "Kurunegala",
                                            "Mannar", "Matale", "Matara", "Moneragala", "Mullaitivu", "Nuwara Eliya", "Polonnaruwa",
                                            "Puttalam", "Ratnapura", "Trincomalee", "Vavuniya"
                                        );

                                        foreach ($district as $district) {
                                            $selected = ($data['district'] === $district) ? 'selected' : '';
                                            echo "<option value=\"$district\" $selected >$district</option>";
                                        }
                                    ?>
                            </select>
                        <!-- <span class="error"><?php echo $data['district_err']; ?></span> -->

                        <input type="text" name="postal_code" class="<?php echo (!empty($data['postal_code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_code']; ?>" placeholder="Postal Code" readonly><br>
                        <span class="error"><?php echo $data['postal_code_err']; ?></span>
                        <button class="submit" type="button" onclick="goBack()">Back</button>
                        <input type="submit" value="Next" name="submit" class="submit">
                    </form>
                    </div>
            </div>
        </div>
    </div>
    <?php
      require APPROOT . '/views/publisher/footer.php'; //path changed
?>
    <script>
        var newStoreForm = document.querySelector('.new-store-form');
        var selectStoreForm = document.querySelector('.select-store-form');
        var defaultStoreForm = document.querySelector('.default-store-form');

        document.querySelectorAll('input[name="addressType"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                if (this.value === 'newStore') {
                    newStoreForm.style.display = 'block';
                    selectStoreForm.style.display = 'none';
                    defaultStoreForm.style.display='none';
                } else if (this.value === 'selectStore') {
                    newStoreForm.style.display = 'none';
                    selectStoreForm.style.display = 'block';
                    defaultStoreForm.style.display='none';
                } else if(this.value === 'defaultAddress'){
                    newStoreForm.style.display = 'none';
                    selectStoreForm.style.display = 'none';
                    defaultStoreForm.style.display='block';
                }else{
                    newStoreForm.style.display = 'none';
                    selectStoreForm.style.display = 'none';
                    defaultStoreForm.style.display='none';
                }
            });
        });

        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
    </script>
</body>

</html>
