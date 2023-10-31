<?php
    $title = "AddBooks";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="http://localhost/Group-27/public/assets/images/publisher/ReadSpot.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/publisher/addbookss.css">

    <title>Add Books</title>
    <style>
    .error {
        color: red;
        font-size: 0.8em;
        margin-top: 4px;
        display: block;
    }
</style>


</head>

<body>
    <div>
        <?php include 'nav.view.php';?>
        
        <div class="buttons">
            <button  id="addbooks"><a style="text-decoration:none;color:white;" href="addBooks.view.php">Add Books</a></button>
            <button  id="productgallery"><a style="text-decoration:none;color:white;" href="productGallery.view.php">Product Gallery</a></button>
        </div>
        
        <div>
            <div class="form1">
                <h2>Enter the Details of the Book</h2>
                <form action="http://localhost/Group-27/app/controllers/publisher/AddBooksController.php" method="POST">                    
                    <br>
                    <br>
                    <table class="form_cover">
                        <tbody>
                            <tr class="form_cover1">
                                <th>
                                    <label>Book Name</label><br>
                                    <input type="text" name="book_name" required>
                                </th>
                                <th>
                                    <label>ISBN no</label><br>
                                    <input type="text" name="ISBN_no" required>
                                </th>
                            </tr>
                            <tr class="form_cover1">
                                <th>
                                    <label>Author of Book</label><br>
                                    <input type="text" name="author" required>
                                </th>
                                <th>
                                    <label>Price</label><br>
                                    <input type="number" step="0.01" min="0" id="priceInput" name="price" required>
                                    <span id="priceError" class="error"></span> 
                                </th>
                            </tr>
                            <tr class="form_cover1">
                                <th>
                                    <label>Book Category</label><br>
                                    <select style="padding-right:48px;padding-left:48px;padding-top:8px;padding-bottom:8px;marging-left:250px;border-radius:7px;border:none;color:gray;" class="select" name="category" required>
                                        <option value="" selected disabled>Select Category</option>
                                        <?php
                                        $servername = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $database = 'readspots';

                                        $connection = new mysqli($servername, $username, $password, $database);

                                        if ($connection->connect_error) {
                                            die("Connection failed: " . $connection->connect_error);
                                        }

                                        $sql = "SELECT * FROM category";
                                        $result = mysqli_query($connection, $sql);

                                        if (!$result) {
                                            die("Invalid query: " . $connection->error);
                                        }

                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row['category'] . '">' . $row['category'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <label>Weight</label><br>
                                    <input type="number" step="0.01" min="0" id="weightInput" placeholder="Approximate weight of the book" name="weight" required> 
                                    <span id="weightError" class="error"></span>
                                    <br>
                                    <button class="calc" id="weightCal">
                                        <a href="https://www.bookmobile.com/book-weight-calculator/">Weight Calculator</a>
                                    </button>
                                </th>
                            </tr>
                            <tr class="form_cover1">
                                <th>
                                    <label>Description</label><br><br>
                                    <input type="text" placeholder="Briefly describe about the content" name="descript">
                                </th>
                                <th>
                                <label>Quantity</label><br><br>
                                <input type="number" step="1" min="0" id="quantityInput" placeholder="No of Books in your stock" name="quantity" required>
                                <span id="quantityError" class="error"></span>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                   
                    <br>
                    <table class="form_cover">
                        <tbody>
                            <tr class="pdfUpload">
                                <th>
                                    <label>Upload two Clear images (Cover Page & Inside Paper)</label><br><br>
                                    <input type="file" id="pdfUpload1" name="img1" required>
                                    <input type="file" id="pdfUpload2" name="img2" required>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    
                    <input class="submit-button" type="submit" placeholder="Submit" name="submit">
                </form>
            </div>
        </div>
        <?php include 'footer.view.php'; ?>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceInput = document.getElementById('priceInput');
        const quantityInput = document.getElementById('quantityInput');
        const weightInput = document.getElementById('weightInput');

        priceInput.addEventListener('input', function() {
            const priceError = document.getElementById('priceError');
            if (priceInput.value < 0) {
                priceError.textContent = 'Price should be a positive value';
            } else {
                priceError.textContent = '';
            }
        });

        quantityInput.addEventListener('input', function() {
            const quantityError = document.getElementById('quantityError');
            if (quantityInput.value < 0) {
                quantityError.textContent = 'Quantity should be a positive value';
            } else {
                quantityError.textContent = '';
            }
        });

        weightInput.addEventListener('input', function() {
            const weightError = document.getElementById('weightError');
            if (weightInput.value < 0) {
                weightError.textContent = 'Weight should be a positive value';
            } else {
                weightError.textContent = '';
            }
        });
    });
</script>

</body>

</html>
