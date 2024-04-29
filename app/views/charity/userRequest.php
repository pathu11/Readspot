<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/charity-home.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/donation-requestcss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/userRequest.css">
    <title>ReadSpot Online Book store</title>
</head>

<body>

    <div id="dashboard">
        <?php $allRequests = $data['allRequests'];?>

    </div>
    <header>
        <div>
            <img id="logo" src=<?= URLROOT . "/assets/images/charity/ReadSpot.png" ?> alt="Logo">
        </div>
        <nav>
            <a href="./">Home</a>

            <a href="event">Event Management</a>
            <a href="donation" class="active">Donation Requests</a>
            <a href="notification">
                <i class="fas fa-bell" id="bell"></i>
                <span class="notification-text">Notification</span>
            </a>
        </nav>
        <div class="dropdown" style="float:right;">
            <button class="dropdown-button">
                <img id="profile" src=<?= URLROOT . "/assets/images/charity/gokuU.jpg" ?> alt="Profile Pic">
            </button>
            <div class="dropdown-content">
                <a href="editprofile"><i class="fas fa-user-edit"></i>Profile</a>
                <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>

    </header>

    <body class="ur-userRequest">
        <a href="javascript:history.go(-1)" class="ur-go-back-btn"><i class="fas fa-arrow-left"></i> Go Back</a>
        <div class="ur-total-count">
            <p>All <span id="ur-totalCount">0</span></p>
        </div>
        <main class="ur-requestTable">
            <section class="ur-table-header">
                <h2>Ramath's Requests</h2>
                <div class="ur-user-common-details">
                    <p>F-name: Ramath</p>
                    <p>L-name: Perera</p>
                    <p>
                        <a href="mailto:ramath@gmail.com" class="ur-email-link">Email ID: ramath@gmail.com</a>
                    </p>
                    <p>
                        <i class="fas fa-phone-alt ur-phone-icon"></i>
                        <span class="ur-phone-link" onclick="showContactOptions()">0764585760</span>
                    </p>
                    <div class="ur-contact-modal" id="ur-contactModal">
                        <div class="ur-contact-modal-content">
                            <i class="fas fa-times ur-close-icon" onclick="closeModal()"></i>
                            <button onclick="callNumber('0764585760')">
                                <i class="fas fa-phone-alt ur-phone-icon"></i> Call
                            </button>
                            <a href="https://wa.me/0764585760" target="_blank">
                                <i class="fab fa-whatsapp ur-phone-icon"></i> Message
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="ur-table-body">
                <table class="ur-table">
                    <thead>
                        <tr>
                            <th>Quantity</th>
                            <th>Book Type</th>
                            <th>Additional Note</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ur-tbody">
                        <?php foreach ($allRequests as $request) { ?>
                            <tr <?php if($request->mark_as_read == 0){ echo 'style="background:#bbebe8  "';} ?>>
                                <td><?php echo $request->quantity ?></td>
                                <td><?php echo $request->book_types ?></td>
                                <td><?php echo $request->description ?></td>
                                
                                <?php if($request->status == "Accepted"){ ?>
                                    <td class="doantion-status" style="color:green"><?php echo $request->status ?></td>
                                <?php } else if($request->status == "Rejected") { ?>
                                    <td class="doantion-status" style="color:red"><?php echo $request->status ?></td>
                                <?php } else { ?>
                                    <td class="doantion-status" style="color:orange"><?php echo $request->status ?></td>
                                <?php } ?>
                                
                                <td>
                                    <form action="<?php URLROOT ?>/Readspot/charity/userrequestform" method="post">
                                        <input type="hidden" name="donate_id" value="<?php echo  $request->donate_id ?>">
                                        <button class="ur-view">View</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
            <div class="ur-popup" id="ur-popup">
                <div class="ur-popup-content">
                    <span class="ur-close-btn" id="ur-closePopup">&times;</span>
                    <p id="ur-popupMessage"></p>
                    <div class="ur-popup-buttons">
                        <button class="ur-popup-button" id="ur-ignoreNow">Ignore</button>
                        <button class="ur-popup-button" id="ur-viewNow">View</button>
                    </div>
                </div>
            </div>
        </main>

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

</html>