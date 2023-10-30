<?php
    $title = "Cart";
    include_once 'header.php';
?>

    <div class="container">
        <div class="sidebar">
        <!-- Sidebar content goes here -->
        <div class="profile-section">
            <img src="http://localhost/Group-27/public/assets/images/customer/profile.png" alt="Profile Image" class="profile-image">
            <?php 
            if (isset($_SESSION["customer_name"])){
                echo '<h2 class="profile-name1">'.$_SESSION["customer_name"].'</h2>';
            } else {
                echo '<h2 class="profile-name1">NO USER</h2>';
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

        <div class="my-content">
            <div class="content-topic">
                <h2>My Cart</h2>
            </div>
            <div class="mycart">
            <form action="#.php" class="search">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="http://localhost/Group-27/public/assets/images/customer/search.png"></button>
            </form>
            <br>
            <br>
            <table border="1">
                <tr>
                    <th>Book Name</th>
                    <th>Price per book</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Checkout/Remove</th>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
            </table>
            </div>
            <!-- <div class="vw">
                <button class="vw-btn">Add a Content</button>
            </div> -->

        </div>
    </div>

<?php
    include_once 'footer.php';
?>
