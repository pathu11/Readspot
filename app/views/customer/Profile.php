<?php
    $title = "Profile";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="prof-content">
            <div class="prof-picture">
                <?php
                    if ($data['customerImage']) {
                        echo '<img src="' . URLROOT . '/assets/images/customer/ProfileImages/'.$data['customerImage'].'" alt="Profile Image" class="profile-image"';
                    } else {
                        echo '<img src="' . URLROOT . '/assets/images/customer/profile.png" alt="Profile Image" class="profile-image">';
                    }
                ?>
                <?php 
                if (isset($_SESSION["user_id"])){
                    echo '<center><h2 class="profile-name2">'.$data['FullName'].'<br><span>'.$data["customerEmail"].'<span></h2></center>';
                } else {
                    echo '<center><h2 class="profile-name2">NO USER<br><span>NO EMAIL<span></h2></center>';
                }
                ?>
            </div>
            <div class="cnge">
                <button class="cnge-btn" onclick="toggleChgImg()">Change Picture</button>
            </div>
            <div class="div-cng-img-overlay" id="DivCngImgOverlay"></div>
            <div class="div-cng-img" id="DivCngImg">
                <form action="<?php echo URLROOT; ?>/customer/ChangeProfImage" enctype="multipart/form-data" method="POST">
                    <?php
                        if ($data['customerImage']) {
                            echo '<img src="' . URLROOT . '/assets/images/customer/ProfileImages/'.$data['customerImage'].'" alt="Profile Image" class="profile-image-cng" id="profileImage">';
                        } else {
                            echo '<img src="' . URLROOT . '/assets/images/customer/profile.png" alt="Profile Image" class="profile-image-cng" id="profileImage">';
                        }
                    ?>
                    <label for="imageInput" id="imageLabel">Choose a new image</label>
                    <input type="file" name="newImage" accept="image/*" id="imageInput" onchange="previewImage()" style="display: none">
                    <div class="buttons-container">
                        <button type="submit" class="save">Save Changes</button>
                        <button type="button" class="cancel" onclick="cancelImage()">Cancel</button>
                    </div>
                </form>
            </div>
            <br>
            <br>
            <hr>
            <form action="<?php echo URLROOT; ?>/customer/profile" enctype="multipart/form-data" method="POST">    
                <div class="personal-details">
                    <h2>Personal Information</h2>
                    <div class="my-details">
                        <!-- <div class="FName">
                            <label class="label-FName">First Name</label><br>
                            <input type="text" class="form-FName" value="<?php echo $data['FName']; ?>">
                        </div>
                        <div class="LName">
                            <label class="label-LName">Last Name</label><br>
                            <input type="text" class="form-LName" value="<?php echo $data['LName']; ?>">
                        </div> -->
                        <div class="Email">
                            <label class="label-Email">Email Address</label><br>
                            <input type="email" name="email" class="form-Email" value="<?php echo $data['customerEmail']; ?>">
                        </div>
                        <div class="Number">
                            <label class="label-Number">Contact Number</label><br>
                            <input type="text" name="ContactNo" class="form-Number" value="<?php echo $data['ContactNumber']; ?>" placeholder="Eg: +94712345689" pattern="\+\d{11}">
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <div class="postal-details">
                    <h2>Postal Information</h2>
                    <div class="post-details">
                        <div class="F-Name">
                            <label class="label-F-Name">First Name</label><br>
                            <input type="text" name="FName" class="form-F-Name" value="<?php echo $data['FName']; ?>">
                        </div>
                        <div class="L-Name">
                            <label class="label-L-Name">Last Name</label><br>
                            <input type="text" name="LName" class="form-L-Name" value="<?php echo $data['LName']; ?>">
                        </div>
                        <div class="Address">
                            <label class="label-Address">Address</label><br>
                            <input type="text" name="Address" class="form-Address" value="<?php echo $data['Address']; ?>">
                        </div>
                        <div class="prov">
                            <label class="label-prov">Province</label><br>
                            <!-- <input type="text" name="Province" class="form-prov" value="<?php echo $data['Province']; ?>"> -->
                            <select id="category" name="Province" required>
                                <option value="Central" <?php echo ($data['Province'] == 'Central') ? 'selected' : ''; ?>>Central</option>
                                <option value="Eastern" <?php echo ($data['Province'] == 'Eastern') ? 'selected' : ''; ?>>Eastern</option>
                                <option value="North Central" <?php echo ($data['Province'] == 'North Central') ? 'selected' : ''; ?>>North Central</option>
                                <option value="Northern" <?php echo ($data['Province'] == 'Northern') ? 'selected' : ''; ?>>Northern</option>
                                <option value="North Western" <?php echo ($data['Province'] == 'North Western') ? 'selected' : ''; ?>>North Western</option>
                                <option value="Sabaragamuwa" <?php echo ($data['Province'] == 'Sabaragamuwa') ? 'selected' : ''; ?>>Sabaragamuwa</option>
                                <option value="Southern" <?php echo ($data['Province'] == 'Southern') ? 'selected' : ''; ?>>Southern</option>
                                <option value="Uva" <?php echo ($data['Province'] == 'Uva') ? 'selected' : ''; ?>>Uva</option>
                                <option value="Western" <?php echo ($data['Province'] == 'Western') ? 'selected' : ''; ?>>Western</option>
                            </select>
                        </div>
                        <div class="dist">
                            <label class="label-dist">District</label><br>
                            <!-- <input type="text" name="District" class="form-dist" value="<?php echo $data['District']; ?>"> -->
                            <select id="category" name="District" required>
                                <!-- <option value="technology" <?php echo ($data['District'] == 'technology') ? 'selected' : ''; ?>>Technology</option>
                                <option value="travel" <?php echo ($data['District'] == 'travel') ? 'selected' : ''; ?>>Travel</option>
                                <option value="food" <?php echo ($data['District'] == 'food') ? 'selected' : ''; ?>>Food</option>
                                <option value="lifestyle" <?php echo ($data['District'] == 'lifestyle') ? 'selected' : ''; ?>>Lifestyle</option>
                                <option value="health" <?php echo ($data['District'] == 'health') ? 'selected' : ''; ?>>Health</option> -->

                                <option value="Ampara" <?php echo ($data['District'] == 'Ampara') ? 'selected' : ''; ?>>Ampara</option>
                                <option value="Anuradhapura" <?php echo ($data['District'] == 'Anuradhapura') ? 'selected' : ''; ?>>Anuradhapura</option>
                                <option value="Badulla" <?php echo ($data['District'] == 'Badulla') ? 'selected' : ''; ?>>Badulla</option>
                                <option value="Batticaloa" <?php echo ($data['District'] == 'Batticaloa') ? 'selected' : ''; ?>>Batticaloa</option>
                                <option value="Colombo" <?php echo ($data['District'] == 'Colombo') ? 'selected' : ''; ?>>Colombo</option>
                                <option value="Galle" <?php echo ($data['District'] == 'Galle') ? 'selected' : ''; ?>>Galle</option>
                                <option value="Gampaha" <?php echo ($data['District'] == 'Gampaha') ? 'selected' : ''; ?>>Gampaha</option>
                                <option value="Hambantota" <?php echo ($data['District'] == 'Hambantota') ? 'selected' : ''; ?>>Hambantota</option>
                                <option value="Jaffna" <?php echo ($data['District'] == 'Jaffna') ? 'selected' : ''; ?>>Jaffna</option>
                                <option value="Kalutara" <?php echo ($data['District'] == 'Kalutara') ? 'selected' : ''; ?>>Kalutara</option>
                                <option value="Kandy" <?php echo ($data['District'] == 'Kandy') ? 'selected' : ''; ?>>Kandy</option>
                                <option value="Kegalla" <?php echo ($data['District'] == 'Kegalla') ? 'selected' : ''; ?>>Kegalla</option>
                                <option value="Kilinochchi" <?php echo ($data['District'] == 'Kilinochchi') ? 'selected' : ''; ?>>Kilinochchi</option>
                                <option value="Kurunegala" <?php echo ($data['District'] == 'Kurunegala') ? 'selected' : ''; ?>>Kurunegala</option>
                                <option value="Mannar" <?php echo ($data['District'] == 'Mannar') ? 'selected' : ''; ?>>Mannar</option>
                                <option value="Matale" <?php echo ($data['District'] == 'Matale') ? 'selected' : ''; ?>>Matale</option>
                                <option value="Matara" <?php echo ($data['District'] == 'Matara') ? 'selected' : ''; ?>>Matara</option>
                                <option value="Moneragala" <?php echo ($data['District'] == 'Moneragala') ? 'selected' : ''; ?>>Moneragala</option>
                                <option value="Mullaitivu" <?php echo ($data['District'] == 'Mullaitivu') ? 'selected' : ''; ?>>Mullaitivu</option>
                                <option value="Nuwara Eliya" <?php echo ($data['District'] == 'Nuwara Eliya') ? 'selected' : ''; ?>>Nuwara Eliya</option>
                                <option value="Polonnaruwa" <?php echo ($data['District'] == 'Polonnaruwa') ? 'selected' : ''; ?>>Polonnaruwa</option>
                                <option value="Puttalam"  <?php echo ($data['District'] == 'Puttalam') ? 'selected' : ''; ?>>Puttalam</option>
                                <option value="Ratnapura" <?php echo ($data['District'] == 'Ratnapura') ? 'selected' : ''; ?>>Ratnapura</option>
                                <option value="Trincomalee" <?php echo ($data['District'] == 'Trincomalee') ? 'selected' : ''; ?>>Trincomalee</option>
                                <option value="Vavuniya" <?php echo ($data['District'] == 'Vavuniya') ? 'selected' : ''; ?>>Vavuniya</option>
                            </select>
                        </div>
                        <div class="city">
                            <label class="label-city">City</label><br>
                            <input type="text" name="city" class="form-city" value="<?php echo $data['City']; ?>">
                        </div>
                        <div class="p-code">
                            <label class="label-p-code">Postal Code</label><br>
                            <input type="text" id="postalCode" name="PostalCode" class="form-p-code" value="<?php echo $data['PostalCode']; ?>">
                            <span class="error" id="postalCodeError" style="color: red;"></span>
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <div class="account-details">
                    <h2>Account Details</h2>
                    <div class="acc-details">
                        <div class="acc-Name">
                            <label class="label-acc-Name">Account Holder's Name</label><br>
                            <input type="text" name="AccName" class="form-Account-Name" value="<?php echo $data['AccName']; ?>">
                        </div>
                        <div class="acc-Number">
                            <label class="label-acc-Number">Account Number</label><br>
                            <input type="number" name="AccNo" class="form-Account-Number" value="<?php echo $data['AccNumber']; ?>">
                        </div>
                        <div class="bank">
                            <label class="label-Bank-Name">Bank Name</label><br>
                            <input type="text" name="BankName" class="form-Bank-Name" value="<?php echo $data['BankName']; ?>">
                        </div>
                        <div class="branch">
                            <label class="label-Branch-Name">Branch Name</label><br>
                            <input type="text" name="BranchName" class="form-Branch-Name" value="<?php echo $data['BranchName']; ?>">
                        </div>
                    </div>
                </div>
                <div class="sbt">
                    <button type="submit" class="sbt-btn">Save Changes</button>
                </div>
                <br>
                <br>
            </form>
        </div>

        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>

