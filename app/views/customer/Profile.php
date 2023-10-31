<?php
    $title = "Profile";
    include_once 'header.php';
?>

    <div class="container">
        <?php
            include_once 'sidebar.php';
        ?>

        <div class="prof-content">
            <div class="prof-picture">
                <img src="http://localhost/Group-27/public/assets/images/customer/profile.png" alt="Profile Image" class="profile-image">
                <?php 
                if (isset($_SESSION["customer_name"])){
                    echo '<h2 class="profile-name2">'.$_SESSION["customer_name"].'<br><span>'.$_SESSION["customer_email"].'<span></h2>';
                } else {
                    echo '<h2 class="profile-name2">NO USER<br><span>NO EMAIL<span></h2>';
                }
                ?>
            </div>
            <div class="cng">
                <button class="cng-btn">change picture</button>
            </div>
            <br>
            <br>
            <br>
            <hr>
            <div class="personal-details">
                <h2>Personal Information</h2>
                <div class="my-details">
                    <div class="FName">
                        <label class="label-FName">First Name</label><br>
                        <input type="text" class="form-FName" value="Ramath">
                    </div>
                    <div class="LName">
                        <label class="label-LName">Last Name</label><br>
                        <input type="text" class="form-LName" value="Perera">
                    </div>
                    <div class="Email">
                        <label class="label-Email">Email Address</label><br>
                        <input type="email" class="form-Email" value="ramath@gmail.com">
                    </div>
                    <div class="Number">
                        <label class="label-Number">Contact Number</label><br>
                        <input type="text" class="form-Number" value="0718695748">
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
                        <input type="text" class="form-F-Name" value="Ramath">
                    </div>
                    <div class="L-Name">
                        <label class="label-L-Name">Last Name</label><br>
                        <input type="text" class="form-L-Name" value="Perera">
                    </div>
                    <div class="Address">
                        <label class="label-Address">Address</label><br>
                        <input type="text" class="form-Address" value="142, Paraththa Road, Panadura">
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
        </div>
    </div>


<?php
    include_once 'footer.php';
?>
