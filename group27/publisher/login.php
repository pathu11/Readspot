<!-- <input type="submit" value="Log In" name="submit"> -->
<?php 

include '../config/connect_login.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page 01</title>
    <link rel="stylesheet" href="login.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>
<body>
    <?php
if(isset($message)){
    foreach($message as $message){
        echo '
        <div>
            <span> '.$message.'</span>
        </div>
        ' ;
    }
}
?>
    <header>
        <div class="head">
            <img src="../images/publisher/ReadSpot.png" alt="logo">
            <div class="navig">
                <nav class="navigation">
                    <a href="#">Home</a>
                    <a href="#">About</a>
                    <a href="#">Services</a>
                    <a href="#">Contact</a>
                </nav>
                <div class="search-box">
                    <input type="text" placeholder="&#xF002; SEARCH BOOKS..." style="font-family: Arial, FontAwesome"/>
                    <span class="icon"><ion-icon name="search"></ion-icon></span>
                </div>
                <div class="Login">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <button class="btnLogin-popup">Login</button>
                </div>
            </div>
        </div>
    </header>

    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>

        <div class="form-box login">
            <h2>Login</h2>
            <form action="" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail" ></ion-icon></span>
                    <input type="email" name ="email" placeholder="enter your email address" maxlength="50" required oninput="this.vakue=this.value.replace(/\s/g, '')" required>
                    <label>Email Address</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" placeholder="enter your password" required name="pass" maxlength="20" required oninput="this.vakue=this.value.replace(/\s/g, '')">
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <input type="submit" value="Log In"  class="btn" name="submit">
                <!-- <button type="submit" class="btn">Login</button> -->
                <div class="login-register">
                    <p><a href="#" class="register-link"> Create Account</a></p>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <h2>publisher Registration</h2>
            <form action="" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="full_name"required>
                    <label>Full Name</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="company_name">
                    <label>Company Name</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="reg_no" required>
                    <label>Registration Number</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="number" name="contact_no" required>
                    <label>Contact Number</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" id="email" name="email" required>
                    <label>Email Address</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" id="password" name="pass"required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" required>I agree to the term & condition</label>
                </div>
                <input type="submit" value="Sign Up"  class="btn" name="signup">

                <!-- <button type="submit" class="btn">Register</button> -->
                <div class="login-register">
                    <p>Already have an account?<a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    

    <script >
        const wrapper = document.querySelector('.wrapper');
        const loginLink = document.querySelector('.login-link');
        const registerLink = document.querySelector('.register-link');
        const btnPopup = document.querySelector('.Login');
        const iconClose = document.querySelector('.icon-close');


        registerLink.addEventListener('click', ()=> {
            wrapper.classList.add('active');
        });

        loginLink.addEventListener('click', ()=> {
            wrapper.classList.remove('active');
        });

        btnPopup.addEventListener('click', ()=> {
            wrapper.classList.add('active-popup');
        });

        iconClose.addEventListener('click', ()=> {
            wrapper.classList.remove('active-popup');
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>