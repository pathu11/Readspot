<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/LoginPageCSS.css">
</head>
<body>
    <div class="container">
        <form class="login" action="./includes/signup.inc.php" method="post">
            <h1>Sign up</h1>
            <input type="text" name="name" placeholder="First & Last Name">
            <input type="email" name="uid" placeholder="Email">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwdrepeat" placeholder="Confirm Password"><br>
            <!-- <input type="checkbox"><span>Remember me</span>
            <a href="#">Forgot password?</a> -->
            <button class="btn" name="submit" type="submit">sign up</button>
            <div>
                <span class="copyright">&copy;2023</span> 
            </div>  
        </form>
        <div class="register">
            <img src="./assets/img/logo.png">
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introducing a web-based Platform for Buying
                Selling, exchanging, and Donating both new & used books.</p>
            <a href="./Login.php"><button>login</button></a>
        </div>  
      </div>
</body>
</html>
                     