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
                <h1>NEW BOOKS</h1>
            </div>
            <div class="search-bar-N">
                <!--button type="submit" class="filter-btn" onclick="toggleDropdownfilter('filter-dropdown')">Filter</button-->
                <div class="search-form-N">
                    <form action="<?php echo URLROOT;?>/customer/filterbook" class="searching-N" method="post">
                        <!--select id="searchBy"  name="category">
                            <option value="technology">Title</option>
                            <option value="travel">Author</option>
                            <option value="food">ISBN</option>
                            <option value="lifestyle">Publisher</option>
                        </select-->
                        <input type="text" placeholder="Search by Name, Publisher, Author or ISBN.." name="search-N" autocomplete="off" id="search-N">
                        
                        <!--button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button--> <!--path changed-->
                    </form>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                </div>
                <div class="filter-category">
                    <div class="list-group-N" id="show-list">
                        
                    </div>
                </div>
            </div>
        </div>
       
        <div class="recommend">
            <div class="viewall">
                <?php if(isset($data['user_id'])): ?>

                 <h2> Recommended For You </h2>
                 <?php else: ?>
                    <h2> Top Selling </h2> 
                    <?php endif; ?>
                <a href="<?php echo URLROOT; ?>/customer/Recommended">VIEW ALL>></a>
            </div>
            <div class="sub-cont-N2">
                <?php if (!empty($data['recommendedBooks'])): ?>
                    <?php $counter = 0; ?>
                    <?php foreach ($data['recommendedBooks'] as $category => $booksInCategory): ?>
                        <!-- <h2><?php echo $category; ?></h2> -->
                        <?php foreach ($booksInCategory as $book): ?>
                            <?php if ($counter >= 5) break 2; ?>
                            <a href="<?php echo URLROOT; ?>/customer/BookDetails/<?php echo $book->book_id; ?>">
                                <div class="B0-R">
                                    <?php if (isset($book->img1)): ?>
                                        <img src="<?php echo URLROOT; ?>/assets/images/publisher/addBooks/<?php echo $book->img1; ?>" alt="Book1" class="Book-N"> 
                                    <?php endif; ?>
                                    <h3><?php echo isset($book->book_name) ? $book->book_name : ''; ?></h3>
                                    <h3><?php echo isset($book->price) ? $book->price : ''; ?></h3>
                                    <div class="fav-cart">
                                        <!-- <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                                        <a href="<?php echo URLROOT; ?>/customer/addToCartByEachBook/<?php echo $book->book_id; ?>"><img src="<?php echo URLROOT; ?>/assets/images/customer/mycart.png" alt="cart"></a> -->

                                        <a href="<?php echo URLROOT; ?>/customer/addToFavoriteNewBooks/<?php echo $book->book_id; ?>">
                                            <button class="book-button">
                                                <i class="fa fa-heart" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        <a href="<?php echo URLROOT; ?>/customer/addToCartByEachBook/<?php echo $book->book_id; ?>">
                                            <button class="book-button">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </a>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>


        </div>
        <div class="recommend">
            <div class="viewall">
                <h2> Top Catagories </h2>
                <a href="<?php echo URLROOT; ?>/customer/TopCategory">VIEW ALL>></a>
            </div>
            <div class="sub-cont-N2">
                <a href="<?php echo URLROOT; ?>/customer/Recommended">
                
                <div class="cat-T">
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
            </div>
        </div>
        <div class="recommend">
            <div class="viewall">
                <h2>New Arrival</h2>
                <a href="<?php echo URLROOT; ?>/customer/NewArrival">VIEW ALL>></a>
            </div>
            <div class="sub-cont-N2">
                <?php if (empty($data['bookDetails'])): ?>
                    <div class="B-div-noBook">
                        <p>No books added yet.</p>
                    </div>
                <?php else: ?>
                    <i class="fas fa-chevron-circle-left arrow left-arrow" aria-hidden="true"></i>
                    <?php
                    // Extract first 10 books from the array
                    $firstTenBooks = array_slice($data['bookDetails'], 0, 10);
                    foreach($firstTenBooks as $books): ?>
                        <div class="B0-N">
                            <a href="<?php echo URLROOT; ?>/customer/BookDetails/<?php echo $books->book_id; ?>">
                                <img src="<?php echo URLROOT; ?>/assets/images/publisher/addBooks/<?php echo $books->img1; ?>" alt="Book1" class="Book-N"> 
                                <h3><?php echo $books->book_name; ?></h3>
                                <h3><?php echo $books->price; ?></h3>
                            </a>
                            <div class="fav-cart">
                                <a href="<?php echo URLROOT; ?>/customer/addToFavoriteNewBooks/<?php echo $books->book_id; ?>">
                                    <button class="book-button">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    </button>
                                </a>
                                <a href="<?php echo URLROOT; ?>/customer/addToCartByEachBook/<?php echo $books->book_id; ?>">
                                    <button class="book-button">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <i class="fas fa-chevron-circle-right arrow right-arrow" aria-hidden="true"></i>
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


<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentIndex = 0;
        var items = document.querySelectorAll('.B0-N');
        var itemAmt = items.length;

        function cycleItems() {
            for (var i = 0; i < itemAmt; i++) {
                items[i].style.display = 'none';
            }
            items[currentIndex].style.display = 'block';
        }

        function nextItem() {
            currentIndex = (currentIndex + 1) % itemAmt;
            cycleItems();
        }

        function prevItem() {
            currentIndex = (currentIndex - 1 + itemAmt) % itemAmt;
            cycleItems();
        }

        // Automatically change every 5 seconds
        var autoSlide = setInterval(nextItem, 5000);

        // Stop automatic slide when arrow is clicked
        document.querySelector('.left-arrow').addEventListener('click', function() {
            clearInterval(autoSlide);
            prevItem();
        });

        document.querySelector('.right-arrow').addEventListener('click', function() {
            clearInterval(autoSlide);
            nextItem();
        });

        cycleItems();
    });
</script> -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentIndex = 0;
        var items = document.querySelectorAll('.B0-N');
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
            document.querySelector('.left-arrow').addEventListener('click', function() {
                prevItem();
            });

            document.querySelector('.right-arrow').addEventListener('click', function() {
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
</script>







