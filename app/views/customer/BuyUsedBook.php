<?php
    $title = "Buy Used Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="back-btn-div01">
            <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>
        <div class="sub-cont-U1">
            <div class="Used-books">
                <h1>USED BOOKS</h1>
            </div>
            <div class="search-bar-U">
                <!--button type="submit" class="filter-btn-U" onclick="toggleDropdownfilter('filter-dropdown')">Filter</button-->
                <div class="search-form-U">
                    <form action="<?php echo URLROOT;?>/customer/filterbook" class="searching-U" method="post">
                        <!--select id="searchBy"  name="category">
                            <option value="technology">Title</option>
                            <option value="travel">Author</option>
                            <option value="food">ISBN</option>
                            <option value="lifestyle">Publisher</option>
                        </select-->
                        <input type="text" placeholder="Search by Name, Publisher, Author or ISBN.." name="search-U" autocomplete="off" id="search-U">
                        <!--button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button--> <!--path changed-->
                    </form>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                </div>
            
                <div class="filter-category">
                    <div class="list-group" id="show-list">
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="recommend">
            <div class="sub-cont-U2">
                <?php if (empty($data['bookDetails'])): ?>
                    <div class="B-div-noBook">
                        <p>No books added yet.</p>
                    </div>
                <?php else: ?>
                    <?php foreach($data['bookDetails'] as $bookDetails): ?>
                        <a href="<?php echo URLROOT; ?>/customer/UsedBookDetails/<?php echo $bookDetails->book_id; ?>">
                        <div class="B0-U"> 
                            <?php if ($bookDetails->price_type == 'Fixed'): ?>
                                <div class="in-of-stock-tag-U"><h5><?php echo $bookDetails->price_type; ?></h5></div>
                            <?php else: ?>
                                <div class="out-of-stock-tag-U"><h5><?php echo $bookDetails->price_type; ?></h5></div>
                            <?php endif; ?>
                            <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $bookDetails->img1 . '" class="Book-U"><br>';?>
                            <h3><?php echo $bookDetails->book_name; ?></h3>
                            <h3><?php echo $bookDetails->price; ?></h3>
                            <!-- <h5>(<?php echo $bookDetails->price_type; ?>)</h5> -->
                            <div class="fav-cart-msg">
                                <?php 
                                    if ($data['user_id']==0000){
                                        $num = 0;
                                    }else{
                                        $num = 0; // Initialize the variable before the loop
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
                                        <button class="book-button-U-after-fav">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo URLROOT; ?>/customer/addToFavoriteUsedBooks/<?php echo $bookDetails->book_id; ?>">
                                        <button class="book-button-U">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                <?php endif; ?>
                                <a href="<?php echo URLROOT; ?>/customer/addToCartByEachBook/<?php echo $bookDetails->book_id; ?>">
                                    <button class="book-button-U">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </button>
                                </a>
                                <a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $bookDetails->customer_user_id; ?>">
                                    <button class="book-button-U">
                                        <i class="fas fa-comment-alt" aria-hidden="true"></i>
                                    </button>
                                </a>
                                <!-- <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                                <img src="<?php echo URLROOT; ?>/assets/images/customer/mycart.png" alt="cart">
                                <a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $bookDetails->customer_user_id; ?>"><img src="<?php echo URLROOT; ?>/assets/images/customer/chat.png" alt="chat"></a> -->
                            </div>
                        </div></a>
                    <?php endforeach; ?>
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
        $("#search-U").keyup(function(){
            var searchText = $(this).val(); // Word coming from the input field
            var bookType = 'U';
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
            $("#search-U").val($(this).text());
            $("#show-list").html('');
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
    var items = document.querySelectorAll('.B0-U'); // Select all book items
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