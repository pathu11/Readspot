<div class="sidebar">
        <!-- Sidebar content goes here -->
        <div class="profile-section">
            <img src="http://localhost/Group-27/public/assets/images/customer/profile.png" alt="Profile Image" class="profile-image">
            <?php 
            if (isset($_SESSION["customer_name"])){
                echo '<h2 class="profile-name1">'.$_SESSION["customer_name"].'</h2>';
            } else {
                echo '<h2 class="profile-name1">NO USER</h2>';
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
                <li data-page="Event"><a href="./Event.php">Event</a></li>
                <li data-page="Cart"><a href="./Cart.php">Cart</a></li>
                <li data-page="Logout"><a href="http://localhost/Group-27/app/controllers/Logout.php">Logout</a></li>
            </ul>
        </div>
        </div>