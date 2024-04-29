<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/main.css"> <!--path changed-->
    <!-- <script src="./assets/js/prof.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" type="image/jpg" href="<?php echo URLROOT; ?>/assets/images/customer/logo.png"
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src="<?php echo URLROOT; ?>/assets/js/customer/Add.js"></script> <!--path changed-->
    <script src="<?php echo URLROOT; ?>/assets/js/customer/dropcategory.js"></script> <!--path changed-->

    <script src="<?php echo URLROOT; ?>/assets/js/customer/home.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/js/customer/tables.js"></script> 
    <script src="<?php echo URLROOT; ?>/assets/js/customer/calender.js"></script> 
    <link rel="icon" type="image/jpg" href="<?php echo URLROOT; ?>/assets/images/customer/logo.png">

    

    <title><?php echo $title; ?></title>
</head>
<body>
    <header>
    <div class="head">
        <img src="<?php echo URLROOT; ?>/assets/images/customer/logo.png" alt="logo" class="logo"> <!--path changed-->
        <div class="navig">
            <nav class="navigation">
                <a href="<?php echo URLROOT; ?>/landing/index" data-head="index">Home</a>
                <a href="<?php echo URLROOT; ?>/customer/AboutUs" data-head="About">About</a> <!--path changed-->
                <div class="dropdown-services">
                    <button onclick="toggleDropdown('myDropdown-S')" data-head="Services">Services <i class="fa fa-caret-down"></i></button> <!--path changed-->
                    <div id="myDropdown-S" class="dropdown-content-services">
                        <a href="<?php echo URLROOT; ?>/customer/BuyNewBooks">Buy New Books</a>
                        <a href="<?php echo URLROOT; ?>/customer/BuyUsedBook">Buy Used Books</a>
                        <a href="<?php echo URLROOT; ?>/customer/ExchangeBook">Exchange Books</a>
                        <a href="<?php echo URLROOT; ?>/customer/DonateBooks">Donate Books</a>
                        <a href="<?php echo URLROOT; ?>/customer/BookContents">Contents</a>
                        <a href="<?php echo URLROOT; ?>/customer/BookEvents">Events</a>
                        <a href="<?php echo URLROOT; ?>/customer/BookChallenge">Book Challenges</a>
                        <!-- <a href="#">Event Calender</a> -->
                    </div>
                </div>
                <a href="<?php echo URLROOT; ?>/customer/ContactUs" data-head="Contact">Contact</a> <!--path changed-->
            </nav>
            <?php 
                if (isset($_SESSION["user_id"])){
                    include_once 'dropdownmenu.php';
                } else {
                    echo '<a href="' . URLROOT . '/landing/login"><button class="Login">Login</button></a>';
                }
            ?>

            <div class="mobnav">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/menu.png" alt="menu" class="menu">
                <nav id="subNav">
                    <a href="<?php echo URLROOT; ?>/landing/index" data-head="Home">Home</a>
                    <a href="<?php echo URLROOT; ?>/customer/AboutUs" data-head="About">About</a> <!--path changed-->
                    <button class="drop-serv">Services <i class="fa fa-caret-down"></i></button> <!--path changed-->
                    <div id="myDropdown-S" class="dropdown-content-services">
                        <a href="<?php echo URLROOT; ?>/customer/BuyNewBooks">Buy New Books</a>
                        <a href="<?php echo URLROOT; ?>/customer/BuyUsedBook">Buy Used Books</a>
                        <a href="<?php echo URLROOT; ?>/customer/ExchangeBook">Exchange Books</a>
                        <a href="<?php echo URLROOT; ?>/customer/DonateBooks">Donate Books</a>
                        <a href="<?php echo URLROOT; ?>/customer/BookContents">Contents</a>
                        <a href="<?php echo URLROOT; ?>/customer/BookEvents">Events</a>
                        <a href="<?php echo URLROOT; ?>/customer/BookChallenge">Book Challenges</a>
                        <!-- <a href="#">Event Calender</a> -->
                    </div>
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

    <script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("drop-serv");
    var i;

    for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
        } else {
        dropdownContent.style.display = "block";
        }
    });
    }

    function toggleDropdown(dropdownId) {
        var dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle("show-S");
    }
    </script>
