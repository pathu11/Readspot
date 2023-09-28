<?php
include '../config/connect.php';

$id = $price = $descript = $quantity = "";
$error = $success = "";

// Fetch existing values based on ID
if ($_SERVER["REQUEST_METHOD"] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM addbook_publisher WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($book) {
        // Assign existing values to variables
        $price = $book['price'];
        $descript = $book['descript'];
        $quantity = $book['quantity'];
    } else {
        $error = "Book not found.";
    }
}
// Update book details
if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['update'])) {
    $id = $_POST["id"];
    $price = $_POST["price"];
    $descript = $_POST["descript"];
    $quantity = $_POST["quantity"];

    $sql = "UPDATE addbook_publisher SET price=:price, descript=:descript, quantity=:quantity WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':descript', $descript);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $success = "Book details updated successfully.";
        header('location:productGallery.php');
    } else {
        $error = "Error updating book details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="addbooks.css">

    <title>Update Books</title>
</head>

<body>
    <div>
        <?php include 'nav.php';?>
        
        <div class="buttons">
            <button id="addbooks"><a style="text-decoration:none;color:white;" href="addbooks.php">Add Books</a></button>
            <button id="productgallery"><a style="text-decoration:none;color:white;" href="productGallery.php">Product Gallery</a></button>
        </div>

        <div style="margin-bottom:180px;">
            <div class="form1">
                <h2>Edit the details of a Book</h2>
                <form action="edit_addbook.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <br>
                    <table class="form_cover">
                        <tbody>
                            <tr class="form_cover1">
                                <th>
                                    <label>Price</label>       
                                </th>
                                <th>
                                    <input type="number" step="0.01" min="0" id="priceInput" name="price" value="<?php echo $price; ?>">
                                </th>
                            </tr>
                            <tr class="form_cover1">
                                <th>
                                    <label for="descript">Description</label>
                                    
                                </th>
                                <th>
                                    <input type="text" name="descript" value="<?php echo $descript; ?>"><br>
                                </th>
                            </tr>
                            <tr class="form_cover1">
                                <th>
                                    <label for="quantity">Quantity</label>
                                    
                                </th>
                                <th>
                                    <input type="number" name="quantity" value="<?php echo $quantity; ?>"><br>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <input class="submit-button" type="submit" placeholder="Update" name="update">
                </form>
                <?php
                    // Display success or error messages
                    if ($success) {
                        echo '<div class="success-message">' . $success . '</div>';
                    } elseif ($error) {
                        echo '<div class="error-message">' . $error . '</div>';
                    }
                ?>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</body>

</html>
