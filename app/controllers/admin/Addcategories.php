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

class AddCategories
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    
    public function insertCategory()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $category = $_POST['category'];
            $description = $_POST['description'];
           
            $insertQuery = "INSERT INTO category(category, description) VALUES ('$category', '$description')";
                            

            if ($this->db->execute($insertQuery)) {
                echo "Category inserted successfully!";
                
		        header("location:http://localhost/Group-27/app/views/admin/categories.view.php");

            } else {
                echo "Error: " . $this->db->getError();
            }
        }
    }
}

$addCategories = new AddCategories();
$addCategories->insertCategory();
?>
