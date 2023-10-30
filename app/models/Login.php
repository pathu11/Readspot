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

    $sql = "SELECT * FROM users WHERE email='" . $email . "' AND pass='" . $password . "' ";
    $result = mysqli_query($data, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        if ($row["user_role"] == "customer") {
            $_SESSION["email"] = $email;
            header("location:http://localhost/Group-27/app/views/home.view.php");
        } elseif ($row["user_role"] == "publisher") {
            $_SESSION["email"] = $email;
            $publisherQuery = "SELECT * FROM Publishers WHERE user_id = " . $row['user_id'];
            $publisherResult = mysqli_query($data, $publisherQuery);
            $publisher = mysqli_fetch_assoc($publisherResult);
            if ($publisher) {
                foreach ($publisher as $key => $value) {
                    $_SESSION["publisher_" . $key] = $value;
                }
            }
            header("location:http://localhost/Group-27/app/views/publisher/home.view.php");
        } elseif ($row["user_role"] == "admin") {
            $_SESSION["email"] = $email;
            $adminQuery = "SELECT * FROM admin WHERE user_id = " . $row['user_id'];
            $adminResult = mysqli_query($data, $adminQuery);
            $admin = mysqli_fetch_assoc($adminResult);
            if ($admin) {
                foreach ($admin as $key => $value) {
                    $_SESSION["admin_" . $key] = $value;
                }
            }
            header("location:http://localhost/Group-27/app/views/admin/index.view.php");
        } elseif ($row["user_role"] == "deliver") {
            $_SESSION["email"] = $email;
            $deliveryQuery = "SELECT * FROM delivery WHERE user_id = " . $row['user_id'];
            $deliveryResult = mysqli_query($data, $deliveryQuery);
            $delivery = mysqli_fetch_assoc($deliveryResult);
            if ($delivery) {
                foreach ($delivery as $key => $value) {
                    $_SESSION["delivery_" . $key] = $value;
                }
            }
            header("location:http://localhost/Group-27/app/views/delivery/home.view.php");
        }
    } else {
		echo "invalid";
        header("location: http://localhost/Group-27/app/views/login.view.php?error=invalid_credentials");
    }
}
