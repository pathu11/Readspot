<?php
    $title = "Buy New Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="sub-cont-N1">
            <div class="New-books">
                <h1>BOOK CHALLENGES</h1>
            </div>
            <div class="search-bar-N">
                <button type="submit" class="filter-btn" onclick="toggleDropdownfilter('filter-dropdown')">Filter</button>
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
        <?php
            require APPROOT . '/views/customer/filterbook.php'; //path changed
        ?>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
