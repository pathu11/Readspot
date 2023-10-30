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
    $company_name = $_POST['company_name'];
    $reg_no = $_POST['reg_no'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $pass = $_POST['pass'];
    $user_role = 'publisher';

    // Insert data into users table
    $insertUser = $conn->prepare("INSERT INTO users (email, pass, user_role) VALUES (?, ?, ?)");
    $insertUser->bind_param("sss", $email, $pass, $user_role);
    $insertUser->execute();

    // Get the ID of the inserted user
    $user_id = $conn->insert_id;

    // Insert data into the publishers table
    $insertPublisher = $conn->prepare("INSERT INTO publishers (user_id, name, company_name, reg_no, email, contact_no, pass) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insertPublisher->bind_param("issssss", $user_id, $name, $company_name, $reg_no, $email, $contact_no, $pass);
    $insertPublisher->execute();

    // Redirect to a success page or do further processing
    header("Location: http://localhost/Group-27/app/views/login.view.php");
    exit;
}
?>
