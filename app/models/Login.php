<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "readspots";

session_start();

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["pass"];

    $query = "SELECT * FROM users WHERE email = ? AND pass = ?";
    $stmt = mysqli_prepare($data, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            switch ($row["user_role"]) {
                case "customer":
                    // Handle Customer Login
                    $_SESSION["email"] = $email;
                    $customerQuery = "SELECT * FROM customers WHERE user_id = " . $row['user_id'];
                    $customerResult = mysqli_query($data, $customerQuery);
                    $customer = mysqli_fetch_assoc($customerResult);
                    if ($customer) {
                        foreach ($customer as $key => $value) {
                            $_SESSION["customer_" . $key] = $value;
                        }
                    }
                    // Redirect to the customer dashboard
                    header("location:http://localhost/Group-27/app/views/customer/Home.php");
                    break;

                case "publisher":
                    // Handle Publisher Login
                    $_SESSION["email"] = $email;
                    $publisherQuery = "SELECT * FROM Publishers WHERE user_id = " . $row['user_id'];
                    $publisherResult = mysqli_query($data, $publisherQuery);
                    $publisher = mysqli_fetch_assoc($publisherResult);
                    if ($publisher) {
                        foreach ($publisher as $key => $value) {
                            $_SESSION["publisher_" . $key] = $value;
                        }
                    }
                    // Redirect to the publisher home view
                    header("location:http://localhost/Group-27/app/views/publisher/home.view.php");
                    break;

                case "admin":
                    // Handle Admin Login
                    $_SESSION["email"] = $email;
                    $adminQuery = "SELECT * FROM admin WHERE user_id = " . $row['user_id'];
                    $adminResult = mysqli_query($data, $adminQuery);
                    $admin = mysqli_fetch_assoc($adminResult);
                    if ($admin) {
                        foreach ($admin as $key => $value) {
                            $_SESSION["admin_" . $key] = $value;
                        }
                    }
                    // Redirect to the admin panel
                    header("location:http://localhost/Group-27/app/views/admin/index.view.php");
                    break;

                case "deliver":
                    // Handle Delivery Login
                    $_SESSION["email"] = $email;
                    $deliveryQuery = "SELECT * FROM delivery WHERE user_id = " . $row['user_id'];
                    $deliveryResult = mysqli_query($data, $deliveryQuery);
                    $delivery = mysqli_fetch_assoc($deliveryResult);
                    if ($delivery) {
                        foreach ($delivery as $key => $value) {
                            $_SESSION["delivery_" . $key] = $value;
                        }
                    }
                    // Redirect to the delivery dashboard
                    header("location:http://localhost/Group-27/app/views/delivery/home.view.php");
                    break;
                
                    case "super_admin":
                        // Handle Delivery Login
                        $_SESSION["email"] = $email;
                        $super_adminQuery = "SELECT * FROM superadmin WHERE user_id = " . $row['user_id'];
                        $super_adminResult = mysqli_query($data, $super_adminQuery);
                        $super_admin = mysqli_fetch_assoc($super_adminResult);
                        if ($super_admin) {
                            foreach ($super_admin as $key => $value) {
                                $_SESSION["super_admin_" . $key] = $value;
                            }
                        }
                        // Redirect to the delivery dashboard
                        header("location:http://localhost/Group-27/app/views/superadmin/index.view.php");
                        break; 
                        
                        case "moderator":
                            // Handle Delivery Login
                            $_SESSION["email"] = $email;
                            $moderatorQuery = "SELECT * FROM moderator WHERE user_id = " . $row['user_id'];
                            $moderatorResult = mysqli_query($data, $moderatorQuery);
                            $moderator = mysqli_fetch_assoc($moderatorResult);
                            if ($moderator) {
                                foreach ($moderator as $key => $value) {
                                    $_SESSION["moderator_" . $key] = $value;
                                }
                            }
                            // Redirect to the delivery dashboard
                            header("location:http://localhost/Group-27/app/views/moderator/index.php");
                            break;

                default:
                    echo "Invalid role.";
                    break;
            }
        } else {
            // Invalid email or password
            header("location: http://localhost/Group-27/app/views/login.view.php?error=invalid_credentials");
        }
    } else {
        echo "Prepared statement errors.";
    }

    // Close prepared statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($data);
}
?>
