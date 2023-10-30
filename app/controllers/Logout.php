<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to a login page or any other page after logging out
header("Location: http://localhost/Group-27/app/views/login.view.php");
exit;
?>
