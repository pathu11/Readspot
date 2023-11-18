<?php
    $title = "Buy Used Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="sub-cont1">
            <?php
                require APPROOT . '/views/customer/bookcategorydropdown.php'; //path changed
            ?>
            <div class="new-books">
                <h1>USED BOOKS</h2>
            </div>
            <div class="search-bar">
                <form action="#.php" class="searching">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/img/search.png"></button> <!--path changed-->
                </form>
            </div>
        </div>
        <div class="sub-cont2">
            <div class="B0">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Book1" class="Book"> <!--path changed-->
                <h3>End Game</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/BookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book1.jpeg" alt="Book2" class="Book"> <!--path changed-->
                <h3>The Adventures of Huckleberry Finn</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/BookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book2.jpeg" alt="Book3" class="Book"> <!--path changed-->
                <h3>Middlemarch</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/BookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book3.jpeg" alt="Book4" class="Book"> <!--path changed-->
                <h3>Lolita</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/BookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book4.jpeg" alt="Book5" class="Book"> <!--path changed-->
                <h3>The Great Gatsby</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/BookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book5.jpeg" alt="Book5" class="Book"> <!--path changed-->
                <h3>War and Peace</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/BookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book6.jpeg" alt="Book5" class="Book"> <!--path changed-->
                <h3>Madame Bovary</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/BookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <div class="B0">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/book7.jpeg" alt="Book5" class="Book"> <!--path changed-->
                <h3>Anna Karenina</h3>
                <h3>500/=</h3>
                <a href="<?php echo URLROOT; ?>/customer/BookDetails"><button class="dts-btn">View Details</button></a> <!--path changed-->
            </div>
            <!-- <div class="B0">
                <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book5" class="Book">
                <h1>500/=</h1>
                <a href="./BookDetails.php"><button class="dts-btn">View Details</button></a>
            </div>
            <div class="B0">
                <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book5" class="Book">
                <h1>500/=</h1>
                <a href="./BookDetails.php"><button class="dts-btn">View Details</button></a>
            </div>
            <div class="B0">
                <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book5" class="Book">
                <h1>500/=</h1>
                <a href="./BookDetails.php"><button class="dts-btn">View Details</button></a>
            </div>
            <div class="B0">
                <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book5" class="Book">
                <h1>500/=</h1>
                <a href="./BookDetails.php"><button class="dts-btn">View Details</button></a>
            </div>
            <div class="B0">
                <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book5" class="Book">
                <h1>500/=</h1>
                <a href="./BookDetails.php"><button class="dts-btn">View Details</button></a>
            </div>
            <div class="B0">
                <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book5" class="Book">
                <h1>500/=</h1>
                <a href="./BookDetails.php"><button class="dts-btn">View Details</button></a>
            </div>
            <div class="B0">
                <img src="http://localhost/Group-27/public/assets/images/customer/book.jpg" alt="Book5" class="Book">
                <h1>500/=</h1>
                <a href="./BookDetails.php"><button class="dts-btn">View Details</button></a>
            </div> -->
        </div>
        
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
