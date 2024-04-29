<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>ReadSpot landing page</title>
</head>
<body>

    <div id="dashboard">

    </div>
    <header>
        <div>
            <img id="logo" src="<?php echo URLROOT; ?>/assets/images/landing/homepage/ReadSpot02.png" alt="ReadSpot Logo">
        </div>
        <nav>
            <a href="#" class="active">Home</a>
            <a href="#categories">customer</a>
            <a href="#events">charity events</a>
            <a href="#publishing">Publishing</a>
            <a href="#delivery">Delivery</a>
            <a href="<?php echo URLROOT; ?>/landing/login"><button class="landing_login_btn">Login</button></a>
            <a href="<?php echo URLROOT; ?>/landing/selectuser"><button class="landing_signup_btn">SignUp</button></a>

        </nav>
    </header>

    <div class="body-container">
        <img id="bcnd" src="<?php echo URLROOT; ?>/assets/images/landing/homepage/Readspot _landingpageBC.png">
    </div>

    <section class="welcombox">
        <h1>Welcome to ReadSpot - Your Online Bookstore</h1>
        <p>Here we introducing a web-based Platform "ReadSpot Bookstore" : <br>Dedicated to Providing a Wide Range of
            Books for Every Reader, Hosting Engaging Literary Events, and Guiding Writers Through the Publishing Journey
        </p>
    </section>

    <!-- Book Categories -->
    <section id="categories" class="categories">
        <h2>We Have a Wide Range of Book Categories</h2>
        <div class="category">
            <img src="<?php echo URLROOT; ?>/assets/images/landing/homepage/1_RLEoqJa5Lnb1xkpdOdQfNQ.png" alt="books" class="book-cover">
            <img src="<?php echo URLROOT; ?>/assets/images/landing/homepage/3dbook.png" alt="books" class="book-cover book-cover-3d">
            <div class="dropdown-container">
                <button class="dropdown-btn" onclick="toggleDropdown()">
                    <i class="material-icons" style="vertical-align: middle;">book</i> Customer Services
                </button>
                <div class="dropdown-content" id="dropdownContent">
                    <a href="<?php echo URLROOT; ?>/customer/BuyNewBooks">Buy New Books</a>
                    <a href="<?php echo URLROOT; ?>/customer/BuyUsedBooks">Buy Used Books</a>
                    <a href="<?php echo URLROOT; ?>/customer/ExchangeBook">Exchange Books</a>
                    <a href="<?php echo URLROOT; ?>/customer/DonateBooks">Donate Books</a>
                    <a href="<?php echo URLROOT; ?>/customer/BookContents">Content</a>
                    <a href="<?php echo URLROOT; ?>/customer/BookEvents">Events</a>
                    <a href="<?php echo URLROOT; ?>/customer/BookChallenge">Book Challenges</a>
                </div>
            </div>
            <div class="message-container">
                <div class="message"><a style="text-decoration:none;color:white;" href="<?php echo URLROOT; ?>/landing/sendEmailCustomer">Signup as a customer and Buy Books!</a></div>
            </div>
        </div>
    </section>


    <div class="scroll-advertisement">
        <p></p>
    </div>

    <!-- Book Publishing Services -->

    <section id="publishing" class="publishing">
        <h2>Book Publishing Services</h2>
        <div class="event">
            <div class="event-details">
                <p>Explore tailored publishing packages with services like editing, design, printing, and distribution
                    to bring your
                    book to life. Our packages offer end-to-end solutions for every stage of your publishing journey.
                </p>

                <a href="<?php echo URLROOT; ?>/landing/signupPub" class="char-button">Signup as Publisher</a>
            </div>
            <video id="videoPlayer" width="60%" height="auto" controls
                style="border-radius: 15px; border: 3px solid rgb(88, 88, 88);">

                <source src="<?php echo URLROOT; ?>/assets/images/landing/homepage/book-publishing.mp4" type="video/mp4">
            </video>
        </div>
    </section>
    <br><br>
    <hr style="border: 1px solid rgb(148, 148, 148);">

    <!-- Delivery Information -->
    <section id="delivery" class="delivery">
        <h2>Delivery Information</h2>


   

        <div class="info-box">
            <i class="material-icons icon">local_shipping</i>
            <h3>Fast Delivery</h3>
            <p>We offer fast and reliable delivery options.</p>
        </div>

        <div class="info-box">
            <i class="material-icons icon">payment</i>
            <h3>Secure Payments</h3>
            <p>Safe and secure payment options for your convenience.</p>
        </div>

        <div class="info-box">
            <i class="material-icons icon">verified_user</i>
            <h3>Quality Assured</h3>
            <p>Guaranteed quality checks for every book delivered.</p>
        </div>

        <!-- Animated Graph for Delivery Status -->
        <div class="delivery-status">
            <h3>Delivery Status</h3>
            <div class="graph-container">
                <div class="status-bar">
                    <div class="bar delivered">
                        <i class="material-icons">done</i> Delivered
                        <div class="progress-circle delivered-circle">
                            <span class="count"><?php echo $data['percentageDel']; ?>%</span>

                        </div>
                    </div>
                    <div class="bar pending">
                        <i class="material-icons">schedule</i> Shipping
                        <div class="progress-circle pending-circle">
                            <span class="count"><?php echo $data['percentageShip']; ?>%</span>
                        </div>
                    </div>
                    <div class="bar not-yet">
                        <i class="material-icons">warning</i>Proccessing
                        <div class="progress-circle not-yet-circle">
                            <span class="count"><?php echo  $data['percentagePro']; ?>%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Reviews -->
        <div class="customer-reviews">
        <?php foreach($data['latestDeliveryReviews'] as $reviews): ?>
            <div class="review-card">
                <div class="reviewer-info">
                    <?php if(isset($reviews->profile_img)): ?>
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/ProfileImages/<?php echo $reviews->profile_img; ?>"alt="Customer 1">
                    <?php else: ?>
                        <img src="<?php echo URLROOT; ?>/assets/images/publisher/person.jpg"alt="Customer 1">
                    <?php endif; ?>
                    <div>
                        <h4><?php echo $reviews->name; ?></h4>
                        <span>
                            <?php 
                            if($reviews->rating==1){
                                echo '★';
                            }else if($reviews->rating==2){
                                echo '★★';
                            }else if($reviews->rating==3){
                                echo '★★★';
                            }else if($reviews->rating==4){
                                echo '★★★★';
                            }else if($reviews->rating==5){
                                echo '★★★★★';
                            }else{
                                echo '';
                            }
                            ?>
                           </span>
                    </div>
                </div>
                <p><?php echo $reviews->review; ?></p>
            </div>
        <?php endforeach; ?>
            <!-- <div class="review-card">
                <div class="reviewer-info">
                    <img src="<?php echo URLROOT; ?>/assets/images/landing/homepage/thalapathi-vijay-photos-thalapathy-wallpaper-hd.jpg"
                        alt="Customer 2">
                    <div>
                        <h4>Thalapathy</h4>
                        <span>★★★☆☆</span>
                    </div>
                </div>
                <p>"Delivery was a bit slow but the product quality is good."</p>
            </div> -->

            <!-- <div class="review-card">
                <div class="reviewer-info">
                    <img src="<?php echo URLROOT; ?>/assets/images/landing/homepage/thalapathi-vijay-photos-thalapathy-wallpaper-hd.jpg"
                        alt="Customer 3">
                    <div>
                        <h4>Thalapathy</h4>
                        <span>★★★★★</span>
                    </div>
                </div>
                <p>"Love the secure payment options and quality of books."</p>
            </div> -->
        </div>
    </section>

    <!-- <a href="#" class="del-button">Login as Delivery person</a> -->
    <br><br>
    <hr style="border: 1px solid rgb(117, 117, 117);">


    <!-- Events Section -->
    <section id="events" class="events">
        <h2>Upcoming Events</h2>
        <div class="event">
            <div class="event-details">
                <p>
                    Becoming a charity member opens up a unique opportunity to directly engage with our community and
                    provide valuable services. As a charity member, you'll receive customer requests that align with our
                    mission and goals.
                </p>
                <a href="<?php echo URLROOT; ?>/landing/signupCharity" class="char-button">Signup as Charity member</a>
            </div>
            <img src="<?php echo URLROOT; ?>/assets/images/landing/homepage/event01.jpg" alt="Event 1">
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div>
            <p>Privacy Policy : All content included on this site, such as text, graphics, logos, button icons, images,
                audio clips, digital downloads, data compilations, and software, is the property of READSPOT or its
                content suppliers and protected by Sri Lanka and international copyright laws...</p>
        </div>
        <div>
            <p id="copyright" style=" color: #141414;">&copy; 2023 ReadSpot. All rights reserved.</p>
        </div>
    </footer>

