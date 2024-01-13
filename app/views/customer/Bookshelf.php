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
                    <?php
                        $firstFourBooks1 = array_slice($data['bookDetails1'], 0, 4);
                        foreach($firstFourBooks1 as $bookDetails1): ?>
                        <div class="B-div">
                            <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $bookDetails1->img1 . '" class="Book"><br>';?>
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
                    <?php
                        $firstFourBooks2 = array_slice($data['bookDetails2'], 0, 4);
                        foreach($firstFourBooks2 as $bookDetails2): ?>
                        <div class="B-div">
                            <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $bookDetails2->img1 . '" class="Book"><br>';?>
                        </div>
                    <?php endforeach; ?>
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

