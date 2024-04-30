

<!DOCTYPE html>
<html lang="en">

<head>
    
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/addbooks.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/sidebar.css" />
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <title>Edit Profile Details</title>
    <style>
        #imagePreview {
            width: 30%;
            border-radius: 60%;
        }
    </style>
</head>

<body>
<?php require APPROOT.'/views/publisher/sidebar.php';?>
    <div>
        <div class="form-container">
            <div class="form1">
                <h2>Edit Profile Details</h2>
                <form action="<?php echo URLROOT; ?>/publisher/editProfile/<?php echo $data['publisher_id']; ?>" method="POST" enctype="multipart/form-data">
                    <br>
                    <br>
                    <!-- Hidden file input -->
                    <input type="file" id="fileInput" name="profile_img" style="display: none;width:100px;height:50px" class="<?php echo (!empty($data['profile_img_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['profile_img']; ?>" required onchange="previewImage()">

                    
                    <label for="fileInput" style="cursor: pointer;">
                    <!-- Image preview -->
                    <img id="imagePreview" src="<?php echo !empty($data['profile_img']) ? URLROOT . '/assets/images/landing/profile/'.$data['profile_img'] : URLROOT . '/assets/images/publisher/person.jpg'; ?>" alt="Profile Image">
                    <span class="error"><?php echo $data['profile_img_err']; ?></span>

                    <br>
                    
                    <input type="text" name="name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" placeholder="Full Name" required><br>
                    <span class="error"><?php echo $data['name_err']; ?></span>

                    <input type="text" name="contact_no" pattern="\+\d{11}"  class="<?php echo (!empty($data['contact_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['contact_no']; ?>" placeholder="Contact Number" required>
                    <button class="submit" type="button" onclick="goBack()">Back</button>
                    <input type="submit" value="Submit" name="submit" class="submit">
                </form>
            </div>
        </div>
    </div>
    <!-- <?php
        require APPROOT . '/views/publisher/footer.php'; //path changed
    ?> -->
    <script>
        function previewImage() {
            var fileInput = document.getElementById('fileInput');
            var imagePreview = document.getElementById('imagePreview');

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>

<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</body>

</html>
