<!-- update.view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/publisher/update.css">
    <title>Update Book Information</title>
</head>
<body>
    <?php include 'nav.view.php'; ?>
    <h2>Update Book Information</h2>
    <form action="../../controllers/publisher/UpdateBook.php" method="post">
        <?php
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "readspots";

        $conn = new mysqli($host, $user, $password, $db);

        if ($conn->connect_error) {
            die("Connection error: " . $conn->connect_error);
        }

        $bookId = $_GET['book_id']; // Assuming the book ID is passed via GET parameter

        $query = "SELECT price, descript, quantity FROM Books WHERE book_id = $bookId";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $bookPrice = $row['price'];
            $bookDescript = $row['descript'];
            $bookQuantity = $row['quantity'];
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>

        <label for="price">New Price:</label>
        <input type="text" id="price" name="price" value="<?php echo $bookPrice; ?>" required><br><br>
        
        <label for="descript">New Description:</label>
        <input type="text" id="descript" name="descript" value="<?php echo $bookDescript; ?>" required><br><br>
        
        <label for="quantity">New Quantity:</label>
        <input type="text" id="quantity" name="quantity" value="<?php echo $bookQuantity; ?>" required><br><br>
        
        <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
        
        <input type="submit" value="Update Book">
    </form>
</body>
</html>
