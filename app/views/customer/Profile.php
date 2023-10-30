<?php
    $title = "Profile";
    include_once 'header.php';
?>

    <div class="container">
        <div class="sidebar">
        <!-- Sidebar content goes here -->
        <div class="profile-section">
            <img src="./assets/img/profile.png" alt="Profile Image" class="profile-image">
            <?php 
            if (isset($_SESSION["customerName"])){
                echo '<h2 class="profile-name1">'.$_SESSION["customerName"].'</h2>';
            } else {
                echo '<h2 class="profile-name1">Ramath Perera</h2>';
            }
            ?>
        </div>
        <br>
        <hr>

        <!-- Menu section -->
        <div class="menu-section">
            <ul class="menu-list">
                <li data-page="Dashboard"><a href="./Dashboard.php">Dashboard</a></li>
                <li data-page="Profile"><a href="./Profile.php">Profile</a></li>
                <li data-page="Notification"><a href="./Notification.php">Notification</a></li>
                <li data-page="Bookshelf"><a href="./Bookshelf.php">Bookshelf</a></li>
                <li data-page="Content"><a href="./Content.php">Content</a></li>
                <li data-page="Cart"><a href="./Cart.php">Cart</a></li>
            </ul>
        </div>
        </div>

        <div class="prof-content">
            <div class="prof-picture">
                <img src="./assets/img/profile.png" alt="Profile Image" class="profile-image">
                <?php 
                if (isset($_SESSION["customerName"])){
                    echo '<h2 class="profile-name2">'.$_SESSION["customerName"].'<br><span>'.$_SESSION["customerEmail"].'<span></h2>';
                } else {
                    echo '<h2 class="profile-name2">Ramath Perera<br><span>ramath@gmail.com<span></h2>';
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
