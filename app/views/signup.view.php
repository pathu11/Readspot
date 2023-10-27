

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form  method="POST">
        <?php if(!empty($errors)):?>
        <div >
            <?= implode("<br>", $errors)?>
        </div>
        <?php endif;?>


        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" required><br><br>

        <label for="company_name">Company Name:</label>
        <input type="text" name="company_name" required><br><br>

        <label for="contact_no">Contact Number:</label>
        <input type="tel" name="contact_no" required><br><br>

        <label for="reg_no">Registration Number:</label>
        <input type="text" name="reg_no" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Sign Up">
    </form>
</body>
</html>
