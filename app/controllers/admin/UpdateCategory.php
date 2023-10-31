<?php
if (isset($_POST['category'], $_POST['description'], $_POST['category_id']) &&
    filter_var($_POST['category_id'], FILTER_VALIDATE_INT)) {
    $category_id = $_POST['category_id'];
    $category = $_POST['category'];
    $description = $_POST['description'];

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
    $updateQuery = "UPDATE category SET category = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);

    // Bind the parameters and execute the query
    $stmt->bind_param('ssi', $category, $description, $category_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Category updated successfully
        header("Location: http://localhost/Group-27/app/views/admin/categories.view.php");
        exit;
    } else {
        echo "Error updating category: " . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid input data or category ID not provided";
}
?>
