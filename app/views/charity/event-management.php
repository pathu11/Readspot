<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/charity-home.css" ?>>
    <link rel="stylesheet" href=<?php echo URLROOT . "/assets/css/charity/eveTable1.css" ?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>ReadSpot Online Book store</title>
    <script src=<?php echo URLROOT . "/assets/js/charity/script.js" ?>></script>
    <script src=<?php echo URLROOT . "/assets/js/charity/eventscript.js" ?>></script>
</head>

<body>
    <header>
        <div>
            <img id="logo" src=<?php echo URLROOT . "/assets/images/charity/ReadSpot.png" ?> alt="Logo">
        </div>
        <nav>
            <a href="./">Home</a>
            <a href="event" class="active">Event Management</a>
            <a href="customerSupport" id="donorRequestLink">Customer Support</a>
            <a href="aboutUs">
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

    <div class="body-container">
        <img id="bcnd" src=<?php echo URLROOT . "/assets/images/charity/Event_man.jpg" ?>>
        <p id="eventnote">Here You can Post Charity events!</p>
    </div>

    <div class="box1">
        <a href="<?php echo URLROOT; ?>/charity/test">test</a>
        <div class="box2">
            <h4> Keep in MIND!</h4>
            <p> I am not just organizing things; also helping create a community where people love to share and read books<br>
            <p style="color:#006e69;"><b>being a part of "ReadSpot" journey!</b></p>
        </div>
        <div class="box3" style="background-color: #303030;">
            <h4> a Charity Member !</h4>
            <img id="joinUs" src=<?= URLROOT . "/assets/images/charity/join-with-us-logo.png" ?>>
            <p> Don't forget the impact of my actions on others; every effort counts
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

    <div class="container">
        <h2>EVENTS INFO ></h2>

        <!-- <table id="eventTable">
            <input type="text" id="searchInput" placeholder="Search by ID or Name" oninput="searchEvents()">
            <thead>
                <tr>
                    <th>Event ID</th>
                    <th>Event Name</th>
                    <th>Goal</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Books for Bright Futures</td>
                    <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                    <td>Charity Book Depot,
                        45 Harmony Street,
                        Colombo 01000.
                        Sri Lanka.</td>
                    <td>20.01.2024</td>
                    <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="update-button" onclick="updateEvent(1)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Books for Bright Futures</td>
                    <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                    <td>Charity Book Depot,
                        45 Harmony Street,
                        Colombo 01000.
                        Sri Lanka.</td>
                    <td>20.01.2024</td>
                    <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(2)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="update-button" onclick="updateEvent(2)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(2)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Books for Bright Futures</td>
                    <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                    <td>Charity Book Depot,
                        45 Harmony Street,
                        Colombo 01000.
                        Sri Lanka.</td>
                    <td>20.01.2024</td>
                    <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(3)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="update-button" onclick="updateEvent(3)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(3)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Books for Bright Futures</td>
                    <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                    <td>Charity Book Depot,
                        45 Harmony Street,
                        Colombo 01000.
                        Sri Lanka.</td>
                    <td>20.01.2024</td>
                    <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(4)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="update-button" onclick="updateEvent(4)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(4)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Books for Bright Futures</td>
                    <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                    <td>Charity Book Depot,
                        45 Harmony Street,
                        Colombo 01000.
                        Sri Lanka.</td>
                    <td>20.01.2024</td>
                    <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(5)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="update-button" onclick="updateEvent(5)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(5)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Books for Bright Futures</td>
                    <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                    <td>Charity Book Depot,
                        45 Harmony Street,
                        Colombo 01000.
                        Sri Lanka.</td>
                    <td>20.01.2024</td>
                    <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(6)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="update-button" onclick="updateEvent(6)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(6)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Books for Bright Futures</td>
                    <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                    <td>Charity Book Depot,
                        45 Harmony Street,
                        Colombo 01000.
                        Sri Lanka.</td>
                    <td>20.01.2024</td>
                    <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(7)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="update-button" onclick="updateEvent(7)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(7)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Books for Bright Futures</td>
                    <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                    <td>Charity Book Depot,
                        45 Harmony Street,
                        Colombo 01000.
                        Sri Lanka.</td>
                    <td>20.01.2024</td>
                    <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(8)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="update-button" onclick="updateEvent(8)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(8)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Books for Bright Futures</td>
                    <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                    <td>Charity Book Depot,
                        45 Harmony Street,
                        Colombo 01000.
                        Sri Lanka.</td>
                    <td>20.01.2024</td>
                    <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(9)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="update-button" onclick="updateEvent(9)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(9)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Books for Bright Futures</td>
                    <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                    <td>Charity Book Depot,
                        45 Harmony Street,
                        Colombo 01000.
                        Sri Lanka.</td>
                    <td>20.01.2024</td>
                    <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(10)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="update-button" onclick="updateEvent(10)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(10)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Books for Bright Futures</td>
                    <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                    <td>Charity Book Depot,
                        45 Harmony Street,
                        Colombo 01000.
                        Sri Lanka.</td>
                    <td>20.01.2024</td>
                    <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(11)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="update-button" onclick="updateEvent(11)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(11)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Books for Bright Futures</td>
                    <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                    <td>Charity Book Depot,
                        45 Harmony Street,
                        Colombo 01000.
                        Sri Lanka.</td>
                    <td>20.01.2024</td>
                    <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(12)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="update-button" onclick="updateEvent(12)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(12)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>

            </tbody>
        </table> -->

        <div class="container">
            <h2>EVENTS INFO ></h2>

            <table id="eventTable">
                <input type="text" id="searchInput" placeholder="Search by ID or Name" oninput="searchEvents()">
                <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Event Name</th>
                        <th>Goal</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Books for Bright Futures</td>
                        <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                        <td>Charity Book Depot,
                            45 Harmony Street,
                            Colombo 01000.
                            Sri Lanka.</td>
                        <td>20.01.2024</td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent(1)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="update-button" onclick="updateEvent(1)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-button" onclick="deleteEvent(1)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Books for Bright Futures</td>
                        <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                        <td>Charity Book Depot,
                            45 Harmony Street,
                            Colombo 01000.
                            Sri Lanka.</td>
                        <td>20.01.2024</td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent(2)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="update-button" onclick="updateEvent(2)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-button" onclick="deleteEvent(2)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Books for Bright Futures</td>
                        <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                        <td>Charity Book Depot,
                            45 Harmony Street,
                            Colombo 01000.
                            Sri Lanka.</td>
                        <td>20.01.2024</td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent(3)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="update-button" onclick="updateEvent(3)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-button" onclick="deleteEvent(3)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Books for Bright Futures</td>
                        <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                        <td>Charity Book Depot,
                            45 Harmony Street,
                            Colombo 01000.
                            Sri Lanka.</td>
                        <td>20.01.2024</td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent(4)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="update-button" onclick="updateEvent(4)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-button" onclick="deleteEvent(4)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Books for Bright Futures</td>
                        <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                        <td>Charity Book Depot,
                            45 Harmony Street,
                            Colombo 01000.
                            Sri Lanka.</td>
                        <td>20.01.2024</td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent(5)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="update-button" onclick="updateEvent(5)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-button" onclick="deleteEvent(5)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Books for Bright Futures</td>
                        <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                        <td>Charity Book Depot,
                            45 Harmony Street,
                            Colombo 01000.
                            Sri Lanka.</td>
                        <td>20.01.2024</td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent(6)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="update-button" onclick="updateEvent(6)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-button" onclick="deleteEvent(6)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Books for Bright Futures</td>
                        <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                        <td>Charity Book Depot,
                            45 Harmony Street,
                            Colombo 01000.
                            Sri Lanka.</td>
                        <td>20.01.2024</td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent(7)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="update-button" onclick="updateEvent(7)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-button" onclick="deleteEvent(7)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Books for Bright Futures</td>
                        <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                        <td>Charity Book Depot,
                            45 Harmony Street,
                            Colombo 01000.
                            Sri Lanka.</td>
                        <td>20.01.2024</td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent(8)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="update-button" onclick="updateEvent(8)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-button" onclick="deleteEvent(8)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Books for Bright Futures</td>
                        <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                        <td>Charity Book Depot,
                            45 Harmony Street,
                            Colombo 01000.
                            Sri Lanka.</td>
                        <td>20.01.2024</td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent(9)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="update-button" onclick="updateEvent(9)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-button" onclick="deleteEvent(9)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Books for Bright Futures</td>
                        <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                        <td>Charity Book Depot,
                            45 Harmony Street,
                            Colombo 01000.
                            Sri Lanka.</td>
                        <td>20.01.2024</td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent(10)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="update-button" onclick="updateEvent(10)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-button" onclick="deleteEvent(10)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Books for Bright Futures</td>
                        <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                        <td>Charity Book Depot,
                            45 Harmony Street,
                            Colombo 01000.
                            Sri Lanka.</td>
                        <td>20.01.2024</td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent(11)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="update-button" onclick="updateEvent(11)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-button" onclick="deleteEvent(11)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Books for Bright Futures</td>
                        <td> Provide 1,000 books to underprivileged children to promote literacy and education.</td>
                        <td>Charity Book Depot,
                            45 Harmony Street,
                            Colombo 01000.
                            Sri Lanka.</td>
                        <td>20.01.2024</td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent(12)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="update-button" onclick="updateEvent(12)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-button" onclick="deleteEvent(12)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>

            <!-- Modal for event details -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Full Details</h2>
                    <table id="eventDetailsTable">
                        <!-- Event details will go here -->
                    </table>
                </div>
            </div>
            <ul class="pagination" id="pagination">
                <li id="prevButton">«</li>
                <li class="current">1</li>
                <li>2</li>
                <li>3</li>
                <li>4</li>
                <li>5</li>
                <li>6</li>
                <li>7</li>
                <li>8</li>
                <li>9</li>
                <li>10</li>
                <li id="nextButton">»</li>
            </ul>
            <div class="button-container">
                <button id="addEventBtn" onclick="redirectToAddEvent()">ADD</button>
            </div>
        </div>

        <div class="gifs">
            <!-- <img src="/images/book-39.gif">
        <img src="/images/book-38.gif">-->
            <img id="loc" src=<?php echo URLROOT . "/assets/images/charity/location.gif" ?>>
            <div class="location">
                <p> <b>Event locations revealed:</b> "Drop your suggested locations, and let's make a positive difference!"
                </p>
            </div>
            <img src=<?php echo URLROOT . "/assets/images/charity/book-38.gif" ?>>
            <div class="location">
                <p><b>Quality of Books:</b> "Let's make this event a memorable chapter in our shared love for exceptional
                    books!"</p>
            </div>
            <img src=<?php echo URLROOT . "/assets/images/charity/customer-support.gif" ?>>
            <div class="location">
                <p><b>customer Satisfaction</b> "Their satisfaction is not just a goal; it's our standard !"</p>
            </div>
        </div>

<!-- 
        <div id="contact-bar_2">
            <div class="contact-info" onclick="toggleDetails('email-details')">
                <span class="contact-icon">✉️</span>
                <span>Email</span>
                <a href="mailto:kokularajh32@gmail.com" class="contact-details" id="email-details" style="color: aqua;">kokularajh32@gmail.com</a>
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
            <p id="copyright" style=" color: #00ffee;">&copy; 2023 ReadSpot. All rights reserved.</p>
        </div>
    </footer>


</body>

</html>