<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo URLROOT."/assets/css/charity/charity-home.css"?>>
    <title>ReadSpot Online Book store</title>
</head>

<body>
    <header>
        <div>
            <img id="logo" src=<?php echo URLROOT."/assets/images/charity/ReadSpot.png"?> alt="Logo">
        </div>
        <nav>
            <a href="charity-home.html">Home</a>
            <a href="event-management.html" class="active">Event Management</a>
            <a href="#" id="donorRequestLink">Donor Request</a>
            <a href="#">Customer Support</a>
        </nav>

    </header>

    <div class="body-container">
        <img id="bcnd" src=<?php echo URLROOT."/assets/images/charity/Event_man.jpg"?>>
        <p id="eventnote">Here You can Post Charity events!</p>
    </div>

    <div class="box1">
        <div class="box2">
            <h4> How You Can Help Us !</h4>
            <p> Your support is instrumental in making a positive impact on the lives of individuals
                through the joy of reading. Together, we can build a more literate and informed community.
                <br>
            <p style="color:#006e69;"><b>Thank you for being a part of our journey!</b></p>
        </div>
        <div class="box3" style="background-color: #006e69;">
            <h4> WOW ! You are a Charity Member now,</h4>
            <img id="joinUs" src=<?php echo URLROOT."/assets/images/charity/join-with-us-logo.png"?>>
            <p> Now share your commitment to kindness.
            </p>
        </div>
        <div class="box4">
            <h4> Hire events Donate Books !</h4>
            <img src=<?php echo URLROOT."/assets/images/charity/donate.png"?>>
            <p> You are a supportive individual of Charity Organization
                <br>
            </p>
        </div>
    </div>


    <h2>Event Information</h2>

    <table>
        <thead>
            <tr>
                <th>Event ID</th>
                <th>Event Name</th>
                <th>Goal</th>
                <th>Address</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Event 1</td>
                <td>Goal 1</td>
                <td>Address 1</td>
                <td>Time 1</td>
                <td class="action-buttons">
                    <button class="update-button">Update</button>
                    <button class="delete-button">Delete</button>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Event 1</td>
                <td>Goal 1</td>
                <td>Address 1</td>
                <td>Time 1</td>
                <td class="action-buttons">
                    <button class="update-button">Update</button>
                    <button class="delete-button">Delete</button>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Event 1</td>
                <td>Goal 1</td>
                <td>Address 1</td>
                <td>Time 1</td>
                <td class="action-buttons">
                    <button class="update-button">Update</button>
                    <button class="delete-button">Delete</button>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Event 1</td>
                <td>Goal 1</td>
                <td>Address 1</td>
                <td>Time 1</td>
                <td class="action-buttons">
                    <button class="update-button">Update</button>
                    <button class="delete-button">Delete</button>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Event 1</td>
                <td>Goal 1</td>
                <td>Address 1</td>
                <td>Time 1</td>
                <td class="action-buttons">
                    <button class="update-button">Update</button>
                    <button class="delete-button">Delete</button>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Event 1</td>
                <td>Goal 1</td>
                <td>Address 1</td>
                <td>Time 1</td>
                <td class="action-buttons">
                    <button class="update-button">Update</button>
                    <button class="delete-button">Delete</button>
                </td>
            </tr>
            <!-- Add similar rows for other events -->
        </tbody>
    </table>
    <div class="gifs">
        <!-- <img src="/images/book-39.gif">
        <img src="/images/book-38.gif">-->
        <img id="loc" src=<?php echo URLROOT."/assets/images/charity/location.gif"?>>
        <div class="location">
            <p> <b>Event locations revealed:</b> "Drop your suggested locations, and let's make a positive difference!"
            </p>
        </div>
        <img src=<?php echo URLROOT."/assets/images/charity/book-38.gif"?>>
        <div class="location">
            <p><b>Quality of Books:</b> "Let's make this event a memorable chapter in our shared love for exceptional
                books!"</p>
        </div>
        <img src=<?php echo URLROOT."/assets/images/charity/customer-support.gif"?>>
        <div class="location">
            <p><b>customer Satisfaction</b> "Their satisfaction is not just a goal; it's our standard !"</p>
        </div>
    </div>


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

    </div>

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

    <script src=<?php echo URLROOT."/assets/js/charity/script.js"?>></script>
</body>

</html>