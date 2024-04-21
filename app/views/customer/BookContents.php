<?php
    $title = "Contents";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="back-btn-div01">
            <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>
        <div class="sub-cont-C1">
            <div class="Content-books">
                <h1>CONTENTS</h2>
            </div>
         <div class="search-bar-C">
                <!-- <button type="submit" class="filter-btn-C" onclick="toggleDropdownfilter('filter-dropdown')">Filter</button> -->
                <div class="search-form-C">
                    <form action="<?php echo URLROOT;?>/customer/filtercontent" class="searching-C" method="post">
                        <!-- <select id="searchBy"  name="category">
                            <option value="technology">Title</option>
                            <option value="travel">Author</option>
                            <option value="food">ISBN</option>
                            <option value="lifestyle">Publisher</option>
                        </select> -->
                        <input type="text" placeholder="Search....." name="search-C" autocomplete="off" id="search-C">
                        <!-- <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> path changed -->
                    </form>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                </div>

                <div class="filter-category">
                    <div class="list-group-C" id="show-list">
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- top contents -->
        <div class="sub-cont-C2">
        <h1>Top Content of This Week</h1>
        <?php foreach($data['topRatedContent'] as $content): ?>
            <div class="content0-C">
                <div class="content1-C">
                    <img src="<?php echo URLROOT; ?>/assets/images/landing/addcontents/<?php echo $content->img; ?>"  alt="Book3" class="content-img-C"> <!--path changed-->
                    <div class="content2-C">
                        <h1><?php echo $content->topic; ?></h1><br>
                        <p>
                            <?php 
                                // Limit the text to 150 characters
                                $limitedText = substr($content->text, 0, 400);
                                echo $limitedText;
                            ?>
                            <?php if(strlen($content->text) > 150): ?>
                                <span id="dots">...</span>
                                <span id="more" style="display: none;">
                                    <?php echo substr($content->text, 150); ?>
                                </span>
                                <a style="text-decoration:none;" href="<?php echo URLROOT; ?>/customer/viewcontent/<?php echo $content->content_id; ?> ">Read more</a>

                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <div class="view-fav">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                    <a href="<?php echo URLROOT; ?>/customer/viewcontent/<?php echo $content->content_id; ?>"><button class="vw-btn-C">View Details</button></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="sub-cont-C2">

            <?php if (empty($data['contentDetails'])): ?>
                <div class="B-div-noBook">
                    <p>No books added yet.</p>
            <?php else: ?>
                <?php foreach($data['contentDetails'] as $content): ?>
                    <div class="content0-C">
                        <div class="content1-C">
                            <img src="<?php echo URLROOT; ?>/assets/images/landing/addcontents/<?php echo $content->img; ?>"  alt="Book3" class="content-img-C"> <!--path changed-->
                            <div class="content2-C">
                                <h1><?php echo $content->topic; ?></h1><br>
                                <p>
                                    <?php 
                                        // Limit the text to 150 characters
                                        $limitedText = substr($content->text, 0, 400);
                                        echo $limitedText;
                                    ?>
                                    <?php if(strlen($content->text) > 150): ?>
                                        <span id="dots">...</span>
                                        <span id="more" style="display: none;">
                                            <?php echo substr($content->text, 150); ?>
                                        </span>
                                        <a style="text-decoration:none;" href="<?php echo URLROOT; ?>/customer/viewcontent/<?php echo $content->content_id; ?> ">Read more</a>

                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <div class="view-fav">
                            <a href="<?php echo URLROOT; ?>/customer/addToFavoriteContent/<?php echo $content->content_id; ?>">
                                <button class="book-button-C">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </button>
                            </a>
                            <a href="<?php echo URLROOT; ?>/customer/viewcontent/<?php echo $content->content_id; ?>"><button class="vw-btn-C">View Details</button></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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
            require APPROOT . '/views/customer/filtercontent.php'; //path changed
        ?>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>


<script type="text/javascript">
    $(document).ready(function(){
        $("#search-C").keyup(function(){
            var searchText = $(this).val(); // Word coming from the input field
            var bookType = 'C';
            if(searchText!=''){
                $.ajax({
                    url:'<?php echo URLROOT;?>/customer/filtercontent',
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
            $("#search-C").val($(this).text());
            $("#show-list").html('');
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
    var items = document.querySelectorAll('.content0-C'); // Select all book items
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