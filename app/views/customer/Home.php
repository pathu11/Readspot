<?php
    $title = "Home Page";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="hero" style="background-image: url('<?php echo URLROOT; ?>/assets/images/customer/hero1.png');">
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
    
    <div class="services"> <!--path changed-->
        <div class="service" onclick="service1()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/new1.jpg" alt="Service 1"> <!--path changed-->
            <h3>Buy New Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service2()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/used1.jpg" alt="Service 2"> <!--path changed-->
            <h3>Buy Used Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service3()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/exchange1.png" alt="Service 3"> <!--path changed-->
            <h3>Exchange Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service4()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/donate1.jpg" alt="Service 4"> <!--path changed-->
            <h3>Donate Books</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service5()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/content1.jpg" alt="Service 5"> <!--path changed-->
            <h3>Contents</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service6()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/event1.jpg" alt="Service 6"> <!--path changed-->
            <h3>Events</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service7()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/challenge1.jpg" alt="Service 7"> <!--path changed-->
            <h3>Book Challenges</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
        <div class="service" onclick="service8()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/calender1.jpg" alt="Service 8"> <!--path changed-->
            <h3>Event Calender</h3>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
        </div>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>


<script>
    function service1() {
    // Define the URL you want to redirect to
    var url = "<?php echo URLROOT; ?>/customer/BuyNewBooks"; //path changed

    // Use the window.location.href property to navigate to the specified URL
    window.location.href = url;
}

function service2() {
    var url = "<?php echo URLROOT; ?>/customer/BuyUsedBook"; //path changed
    window.location.href = url;
}

function service3() {
    var url = "<?php echo URLROOT; ?>/customer/ExchangeBook"; //path changed
    window.location.href = url;
}

function service4() {
    var url = "<?php echo URLROOT; ?>/customer/DonateBooks"; //path changed
    window.location.href = url;
}

function service5() {
    var url = "<?php echo URLROOT; ?>/customer/BookContents"; //path changed
    window.location.href = url;
}

function service6() {
    var url = "<?php echo URLROOT; ?>/customer/BookEvents"; //path changed
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