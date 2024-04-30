<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Select User Role </title>
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/signupCss.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/LoginPageCSS.css">


</head>

<body>
    <div class="container">
        <div class="login">
            <h1>Sign up as</h1>
            <div class="types">
                <a href="<?php echo URLROOT; ?>/landing/sendEmailCustomer"><button class="ctg">CUSTOMER</button></a>
                <a href="<?php echo URLROOT; ?>/landing/signupPub"><button class="ctg">PUBLISHER</button></a>
                <a href="<?php echo URLROOT; ?>/landing/signupCharity"><button class="ctg">CHARITY ORGANIZATION</button></a>
            </div>

            <div class="button-container">
                <a href="<?php echo URLROOT; ?>/landing/login"><button class="btn-con-log">login</button></a>
            </div>
            <!-- <div>
                <span class="copyright">ReadSpot &copy;2023</span>
            </div> -->
        </div>
        <div class="register">
            <div class="back-btn-div-login">
                <button class="back-btn-login" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
            </div>
            <img src="<?php echo URLROOT; ?>/assets/images/customer/logo.png">
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introducing a web-based Platform for Buying
                Selling, exchanging, and Donating both new & used books.</p>
        </div>
    </div>
</body>

</html>