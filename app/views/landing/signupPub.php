<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/signuppub.css">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>

<body>
    <div class="container">
        <form class="login" action="<?php echo URLROOT; ?>/landing/signupPub" method="post">
            <div id="formPart1">
                <h1>Sign up</h1>
                <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                <input type="text" name="name" placeholder="Full Name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" required>

                <span class="invalid-feedback"><?php echo $data['company_name_err']; ?></span>
                <input type="text" name="company_name" placeholder="Company Name" class="<?php echo (!empty($data['company_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['company_name']; ?>" required>

                <span class="invalid-feedback"><?php echo $data['reg_no_err']; ?></span>
                <input type="text" name="reg_no" placeholder="Registration Number of the company" class="<?php echo (!empty($data['reg_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['reg_no']; ?>" required>

                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                <input type="email" name="email" placeholder="Email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" required>


                <span class="invalid-feedback"><?php echo $data['contact_no_err']; ?></span>
                <input type="text" name="contact_no" placeholder="Contact Number" class="<?php echo (!empty($data['contact_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['contact_no']; ?>" required>

                <div class="password-wrapper">
                <span class="invalid-feedback"><?php echo $data['pass_err']; ?></span>
                <input type="password" name="pass" placeholder="Password" class="<?php echo (!empty($data['pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pass']; ?>" required>
                <i class="fa fa-eye-slash" id="togglePassword"></i> <br></div>

                <div class="password-wrapper">
                <span class="invalid-feedback"><?php echo $data['confirm_pass_err']; ?></span>
                <input type="password" name="confirm_pass" placeholder="Confirm Password" class="<?php echo (!empty($data['confirm_pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_pass']; ?>" required>
                <i class="fa fa-eye-slash" id="togglePassword2"></i> <br></div>

                <!-- <button onclick="goBack()" class="btn" type="submit">  Cancel </button>  -->
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
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordInput = document.querySelector('input[name="pass"]');
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        this.classList.toggle('fa-eye-slash'); // Toggle the slash on the icon
        this.classList.toggle('fa-eye');   // Toggle the eye icon itself
        });

        document.getElementById('togglePassword2').addEventListener('click', function() {
        var confirmPasswordInput = document.querySelector('input[name="confirm_pass"]');
        var type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);

        this.classList.toggle('fa-eye-slash'); // Toggle the slash on the icon
        this.classList.toggle('fa-eye');   // Toggle the eye icon itself
    });
        
        
    </script>
</html>
