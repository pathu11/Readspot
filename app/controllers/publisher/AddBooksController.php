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

class AddBooksController
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    

    public function insertBook()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $bookName = $_POST['book_name'];
            $ISBN = $_POST['ISBN_no'];
            $author = $_POST['author'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $weight = $_POST['weight'];
            $description = $_POST['descript'];
            $quantity = $_POST['quantity'];
            $publisherId = $_SESSION['publisher_id'];// Replace this with the actual publisher ID

            $insertQuery = "INSERT INTO Books (book_name, ISBN_no, author, price, category, weight, descript, quantity, publisher_id) 
                            VALUES ('$bookName', '$ISBN', '$author', $price, '$category', '$weight', '$description', $quantity, $publisherId)";

            if ($this->db->execute($insertQuery)) {
                echo "Book inserted successfully!";
                // $bookQuery = "SELECT * FROM Books WHERE user_id = " . $row['user_id'];
                // $bookResult = mysqli_query($data, $bookQuery);
                // $book = mysqli_fetch_assoc($bookResult);

                // if ($book) {
                //     foreach ($book as $key => $value) {
                //         $_SESSION["book_" . $key] = $value;
                //     }

                // }
		
		        header("location:http://localhost/Group-27/app/views/publisher/productGallery.view.php");

            } else {
                echo "Error: " . $this->db->getError();
            }
        }
    }
}

$addBooksController = new AddBooksController();
$addBooksController->insertBook();
