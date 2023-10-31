<?php
// session_start();
// class Database {
//     protected $conn;

//     public function __construct() {
//         $host = "localhost";
//         $user = "root";
//         $password = "";
//         $db = "readspots";

//         $this->conn = new mysqli($host, $user, $password, $db);

//         if ($this->conn->connect_error) {
//             die("Connection error: " . $this->conn->connect_error);
//         }
//     }

//     public function execute($query) {
//         return $this->conn->query($query);
//     }

//     public function getError() {
//         return $this->conn->error;
//     }
// }

// class AddExchangedookController
// {
//     protected $db;

//     public function __construct()
//     {
//         $this->db = new Database();
//     }
    

//     public function insertBook()
//     {
//         if ($_SERVER["REQUEST_METHOD"] === "POST") {
//             $book_name = $_POST['book_name'];
//             $author_name = $_POST['author_name'];
//             $category = $_POST['book_category'];
//             $book_condition = $_POST['book_condition'];
//             $published_date = $_POST['published_date'];
//             $weight_grams = $_POST['weight_grams'];

//             $isbn_number = $_POST['isbn_number'];
//             $issn_number = $_POST['issn_number'];
//             $ismn_number = $_POST['ismn_number'];
//             $description = $_POST['description'];           
//             $town = $_POST['town'];
//             $district = $_POST['district'];
//             $postal_code = $_POST['postal_code'];
//             $front_page_img = $_POST['front_page_img'];
//             $back_page_img = $_POST['back_page_img'];
//             $inside_page_img = $_POST['inside_page_img'];
//             $customer_id = $_SESSION['customer_id'];// Replace this with the actual publisher ID

//             $insertBook = $conn->prepare("INSERT INTO books (customer_id, book_name, author_name, book_category, book_condition, published_date, weight_grams, isbn_number, issn_number, ismn_number, description, town, district, postal_code, front_page_img, back_page_img, inside_page_img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
// // $insertBook->bind_param("isssssissssssssss", $customer_id, $book_name, $author_name, $book_category, $book_condition, $published_date, $weight_grams, $isbn_number, $issn_number, $ismn_number, $description, $town, $district, $postal_code, $front_page_img, $back_page_img, $inside_page_img);


//             if ($this->db->execute($insertBook)) {
//                 echo "Book inserted successfully!";
                
// 		        header("location:http://localhost/Group-27/app/views/publisher/productGallery.view.php");

//             } else {
//                 echo "Error: " . $this->db->getError();
//             }
//         }
//     }
// }

// $addExchangedbookController = new AddExchangedbookController();
// $addExchangedbookController->insertBook();



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

class AddExchangedbookController {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insertBook() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $book_name = $_POST['book_name'];
            $author_name = $_POST['author_name'];
            $book_category = $_POST['book_category'];
            $book_condition = $_POST['book_condition'];
            $published_date = $_POST['published_date'];
            $weight_grams = $_POST['weight_grams'];

            $isbn_number = $_POST['isbn_number'];
            $issn_number = $_POST['issn_number'];
            $ismn_number = $_POST['ismn_number'];
            $description1 = $_POST['description1'];
            $description2 = $_POST['description2'];           
           
            $front_page_img = $_POST['front_page_img'];
            $back_page_img = $_POST['back_page_img'];
            $inside_page_img = $_POST['inside_page_img'];
            $town = $_POST['town'];
            $district = $_POST['district'];
            $postal_code = $_POST['postal_code'];
            // ... Your code to retrieve POST data

            $customer_id = $_SESSION['customer_id']; // Replace this with the actual publisher ID

            $insertBook = $this->db->conn->prepare("INSERT INTO books (customer_id, book_name, author_name, book_category, book_condition, published_date, weight_grams, isbn_number, issn_number, ismn_number, description1,description2, front_page_img, back_page_img, inside_page_img,town, district, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $insertBook->bind_param("isssssisssssssssss", $customer_id, $book_name, $author_name, $book_category, $book_condition, $published_date, $weight_grams, $isbn_number, $issn_number, $ismn_number, $description1, $description2, $front_page_img, $back_page_img, $inside_page_img,$town, $district, $postal_code);
            $insertBook->execute();

            if ($insertBook->execute()) {
                echo "Book inserted successfully!";
                // header("location:http://localhost/Group-27/app/views/publisher/productGallery.view.php");
            } else {
                echo "Error: " . $this->db->getError();
            }
        }
    }
}

$addExchangedbookController = new AddExchangedbookController();
$addExchangedbookController->insertBook();