</body>
<script>
    var video = document.getElementById("videoPlayer");

    function isElementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function playVideo() {
        console.log("Checking video visibility");

        if (isElementInViewport(video)) {
            console.log("Video is in viewport, playing...");
            video.play();
            video.loop = true;
        } else {
            console.log("Video is not in viewport, pausing...");
            video.pause();
        }
    }

    window.addEventListener("scroll", playVideo);
    window.addEventListener("load", playVideo);

    function toggleDropdown() {
        console.log("Toggling dropdown");

        var dropdownContent = document.getElementById("dropdownContent");
        if (dropdownContent.style.display === "block" || dropdownContent.style.display === "") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    }

    // Close the dropdown when clicking outside of it
    window.onclick = function (event) {
        if (!event.target.matches('.dropdown-btn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === "block") {
                    openDropdown.style.display = "none";
                }
            }
        }
    }
    
    // Advertisement messages
    var advertisements = [
        "🚀 Special Offer: Get 10% off on all books this month! 📚",
        "💡 Exclusive Access: Gain access to exclusive events for our charity members.",
        "📖 New Arrivals: Check out our latest book collection!",
        "🎉 Join our loyalty program and earn rewards with every purchase!",
        "🎁 Special Discounts: for your charitable initiatives.",
        "💡 Book recommendations just for you! Explore now."
    ];

    var index = 0;

    function showAdvertisement() {
        var scrollAdvertisement = document.querySelector('.scroll-advertisement p');
        scrollAdvertisement.textContent = advertisements[index];

        var adContainer = document.querySelector('.scroll-advertisement');
        adContainer.style.display = 'block';
        index = (index + 1) % advertisements.length;
        setTimeout(function () {
            adContainer.style.animation = 'slideUp 1s forwards';
            setTimeout(function () {
                adContainer.style.display = 'none';
                adContainer.style.animation = '';
            }, 1000);

            setTimeout(showAdvertisement, 1000);
        }, 5000);
    }

    window.addEventListener('DOMContentLoaded', function () {
        setTimeout(showAdvertisement, 2000);
    });

</script>

</html>