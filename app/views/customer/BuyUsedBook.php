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
                    <div class="list-group-U" id="show-list">
                        
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="sub-cont-U2">
            <?php foreach($data['bookDetails'] as $bookDetails): ?>
                <a href="<?php echo URLROOT; ?>/customer/UsedBookDetails/<?php echo $bookDetails->book_id; ?>"><div class="B0-U">
                <?php echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' .  $bookDetails->img1 . '" class="Book-U"><br>';?>
                    <h3><?php echo $bookDetails->book_name; ?></h3>
                    <h3><?php echo $bookDetails->price; ?></h3>
                    <h5>(<?php echo $bookDetails->price_type; ?>)</h5>
                    <div class="fav-cart-msg">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/mycart.png" alt="cart">
                        <a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $bookDetails->customer_user_id; ?>"><img src="<?php echo URLROOT; ?>/assets/images/customer/chat.png" alt="chat"></a>
                    </div>
                </div></a>
            <?php endforeach; ?>
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
