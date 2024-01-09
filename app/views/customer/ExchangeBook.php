<?php
    $title = "Exchange Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="sub-cont-E1">
            <div class="Exchange-books">
                <h1>EXCHANGE BOOKS</h2>
            </div>
            <div class="search-bar-E">
                <button type="submit" class="filter-btn-E" onclick="toggleDropdownfilter('filter-dropdown')">Filter</button>
                <form action="#.php" class="searching-E">
                    <select id="searchBy"  name="category">
                        <option value="technology">Title</option>
                        <option value="travel">Author</option>
                        <option value="food">ISBN</option>
                        <option value="lifestyle">Publisher</option>
                    </select>
                    <input type="text" placeholder="Search.." name="search-E">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> <!--path changed-->
                </form>
            </div>
        </div>
        <div class="sub-cont-E2">
            <a href="<?php echo URLROOT; ?>/customer/ExchangeBookDetails"><div class="B0-E">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1" class="Book-E"> <!--path changed-->
                <div class="hov-aft">
                    <h4>Which Books I Want</h4>
                    <ul>
                        <li>War and Peace</li>
                        <li>Madame Bovary</li>
                        <li>Anna Karenina</li>
                        <li>Lolita</li>
                        <li>Harry Potter and the Chamber of Secrets</li>
                        <li>Harry Potter and the Half-Blood Prince</li>
                        <li>Hamlet</li>
                    </ul>
                </div>
                <h3>End Game</h3>
                <div class="fav-msg">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/chat.png" alt="chat">
                </div>
            </div></a>
            <div class="B0-E">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book1.jpeg" alt="Book2" class="Book-E"> <!--path changed-->
                <h3>The Adventures of Huckleberry Finn</h3>
                <a href="<?php echo URLROOT; ?>/customer/ExchangeBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0-E">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book2.jpeg" alt="Book3" class="Book-E"> <!--path changed-->
                <h3>Middlemarch</h3>
                <a href="<?php echo URLROOT; ?>/customer/ExchangeBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0-E">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book3.jpeg" alt="Book4" class="Book-E"> <!--path changed-->
                <h3>Lolita</h3>
                <a href="<?php echo URLROOT; ?>/customer/ExchangeBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0-E">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book5.jpeg" alt="Book5" class="Book-E"> <!--path changed-->
                <h3>War and Peace</h3>
                <a href="<?php echo URLROOT; ?>/customer/ExchangeBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0-E">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book6.jpeg" alt="Book5" class="Book-E"> <!--path changed-->
                <h3>Madame Bovary</h3>
                <a href="<?php echo URLROOT; ?>/customer/ExchangeBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0-E">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book7.jpeg" alt="Book5" class="Book-E"> <!--path changed-->
                <h3>Anna Karenina</h3>
                <a href="<?php echo URLROOT; ?>/customer/ExchangeBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0-E">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book4.jpeg" alt="Book5" class="Book-E"> <!--path changed-->
                <h3>The Great Gatsby</h3>
        
                <a href="<?php echo URLROOT; ?>/customer/ExchangeBookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/filterbook.php'; //path changed
        ?>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
