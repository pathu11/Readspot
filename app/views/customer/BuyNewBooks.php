<?php
    $title = "Buy New Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="sub-cont-N1">
            <div class="New-books">
                <h1>NEW BOOKS</h1>
            </div>
            <div class="search-bar-N">
                <form action="#.php" class="searching-N">
                    <select id="searchBy"  name="category">
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
                <h2> Top Authors </h2>
                <a href="<?php echo URLROOT; ?>/customer/TopAuthor">VIEW ALL>></a>
            </div>
            <div class="sub-cont-N2">
                <a href="<?php echo URLROOT; ?>/customer/Recommended"><div class="aut-T">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/profile.png" alt="Book1"> <!--path changed-->
                    <h3>Martin Wickramasignhe</h3>
                </div></a>
                <div class="aut-T">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1"> <!--path changed-->
                </div>
                <div class="aut-T">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1"> <!--path changed-->
                </div>
                <div class="aut-T">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1"> <!--path changed-->
                </div>
                <div class="aut-T">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1"> <!--path changed-->
                </div>
            </div>
        </div>
        <div class="recommend">
            <div class="viewall">
                <h2> Top Catagories </h2>
                <a href="<?php echo URLROOT; ?>/customer/TopCategory">VIEW ALL>></a>
            </div>
            <div class="sub-cont-N2">
                <a href="<?php echo URLROOT; ?>/customer/Recommended"><div class="cat-T">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/fantasy.jpg" alt="Book1"> <!--path changed-->
                </div></a>
                <div class="cat-T">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/horror.jpg" alt="Book1"> <!--path changed-->
                </div>
                <div class="cat-T">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1"> <!--path changed-->
                </div>
                <div class="cat-T">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1"> <!--path changed-->
                </div>
                <div class="cat-T">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1"> <!--path changed-->
                </div>
                <div class="cat-T">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1"> <!--path changed-->
                </div>
                <div class="cat-T">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1"> <!--path changed-->
                </div>
            </div>
        </div>
        <div class="recommend">
            <div class="viewall">
                <h2> Recommended For You </h2>
                <a href="<?php echo URLROOT; ?>/customer/Recommended">VIEW ALL>></a>
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
                <!--  -->
            </div>
        </div>
        
        
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
