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
        <?php $event = $data['event'] ?>
    </div>
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
                <img id="profile" src=<?= URLROOT . "/assets/images/charity/gokuU.jpg" ?> alt="Profile Pic">
            </button>
            <div class="dropdown-content">
                <a href="editprofile"><i class="fas fa-user-edit"></i>Profile</a>
                <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </header>


    <a href="javascript:history.go(-1)" class="ae-go-back-btn"><i class="fas fa-arrow-left"></i> Go Back</a>
    <div class="ae-requestTable">
        <div class="ae-table-header">
            <h2>View event</h2>
        </div>
        <form id="eventForm" action="#" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Event Name:</td>
                    <td><input type="text" name="eventName" value="<?php echo $event->event_name ?>" required disabled></td>
                </tr>
                <tr>
                    <td>Event Location:</td>
                    <td><input type="text" name="eventLocation" value="<?php echo $event->location ?>" required disabled></td>
                </tr>
                <tr>
                    <td>Start Date:</td>
                    <td><input type="date" name="startDate" value="<?php echo $event->start_date ?>" required disabled></td>
                </tr>
                <tr>
                    <td>End Date:</td>
                    <td><input type="date" name="endDate" value="<?php echo $event->end_date ?>" required disabled></td>
                </tr>
                <tr>
                    <td>Start Time:</td>
                    <td><input type="time" name="startTime" value="<?php echo $event->start_time ?>" required disabled></td>
                </tr>
                <tr>
                    <td>End Time:</td>
                    <td><input type="time" name="endTime" value="<?php echo $event->end_time ?>" required disabled></td>
                </tr>

                <!-- need to be add in DB -->
                <tr>
                    <td class="deadline">Deadline for donation <i class="fas fa-edit edit-icon"></i></td>
                    <td>
                        <input type="date" id="deadlineDate" name="deadlineDate" required min="1000-01-01" max="9999-12-31">
                    </td>
                </tr>
                <tr>
                    <td>Charity Member Phone:</td>
                    <td><input type="tel" name="charityMemberPhone" value="<?php echo $event->contact_no ?>" placeholder="Enter phone number" required disabled></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" required disabled><?php echo $event->description ?></textarea></td>
                </tr>
                <tr>
                    <td>Poster image:</td>
                    <td>
                        <div class="ae-drop-image-box">
                            <span class="placeholder-text"><i class="fas fa-camera"></i> Drop an Image</span>
                            <img id="previewImage" src="<?php echo URLROOT ?>/public/assets/images/charity/event01.jpg" alt="Preview">
                            <input type="file" name="posterImage" id="posterImageInput" accept="image/*" required disabled>
                            <span class="ae-view-icon" id="viewpos" onclick="openModal()"><i class="fas fa-eye"></i></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type="button" style="background-color: red;" id="ve-dltbtn">Delete</button>
                        <button type="button" onclick="enableEditing()" id="ve-editbtn">Edit</button>

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
            <p id="copyright" style=" color: black;">&copy; 2023 ReadSpot. All rights reserved.</p>
        </div>
    </footer>
</body>
<script src=<?= URLROOT . "/assets/js/charity/eventscript.js" ?>></script>
<script src=<?= URLROOT . "/assets/js/charity/userRequestjs.js" ?>></script>
<script src=<?= URLROOT . "/assets/js/charity/user-req-form.js" ?>></script>
<script src=<?= URLROOT . "/assets/js/charity/confirm-event.js" ?>></script>

<script>
    function enableEditing() {
        var btn = document.getElementById("ve-editbtn");
        var dltBtn = document.getElementById("ve-dltbtn");
        var form = document.getElementById("eventForm");
        var inputs = form.querySelectorAll("input, textarea, select");

        if (btn.innerHTML === "Edit") {
            btn.innerHTML = "Save";
            dltBtn.style.display = "none";
            inputs.forEach(function(input) {
                input.removeAttribute("disabled");
            });
        }

    }


    function toggleOther() {
        var otherCheckbox = document.querySelector('input[name="bookCategory[]"][value="other"]');
        var otherCategoryInput = document.getElementById("otherCategory");

        if (otherCheckbox.checked) {
            otherCategoryInput.style.display = "inline";
        } else {
            otherCategoryInput.style.display = "none";
        }
    }

    function openModal() {
        var modal = document.getElementById("imageModal");
        var modalImage = document.getElementById("modalImage");
        var previewImage = document.getElementById("previewImage");

        modal.style.display = "block";
        modalImage.src = previewImage.src;
    }

    function closeModal() {
        var modal = document.getElementById("imageModal");
        modal.style.display = "none";
    }
</script>

</html>