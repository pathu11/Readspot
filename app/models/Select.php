<?php
session_start();

include_once '../core/Database.php'; // Path to your Database.php file

class Select
{
    use Database;

    public function getUserRole($userRole)
    {
        // Assuming this function retrieves user data based on the role
        $query = "SELECT * FROM users WHERE user_role = :userRole";
        $result = $this->get_row($query, [':userRole' => $userRole]);

        return $result;
    }
}

$data = new Select();

if (isset($_SESSION['notification'])) {
    echo $_SESSION['notification'];
    unset($_SESSION['notification']); // Remove the notification from the session
}

if (isset($_GET["user_role"])) {
    $userRole = $_GET["user_role"];
    $_SESSION['user_role'] = $userRole;

    if ($userRole === 'customer') {
        // Redirect to the respective view based on user selection
        header("Location: http://localhost/Group-27/app/views/signupCustomer.view.php");
        exit; // Ensure that the script stops here
    } elseif ($userRole === 'publisher') {
        // Process the retrieved user data as needed
        $result = $data->getUserRole($userRole);

        // Redirect to the respective view based on user selection
        header("Location: http://localhost/Group-27/app/views/signupPub.view.php");
        exit; // Ensure that the script stops here
    } else {
        echo "User not found";
    }
}
?>
