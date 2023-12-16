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
                <img src="<?php echo URLROOT; ?>/assets/images/customer/profile.png" alt="Profile Image" class="profile-image"> <!--path changed-->
                <?php 
                if (isset($_SESSION["user_id"])){
                    echo '<h2 class="profile-name2">'.$data['customerName'].'<br><span>'.$data["customerEmail"].'<span></h2>';
                } else {
                    echo '<h2 class="profile-name2">NO USER<br><span>NO EMAIL<span></h2>';
                }
                ?>
            </div>
            <div class="cnge">
                <button class="cnge-btn">change picture</button>
            </div>
            <br>
            <br>
            <hr>
            <div class="personal-details">
                <h2>Personal Information</h2>
                <div class="my-details">
                    <div class="FName">
                        <label class="label-FName">First Name</label><br>
                        <input type="text" class="form-FName" value="user">
                    </div>
                    <div class="LName">
                        <label class="label-LName">Last Name</label><br>
                        <input type="text" class="form-LName" value="user">
                    </div>
                    <div class="Email">
                        <label class="label-Email">Email Address</label><br>
                        <input type="email" class="form-Email" value="user@gmail.com">
                    </div>
                    <div class="Number">
                        <label class="label-Number">Contact Number</label><br>
                        <input type="text" class="form-Number" value="0712345678">
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
                        <input type="text" class="form-F-Name" value="user">
                    </div>
                    <div class="L-Name">
                        <label class="label-L-Name">Last Name</label><br>
                        <input type="text" class="form-L-Name" value="user">
                    </div>
                    <div class="Address">
                        <label class="label-Address">Address</label><br>
                        <input type="text" class="form-Address" value="142, temple Road, Panadura">
                    </div>
                    <div class="prov">
                        <label class="label-prov">Province</label><br>
                        <input type="text" class="form-prov" value="Western">
                    </div>
                    <div class="dist">
                        <label class="label-dist">District</label><br>
                        <input type="text" class="form-dist" value="Kaluthara">
                    </div>
                    <div class="city">
                        <label class="label-city">City</label><br>
                        <input type="text" class="form-city" value="Panadura">
                    </div>
                    <div class="p-code">
                        <label class="label-p-code">Postal Code</label><br>
                        <input type="text" class="form-p-code" value="12550">
                    </div>
                </div>
            </div>
            <div class="sbt">
                <button class="sbt-btn">Save Changes</button>
            </div>
            <br>
            <br>
        </div>

        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>



