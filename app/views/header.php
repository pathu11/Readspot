<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/customer/LandingPage.css">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/customer/head.css">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/customer/footer.css">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/customer/prof.css">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/customer/AddBookConte.css">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/customer/BuyBook.css">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/customer/Sevices.css">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/customer/Aboutus.css">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/customer/BookDetails.css">

    <!-- <script src="./assets/js/prof.js"></script> -->
    <script src="http://localhost/Group-27/public/assets/js/customer/service.js"></script>
    <script src="http://localhost/Group-27/public/assets/js/customer/Add.js"></script>
    <script src="http://localhost/Group-27/public/assets/js/customer/dropcategory.js"></script>
    <script src="http://localhost/Group-27/public/assets/js/customer/home.js"></script>

    <title><?php echo $title; ?></title>
</head>
<body>
    <header>
    <div class="head">
        <img src="http://localhost/Group-27/public/assets/images/customer/logo.png" alt="logo" class="logo">
        <div class="navig">
            <nav class="navigation">
                <?php 
                if (isset($_SESSION["customerName"])){
                    echo '<a href="http://localhost/Group-27/app/views/customer/Home.php">Home</a>';
                } else {
                    echo '<a href="./index.php">Home</a>';
                }
                ?>
                <a href="http://localhost/Group-27/app/views/customer/AboutUs.php">About</a>
                <a href="http://localhost/Group-27/app/views/customer/Services.php">Services</a>
                <a href="http://localhost/Group-27/app/views/customer/ContactUs.php">Contact</a>
            </nav>
            <?php 
                if (isset($_SESSION["customerName"])){
                    include_once 'dropdownmenu.php';
                } else {
                    echo '<a href="http://localhost/Group-27/app/views/login.view.php"><button class="Login">Login</button></a>';
                }
            ?>
        </div>
        </div>
    </header>
    