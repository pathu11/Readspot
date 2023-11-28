<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/signuppub.css">
    <title>Sign Up For Charity Organization</title>
    
</head>

<body>
    <div class="container">
        <form class="login" action="<?php echo URLROOT; ?>/landing/signupCharity" method="post">
            <div id="formPart1">
                <h1>Sign up</h1>
                <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                <input type="text" name="name" placeholder="Full Name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" required>

                <span class="invalid-feedback"><?php echo $data['org_name_err']; ?></span>
                <input type="text" name="org_name" placeholder="Organization Name" class="<?php echo (!empty($data['org_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['org_name']; ?>" required>

                

                <span class="invalid-feedback"><?php echo $data['reg_no_err']; ?></span>
                <input type="text" name="reg_no" placeholder="Registration Number of the company" class="<?php echo (!empty($data['reg_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['reg_no']; ?>" required>


                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                <input type="email" name="email" placeholder="Email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" required>

                <span class="invalid-feedback"><?php echo $data['contact_no_err']; ?></span>
                <input type="text" name="contact_no" placeholder="Contact Number" class="<?php echo (!empty($data['contact_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['contact_no']; ?>" required>

                <span class="invalid-feedback"><?php echo $data['pass_err']; ?></span>
                <input type="password" name="pass" placeholder="Password" class="<?php echo (!empty($data['pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pass']; ?>" required>

                <span class="invalid-feedback"><?php echo $data['confirm_pass_err']; ?></span>
                <input type="password" name="confirm_pass" placeholder="Confirm Password" class="<?php echo (!empty($data['confirm_pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_pass']; ?>" required>
                

                <button type="submit" class="btn" name="submit">Submit</button>
            </div>
        </form>

        <div class="register">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/logo.png">
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introduce a web-based platform for buying, selling, exchanging, and donating both new & used books.</p>
            <a href="<?php echo URLROOT; ?>/landing/login"><button>login</button></a>
        </div>
    </div>
</body>

</html>
