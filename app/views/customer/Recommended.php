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
        <div class="recommend">
            <div class="viewall">
                <?php if(isset($data['user_id'])): ?>
                    <h2> Recommended For You </h2>
                <?php else: ?>
                    <h2> Top Selling </h2> 
                <?php endif; ?>
            </div>
            <div class="sub-cont-N2">
            <?php if (!empty($data['recommendedBooks'])): ?>
            <?php foreach ($data['recommendedBooks'] as $category => $booksInCategory): ?>
                <!-- <h2><?php echo $category; ?></h2> -->
                <?php foreach ($booksInCategory as $book): ?>
                    <a href="<?php echo URLROOT; ?>/customer/BookDetails/<?php echo $book->book_id; ?>">
                    <div class="B0-N">
                        <?php if ($book->quantity == 0): ?>
                            <div class="out-of-stock-tag">Out of Stock</div>
                        <?php else: ?>
                            <div class="in-of-stock-tag">In Stock</div>
                        <?php endif; ?>
                        <?php if ($book->discounts != 0.00): ?>
                            <div class="discount-badge"><?php echo $book->discounts; ?>%</div> 
                        <?php endif; ?>
                        <?php if (isset($book->img1)): ?>
                            <img src="<?php echo URLROOT; ?>/assets/images/publisher/addBooks/<?php echo $book->img1; ?>" alt="Book1" class="Book-N"> 
                        <?php endif; ?>
                        <h3><?php echo isset($book->book_name) ? $book->book_name : ''; ?></h3>
                        <h3><?php echo isset($book->price) ? $book->price : ''; ?></h3>
                       

                        <div class="fav-cart">
                            <!-- <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                            <a href="<?php echo URLROOT; ?>/customer/addToCartByEachBook/<?php echo $bookDetails->book_id; ?>"><img src="<?php echo URLROOT; ?>/assets/images/customer/mycart.png" alt="cart"></a> -->
                            <?php 
                                $num = 0; // Initialize the variable before the loop
                                if ($data['user_id']==0000){
                                    $num = 0;
                                }else{
                                    foreach ($data['favoriteDetails'] as $favorite): 
                                        if ($book->book_id == $favorite->item_id): 
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
                                <a href="<?php echo URLROOT; ?>/customer/addToFavoriteNewBooks/<?php echo $book->book_id; ?>">
                                    <button class="book-button">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                    </button>
                                </a>
                            <?php endif; ?>
                                <a href="<?php echo URLROOT; ?>/customer/addToCartByEachBook/<?php echo $book->book_id; ?>">
                                    <button class="book-button">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </button>
                                </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No recommended books found.</p>
        <?php endif; ?>
        </div>     
            <ul class="pagination" id="pagination">
                <li id="prevButton">«</li>
                <li class="current">1</li>
                <li>2</li>
                <li>3</li>
                <li>4</li>
                <li>5</li>
                <li>6</li>
                <li>7</li>
                <li>8</li>
                <li>9</li>
                <li>10</li>
                <li id="nextButton">»</li>
            </ul>
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




<script>
    document.addEventListener("DOMContentLoaded", function() {
    var items = document.querySelectorAll('.B0-N'); // Select all book items
    var itemsPerPage = 10; // Number of items per page
    var currentPage = 1; // Current page
    var numPages = Math.ceil(items.length / itemsPerPage); // Total number of pages
    var pagination = document.getElementById('pagination');

    // Function to display items for the current page
    function displayItems() {
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = Math.min(startIndex + itemsPerPage, items.length);

        // Hide all items
        items.forEach(function(item) {
            item.style.display = 'none';
        });

        // Display items for the current page
        for (var i = startIndex; i < endIndex; i++) {
            items[i].style.display = 'block';
        }
    }

    // Function to update pagination buttons
    function updatePaginationButtons() {
        // Clear previous pagination buttons
        pagination.innerHTML = '';

        // Previous button
        pagination.innerHTML += '<li id="prevButton">«</li>';

        // Display only necessary pagination numbers
        for (var i = 1; i <= numPages; i++) {
            pagination.innerHTML += '<li class="' + (currentPage === i ? 'current' : '') + '">' + i + '</li>';
        }

        // Next button
        pagination.innerHTML += '<li id="nextButton">»</li>';

        // Add event listeners to newly created pagination buttons
        var pageButtons = pagination.querySelectorAll('li:not(#prevButton):not(#nextButton)');
        pageButtons.forEach(function(button, index) {
            button.addEventListener('click', function() {
                currentPage = index + 1;
                displayItems();
                updatePaginationButtons();
            });
        });

        // Add event listeners for previous and next buttons
        document.getElementById('prevButton').addEventListener('click', goToPrevPage);
        document.getElementById('nextButton').addEventListener('click', goToNextPage);
    }

    // Initial display
    displayItems();
    updatePaginationButtons();

    // Function to go to the previous page
    function goToPrevPage() {
        if (currentPage > 1) {
            currentPage--;
            displayItems();
            updatePaginationButtons();
        }
    }

    // Function to go to the next page
    function goToNextPage() {
        if (currentPage < numPages) {
            currentPage++;
            displayItems();
            updatePaginationButtons();
        }
    }
});
</script>
