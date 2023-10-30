<div class="user"> 
    <img src="./assets/img/profile.png" onclick="toggleMenu()">
</div>

<div class="sub-menu-wrap" id="subMenu">
    <div class="sub-menu">
        <div class="user-info">
            <img src="./assets/img/profile.png">
            <h3><?php echo $_SESSION["customerName"]; ?></h3>
        </div>
        <hr>

        <a href="./Dashboard.php" class="sub-menu-link">
            <img src="./assets/img/person.png">
            <p>Dashboard</p>
            <span>></span>
        </a>
        
        <a href="./AddCont.php" class="sub-menu-link">
            <img src="./assets/img/plus.png">
            <p>Add contents</p>
            <span>></span>
        </a>
        
        <a href="./Notification.php" class="sub-menu-link">
            <img src="./assets/img/bell.png">
            <p>Notifications</p>
            <span>></span>
        </a>

        <a href="./Cart.php" class="sub-menu-link">
            <img src="./assets/img/cart.png">
            <p>Cart</p>
            <span>></span>
        </a>
        
        <a href="includes/logout.inc.php" class="sub-menu-link">
            <img src="./assets/img/logout.png">
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