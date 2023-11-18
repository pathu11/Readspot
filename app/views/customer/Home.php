<?php
    $title = "Home Page";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="hero" style="background-image: url('<?php echo URLROOT; ?>/assets/images/customer/hero.jpg');">
        <div class="content">
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introducing a web-based Platform for Buying<br>
                Selling , exchanging, and Donating both new & used books.</p>
        </div>
    </div>

    <div class="our_ser">
        <h2><span>Our Services</span></h2>
    </div>
    
    <div class="services" style="background-image: url('<?php echo URLROOT; ?>/assets/css/customer/bg.jpg')"> <!--path changed-->
        <div class="service" onclick="service1()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/new.jpeg" alt="Service 1"> <!--path changed-->
            <h3>Buy New Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service2()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/used.jpeg" alt="Service 2"> <!--path changed-->
            <h3>Buy Used Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service3()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/exchange.jpeg" alt="Service 3"> <!--path changed-->
            <h3>Exchange Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service4()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/donate.jpeg" alt="Service 4"> <!--path changed-->
            <h3>Donate Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service5()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/content.jpg" alt="Service 5"> <!--path changed-->
            <h3>Contents</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service6()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/event.jpeg" alt="Service 6"> <!--path changed-->
            <h3>Events</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service7()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/bookchallenge.jpg" alt="Service 7"> <!--path changed-->
            <h3>Book Challenges</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service8()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/calender.jpg" alt="Service 8"> <!--path changed-->
            <h3>Event Calender</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
