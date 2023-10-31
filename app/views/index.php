<?php
    $title = "Landing Page";
    include_once './header.php';
?>

    <div class="hero" style="background-image: url('http://localhost/Group-27/public/assets/images/customer/hero.jpg');">
        <div class="content">
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introducing a web-based Platform for Buying<br>
                Selling , exchanging, and Donating both new & used books.</p>
        </div>
        <a href="http://localhost/Group-27/app/views/customer/RegisterCategory.php"><button class="sing-up_btn" href="">Sign-up</button></a>
        <a href="login.view.php"><button class="login_btn">Login</button></a>
    </div>

    <div class="our_ser">
        <h2><span>Our Services</span></h2>
    </div>
    
    <div class="services" style="background-image: url('http://localhost/Group-27/public/assets/css/customer/bg.jpg')">
        <div class="service" onclick="service1()">
            <img src="http://localhost/Group-27/public/assets/images/customer/bg.jpg" alt="Service 1">
            <h3>Buy New Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service2()">
            <img src="http://localhost/Group-27/public/assets/images/customer/bg.jpg" alt="Service 2">
            <h3>Buy Used Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service3()">
            <img src="http://localhost/Group-27/public/assets/images/customer/bg.jpg" alt="Service 3">
            <h3>Exchange Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service4()">
            <img src="http://localhost/Group-27/public/assets/images/customer/bg.jpg" alt="Service 4">
            <h3>Donate Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service5()">
            <img src="http://localhost/Group-27/public/assets/images/customer/bg.jpg" alt="Service 5">
            <h3>Contents</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service6()">
            <img src="http://localhost/Group-27/public/assets/images/customer/bg.jpg" alt="Service 6">
            <h3>Events</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service7()">
            <img src="http://localhost/Group-27/public/assets/images/customer/bg.jpg" alt="Service 7">
            <h3>Book Challenges</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service8()">
            <img src="http://localhost/Group-27/public/assets/images/customer/bg.jpg" alt="Service 8">
            <h3>Service 8</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
    </div>

<?php
    include_once 'footer.php';
?>
