<?php
<<<<<<< HEAD
// session_start();
    $title = "Bookshelf";
=======
    $title = "Book Shelf";
>>>>>>> 4bc30dc8051ec2d832549e065496ecc3add162fa
    include_once 'header.php';
?>

    <div class="container">
    <?php
            include_once 'sidebar.php';
        ?>
        

        <div class="book-shelf">
            <div class="used-books">
                <h2>Used Books</h2>
                <div class="books">
                <?php
                        $serverName = "localhost";
                        $dbUsername = "root";
                        $dbPassword = "";
                        $dbName = "readspots";
                        
                        
                        
                        $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);
                        
                        if (!$conn) {
                            die("Connection failed : " .mysqli_connect_error());
                        }
                        $customerId = $_SESSION['customer_id'];

                    

                         $sql = "SELECT * FROM usedbooks WHERE customer_id= $customerId";
                         $result = mysqli_query($conn, $sql);
                         $checkResults = mysqli_num_rows($result);
                         if ($checkResults > 0) {
                            while ($row = mysqli_fetch_assoc($result)){
                                $imgFront = $row['imgFront'];
                                $bookId = $row['bookId'];
                                echo '<div class="B5">
                                <img src="http://localhost/Group-27/public/assets/images/customer/'.$imgFront.'"alt="Book1" class="Book"><br>
                                <a href="./ViewBook.php?id='.$bookId.'"><button class="dts-btn">View Details</button></a>
                            </div>';
                            }
                        }
                    ?>
                    <!-- <div class="B1">
                        <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book1" class="Book"><br>
                        <button class="dts-btn">View Details</button>
                    -<!- </div>
                    <div class="B2">
                        <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book2" class="Book"><br> -->
                        <!-- <button class="dts-btn">View Details</button> -->
                    <!-- </div>
                    <div class="B3">
                        <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book3" class="Book"><br> -->
                        <!-- <button class="dts-btn">View Details</button> -->
                    <!-- </div>
                    <div class="B4">
                        <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book4" class="Book"><br> -->
                        <!-- <button class="dts-btn">View Details</button> -->
                    <!-- </div>
                    <div class="B5">
                        <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book5" class="Book"><br> -->
                        <!-- <button class="dts-btn">View Details</button> -->
                    <!-- </div> --> 
                </div>
            </div>
            <div class="vw">
                <a href="./UsedBooks.php"><button class="vw-btn">View All >></button></a>
            </div>
            <br>
            <br>
            <br>
            <hr>
            <div class="exchange-books">
                <h2>Exchange Books</h2>
                <div class="books">
                    <div class="B1">
                        <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book1" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B2">
                        <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book2" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B3">
                        <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book3" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B4">
                        <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book4" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book5" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                </div>
            </div>
            <div class="vw">
                <a href="./ExchangeBooks.php"><button class="vw-btn">View All >></button></a>
            </div>
        </div>
    </div>

<?php
    include_once 'footer.php';
?>
