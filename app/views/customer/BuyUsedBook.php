<?php
    $title = "Buy Used Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
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
            <a href="<?php echo URLROOT; ?>/customer/UsedBookDetails"><div class="B0-U">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1" class="Book-U"> <!--path changed-->
                <h3>End Game</h3>
                <h3>500/=</h3>
                <h5>(Negotiate)</h5>
                <div class="fav-cart-msg">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/mycart.png" alt="cart">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/chat.png" alt="chat">
                </div>
            </div></a>
            <div class="B0-U">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book1.jpeg" alt="Book2" class="Book-U"> <!--path changed-->
                <h3>The Adventures of Huckleberry Finn</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/UsedBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0-U">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book2.jpeg" alt="Book3" class="Book-U"> <!--path changed-->
                <h3>Middlemarch</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/UsedBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0-U">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book3.jpeg" alt="Book4" class="Book-U"> <!--path changed-->
                <h3>Lolita</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/UsedBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0-U">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book4.jpeg" alt="Book5" class="Book-U"> <!--path changed-->
                <h3>The Great Gatsby</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/UsedBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0-U">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book5.jpeg" alt="Book5" class="Book-U"> <!--path changed-->
                <h3>War and Peace</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/UsedBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0-U">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book6.jpeg" alt="Book5" class="Book-U"> <!--path changed-->
                <h3>Madame Bovary</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/UsedBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0-U">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book7.jpeg" alt="Book5" class="Book-U"> <!--path changed-->
                <h3>Anna Karenina</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/UsedBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/filterbook.php'; //path changed
        ?>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
