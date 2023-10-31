<?php

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

    public function displayProductGallery() {
        // Get the publisher ID from the session
        $publisherId = $_SESSION['publisher_id'];

        // Fetch books for the logged-in publisher
        $query = "SELECT * FROM Books WHERE publisher_id = $publisherId";
        $result = $this->db->execute($query);


        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<th>" . $row['book_id'] . "</th>";
                echo "<th>" . $row['quantity'] . "</th>";
                echo "<th>" . $row['descript'] . "</th>";
                echo "<th>" . $row['price'] . "</th>";                
                
                echo "<th><a href='../../views/publisher/update.view.php?book_id=" . $row['book_id'] . "'><i class='fa fa-edit' style='color:black;'></i></a></th>";

                echo "<th><a href='../../controllers/publisher/Delete.php?book_id=" . $row['book_id'] . "'><i class='fa fa-trash' style='color:black;'></i></a></th>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
    }
}
