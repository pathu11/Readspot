<?php
    $title = "My Used Books";
    require APPROOT . '/views/customer/header.php';
?>

    <?php
        require APPROOT . '/views/customer/sidebar.php';
    ?>
    <div class="container">
        <div class="book-shelf">
            <div class="back-btn-div">
                <button class="back-btn" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
            </div>
            <div class="used-books">
                <h2>Used Books</h2>
                <!-- <form action="#.php" class="mybook-search">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button>
                </form>
                <br>
                <br> -->
                <div class="books">
                    <?php if (empty($data['bookDetails'])): ?>
                        <div class="B-div-noBook">
                            <p>No books added yet.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($data['bookDetails'] as $bookDetails): ?>
                            <div class="B-div">
                                <?php if ($bookDetails->status == 'approval'): ?>
                                    <div class="approval-tag">Approved</div>
                                <?php elseif ($bookDetails->status == 'pending'): ?>
                                    <div class="pending-tag">Pending</div>
                                <?php elseif ($bookDetails->status == 'rejected'): ?>
                                    <div class="reject-tag">Rejected</div>
                                <?php else: ?>
                                    <div class="noDetails-tag">No result</div>
                                <?php endif; ?>
                                <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $bookDetails->img1 . '" class="Book">'; ?>
                                <a href="<?php echo URLROOT; ?>/customer/ViewBook/<?php echo $bookDetails->book_id; ?>"><button class="ub-dts-btn">View Details</button></a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>                   
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
