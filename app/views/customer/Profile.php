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
                <img src="<?php echo URLROOT; ?>/assets/images/customer/ProfileImages/<?php echo $data['customerImage']; ?>" alt="Profile Image" class="profile-image"> <!--path changed-->
                <?php 
                if (isset($_SESSION["user_id"])){
                    echo '<center><h2 class="profile-name2">'.$data['customerName'].'<br><span>'.$data["customerEmail"].'<span></h2></center>';
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
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/ProfileImages/<?php echo $data['customerImage']; ?>" alt="Profile Image" class="profile-image-cng" id="profileImage">
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
                            <input type="text" name="ContactNo" class="form-Number" value="<?php echo $data['ContactNumber']; ?>">
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
                            <input type="text" name="Province" class="form-prov" value="<?php echo $data['Province']; ?>">
                        </div>
                        <div class="dist">
                            <label class="label-dist">District</label><br>
                            <input type="text" name="District" class="form-dist" value="<?php echo $data['District']; ?>">
                        </div>
                        <div class="city">
                            <label class="label-city">City</label><br>
                            <input type="text" name="city" class="form-city" value="<?php echo $data['City']; ?>">
                        </div>
                        <div class="p-code">
                            <label class="label-p-code">Postal Code</label><br>
                            <input type="text" name="PostalCode" class="form-p-code" value="<?php echo $data['PostalCode']; ?>">
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
                            <input type="text" name="AccNo" class="form-Account-Number" value="<?php echo $data['AccNumber']; ?>">
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