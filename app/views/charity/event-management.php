<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo URLROOT . "/assets/css/charity/eventManagement.css" ?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>ReadSpot Online Book store</title>
</head>

<style>
    /* Modal styles */
    .em-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .em-modal-content {
        background-color: #fefefe;
        padding: 20px;
        border-radius: 8px;
        width: 355px;
        margin-left: 37%;
        margin-top: 15%;
        text-align: center;
    }

    .em-modal-content i {
        font-size: 30px;
        color: red;
        margin-bottom: 20px;
    }

    .em-modal-content p {
        margin-bottom: 20px;
    }

    .em-modal-content button {
        padding: 5px 62px;
        font-size: 14px;
        background-color: white;
        color: #4e4e4e;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .em-modal-content button:hover {
        background-color: red;
        color: white;
    }

    .em-modal-content #em-noButton:hover {
        background-color: gray;
        color: white;
    }

    .em-red-box {
        background-color: #ffcccc;
        border: 1px solid #ff0000;
        color: #ff0000;
    }
</style>

<body>
    <header>
        <div>
            <img id="logo" src=<?= URLROOT . "/assets/images/charity/ReadSpot.png" ?> alt="Logo">

        </div>
        <nav>
            <a href="./">Home</a>

            <a href="event" class="active">Event Management</a>
            <a href="donation">Donation Requests</a>
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
                <a href="<?php echo URLROOT; ?>/landing/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </header>

    <div class="body-container">
        <img id="bcnd" src=<?= URLROOT . "/assets/images/charity/eventMang.png" ?>>
        <!-- <a href="#" class="postevent" onclick="showMessage()"> POST EVENTS</a> -->
    </div>

    <!-- <div class="box1">
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
    </div> -->
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
                    <?php foreach ($data['allEvents'] as $event) : ?>
                        <tr>
                            <td>1</td>
                            <td><?php echo $event->event_name ?></td>
                            <td><?php echo $event->description ?></td>
                            <td><?php echo $event->location ?></td>
                            <td><?php echo $event->start_date ?></td>
                            <td class="action-buttons">

                                <form action="<?php echo URLROOT; ?>/charity/viewEvent" method="POST" style="display: inline;">
                                    <input type="hidden" name="eventId" value="<?php echo $event->charity_event_id ?>">
                                    <button class="view-button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </form>

                                <?php if ($event->status == 0) { ?>
                                    <form action="<?php echo URLROOT; ?>/Readspot/charity/deleteEvent" method="POST" style="display: inline;">
                                        <input type="hidden" name="eventId" value="<?php echo $event->charity_event_id; ?>">
                                        <button type="button" class="em-delete-button">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                <?php } ?>

                                <div id="em-deleteModal" class="em-modal">
                                    <div class="em-modal-content em-red-box">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <p>Are you sure you want to delete this item?</p>
                                        <button id="em-okButton">yes</button>
                                        <button id="em-noButton">No</button>
                                    </div>
                                </div>


                                <!-- <button type="submit" class="delete-button">
                                        <i class="fas fa-trash"></i>
                                </button> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <!-- Modal for event details -->
            <!-- <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Full Details</h2>
                    <table id="eventDetailsTable">
                        Event details will go here -->
            <!-- </table>
                    </div>
                </div> -->

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
            <p id="copyright" style=" color: black;">&copy; 2023 ReadSpot. All rights reserved.</p>
        </div>
    </footer>
    <script src=<?= URLROOT . "/assets/js/charity/eventscript.js" ?>></script>
</body>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".em-delete-button");
        const deleteModal = document.getElementById("em-deleteModal");
        const yesButton = document.getElementById("em-okButton");
        const noButton = document.getElementById("em-noButton");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default form submission
                deleteModal.style.display = "block";
            });
        });

        yesButton.addEventListener("click", function() {
            deleteEvent();
        });

        noButton.addEventListener("click", function() {
            closeModal();
        });

        function deleteEvent() {
            const eventId = "<?php echo $event->charity_event_id; ?>"; // Get the event ID
            const formData = new FormData();
            formData.append('eventId', eventId);

            fetch("<?php echo URLROOT; ?>/Readspot/charity/deleteEvent", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Event deleted!");
                        closeModal(); // Close the modal
                        // Optionally, you can reload the page to reflect the changes
                        // location.reload();
                    } else {
                        alert("Failed to delete event.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred while deleting the event.");
                });
        }

        function closeModal() {
            deleteModal.style.display = "none";
        }
    });
</script>

</html>