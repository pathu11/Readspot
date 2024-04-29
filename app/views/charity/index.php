<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/charity-home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>ReadSpot Online Book store</title>
</head>

<body>

    <div id="dashboard">

    </div>
    <header>
        <div>
            <img id="logo" src=<?= URLROOT . "/assets/images/charity/ReadSpot.png" ?> alt="Logo">
        </div>
        <nav>
            <a href="#" class="active">Home</a>
            <a href="./event">Event Management</a>
            <a href="donation">Donation Requests</a>

            <a href="notification">
                <i class="fas fa-bell" id="bell"></i>
                <!-- <span class="notification-text">Notification</span> -->
            </a>
        </nav>
        <div class="dropdown" style="float:right;">
            <button class="dropdown-button">
                <img id="profile" src=<?= URLROOT . "/assets/images/charity/rayhan.jpg" ?> alt="Profile Pic">
            </button>
            <div class="dropdown-content">
                <a href="editprofile"><i class="fas fa-user-edit"></i>Profile</a>

                <a href="<?php echo URLROOT; ?>/landing/IsLoggedOut"><i class="fas fa-sign-out-alt"></i> Logout</a>

            </div>
        </div>
        

    </header>

    <div class="body-container">
        <img id="bcnd" src=<?= URLROOT . "/assets/images/charity/CharityDas.png" ?>>
        <!-- <a href="#" class="postevent" onclick="showMessage()"> POST EVENTS</a> -->
    </div>

    <div class="box1">
        <!-- <a href="<?php echo URLROOT; ?>/charity/test">test</a> -->
        <div class="box2">
            <h4 id="dynamicHeading">Keep in MIND!</h4>
            <p id="dynamicText">You are not just organizing things; also helping create a community where people love to share and read books</p>
            <p id="secondaryText" style="color:#006e69;"><b>being a part of "ReadSpot" journey!</b></p>
        </div>
        <div class="box3" style="background-color: #303030;">
            <h4> a Charity Member !</h4>
            <img id="joinUs" src=<?= URLROOT . "/assets/images/charity/join-with-us-logo.png" ?>>
            <p> Don't forget the impact of actions on others; every effort counts
            </p>
        </div>
        <div class="box4">
            <h4> Hire events Donate Books !</h4>
            <img src=<?= URLROOT . "/assets/images/charity/donate.png" ?>>
            <p> Joined as a supportive individual of Charity Organization
                <br>
            </p>
        </div>
    </div>



    <section class="container">
        <div class="card">
            <div class="card-image donation"></div>
            <h2>BOOK DONATIONS</h2>
            <dl>
                <dt> <b>Types of Books:</b></dt>
                <dd> We accept a wide range of books, including fiction, non-fiction, children's books, and educational
                    materials.</dd>
                <dt><b>Condition:</b></dt>
                <dd> Please ensure that the books are in good condition. We appreciate gently used books that can be
                    enjoyed by others.</dd>
                <dt><b>Drop-off Locations:</b></dt>
                <dd>You can drop off your book donations at our main office during business hours. Check our website for
                    additional drop-off locations and events.</dd>
                <!-- <dt><b>Monetary Donations:</b></dt> -->
                <!-- <dd>In addition to book donations, we also welcome monetary contributions to support our programs and
                    initiatives.</dd> -->
            </dl>
        </div>

        <div class="card">
            <div class="card-image events"></div>
            <h2>EVENTS HOSTING</h2>
            <dl>
                <dt> <b>Event Hosting:</b></dt>
                <dd> We host variety of events, including fundraisers, workshops, and community gatherings.</dd>
                <dt><b>Registration:</b></dt>
                <dd> Some events may require pre-registration. Make sure to register early to
                    secure your spot and receive important event updates.</dd>
                <dt><b>Volunteer Opportunities:</b></dt>
                <dd> Interested in getting involved? We often have volunteer
                    opportunities during our events. Contact us to learn more about how you can contribute.</dd>
                <!-- <dt><b>Event Locations:</b></dt>
                <dd>Events may take place at various locations. Check all.</dd> -->
            </dl>
        </div>

        <div class="card">
            <div class="card-image customer"></div>
            <h2>CUSTOMER SATTISFACTION</h2>
            <dl>
                <dt> <b>Feedback Mechanism:</b></dt>
                <dd>We have established an open feedback mechanism to hear your thoughts,
                    suggestions, and concerns.
                </dd>
                <dt><b>Responsive Support:</b></dt>
                <dd> Our customer support team is here to assist you. If you have any questions,
                    feel free to reach out to our dedicated support staff.</dd>
                <dt><b>Community Engagement:</b></dt>
                <dd> Join our community forums and events to connect with other supporters. We value the sense of
                    community and collaboration among our supporters.</dd>
                <!-- <dt><b>Transparency:</b></dt>
                <dd> We believe in transparency in all our interactions.</dd> -->
            </dl>
        </div>
    </section>

    <br><br><br>

    <div class="gifs">
        <!-- <img src="/images/book-39.gif">
        <img src="/images/book-38.gif">-->
        <img id="loc" src=<?= URLROOT . "/assets/images/charity/locationn.gif" ?>>
        <div class="location">
            <p> <b>Event locations revealed:</b> "Drop your suggested locations, and let's make a positive difference!"</p>
        </div>
        <img src=<?= URLROOT . "/assets/images/charity/book-38.gif" ?>>
        <div class="location">
            <p><b>Quality of Books:</b> "Let's make this event a memorable chapter in our shared love for exceptional books!"</p>
        </div>
        <img src=<?= URLROOT . "/assets/images/charity/customer-support.gif" ?>>
        <div class="location">
            <p><b>customer Satisfaction</b> "Their satisfaction is not just a goal; it's our standard !"</p>
        </div>
    </div>

    <!-- 
    <div class="aboutusandcontactus">
        <div class="aboutus">
            <h3>About Us</h3>
            <p>Welcome to Book Store Charity, where we believe in the transformative power of books.
                Our organization is dedicated to making a positive impact on communities through the love of reading and
                learning.
                Our mission is to provide access to books and educational resources for those in
                need. We believe that everyone,
                regardless of their circumstances, should have the opportunity to discover the joy of reading and the
                knowledge that comes with it.<br><br>
                At Book Store Charity, we operate a book store with a purpose. Every purchase you make supports our
                charitable initiatives, allowing
                us to donate books to schools, libraries, and individuals who may not have easy access to literature.
                Join us in our journey to spread the joy of reading and make a positive difference in the lives of
                others.</p>
            <span id="read-more" class="read-more-btn" onclick="toggleReadMore()">Read More</span>
        </div>

        <div class="contactus-container">
            <form action="https://formsubmit.co/readspot32@email.com" method="POST">
                <h3>Contact Us</h3>
                <input type="text" id="firstName" placeholder="First Name" required>
                <input type="text" id="lastName" placeholder="Last Name" required>
                <input type="text" id="email" placeholder="Email" required>
                <input type="text" id="mobile" placeholder="Mobile" required>
                <h4>Type Your Comment</h4>
                <textarea required></textarea>
                <input type="reset" value="Reset" id="resetbtn">
                <input type="submit" value="Submit" id="submitbtn">

            </form>
        </div> -->
    <!--         
        <div id="contact-bar">
            <div class="contact-info" onclick="toggleDetails('email-details')">
                <span class="contact-icon">✉️</span>
                <span>Email</span>
                <a href="mailto:kokularajh32@gmail.com" class="contact-details" id="email-details"
                    style="color: aqua;">kokularajh32@gmail.com</a>
            </div>
            <div class="contact-info" onclick="openWhatsApp()">
                <span class="contact-icon phone-icon">📞</span>
                <span>Phone</span>
                <div class="contact-details" id="phone-details" style="color: aqua;">+94 (076) 854 5700</div>
            </div>
        </div>

    </div> -->

    <footer>
        <div>
            <p>Privacy Policy : All content included on this site, such as text, graphics, logos, button icons, images,
                audio clips, digital downloads, data compilations,<br>
                and software, is the property of READSPOT or its content suppliers and protected by Sri Lanka and
                international copyright laws...
            </p>
        </div>
        <div>
            <p id="copyright" style=" color: black;">&copy; 2023 ReadSpot. All rights reserved.</p>
        </div>
    </footer>

    <script src=<?= URLROOT . "assets/charity/script.js" ?>></script>
</body>

</html>