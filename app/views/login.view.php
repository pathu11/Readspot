<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="./assets/css/LoginPageCSS.css"> -->
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/signupCss.css" />
</head>
<body>
    <div class="container">
        <form class="login" action="http://localhost/Group-27/app/models/Login.php" method="post">
            <h1>Log in</h1>
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="pass" placeholder="Password"><br>
            <input type="checkbox"><span>Remember me</span>
            <a href="#">Forgot password?</a>
            <button class="btn" name="submit" type="submit">log in</button>
            <div class="connect">
                <h4><span>Or Connect With</span></h4>
            </div>
            <img src="http://localhost/Group-27/public/assets/images/customer/icons8-google-48.png">
            <div>
                <span class="copyright">&copy;2023</span> 
            </div>  
        </form>


        <div class="register">
            <img src="http://localhost/Group-27/public/assets/images/customer/logo.png">
            <!-- <i class="fas fa-user-plus fa-5x"></i> -->
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introducing a web-based Platform for Buying
                Selling, exchanging, and Donating both new & used books.</p>
            <a href="http://localhost/Group-27/app/views/selectuser.view.php"><button>sign up</button></a>
            
        </div>  
      </div>
</body>
</html>
                     