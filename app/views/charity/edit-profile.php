<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit profile</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/charity/edit-profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>

    <body>
        <div id="changePasswordModal" class="modal">
            <div class="modal-content">
                <h2>Change Password</h2>
                <label for="modal-Oldpassword">Old Password:</label>
                <input type="password" id="modal-Oldpassword" value="OldPassword" readonly>
                <label for="modal-Newpassword">New Password:</label>
                <input type="password" id="modal-Newpassword">
                <label for="modal-Confirmpassword">Confirm Password:</label>
                <input type="password" id="modal-Confirmpassword">
                <button onclick="updatePassword()">Update</button>
                <button onclick="closeModal()" style="background-color: #d9534f;">Cancel</button>
            </div>
        </div>

        <div id="prof-container">
            <div id="prof-left">
                <img id="Current-prof" src=<?= URLROOT . "/assets/images/charity/rayhan.jpg" ?> alt="Current Profile">
                <label for="prof-profileImage" class="choose-image-btn"><i class="fas fa-upload"></i>Choose Image</label>
                <input type="file" class="prof-input" id="prof-profileImage" accept="image/*" onchange="previewImage(event)">
                <button class="logout-btn" onclick="logout()" style="width: 300px;"><i class=" fas fa-sign-out-alt"></i>
                    Logout</button>
            </div>

            <div id="prof-right">
                <label for="prof-fname">First Name:</label>
                <input type="text" class="prof-input" id="prof-fname" value="John" readonly>

                <label for="prof-lname">Last Name:</label>
                <input type="text" class="prof-input" id="prof-lname" value="Doe" readonly>

                <label for="prof-email">Email:</label>
                <input type="email" class="prof-input" id="prof-email" value="johndoe@example.com" readonly>

                <label for="prof-mobile">Mobile Number:</label>
                <input type="tel" class="prof-input" id="prof-mobile" value="1234567890" readonly>

                <div class="change-password-box">
                    <h4 id="change-pwd"><label for="change-pwd">Change Password</label><i class="fas fa-key"></i></h4>
                </div>

                <div class="password-section" id="passwordSection">
                    <div class="password-container">
                        <div class="password-input-container">
                            <label for="prof-password">Old Password:</label>
                            <input type="password" class="prof-input password-input show-password" id="prof-password" value="33333" readonly>
                            <span class="toggle-password" onclick="togglePasswordVisibility('prof-password')"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="password-container">
                        <div class="password-input-container">
                            <label for="prof-new-password">New Password:</label>
                            <input type="password" class="prof-input password-input show-password" id="prof-new-password">
                            <span class="toggle-password" onclick="togglePasswordVisibility('prof-new-password')"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="password-container">
                        <div class="password-input-container">
                            <label for="prof-confirm-password">Confirm Password:</label>
                            <input type="password" class="prof-input password-input show-password" id="prof-confirm-password">
                            <span class="toggle-password" onclick="togglePasswordVisibility('prof-confirm-password')"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                </div>

                <button class="prof-btn-cancel" style="width: 83px;">Edit</button>
                <button class="prof-btn-update hide">Update</button>
            </div>
        </div>

        <script>
            function previewImage(event) {
                const preview = document.getElementById('Current-prof');
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onloadend = function() {
                    preview.src = reader.result;
                };

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "rayhan.jpg";
                }
            }

            function logout() {
                alert("Logged out successfully!");
            }

            function toggleChangePassword() {
                const modal = document.getElementById('changePasswordModal');
                modal.style.display = 'flex';
            }

            function closeModal() {
                const modal = document.getElementById('changePasswordModal');
                modal.style.display = 'none';
            }

            function updatePassword() {
                const oldPassword = document.getElementById('modal-Oldpassword').value;
                const newPassword = document.getElementById('modal-Newpassword').value;
                const surePassword = document.getElementById('modal-Confirmpassword').value;
                closeModal();
            }

            function updateProfile() {
                alert("Profile successfully updated!");
                document.querySelector('.prof-btn-update').classList.add('hide');
                document.querySelector('.prof-btn-cancel').classList.remove('hide');
                document.querySelectorAll('.prof-input').forEach(function(input) {
                    input.readOnly = true;
                });
            }

            function togglePasswordVisibility(inputId) {
                const input = document.getElementById(inputId);
                const icon = input.nextElementSibling.querySelector('i');
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.add('active');
                } else {
                    input.type = "password";
                    icon.classList.remove('active');
                }
            }

            document.querySelector('.change-password-box').addEventListener('click', toggleChangePassword);

            document.querySelector('.prof-btn-update').addEventListener('click', updateProfile);

            document.querySelector('.prof-btn-cancel').addEventListener('click', function() {
                document.querySelector('.prof-btn-update').classList.remove('hide');
                document.querySelector('.prof-btn-cancel').classList.add('hide');
                document.querySelectorAll('.prof-input').forEach(function(input) {
                    input.readOnly = false;
                });
            });
        </script>
    </body>

</html>

</body>

</html>