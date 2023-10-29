<?php

/**
 * AddBooks class
 */
require_once '../../core/Controller.php';
class AddBooks
{
	use Controller;
    protected $data;

    public function __construct()
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "readspots";

        $this->data = mysqli_connect($host, $user, $password, $db);

        if ($this->data === false) {
            die("Connection error: " . mysqli_connect_error());
        }
    }

    public function index()
    {
        $this->viewpub('addBooks');
    }

    public function addBook()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Process form data
            $bookName = $_POST['book_name'];
            $ISBN = $_POST['ISBN_no'];
            // ... Other form field processing
            
            // Example: Inserting data into the Books table
            $insertQuery = "INSERT INTO Books (book_name, ISBN_no) VALUES ('$bookName', '$ISBN')";
            $insertResult = mysqli_query($this->data, $insertQuery);

            if ($insertResult) {
                echo "Book inserted successfully!";
            } else {
                echo "Error: " . mysqli_error($this->data);
            }
        }
    }
}
