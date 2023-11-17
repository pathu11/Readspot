<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./assets/css/LoginPageCSS.css">
</head>
<body>
    <div class="container">
        <form class="login" action="./includes/login.inc.php" method="post">
            <h1>Log in</h1>
            <input type="email" name="uid" placeholder="Email">
            <input type="password" name="pwd" placeholder="Password"><br>
            <input type="checkbox"><span>Remember me</span>
            <a href="#">Forgot password?</a>
            <button class="btn" name="submit" type="submit">log in</button>
            <div class="connect">
                <h4><span>Or Connect With</span></h4>
            </div>
            <img src="./assets/img/icons8-google-48.png">
            <div>
                <span class="copyright">&copy;2023</span> 
            </div>  
        </form>
        <div class="register">
            <img src="./assets/img/logo.png">
            <!-- <i class="fas fa-user-plus fa-5x"></i> -->
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introducing a web-based Platform for Buying
                Selling, exchanging, and Donating both new & used books.</p>
            <a href="./RegisterCategory.php"><button>sign up</button></a>
        </div>  
      </div>
</body>
</html>
                     