<div class="user"> 
    <?php
        if ($data['customerImage']) {
            echo '<img src="' . URLROOT . '/assets/images/customer/ProfileImages/'.$data['customerImage'].'" onclick="toggleMenu()">';
        } else {
            echo '<img src="' . URLROOT . '/assets/images/customer/profile.png" onclick="toggleMenu()">';
        }
    ?>
    <!-- <img src="<?php echo URLROOT; ?>/assets/images/customer/profile.png" onclick="toggleMenu()"> path changed -->
</div>

<div class="sub-menu-wrap" id="subMenu">
    <div class="sub-menu">
        <div class="user-info">
            <?php
                if ($data['customerImage']) {
                    echo '<img src="' . URLROOT . '/assets/images/customer/ProfileImages/'.$data['customerImage'].'" onclick="toggleMenu()">';
                } else {
                    echo '<img src="' . URLROOT . '/assets/images/customer/profile.png" onclick="toggleMenu()">';
                }
            ?>
            <!-- <img src="<?php echo URLROOT; ?>/assets/images/customer/profile.png"> path changed -->
            <h3><?php echo $data['customerName']; ?></h3> <!--NAME COMMENT-->
        </div>
        <hr>

        <a href="<?php echo URLROOT; ?>/customer/Dashboard" class="sub-menu-link"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/customer/person.png"> <!--path changed-->
            <p>Dashboard</p>
            <span>></span>
        </a>
        
        <a href="<?php echo URLROOT; ?>/customer/Favorite" class="sub-menu-link"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit_icon.png"> <!--path changed-->
            <p>Favorites</p>
            <span>></span>
        </a>
        
        <a href="<?php echo URLROOT; ?>/customer/Notification" class="sub-menu-link"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/customer/bell.png"> <!--path changed-->
            <p>Notifications</p>
            <?php
                if ($data['unreadNotification'] > 0) {
                    echo '<h1> '. $data['unreadNotification']. ' </h1>';
                }
            ?>
            <span>></span>
        </a>

        <a href="<?php echo URLROOT; ?>/customer/Cart" class="sub-menu-link"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/customer/cart01.png"> <!--path changed-->
            <p>Cart</p>
            <span>></span>
        </a>
        
        <a href="<?php echo URLROOT; ?>/landing/IsLoggedOut" class="sub-menu-link"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/customer/logout01.png"> <!--path changed-->
            <p>Logout</p>
            <span>></span>
        </a>
    </div>
</div>

<script>
    let subMenu = document.getElementById("subMenu");

function toggleMenu(){
    subMenu.classList.toggle("open-menu");
}
</script>