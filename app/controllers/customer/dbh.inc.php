<?php
// $serverName = "localhost";
// $dbUsername = "readspot123";
// $dbPassword = "tNa65OlbRzKRcl8d";
// $dbName = "readspot_login";
// $serverName = "localhost";
// $dbUsername = "readspot222";
// $dbPassword = "lW9NE214KBiz0Lm5";
// $dbName = "customers";

// $serverName = "localhost";
// $dbUsername = "readspot01";
// $dbPassword = "yh0H5F8um5N4ZiTg";
// $dbName = "readspot_login";

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "readspots";



$conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed : " .mysqli_connect_error());
}
// else {
//     echo "it's working";
// }