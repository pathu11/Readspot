<?php
    $title = "Book Shelf";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="book-shelf">
            <div class="used-books">
                <h2>Used Books</h2>
                <div class="books">
                    <?php foreach($data['bookDetails'] as $bookDetails): ?>
                        <div class="B-div">
                            <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $bookDetails->img1 . '" class="Book"><br>';?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="ub-vw">
                <a href="<?php echo URLROOT; ?>/customer/UsedBooks"><button class="ub-vw-btn">View All >></button></a> <!--path changed-->
            </div>
            <br>
            <br>
            <br>
            <hr>
            <div class="exchange-books">
                <h2>Exchange Books</h2>
                <div class="books">
                    <div class="B-div">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B-div">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book2" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B-div">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book3" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B-div">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book4" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B-div">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book5" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                </div>
            </div>
            <div class="eb-vw">
                <a href="<?php echo URLROOT; ?>/customer/ExchangeBooks"><button class="eb-vw-btn">View All >></button></a> <!--path changed-->
            </div>
            <br>
            <br>
        </div>    
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>

