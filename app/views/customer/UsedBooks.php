<?php
    $title = "My Used Books";
    require APPROOT . '/views/customer/header.php';
?>

    <?php
        require APPROOT . '/views/customer/sidebar.php';
    ?>
    <div class="container">
        <div class="book-shelf">
            <div class="used-books">
                <h2>Used Books</h2>
                <form action="#.php" class="mybook-search">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button>
                </form>
                <br>
                <br>
                <div class="books">
                    <?php foreach($data['bookDetails'] as $bookDetails): ?>
                        <div class="B-div">
                            <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $bookDetails->img1 . '" class="Book"><br>';?>
                            <a href="<?php echo URLROOT; ?>/customer/ViewBook/<?php echo $bookDetails->book_id; ?>"><button class="ub-dts-btn">View Details</button></a>
                        </div>
                    <?php endforeach; ?>

                         
                   
                </div>
                <div class="ub-vw">
                    <a href="<?php echo URLROOT; ?>/customer/AddUsedBook"><button class="ub-vw-btn">Add a Book</button></a>
                </div>
                <br>
                <br>
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php';
        ?>
    </div>
