<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=<?php echo URLROOT . "/assets/css/charity/eventManagement.css" ?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>ReadSpot Online Book store</title>
</head>

<body>
    <header>
        <div>
            <img id="logo" src=<?= URLROOT . "/assets/images/charity/ReadSpot.png" ?> alt="Logo">
        </div>
        <nav>
            <a href="./">Home</a>
            <a href="donation">Donation Requests</a>
            <a href="event" class="active">Event Management</a>
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
        <img id="bcnd" src=<?= URLROOT . "/assets/images/charity/Readspot_Bcrnd-Events.png" ?>>
        <!-- <a href="#" class="postevent" onclick="showMessage()"> POST EVENTS</a> -->
    </div>

    <div class="box1">
        <!-- <a href="<?php echo URLROOT; ?>/charity/test">test</a> -->
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
    <div class="event-table">
        <div class="container">
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
            <a href="addEvent"><button id="addEventBtn">ADD</button></a>
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
    <script src=<?= URLROOT . "/assets/js/charity/eventscript.js" ?>></script>
</body>

</html>