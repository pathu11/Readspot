<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/charity-home.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/user-req-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/confirm-event.css">
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
            <a href="event" class="active">Event Management</a>
            <a href="donation">Donation Requests</a>
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

    <body>
        <a href="javascript:history.go(-1)" class="ae-go-back-btn"><i class="fas fa-arrow-left"></i> Go Back</a>
        <div class="ae-requestTable">
            <div class="ae-table-header">
                <h2>Confirm & Add event</h2>
            </div>
            <form action="<?php URLROOT?>/Readspot/charity/createEvent" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Event Name:</td>
                        <td><input type="text" name="eventName" required></td>
                    </tr>
                    <tr>
                        <td>Event Location:</td>
                        <td><input type="text" name="eventLocation" required></td>
                    </tr>
                    <tr>
                        <td>Start Date:</td>
                        <td><input type="date" name="startDate" required></td>
                    </tr>
                    <tr>
                        <td>End Date:</td>
                        <td><input type="date" name="endDate" required></td>
                    </tr>
                    <tr>
                        <td>Start Time:</td>
                        <td><input type="time" name="startTime" required></td>
                    </tr>
                    <tr>
                        <td>End Time:</td>
                        <td><input type="time" name="endTime" required></td>
                    </tr>
                    <tr>
                        <td>Book Count:</td>
                        <td><input type="text" name="bookCount" required></td>
                    </tr>
                    <tr>
                        <td>Book Category:</td>
                        <td>
                            <label><input type="checkbox" name="bookCategory[]" value="fiction"> Fiction</label><br>
                            <label><input type="checkbox" name="bookCategory[]" value="non-fiction"> Non-Fiction</label><br>
                            <label><input type="checkbox" name="bookCategory[]" value="biography"> Biography</label><br>
                            <label><input type="checkbox" name="bookCategory[]" value="science"> Science</label><br>
                            <label><input type="checkbox" name="bookCategory[]" value="other" onchange="toggleOther()">
                                Other</label>
                            <input type="text" id="otherCategory" name="otherCategory" placeholder="Enter Category" style="display: none;">
                        </td>
                    </tr>
                    <tr>
                        <td>Poster Image:</td>
                        <td>
                            <div class="ae-drop-image-box">
                                <span class="placeholder-text"><i class="fas fa-camera"></i> Drop an Image</span>
                                <img id="previewImage" src="#" alt="Preview" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                                <input type="file" name="posterImage" id="posterImageInput">
                                
                                <span class="ae-view-icon" id="viewpos" onclick="openModal()"><i class="fas fa-eye"></i></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Charity Member Phone:</td>
                        <td><input type="tel" name="charityMemberPhone" value="076-8545700" placeholder="Enter phone number" required></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><textarea name="description" required></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button type="submit">Add</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div id="imageModal" class="modal">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="modalImage">
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
    </body>
    <script src=<?= URLROOT . "/assets/js/charity/eventscript.js" ?>></script>
    <script src=<?= URLROOT . "/assets/js/charity/userRequestjs.js" ?>></script>
    <script src=<?= URLROOT . "/assets/js/charity/user-req-form.js" ?>></script>
    <script src=<?= URLROOT . "/assets/js/charity/confirm-event.js" ?>></script>

</html>