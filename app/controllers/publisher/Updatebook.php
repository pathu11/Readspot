<?php
if (
    isset($_POST['book_id'], $_POST['book_name'], $_POST['ISBN_no'], $_POST['author'], $_POST['price'], $_POST['category'], $_POST['weight'], $_POST['descript'], $_POST['quantity'], $_POST['img1'], $_POST['img2']) &&
    filter_var($_POST['book_id'], FILTER_VALIDATE_INT)
) {
    $bookId = $_POST['book_id'];
    $bookName = $_POST['book_name'];
    $ISBN = $_POST['ISBN_no'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $weight = $_POST['weight'];
    $descript = $_POST['descript'];
    $quantity = $_POST['quantity'];
    $img1Name = $_POST['img1']; // Note: This assumes file uploads are handled separately
    $img2Name = $_POST['img2']; // Note: This assumes file uploads are handled separately

    // Database connection
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "readspots";

    $conn = new mysqli($host, $user, $password, $db);

    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    // Prepare and execute the SQL UPDATE query
    $updateQuery = "UPDATE Books SET book_name = ?, ISBN_no = ?, author = ?, price = ?, category = ?, weight = ?, descript = ?, quantity = ?, img1 = ?, img2 = ? WHERE book_id = ?";
    $stmt = $conn->prepare($updateQuery);

    // Bind parameters and execute the query
    $stmt->bind_param("sssdsisissi", $bookName, $ISBN, $author, $price, $category, $weight, $descript, $quantity, $img1Name, $img2Name, $bookId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Book updated successfully, redirect to the desired page
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
