<?php
    $title = "Bookshelf";
    include_once 'header.php';
?>

    <div class="container">
        <div class="sidebar">
        <!-- Sidebar content goes here -->
        <div class="profile-section">
            <img src="./assets/img/profile.png" alt="Profile Image" class="profile-image">
            <?php 
            if (isset($_SESSION["customerName"])){
                echo '<h2 class="profile-name1">'.$_SESSION["customerName"].'</h2>';
            } else {
                echo '<h2 class="profile-name1">Ramath Perera</h2>';
            }
            ?>
        </div>
        <br>
        <hr>

        <!-- Menu section -->
        <div class="menu-section">
            <ul class="menu-list">
                <li data-page="Dashboard"><a href="./Dashboard.php">Dashboard</a></li>
                <li data-page="Profile"><a href="./Profile.php">Profile</a></li>
                <li data-page="Notification"><a href="./Notification.php">Notification</a></li>
                <li data-page="Bookshelf"><a href="./Bookshelf.php">Bookshelf</a></li>
                <li data-page="Content"><a href="./Content.php">Content</a></li>
                <li data-page="Cart"><a href="./Cart.php">Cart</a></li>
            </ul>
        </div>
        </div>

        <div class="book-shelf">
            <div class="used-books">
                <h2>Used Books</h2>
                <form action="#.php" class="search">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="./assets/img/search.png"></button>
                </form>
                <br>
                <br>
                <div class="books">
                    <div class="B1">
                        <img src="./assets/img/book.jpg" alt="Book1" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B2">
                        <img src="./assets/img/book.jpg" alt="Book2" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B3">
                        <img src="./assets/img/book.jpg" alt="Book3" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B4">
                        <img src="./assets/img/book.jpg" alt="Book4" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="./assets/img/book.jpg" alt="Book5" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="./assets/img/book.jpg" alt="Book5" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="./assets/img/book.jpg" alt="Book5" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="./assets/img/book.jpg" alt="Book5" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="./assets/img/book.jpg" alt="Book5" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="./assets/img/book.jpg" alt="Book5" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="./assets/img/book.jpg" alt="Book5" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="./assets/img/book.jpg" alt="Book5" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="./assets/img/book.jpg" alt="Book5" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="./assets/img/book.jpg" alt="Book5" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                    <div class="B5">
                        <img src="./assets/img/book.jpg" alt="Book5" class="Book"><br>
                        <!-- <button class="dts-btn">View Details</button> -->
                    </div>
                </div>
                <div class="vw">
                    <a href="./AddUsedBook.php"><button class="vw-btn">Add a Book</button></a>
                </div>
            </div>
        </div>
    </div>

<?php
    include_once 'footer.php';
?>
