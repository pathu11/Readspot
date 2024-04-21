<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/charity-home.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/user-req-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/userRequest.css">
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
            <a href="donation" class="active">Donation Requests</a>
            <a href="customerSupport">Customer Support</a>
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
        <a href="javascript:history.go(-1)" class="uf-go-back-btn"><i class="fas fa-arrow-left"></i> Go Back</a>
        <div class="uf-requestTable">

            <div class="uf-table-header">
                <h2>Full Details</h2>
            </div>
            <form action="#" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="firstName" value="Ramath" readonly></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" name="lastName" value="Perera" readonly></td>
                    </tr>
                    <tr>
                        <td>Mail ID:</td>
                        <td><input type="email" name="mailId" value="ramath@gmail.com" readonly></td>
                    </tr>
                    <tr>
                        <td>Mobile Number:</td>
                        <td><input type="tel" name="mobileNumber" value="0768563700" readonly></td>
                    </tr>
                    <tr>
                        <td>Quantity:</td>
                        <td><input type="number" name="quantity" value="200" readonly></td>
                    </tr>
                    <tr>
                        <td>Book Types:</td>
                        <td>
                            <label><input type="checkbox" name="bookType[]" value="fiction" checked disabled>
                                Fiction</label><br>
                            <label><input type="checkbox" name="bookType[]" value="non-fiction" disabled>
                                Non-Fiction</label><br>
                            <label><input type="checkbox" name="bookType[]" value="biography" disabled>
                                Biography</label><br>
                            <label><input type="checkbox" name="bookType[]" value="science" disabled> Science</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Additional Note:</td>
                        <td><textarea name="additionalNote" readonly>Special request for the event</textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button type="button" onclick="openRejectModal()" class="uf-reject-req">Reject Request</button>
                            <button type="submit" name="uf-confirm-req" class="uf-confirm-req">Confirm & Make Event</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>


        <div class="uf-modal" id="ufRejectModal">
            <div class="uf-modal-content">
                <span class="uf-close-btn" onclick="closeRejectModal()">&times;</span>
                <h3>Reason for Rejecting Request</h3>
                <form action="#" method="post" id="ufRejectForm">
                    <input type="radio" name="reason" value="bookcat-not-available"> Book Category not available : <input id="book-cat-reason" type="text" class="reasonD" placeholder="suggest an alter category..."><br><br>
                    <input type="radio" name="reason" value="location-not-available"> Locations is not feasible : <input id="location-reason" type="text" class="reasonD" placeholder="suggest an alter location..."> <br><br>
                    <input type="radio" name="reason" value="count-not-enough"> Book count is not enough : <input id="book-count-reason" type="text" class="reasonD" placeholder="request more books..."><br><br>
                    <input type="radio" name="reason" value="date-not-available"> Date is already fixed : <input id="date-reason" type="text" class="reasonD" placeholder="suggest an alter Date..."><br><br>
                    <input type="radio" name="reason" value="other" onclick="toggleCustomReason()"> Other:  <br><br>
                    <textarea name="customReason" id="ufCustomReason" placeholder="Enter a Custom Reason with suggestion" style="display:none;"></textarea>
                    <button type="button" class="send-button" onclick="submitRejectReason()">send</button>
                </form>
            </div>
        </div>
    </body>

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

</html>