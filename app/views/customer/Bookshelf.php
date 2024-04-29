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
                    <?php if (empty($data['bookDetails1'])): ?>
                        <div class="B-div-noBook">
                            <p>No books added yet.</p>
                        </div>
                    <?php else: ?>
                        <?php
                        $firstFourBooks1 = array_slice($data['bookDetails1'], 0, 4);
                        foreach ($firstFourBooks1 as $bookDetails1): ?>
                            <div class="B-div">
                                <?php if ($bookDetails1->status == 'approval'): ?>
                                    <div class="approval-tag">Approved</div>
                                <?php elseif ($bookDetails1->status == 'pending'): ?>
                                    <div class="pending-tag">Pending</div>
                                <?php elseif ($bookDetails1->status == 'rejected'): ?>
                                    <div class="reject-tag">Rejected</div>
                                <?php else: ?>
                                    <div class="noDetails-tag">No result</div>
                                <?php endif; ?>
                                <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $bookDetails1->img1 . '" class="Book">'; ?>
                                <a href="<?php echo URLROOT; ?>/customer/ViewBook/<?php echo $bookDetails1->book_id; ?>"><button class="ub-dts-btn">View Details</button></a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="ub-vw">
                <a href="<?php echo URLROOT; ?>/customer/AddUsedBook"><button class="ub-vw-btn">Add a Book</button></a>
                <a href="<?php echo URLROOT; ?>/customer/UsedBooks"><button class="ub-vw-btn">View All >></button></a> <!--path changed-->
            </div>
            <br>
            <br>
            <br>
            <hr>
            <div class="exchange-books">
                <h2>Exchange Books</h2>
                <div class="books">
                    <?php if (empty($data['bookDetails2'])): ?>
                        <div class="B-div-noBook">
                            <p>No books added yet.</p>
                        </div>
                    <?php else: ?>
                        <?php
                        $firstFourBooks2 = array_slice($data['bookDetails2'], 0, 4);
                        foreach ($firstFourBooks2 as $bookDetails2): ?>
                            <div class="B-div">
                                <?php if ($bookDetails2->status == 'approval'): ?>
                                    <div class="approval-tag">Approved</div>
                                <?php elseif ($bookDetails2->status == 'pending'): ?>
                                    <div class="pending-tag">Pending</div>
                                <?php elseif ($bookDetails2->status == 'rejected'): ?>
                                    <div class="reject-tag">Rejected</div>
                                <?php else: ?>
                                    <div class="noDetails-tag">No result</div>
                                <?php endif; ?>
                                <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddExchangeBook/' .  $bookDetails2->img1 . '" class="Book">'; ?>
                                <a href="<?php echo URLROOT; ?>/customer/ViewBookExchange/<?php echo $bookDetails2->book_id; ?>"><button class="ub-dts-btn">View Details</button></a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="eb-vw">
                <a href="<?php echo URLROOT; ?>/customer/AddExchangeBook"><button class="eb-vw-btn">Add a Book</button></a>
                <a href="<?php echo URLROOT; ?>/customer/ExchangeBooks"><button class="eb-vw-btn">View All >></button></a> <!--path changed-->
            </div>
            <br>
            <br>
        </div>    
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>

