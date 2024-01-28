<?php
    $title = "Buy Used Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="back-btn-div01">
            <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>
        <div class="sub-cont-U1">
            <div class="Used-books">
                <h1>USED BOOKS</h1>
            </div>
            <div class="search-bar-U">
                <button type="submit" class="filter-btn-U" onclick="toggleDropdownfilter('filter-dropdown')">Filter</button>
                <form action="#.php" class="searching-U">
                    <select id="searchBy"  name="category">
                        <option value="technology">Title</option>
                        <option value="travel">Author</option>
                        <option value="food">ISBN</option>
                        <option value="lifestyle">Publisher</option>
                    </select>
                    <input type="text" placeholder="Search.." name="search-U">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> <!--path changed-->
                </form>
            </div>
        </div>
        <div class="sub-cont-U2">
            <?php foreach($data['bookDetails'] as $bookDetails): ?>
                <a href="<?php echo URLROOT; ?>/customer/UsedBookDetails/<?php echo $bookDetails->book_id; ?>"><div class="B0-U">
                <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $bookDetails->img1 . '" class="Book-U"><br>';?>
                    <h3>End Game</h3>
                    <h3>500/=</h3>
                    <h5>(<?php echo $bookDetails->price_type; ?>)</h5>
                    <div class="fav-cart-msg">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/mycart.png" alt="cart">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/chat.png" alt="chat">
                    </div>
                </div></a>
            <?php endforeach; ?>
        </div>
        <?php
            require APPROOT . '/views/customer/filterbook.php'; //path changed
        ?>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
