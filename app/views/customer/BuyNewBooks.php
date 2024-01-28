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
                </div>
                <div class="filter-category">
                    <div class="list-group-N" id="show-list">
                        
                    </div>
                </div>
            </div>
        </div>
       
        <div class="recommend">
            <div class="viewall">
                <h2> Recommended For You </h2>
                <a href="<?php echo URLROOT; ?>/customer/Recommended">VIEW ALL>></a>
            </div>
            <?php $data['recommendedBooks']; ?>
            <div class="sub-cont-N2">
            <?php if (empty($data['recommendedBooks'])): ?>
            <p>No recommended books found.</p>
            <?php else: ?>
                <?php foreach ($data['recommendedBooks'] as $category => $booksInCategory): ?>
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
                                    <a href="<?php echo URLROOT; ?>/customer/Cart"><img src="<?php echo URLROOT; ?>/assets/images/customer/mycart.png" alt="cart"></a>
                                </div>
                            </div>
                        </a>
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
                <h2> New Arrival </h2>
                <a href="<?php echo URLROOT; ?>/customer/Recommended">VIEW ALL>></a>
            </div>
            <div class="sub-cont-N2">
               
                <?php foreach($data['bookDetails'] as $books): ?>
                <a href="<?php echo URLROOT; ?>/customer/BookDetails/<?php echo $books->book_id; ?>">
                <div class="B0-N">
                    <img src="<?php echo URLROOT; ?>/assets/images/publisher/addBooks/<?php echo $books->img1; ?>" alt="Book1" class="Book-N"> 
                    <h3><?php echo $books->book_name; ?></h3>
                    <h3><?php echo $books->price; ?></h3>
                    <div class="fav-cart">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                        <a href="<?php echo URLROOT; ?>/customer/Cart"><img src="<?php echo URLROOT; ?>/assets/images/customer/mycart.png" alt="cart"></a>
                    </div>
                </div>
            </a>
                <?php endforeach; ?>
                
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
            if(searchText!=''){
                $.ajax({
                    url:'<?php echo URLROOT;?>/customer/filterbook',
                    method : 'post',
                    data : {query:searchText},
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

