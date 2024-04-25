<?php
    foreach ($data['ExchangeBookId'] as $UsedBook):
        $title = $data['book_name'];
    endforeach;
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="exchange-detail">
        <div class="back-btn-div">
            <button class="back-btn" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>
        <div class="exchange-des">
            <div class="books-want">
                <div class="exchange-img">
                    <div class="sub1-E">
                        <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddExchangeBook/' .  $data['img1'] . '" alt="Book3" class="sub-img-excg">';?>
                    </div>
                    <div class="sub2-E">
                        <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddExchangeBook/' .  $data['img2'] . '" alt="Book3" class="sub-img-excg">';?>
                    </div>
                    <div class="sub3-E">
                        <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddExchangeBook/' .  $data['img3'] . '" alt="Book3" class="sub-img-excg">';?>
                    </div>
                </div>
                <!-- <div class="want-exchange-book">
                    <h3>Which Books I Want</h3><br>
                    <p><?php echo $data['booksIWant']; ?></p>
                </div> -->
                <?php
                    // Split the booksIWant string by commas
                    $booksIWantList = explode(',', $data['booksIWant']);

                    // Output each book in the list as a list item
                    echo '<div class="want-exchange-book">';
                    echo '<h3>Which Books I Want</h3><br>';
                    echo '<ul>'; // Start unordered list
                    foreach ($booksIWantList as $book) {
                        echo '<li>' . trim($book) . '</li>'; // Trim whitespace and display each book
                    }
                    echo '</ul>'; // End unordered list
                    echo '</div>';
                ?>
            </div>
            <div class="description-exchange">
            <h3>Description about the book</h3><br>
                <p><?php echo $data['descript']; ?></p>
            </div>
        </div>
        <div class="new-book-details">
            <div class="exchange-topic">
                <h3>Book Name : <span><?php echo $data['book_name']; ?></span></h3><br>
                <h3>Author of Book : <span><?php echo $data['author']; ?></span></h3><br>
                <h3>Book Category : <span><?php echo $data['category']; ?></span></h3><br>
                <h3>Published Year : <span><?php echo $data['published_year']; ?></span></h3><br>
                <h3>ISBN Number : <span><?php echo $data['ISBN_no']; ?></span></h3><br>
            </div>
            
            <div class="city-details-E">
                <h3>Weight (grams) : <span><?php echo $data['weight']; ?></span></h3><br>
                <h3>Condition : <span><?php echo $data['condition']; ?></span></h3><br>
                <h3>Town : <span><?php echo $data['town']; ?></span></h3><br>
                <h3>District : <span><?php echo $data['district']; ?></span></h3><br>
                <h3>Postal Code : <span><?php echo $data['postal_code']; ?></span></h3><br>
            </div>
        </div>
        <div class="sub4-E">
            <a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $data['customer_user_id']; ?>"><button class="chat-btn-Excg">Chat</button></a>
            <?php 
                $num = 0; // Initialize the variable before the loop
                if ($data['user_id']==0000){
                    $num = 0;
                }else{
                    foreach ($data['favoriteDetails'] as $favorite): 
                        if ($data['book_id'] == $favorite->item_id): 
                            $num = 1;
                            $fav_id = $favorite->fav_id;
                            break; // Assuming you want to stop the loop once a match is found
                        endif;
                    endforeach;
                }
            ?>
            <?php if ($num == 1): ?>
                <a href="<?php echo URLROOT; ?>/customer/deleteFavorite/<?php echo $fav_id; ?>">
                    <button class="book-button-after-fav chat-btn-used-fav">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                    </button>
                </a>
            <?php else: ?>
                <a href="<?php echo URLROOT; ?>/customer/addToFavoriteExchangeBooks/<?php echo $data['book_id']; ?>">
                    <button class="book-button chat-btn-used-fav">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                    </button>
                </a>
            <?php endif; ?>
        </div>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
