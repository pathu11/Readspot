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
                <!-- <button type="submit" class="filter-btn" onclick="toggleDropdownfilter('filter-dropdown')">Filter</button> -->
                <div class="search-form-N">
                    <form action="<?php echo URLROOT;?>/customer/filterbook" class="searching-N" method="post">
                        <!-- <select id="searchBy"  name="category" required>
                            <option value="technology">Title</option>
                            <option value="travel">Author</option>
                            <option value="food">ISBN</option>
                            <option value="lifestyle">Publisher</option>
                        </select> -->
                        <input type="text" placeholder="Search by Name, Publisher, Author or ISBN.." name="search-N" autocomplete="off" id="search-N">
                        <!-- <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> path changed -->
                    </form>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                </div>
                <div class="filter-category">
                    <div class="list-group-N" id="show-list">
                        
                    </div>
                </div>
            </div>
        </div>
        <?php foreach($data['bookCategoryDetails'] as $bookCategory): ?>
            <div class="recommend">
                <div class="viewall">
                    <h2><?php echo $bookCategory->category; ?></h2>
                    <a href="<?php echo URLROOT; ?>/customer/Category/<?php echo $bookCategory->category; ?>">VIEW ALL>></a>
                </div>
                <div class="sub-cont-N2">
                    <?php
                    // Initialize variables
                    $booksFound = false; // Flag to check if any books were found for the current category
                    $categoryBooks = []; // Array to store books for the current category
                    foreach($data['bookDetails'] as $bookDetails) {
                        // Check if book belongs to the current category
                        if ($bookCategory->category == $bookDetails->category) {
                            $categoryBooks[] = $bookDetails; // Add book to the category's array
                            $booksFound = true; // Set flag to true if book is found
                        }
                    }
                    ?>
                    <i class="fas fa-chevron-circle-left arrow left-arrow" aria-hidden="true"></i>
                    <?php if ($booksFound): // If books found for the current category ?>
                        <?php
                        // Display books
                        foreach ($categoryBooks as $bookDetails): ?>
                            <a href="<?php echo URLROOT; ?>/customer/BookDetails/<?php echo $bookDetails->book_id; ?>">
                                <div class="B0-N">
                                    <?php if ($bookDetails->quantity == 0): ?>
                                        <div class="out-of-stock-tag">Out of Stock</div>
                                    <?php else: ?>
                                        <div class="in-of-stock-tag">In Stock</div>
                                    <?php endif; ?>
                                    <?php if ($bookDetails->discounts != 0.00): ?>
                                        <div class="discount-badge"><?php echo $bookDetails->discounts; ?>%</div> 
                                    <?php endif; ?>
                                    <img src="<?php echo URLROOT; ?>/assets/images/publisher/addBooks/<?php echo $bookDetails->img1; ?>" alt="Book1" class="Book-N">
                                    <h3><?php echo $bookDetails->book_name; ?></h3>
                                    <h3><?php echo $bookDetails->price; ?></h3>
                                    <!-- <div class="fav-cart">
                                        <button class="book-button">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </button>
                                        <a href="<?php echo URLROOT; ?>/customer/addToCartByEachBook/<?php echo $bookDetails->book_id; ?>">
                                            <button class="book-button">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    </div> -->
                                    <div class="fav-cart">
                                        <!-- <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                                        <a href="<?php echo URLROOT; ?>/customer/addToCartByEachBook/<?php echo $bookDetails->book_id; ?>"><img src="<?php echo URLROOT; ?>/assets/images/customer/mycart.png" alt="cart"></a> -->
                                        <?php 
                                            $num = 0; // Initialize the variable before the loop
                                            if ($data['user_id']==0000){
                                                $num = 0;
                                            }else{
                                                foreach ($data['favoriteDetails'] as $favorite): 
                                                    if ($bookDetails->book_id == $favorite->item_id): 
                                                        $num = 1;
                                                        $fav_id = $favorite->fav_id;
                                                        break; // Assuming you want to stop the loop once a match is found
                                                    endif;
                                                endforeach;
                                            }
                                        ?>

                                        <?php if ($num == 1): ?>
                                            <a href="<?php echo URLROOT; ?>/customer/deleteFavorite/<?php echo $fav_id; ?>">
                                                <button class="book-button-after-fav">
                                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo URLROOT; ?>/customer/addToFavoriteNewBooks/<?php echo $bookDetails->book_id; ?>">
                                                <button class="book-button">
                                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?php echo URLROOT; ?>/customer/addToCartByEachBook/<?php echo $bookDetails->book_id; ?>">
                                            <button class="book-button">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else: // If no books found for the current category ?>
                        <div class="B-div-noBook">
                            <p>No books added yet.</p>
                        </div>
                    <?php endif; ?>
                    <i class="fas fa-chevron-circle-right arrow right-arrow" aria-hidden="true"></i>
                </div>
            </div>
        <?php endforeach; ?>
        
        <?php
            require APPROOT . '/views/customer/filterbook.php'; //path changed
        ?>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>


