<?php
    $title = "Landing Page";
    
    require APPROOT . '/views/landing/header.php';

?>


    <div class="hero" style="background-image: url('<?php echo URLROOT; ?>/assets/images/customer/hero.jpg');">
        <div class="content">
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introducing a web-based Platform for Buying<br>
                Selling , exchanging, and Donating both new & used books.</p>
        </div>
        <a href="<?php echo URLROOT; ?>/landing/selectuser"><button class="sing-up_btn" href="">Sign-up</button></a>
        <a href="<?php echo URLROOT; ?>/landing/login"><button class="login_btn">Login</button></a>
    </div>
    
    <div class="our_ser">
        <h2><span>Our Services</span></h2>
    </div>
    
    <div class="services" style="background-image: url('<?php echo URLROOT; ?>/assets/images/customer/bg.jpg')">
        <div class="service" onclick="service1()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/new.jpeg" alt="Service 1">
            <h3>Buy New Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service2()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/used.jpeg" alt="Service 2">
            <h3>Buy Used Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service3()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/exchange.jpeg" alt="Service 3">
            <h3>Exchange Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service4()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/donate.jpeg" alt="Service 4">
            <h3>Donate Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service5()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/content.jpg" alt="Service 5">
            <h3>Contents</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service6()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/event.jpeg" alt="Service 6">
            <h3>Events</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service7()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/bookchallenge.jpg" alt="Service 7">
            <h3>Book Challenges</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service8()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/calender.jpg" alt="Service 8">
            <h3>Event Calender</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
    </div>


    <script>
                function service1() {
            // Define the URL you want to redirect to
            var url = "<?php echo URLROOT; ?>/customer/BuyNewBooks.php"; // Replace with your desired URL

            // Use the window.location.href property to navigate to the specified URL
            window.location.href = url;
        }

        function service2() {
            var url = "<?php echo URLROOT; ?>/customer/BuyUsedBook.php";
            window.location.href = url;
        }

        function service3() {
            var url = "http://localhost/Group-27/app/views/customer/Exchange-Book.php";
            window.location.href = url;
        }

        function service4() {
            var url = "http://localhost/Group-27/app/views/customer/DonateBooks.php";
            window.location.href = url;
        }

        function service5() {
            var url = "http://localhost/Group-27/app/views/customer/BookContents.php";
            window.location.href = url;
        }

        function service6() {
            var url = "http://localhost/Group-27/app/views/customer/BookEvents.php";
            window.location.href = url;
        }

        function service7() {
            var url = "#";
            window.location.href = url;
        }

        function service8() {
            var url = "#";
            window.location.href = url;
        }


    </script>
<?php
    require APPROOT . '/views/landing/footer.php';
?>