<?php
    $title = "My Exchange Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="book-shelf">
            <div class="exchange-books">
                <h2>Exchange Books</h2>
                <form action="#.php" class="mybook-search">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> <!--path changed-->
                </form>
                <br>
                <br>
                <div class="books">
                    <div class="B-div">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/harry1.jpeg" alt="Book1" class="Book"><br> <!--path changed-->
                        <button class="eb-dts-btn">View Details</button>
                    </div>
                    <div class="B-div">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/harry2.jpeg" alt="Book2" class="Book"><br> <!--path changed-->
                        <button class="eb-dts-btn">View Details</button>
                    </div>
                    <div class="B-div">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/harry3.jpeg" alt="Book3" class="Book"><br> <!--path changed-->
                        <button class="eb-dts-btn">View Details</button>
                    </div>
                    <div class="B-div">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/harry4.jpeg" alt="Book4" class="Book"><br> <!--path changed-->
                        <button class="eb-dts-btn">View Details</button>
                    </div>
                    <div class="B-div">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/harry5.jpeg" alt="Book5" class="Book"><br> <!--path changed-->
                        <button class="eb-dts-btn">View Details</button>
                    </div>
                    <div class="B-div">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/harry6.jpeg" alt="Book5" class="Book"><br> <!--path changed-->
                        <button class="eb-dts-btn">View Details</button>
                    </div>
                    <div class="B-div">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/harry7.jpeg" alt="Book5" class="Book"><br> <!--path changed-->
                        <button class="eb-dts-btn">View Details</button>
                    </div>
                </div>
                <div class="eb-vw">
                    <a href="<?php echo URLROOT; ?>/customer/AddExchangeBook"><button class="eb-vw-btn">Add a Book</button></a> <!--path changed-->
                </div>
                <br>
                <br>
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>
