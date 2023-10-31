<?php
class Signup extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $user->insertUser($email, $password, 'publisher'); // Calls the method to insert a user

            header("Location: " . ROOT . "/login.view.php"); // Redirect to login after registration
            exit;
        }

        // Load your view file
        require_once 'http://localhost/Group-27/app/views/signup.view.php';
    }
}
?>
