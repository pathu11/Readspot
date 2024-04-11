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
                
            </div>
            <div class="sub-cont-N2">
            <?php if (!empty($data['recommendedBooks'])): ?>
            <?php foreach ($data['recommendedBooks'] as $category => $booksInCategory): ?>
                <!-- <h2><?php echo $category; ?></h2> -->
                <?php foreach ($booksInCategory as $book): ?>
                    <a href="<?php echo URLROOT; ?>/customer/BookDetails/<?php echo $book->book_id; ?>">
                    <div class="B0-N">
                        <?php if (isset($book->img1)): ?>
                            <img src="<?php echo URLROOT; ?>/assets/images/publisher/addBooks/<?php echo $book->img1; ?>" alt="Book1" class="Book-N"> 
                        <?php endif; ?>
                        <h3><?php echo isset($book->book_name) ? $book->book_name : ''; ?></h3>
                        <h3><?php echo isset($book->price) ? $book->price : ''; ?></h3>
                        <div class="fav-cart">
                            <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                            <a href="<?php echo URLROOT; ?>/customer/addToCartByEachBook/<?php echo $book->book_id; ?>"><img src="<?php echo URLROOT; ?>/assets/images/customer/mycart.png" alt="cart"></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No recommended books found.</p>
        <?php endif; ?>

</div>     
        </div>
        <?php
            require APPROOT . '/views/customer/filterbook.php'; //path changed
        ?>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
