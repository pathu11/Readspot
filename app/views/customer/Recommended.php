<?php
    $title = "Buy New Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="back-btn-div01">
            <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>
        <div class="sub-cont-N1">
            <div class="New-books">
                <h1>NEW BOOKS</h2>
            </div>
            <div class="search-bar-N">
                <button type="submit" class="filter-btn" onclick="toggleDropdownfilter('filter-dropdown')">Filter</button>
                <form action="#.php" class="searching-N">
                    <select id="searchBy"  name="category" required>
                        <option value="technology">Title</option>
                        <option value="travel">Author</option>
                        <option value="food">ISBN</option>
                        <option value="lifestyle">Publisher</option>
                    </select>
                    <input type="text" placeholder="Search.." name="search-N">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> <!--path changed-->
                </form>
            </div>
        </div>
        <div class="recommend">
            <div class="viewall">
                <h2> Topic </h2>
            </div>
            <div class="sub-cont-N2">
                <a href="<?php echo URLROOT; ?>/customer/BookDetails"><div class="B0-N">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1" class="Book-N"> <!--path changed-->
                    <h3>End Game</h3>
                    <h3>500/=</h3>
                    <div class="fav-cart">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/mycart.png" alt="cart">
                    </div>
                </div></a>
                <div class="B0-N">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book1.jpeg" alt="Book2" class="Book-N"> <!--path changed-->
                    <h3>The Adventures</h3>
                    <h3>500/=</h3>
                    <button class="dts-btn">Add to Cart</button>
                    <button class="dts-btn">View Details</button>
                </div>
                <div class="B0-N">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book2.jpeg" alt="Book3" class="Book-N"> <!--path changed-->
                    <h3>Middlemarch</h3>
                    <h3>500/=</h3>
                    <button class="dts-btn">Add to Cart</button>
                    <button class="dts-btn">View Details</button>
                </div>
                <div class="B0-N">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book3.jpeg" alt="Book4" class="Book-N"> <!--path changed-->
                    <h3>Lolita</h3>
                    <h3>500/=</h3>
                    <button class="dts-btn">Add to Cart</button>
                    <button class="dts-btn">View Details</button>
                </div>
                <div class="B0-N">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book4.jpeg" alt="Book5" class="Book-N"> <!--path changed-->
                    <h3>The Great Gatsby</h3>
                    <h3>500/=</h3>
                    <button class="dts-btn">Add to Cart</button>
                    <button class="dts-btn">View Details</button>
                </div>
                <div class="B0-N">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book2.jpeg" alt="Book3" class="Book-N"> <!--path changed-->
                    <h3>Middlemarch</h3>
                    <h3>500/=</h3>
                    <button class="dts-btn">Add to Cart</button>
                    <button class="dts-btn">View Details</button>
                </div>
                <div class="B0-N">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book3.jpeg" alt="Book4" class="Book-N"> <!--path changed-->
                    <h3>Lolita</h3>
                    <h3>500/=</h3>
                    <button class="dts-btn">Add to Cart</button>
                    <button class="dts-btn">View Details</button>
                </div>
                <div class="B0-N">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book4.jpeg" alt="Book5" class="Book-N"> <!--path changed-->
                    <h3>The Great Gatsby</h3>
                    <h3>500/=</h3>
                    <button class="dts-btn">Add to Cart</button>
                    <button class="dts-btn">View Details</button>
                </div>
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/filterbook.php'; //path changed
        ?>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