<script>
    function toggleChgImg() {
    var divCngImgOverlay = document.getElementById('DivCngImgOverlay');
    var divCngImg = document.getElementById('DivCngImg');
    
    if (divCngImg.style.display === 'none' || divCngImg.style.display === '') {
        divCngImgOverlay.style.display = 'block';
        divCngImg.style.display = 'block';
    } else {
        divCngImgOverlay.style.display = 'none';
        divCngImg.style.display = 'none';
    }
}

function previewImage() {
    var imageInput = document.getElementById('imageInput');
    var profileImage = document.getElementById('profileImage');

    if (imageInput.files && imageInput.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            profileImage.src = e.target.result;
        };

        reader.readAsDataURL(imageInput.files[0]);
    }
}

function cancelImage() {
    var divCngImgOverlay = document.getElementById('DivCngImgOverlay');
    var divCngImg = document.getElementById('DivCngImg');
    
    divCngImgOverlay.style.display = 'none';
    divCngImg.style.display = 'none';
}

</script>

<script>
    document.getElementById('postalCode').addEventListener('input', function(event) {
        var postalCode = event.target.value;
        var postalCodeError = document.getElementById('postalCodeError');

        // Check if postal code is exactly 5 digits long
        if (postalCode.length !== 5 || isNaN(postalCode)) {
            postalCodeError.textContent = 'Postal code must be a 5-digit number.';
            event.target.setCustomValidity('Invalid postal code');
        } else {
            postalCodeError.textContent = '';
            event.target.setCustomValidity('');
        }
    });
</script>