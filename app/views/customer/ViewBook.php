<?php
    foreach ($data['UsedBookId'] as $UsedBook):
        $title = $data['book_name'];
    endforeach;
    require APPROOT . '/views/customer/header.php';
?>

    <div class="main-detail">
            <div class="sub1">
                <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $data['img1'] . '" alt="Book3" class="main-img">';?>
            </div>
            <div class="sub2">
                <h3>Book Name : <span><?php echo $data['book_name']; ?></span></h3><br>
                <h3>Author of Book : <span><?php echo $data['author']; ?></span></h3><br>
                <h3>Book Category : <span><?php echo $data['category']; ?></span></h3><br>
                <h3>Condition : <span><?php echo $data['condition']; ?></span></h3><br>
                <h3>Published Year : <span><?php echo $data['published_year']; ?></span></h3><br>
                <h3>Price : <span><?php echo $data['price']; ?></span></h3><br>
                <h3>Price Type : <span><?php echo $data['price_type']; ?></span></h3><br>
                <h3>Weight (grams) : <span><?php echo $data['weight']; ?></span></h3><br>
                <h3>ISBN Number : <span><?php echo $data['ISBN_no']; ?></span></h3>
                <!-- <h3>ISSN Number : <span></span></h3><br>
                <h3>ISMN Number : <span></span></h3> -->
            </div>
            <div class="sub3">
                <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $data['img1'] . '" alt="Book3" class="sub-img">';?>
            </div>
            <div class="sub4">
                <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $data['img2'] . '" alt="Book3" class="sub-img">';?>
            </div>
            <div class="sub5">
                <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $data['img3'] . '" alt="Book3" class="sub-img">';?>
            </div>
            <div class="sub6">
                <h3>Description about the book</h3><br>
                <p><?php echo $data['descript']; ?></p>

            </div>
            <div class="sub7">
                <h3>Town : <span><?php echo $data['town']; ?></span></h3><br>
                <h3>District : <span><?php echo $data['district']; ?></span></h3><br>
                <h3>Postal Code : <span><?php echo $data['postal_code']; ?></span></h3><br>
            </div>
            <div class="sub8">
                <a href="<?php echo URLROOT; ?>/customer/deleteusedbook/<?php echo $data['book_id']; ?>"><button class="chat-dlt-btn">Delete</button></a>
                <a href="<?php echo URLROOT; ?>/customer/updateusedbook/<?php echo $data['book_id']; ?>"><button class="chat-btn">Edit</button></a>
            </div>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php';
?>
