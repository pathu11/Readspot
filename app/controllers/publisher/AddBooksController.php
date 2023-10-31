<?php
session_start();
class Database {
    protected $conn;

    public function __construct() {
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "readspots";

        $this->conn = new mysqli($host, $user, $password, $db);

        if ($this->conn->connect_error) {
            die("Connection error: " . $this->conn->connect_error);
        }
    }

    public function execute($query) {
        return $this->conn->query($query);
    }

    public function getError() {
        return $this->conn->error;
    }
}

class AddBooksController {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
    
    public function insertBook() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Fetching other form data
            $bookName = $_POST['book_name'];
            $ISBN = $_POST['ISBN_no'];
            $author = $_POST['author'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $weight = $_POST['weight'];
            $description = $_POST['descript'];
            $quantity = $_POST['quantity'];
            $publisherId = $_SESSION['publisher_id']; // Replace this with the actual publisher ID
            $img1Name = $_POST['img1'];
            $img2Name = $_POST['img2'];
            
            // File handling
            // $img1Name = $_FILES['img1']['name'];
            // $img1FileType = $_FILES['img1']['type'];
            // $img2Name = $_FILES['img2']['name'];
            // $img2FileType = $_FILES['img2']['type'];

            // // Check if it's an image type
            // $allowedImageTypes = array('image/jpg');
            
            // if (in_array($img1FileType, $allowedImageTypes) && in_array($img2FileType, $allowedImageTypes)) {
            //     // File handling
            //     $img1 = addslashes(file_get_contents($_FILES['img1']['tmp_name']));
            //     $img2 = addslashes(file_get_contents($_FILES['img2']['tmp_name']));

            //     // Rest of the insertion logic...
            // } else {
            //     echo "Sorry, only JPG files are allowed to upload.";
            // }

            $insertQuery = "INSERT INTO Books 
                            (book_name, ISBN_no, author, price, category, weight, descript, quantity, img1, img2, publisher_id) 
                            VALUES 
                            ('$bookName', '$ISBN', '$author', $price, '$category', '$weight', '$description', $quantity, '$img1', '$img2', '$publisherId')";

            if ($this->db->execute($insertQuery)) {
                echo "Book inserted successfully!";
                header("location:http://localhost/Group-27/app/views/publisher/productGallery.view.php");
            } else {
                echo "Error: " . $this->db->getError();
            }
        }
    }
}

$addBooksController = new AddBooksController();
$addBooksController->insertBook();
