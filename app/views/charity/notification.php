<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo URLROOT . "/assets/css/charity/eventManagement.css" ?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href=<?php echo URLROOT . "/assets/css/charity/notification.css" ?>>
    <title>ReadSpot Online Book store</title>
</head>

<body>
    <header>
        <div>
            <img id="logo" src=<?= URLROOT . "/assets/images/charity/ReadSpot.png" ?> alt="Logo">

        </div>
        <nav>
            <a href="./">Home</a>

            <a href="event">Event Management</a>
            <a href="donation">Donation Requests</a>
            <a href="notification" class="active">
                <i class="fas fa-bell" id="bell"></i>
                <span class="notification-text">Notification</span>
            </a>
        </nav>
        <div class="dropdown" style="float:right;">
            <button class="dropdown-button">
                <img id="profile" src=<?= URLROOT . "/assets/images/charity/rayhan.jpg" ?> alt="Profile Pic">
            </button>
            <div class="dropdown-content">
                <a href="editprofile"><i class="fas fa-user-edit"></i>Profile</a>
                <a href="<?php echo URLROOT; ?>/landing/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </header>

    <div class="notification-container">
        <button class="req-not active" onclick="showRequests()">Requests</button>
        <button class="query-not" onclick="showQueries()">Queries</button>

        <div class="request-notification not-list">
            <div class="not-notification-item">
                <div class="not-profile-image">
                    <img src="/assets/images/charity/himaza.jpg" alt="Profile">
                </div>
                <div class="not-notification-content">
                    <strong>Ramath</strong> has donated 50 fiction types of books for the book marathon event
                </div>
                <div class="not-notification-date">
                    May 8, 2024
                </div>
                <div class="not-menu-icons">
                    <a href="<?php echo URLROOT; ?>/charity/userrequestform">
                        <i class="fas fa-eye not-view-icon"></i>
                    </a>

                    <i class="fas fa-trash not-delete-icon"></i>
                    <!-- <i class="fas fa-comment-alt not-chat-icon"></i> -->
                </div>
            </div>

            <div class="not-notification-item">
                <div class="not-profile-image">
                    <img src="/assets/images/charity/himaza.jpg" alt="Profile">
                </div>
                <div class="not-notification-content">
                    <strong>Ramath</strong> has donated 50 fiction types of books for the book marathon event
                </div>
                <div class="not-notification-date">
                    May 8, 2024
                </div>
                <div class="not-menu-icons">
                    <a href="<?php echo URLROOT; ?>/charity/userrequestform">
                        <i class="fas fa-eye not-view-icon"></i>
                    </a>
                    <i class="fas fa-trash not-delete-icon"></i>
                    <!-- <i class="fas fa-comment-alt not-chat-icon"></i> -->
                </div>
            </div>
            <div class="not-notification-item">
                <div class="not-profile-image">
                    <img src="/assets/images/charity/himaza.jpg" alt="Profile">
                </div>
                <div class="not-notification-content">
                    <strong>Ramath</strong> has donated 50 fiction types of books for the book marathon event
                </div>
                <div class="not-notification-date">
                    May 8, 2024
                </div>
                <div class="not-menu-icons">
                    <a href="<?php echo URLROOT; ?>/charity/userrequestform">
                        <i class="fas fa-eye not-view-icon"></i>
                    </a>
                    <i class="fas fa-trash not-delete-icon"></i>
                    <!-- <i class="fas fa-comment-alt not-chat-icon"></i> -->
                </div>
            </div>
            <div class="not-notification-item">
                <div class="not-profile-image">
                    <img src="/assets/images/charity/himaza.jpg" alt="Profile">
                </div>
                <div class="not-notification-content">
                    <strong>Ramath</strong> has donated 50 fiction types of books for the book marathon event
                </div>
                <div class="not-notification-date">
                    May 8, 2024
                </div>
                <div class="not-menu-icons">
                    <a href="<?php echo URLROOT; ?>/charity/userrequestform">
                        <i class="fas fa-eye not-view-icon"></i>
                    </a>
                    <i class="fas fa-trash not-delete-icon"></i>
                    <!-- <i class="fas fa-comment-alt not-chat-icon"></i> -->
                </div>
            </div>
            <div class="not-notification-item">
                <div class="not-profile-image">
                    <img src="/assets/images/charity/himaza.jpg" alt="Profile">
                </div>
                <div class="not-notification-content">
                    <strong>Ramath</strong> has donated 50 fiction types of books for the book marathon event
                </div>
                <div class="not-notification-date">
                    May 8, 2024
                </div>
                <div class="not-menu-icons">
                    <a href="<?php echo URLROOT; ?>/charity/userrequestform">
                        <i class="fas fa-eye not-view-icon"></i>
                    </a>
                    <i class="fas fa-trash not-delete-icon"></i>
                    <!-- <i class="fas fa-comment-alt not-chat-icon"></i> -->
                </div>
            </div>
        </div>

        <div class="query-notification not-list" style="display:none;">
            <div class="not-notification-item">
                <div class="not-profile-image">
                    <img src="/assets/images/charity/himaza.jpg" alt="Profile">
                </div>
                <div class="not-notification-content">
                    <strong>Himaza</strong> shall we donate for poor childs ?!!!
                </div>
                <div class="not-notification-date">
                    May 8, 2024
                </div>
                <div class="not-menu-icons">
                    <!-- <i class="fas fa-eye not-view-icon"></i> -->
                    <i class="fas fa-trash not-delete-icon"></i>
                    <i class="fas fa-comment-alt not-chat-icon"></i>
                </div>
            </div>
            <div class="not-notification-item">
                <div class="not-profile-image">
                    <img src="/assets/images/charity/himaza.jpg" alt="Profile">
                </div>
                <div class="not-notification-content">
                    <strong>Himaza</strong> shall we donate for poor childs ?!!!
                </div>
                <div class="not-notification-date">
                    May 8, 2024
                </div>
                <div class="not-menu-icons">
                    <!-- <i class="fas fa-eye not-view-icon"></i> -->
                    <i class="fas fa-trash not-delete-icon"></i>
                    <i class="fas fa-comment-alt not-chat-icon"></i>
                </div>
            </div>
            <div class="not-notification-item">
                <div class="not-profile-image">
                    <img src="/assets/images/charity/himaza.jpg" alt="Profile">
                </div>
                <div class="not-notification-content">
                    <strong>Himaza</strong> shall we donate for poor childs ?!!!
                </div>
                <div class="not-notification-date">
                    May 8, 2024
                </div>
                <div class="not-menu-icons">
                    <!-- <i class="fas fa-eye not-view-icon"></i> -->
                    <i class="fas fa-trash not-delete-icon"></i>
                    <i class="fas fa-comment-alt not-chat-icon"></i>
                </div>
            </div>
        </div>
    </div>


    <!-- delete-model -->





    <footer style="margin-top: auto;">
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
    <script src=<?= URLROOT . "/assets/js/charity/eventscript.js" ?>></script>

    <script>
        function showRequests() {
            // Remove 'active' class from all buttons
            document.querySelector('.req-not').classList.add('active');
            document.querySelector('.query-not').classList.remove('active');

            // Show request notifications and hide query notifications
            document.querySelector('.request-notification').style.display = 'block';
            document.querySelector('.query-notification').style.display = 'none';
        }

        function showQueries() {
            // Remove 'active' class from all buttons
            document.querySelector('.query-not').classList.add('active');
            document.querySelector('.req-not').classList.remove('active');

            // Show query notifications and hide request notifications
            document.querySelector('.query-notification').style.display = 'block';
            document.querySelector('.request-notification').style.display = 'none';
        }
    </script>
</body>

</html>