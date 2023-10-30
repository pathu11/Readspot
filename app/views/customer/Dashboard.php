<?php
    $title = "Dashboard";
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
            <!-- Main content goes here -->
            <!-- 4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br>
            4<br> -->
        </div>
    </div>

<?php
    include_once 'footer.php';
?>
