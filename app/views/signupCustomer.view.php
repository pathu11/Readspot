<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/customer/LoginPageCSS.css">
</head>
<body>
    <div class="container">
        <form class="login" action="http://localhost/Group-27/app/models/UserCus.php" method="post">
            <h1>Sign up</h1>
            <input type="text" name="name" placeholder="First & Last Name">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="pass" placeholder="Password">
            <input type="password" name="passrepeat" placeholder="Confirm Password"><br>
            
            <button class="btn" name="submit" type="submit">sign up</button>
            <div>
                <span class="copyright">&copy;2023</span> 
            </div>  
        </form>
        <div class="register">
            <img src="http://localhost/Group-27/public/assets/images/customer/logo.png">
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introducing a web-based Platform for Buying
                Selling, exchanging, and Donating both new & used books.</p>
            <a href="http://localhost/Group-27/app/views/login.view.php"><button>login</button></a>
        </div>  
      </div>
</body>
</html>
                     