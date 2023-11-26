<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/LandingPage.css"> <!--path changed-->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/head.css"> <!--path changed-->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/footer.css"> <!--path changed-->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/prof.css"> <!--path changed-->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/AddBookConte.css"> <!--path changed-->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/BuyBook.css"> <!--path changed-->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/Sevices.css"> <!--path changed-->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/Aboutus.css"> <!--path changed-->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/BookDetails.css"> <!--path changed-->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/Event&Donate.css"> <!--path changed-->
    <!-- <script src="./assets/js/prof.js"></script> -->
    <script src="<?php echo URLROOT; ?>/assets/js/customer/service.js"></script> <!--path changed-->
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
                <?php 
                if (isset($_SESSION["user_id"])){
                    echo '<a href="#">Home</a>'; //path changed
                } else {
                    echo '<a href="http://localhost/Group-27/app/views/index.php">Home</a>';
                }
                ?>
                <a href="<?php echo URLROOT; ?>/customer/AboutUs">About</a> <!--path changed-->
                <a href="<?php echo URLROOT; ?>/customer/Services">Services</a> <!--path changed-->
                <a href="<?php echo URLROOT; ?>/customer/ContactUs">Contact</a> <!--path changed-->
            </nav>
            <?php 
                if (isset($_SESSION["user_id"])){
                    include_once 'dropdownmenu.php';
                } else {
                    echo '<a href="http://localhost/Group-27/app/views/login.view.php"><button class="Login">Login</button></a>';
                }
            ?>
        </div>
        </div>
    </header>
    