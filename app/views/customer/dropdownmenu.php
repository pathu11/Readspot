<div class="user"> 
    <img src="http://localhost/Group-27/public/assets/images/customer/profile.png" onclick="toggleMenu()">
</div>

<div class="sub-menu-wrap" id="subMenu">
    <div class="sub-menu">
        <div class="user-info">
            <img src="http://localhost/Group-27/public/assets/images/customer/profile.png">
            <h3><?php echo $_SESSION["customerName"]; ?></h3>
        </div>
        <hr>

        <a href="./Dashboard.php" class="sub-menu-link">
            <img src="http://localhost/Group-27/public/assets/images/customer/person.png">
            <p>Dashboard</p>
            <span>></span>
        </a>
        
        <a href="./AddCont.php" class="sub-menu-link">
            <img src="http://localhost/Group-27/public/assets/images/customer/plus.png">
            <p>Add contents</p>
            <span>></span>
        </a>
        
        <a href="./Notification.php" class="sub-menu-link">
            <img src="http://localhost/Group-27/public/assets/images/customer/bell.png">
            <p>Notifications</p>
            <span>></span>
        </a>

        <a href="./Cart.php" class="sub-menu-link">
            <img src="http://localhost/Group-27/public/assets/images/customer/cart.png">
            <p>Cart</p>
            <span>></span>
        </a>
        
        <a href="http://localhost/Group-27/app/controllers/publisher/Logout.php" class="sub-menu-link">
            <img src="http://localhost/Group-27/public/assets/images/customer/logout.png">
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