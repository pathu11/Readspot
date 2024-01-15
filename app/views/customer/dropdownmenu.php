<div class="user"> 
    <img src="<?php echo URLROOT; ?>/assets/images/customer/profile.png" onclick="toggleMenu()"> <!--path changed-->
</div>

<div class="sub-menu-wrap" id="subMenu">
    <div class="sub-menu">
        <div class="user-info">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/profile.png"> <!--path changed-->
            <h3><?php echo $data['customerName']; ?></h3> <!--NAME COMMENT-->
        </div>
        <hr>

        <a href="<?php echo URLROOT; ?>/customer/Dashboard" class="sub-menu-link"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/customer/person.png"> <!--path changed-->
            <p>Dashboard</p>
            <span>></span>
        </a>
        
        <a href="<?php echo URLROOT; ?>/customer/AddCont" class="sub-menu-link"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/customer/plus.png"> <!--path changed-->
            <p>Add contents</p>
            <span>></span>
        </a>
        
        <a href="<?php echo URLROOT; ?>/customer/Notification" class="sub-menu-link"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/customer/bell.png"> <!--path changed-->
            <p>Notifications</p>
            <span>></span>
        </a>

        <a href="<?php echo URLROOT; ?>/customer/Cart" class="sub-menu-link"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/customer/cart01.png"> <!--path changed-->
            <p>Cart</p>
            <span>></span>
        </a>
        
        <a href="<?php echo URLROOT; ?>/landing/logout" class="sub-menu-link"> <!--path changed-->
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