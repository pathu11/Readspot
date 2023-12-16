<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/main.css"> <!--path changed-->
    <!-- <script src="./assets/js/prof.js"></script> -->
    <script src="<?php echo URLROOT; ?>/assets/js/customer/Add.js"></script> <!--path changed-->
    <script src="<?php echo URLROOT; ?>/assets/js/customer/dropcategory.js"></script> <!--path changed-->
    <script src="<?php echo URLROOT; ?>/assets/js/customer/home.js"></script> <!--path changed-->

    <title><?php echo $title; ?></title>
</head>
<body>
    <header>
    <div class="head">
        <img src="<?php echo URLROOT; ?>/assets/images/customer/logo.png" alt="logo" class="logo"> <!--path changed-->
        <div class="navig">
            <nav class="navigation">
                <a href="<?php echo URLROOT; ?>/customer/index" data-head="Home">Home</a>
                <a href="<?php echo URLROOT; ?>/customer/AboutUs" data-head="About">About</a> <!--path changed-->
                <a href="<?php echo URLROOT; ?>/customer/Services" data-head="Services">Services</a> <!--path changed-->
                <a href="<?php echo URLROOT; ?>/customer/ContactUs" data-head="Contact">Contact</a> <!--path changed-->
            </nav>
            <?php 
                if (isset($_SESSION["user_id"])){
                    include_once 'dropdownmenu.php';
                } else {
                    echo '<a href="<?php echo URLROOT; ?>landing/login"><button class="Login">Login</button></a>';
                }
            ?>
            <div class="mobnav">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/menu.png" alt="menu" class="menu">
                <nav id="subNav">
                    <a href="<?php echo URLROOT; ?>/customer/index" data-head="Home">Home</a>
                    <a href="<?php echo URLROOT; ?>/customer/AboutUs" data-head="About">About</a> <!--path changed-->
                    <a href="<?php echo URLROOT; ?>/customer/Services" data-head="Services">Services</a> <!--path changed-->
                    <a href="<?php echo URLROOT; ?>/customer/ContactUs" data-head="Contact">Contact</a> <!--path changed-->
                </nav>
            </div>
        </div>
        </div>
    </header>

    <script>
        // Get the current page URL
        var currentPage = window.location.href;

        // Get all menu items
        var menuItem = document.querySelectorAll('.navigation a');

        // Loop through menu items to find the active one
        for (var i = 0; i < menuItem.length; i++) {
            var page = menuItem[i].getAttribute('data-head');
            if (currentPage.includes(page)) {
                menuItem[i].classList.add('active');
                break; // Exit the loop once the active item is found
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const menuIcon = document.querySelector('.mobnav img');
            const subNav = document.getElementById('subNav');

            menuIcon.addEventListener('click', function () {
                subNav.style.display = (subNav.style.display === 'block') ? 'none' : 'block';
                menuIcon.src = (menuIcon.src.includes('<?php echo URLROOT; ?>/assets/images/customer/menu.png')) ? '<?php echo URLROOT; ?>/assets/images/customer/close.png' : '<?php echo URLROOT; ?>/assets/images/customer/menu.png';
            });
        });

    </script>
    