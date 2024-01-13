<div class="sidebar">
        <!-- Menu section -->
        <div class="menu-section">
            <ul class="menu-list">
                <li data-page="Dashboard"><a href="<?php echo URLROOT; ?>/customer/Dashboard">Dashboard</a></li>
                <li data-page="Profile"><a href="<?php echo URLROOT; ?>/customer/Profile">Profile</a></li>
                <li data-page="Notification"><a href="<?php echo URLROOT; ?>/customer/Notification">Notification</a></li>
                <li data-page="Bookshelf"><a href="<?php echo URLROOT; ?>/customer/Bookshelf">Bookshelf</a></li>
                <li data-page="Content"><a href="<?php echo URLROOT; ?>/customer/Content">Content</a></li>
                <li data-page="Event"><a href="<?php echo URLROOT; ?>/customer/Event">Event</a></li>
                <li data-page="Favorite"><a href="<?php echo URLROOT; ?>/customer/Favorite">Favorite</a></li>
                <li data-page="Calender"><a href="<?php echo URLROOT; ?>/customer/Calender">Calender</a></li>
                <li data-page="Cart"><a href="<?php echo URLROOT; ?>/customer/Cart">Cart</a></li>
                <li data-page="Logout"><a href="<?php echo URLROOT; ?>/landing/logout">Logout</a></li>
            </ul>
        </div>
        </div>

<div class="mob-sidebar">
        <!-- Menu section -->
        <div class="mob-section">
        <a href="<?php echo URLROOT; ?>/customer/Dashboard" class="sidebar-link" data-page="Dashboard"><img src="<?php echo URLROOT; ?>/assets/images/customer/dashboard.png" alt="logo" class="sidebar-img"></a>
        <a href="<?php echo URLROOT; ?>/customer/Profile" class="sidebar-link" data-page="Profile"><img src="<?php echo URLROOT; ?>/assets/images/customer/myprofile.png" alt="logo" class="sidebar-img"></a>
        <a href="<?php echo URLROOT; ?>/customer/Notification" class="sidebar-link" data-page="Notification"><img src="<?php echo URLROOT; ?>/assets/images/customer/notification.png" alt="logo" class="sidebar-img"></a>
        <a href="<?php echo URLROOT; ?>/customer/Bookshelf" class="sidebar-link" data-page="Bookshelf"><img src="<?php echo URLROOT; ?>/assets/images/customer/bookshelf.png" alt="logo" class="sidebar-img"></a>
        <a href="<?php echo URLROOT; ?>/customer/Content" class="sidebar-link" data-page="Content"><img src="<?php echo URLROOT; ?>/assets/images/customer/mycontent.png" alt="logo" class="sidebar-img"></a>
        <a href="<?php echo URLROOT; ?>/customer/Event" class="sidebar-link" data-page="Event"><img src="<?php echo URLROOT; ?>/assets/images/customer/myevent.png" alt="logo" class="sidebar-img"></a>
        <a href="<?php echo URLROOT; ?>/customer/Favorite" class="sidebar-link" data-page="Favorite"><img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="logo" class="sidebar-img"></a>
        <a href="<?php echo URLROOT; ?>/customer/Calender" class="sidebar-link" data-page="Calender"><img src="<?php echo URLROOT; ?>/assets/images/customer/calendar.png" alt="logo" class="sidebar-img"></a>
        <a href="<?php echo URLROOT; ?>/customer/Cart" class="sidebar-link" data-page="Cart"><img src="<?php echo URLROOT; ?>/assets/images/customer/mycart.png" alt="logo" class="sidebar-img"></a>
        <a href="<?php echo URLROOT; ?>/customer/logout" class="sidebar-link" data-page="Logout"><img src="<?php echo URLROOT; ?>/assets/images/customer/logout.png" alt="logo" class="sidebar-img"></a>
        </div>
        </div>

        <script>
             // Get the current page URL
            var currentPageUrl = window.location.href;

            // Get all sidebar links
            var sidebarLinks = document.querySelectorAll('.sidebar-link');

            // Loop through sidebar links to find the active one
            for (var i = 0; i < sidebarLinks.length; i++) {
                var page = sidebarLinks[i].getAttribute('data-page');
                if (currentPageUrl.includes(page)) {
                    sidebarLinks[i].querySelector('.sidebar-img').classList.add('active');
                    break; // Exit the loop once the active item is found
                }
            }
        </script>
        