<?php
    $title = "Edit Profile Details";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/addbooks.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/sidebar.css" />
</head>

<body>
    <div>
        <div class="form-container">
            <div class="form1">
                <h2>Edit Profile Details </h2>
                <form action="<?php echo URLROOT; ?>/publisher/editProfile/<?php echo $data['publisher_id']; ?>" method="POST">                    
                    <br>
                    <br>

                    <!-- Hidden file input -->
                    <input type="file" id="fileInput" name="profile_img" style="display: none;" class="<?php echo (!empty($data['profile_img_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['profile_img']; ?>" required>

                    <!-- Icon to trigger file input -->
                    <label for="fileInput" style="cursor: pointer;">
                    <img style="border-radius:60%;width:30%;" src="<?php echo URLROOT; ?>/assets/images/publisher/person.jpg"><span class="error"><?php echo $data['profile_img_err']; ?></span>
                    </label>

                    <br>
                    
                    <input type="text" name="name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" placeholder="Full Name" required><br>
                    <span class="error"><?php echo $data['name_err']; ?></span>

                    <input type="text" name="contact_no" class="<?php echo (!empty($data['contact_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['contact_no']; ?>" placeholder="Contact Number" required>

                    <input type="submit" placeholder="Submit" name="submit" class="submit">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
