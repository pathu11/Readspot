<?php
    // session_start();
    $title = "My Used Books";
    require APPROOT . '/views/customer/header.php';
    // $serverName = "localhost";
    // $dbUsername = "root";
    // $dbPassword = "";
    // $dbName = "readspots";



    // $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

    // if (!$conn) {
    //     die("Connection failed : " .mysqli_connect_error());
    // }
    // include_once 'http://localhost/Group-27/app/controllers/customer/dbh.inc.php';
?>

    <?php
        require APPROOT . '/views/customer/sidebar.php';
    ?>
    <div class="container">
        <div class="book-shelf">
            <div class="used-books">
                <h2>Used Books</h2>
                <form action="#.php" class="search">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button>
                </form>
                <br>
                <br>
                <div class="books">
                    <?php foreach($data['bookDetails'] as $bookDetails): ?>
                        <div class="B5">
                            <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $bookDetails->imgFront . '" class="Book"><br>';?>
                            <a href="<?php echo URLROOT; ?>/customer/ViewBook/<?php echo $bookDetails->bookId; ?>"><button class="dts-btn">View Details</button></a>
                        </div>
                    <?php endforeach; ?>

                         
                   
                </div>
                <div class="vw">
                    <a href="<?php echo URLROOT; ?>/customer/AddUsedBook"><button class="vw-btn">Add a Book</button></a>
                </div>
                <br>
                <br>
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php';
        ?>
    </div>
