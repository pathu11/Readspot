<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=<?php echo URLROOT . "/assets/css/charity/addEvent.css" ?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>ReadSpot Online Book store</title>
    <script>

        "use strict";
        function dragNdrop(event) {
            var fileName = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("preview");
            var previewImg = document.createElement("img");
            previewImg.setAttribute("src", fileName);
            preview.innerHTML = "";
            preview.appendChild(previewImg);
        }

        function drag() {
            document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
        }

        function drop() {
            document.getElementById('uploadFile').parentNode.className = 'dragBox';
        }

    </script>
</head>

<body>
    <header>
        <div>
            <img id="logo" src=<?= URLROOT . "/assets/images/charity/ReadSpot.png" ?> alt="Logo">
        </div>
        <nav>
            <a href="./">Home</a>
            <a href="event" class="active">Event Management</a>
            <a href="donation">Donation Requests</a>
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

    <div class="addEventContainer">
        <h2>CREATE CHARITY EVENTS</h2>
        
        <div class="addeventInputRow">
            <div class="addeventRowElement">
                <p>Event Name :</p>
                <input type="text">
            </div>
            <div class="addeventRowElement">
                <p>Event Location :</p>
                <input type="text">
            </div>
        </div>

        <div class="addeventInputRow">
            <div class="addeventRowElement">
                <p>Start Date :</p>
                <input type="text">
            </div>
            <div class="addeventRowElement">
                <p>End Date :</p>
                <input type="text">
            </div>
        </div>

        <div class="addeventInputRow">
            <div class="addeventRowElement">
                <p>Start Time :</p>
                <input type="text">
            </div>
            <div class="addeventRowElement">
                <p>End Time :</p>
                <input type="text">
            </div>
        </div>

        <div class="addeventInputRow">
            <div class="addeventRowElement uploadEventPoster">
                <p>Import Event Poster:</p>
                <div class="uploadOuter">
                    <span class="dragBox" >
                        <p>Darg and Drop image here</p>
                        <input type="file" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"  />
                    </span>
                </div>
                <div id="preview"></div>
            </div>
        </div>

        <div class="addeventInputRow">
            <div class="addeventRowElement">
                <p>Event Name :</p>
                <input type="text">
            </div>
            <div class="addeventRowElement">
                <p>Event Location :</p>
                <input type="text">
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