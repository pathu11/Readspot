<?php
    $title = "Exchange Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="back-btn-div01">
            <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>
        <div class="sub-cont-E1">
            <div class="Exchange-books">
                <h1>EXCHANGE BOOKS</h2>
            </div>
            <div class="search-bar-E">
                <!-- <button type="submit" class="filter-btn-E" onclick="toggleDropdownfilter('filter-dropdown')">Filter</button> -->
                <div class="search-form-E">
                    <form action="<?php echo URLROOT;?>/customer/filterbook" class="searching-E" method="post">
                        <!-- <select id="searchBy"  name="category">
                            <option value="technology">Title</option>
                            <option value="travel">Author</option>
                            <option value="food">ISBN</option>
                            <option value="lifestyle">Publisher</option>
                        </select> -->
                        <input type="text" placeholder="Search by Name, Publisher, Author or ISBN.." name="search-E">
                        <!-- <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> path changed -->
                    </form>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                </div>
                <div class="filter-category">
                    <div class="list-group-E" id="show-list">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-cont-E2">
            <?php foreach($data['bookDetails'] as $bookDetails): ?>
                <a href="<?php echo URLROOT; ?>/customer/ExchangeBookDetails/<?php echo $bookDetails->book_id; ?>"><div class="B0-E">
                <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddExchangeBook/' .  $bookDetails->img1 . '" class="Book-E"><br>';?> <!--path changed-->
                    <div class="hov-aft">
                        <h4>Which Books I Want</h4>
                        <ul>
                            <li><?php echo $bookDetails->booksIWant; ?></li>
                        </ul>
                    </div>
                    <h3>End Game</h3>
                    <div class="fav-msg">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
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
