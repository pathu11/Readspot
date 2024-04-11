<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo URLROOT . "/assets/css/charity/charity-home.css" ?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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
            <a href="./">Home</a>
            <a href="event">Event Management</a>
            <a href="customerSupport" id="donorRequestLink">Customer Support</a>
            <a href="aboutUs" class="active">
                <i class="fas fa-bell" id="bell"></i>
                <span class="notification-text">Notification</span>
            </a>
        </nav>
        <div class="dropdown" style="float:right;">
            <button class="dropdown-button">
                <img id="profile" src=<?= URLROOT . "/assets/images/charity/gokuU.jpg" ?> alt="Profile Pic">
            </button>
            <div class="dropdown-content">
                <a href="#"><i class="fas fa-user-edit"></i>Profile</a>
                <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </header>
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
            <p id="copyright" style=" color: #00ffee;">&copy; 2023 ReadSpot. All rights reserved.</p>
        </div>
    </footer>

    <script src=<?= URLROOT . "assets/charity/script.js" ?>></script>
</body>

</html>