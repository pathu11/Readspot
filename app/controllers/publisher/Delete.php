<?php
// deleteBook.php

// Check if book_id is set and if the ID is a valid integer
// if (isset($_GET['book_id']) && filter_var($_GET['book_id'], FILTER_VALIDATE_INT)) {
//     $bookId = $_GET['book_id'];

    // Connect to the database
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "readspots";

    $conn = new mysqli($host, $user, $password, $db);

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

//     // Execute the SQL DELETE query to remove the selected book
//     $deleteQuery = "DELETE FROM Books WHERE book_id = $bookId";

//     if ($conn->query($deleteQuery) === TRUE) {
//         // Book deleted successfully, redirect back to the product gallery or any other page
//         header("Location:http://localhost/Group-27/app/views/publisher/productGallery.php");
//         exit;
//     } else {
//         echo "Error deleting book: " . $conn->error;
//     }

//     // Close the database connection
//     $conn->close();
// } else {
//     echo "Invalid book ID or ID not provided";
// }

if (isset($_GET['book_id']) && filter_var($_GET['book_id'], FILTER_VALIDATE_INT)) {
    $bookId = $_GET['book_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Delete Book Confirmation</title>
</head>

<body>
    <script>
        if (confirm('Are you sure you want to delete this book?')) {
            window.location.href = 'confirmdelete.php?book_id=<?php echo $bookId; ?>';
        } else {
            window.location.href = 'http://localhost/Group-27/app/views/publisher/productGallery.view.php';
        }
    </script>
</body>

</html>

<?php
} else {
    echo "Invalid book ID or ID not provided";
}
?>
?>
