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

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // ... Your other variable assignments

    $stmt = $conn->prepare("SELECT email FROM publishers2 WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "An account with this email already exists.";
    } else {
        $insertStmt = $conn->prepare("INSERT INTO publishers2 (name, company_name, reg_no, email, contact_no, pass, street_name, town, district, postal_code, account_name, account_no, branch_name, bank_name, user_role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param('ssssssssssssss', $name, $company_name, $reg_no, $email, $contact_no, $password, $street_name, $town, $district, $postal_code, $account_name, $account_no, $branch_name, $bank_name, $user_role);
        
        if ($insertStmt->execute()) {
            // Insert data into the 'users' table
            $insertStmtUsers = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, 'publisher')");
            $insertStmtUsers->bind_param('sss', $email, $password);
            if (!$insertStmtUsers->execute()) {
                echo "Registration failed for user insertion: " . $insertStmtUsers->error;
                // Handle the error accordingly
            } else {
                header("Location: http://localhost/Group-27/app/views/login.view.php");
                exit;
            }
        } else {
            error_log("Registration failed: " . $insertStmt->error);
            echo "Registration failed. Please try again later.";
        }
    }
}
?>
