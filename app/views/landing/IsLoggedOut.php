<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <title>Is Logout</title>
    <!-- <link rel="stylesheet" href="./assets/css/LoginPageCSS.css"> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/logout.css" />
</head>
<body>
    <div class="container">
           <div class="login">
            <h1>Oh no! You're leaving...</h1>
                <h1>Are you sure?</h1>
                <br>
                <br>
                <button onclick="logout()"><a style="text-decoration:none;color:black;" href="<?php echo URLROOT; ?>/landing/logout">Yes,Log Me Out</a></button><br>
                <button onclick="cancel()">No,Just Kidding</button>
           </div> 
           

        <div class="register">
            <img src="<?php echo URLROOT; ?>/assets/images/landing/exit.avif">
           
        </div>  
      </div>
<script>
    
    function logout() {
        window.location.href = "<?php echo URLROOT; ?>/landing/logout";
    }

    function cancel() {
        <?php if ($_SESSION['user_role'] === 'customer'): ?>
            window.location.href = "<?php echo URLROOT; ?>/customer/index";
        <?php elseif ($_SESSION['user_role'] === 'publisher'): ?>
            window.location.href = "<?php echo URLROOT; ?>/publisher/index";
        <?php elseif ($_SESSION['user_role'] === 'admin'): ?>
            window.location.href = "<?php echo URLROOT; ?>/admin/index";
        <?php elseif ($_SESSION['user_role'] === 'moderator'): ?>
            window.location.href = "<?php echo URLROOT; ?>/moderator/index";
        <?php elseif ($_SESSION['user_role'] === 'charity'): ?>
            window.location.href = "<?php echo URLROOT; ?>/charity/index";
        <?php elseif ($_SESSION['user_role'] === 'super_admin'): ?>
            window.location.href = "<?php echo URLROOT; ?>/superadmin/index";
        <?php elseif ($_SESSION['user_role'] === 'delivery'): ?>
            window.location.href = "<?php echo URLROOT; ?>/delivery/index";
        <?php endif; ?>
    }
</script>

</body>
</html>


          
