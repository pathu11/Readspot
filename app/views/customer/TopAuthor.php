<?php
    $title = "Buy New Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
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
                <h2> Top Authors </h2>
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
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/filterbook.php'; //path changed
        ?>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
