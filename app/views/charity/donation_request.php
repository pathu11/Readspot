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
            <a href="notification">
                <i class="fas fa-bell" id="bell"></i>
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
    <!-- Filter Buttons -->
    <div class="filter-buttons">
        <button onclick="filterByUserId()" class="filter-button" style="color:white; background-color: #70bfba;">Users</button>
        <button onclick="filterByEventId()" class="filter-button">Event types</button>
    </div>

    <div class="reqContainer">
        <?php foreach ($allUsers as $user) { ?>
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
        // function filterByUserId() {
        //     var selectedUserId = prompt("Enter User ID:");

        //     var reqCards = document.querySelectorAll('.reqCard');

        //     reqCards.forEach(function(card) {
        //         var cardUserId = card.getAttribute('data-userid');

        //         if (selectedUserId === '' || cardUserId === selectedUserId) {
        //             card.style.display = 'block';
        //         } else {
        //             card.style.display = 'none';
        //         }
        //     });
        // }

        // function filterByEventId() {
        //     // You can implement filtering by Event ID similarly
        //     alert("Filtering by Event ID is not implemented yet.");
        // }
    </script>
</body>

</html>