<script type="text/javascript">
    $(document).ready(function(){
        $("#search-N").keyup(function(){
            var searchText = $(this).val(); // Word coming from the input field
            var bookType = 'N';
            if(searchText!=''){
                $.ajax({
                    url:'<?php echo URLROOT;?>/customer/filterbook',
                    method : 'post',
                    data : {query:searchText, bookType:bookType},
                    success:function(response){
                        $("#show-list").html(response);
                    }
                });
            } else {
                $('#show-list').html('');
            }
        });
        $(document).on('click','a',function(){
            $("#search-N").val($(this).text());
            $("#show-list").html('');
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get elements for this specific category
        var categoryItems = document.querySelectorAll('.sub-cont-N2');

        // Apply slideshow logic for each category
        categoryItems.forEach(function(item) {
            var currentIndex = 0;
            var items = item.querySelectorAll('.B0-N');
            var itemAmt = items.length;
            var numVisible = 4; // Default number of books visible at once

            function cycleItems() {
                // Hide all books
                for (var i = 0; i < itemAmt; i++) {
                    items[i].style.display = 'none';
                }
                // Calculate the starting index for displaying the books
                var start = currentIndex;
                // Display the next numVisible books in the correct circular order
                for (var i = 0; i < numVisible; i++) {
                    var index = (start + i) % itemAmt;
                    items[index].style.display = 'block';
                }
            }

            function nextItem() {
                currentIndex = (currentIndex + 1) % itemAmt;
                cycleItems();
            }

            function prevItem() {
                currentIndex = (currentIndex - 1 + itemAmt) % itemAmt;
                cycleItems();
            }

            // Check if there are 4 or fewer books
            if (itemAmt <= 4) {
                // Display all books without slideshow functionality
                cycleItems();
            } else {
                // Automatically change every 5 seconds
                var autoSlide = setInterval(nextItem, 5000);

                // Arrow click handlers
                item.querySelector('.left-arrow').addEventListener('click', function() {
                    prevItem();
                });

                item.querySelector('.right-arrow').addEventListener('click', function() {
                    nextItem();
                });
            }

            // Adjust number of visible books based on screen size
            function updateNumVisible() {
                if (window.innerWidth < 1180 && window.innerWidth >= 925) { // Adjust as needed
                    numVisible = 3; // Set to 3 for medium screens
                } else if (window.innerWidth < 925 && window.innerWidth >= 680) {
                    numVisible = 2; // Set to 2 for small screens
                } else if (window.innerWidth < 680) {
                    numVisible = 1; // Set to 1 for extra small screens
                } else {
                    numVisible = 4; // Default to 4 for larger screens
                }
                cycleItems(); // Update display based on new number of visible books
            }

            // Call updateNumVisible initially and on window resize
            updateNumVisible();
            window.addEventListener('resize', updateNumVisible);
        });
    });
</script>
