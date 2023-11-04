<?php
    // session_start();
    $title = "Bookshelf";
    include_once 'header.php';
    $serverName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "readspots";



    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        die("Connection failed : " .mysqli_connect_error());
    }
    // include_once 'http://localhost/Group-27/app/controllers/customer/dbh.inc.php';
?>

    <div class="container">
        <?php
            include_once 'sidebar.php';
        ?>

        <div class="book-shelf">
            <div class="used-books">
                <h2>Used Books</h2>
                <form action="#.php" class="search">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="http://localhost/Group-27/public/assets/images/customer/search.png"></button>
                </form>
                <br>
                <br>
                <div class="books">

                    <?php
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
                   
                </div>
                <div class="vw">
                    <a href="./AddUsedBook.php"><button class="vw-btn">Add a Book</button></a>
                </div>
            </div>
        </div>
    </div>

<?php
    include_once 'footer.php';
?>
