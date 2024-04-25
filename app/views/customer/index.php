<?php
    $title = "Home Page";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <div class="hero-div-M" style="background-image: url('<?php echo URLROOT; ?>/assets/images/customer/hero1.png');">
       
        <div class="content-div-M">
       
            <h3>WELCOME TO</h3>
            <h2>ReadSpot</h2><br>
            <p>Here we introducing a web-based Platform for Buying<br>
                Selling , Exchanging, and Donating both new & used books.</p>
        </div>
        
    </div>
    
    <div class="our_ser-div-M">
        <h3><span>Our Services</span></h3>
    </div>
    <div class="services-div-M"> 
        <div class="service-div-M" onclick="service1()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/new1.jpg" alt="Service 1" class="Sev1"> 
            <h3>Buy New Books</h3>
            <p style="font-size:13px;">Purchase brand-new, high-quality books from a wide selection of genres and authors, ensuring you stay up-to-date with the latest literary releases.</p>
        </div>
        <div class="service-div-M" onclick="service2()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/used1.jpg" alt="Service 2" class="Sev1"> <!--path changed-->
            <h3>Buy Used Books</h3>
            <p style="font-size:13px;">Explore a diverse collection of pre-owned books at budget-friendly prices, offering an affordable way to enjoy your favorite reads or discover new ones.</p>
        </div>
        <div class="service-div-M" onclick="service3()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/exchange1.png" alt="Service 3" class="Sev1"> <!--path changed-->
            <h3>Exchange Books</h3>
            <p style="font-size:13px;">Connect with fellow book enthusiasts to exchange books, fostering a community where individuals can share their favorite titles and explore new literary adventures.</p>
        </div>
        <div class="service-div-M" onclick="service4()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/donate1.jpg" alt="Service 4" class="Sev1"> <!--path changed-->
            <h3>Donate Books</h3>
            <p style="font-size:13px;">Contribute to a noble cause by donating your gently used books. Our platform facilitates book donations to charity organizations, spreading the joy of reading to those in need.</p>
        </div>
        <div class="service-div-M" onclick="service5()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/content1.jpg" alt="Service 5" class="Sev1"> <!--path changed-->
            <h3>Contents</h3>
            <p style="font-size:13px;">Showcase your writing skills by contributing book reviews, literary analyses, or creative pieces to the platform. Encourage users to share their perspectives and insights, creating a dynamic space for thoughtful discussions around literature.</p>
        </div>
        <div class="service-div-M" onclick="service6()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/event1.jpg" alt="Service 6" class="Sev1"> <!--path changed-->
            <h3>Events</h3>
            <p style="font-size:13px;">Stay informed about literary events, book launches, and author meet-ups happening in your area. Engage with fellow book lovers and participate in enriching literary experiences.</p>
        </div>
        <div class="service-div-M" onclick="service7()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/challenge1.jpg" alt="Service 7" class="Sev1"> <!--path changed-->
            <h3>Book Challenges</h3>
            <p style="font-size:13px;">Participate in book challenges and reading campaigns that cater to various genres, themes, or specific authors. Challenge yourself and fellow readers to explore diverse literary landscapes, fostering a sense of achievement and community.</p>
        </div>
        <!-- <div class="service-div-M" onclick="service8()">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/calender1.jpg" alt="Service 8" class="Sev1">
            <h3>Event Calender</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div> -->
    </div>
    
    <?php
        require APPROOT . '/views/customer/footer.php';
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
    var url = "<?php echo URLROOT; ?>/customer/BookChallenge";
    window.location.href = url;
}

// function service8() {
//     var url = "#";
//     window.location.href = url;
// }

</script>