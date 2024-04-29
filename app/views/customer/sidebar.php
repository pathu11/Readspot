<div class="sidebar">
        <!-- Menu section -->
        <div class="menu-section">
            <ul class="menu-list">
                <li data-page="Dashboard"><a href="<?php echo URLROOT; ?>/customer/Dashboard"><i class="fa fa-tachometer sidebar-img-main" aria-hidden="true"></i>Dashboard</a></li>
                <li data-page="Profile"><a href="<?php echo URLROOT; ?>/customer/Profile"><i class="fa fa-user sidebar-img-main" aria-hidden="true"></i>Profile</a></li>
                <li data-page="Notification"><a href="<?php echo URLROOT; ?>/customer/Notification"><i class="fa fa-bell sidebar-img-main" aria-hidden="true"></i>Notification 
                <?php
                    if ($data['unreadNotification'] > 0) {
                        echo '<h1> '. $data['unreadNotification']. ' </h1>';
                    }
                ?>
                </a></li>
                <li data-page="Messages"><a href="<?php echo URLROOT; ?>/customer/Messages"><i class="fas fa-comment-alt sidebar-img-main" aria-hidden="true"></i>Messages</a></li>
                <li data-page="Bookshelf"><a href="<?php echo URLROOT; ?>/customer/Bookshelf"><i class="fa fa-book sidebar-img-main" aria-hidden="true"></i>Bookshelf</a></li>
                <li data-page="Content"><a href="<?php echo URLROOT; ?>/customer/Content"><i class="fa fa-file sidebar-img-main" aria-hidden="true"></i>Content</a></li>
                <li data-page="Event"><a href="<?php echo URLROOT; ?>/customer/Event"><i class='fas fa-clipboard-list sidebar-img-main'></i>Event</a></li>
                <li data-page="Favorite"><a href="<?php echo URLROOT; ?>/customer/Favorite"><i class="fa fa-heart sidebar-img-main" aria-hidden="true"></i>Favorite</a></li>
                <li data-page="Calender"><a href="<?php echo URLROOT; ?>/customer/Calender"><i class="fa fa-calendar sidebar-img-main" aria-hidden="true"></i>Calender</a></li>
                <li data-page="Cart"><a href="<?php echo URLROOT; ?>/customer/Cart"><i class="fa fa-shopping-cart sidebar-img-main" aria-hidden="true"></i>Cart</a></li>
                <li data-page="Order"><a href="<?php echo URLROOT; ?>/customer/Order"><i class='fas fa-box sidebar-img-main'></i>Order</a></li>
                <li data-page="Logout"><a href="<?php echo URLROOT; ?>/landing/IsLoggedOut"><i class="fa fa-sign-out sidebar-img-main" aria-hidden="true"></i>Logout</a></li>
            </ul>


        </div>
        </div>

<div class="mob-sidebar">
        <!-- Menu section -->
        <div class="mob-section">
            <div class="sidebar-img">
                <a href="<?php echo URLROOT; ?>/customer/Dashboard" class="sidebar-link" data-page="Dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i></a>
            </div>
            <div class="sidebar-img">
                <a href="<?php echo URLROOT; ?>/customer/Profile" class="sidebar-link" data-page="Profile"><i class="fa fa-user" aria-hidden="true"></i></a>
            </div>
            <div class="sidebar-img">
                <a href="<?php echo URLROOT; ?>/customer/Notification" class="sidebar-link" data-page="Notification"><i class="fa fa-bell" aria-hidden="true"></i>
                    <?php
                        if ($data['unreadNotification'] > 0) {
                            echo '<h1> '. $data['unreadNotification']. ' </h1>';
                        }
                    ?>
                </a>
            </div>
            <div class="sidebar-img">
                <a href="<?php echo URLROOT; ?>/customer/Messages" class="sidebar-link" data-page="Messages"><i class="fas fa-comment-alt" aria-hidden="true"></i></a>
            </div>
            <div class="sidebar-img">
                <a href="<?php echo URLROOT; ?>/customer/Bookshelf" class="sidebar-link" data-page="Bookshelf"><i class="fa fa-book" aria-hidden="true"></i></a>
            </div>
            <div class="sidebar-img">
                <a href="<?php echo URLROOT; ?>/customer/Content" class="sidebar-link" data-page="Content"><i class="fa fa-file" aria-hidden="true"></i></a>
            </div>
            <div class="sidebar-img">
                <a href="<?php echo URLROOT; ?>/customer/Event" class="sidebar-link" data-page="Event"><i class='fas fa-clipboard-list'></i></a>
            </div>
            <div class="sidebar-img">
                <a href="<?php echo URLROOT; ?>/customer/Favorite" class="sidebar-link" data-page="Favorite"><i class="fa fa-heart" aria-hidden="true"></i></a>
            </div>
            <div class="sidebar-img">
                <a href="<?php echo URLROOT; ?>/customer/Calender" class="sidebar-link" data-page="Calender"><i class="fa fa-calendar" aria-hidden="true"></i></a>
            </div>
            <div class="sidebar-img">
                <a href="<?php echo URLROOT; ?>/customer/Cart" class="sidebar-link" data-page="Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
            </div>
            <div class="sidebar-img">
                <a href="<?php echo URLROOT; ?>/customer/Order" class="sidebar-link" data-page="Order"><i class='fas fa-box'></i></a>
            </div>
            <div class="sidebar-img">
                <a href="<?php echo URLROOT; ?>/landing/IsLoggedOut" class="sidebar-link" data-page="Logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Get the current page URL
                var currentPageUrl = window.location.href;

                // Get all sidebar links
                var sidebarLinks = document.querySelectorAll('.sidebar-link');

                // Loop through sidebar links to find the active one
                for (var i = 0; i < sidebarLinks.length; i++) {
                    var page = sidebarLinks[i].getAttribute('href');
                    if (currentPageUrl.includes(page)) {
                        sidebarLinks[i].parentNode.classList.add('active');
                        break; // Exit the loop once the active item is found
                    }
                }
            });

        </script>
        