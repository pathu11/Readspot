<?php
    $title = "Content";
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

        <div class="my-content">
            <div class="content-topic">
                <h2>Used Books</h2>
            </div>
            <div class="mycontent">
            <form action="#.php" class="search">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="./assets/img/search.png"></button>
            </form>
            <br>
            <br>
            <table border="1">
                <tr>
                    <th>Contents</th>
                    <th>Added-Date</th>
                    <th>VIew/Delete </th>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>R03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
            </table>
            </div>
            <div class="vw">
                <a href="./AddCont.php"><button class="vw-btn">Add a Content</button></a>
            </div>

        </div>
    </div>

<?php
    include_once 'footer.php';
?>
