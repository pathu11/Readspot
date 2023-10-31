<?php
// UpdateBook.php

if (
    isset($_POST['book_id'], $_POST['price'], $_POST['descript'], $_POST['quantity']) &&
    filter_var($_POST['book_id'], FILTER_VALIDATE_INT)
) {
    $bookId = $_POST['book_id'];
    $newPrice = $_POST['price'];
    $newDescription = $_POST['descript'];
    $newQuantity = $_POST['quantity'];

    // Database connection and update query
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "readspots";

    $conn = new mysqli($host, $user, $password, $db);

    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    // Prepare and execute the SQL UPDATE query
    $updateQuery = "UPDATE Books SET price = ?, descript = ?, quantity = ? WHERE book_id = ?";
    $stmt = $conn->prepare($updateQuery);

    // Bind the parameters and execute the query
    $stmt->bind_param("dsii", $newPrice, $newDescription, $newQuantity, $bookId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Book updated successfully
        header("Location: http://localhost/Group-27/app/views/publisher/productGallery.view.php");
        exit;
    } else {
        echo "Error updating book: " . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid input data or book ID not provided";
}
?>
