<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/charity-home.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/donation-requestcss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>ReadSpot Online Book store</title>
</head>

<body>
    <?php $allUsers = $data['allUsers']; ?>

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
            <a href="aboutUs">
                <i class="fas fa-bell" id="bell"></i>
                <span class="notification-text">Notification</span>
            </a>
        </nav>
        <div class="dropdown" style="float:right;">
            <button class="dropdown-button">
                <img id="profile" src=<?= URLROOT . "/assets/images/charity/rayhan.jpg" ?> alt="Profile Pic">
            </button>
            <div class="dropdown-content">
                <a href="#"><i class="fas fa-user-edit"></i>Profile</a>
                <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>

    </header>

    <div class="body-container">
        <img id="bcnd" src=<?= URLROOT . "/assets/images/charity/donationREQ.png" ?>>
    </div>

    <div class="reqContainer">
        <?php foreach($allUsers as $user) { ?>
        <div class="reqCard">
            <div class="imgBox">
                <img src=<?= URLROOT . "/assets/images/charity/ram3.jpeg" ?>>
            </div>
            <div class="content">
                <div class="customer-info">
                    <h4><?php echo $user->first_name ?></h4>
                    <p style="color: aqua;"><?php echo $user->email ?></p>
                </div>
                <br>
                <p>NEW donation Requests from Ramath!</p>
            </div>
            <a href="<?php echo URLROOT; ?>/charity/userRequest">CHECK</a>
        </div>
        <?php } ?>

        <div class="reqCard checked">
            <div class="imgBox">
                <img src=<?= URLROOT . "/assets/images/charity/ganesh.avif" ?>>
            </div>
            <div class="content">
                <div class="customer-info">
                    <h4>Ganeshwar</h4>
                    <p style="color: aqua;">Ganeshwar11@gmail.com</p>
                </div>
                <br>
                <p>No any NEW donations!</p>
            </div>
            <a href="<?php echo URLROOT; ?>/charity/userRequest" style="background-color:gray;">CHECK</a>
        </div>

    </div>


    <div class="modal" id="confirmationModal">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <p>No NEW requests, Do you want to see OLD donation details ?!</p>
            <div class="modal-actions">
                <button id="confirmBtn">Yes</button>
                <button id="cancelBtn">No</button>
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
            <p id="copyright" style=" color: black;">&copy; 2023 ReadSpot. All rights reserved.</p>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notAvailableButtons = document.querySelectorAll('.not-available');
            const modal = document.getElementById('confirmationModal');
            const closeModalBtn = document.getElementById('closeModal');
            const confirmBtn = document.getElementById('confirmBtn');
            const cancelBtn = document.getElementById('cancelBtn');

            notAvailableButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    modal.style.display = 'block';
                });
            });

            closeModalBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            cancelBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            confirmBtn.addEventListener('click', function() {
                window.location.href = 'oldDonationDetailsPage.html';
            });
        });
    </script>
</body>

</html>