<?php
    $title = "Book Shelf";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="container">
        <?php
            require APPROOT . '/views/customer/sidebar.php'; //path changed
        ?>

        <div class="book-shelf">
            <div class="used-books">
                <h2>Used Books</h2>
                <div class="books">
                    <div class="B1">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B2">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book2" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B3">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book3" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B4">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book4" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book5" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                </div>
            </div>
            <div class="vw">
                <a href="<?php echo URLROOT; ?>/customer/UsedBooks"><button class="vw-btn">View All >></button></a> <!--path changed-->
            </div>
            <br>
            <br>
            <br>
            <hr>
            <div class="exchange-books">
                <h2>Exchange Books</h2>
                <div class="books">
                    <div class="B1">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B2">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book2" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B3">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book3" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B4">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book4" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book5" class="Book"><br> <!--path changed-->
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                </div>
            </div>
            <div class="vw">
                <a href="<?php echo URLROOT; ?>/customer/ExchangeBooks"><button class="vw-btn">View All >></button></a> <!--path changed-->
            </div>
        </div>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
