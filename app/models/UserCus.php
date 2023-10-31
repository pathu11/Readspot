<?php
// $host = 'localhost';
// $user = 'root';  
// $password = '';  
// $database = 'readspots';

// $conn = new mysqli($host, $user, $password, $database);

// if ($conn->connect_error) {
//     error_log("Connection failed: " . $conn->connect_error);
//     die("Connection failed. Please try again later.");
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $name = $_POST['name'];   
//     $email = $_POST['email'];  
//     $pass = $_POST['pass'];
//     $confirmPass = $_POST['passrepeat'];
//     $user_role = 'customer';

//     if ($pass !== $confirmPass) {
//         $errors[] = "Passwords do not match.";
//     }

//     // Insert data into users table
//     $insertUser = $conn->prepare("INSERT INTO users (email, pass, user_role) VALUES (?, ?, ?)");
//     $insertUser->bind_param("sss", $email, $pass, $user_role);
//     $insertUser->execute();

//     // Get the ID of the inserted user
//     $user_id = $conn->insert_id;

//     // Insert data into the customers table
//     $insertCustomer = $conn->prepare("INSERT INTO customers (customersId, customersName, customersEmail, customersPwd) VALUES (?, ?, ?, ?)");
//     $insertCustomer->bind_param("isss", $user_id, $name, $email, $pass);
//     $insertCustomer->execute();


//     // Redirect to a success page or do further processing
//     header("Location: http://localhost/Group-27/app/views/login.view.php");
//     exit;
// }

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
    $confirmPass = $_POST['passrepeat'];
    $user_role = 'customer';

    if ($pass !== $confirmPass) {
        echo "Passwords do not match!";
    } else {
        // Insert data into users table
        $insertUser = $conn->prepare("INSERT INTO users (email, pass, user_role) VALUES (?, ?, ?)");
        $insertUser->bind_param("sss", $email, $pass, $user_role);
        $insertUser->execute();

        if ($insertUser) {
            $user_id = $conn->insert_id; // Retrieve the auto-generated user_id after inserting user data

            // Insert the user data into the customers table
            $insertCustomer = $conn->prepare("INSERT INTO customers (user_id, name, email, pass) VALUES (?, ?, ?, ?)");
            $insertCustomer->bind_param("isss", $user_id, $name, $email, $pass);
            $insertCustomer->execute();

            if ($insertCustomer && $insertUser) {
                echo "Data inserted successfully.";
                // Redirect to a success page or do further processing
                header("Location: http://localhost/Group-27/app/views/login.view.php");
                exit;
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

