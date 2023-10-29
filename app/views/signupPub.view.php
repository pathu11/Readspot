<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/signupCss.css" />
</head>

<body>
    <div class="container">
        <!-- Combined Form for both First Page and Second Page -->
        <form class="login" action="http://localhost/Group-27/app/models/User.php" method="post">
            <!-- First Page Content -->
            <div id="formPart1">
                <h1>Sign up</h1>
                <input type="text" name="name" placeholder="First & Last Name">
                <input type="text" name="company_name" placeholder="Company Name">
                <input type="text" name="reg_no" placeholder="Registration Number of the company">
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="contact_no" placeholder="Contact Number">
                <input type="password" name="pass" placeholder="Password">
                <button type="button" class="btn" id="nextButton">Next</button>
            </div>

            <!-- Second Page Content -->
            <div id="formPart2" style="display: none;">
                <input type="text" name="street_name" placeholder="Street Name">
                <input type="text" name="town" placeholder="Town">
                <input type="text" name="district" placeholder="District">
                <input type="text" name="postal_code" placeholder="Postal Code">
                <input type="text" name="account_name" placeholder="Account Holder Name">
                <input type="text" name="account_no" placeholder="Account Number">
                <input type="text" name="branch_name" placeholder="Branch Name">
                <input type="text" name="bank_name" placeholder="Bank Name">
                <button type="submit" class="btn" name="submit">Submit</button>
            </div>
        </form>

        <div class="register">
            <img src="http://localhost/Group-27/public/assets/images/customer/logo.png">
            <h3>WELCOME TO</h3>
            <h2>Read Spot</h2>
            <p>Here we introduce a web-based platform for buying, selling, exchanging, and donating both new & used books.</p>
            <a href="http://localhost/Group-27/app/views/login.view.php"><button>login</button></a>
        </div>
    </div>

    <script>
        const formPart1 = document.getElementById('formPart1');
        const formPart2 = document.getElementById('formPart2');
        const nextButton = document.getElementById('nextButton');

        nextButton.addEventListener('click', () => {
            formPart1.style.display = 'none';
            formPart2.style.display = 'block';
        });
    </script>
</body>

</html>
