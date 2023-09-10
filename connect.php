<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$emailAddress = $_POST['emailAddress'];
$password = $_POST['password'];
$phoneNumber = $_POST['phoneNumber'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'group27');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, emailAddress, password, phoneNumber) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $emailAddress, $password, $phoneNumber);
    
    if ($stmt->execute()) {
        echo "Registration Successful";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
