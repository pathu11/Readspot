<div class="sidebar">
        <!-- Sidebar content goes here -->
        <div class="profile-section">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/profile.png" alt="Profile Image" class="profile-image">
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
                <li data-page="Dashboard"><a href="<?php echo URLROOT; ?>/customer/Dashboard">Dashboard</a></li>
                <li data-page="Profile"><a href="<?php echo URLROOT; ?>/customer/Profile">Profile</a></li>
                <li data-page="Notification"><a href="<?php echo URLROOT; ?>/customer/Notification">Notification</a></li>
                <li data-page="Bookshelf"><a href="<?php echo URLROOT; ?>/customer/Bookshelf">Bookshelf</a></li>
                <li data-page="Content"><a href="<?php echo URLROOT; ?>/customer/Content">Content</a></li>
                <li data-page="Event"><a href="<?php echo URLROOT; ?>/customer/Event">Event</a></li>
                <li data-page="Cart"><a href="<?php echo URLROOT; ?>/customer/Cart">Cart</a></li>
                <li data-page="Logout"><a href="<?php echo URLROOT; ?>/landing/logout">Logout</a></li>
            </ul>
        </div>
        </div>