<<<<<<< HEAD
<?php
    $title = "Index";  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/homepage.css" />
    <title>Publisher Home Page</title>

</head>

<body>
   
<?php   require APPROOT . '/views/publisher/nav.php';?>
 
    <div class="content">
        <h1 class="header_1">WELCOME TO</h1><br>
        <h1 class="header_2">ReadSpot</h1>
        <span>Effortlessly sell your books, manage inventory, and connect <br>
            with readers. Sell smart, sell efficiently. Happy publishing!</span>
    </div>

    <div class="btn">
        
        <!-- <button class="my-button"><a href="#" target="_blank">GET STARTING FOR SELLING</a></button> -->
        <button id="btnclick"  onclick="window.location.href = '<?php echo URLROOT; ?>/publisher/addbooks';" class="my-button">GET STARTING FOR SELLING </button>

    </div>
    

    
     <?php 
 
 // echo APPROOT ;
        require APPROOT . '/views/publisher/footer.php';
 
 
 ?>   
</body>

</html>
=======
<?php
    $title = "Index";  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/homepage.css" />
    <title>Publisher Home Page</title>

</head>

<body>
   
<?php   require APPROOT . '/views/publisher/nav.php';?>
 
    <div class="content">
        <h1 class="header_1">WELCOME TO</h1><br>
        <h1 class="header_2">ReadSpot</h1>
        <span>Effortlessly sell your books, manage inventory, and connect <br>
            with readers. Sell smart, sell efficiently. Happy publishing!</span>
    </div>

    <div class="btn">
        
        <!-- <button class="my-button"><a href="#" target="_blank">GET STARTING FOR SELLING</a></button> -->
        <button id="btnclick"  onclick="window.location.href = '<?php echo URLROOT; ?>/publisher/addbooks';" class="my-button">GET STARTING FOR SELLING </button>

    </div>
    

    
     <?php 
 
 // echo APPROOT ;
        require APPROOT . '/views/publisher/footer.php';
 
 
 ?>   
</body>

</html>
>>>>>>> 46ef4d2bb18a2134244a28ff29e0efe622c4dc2b
