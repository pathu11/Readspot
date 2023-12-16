<head>
    <style>
    /* Header */
.head{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 10px 5px;
    display: flex;
    justify-content: space-between;
    background-color: #02514C;
    align-items: center;
    z-index: 100;
}

.head img {
    height: 65px;
    width: 84px;
    margin-left: 8px;
    margin-right: 8px;
}



/* Navigation Bar */
.navig{
    display: flex;
    justify-content: flex-end;
}

.navigation{
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin-left: 8px;
    margin-right: 8px;
}

.navigation a {
    position: relative;
    font-size: 1.1em;
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    margin-left: 16px;
    margin-right: 16px;
}

.navigation a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 100%;
    height: 3px;
    background: #fff;
    border-radius: 5px;
    transform-origin: right;
    transform: scaleX(0);
    transition: transform .5s;
}

.navigation a:hover::after {
    transform-origin: left;
    transform: scaleX(1);
}



/* Login Icon */
.Login {
    width: 88px;
    height: 50px;
    background-color: transparent;
    border-color: #03FFF0;
    outline: none;
    border-radius: 6px;
    cursor: pointer;
    color: #03FFF0;
    font-size: 1.1em;
    font-weight: 500;
    transition: .5s;
    margin-left: 8px;
    margin-right: 8px;
}

.Login:hover {
    background: #fff;
    color: black;
    border: none;
    transform: scale(1.1);
}


/* Drop Down Menu */
.user img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    background-size: cover;
    background-position: center;
}

.sub-menu-wrap{
    position: absolute;
    top: 88%;
    right: 0%;
    width: 240px;
    max-height: 0px;
    overflow: hidden;
    transition: max-height 0.5s;
}

.sub-menu-wrap.open-menu{
    max-height: 360px;
}

.sub-menu{
    background: #fff;
    padding: 20px;
    margin: 10px;
    /* backdrop-filter: blur(5px); */
    border-radius: 20px;
}

.user-info{
    display: flex;
    flex-direction: column;
    align-items: center;
}

.user-info h3{
    font-weight: 500;
    margin-top: 5px;
}

.user-info img{
    width: 40px;
    height: 40px;
    border-radius: 50%;
    /* margin-right: 15px; */
}


.sub-menu hr{
    border: 0;
    height: 2px;
    width: 100%;
    background: #ccc;
    margin: 15px 0 10px;
}

.sub-menu-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #525252;
    margin: 10px 0;
}

.sub-menu-link p {
    width: 100%;
}

.sub-menu-link img {
    width: 30px;
    height: 30px;
    background: black;
    border-radius: 50%;
    padding: 5px;
    margin-right: 15px;
}

.sub-menu-link span {
    font-size: 22px;
    transition: transform 0.5s;
}

.sub-menu-link:hover span {
    transform: translateX(5px);
}

.sub-menu-link:hover p {
    font-weight: 600;
}/* Header */
.head{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 10px 5px;
    display: flex;
    justify-content: space-between;
    background-color: #D2EAE9;
    align-items: center;
    z-index: 100;
}

.head img {
    height: 65px;
    width: 84px;
    margin-left: 8px;
    margin-right: 8px;
}



/* Navigation Bar */
.navig{
    display: flex;
    justify-content: flex-end;
}

.navigation{
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin-left: 8px;
    margin-right: 8px;
}

.navigation a {
    position: relative;
    font-size: 1.1em;
    color: #525252;
    text-decoration: none;
    font-weight: 500;
    margin-left: 16px;
    margin-right: 16px;
}

.navigation a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 100%;
    height: 3px;
    background: #525252;
    border-radius: 5px;
    transform-origin: right;
    transform: scaleX(0);
    transition: transform .5s;
}

.navigation a:hover::after {
    transform-origin: left;
    transform: scaleX(1);
}



/* Login Icon */
.Login {
    width: 88px;
    height: 50px;
    background-color: transparent;
    border-color: #525252;
    outline: none;
    border-radius: 6px;
    cursor: pointer;
    color: #525252;
    font-size: 1.1em;
    font-weight: 500;
    transition: .5s;
    margin-left: 8px;
    margin-right: 8px;
}

.Login:hover {
    background: #fff;
    color: black;
    border: none;
    transform: scale(1.1);
}


/* Drop Down Menu */
.user img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    background-size: cover;
    background-position: center;
}

.sub-menu-wrap{
    position: absolute;
    top: 88%;
    right: 0%;
    width: 240px;
    max-height: 0px;
    overflow: hidden;
    transition: max-height 0.5s;
}

.sub-menu-wrap.open-menu{
    max-height: 360px;
}

.sub-menu{
    background: #fff;
    padding: 20px;
    margin: 10px;
    /* backdrop-filter: blur(5px); */
    border-radius: 20px;
}

.user-info{
    display: flex;
    flex-direction: column;
    align-items: center;
}

.user-info h3{
    font-weight: 500;
    margin-top: 5px;
}

.user-info img{
    width: 40px;
    height: 40px;
    border-radius: 50%;
    /* margin-right: 15px; */
}


.sub-menu hr{
    border: 0;
    height: 2px;
    width: 100%;
    background: #ccc;
    margin: 15px 0 10px;
}

.sub-menu-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #525252;
    margin: 10px 0;
}

.sub-menu-link p {
    width: 100%;
}

.sub-menu-link img {
    width: 30px;
    height: 30px;
    background: black;
    border-radius: 50%;
    padding: 5px;
    margin-right: 15px;
}

.sub-menu-link span {
    font-size: 22px;
    transition: transform 0.5s;
}

.sub-menu-link:hover span {
    transform: translateX(5px);
}

.sub-menu-link:hover p {
    font-weight: 600;
}

.highlight{
    background-color: #70BFBA;
    border-radius: 5px;
    padding: 5px;
}

.bx{
    font-size: 40px;
}
/* Header */
    </style>
</head>

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
            <img src="<?php echo URLROOT; ?>/assets/images/customer/cart.png"> <!--path changed-->
            <p>Cart</p>
            <span>></span>
        </a>
        
        <a href="<?php echo URLROOT; ?>/landing/logout" class="sub-menu-link"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/customer/logout.png"> <!--path changed-->
            <p>Logout</p>
            <span>></span>
        </a>
    </div>
</div>

<script>
    // Updated JavaScript code
    document.addEventListener("DOMContentLoaded", function () {
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }

        // Attach the click event listener to the profile image
        document.querySelector('.user img').addEventListener('click', toggleMenu);
    });
</script>