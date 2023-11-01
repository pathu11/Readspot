<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'readspots';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed. Please try again later.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
   
    $email = $_POST['email'];
    
    $pass = $_POST['pass'];
    $user_role = 'admin';

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format. Please enter a valid email address.');
    }
    if (strlen($pass) < 6) {
        // die('Password should contain more than 6 characters.');
        echo '<script>alert("Password should contain more than 4 characters");</script>';
        echo '<script>location.href = "http://localhost/Group-27/app/views/signupPub.view.php";</script>';
        exit;
    }


    // Check if the email already exists
    $checkUser = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $checkUser->bind_param("s", $email);
    $checkUser->execute();
    $checkUser->store_result();

    if ($checkUser->num_rows > 0) {
        echo '<script>alert("Email is already registered.");</script>';
        echo '<script>location.href = "http://localhost/Group-27/app/views/superadmin/addadmin.view.php";</script>';
        exit;
    }

    // Insert data into users table
    $insertUser = $conn->prepare("INSERT INTO users (email, pass, user_role) VALUES (?, ?, ?)");
    $insertUser->bind_param("sss", $email, $pass, $user_role);
    $insertUser->execute();

    // Get the ID of the inserted user
    $user_id = $conn->insert_id;

    // Insert data into the publishers table
    $insertPublisher = $conn->prepare("INSERT INTO admin (user_id, name,  email,  pass) VALUES ( ?, ?, ?, ?)");
    $insertPublisher->bind_param("issssss", $user_id, $name,$email, $pass);
    $insertPublisher->execute();

    // Redirect to a success page or do further processing
    header("Location: http://localhost/Group-27/app/views/superadmin/addadmin.view.php");
    exit;
}
?>
