<?php
    $title = "Notification";
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

        <div class="prof-content">
            <div class="content-topic">
                <h2>Notification</h2>
            </div>
            <div class="mycart">
            <form action="#.php" class="search">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="./assets/img/search.png"></button>
            </form>
            <br>
            <br>
            <div class="notification">
                <div class="notify">
                    <input type="checkbox">
                    <p>Lorem ipsum dolor sit amet consectetur, 
                        adipisicing elit. Accusantium, numquam! 
                        Voluptas voluptates quas modi debitis molestias
                        cumque voluptatum fugit laudantium voluptatibus 
                        repellat facere optio cupiditate, vel, aperiam 
                        aliquam consequatur perspiciatis iusto enim quaerat. 
                        Laboriosam, debitis cum. Pariatur consequatur rem tenetur, 
                        sit ullam sint dolores iure natus commodi veniam aliquid odit.
                    </p>
                </div>
                <div class="notify">
                    <input type="checkbox">
                    <p>Lorem ipsum dolor sit amet consectetur, 
                        adipisicing elit. Accusantium, numquam! 
                        Voluptas voluptates quas modi debitis molestias
                        cumque voluptatum fugit laudantium voluptatibus 
                        repellat facere optio cupiditate, vel, aperiam 
                        aliquam consequatur perspiciatis iusto enim quaerat. 
                        Laboriosam, debitis cum. Pariatur consequatur rem tenetur, 
                        sit ullam sint dolores iure natus commodi veniam aliquid odit.
                    </p>
                </div>
                <div class="notify">
                    <input type="checkbox">
                    <p>Lorem ipsum dolor sit amet consectetur, 
                        adipisicing elit. Accusantium, numquam! 
                        Voluptas voluptates quas modi debitis molestias
                        cumque voluptatum fugit laudantium voluptatibus 
                        repellat facere optio cupiditate, vel, aperiam 
                        aliquam consequatur perspiciatis iusto enim quaerat. 
                        Laboriosam, debitis cum. Pariatur consequatur rem tenetur, 
                        sit ullam sint dolores iure natus commodi veniam aliquid odit.
                    </p>
                </div>
                <div class="notify">
                    <input type="checkbox">
                    <p>Lorem ipsum dolor sit amet consectetur, 
                        adipisicing elit. Accusantium, numquam! 
                        Voluptas voluptates quas modi debitis molestias
                        cumque voluptatum fugit laudantium voluptatibus 
                        repellat facere optio cupiditate, vel, aperiam 
                        aliquam consequatur perspiciatis iusto enim quaerat. 
                        Laboriosam, debitis cum. Pariatur consequatur rem tenetur, 
                        sit ullam sint dolores iure natus commodi veniam aliquid odit.
                    </p>
                </div>
                <div class="notify">
                    <input type="checkbox">
                    <p>Lorem ipsum dolor sit amet consectetur, 
                        adipisicing elit. Accusantium, numquam! 
                        Voluptas voluptates quas modi debitis molestias
                        cumque voluptatum fugit laudantium voluptatibus 
                        repellat facere optio cupiditate, vel, aperiam 
                        aliquam consequatur perspiciatis iusto enim quaerat. 
                        Laboriosam, debitis cum. Pariatur consequatur rem tenetur, 
                        sit ullam sint dolores iure natus commodi veniam aliquid odit.
                    </p>
                </div>
                <div class="notify">
                    <input type="checkbox">
                    <p>Lorem ipsum dolor sit amet consectetur, 
                        adipisicing elit. Accusantium, numquam! 
                        Voluptas voluptates quas modi debitis molestias
                        cumque voluptatum fugit laudantium voluptatibus 
                        repellat facere optio cupiditate, vel, aperiam 
                        aliquam consequatur perspiciatis iusto enim quaerat. 
                        Laboriosam, debitis cum. Pariatur consequatur rem tenetur, 
                        sit ullam sint dolores iure natus commodi veniam aliquid odit.
                    </p>
                </div>
            </div>
            </div>
        </div>
    </div>

<?php
    include_once 'footer.php';
?>
