<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/charity-home.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/user-req-form.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/userRequest.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <title>ReadSpot Online Book store</title>
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .success-modal {
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

        .success-modal-content {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            width: 600px;
            max-width: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .success-modal-content i {
            font-size: 50px;
            color: #009d94;
            margin-bottom: 20px;
        }

        .success-modal-content p {
            margin-bottom: 20px;
        }

        .success-modal-content button {
            padding: 10px 127px;
            font-size: 15px;
            background-color: #009d94;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .success-modal-content button:hover {
            background-color: #00726c;
        }
    </style>
</head>

<body>

    <div id="dashboard">
        <?php $details = $data['requestDetail'];//  print_r($details);die(); ?>
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
                <a href="editprofile"><i class="fas fa-user-edit"></i>Profile</a>
                <a href="<?php echo URLROOT; ?>/landing/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>

            </div>
        </div>

    </header>

    <body>
        <a href="javascript:history.go(-1)" class="uf-go-back-btn"><i class="fas fa-arrow-left"></i> Go Back</a>
        <div class="uf-requestTable">

            <div class="uf-table-header">
                <h2>Full Details</h2>
            </div>
                <table>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="firstName" value="<?php echo $details->first_name?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" name="lastName" value="<?php echo $details->last_name?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Mail ID:</td>
                        <td><input type="email" name="mailId" value="<?php echo $details->email?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Mobile Number:</td>
                        <td><input type="tel" name="mobileNumber" value="<?php echo $details->contact_number ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Quantity:</td>
                        <td><input type="number" name="quantity" value="<?php echo $details->quantity?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Book Types:</td>
                        <td>
                            <input type="text" name="bookTypes" value="<?php echo $details->book_types?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Request Status:</td>
                        <td>
                        <?php if($details->status == "Accepted"){ ?>
                                    <input type="text" name="bookTypes" style="color:green; font-weight: 600;" value="<?php echo $details->status?>" readonly>
                                <?php } else if($details->status == "Rejected") { ?>
                                    <input type="text" name="bookTypes" style="color:red; font-weight: 600;" value="<?php echo $details->status?>" readonly>
                                <?php } else { ?>
                                    <input type="text" name="bookTypes" style="color:orange; font-weight: 600;" value="<?php echo $details->status?>" readonly>
                        <?php } ?>                        
                        </td>
                    </tr>
                    <?php if($details->status == "Rejected") { ?>
                    <tr>
                        <td>Reason for Rejected:</td>
                        <td><input type="text" name="bookTypes" value="<?php echo $details->reject_reason?>" readonly></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td>Description:</td>
                        <td><textarea name="additionalNote" readonly><?php echo $details->description?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <?php if($details->status == "Pending") {?>
                                    <button type="button" onclick="openRejectModal()" class="uf-reject-req">Reject Request</button>
                                <form action="<?php URLROOT ?>/Readspot/charity/confirmEvent" method="POST">
                                    <input type="hidden" name="doantionId" value="<?php echo $details->donate_id?>" readonly>
                                    <button type="submit" name="uf-confirm-req" class="uf-confirm-req" onclick="openModalConfirm()">Confirm Request</button>
                                </form>
                            <?php } ?>
                            <div id="confirmModal" class="modal">
                                <div class="modal-content">
                                    <span class="close-btn" onclick="hideModal()">&times;</span>
                                    <p>Are you sure?</p>
                                    <button onclick="confirmAction()">Yes</button>
                                    <button onclick="hideModal()">No</button>
                                </div>
                            </div>

                        </td>
                    </tr>
                </table>
        </div>
        
        
            <div class="uf-modal" id="ufRejectModal">
                <div class="uf-modal-content">
                    <span class="uf-close-btn" onclick="closeRejectModal()">&times;</span>
                    <h3>Reason for Rejecting Request</h3>
                    <form action="<?php URLROOT ?>/Readspot/charity/rejectEvent" method="POST">
                        <input type="radio" name="reason" value="Please Donate for upcoming events" onclick="toggleCustomReason()" id="radio1"> <label for="radio1"> Perticular event Date was expired !</label><br>
                        <input id="book-cat-reason" type="text" class="reasonD" value="Please Donate for upcoming events" style="display:none;"><br>

                        <input type="radio" name="reason" value="we have already enough books these category" onclick="toggleCustomReason()" id=radio2> <label for="radio2"> Duplicate Titles </label><br>
                        <input id="location-reason" type="text" class="reasonD" value="we have already enough books these category" style="display:none;"> <br>

                        <input type="radio" name="reason" value="Books that infringe on copyrights or other legal concerns" onclick="toggleCustomReason()" id="radio3"><label for="radio3"> Copyright Issues</label><br>
                        <input id="book-count-reason" type="text" class="reasonD" value="Books that infringe on copyrights or other legal concerns" style="display:none;"><br>

                        <input type="radio" name="reason" value="Books containing offensive or inappropriate content" onclick="toggleCustomReason()" id="radio4"> <label for="radio4">Inappropriate Content</label><br>
                        <input id="date-reason" type="text" class="reasonD" value="Books containing offensive or inappropriate content" style="display:none;"><br>

                        <input type="radio" name="reason" value="other" onclick="toggleCustomReason()" id="radio5"><label for="radio5"> Other</label><br>
                        <textarea name="customReason" id="ufCustomReason" placeholder="Enter a Custom Reason with suggestion" style="display:none;"></textarea>
                        <input type="hidden" name="doantionId" value="<?php echo $details->donate_id?>" readonly>
                        <button type="submit" class="send-button">send</button>
                    </form>
                </div>
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
            <p id="copyright" style=" color: black">&copy; 2023 ReadSpot. All rights reserved.</p>
        </div>
    </footer>
</body>
<script src=<?= URLROOT . "/assets/js/charity/eventscript.js" ?>></script>
<script src=<?= URLROOT . "/assets/js/charity/userRequestjs.js" ?>></script>
<script src=<?= URLROOT . "/assets/js/charity/user-req-form.js" ?>></script>
<script>
    // Open the modal
    function openModal() {
        var modal = document.getElementById('confirmModal');
        modal.style.display = 'block';
    }

    // Close the modal
    function closeModal() {
        var modal = document.getElementById('confirmModal');
        modal.style.display = 'none';
    }

    function openModalConfirm() {
        var modal = document.getElementById('successModal');
        modal.style.display = 'flex';
    }

    // Close the modal
    function closeModalConfirm() {
        var modal = document.getElementById('successModal');
        modal.style.display = 'none';
    }

    // Confirm action
    function confirmAction() {
        // Perform your action here (e.g., form submission)
        document.getElementById('eventForm').submit(); // Replace 'eventForm' with your form's ID

        // Close the modal
        closeModal();
    }
</script>

</html>