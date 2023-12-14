<?php
    $title = "Update Moderators";
    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/addbooks.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
</head>

<body>
    <div>
        <?php require APPROOT . '/views/superadmin/nav.php';?>
        <div>
            <div class="form-container">
                <div class="form1">
               
                    <h2>Enter the Details of the Moderator</h2>
                    <form action="<?php echo URLROOT; ?>/superadmin/updateModerator/<?php echo $data['user_id']; ?>" method="POST">
                        <br>
                        <br>
                       
                        <input type="text" name="name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" placeholder="Full Name" required><br>
                        <span class="error"><?php echo isset($data['name_err']) ? $data['name_err'] : ''; ?></span>
                        <input type="email" name="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" placeholder="Email" required>
                        <input type="password" name="pass"  class="<?php echo (!empty($data['pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($data['pass']) ? $data['pass'] : ''; ?>" placeholder="Password" required><br>
                        <span class="error"><?php echo isset($data['pass_err']) ? $data['pass_err'] : ''; ?></span>
                        <input type="password" name="confirm_pass"  class="<?php echo (!empty($data['confirm_pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($data['confirm_pass']) ? $data['confirm_pass'] : ''; ?>" placeholder="Confirm Password" required><br>
                        <span class="error"><?php echo isset($data['confirm_pass_err']) ? $data['confirm_pass_err'] : ''; ?></span>
                        <br>
                        <input  type="submit" placeholder="Submit" name="submit" class="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
